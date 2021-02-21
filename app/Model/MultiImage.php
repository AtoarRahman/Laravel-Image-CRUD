<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MultiImage extends Model
{
    protected $fillable = [
        'name', 'email', 'designation'
    ];
	
	public function attachmentImage()
    {
        return $this->belongsTo(Attachment::class,'id','multiImage_id');
    }

}
