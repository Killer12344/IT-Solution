<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

   Route::get('/',[QuestionController::class,'index'])->name('page.home');
   Route::get('/logout',[AuthController::class,'logOut'])->name('logout');

   # like and comment for question
   Route::get('/like/{id}',[QuestionController::class,'isLike'])->name('question.like');
   Route::post('/comment',[QuestionController::class,'createComment'])->name('question.comment');

   # Question
   Route::get('/question-create',[QuestionController::class,'create'])->name('question.create');
   Route::post('/question-create',[QuestionController::class,'store'])->name('question.store');
   Route::get('/question-detail/{slug}',[QuestionController::class,'show'])->name('question.show');
   Route::get('/question-delete/{id}',[QuestionController::class,'delete'])->name('question.delete');
   Route::post('/question-fixed',[QuestionController::class,'isFixed'])->name('question.fixed');

   # Profile
   Route::get('/profile/edit',[PageController::class,'edit'])->name('user.edit');
   Route::post('/profile/edit',[PageController::class,'update'])->name('user.update');
   Route::get('profile/question/',[QuestionController::class,'userQuestion'])->name('question.user');
   Route::get('profile/question/save',[QuestionController::class,'showSave'])->name('question.userSave');
   Route::post('profile/question/save',[QuestionController::class,'saveQuestion'])->name('question.save');

});




Route::middleware(['isLogin'])->group(function () {
   Route::get('/sign-in',[AuthController::class,'login'])->name('login');
   Route::post('/in',[AuthController::class,'loginAcc'])->name('post.login');

   Route::get('/sign-up',[AuthController::class,'register']);
   Route::post('/up',[AuthController::class,'registerAcc']);

});

