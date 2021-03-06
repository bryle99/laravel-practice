<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use PhpParser\Node\Stmt\Echo_;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::latestt()->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {

        $input = $request->all();

        if ($file = $request->file('file')) {
            $name = $file->getClientOriginalName();
            // create images folder in public folder if it doesnt exist
            $file->move('images', $name);
            // path is a column in posts table
            $input['path'] = $name;
        }

        Post::create($input);

        // files
        // $file = $request->file('file');

        // echo '<br>';

        // echo $file->getClientOriginalName();

        // //
        // // return $request->get('title');

        // // $this->validate($request, [
        // //     'title' => 'required'
        // // ]);

        // Post::create($request->all());

        return redirect('/posts');

        // // $post = new Post;
        // // $post->title = $request->title;
        // // $post->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // $post = Post::findOrFail($id);
        // $post->update($request->all());
        $input = $request->all();

        if ($file = $request->file('file')) {
            $name = $file->getClientOriginalName();
            // create images folder in public folder if it doesnt exist
            $file->move('images', $name);
            // path is a column in posts table
            $input['path'] = $name;
        }

        $post = Post::findOrFail($id);
        $post->update($input);

        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Post::whereId($id)->delete();
        return redirect('/posts');
    }

    public function contact()
    {
        $people = ['Bryle', 'Rina', 'Killua', 'Ansey'];

        return view('contact', compact('people'));
    }

    public function show_posts($id, $name)
    {
        $aa = 4;
        // return view('posts')->with('id', $id)->with('aa', $aa);
        return view('posts', compact('id', 'aa', 'name'));
    }
}
