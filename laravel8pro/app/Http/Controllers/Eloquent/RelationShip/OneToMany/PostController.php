<?php

namespace App\Http\Controllers\Eloquent\RelationShip\OneToMany;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
       public function addPost()
       {
           $post = new Post();
           $post->title = "Second Post Title";
           $post->body  = "Second Post Description";
           $post->save();
           return "Post has been created successfully!";
       }



       public function addComment($postId)
       {
            $post = Post::find($postId);

            $comment = new Comment();
            $comment->comment = "This is the first comment";
            $post->comments()->save($comment);

            return "Comment has been posted.";
       }



       public function getCommentsByPostId($postId)
       {
            $comments = Post::find($postId)->comments;

            return $comments;
       }
}
