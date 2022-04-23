<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;


    public function comment(){
        return $this->hasMany(QuestionComment::class);
    }

    public function like(){
        return $this->hasMany(QuestionLike::class);
    }

    public function saveQuestion(){
        return $this->hasMany(QuestionSave::class);
    }


    public function tag(){
        return $this->belongsToMany(Tag::class,'question_tags');
    }
}
