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
use Hash;

class AccountController extends Controller
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
    public function index(Request $request) 
    {
        $authId = Auth::guard('web')->user()->id; 
       
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
        $query = Post::select(_groupArr());

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
        
        $query->where('posts.id_user',$authId)->orderBy('posts.created_at','DESC');

        $posts_count = $query->get()->count(); 
        $posts = $query->offset($position)->limit($item_per_page)->get();
        $total_pages = ceil($posts_count / $item_per_page);  
    
        $page_url =  \Request::fullUrl(); 
        $query = parse_url($page_url, PHP_URL_QUERY);
        if ($query) { $page_url .= '&'; } else { $page_url .= '?';}

        $user = User::where('id',$authId)->first();

        $is_chk_post = 'ALL';
        return view('account.home',compact('posts', 'posts_count','total_pages','param','page_url','user','is_chk_post'));

    }


    public function MYPendingPosts(Request $request) 
    {
        
        $authId = Auth::guard('web')->user()->id; 
        
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
        $query = Post::select(_groupArr());

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
        

        $query->where('posts.id_user',$authId);
        $query->where('is_rejected',0)->where('is_active',0);
        $query->orderBy('posts.created_at','DESC');

        $posts_count = $query->get()->count(); 
        $posts = $query->offset($position)->limit($item_per_page)->get();
        $total_pages = ceil($posts_count / $item_per_page);  
    
        $page_url =  \Request::fullUrl(); 
        $query = parse_url($page_url, PHP_URL_QUERY);
        if ($query) { $page_url .= '&'; } else { $page_url .= '?';}


        $user = User::where('id',$authId)->first();

        $is_chk_post = 'P';
        return view('account.home',compact('posts', 'posts_count','total_pages','param','page_url','user','is_chk_post'));

    }

    public function MYApprovedPosts(Request $request) 
    {
        $authId = Auth::guard('web')->user()->id; 
        
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
        $query = Post::select(_groupArr());

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
        

        $query->where('posts.id_user',$authId);
        $query->where('is_rejected',0)->where('is_active',1);
        $query->orderBy('posts.created_at','DESC');

        $posts_count = $query->get()->count(); 
        $posts = $query->offset($position)->limit($item_per_page)->get();
        $total_pages = ceil($posts_count / $item_per_page);  
    
        $page_url =  \Request::fullUrl(); 
        $query = parse_url($page_url, PHP_URL_QUERY);
        if ($query) { $page_url .= '&'; } else { $page_url .= '?';}


        $user = User::where('id',$authId)->first();

        $is_chk_post = 'A';
        return view('account.home',compact('posts', 'posts_count','total_pages','param','page_url','user','is_chk_post'));

    }

    public function MYRejectedPosts(Request $request) 
    {
        $authId = Auth::guard('web')->user()->id; 
       
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
        $query = Post::select(_groupArr());

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
        
        
        $query->where('posts.id_user',$authId);
        $query->where('is_rejected',1)->where('is_active',0);
        $query->orderBy('posts.created_at','DESC');

        $posts_count = $query->get()->count(); 
        $posts = $query->offset($position)->limit($item_per_page)->get();
        $total_pages = ceil($posts_count / $item_per_page);  
    
        $page_url =  \Request::fullUrl(); 
        $query = parse_url($page_url, PHP_URL_QUERY);
        if ($query) { $page_url .= '&'; } else { $page_url .= '?';}


        $user = User::where('id',$authId)->first();

        $is_chk_post = 'R';
        return view('account.home',compact('posts', 'posts_count','total_pages','param','page_url','user','is_chk_post'));

    }

    public function editProfileForm() 
    {
        
        $user = User::find(Auth::guard('web')->user()->id);
        $countries = Country::where('is_active',1)->get();

        return view('account.edit-profile',compact('countries','user'));
    }

    public function updateUserInfo(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'mobile' => 'required',
            'email' => 'required',
        ]);
       
        
        if(!empty($request->image)){
          $image_name =  time().'.'.$request->file('image')->getClientOriginalExtension();
          $request->image->storeAs('public/avatar',$image_name);
          $request->avatar  = $image_name;
          
        }else{
            unset($request->avatar);
        }

        $user = Auth::guard('web')->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->city = $request->city;
        $user->gender = $request->gender;
        $user->id_country = $request->id_country;
        $user->save();
        
         return response()->json([
            'status' => 'S',
            'msg' => 'Profile updated successfully' 
        ], 201);


    }

    public function postAboutMe(Request $request){

        $user = Auth::guard('web')->user();
        $user->aboutme = $request->aboutme;
        $user->save();
        return response()->json([
            'status' => 'S',
            'msg' => 'Profile updated successfully' 
        ], 201);

    }

    public function upAvatarImg(Request $request)
    {
        $request->validate([
            'avatar' => 'required',
        ]);
       
       if(!empty($request->avatar)){
          $image_name =  time().'.'.$request->file('avatar')->getClientOriginalExtension();
          $request->avatar->storeAs('public/avatar',$image_name);
          $request->avatar  = $image_name;
          
        }else{
            unset($request->avatar);
        }

        $user = Auth::guard('web')->user();
        $user->avatar = $request->avatar;
        $user->save();
        
         return response()->json([
            'status' => 'S',
            'msg' => 'Profile photo updated successfully !' 
        ], 201);


    }
    
    public function showChangePassword()
    {   
        $user = User::find(Auth::guard('web')->user()->id);
        return view('account.change-password',compact('user'));
    }

    public function changePassword(Request $request)
    {

        $this->validate($request, [
            'cpassword' => 'required',
            'cc_password'=>'required|confirmed',
            'cc_password_confirmation'=>'sometimes|required_with:password',
        ]);
        $cpassword = $request->get('cpassword');
        $npassword = $request->get('cc_password');
        
        if (!(Hash::check($cpassword, Auth::guard('web')->user()->password))) {
            // The passwords matches
             return response()->json([
                'status' => 'E',
                'msg' => 'Password and confirm password do not match. Please enter same value in both fields..' 
             ], 201);

           
        }
        if(strcmp($cpassword, $npassword) == 0){
            //Current password and new password are same
            return response()->json([
                 'status' => 'E',
                'msg' => 'New Password cannot be same as your current password. Please choose a different password.' 
             ], 201);
        }
        //Change Password
        $user = Auth::guard('web')->user();
        $user->password = Hash::make($npassword);
        $user->save();
       
        return response()->json([
            'status' => 'S',
            'msg' => 'Password changed successfully !' 
        ], 201);

    }
    
}
    