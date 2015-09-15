<?php

namespace Coverart;

use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    protected $fillable = ['title', 'description'];

    public function user()
    {
        return $this->belongsTo('Coverart\User');
    }
}
