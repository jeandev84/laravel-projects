<?php

namespace App\Http\Controllers\Connection;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Student;
use Illuminate\Http\Request;

class MultipleConnectionController extends Controller
{
      public function addStudents()
      {
          $students = [
              ['name' => 'Smith', "email" => 'smith@gmail.com', 'phone' => '1234567890'],
              ['name' => 'Jennifer', "email" => 'jennifer@gmail.com', 'phone' => '1234567891'],
          ];

          Student::insert($students);

          return "Students are added";
      }



      public function addPosts()
      {
          $posts = [
              ['title' => 'first post title', 'body' => 'first post description'],
              ['title' => 'second post title', 'body' => 'second post description'],
          ];


          Post::insert($posts);

          return "Posts are created";
      }


      public function getStudents()
      {
          return Student::all();
      }


      public function getPosts()
      {
          return Post::all();
      }
}
