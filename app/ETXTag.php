<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ETXTag
 *
 * @package App
 */
class ETXTag extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    protected function entities()  {
        return $this->belongsToMany('ETXEntity', 'ETXEntity_ETXTags', 'entity_id', 'tag_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    protected function events()
    {
        return $this->belongsToMany('ETXEvents', 'ETXEventsETXTags', 'event_id', 'tag_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    protected function locations()
    {
        return $this->belongsToMany('ETXLocation', 'ETXLocationsETXTags', 'location_id', 'tag_id');
    }

    protected function categories()  {
        return $this->belongsToMany('ETXCategory', 'e_t_x_categories_e_t_x_tags', 'tag_id', 'category_id');
    }


}
