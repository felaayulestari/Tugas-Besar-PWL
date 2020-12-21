<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'body', 'user_id', 'thumbnail'];//gaiso menentukan tanpa fill yg dimasukkan
    
    public function getTakeImageAttribute(){
        return   "storage/".$this->thumbnail;
    }
    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
