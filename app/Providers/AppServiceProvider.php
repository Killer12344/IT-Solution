<?php

namespace App\Providers;

use App\Models\Question;
use App\Models\QuestionTag;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Inertia::share('flash',function(){
            return [
                'success' => Session::get('success'),
                'error' => Session::get('error'),
                'status' => Session::get('status'),
                'message' => Session::get('message'),
            ];
        });

        
        // Inertia::share([
        //     'auth_user'=> function(){
        //         return Auth::user();
        //     }
        // ]);

        Inertia::share('auth',function(){
            return Auth::user();
        });

        Inertia::share('allTags',Tag::all());
        Inertia::share('allUser',User::all());
        Inertia::share('allQuestions',Question::all());
        Inertia::share('questionTag',QuestionTag::all());

    }
}
