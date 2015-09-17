<?php

namespace Coverart;

use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    protected $fillable = ['title', 'description', 'platform_id'];

    protected $casts = ['id' => 'integer'];

    public function user()
    {
        return $this->belongsTo('Coverart\User');
    }

    public function platform()
    {
        return $this->belongsTo('Coverart\Platform');
    }
}
