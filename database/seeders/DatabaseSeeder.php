<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionTag;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::created([
            'name' => "Hein Htet Aung",
            'email' => "hh1716101@gmail.com",
            'password' => Hash::make(11111111),
            'photo' => '/images/profile/default.png',

        ]);

        Tag::created([
            'name'=>'Web Development',
            'slug'=> Str::slug('Web Development'),
        ]);
        
        Tag::created([
            'name'=>'Web Development',
            'slug'=> Str::slug('Web Design'),
        ]);
        
        Tag::created([
            'name'=>'Web Development',
            'slug'=> Str::slug('Mobile Development'),
        ]);

        Question::created([
            'user_id'=>1,
            'title'=>'Can we make a Website Dont Sweat?',
            'slug'=>Str::slug('Can we make a Website Dont Sweat?'),
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, tempora iusto ea nulla eligendi rerum quis facilis, vero dolore exercitationem facere quas ipsum placeat dicta nisi mollitia veniam ipsam saepe.'
        ]);

        QuestionTag::created([
            'tag_id'=>1,
            'question_id'=>1,
        ]);

        QuestionTag::created([
            'tag_id'=>2,
            'question_id'=>1,
        ]);

    }
}

