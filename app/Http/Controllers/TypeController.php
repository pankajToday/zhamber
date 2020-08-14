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
use Illuminate\Support\Arr;

class TypeController extends Controller
{
    public function index(Request $request,$type,$tfind = null) {

    	if(empty($type)){
    		return redirect('');
    	}
	    
        //SET TYPE SESSION

       
        $query = Post::select(_groupArr(),DB::raw('SUM(posts.id) AS sum_of_posts'))->where('posts.is_active',1);
        $query = Post::lang_query($query);
        
        if(!empty($type) && empty($tfind)){
	        $query = Post::type_query($query,$type);
        }

        if(!empty($type) && !empty($tfind)){
            $query = Post::tfind_query($query,$type,$tfind);
        }

        $posts = $query->get();
        $posts_count = $posts->count();
        
        /*$iArr = array();
        foreach ($posts as $key => $value) {
            array_push($iArr, $value->id);
        }
        $array_unique = array_unique($iArr);
        print_r(count($array_unique));
*/
	
        $refine = ['type' => $type,'tfind' => $tfind];
		return view('posts.type', compact('posts', 'posts_count','refine'));

    }   
}

