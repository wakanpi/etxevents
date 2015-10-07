<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ETXEntity extends Model
{

    protected function category()
    {
        return $this->belongsTo('ETXCategory');
    }

    protected function events()
    {
        return $this->hasMany('ETXEvents');
    }

    protected function locations()
    {
        return $this->hasMany('ETXLocations');
    }

    protected function tags()
    {
        return $this->hasMany('ETXTags');
    }

}
