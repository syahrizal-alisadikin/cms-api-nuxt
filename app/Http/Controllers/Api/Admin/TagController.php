<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\TagResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get tags
        $tags = Tag::when(request()->q, function ($tags) {
            $tags = $tags->where('name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(5);

        //return with Api Resource
        return new TagResource(true, 'List Data Tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|unique:tags',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create tag
        $tag = Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
        ]);

        if ($tag) {
            //return success with Api Resource
            return new TagResource(true, 'Data Tag Berhasil Disimpan!', $tag);
        }

        //return failed with Api Resource
        return new TagResource(false, 'Data Tag Gagal Disimpan!', null);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::whereId($id)->first();

        if ($tag) {
            //return success with Api Resource
            return new TagResource(true, 'Detail Data Tag!', $tag);
        }

        //return failed with Api Resource
        return new TagResource(false, 'Detail Data Tag Tidak DItemukan!', null);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|unique:tags,name,' . $tag->id,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //update tag
        $tag->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
        ]);

        if ($tag) {
            //return success with Api Resource
            return new TagResource(true, 'Data Tag Berhasil Diupdate!', $tag);
        }

        //return failed with Api Resource
        return new TagResource(false, 'Data Tag Gagal Diupdate!', null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if ($tag->delete()) {
            //return success with Api Resource
            return new TagResource(true, 'Data Tag Berhasil Dihapus!', null);
        }

        //return failed with Api Resource
        return new TagResource(false, 'Data Tag Gagal Dihapus!', null);
    }
}
