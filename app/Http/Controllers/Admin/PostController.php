<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\PostTag;
use App\Vote;
use Auth;
use DB;
use Storage;
use Carbon\Carbon;


class PostController extends Controller
{
    /**
     * Only Authenticated admins for "admin" guard 
     * are allowed.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:post-list');
        $this->middleware('permission:post-create', ['only' => ['create','store']]);
        $this->middleware('permission:post-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:post-remove', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
         $posts = Post::orderBy('id','DESC')->get();
         return view('admin.posts.home',compact('posts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $posts = Post::orderBy('id','DESC')->get();
         return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

   

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $last_10_votes = Vote::where('id_post',$post->id)->orderBy('id','desc')->take(10)->get();
        return view('admin.posts.show',compact('post','last_10_votes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $posts)
    {
       
        $authId = Auth::guard('admin')->User()->id;
        $ip =  $request->all();
        $request->validate([
            'title' => 'required',
          
            'description' => 'required_if:is_link,0',
            'link' => 'required_if:is_link,1',
        ]);
        
         if(!empty($request->icon)){
            
              $image_name =  time().'.'.$request->file('icon')->getClientOriginalExtension();
              $request->icon->storeAs('public/posts/icon',$image_name);
              $ip['icon'] = $image_name;
        }
      
       unset($ip['image']);
       

         $post->update($ip);

         return redirect()->route('admin.posts.index')
                        ->with('success','posts has benn updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        //REMOVE POST TAG FIRST
        PostTag::where('id_post',$post->id)->delete();

        $row = Post::select('image')->where('id',$post->id)->first();
        $directory = 'public/posts/images/';
        $file = $directory.$row->image; 
        if(!empty($file)){
               Storage::delete($file);
        }
   
        $post->delete();
        return redirect()->route('admin.posts.index')
                        ->with('success','posts deleted successfully');
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function today()
    {
       $posts = Post::select('posts.*')->whereDate('posts.created_at', Carbon::today())->orderBy('posts.id','DESC')->get();
       return view('admin.posts.today',compact('posts'));
    }

    public function this_week()
    {
       $posts = Post::select('posts.*')->whereBetween('posts.created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->orderBy('posts.id','DESC')->get();
       return view('admin.posts.this-week',compact('posts'));
    }

    public function this_month()
    {

      
       $posts = Post::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->orderBy('id','DESC')->get();
    

       return view('admin.posts.this-month',compact('posts'));
    }


    public function pending()
    {
       $posts = Post::where('is_active',0)->where('is_rejected',0)->orderBy('id','DESC')->get();
       return view('admin.posts.pending',compact('posts'));
    }

    public function approved()
    {
       $posts = Post::where('is_active',1)->where('is_rejected',0)->orderBy('id','DESC')->get();
       return view('admin.posts.approved',compact('posts'));
    }

     public function rejected()
    {
       $posts = Post::where('is_active',0)->where('is_rejected',1)->orderBy('id','DESC')->get();
       return view('admin.posts.rejected',compact('posts'));
    }



    




    public function postRejectForm($id_post){
        
         $post =Post::where('id',$id_post)->first();
         
         return view('admin.posts.reject_form',compact('post'));
    }


    public function savePostApproved(Request $request){
        
        $authId = Auth::guard('admin')->User()->id;
        $ip = $request->all();
        $uArr = [
            'is_active'         => 1,
            'is_rejected'       => 0,
            'rejected_reason'   => '',
            'rejected_by'       => '',
        ];
        Post::where('id',$request->id_post)->update($uArr);
        
        return response()->json([
            'status' => 'S',
            'msg' => 'User Post has been approved successfully !' 
        ], 201);
       
    }

     public function savePostRejection(Request $request){
        
         $authId = Auth::guard('admin')->User()->id;
        $ip = $request->all();
        $uArr = [
            'is_active'         => 0,
            'is_rejected'       => 1,
            'rejected_reason'   => $ip['rejected_reason'],
            'rejected_by'       => $authId,
        ];

        Post::where('id',$request->id_post)->update($uArr);

        return response()->json([
            'status' => 'S',
            'msg' => 'User Post has been rejected successfully !' 
        ], 201);
       
    }
    public function votes($id_post){

         $post = Post::where('id',$id_post)->first();
         $votes = Vote::orderBy('id','DESC')->get();
         return view('admin.posts.votes',compact('votes','post'));

    }


    public function update_p_stat(Request $request){
        
        $authId = Auth::guard('admin')->User()->id;
        $ip = $request->all();

        if(empty($ip['n_like']) || empty($ip['n_dlike']) || empty($ip['n_views']) ||  empty($ip['id_post'])){

             return response()->json([
                'status' => 'R',
                'msg' => 'All fields are mandatory !' 
            ], 201);

        }

        $uArr = [
            'n_like'    => $ip['n_like'],
            'n_dlike'   => $ip['n_dlike'],
            'n_views'   => $ip['n_views'],
        ];
        Post::where('id',$request->id_post)->update($uArr);

        return response()->json([
            'status' => 'S',
            'msg' => 'Post Statistics has been updated successfully !' 
        ], 201);
       
    }

    
}
