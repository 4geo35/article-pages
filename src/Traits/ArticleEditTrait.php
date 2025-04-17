<?php

namespace GIS\ArticlePages\Traits;

use GIS\ArticleLabels\Models\ArticleLabel;
use GIS\ArticlePages\Interfaces\ArticleModelInterface;
use GIS\ArticlePages\Models\Article;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

trait ArticleEditTrait
{
    public bool $displayData = false;
    public bool $displayDelete = false;
    public bool $displayPublish = false;

    public string $title = "";
    public string $slug = "";
    public string $short = "";
    public string $publishedAt = "";
    public TemporaryUploadedFile|null $cover = null;

    public string|null $coverUrl = null;
    public int|null $articleId = null;

    public Collection|null $labelList = null;
    public array $labels = [];

    public function rules(): array
    {
        $uniqueCondition = "unique:articles,slug";
        if ($this->articleId) $uniqueCondition .= ",{$this->articleId}";
        return [
            "title" => ["required", "string", "max:150"],
            "slug" => ["nullable", "string", "max:150", $uniqueCondition],
            "short" => ["nullable", "string", "max:250"],
            "cover" => ["nullable", "image"],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            "title" => __("Title"),
            "slug" => __("Slug"),
            "short" => __("Short description"),
            "cover" => __("Cover"),
        ];
    }

    public function closeData(): void
    {
        $this->resetFields();
        $this->displayData = false;
    }

    public function showEdit(int $articleId): void
    {
        $this->resetFields();
        $this->articleId = $articleId;
        $article = $this->findModel();
        if (! $article) return;
        if (! $this->checkAuth("update", $article)) return;

        $this->setLabelList($article);
        $this->title = $article->title;
        $this->slug = $article->slug;
        $this->short = $article->short;
        $this->displayData = true;
        if ($article->image_id) {
            $article->load("image");
            $this->coverUrl = $article->image->storage;
        } else $this->coverUrl = null;
    }

    public function update(): void
    {
        $article = $this->findModel();
        if (! $article) return;
        if (! $this->checkAuth("update", $article)) return;
        $this->validate();

        $slugHasChanged = $this->slug !== $article->slug;

        $article->update([
            "title" => $this->title,
            "slug" => $this->slug,
            "short" => $this->short,
        ]);
        $article->livewireImage($this->cover);
        if (config("article-labels")) {
            $article->labels()->sync($this->labels);
        }

        session()->flash("success", __("Article successfully updated"));
        $this->closeData();
        if (method_exists($this, "resetPage")) { $this->resetPage(); }
        if (isset($this->article)) {
            $this->article->fresh();
            if ($slugHasChanged) {
                $this->redirectRoute("admin.articles.show", ["article" => $article]);
            }
        }
        if (! $slugHasChanged) { $this->dispatch("article-updated"); }
    }

    public function showDelete(int $articleId): void
    {
        $this->resetFields();
        $this->articleId = $articleId;
        $article = $this->findModel();
        if (! $article) return;
        if (! $this->checkAuth("delete", $article)) return;

        $this->displayDelete = true;
    }

    public function confirmDelete(): void
    {
        $article = $this->findModel();
        if (! $article) return;
        if (! $this->checkAuth("delete", $article)) return;

        try {
            $article->delete();
            session()->flash("success", __("Article successfully deleted"));
        } catch (\Exception $exception) {
            session()->flash("error", __("Error while deleting article"));
        }

        $this->closeDelete();
        if (method_exists($this, "resetPage")) $this->resetPage();
        if (isset($this->article)) $this->redirectRoute("admin.articles.index");
    }

    public function closeDelete(): void
    {
        $this->displayDelete = false;
        $this->resetFields();
    }

    public function switchFixed(int $articleId): void
    {
        $this->resetFields();
        $this->articleId = $articleId;
        $article = $this->findModel();
        if (! $article) return;
        if (! $this->checkAuth("update", $article)) return;

        $article->update([
            "fixed_at" => $article->fixed_at ? null : now(),
        ]);
    }

    public function switchPublish(int $articleId): void
    {
        $this->resetFields();
        $this->articleId = $articleId;
        $article = $this->findModel();
        if (! $article) return;
        if (! $this->checkAuth("update", $article)) return;

        if ($article->published_at) {
            $article->update([
                "published_at" => null,
            ]);
        } else {
            $this->displayPublish = true;
            $this->publishedAt = date_helper()->format(date_helper()->changeTz(now()->timestamp), "Y-m-d\TH:i");
        }
    }

    public function setPublish(): void
    {
        $article = $this->findModel();
        if (! $article) return;
        if (! $this->checkAuth("update", $article)) return;
        $this->validate([
            "publishedAt" => ["required"]
        ]);

        $article->update([
            "published_at" => $this->publishedAt,
        ]);
        session()->flash("success", __("Article was published"));
        $this->closePublish();
    }

    public function closePublish(): void
    {
        $this->resetFields();
        $this->displayPublish = false;
    }

    protected function findModel(): ?ArticleModelInterface
    {
        if (isset($this->article)) return $this->article;
        $articleModelClass = config("article-pages.customArticleModel") ?? Article::class;
        $article = $articleModelClass::find($this->articleId);
        if (! $article) {
            session()->flash("error", __("Article not found"));
            $this->closeData();
            return null;
        }
        return $article;
    }

    protected function resetFields(): void
    {
        $this->reset(["title", "slug", "short", "publishedAt", "cover", "coverUrl", "articleId", "labelList", "labels"]);
    }

    protected function checkAuth(string $action, ArticleModelInterface $article = null): bool
    {
        try {
            $articleModelClass = config("article-pages.customArticleModel") ?? Article::class;
            $this->authorize($action, $article ?? $articleModelClass);
            return true;
        } catch (\Exception $exception) {
            session()->flash("error", __("Unauthorized action"));
            $this->closeData();
            $this->closeDelete();
            return false;
        }
    }

    protected function setLabelList(ArticleModelInterface $article): void
    {
        if (! config("article-labels")) {
            $this->labelList = null;
            return;
        }
        $labelModelClass = config("article-labels.customLabelModel") ?? ArticleLabel::class;
        $this->labelList = $labelModelClass::query()
            ->select("id", "title")
            ->orderBy("priority")
            ->get();
        $article->load("labels:id");
        foreach ($article->labels as $label) {
            $this->labels[] = $label->id;
        }
    }
}
