<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\User;
use DB;
use Illuminate\Support\Str;
use App\Traits\FileTrait;



class PostsController extends Controller
{

    use FileTrait;

    /**
     * construtor classs.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetch all posts
        //$posts = Post::all();
        //pagination
        $posts = Post::orderBy('created_at','desc')->paginate(5);

        foreach ($posts as $post) {
            $comments = Comment::all()->where('post_id',$post->id);
            $post->comments = $comments;
            $post->commentSize = count($comments);
        }
        $posts->commnets = $comments;
        return view('posts.index',compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        //Create a post

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;

        // Define folder path
        $folder = '/uploads/images/';

        // Make a image name based on user name and current timestamp
        $name = Str::slug(auth()->user()->email).'_'.time();


        // Check if a profile image has been uploaded
        if ($request->has('cover_image')) {
            // Get image file
            $image = $request->file('cover_image');

            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $post->cover_image = $filePath;
        }else{
            $post->cover_image = "/uploads/images/noimage.jpg";
        }


        //save the created post
        $post->save();

        return redirect('/posts')->with('success', 'New Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $comments = Comment::orderBy('updated_at','desc')->where('post_id',$id)->paginate(10);

        foreach ($comments as $comment) {
            $user = User::find($comment->user_id);
            $comment->commentedBy = $user->name;
        }

        return view('posts.show',compact('post','comments'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        //check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorized Page');
        }

        return view('posts.edit')->with('post',$post);
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
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        //Create a post

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;

        // Define folder path
        $folder = '/uploads/images/';

        // Make a image name based on user name and current timestamp
        $name = Str::slug(auth()->user()->email).'_'.time();


        // Check if a profile image has been uploaded
        if ($request->has('cover_image')) {
            // Get image file
            $image = $request->file('cover_image');

            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $post->cover_image = $filePath;
        }


        //save the created post
        $post->save();

        return redirect('/posts')->with('success', 'Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        //check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorized Page');
        }

        $post->delete();

        //deleting the image uploaded

        // Define folder path
        $folder = '/uploads/images/';
        //get file name
        $name = Str::substr($post->cover_image,16);

        $this->deleteOne($folder,'public',$name);


        return redirect('/posts')->with('success', 'Post Removed Successfully');
    }
}
