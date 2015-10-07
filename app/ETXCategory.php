<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ETXCategory extends Model
{

    protected function events()
    {
        return $this->belongsToMany('App\ETXEvent', 'e_t_x_categories_e_t_x_events', 'category_id', 'event_id')->future();
    }


    protected function locations()
    {
        return $this->belongsToMany('ETXLocations');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    protected function tags()
    {
        return $this->belongsToMany('App\ETXTag', 'e_t_x_categories_e_t_x_tags', 'category_id', 'tag_id');
    }

}
