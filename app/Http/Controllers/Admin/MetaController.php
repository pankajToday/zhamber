<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Meta;
use Auth;
use DB;
use Storage;



class MetaController extends Controller
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
    public function index()
    {
         $facilities = Meta::all();
         return view('admin.meta.index',compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.meta.create');
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
        $ip =  $request->all();
        $request->validate([
            'page_url' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_content' => 'required',
        ]);
        
       $icatarr = [ 
            'page_url'                    => $ip['page_url'],
            'meta_title'                => $ip['meta_title'],
            'meta_keywords'             => $ip['meta_keywords'],
            'meta_content'              => $ip['meta_content'],
            'id_admin'                  => $authId
        ];
        
        Meta::create($icatarr);
         return redirect()->route('admin.meta.index')
                        ->with('success','School Meta created successfully.');




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Meta  $meta
     * @return \Illuminate\Http\Response
     */
    public function show(Meta $meta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Meta  $meta
     * @return \Illuminate\Http\Response
     */
    public function edit(Meta $metum)
    {
       /* print_r($meta->toArray());
        die;*/
         
          return view('admin.meta.edit',compact('metum'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Meta  $meta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meta $metum)
    {
       
        $authId = Auth::guard('admin')->User()->id;
        $ip =  $request->all();
       $request->validate([
            'page_url' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_content' => 'required',
        ]);
        $ip['id_admin'] = $authId;
        $metum->update($ip);

         return redirect()->route('admin.meta.index')
                        ->with('success','meta has benn updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Meta  $meta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meta $meta)
    {
       print_r($meta);die;
        $meta->delete();
        return redirect()->route('admin.meta.index')
                        ->with('success','meta deleted successfully');
    }


    
}
