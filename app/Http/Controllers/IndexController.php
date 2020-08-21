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
use Carbon\Carbon;
use Auth;
use Mail;

class IndexController extends Controller
{
    public function index(Request $request) {

    
        //EVERY TIME EMPTY
        $request->session()->put('refine','');

        $param = $request->all();
        if(empty($param['type'])){$param['type'] = 'recent'; }

        //DEFINE SESSION
        $request->session()->put('refine',$param);

        $item_per_page = _itemPerPage();
        $total_items = _totalItems();

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
        $query = Post::select(_groupArr()) ;//->where('posts.is_active',1);
        
        $query = Post::lang_query($query);

        //ONLY TYPE TRUE & TFIND FALSE
        if(!empty($param['type']) && empty($param['tfind'])){
            $query = Post::type_query($query,$param['type']);
        }
        
        //IF BOTH TYPE & TFIND
        if(!empty($param['type']) && !empty($param['tfind'])){
            $query = Post::tfind_query($query,$param['type'],$param['tfind']);
        }

        //IF TAG
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
        
        if($total_items != 0){
          $posts_count = $query->limit($total_items)->get()->count();

             $position_restricted = $total_items - $item_per_page;
            if($position <= $position_restricted){
               $posts = $query->offset($position)->limit($item_per_page)->get();        
            }else{
                $posts = array();
            }
        
        }else{
          $posts_count = $query->get()->count(); 
          $posts = $query->offset($position)->limit($item_per_page)->get();  
        }

        $total_pages = ceil($posts_count / $item_per_page);  

        $page_url =  \Request::fullUrl(); 
        $query = parse_url($page_url, PHP_URL_QUERY);
        if ($query) {$page_url .= '&'; } else {$page_url .= '?'; }

        return view('index', compact('posts', 'posts_count','total_pages','param','page_url'));

    }

    
    public function show($uid)
    {   
    	
        if(!isset($uid)){
            return redirect('');
        }
		
		$post = Post::select('posts.*','users.username','users.id as id_user','users.avatar')
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

        $alsoViewed = Post::where('is_active',1)->where('posts.id','!=',$post->id)->take(4)->get();


        //NEXT AND PREV ID
        $param = session('refine');
        
        $query = Post::select(_groupArr())->where('posts.is_active',1);
        $query = Post::lang_query($query);

        //ONLY TYPE TRUE & TFIND FALSE
        if(!empty($param['type']) && empty($param['tfind'])){
            $query = Post::type_query($query,$param['type']);
        }
        
        //IF BOTH TYPE & TFIND
        if(!empty($param['type']) && !empty($param['tfind'])){
            $query = Post::tfind_query($query,$param['type'],$param['tfind']);
        }

        //IF TAG
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
            $prevURL = asset('p/'.$prev->iunique);    
        }
        if(!empty($next)){
            $nextURL = asset('p/'.$next->iunique);   
        }
        
        return view('posts.show-post',compact('post','alsoViewed','prevURL','nextURL'));


    }    
	
	public function selectLanguage(Request $request){

        $ip = $request->all();
        $request->session()->put('mylang', '');
        if(isset($ip['select_all'])){
            $request->session()->put('mylang', 'all');
        }else{
            $request->session()->put('mylang', $ip['language']);
        }
		if(Auth::guard('web')->check()) {
            $authId = Auth::guard('web')->user()->id; 
             if(is_array(session('mylang'))){
                $lArr = implode(',',session('mylang'));
                User::where('id',$authId)->update(['my_language' => $lArr]); 
             }else{
                User::where('id',$authId)->update(['my_language' => 'all']); 
             }
            
        }
		return response()->json([
            'status' => 'S',
            'msg' => 'Password changed successfully !' 
        ], 201);
    }

    public function user(Request $request,$username)
    {


        $user = User::where('username',$username)->first();

        $param = $request->all();
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

        if(
            (isset(Auth::guard('web')->user()->id) && !isset($param['tfind'])) || 
            (isset(Auth::guard('web')->user()->id) && $param['tfind'] =='ever') 
        ){
           
           $query->leftJoin('votes', function ($join) {
                $authId = Auth::guard('web')->user()->id; 
                $join->on('posts.id', '=', 'votes.id_post')->where('votes.id_user', '=', $authId);
            });
        }

        $query->where('posts.id_user',$user->id)->orderBy('posts.created_at','DESC');

        $posts_count = $query->get()->count(); 
        $posts = $query->offset($position)->limit($item_per_page)->get();
        $total_pages = ceil($posts_count / $item_per_page);  
    
        $page_url =  \Request::fullUrl(); 
        $query = parse_url($page_url, PHP_URL_QUERY);
        if ($query) { $page_url .= '&'; } else { $page_url .= '?';}

        return view('show-user', compact('posts', 'posts_count','total_pages','param','page_url','user'));



    }   

    public function loadImg($iurl = null){


        $color = dechex(rand(0x000000, 0xFFFFFF)); 
        echo $color;
        die;
              
       return view('img-create');

    }

    public function testemail(){

        $user = User::where('username','nitinkharche')->first()->toArray();
        Mail::send('emails.register',$user,function($message)
        {
            $submsg = 'Welcome to Zhamber';
            $message->to('ganeshkharche01@gmail.com')->subject($submsg);
        
        });
        echo "SEND!!"; die;

    }

}
