<?php

namespace GIS\ArticlePages\Interfaces;

use ArrayAccess;
use GIS\Fileable\Interfaces\ShouldGalleryInterface;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use JsonSerializable;
use Stringable;
use GIS\Fileable\Interfaces\ShouldImageInterface;
use Illuminate\Contracts\Broadcasting\HasBroadcastChannel;
use Illuminate\Contracts\Queue\QueueableEntity;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\CanBeEscapedWhenCastToString;
use Illuminate\Contracts\Support\Jsonable;

interface ArticleBlockModelInterface extends Arrayable, ArrayAccess, CanBeEscapedWhenCastToString,
    HasBroadcastChannel, Jsonable, JsonSerializable, QueueableEntity, Stringable, UrlRoutable, ShouldImageInterface, ShouldGalleryInterface
{
    public function article(): BelongsTo;
}
