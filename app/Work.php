<?php

namespace Coverart;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = ['title', 'subcategory_id'];

    public function covers()
    {
        return $this->hasMany('Coverart\Cover');
    }

    public function subcategory()
    {
        return $this->belongsTo('Coverart\Subcategory');
    }

}
