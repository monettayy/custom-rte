<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Crypt;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.blogs.index');
    }

    /**
     * Returns the list of Table.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $input = $request->all();
        $list = Blog::get();

        return response()->json([
            'success' => true,
            'data' => $list,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $input = $request->all();
        $data = Blog::create($input);

        return response()->json([
            'success' => true,
            'data' => $data,
            'redirect' => '/blogs',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::findOrFail(Crypt::decryptString($id));

        return view('pages.blogs.edit', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $input = $request->all();

        $blog = Blog::findOrFail(Crypt::decryptString($id));
        $blog->title = $input['title'];
        $blog->content = $input['content'];
        $blog->save();
        
        return response()->json([
            'success' => true,
            'data' => $blog,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail(Crypt::decryptString($id));
        $blog->delete();

        $list = Blog::get();

        return response()->json([
            'success' => true,
            'data' => $list,
        ]);
    }
}
