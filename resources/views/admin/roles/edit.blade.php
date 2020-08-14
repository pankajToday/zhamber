@extends('layouts.admin')
@section('content')

<div class="row bg-title">
   <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
      <h4 class="page-title">Designation</h4>
   </div>
   <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
      <ol class="breadcrumb">
         <li><a href="#">Dashboard</a></li>
         <li ><a href="{{ route('admin.roles.index') }}">Designation</a></li>
         <li  class="active"><a href="">Edit Designation</a></li>
      </ol>
   </div>
</div>
<!-- /.row -->

<div class="white-box">
 <form action="{{ route('admin.roles.update',$role->id) }}" method="POST">
   @csrf
   @method('PUT')


<div class="row">
   <div class="col-md-12 col-lg-12 col-sm-12">
      <div class="form-group">
         <strong>Name:</strong>
         <input class="form-control" type="text"  name="name" id="name" value="{{ $role->name }}"  autocomplete="Off"   >
      </div>
      <div class="form-group">
         <div class="checkbox checkbox-info">
            <input type="checkbox" id="checkAll"  >
            <label for="checkAll">Check All</label>
         </div>
         @foreach($md_with_permission as $key => $row)
         <div style="border:solid 1px #ddd;margin-bottom:10px;">
          <div class="mod_head">
               <div cas="row m-0 p-0">
                  <div cas="col-md-12">
                    <div class="checkbox checkbox-info m-0 p-b-0">
                       <input type="checkbox" id="chk_{{ $key }}" onchange="ckbCheckAll('chk_{{ $key }}')"  >
                      <label for="chk_{{ $key }}"> {{ str_replace('_',' ',$row['module']) }} </label>
                   </div>
                  </div>
               </div>
          </div>
            <div class="row" style="padding:10px;">
               @foreach($row['permissions'] as $value)
               <div class="col-xs-12 col-sm-4 col-md-3 text-left">
                  <div class="checkbox checkbox-info">
                     <input type="checkbox" name="permission[]" id="{{ $value->name }}" class="chk_{{ $key }}" {{ in_array($value->id, $rolePermissions) ? 'checked': ''  }} value="{{ $value->id }}" >
                     <label for="{{ $value->name }}">{{ $value->text }} </label>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
         @endforeach
      </div>
      <div class="form-group">     
         <button type="submit" class="btn  btn-primary">Submit</button>
      </div>
   </div>
</div>




  </form>
</div>

<script type="text/javascript">
$("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
function ckbCheckAll(key){
  if($("#"+key).prop("checked") == true){
       $("."+key).prop("checked", true);
  }else{
    $("."+key).prop("checked", false);
  }
}
</script>
<style type="text/css">

.mod_head{
  text-transform:capitalize; font-size:16px;font-weight:400; border-bottom:solid 1px #ddd; padding:10px 10px 10px 10px; background: #f5f5f5;
}
</style>
@endsection
