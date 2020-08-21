<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\PostTag;
use App\Post;
use App\User;
use App\Vote;
use App\Language;
use DB;
use Auth;

class MarkController extends Controller
{
    public function index(Request $request,$tag) {

    	if(empty($tag)){
    		return redirect('');
    	}

        //EVERY TIME EMPTY
        $request->session()->put('refine','');

        $param = $request->all();

        //DEFINE SESSION
        $request->session()->put('refine',$param);

        $item_per_page = _itemPerPage();
        if(isset($param['pg'])){
            $page_num = ($param['pg'] != '')?$param['pg']:1;
        }else{
            $page_num = 1;
        }

        $page_number = filter_var($page_num, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
        if (!is_numeric($page_number)) {
            header('HTTP/1.1 500 Invalid page number!');
            exit();
        }
        $position = (($page_number - 1) * $item_per_page);
       
        unset($param['page']);
        unset($param['_token']);
       
      
        //QUERY START
        $query = Post::select(_groupArr())->where('posts.is_active',1);
        
        $query = Post::lang_query($query);
     
        //if tag
        if(!empty($tag)){
            $query = Post::tag_query($query,$tag);
        }

        //CHECK LOGIN & POST ALREADY VOTED
        if(isset(Auth::guard('web')->user()->id)){
           $query->leftJoin('votes', function ($join) {
                $authId = Auth::guard('web')->user()->id; 
                $join->on('posts.id', '=', 'votes.id_post')->where('votes.id_user', '=', $authId);
            });
        }

        $posts_count = $query->get()->count();
        $posts = $query->offset($position)->limit($item_per_page)->get();
        $total_pages = ceil($posts_count / $item_per_page);  
       
         $page_url =  \Request::fullUrl(); 
         $query = parse_url($page_url, PHP_URL_QUERY);
         if ($query) {
             $page_url .= '&';
        } else {
            $page_url .= '?';
        }

        //dd(compact( 'posts', 'posts_count','total_pages','param','page_url','tag'));
        // $page_url =   http_build_query($param,'&');

        return view('posts.tag', compact('posts', 'posts_count','total_pages','param','page_url','tag'));


    }

    public function show($tag,$uid)
    {

        if(!isset($tag) &&  !isset($uid) ){
            return redirect('');
        }

        $post = Post::select('posts.*','users.username','users.id as id_user')
                 ->leftJoin('users','posts.id_user','users.id')
                 ->where('posts.iunique',$uid)
                ->where('posts.is_active',1)->first();

        
        if(collect($post)->isEmpty()){
            return redirect('');   
        }

        //UPDATE n_views IN POST
        Post::where('id',$post->id)->update([
            'n_views' => DB::raw('n_views + 1')
        ]);
        
        $alsoViewed = Post::where('id','!=',$post->id)->take(4)->get();


        //NEXT AND PREV ID
        $param = session('refine');
        
        $query = Post::select(_groupArr())->where('posts.is_active',1);
        $query = Post::lang_query($query);

        //Only type true & tfind false
        if(!empty($param['type']) && empty($param['tfind'])){
            $query = Post::type_query($query,$param['type']);
        }
        
        //If both type & tfind
        if(!empty($param['type']) && !empty($param['tfind'])){
            $query = Post::tfind_query($query,$param['type'],$param['tfind']);
        }

        //if tag
        if(!empty($param['tag'])){
            $query = Post::tag_query($query,$param['tag']);
        }

        //CHECK LOGIN & POST ALREADY VOTED
        if(
            (isset(Auth::guard('web')->user()->id) && !isset($param['tfind'])) || 
            (isset(Auth::guard('web')->user()->id) && $param['tfind'] =='ever') 
        ){
            
           $query->leftJoin('votes', function ($join) {
                $authId = Auth::guard('web')->user()->id; 
                $join->on('posts.id', '=', 'votes.id_post')->where('votes.id_user', '=', $authId);
            });
        }


        $posts = $query->get();
       
        $ids = _idArr($posts);

        $thisindex = array_search($post->id,$ids );
        $previd    = isset( $ids[ $thisindex - 1 ] ) ? $ids[ $thisindex - 1 ] : '';
        $nextid    = isset( $ids[ $thisindex + 1 ] ) ? $ids[ $thisindex + 1 ] : '';
        
        $prev = Post::postInfo($previd,'iunique');
        $next = Post::postInfo($nextid,'iunique');
        
        $prevURL = '';
        $nextURL = '';
        if(!empty($prev)){
            $prevURL = asset('tag/'.$tag.'/'.$prev->iunique);    
        }
        if(!empty($next)){
            $nextURL = asset('tag/'.$tag.'/'.$next->iunique);   
        }
        return view('posts.show-post',compact('post','alsoViewed','prevURL','nextURL'));
    
    }

    public function callTagsHints(Request $request){

        $ip = $request->all();
        $keyword = $ip['keyword'];
        $tags = Tag::where('name', 'LIKE', "%{$keyword}%")->orderBy('name','ASC')->get();
        $reArr = array();
        foreach ($tags as $key => $row) {
            if(!empty($row->name)){
                $reArr[$key] = $row; 
                $reArr[$key]['tkey'] = 't';     
            }
        }
        return json_encode($reArr);
    }

    public function callUserHints(Request $request){

        $ip = $request->all();
        $keyword = $ip['keyword'];
        $users = User::where('username', 'LIKE', "%{$keyword}%")->orderBy('username','ASC')->get();

        $reArr = array();
        foreach ($users as $key => $row) {
            if(!empty($row->username)){
                $reArr[$key] = $row;
                $reArr[$key]['tkey'] = 'u';     
            }
        }
        return json_encode($reArr);
    }   
}
