<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ETXLocation
 *
 * @package App
 */
class ETXLocation extends Model
{

    protected  $fillable = ['name', 'address', 'address2', 'city', 'state', 'zip', 'phone'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    protected function category()
    {
        return $this->hasMany('ETXCategory', '');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    protected function entity()
    {
        return $this->hasMany('ETXEntity', '');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    protected function events()
    {
        return $this->hasMany('ETXEvents');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    protected function tags()
    {
        return $this->hasMany('ETXTags');
    }
}
