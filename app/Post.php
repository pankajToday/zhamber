<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use Auth;
class Post extends Model
{
    protected $fillable = [
        'title','iseo','iunique','is_active','image','description','tags', 'n_like','language',
        'n_dlike','n_share','n_views','is_rejected','rejected_reason','rejected_by','created_by','created_by_type','id_user'

    ];

    public function User()
    {
        return $this->hasOne('App\User','id','id_user');
    }

    public function PostTag()
    {
        return $this->hasMany('App\PostTag','id_post','id');
    }

    public function PostLang()
    {
        return $this->hasMany('App\PostLang','id_post','id');
    }
    
    public function Vote()
    {
        return $this->hasMany('App\Vote','id_post','id');
    }

    public static function  postInfo($id_post,$column = null){
       
        if(!empty($column)){
            return Post::select($column)->where('id',$id_post)->first();
        }else{
           return  Post::select('id','iunique')->where('id',$id_post)->first();
          
        }
    }

    public static function lang_query($query){
        if(_myLang() != 'all'){

            $query->join('post_langs','posts.id','post_langs.id_post');
            $query->whereIn('post_langs.language',_myLang());
            $query->groupBy(_groupArr());

              return $query;
        }else{
            return $query;
        }

    }

    public static function type_query($query,$type){

        if($type == 'popular'){
             //LAST 30 DAYS
             $query->where('posts.created_at','>=',Carbon::now()->subdays(30));
             $query->orderBy('posts.n_like','DESC');
        }
        
        if($type == 'recent'){
             //LAST 30 DAYS
             $query->where('posts.created_at','>=',Carbon::now()->subdays(30));
             $query->orderBy('posts.created_at','DESC');
        }

        if($type == 'most-viewed'){
            $query->orderBy('posts.n_views','DESC');
        }
        return $query;
    }

    public static function tfind_query($query,$type,$tfind){

       
       DB::statement("SET session sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");


        if($type == 'highest-scoring'){

            if($tfind == 'today'){

                $query->leftJoin('votes','posts.id','votes.id_post');  
                $query->whereDate('votes.created_at',Carbon::today());
                if(isset(Auth::guard('web')->user()->id)){
                     $authId = Auth::guard('web')->user()->id; 
                     $query->where('votes.id_user','=',$authId);
                }

                $query->groupBy('votes.id_post',_groupArr())->orderBy('posts.n_like','DESC'); 

                                
            }
            if($tfind == 'week'){

                 $query->leftJoin('votes','posts.id','votes.id_post'); 
                 $query->where('posts.created_at','>=',Carbon::now()->subdays(7));
                 if(isset(Auth::guard('web')->user()->id)){
                     $authId = Auth::guard('web')->user()->id; 
                     $query->where('votes.id_user','=',$authId);
                 }
                
                 $query->groupBy('votes.id_post',_groupArr())->orderBy('posts.n_like','DESC');  
                        

            }
            if($tfind == 'month'){
                
                $query->join('votes','posts.id','votes.id_post'); 
                $query->where('posts.created_at','>=',Carbon::now()->subdays(30));
                
                if(isset(Auth::guard('web')->user()->id)){
                     $authId = Auth::guard('web')->user()->id; 
                     $query->where('votes.id_user','=',$authId);
                }

                $query->groupBy('votes.id_post',_groupArr())->orderBy('posts.n_like','DESC');  

            }
            if($tfind == 'ever'){
                
                 $query->orderBy('posts.n_like','DESC');     
            }

        }
        return $query;
    }

    public static function tag_query($query,$tag){

       
        $query->join('post_tags','posts.id','post_tags.id_post')
        ->where('post_tags.name',$tag);
        return $query;
    }


}

