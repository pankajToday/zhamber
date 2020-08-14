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

class GridController extends Controller
{


    public function index(Request $request) {


        //EVERY TIME EMPTY
        
        $refine = $request->all();
        $item_per_page = 10;
        if(isset($refine['pg'])){
            if($refine['pg'] != ''){
                $pg = $refine['pg'];    
            }else{
                $pg = 1;  
                
            }
            
        }else{
            $pg = 1;
           
        }

       
        $page_number = filter_var($pg, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
        if (!is_numeric($page_number)) {
            header('HTTP/1.1 500 Invalid page number!');
            exit();
        }
        $position = (($page_number - 1) * $item_per_page);
      
       
      
        //QUERY START
       $query = Post::select(_groupArr(),DB::raw('SUM(posts.id) AS sum_of_posts'))->where('posts.is_active',1);

      
       // $query = Post::tag_query($query,'lockdown');
        $posts_count = $query->get()->count();


        
        $posts = $query->offset($position)->limit($item_per_page)->get();


        $total_pages = ceil($posts_count / $item_per_page);   
       

        return view('grid.index', array('posts' => $posts,'total_pages' => $total_pages,'pg'=>$pg));

    }

   


}
