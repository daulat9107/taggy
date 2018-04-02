<?php

namespace Daulat\Taggy;

use Daulat\Taggy\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Daulat\Taggy\Scopes\TaggableScopeTrait;
trait TaggableTrait
{
    use TaggableScopeTrait;
    public function tags()
    {
        return $this->morphToMany(Tag::class,'taggable');  
    }
    /**
     *  We are not going to type hint this because 
        it's going to be a Model, Collection, Array of string
     * @param  [type] $tags [description]
     * @return [type]       [description]
     */
    public function tag($tags)
    {    
         $this->addTags($this->getWorkableTags($tags));
    }
    public function untag($tags = null)
    {
        if($tags === null)
        {
            $this->removeAllTags();
            return;
        }

        $this->removeTages($this->getWorkableTags($tags));
    }
    public function retag($tags){
        $this->removeAllTags();
        $this->tag($tags);
    }
    private function removeAllTags()
    {
        $this->removeTages($this->tags);
    }
    private function removeTages(Collection $tags)
    {
        $this->tags()->detach($tags);
        foreach ($tags->where('count', '>',0) as $tag) {
            $tag->decrement('count');
        }
    }
    private function addTags(Collection $tags)
    {
        $sync=$this->tags()->syncWithoutDetaching($tags->pluck('id')->toArray());

        foreach (array_get($sync,'attached') as $attachedId) {
            $tags->where('id',$attachedId)->first()->increment('count');
        }
    }
    /**
     * Job of this method is whatever we are passing in, always 
     * return a collection
     * @param  [type] $tags [description]
     * @return [type]       [description]
     */
    private function getWorkableTags($tags)
    {
        if(is_array($tags))
        {
            return $this->getTagModels($tags);
        }

        if($tags instanceof Model)
        {
             return $this->getTagModels([$tags->slug]);
        }

        return $this->filterTagCollection($tags); //filter in some point if something is not a tag
    }
    private function filterTagCollection(Collection $tags)
    {
        return $tags->filter(function($tag){
            return $tag instanceof Model;
        });
    }

    private function getTagModels(array $tags)
    {
        return Tag::whereIn('slug',$this->normaliseTagNames($tags))->get();
    }

    private function normaliseTagNames(array $tags)
    {
        return array_map(function($tag){
            return str_slug($tag);
        },$tags);
    }
}
