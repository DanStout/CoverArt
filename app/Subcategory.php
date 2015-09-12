<?php

namespace Coverart;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['name', 'category_id'];

    public function works()
    {
        return $this->hasMany('Coverart\Work');
    }

    public function category()
    {
        return $this->belongsTo('Coverart\Category');
    }

}
