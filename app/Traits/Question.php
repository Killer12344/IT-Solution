<?php
namespace App\Traits;

use App\Models\QuestionLike;
use App\Models\QuestionSave;
use Illuminate\Support\Facades\Auth;

trait Question{

   public function getLike($id){
      $like = QuestionLike::where('question_id',$id)
                  ->where('user_id',Auth::user()->id)->first();

      if ($like) {
          $is_like = 'true';
      }else {
          $is_like ='false';
      }

      $like_count =  QuestionLike::where('question_id',$id)->count();
      $data['is_like'] = $is_like;
      $data['like_count'] = $like_count;
      return $data;
  
  }

  public function getSave($id){
      $save = QuestionSave::where('question_id',$id)->where('user_id',Auth::user()->id)->first();

        if ($save) {
            $is_save = 'true';
        }else{
            $is_save = 'false';
        }

        $data['is_save'] = $is_save;
        return $data;

  }

}
