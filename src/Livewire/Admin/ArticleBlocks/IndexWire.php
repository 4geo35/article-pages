<?php

namespace GIS\ArticlePages\Livewire\Admin\ArticleBlocks;

use GIS\ArticlePages\Interfaces\ArticleBlockModelInterface;
use GIS\ArticlePages\Interfaces\ArticleModelInterface;
use GIS\ArticlePages\Models\Article;
use GIS\ArticlePages\Models\ArticleBlock;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class IndexWire extends Component
{
    use WithFileUploads;

    public ArticleModelInterface $article;

    public bool $displayDelete = false;
    public bool $displayData = false;

    public string $type = "";
    public string $title = "";
    public string $description = "";
    public TemporaryUploadedFile|null $image = null;
    public string|null $imageUrl = null;

    public int|null $blockId = null;

    public function rules(): array
    {
        $rules = [
            "title" => ["nullable", "string", "max:150"],
        ];

        if (in_array($this->type, config("article-pages.blockHasImage")))
            $rules["image"] = ["nullable", "image"];

        if (in_array($this->type, config("article-pages.blockHasDescription")))
            $rules["description"] = ["required", "string"];

        return $rules;
    }

    public function validationAttributes(): array
    {
        return [
            "title" => __("Title"),
            "image" => __("Image"),
            "description" => __("Description"),
        ];
    }

    public function render(): View
    {
        $blocks = $this->article->blocks()->orderBy("priority")->get();
        return view('ap::livewire.admin.article-blocks.index-wire', compact("blocks"));
    }

    #[On("article-updated")]
    public function updateArticleData(): void
    {
        $this->article->fresh();
    }

    public function showCreateBlock(string $type): void
    {
        if (! $this->checkAuth()) return;
        $this->resetFields();
        if (! $this->checkType($type)) return;
        $this->type = $type;
        $this->displayData = true;
    }

    public function closeData(): void
    {
        $this->displayData = false;
        $this->resetFields();
    }

    public function store(): void
    {
        if (! $this->checkAuth()) return;
        if (! $this->checkType($this->type)) return;
        $this->validate();
        $block = $this->article->blocks()->create([
            "type" => $this->type,
            "title" => $this->title,
            "description" => $this->description,
        ]);
        /**
         * @var ArticleBlockModelInterface $block
         */
        $block->livewireImage($this->image);
        session()->flash("block-success", __("Block successfully added"));
        $this->closeData();
    }

    public function showEdit(int $blockId): void
    {
        if (! $this->checkAuth()) return;
        $this->resetFields();
        $this->blockId = $blockId;
        $block = $this->findBlock();
        if (! $block) return;

        $this->type = $block->type;
        $this->title = $block->title;
        $this->description = $block->description;
        if ($block->image_id) {
            $block->load("image");
            $this->imageUrl = $block->image->storage;
        } else $this->imageUrl = null;
        $this->displayData = true;
    }

    public function update(): void
    {
        if (! $this->checkAuth()) return;
        $block = $this->findBlock();
        if (! $block) return;

        $this->validate();
        $block->update([
            "title" => $this->title,
            "description" => $this->description,
        ]);
        $block->livewireImage($this->image);
        session()->flash("block-success", __("Block successfully updated"));
        $this->closeData();
    }

    public function showDelete(int $blockId): void
    {
        if (! $this->checkAuth()) return;
        $this->resetFields();
        $this->blockId = $blockId;
        $block = $this->findBlock();
        if (! $block) return;
        $this->displayDelete = true;
    }

    public function closeDelete(): void
    {
        $this->displayDelete = false;
        $this->resetFields();
    }

    public function confirmDelete(): void
    {
        if (! $this->checkAuth()) return;
        $block = $this->findBlock();
        if (! $block) return;
        $block->delete();
        session()->flash("block-success", __("Block successfully deleted"));
        $this->closeDelete();
    }

    public function moveUp(int $blockId): void
    {
        if (! $this->checkAuth()) return;
        $this->blockId = $blockId;
        $block = $this->findBlock();
        if (! $block) return;

        $previous = $this->article->blocks()
            ->where("priority", "<", $block->priority)
            ->orderBy("priority", "desc")
            ->first();

        if ($previous) $this->switchPriority($block, $previous);
    }

    public function moveDown(int $blockId): void
    {
        if (! $this->checkAuth()) return;
        $this->blockId = $blockId;
        $block = $this->findBlock();
        if (! $block) return;

        $previous = $this->article->blocks()
            ->where("priority", ">", $block->priority)
            ->orderBy("priority")
            ->first();

        if ($previous) $this->switchPriority($block, $previous);
    }

    protected function checkType(string $type): bool
    {
        if (isset(config("article-pages.blockTypesList")[$type])) return true;
        session()->flash("block-error", __("Block type not found"));
        return false;
    }

    protected function checkAuth(): bool
    {
        try {
            $this->authorize("update", $this->article);
            return true;
        } catch (\Exception $exception) {
            session()->flash("block-error", __("Unauthorized action"));
            $this->closeData();
            $this->closeDelete();
            return false;
        }
    }

    protected function resetFields(): void
    {
        $this->reset(["blockId", "title", "description", "image", "imageUrl"]);
    }

    protected function findBlock(): ?ArticleBlockModelInterface
    {
        $blockModelClass = config("article-pages.customArticleBlockModel") ?? ArticleBlock::class;
        $block = $blockModelClass::find($this->blockId);
        if (! $block) {
            session()->flash("block-error", __("Block not found"));
            $this->closeDelete();
            $this->closeData();
            return null;
        }
        return $block;
    }

    protected function switchPriority(ArticleBlockModelInterface $block, ArticleBlockModelInterface $target): void
    {
        $buff = $target->priority;
        $target->priority = $block->priority;
        $target->save();

        $block->priority = $buff;
        $block->save();
    }
}
