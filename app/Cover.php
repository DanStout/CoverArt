<?php

namespace Coverart;

use File;
use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    protected $fillable = ['title', 'description', 'platform_id'];

    protected $casts = ['id' => 'integer', 'user_id' => 'integer', 'platform_id' => 'integer'];

    public function user()
    {
        return $this->belongsTo('Coverart\User');
    }

    public function platform()
    {
        return $this->belongsTo('Coverart\Platform');
    }

    public function delete()
    {
        $fullImg = $this->attributes['full_img_path'];
        $smallPreview = $this->attributes['small_preview_img_path'];
        $largePreview = $this->attributes['large_preview_img_path'];

        File::delete([$fullImg, $smallPreview, $largePreview]);
        return parent::delete();
    }
}
