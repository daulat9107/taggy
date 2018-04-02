<?php
namespace Daulat\Taggy\Scopes;


trait TaggableScopeTrait
{
    public function scopeWithAnyTag($query, array $tags)
    {
        return $query->HasTags($tags);
    }
    public function scopewithAllTags($query, array $tags)
    {
        foreach ($tags as $tag) {
            $query->HasTags([$tag]);
        }
        $query;
    }

    public function scopeHasTags($query, array $tags)
    {
        return $query->whereHas('tags',function($query) use ($tags){
            return $query->whereIn('slug',[$tags]);
        });
    }
}
