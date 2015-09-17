<?php

namespace Coverart;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $fillable = ['name'];

    public function covers()
    {
        return $this->hasMany('Coverart\Cover');
    }
}
