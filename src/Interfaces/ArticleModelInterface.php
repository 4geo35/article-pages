<?php

namespace GIS\ArticlePages\Interfaces;

use ArrayAccess;
use GIS\Fileable\Interfaces\ShouldImageInterface;
use GIS\Metable\Interfaces\ShouldMetaInterface;
use JsonSerializable;
use Stringable;
use Illuminate\Contracts\Broadcasting\HasBroadcastChannel;
use Illuminate\Contracts\Queue\QueueableEntity;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\CanBeEscapedWhenCastToString;
use Illuminate\Contracts\Support\Jsonable;

interface ArticleModelInterface extends Arrayable, ArrayAccess, CanBeEscapedWhenCastToString,
    HasBroadcastChannel, Jsonable, JsonSerializable, QueueableEntity, Stringable, UrlRoutable, ShouldImageInterface, ShouldMetaInterface
{
}
