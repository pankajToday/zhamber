<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use App\Vote;
use Auth;
use DB;

class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         
         $this->middleware('auth:admin');  
         $this->middleware('permission:user-list');
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::orderBy('id','DESC')->get();
        return view('admin.users.index',compact('data'));
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $authId = Auth::guard('admin')->User()->id;
        $request->validate([
            'name' => 'required',
            'show_text' => 'required'
        ]);
        $request->request->add(['id_admin' => $authId]);
        //DB::statement('ALTER TABLE products ADD COLUMN '.$request->name.' VARCHAR(40)');

        
        User::create($request->all());
        return redirect()->route('admin.users.index')
                        ->with('success','users created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $n_like_count = Vote::where('id_user',$user->id)->where('v_type','up')->count();
        $n_dlike_count = Vote::where('id_user',$user->id)->where('v_type','down')->count();

        return view('admin.users.show',compact('user','n_like_count','n_dlike_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $users)
    {

        $categories = User::where('status',0)->get();
        return view('admin.users.edit',compact('users','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $users)
    {
        
        $request->validate([
            'name' => 'required',
            'show_text' => 'required'
        ]);
        
        $users->update($request->all());
        return redirect()->route('admin.users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $users)
    {
        $users->delete();
  
        return redirect()->route('admin.users.index')
                        ->with('success','User deleted successfully');
    }

     public function banned()
    {
        $data = User::where('is_active',0)->orderBy('id','DESC')->get();
        return view('admin.users.banned',compact('data'));
      
        
    }


    public function listUserPosts($id_user)
    {
        $user = User::where('id',$id_user)->first();
        $posts = Post::where('id_user',$id_user)->get();
        return view('admin.users.posts',compact('posts','user'));
        
    }

    public function activeOrDisable(Request $request)
    {
        User::where('id',$request->id_user)->update(['is_active' => $request->upStatus]);
        return response()->json([
            'status'    => 'S',
            'msg'       => '',
        ], 201);
        
    }

   

    

}
