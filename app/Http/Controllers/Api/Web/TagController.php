<?php

namespace App\Http\Controllers\Api\Web;

use App\Models\Tag;
use App\Http\Resources\TagResource;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $tags = Tag::latest()->get();

        //return with Api Resource
        return new TagResource(true, 'List Data Tags', $tags);
    }

    /**
     * show
     *
     * @param  mixed $slug
     * @return void
     */
    public function show($slug)
    {
        $tag = Tag::with('posts.tags', 'posts.category', 'posts.comments')->where('slug', $slug)->first();

        if ($tag) {
            //return with Api Resource
            return new TagResource(true, 'List Data Posts By Tag', $tag);
        }

        //return with Api Resource
        return new TagResource(false, 'Data Tag Tidak Ditemukan!', null);
    }
}
