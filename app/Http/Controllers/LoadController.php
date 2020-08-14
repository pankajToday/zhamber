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

class LoadController extends Controller
{
    public function aload(Request $request) {

        
         
         
        //EVERY TIME EMPTY
        $request->session()->put('refine','');

        $param = $request->all();

        //DEFINE SESSION
        $request->session()->put('refine',$param);

    	$item_per_page = 25;
        $page_number = filter_var($param["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
        if (!is_numeric($page_number)) {
            header('HTTP/1.1 500 Invalid page number!');
            exit();
        }
        $position = (($page_number - 1) * $item_per_page);
        $page_num = $param['page'];


        unset($param['page']);
        unset($param['_token']);
       
      
        //QUERY START
        $query = Post::select(_groupArr(),DB::raw('SUM(posts.id) AS sum_of_posts'))->where('posts.is_active',1);

        //$query = Post::select('posts.*')->where('posts.is_active',1);
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

        $total_posts = $query->get()->count();
        $filters = $query->offset($position)->limit($item_per_page)->get();
       


        $rjson = array();
        foreach ($filters as $key => $row) {
           $rjson[$key] = $row;
           $rjson[$key]['title'] = limit_text($row->title,6);
           $rjson[$key]['image'] = asset('storage/posts/images/'.$row->image); 
           
           if(!empty($param['tag'])){
             $rjson[$key]['post_d_url'] = asset('tag/'.$param['tag'].'/'.$row->iunique); 
           }else{
            $rjson[$key]['post_d_url'] = asset('p/'.$row->iunique);
           }
        } 

        $rArr['total_pages'] = ceil($total_posts/$item_per_page);
        $rArr['total_posts'] = $total_posts;
        $rArr['page_num']    = (int)$page_num;

        $rArr['rjson'] = $rjson;

        if(!empty($rjson)){
            return json_encode($rArr); 
        }else{
            return "NO";
        }
        

    }   
}
