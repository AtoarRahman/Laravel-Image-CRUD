<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'multiImage_id', 'attachment'
    ];
	
	
	public function imageInfo()
    {
        return $this->belongsTo(MultiImage::class,'multiImage_id','id');
    }
}
