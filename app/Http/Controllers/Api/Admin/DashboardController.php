<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $posts      = Post::count();
        $comments   = Comment::count();
        $categories = Category::count();
        $users      = User::count();

        return response()->json([
            'success' => true,
            'message' => 'List Count Data Table',
            'data' => [
                'posts'      => $posts,
                'comments'   => $comments,
                'categories' => $categories,
                'users'      => $users
            ],
        ], 200);
    }
}
