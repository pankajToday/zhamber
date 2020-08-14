<?php
use App\Post;
use App\Tags;
use App\Vote;
use App\User;
use App\Language;

if (!function_exists('_itemImgAlt')) {
   function _itemImgAlt($tArr){
      if(!empty($tArr)){
        $rArr = array();
        foreach ($tArr as $key => $row) {
          //$rArr[$key] =  'This image is a '.$row->name."";
          $rArr[$key] =  $row->name;
        }
        return implode(",",$rArr);
      }else{
        return '';
      }
  }
}

if (!function_exists('_itemPerPage')) {
   function _itemPerPage(){
      return 8;
  }
}

if (!function_exists('_totalItems')) {
   function _totalItems(){
      return 150; // 0 FOR ALL RECORDS
  }
}

if (!function_exists('_charColor')) {

   function _charColor($username){

      $key = ucfirst($username[0]);

      $alphArr = array('A' => '#0000FF','B' => '#A52A2A','C' => '#7FFF00','D' => '#D2691E','D' => '#6495ED','F' => '#00FFFF','G' => '#DC143C','H' => '#00008B','I' => '#006400','J' => '#8B008B','K' => '#556B2F','L' => '#FF8C00','M' => '#8B0000','N' => '#2F4F4F','O' => '#00BFFF','P' => '#1E90FF','Q' => '#228B22','R' => '#FF00FF','S' => '#008000','T' => '#4B0082','U' => '#800000','V' => '#0000CD','W' => '#191970','X' => '#FF4500','Y' => '#800080','Z' => '#FF0000');

      if(!empty($key)){
        if(isset($alphArr[$key])){
          return '<div class="cbox" style="background:'.$alphArr[$key].'">'.$key.'</div>';  
        }else{
          return '<div class="cbox" style="background:#556B2F">'.$key.'</div>';
        }
        

      }else{
        return '<div class="cbox" style="background:">G</div>';
      }


  }
}

function random_color_part() {
    return str_pad(  mt_rand( 0, 255 ) , 2, '0', STR_PAD_LEFT);
}



if (!function_exists('_loadImg')) {
   function _loadImg($img_with_path){

      ob_start();
      list($width, $height, $type, $attr) = getimagesize($img_with_path);
      // Create the size of image or blank image 
      $image = imagecreate($width,$height); 


      $background_color = imagecolorallocate($image, random_color_part(),random_color_part(),random_color_part()); 
      imagefill($image, 0, 0, $background_color); 
      header('Content-type: image/png'); 
      imagepng($image); 
      $rawImageBytes = ob_get_clean();

      return $img64path = base64_encode($rawImageBytes);
    }
}

if (!function_exists('_imgSize')) {
   function _imgSize($img){
      list($width, $height, $type, $attr) = getimagesize($img);
      return $width.'x'.$height;
  }
}






if (!function_exists('_groupArr')) {
   function _groupArr(){
    
    $groupArr = array('posts.iseo','posts.id','posts.iunique','posts.title','posts.description','posts.n_like','posts.n_dlike','posts.n_views','posts.image','posts.created_at','posts.id_user');

    //CHECK LOGIN & POST ALREADY VOTED
    if(Auth::guard('web')->check()) {
      array_push($groupArr,'votes.v_type');
    }

    return $groupArr;

  }
}
if (!function_exists('_idArr')) {

  function _chkMobOrDesk(){

        if(isset($_SERVER['HTTP_USER_AGENT'])){ $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone"); }else{ $iphone = FALSE; }
        if(isset($_SERVER['HTTP_USER_AGENT'])){ $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android"); }else{ $android = FALSE; }
        if(isset($_SERVER['HTTP_USER_AGENT'])){ $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS"); }else{ $palmpre = FALSE; }
        if(isset($_SERVER['HTTP_USER_AGENT'])){ $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry"); }else{ $berry = FALSE; }
        if(isset($_SERVER['HTTP_USER_AGENT'])){ $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod"); }else{ $ipod = FALSE; }
        if(isset($_SERVER['HTTP_USER_AGENT'])){ $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad"); }else{ $ipad = FALSE; }
        if(isset($_SERVER['HTTP_USER_AGENT'])){ $windows = strpos($_SERVER['HTTP_USER_AGENT'],"Windows"); }else{ $windows = FALSE; }
        if(isset($_SERVER['HTTP_USER_AGENT'])){ $touch = strpos($_SERVER['HTTP_USER_AGENT'],"Touch"); }else{ $touch = FALSE; }
        if(isset($_SERVER['HTTP_USER_AGENT'])){ $window_phone = strpos($_SERVER['HTTP_USER_AGENT'],"Windows Phone"); }else{ $window_phone = FALSE; }
        if(isset($_SERVER['HTTP_USER_AGENT'])){ $mobile = strpos($_SERVER['HTTP_USER_AGENT'],"mobile"); }else{ $mobile = FALSE; }
        if(isset($_SERVER['HTTP_USER_AGENT'])){ $TouchPad = strpos($_SERVER['HTTP_USER_AGENT'],"TouchPad"); }else{ $TouchPad = FALSE; }
       
        $_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
        
        if ($iphone || $android || $palmpre || $ipod  || $ipad || $iphone  || $touch || $window_phone || $mobile || $TouchPad || $berry == true) 
        {
          return "M"; 
        }else
        {
          return "D";
        }
  }


}

if (!function_exists('_idArr')) {
   function  _idArr($posts){
    $ids = array();
    foreach ( $posts as $item ) {
        $ids[] = $item->id;
    }
    return $ids;
   }
}

if (!function_exists('_myLang')) {
  function  _myLang(){

    if(Auth::guard('web')->check()) {

      $my_language = Auth::guard('web')->user()->my_language;
      if($my_language == '' ||  $my_language == 'all'){
        return 'all';
      }else{
        return  explode(',',$my_language);
      }

    }else{

          if(!empty(session('mylang'))){
              
            if(is_array(session('mylang'))){
              return session('mylang');
            }else{
              return 'all';
            }

          }else{
            return 'all';
          }  
    }

  }
}

if (!function_exists('_chkVoted')) {
  function  _chkVoted($id_post,$v_type){

    if(isset(Auth::guard('web')->user()->id)){

        $chk = Vote::select('id')->where('id_post',$id_post)
              ->where('id_user',Auth::guard('web')->user()->id)
              ->where('v_type',$v_type)
              ->first();
     if(collect($chk)->isNotEmpty()){
      return 'Y';
     }else{
      return 'N';
     }     
    }else{
      return 'N';
    } 
         
   }   
}

if (!function_exists('_langList')) {
  function  _langList(){
    
    return Language::where('is_active',1)
        ->orderBy('id', 'ASC')->get();
  }   
}

if (!function_exists('_userVote')) {
  function  _userVote($id_user,$v_type){

      $all_posts = Post::where('id_user',$id_user)
                      ->where('created_by_type','U')
                       ->orderBy('id', 'DESC')->get();
      if($v_type == 'up'){
        return $all_posts->sum('n_like');  
      }
       if($v_type == 'down'){
        return $all_posts->sum('n_dlike');  
      }
   }   
}



if (!function_exists('_btnRandom')) {
  function  _btnRandom(){
    $btnArr =  array("btn-danger","btn-success","btn-info","btn-warning","btn-primary","btn-light");
    $key =  array_rand($btnArr,1); 
    return $btnArr[$key];
  }   
}

if (!function_exists('_topTags')) {
  function  _topTags(){
    
            $query = DB::table('post_tags')->select('post_tags.name');
            $query->selectRaw('count(posts.id) as no_sum_post');
            $query->join('posts', 'post_tags.id_post', '=', 'posts.id');

            if(_myLang() != 'all'){
               $query->join('post_langs','posts.id','post_langs.id_post');
               $query->whereIn('post_langs.language', _myLang());
            }

            $query->where('posts.is_active',1);
            $query->groupBy('post_tags.name');
            $query->orderBy(\DB::raw('count(posts.id)'), 'DESC');
            $query->take(15);
            $rtarr = $query->get();

            return $rtarr;

  }   
} 

if (!function_exists('_typePostCount')) {
  function  _typePostCount($tag){
    
    
     $return_val = 0;
      $post_count =  DB::table('post_tags')
            ->selectRaw('count(posts.id) as no_sum_post')
            ->join('posts', 'post_tags.id_post', '=', 'posts.id')
            ->where('posts.is_active',1)
            ->where('post_tags.name',$tag)
            ->groupBy('post_tags.name')
            ->first();
      
       if(collect($post_count)->isNotEmpty()){
          return $return_val = $post_count->no_sum_post; 
       } else{
        return $return_val;
       }  
   }  
    
} 


if (!function_exists('_pstURL')) {
  function  _pstURL($iunique,$type = null){
     return asset('p/'.$iunique);
  }   
} 

if (!function_exists('_pstStatus')) {
  function  _pstStatus($id_post){
    $pst = Post::select('is_active','is_rejected')->where('id',$id_post)->first();

   
    if($pst->is_active == 0 && $pst->is_rejected == 0){
      
      return 'P';
    
    }elseif($pst->is_active == 1 && $pst->is_rejected == 0){
    
      return 'A';
    
    }elseif($pst->is_active == 0 && $pst->is_rejected == 1){

      return 'R';
    }    
  }   
} 

if (!function_exists('_pstStatusColor')) {
  function  _pstStatusColor($id_post){
   if(_pstStatus($id_post) == 'P'){
        return 'yellow';
    }

    if(_pstStatus($id_post) == 'A'){
        return 'green';
    }

    if(_pstStatus($id_post) == 'R'){
        return 'red';
    }
    
  }
}



if (!function_exists('_pfix')) {
  function _pfix($id_post){
     return "PID-".$id_post;
  }
}

if(!function_exists('rSpaceAddDash')) {
    function rSpaceAddDash($string) {

         //Lower case everything
         $string = strtolower($string);
        //Make alphanumeric (removes all other characters)
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean up multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
    }
}

if (!function_exists('_NToken')) {
	function _NToken($num){
		$alphabet = '1234567890';
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < $num; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); 
	}
}

if (!function_exists('_RToken')) {
  function _RToken($char){
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
      $pass = array(); //remember to declare $pass as an array
      $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
      for ($i = 0; $i < $char; $i++) {
          $n = rand(0, $alphaLength);
          $pass[] = $alphabet[$n];
      }
      return implode($pass); 
  }
}


if (!function_exists('in_arrayi')) {
 
    /**
     * Checks if a value exists in an array in a case-insensitive manner
     *
     * @param mixed $needle
     * The searched value
     *
     * @param $haystack
     * The array
     *
     * @param bool $strict [optional]
     * If set to true type of needle will also be matched
     *
     * @return bool true if needle is found in the array,
     * false otherwise
     */
    function in_arrayi($needle, $haystack, $strict = false)
    {
        return in_array(strtolower($needle), array_map('strtolower', $haystack), $strict);
    }
}


if (!function_exists('inArrChkKeyVal')) {
  
  function inArrChkKeyVal($key,$value, $rArr, $strict = false)
  {

        if(array_key_exists($key,$rArr)){
        
           $refine = [];
            foreach ($rArr as $k => $val) 
            {
                $val = urldecode($val); 
                if (trim($val) != '') 
                {
					$refine[$k] = explode(",", $val);
                }
            }
            return in_array_r($value,$refine);

        }else{

           return false;    

        }
    }
}

if (!function_exists('in_array_r')) {
	function in_array_r($needle, $haystack, $strict = false) {

	    foreach ($haystack as $item) {
	        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
	            return true;
	        }
	    }
	    return false;
	}
}
if (!function_exists('removeFromString')) {
	function removeFromString($str, $item,$sept) {
	    $parts = explode($sept, $str);
	    while(($i = array_search($item, $parts)) !== false) {
	        unset($parts[$i]);
	    }
	     return implode($sept, $parts);
	}
}

if (!function_exists('_str2HashtagArr')) {

  function _str2HashtagArr($string) {

     /* Match hashtags */
     preg_match_all('/#(\w+)/', $string, $matches);

      /* Add all matches to array */
      foreach ($matches[1] as $match) {
        $keywords[] = $match;
      }
      if(!empty($keywords)){
        return (array) $keywords;  
      }else
      {
        return array('');
      }
      
   }

}

if (!function_exists('_str2HashtagStr')) {

  function _str2HashtagStr($string) {

      preg_match_all('/#(\w+)/', $string, $matches);

      /* Add all matches to array */
      foreach ($matches[1] as $match) {
        $keywords .= $match . ', ';
      }

     return rtrim(trim($keywords), ',');
    
   }
}

if (!function_exists('_str2HashtagStrLink')) {

  function _str2HashtagStrLink($string) {

      preg_match_all('/#(\w+)/', $string, $matches);
      foreach ($matches[1] as $match) {
          if(strlen($match) >= 3){
           /*$string = str_replace("#$match", "<a href='".asset('/tag/'.$match)."' class='btn btn-sm btn-outline-warning' style='margin:0px 5px 5px 5px'>#$match</a>", "$string");*/

           $string = str_replace("#$match", "<a href='".asset('/tag/'.$match)."'>#$match</a>", "$string");
         
        }
      }
      return $string;
    
   }
}

if (!function_exists('limit_text')) {
  function limit_text($text, $limit) {
         $text =  strip_tags($text);
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
  }
}


if (!function_exists('limit_words')) {
  function limit_words($string, $word_limit)
  { 
      $text =  strip_tags($string);
      $words = explode(" ",$string);
      return implode(" ", array_splice($words, 0, $word_limit));
  }
}


if (!function_exists('sendPushNotification')) {

    function sendPushNotification($fcm_keys,$msg)
    {

        $data = $msg;
        $target = $fcm_keys;
        $url = 'https://fcm.googleapis.com/fcm/send';
        $server_key = 'AIzaSyBVeQKs5Qnkkzh_fyGDJWdMwTb8QEmA-X0';
        
        $fields = array();
        $fields['data'] = $data;
        if(is_array($target)){
            $fields['registration_ids'] = $target;
        }else{
            $fields['to'] = $target;
        }

        $headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$server_key
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
		
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return true;
    }

}




