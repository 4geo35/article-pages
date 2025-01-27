<?php

namespace GIS\ArticlePages\Livewire\Admin\ArticleBlocks;

use GIS\ArticlePages\Interfaces\ArticleBlockModelInterface;
use GIS\ArticlePages\Interfaces\ArticleModelInterface;
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

        if (in_array($this->type, config("article-pages.blockImageValidation")))
            $rules["image"] = ["nullable", "image"];

        if (in_array($this->type, config("article-pages.blockDescriptionValidation")))
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
        return view('ap::livewire.admin.article-blocks.index-wire');
    }

    #[On("article-updated")]
    public function updateArticleData(): void
    {
        $this->article->fresh();
    }

    public function showCreateBlock(string $type): void
    {
        $this->resetFields();
        if (! $this->checkType($type)) return;
        $this->type = $type;
        $this->displayData = true;
    }

    public function closeDelete(): void
    {

    }

    protected function checkType(string $type): bool
    {
        if (isset(config("article-pages.blockTypesList")[$type])) return true;
        session()->flash("block-error", __("Block type not found"));
        return false;
    }

    protected function resetFields(): void
    {
        $this->reset(["blockId", "title", "description", "image", "imageUrl"]);
    }

    protected function findBlock(): ?ArticleModelInterface
    {
        $blockModelClass = config("article-pages.customArticleBlockModel") ?? ArticleBlock::class;
        $block = $blockModelClass::find($this->blockId);
        if (! $block) {
            session()->flash("block-error", __("Block not found"));
            $this->closeDelete();
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
