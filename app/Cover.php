<?php

namespace Coverart;

use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    protected $fillable = ['description', 'img_path', 'work_id'];

    public function work()
    {
        return $this->belongsTo('Coverart\Work');
    }

}

