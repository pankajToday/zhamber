<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

use App\Admin;
use Auth;
use Hash;
use DB;
use Debugbar;
use Illuminate\Support\Arr;

class AdminController extends Controller
{
    
    /**
     * Only Authenticated admins for "admin" guard 
     * are allowed.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       /*
        Message

        Debugbar::info($request);
        Debugbar::error('Error!');
        Debugbar::warning('Watch out…');
        Debugbar::addMessage('Another message', 'mylabel');*/


       
        $data = Admin::where('id','!=',1)->orderBy('id','DESC')->paginate(12);
        return view('admin.employee.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 12);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

        $roles = Role::where('name','!=','super_admin')->pluck('name','name');

       // $roles = Role::pluck('name','name')->all();
        return view('admin.employee.create',compact('roles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $admin = Admin::create($input);

        $admin->guard_name = 'admin';
        $admin->assignRole($request->input('roles'));


        return redirect()->route('admin.employee.index')
                        ->with('success','Admin created successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = Admin::find($id);
        return view('admin.employee.show',compact('admin'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::find($id);
       // $roles = Role::pluck('name','name')->all();
        $roles = Role::where('name','!=','super_admin')->pluck('name','name');
        $adminRole = $admin->roles->pluck('name','name')->all();
        
       /* echo "<pre>";
        print_r($adminRole);
        die;*/

        return view('admin.employee.edit',compact('admin','roles','adminRole'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        

        /*Timeline

        Debugbar::startMeasure('render','Time for rendering');
        Debugbar::stopMeasure('render');
        Debugbar::addMeasure('now', LARAVEL_START, microtime(true));
        Debugbar::measure('My long operation', function() {
        // Do something…
        });*/
        

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);


      

         $input = $request->all();
        if(!empty($input['password'])){ 
           $input['password'] = Hash::make($input['password']);
        }else{
           $input = Arr::except($input,array('password'));    
        }


        $admin = Admin::find($id);
        $admin->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        
        $admin->assignRole($request->input('roles'));

        return redirect()->route('admin.employee.index')
                        ->with('success','Admin updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::find($id)->delete();
        return redirect()->route('admin.employee.index')
                        ->with('success','Admin deleted successfully');
    }

    public function showChangePassword()
    {   
        $user = Admin::find(Auth::guard('admin')->user()->id);
        return view('admin.employee.change-password',compact('user'));
    }

    public function changePassword(Request $request)
    {

        $this->validate($request, [
            'cpassword' => 'required',
            'password'=>'required|confirmed',
            'password_confirmation'=>'sometimes|required_with:password',
        ]);
        $cpassword = $request->get('cpassword');
        $npassword = $request->get('password');
        
        if (!(Hash::check($cpassword, Auth::guard('admin')->user()->password))) {
            // The passwords matches
            $retunr_arr = array(
             'status' => 'E',
             'msg' => 'Your current password does not matches with the password you provided. Please try again.' 
            );
            return json_encode($retunr_arr);   die;
        }
        if(strcmp($cpassword, $npassword) == 0){
            //Current password and new password are same
            $retunr_arr = array(
            'status' => 'E',
            'msg' => 'New Password cannot be same as your current password. Please choose a different password.' 
            );
            return json_encode($retunr_arr);   die;
        }
        //Change Password
        $user = Auth::guard('admin')->user();
        $user->password = Hash::make($npassword);
        $user->save();
        
        $retunr_arr = array(
            'status' => 'S',
            'msg' => 'Password changed successfully !' 
        );
        return json_encode($retunr_arr);   die;
    }

}
