<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Crypt;

class Blog extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'content',
    ];

    protected $appends = ['code'];
    
    public function getCodeAttribute(){
        if(isset($this->attributes['id']))
            return Crypt::encryptString($this->attributes['id']);
        
        return null;
    }
}
