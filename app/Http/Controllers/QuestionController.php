<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionComment;
use App\Models\QuestionLike;
use App\Models\QuestionSave;
use App\Models\QuestionTag;
use App\Models\Tag;
use App\Traits\Question as TraitsQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class QuestionController extends Controller
{

    use TraitsQuestion;

    # AllQuestions

    public function index(Request $request){

        if ($slug = $request->tag) {
            
            $tag = Tag::where('slug',$slug)->first();
            $questions = $tag->question()->with('comment','saveQuestion','tag')->latest('id')->paginate(3);

        }
        elseif($request->type == 'answer'){

            $questions = Question::whereHas('comment',function($query){
                $query->where('user_id',Auth::user()->id);
            })->with('comment','saveQuestion','tag')->paginate(3);
        
        }elseif($request->type == 'unanswer'){
            $questions = Question::has('comment','<',1)->with('comment','saveQuestion','tag')->paginate(3);
        }
        else{
            $questions = Question::with('comment','saveQuestion','tag')->paginate(3);
        }

        foreach($questions as $k=>$v){
            $questions[$k]->is_like = $this->getLike($v->id)['is_like'];
            $questions[$k]->like_count = $this->getLike($v->id)['like_count'];
            $questions[$k]->is_save = $this->getSave($v->id)['is_save'];
        };


        return Inertia::render("Home",compact('questions'));
    }

    # Question Detail

    public function show($slug){


        $question = Question::with('comment.user','like','tag')->where('slug',$slug)->first();
        $question->is_like = $this->getLike($question->id)['is_like'];
        $question->like_count = $this->getLike($question->id)['like_count'];



        return Inertia::render("QuestionDetail",compact('question'));
    }
    
    # Question Like

    public function isLike($id){

        $like = new QuestionLike();

        $like->user_id = Auth::user()->id;
        $like->question_id = $id;
        $like->save();

    }

    # Question Comment

    public function createComment(Request $request){


        $q_comment = new QuestionComment();

        $q_comment->question_id = $request->q_id;
        $q_comment->comment = $request->comment;
        $q_comment->user_id = Auth::user()->id;

        $q_comment->save();

        $comment = QuestionComment::where('id',$q_comment->id)->with('user')->first();
        return ['success'=>true,'comment'=>$comment];
    }

    # Question Index


    public function create(){
        return Inertia::render('CreateQuestion');
    }

    # Question Create


    public function store(Request $request){

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tag' => 'required',
        ]);

        $q = new Question();

        $q->title = $request->title;
        $q->description = $request->description;
        $q->user_id = Auth::user()->id;
        $q->slug = Str::slug($request->title);
        $q->save();

        foreach($request->tag as $v){

            $tag = new QuestionTag();
            $tag->question_id = $q->id;
            $tag->tag_id = $v;
            $tag->save();
        }

        return redirect()->route('page.home')->with('success','Created is Success');

    }

    # showUserQuestion

    public function userQuestion(){

        $current = Auth::user()->id;
        $user_question = Question::where('user_id',$current)->with('comment.user','saveQuestion','tag')->latest('id')->paginate(3);
        foreach($user_question as $k=>$v){
            $user_question[$k]->is_like = $this->getLike($v->id)['is_like'];
            $user_question[$k]->like_count = $this->getLike($v->id)['like_count'];
        };

        return Inertia::render('UserQuestion',compact('user_question'));
    }

    # Question Delete

    public function delete($id){

        $q = Question::where('id',$id)->first();



        $q->delete();

        return response()->json(['success'=>true]);

    }

    #Question Fix

    public function isFixed(){
        $id = request()->id;
        $q = Question::where('id',$id)->first();
        $q->is_fixed = 'true';
        $q->update();
        return ['success'=>true];
    }

    #Question Save

    public function showSave(){

        $saveQ = QuestionSave::with('question')->where('user_id',Auth::user()->id)->get();
    
        return Inertia::render('SaveQuestion',compact('saveQ'));
    
    }

    public function saveQuestion(Request $request){
        
        $questions = new QuestionSave();
        $questions->user_id = Auth::user()->id;
        $questions->question_id = $request->id;
        $questions->save();

        return ['success'=>true];

    }

}
