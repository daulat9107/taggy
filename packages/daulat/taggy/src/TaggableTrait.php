<?php

namespace Daulat\Taggy;

use Daulat\Taggy\Models\Tag;

trait TaggableTrait
{
    public function tags()
    {
        return $this->morphToMany(Tag::class,'taggable');  
    }
}
