<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\PostTag;
use App\Post;
use App\User;
use App\Vote;
use App\Language;
use App\Contact;
use DB;

class StaticController extends Controller
{
   
     public function sbmk() {
        return view('static.sbmk');
    }

    public function zpp() {
        return view('static.zpp');
    }
    
    public function contactus() {
        
        return view('static.contact');
    }

    public function aboutus() {
        
        return view('static.about');
    }

    public function privacy_policy() {
        
        return view('static.privacy-policy');
    }

    public function terms_conditions() {
        
        return view('static.terms-conditions');
    }

    public function terms_of_service() {
        
        return view('static.terms-of-service');
    }

     public function rules() {
        
        return view('static.rules');
    }

    public function advertise() {
        
        return view('static.advertise');
    }

    public function sendContactEnquiry(Request $request){

    	$ip = $request->all();

    	if(empty($ip['name']) || empty($ip['email']) || empty($ip['mobile'])){
        		
                return response()->json([
                    'status' => 'R',
                    'msg' => 'All fields are Mandatory.!' 
                 ], 201);
    	}
    	
    	Contact::create($ip);

    	return response()->json([
            'status' => 'S',
            'msg' => 'Profile updated successfully' 
        ], 201);


    }

    
   

}
