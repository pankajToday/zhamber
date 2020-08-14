<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Post;
use App\Tag;
use App\PostTag;
use App\Country;
use App\Vote;
use App\PostLang;


class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth:web');
         
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index() 
    {
        
    }


    public function newPostForm() 
    {
        $authId = Auth::guard('web')->user()->id; 
       return view('account.new-post');
    }

    public function submitNewPost(Request $request) 
    {
        /*return back()->with('success', 'Profile updated!');*/

        $authId = Auth::guard('web')->user()->id;
        $request->validate([
            'title' => 'required',
            'image' => 'required',
            'language' => 'required',
        ]);
        
        $ip = $request->all(); 

       
        if(!empty($request->image)){
          $image_name =  time().'.'.$request->file('image')->getClientOriginalExtension();
          $request->image->storeAs('public/posts/images',$image_name);
          $ip['image'] = $image_name;
        }

        //SET UNIQUE
        $ip['iunique']  = _RToken(7);
        $ip['iseo']     = rSpaceAddDash($ip['title']);
        $ip['created_by']  = $authId;
        $ip['created_by_type']  = 'U';
        $ip['id_user']  = $authId;
        $ip['is_rejected']  = 0;
        $ip['is_active']  = 0;
        
        $langArr = $ip['language'];
        $ip['language']  = implode(',',$langArr);
        $post = Post::create($ip);

        //POST HASH TAGS
        $tagArr = explode(",",$ip['description']);
        if(collect($tagArr)->isNotEmpty()){
           
           foreach ($tagArr as $key => $tag) {
              if(!empty($tag) && strlen($tag) >= 3){
                //POST TAG
                PostTag::create([
                          'id_post' => $post->id,
                          'name' => $tag]);

                ///ADD TAG TO TAG TABLE
                $isExist = Tag::where('name',$tag)->first();
                if(collect($isExist)->isEmpty()){
                    Tag::create(['name' => $tag]);    
                }
              }
            }
        }

        //INSERT POST LANGUAGE
        if(collect($langArr)->isNotEmpty()){
          foreach ($langArr as $key => $lang) {
            if(!empty($lang)){

                PostLang::create([
                    'id_post' => $post->id,
                    'language' => $lang]);
            }
            
          }
        }

        return response()->json([
                'status' => 'S',
                'msg' => 'Your post has been submitted successfully.!' 
        ], 201);
        


    }

    public function ajxHintTags($keyword = null)
    {   
        $query = Tag::select('*');
        $query->where('name', 'like', $keyword . '%');
        $listing = $query->take(10)->get();
        $sort_order = array();
        foreach ($listing as $key => $value) {
            $sort_order[$key] =  strip_tags(html_entity_decode($value->name, ENT_QUOTES, 'UTF-8'));
           
        }
        return json_encode($sort_order);
   }
   
   public function upOrdownVote(Request $request){

       $v_type = $request->upordown;

       $authId = Auth::guard('web')->user()->id;
       
       $chk = Vote::where('id_post',$request->id_post)
              ->where('id_user',$authId)
              ->first();
       
       $post = Post::where('id',$request->id_post)->first();
       $is_canceled = 'N';

       if(collect($chk)->isNotEmpty()){

          if($chk->v_type == $v_type){

              
              /*
              return response()->json([
                'status' => 'A',
                'msg' => 'You have already voted for the post!' 
                ], 201);*/

             Vote::where('id',$chk->id)->delete();
             if($chk->v_type  == 'up'){
               $up_count = $post->n_like - 1;
               $post->n_like = ($up_count > 0)?$up_count:'0';
              }else{
                  $down_count = $post->n_dlike - 1;
                  $post->n_dlike = ($down_count > 0)?$down_count:'0';
              }
              $post->save();

               $is_canceled = 'Y';

          }else{

             Vote::where('id',$chk->id)->delete();
             if($chk->v_type  == 'up'){
               $up_count = $post->n_like - 1;
               $post->n_like = ($up_count > 0)?$up_count:'0';
              }else{
                  $down_count = $post->n_dlike - 1;
                  $post->n_dlike = ($down_count > 0)?$down_count:'0';
              }
              $post->save();


              Vote::create(['id_user' => $authId,
                'id_post' => $request->id_post,
                'v_type' => $v_type]);

              if($v_type  == 'up'){
                   $up_count = $post->n_like + 1;
                   $post->n_like = $up_count;
              }else{
                  $down_count = $post->n_dlike + 1;
                  $post->n_dlike = $down_count;
              }
              $post->save();


          }
      
      }else{
    
         Vote::create(['id_user' => $authId,
                'id_post' => $request->id_post,
                'v_type' => $v_type]);

          if($v_type  == 'up'){
               $up_count = $post->n_like + 1;
               $post->n_like = $up_count;
          }else{
              $down_count = $post->n_dlike + 1;
              $post->n_dlike = $down_count;
          }
          $post->save();
      
      }
      
      $vpost = Post::where('id',$request->id_post)->first();
      return response()->json([
            'status' => 'S',
            'up_c' => $vpost->n_like,
            'down_c' => $vpost->n_dlike,
            'msg' => 'Thank for voting!',
            'is_canceled' => $is_canceled,

      ], 201);

   }  

    
}
    