<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        //return with Api Resource
        return new CategoryResource(true, 'List Data Categories', $categories);
    }

    /**
     * show
     *
     * @param  mixed $slug
     * @return void
     */
    public function show($slug)
    {
        $category = Category::with('posts.tags', 'posts.category', 'posts.comments')->where('slug', $slug)->first();

        if ($category) {
            //return with Api Resource
            return new CategoryResource(true, 'List Data Post By Category', $category);
        }

        //return with Api Resource
        return new CategoryResource(false, 'Data Category Tidak Ditemukan!', null);
    }

    /**
     * categorySidebar
     *
     * @return void
     */
    public function categorySidebar()
    {
        $categories = Category::orderBy('name', 'ASC')->get();

        //return with Api Resource
        return new CategoryResource(true, 'List Data Categories Sidebar', $categories);
    }
}
