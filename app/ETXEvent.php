<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ETXEvent extends Model
{

    protected $fillable = ['user_id', 'location_id', 'date_start', 'date_stop', 'title', 'description', 'slug'];

    protected function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

    protected function config()
    {
        return $this->hasOne('ETXEventConfig', 'event_id');
    }

    protected function categories()
    {
        return $this->belongsToMany('App\ETXCategory', 'e_t_x_categories_e_t_x_events', 'event_id', 'category_id');
    }

    protected function tags()
    {
        return $this->hasMany('ETXTag', 'tag_id');
    }

    protected function entity()
    {
        return $this->hasMany('ETXEntity', 'entity_id');
    }

    protected function location()
    {
        return $this->hasOne('ETXLocation', 'location_id');
    }


    public function scopeFuture($query)  {
        return $query->where('date_start', '>=', date('Y-m-d-'));
    }

    public function scopePast($query)  {
        return $query->where('date_start', '<', date('Y-m-d'));
    }

    public function scopeSearch($query, $kw)  {
        return $query->where('title', 'LIKE' , '%'. $kw .'%')
            ->orwhere('description', 'LIKE', '%'. $kw .'%');
    }
}
