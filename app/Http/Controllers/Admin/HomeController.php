<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Tag;
use App\PostTag;
use App\Vote;
use App\Contact;

use Auth;
use DB;
use Storage;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Only Authenticated users for "admin" guard 
     * are allowed.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show Admin Dashboard.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(){
      
       $total_post_c = Post::select('posts.*')->count();
       $today_post_c = Post::select('posts.*')->whereDate('posts.created_at', Carbon::today())->count();
       
       $week_post_c = Post::where('posts.created_at','>=',Carbon::now()->subdays(7))->count();

       $month_post_c =  Post::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();


       $pending_post_c = Post::where('is_active',0)->where('is_rejected',0)->count();
       $rejected_post_c = Post::where('is_active',0)->where('is_rejected',1)->count();
       $approved_post_c = Post::where('is_active',1)->where('is_rejected',0)->count();


       $tol_users_c = User::count();

      $tol_banned_c = User::where('is_active',0)->count();

        $last_5_enq  = Contact::orderBy('id','desc')->take(5)->get();
       return view('admin.home',compact('today_post_c','total_post_c','week_post_c','month_post_c','last_5_enq','pending_post_c','tol_users_c','tol_banned_c','rejected_post_c','approved_post_c'));

    }

    public function getLast6MonthsDetails(){
        $month = date('m');
        $year  = date('Y');
        $i = 0;
        $date = array();
        while($i<6){
          $timestamp = mktime(0,0,0,$month,1,$year);
          $date[$i]['month']      = date('F', $timestamp);
          $date[$i]['monthCount'] = date('m', $timestamp);
          $date[$i]['monthShort'] = date('m', $timestamp);
          $date[$i]['daysInMonth'] = date('t', $timestamp);
          $date[$i]['year']      = date('Y', $timestamp);
          $date[$i]['yearShort']  = date('y', $timestamp);
          $month--;
          $i++;
        }
        return $date;
    }

    public function contactEnquiryList(){

       $enquiries  = Contact::all();
       return view('admin.enquiries',compact('enquiries'));

    }

    public function tagList(){

       $tags  = Tag::select('tags.name','tags.created_at')
        ->selectRaw('count(post_tags.id_post) as no_sum_post')
        ->join('post_tags','tags.name','post_tags.name')->groupBy('tags.name')
        ->orderBy(\DB::raw('count(post_tags.id_post)'), 'DESC')->get();
        return view('admin.tags.index',compact('tags'));

    }

   
}
