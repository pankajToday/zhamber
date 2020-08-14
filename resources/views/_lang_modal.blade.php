<div class="modal fade" id="langModal" tabindex="-1" role="dialog" aria-labelledby="LangModalTitle" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
         <!--   <div class="modal-header" style="background: #48484!important;">
            <h5 class="modal-title">Modal title</h5>
            
            </div> -->
         <div class="modal-body card-body" style="padding: 20px;background: #484848">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
             <form id="langForm" action="#" name="langForm" >
               @csrf
            <div class="log-social-area">
               <h2>Your language</h2>
               <p>You can see post in multiple langulages. please select one or more langulage</p>
                <div class="row">

                   @if(_myLang() != 'all') 
                  <div class="col-12 col-md-3 mb-2">
                     <label class="btn btn-block btn-warning  chkAllBox  noradius ">
                     <input type="checkbox" name="select_all"   id="select_all"  value="all" checked="" class="check chkhide"  autocomplete="off"> ALL
                     </label>
                  </div>
                  @else
                  <div class="col-12 col-md-3 mb-2">
                     <label class="btn btn-block btn-success  chkAllBox  noradius ">
                     <input type="checkbox" name="select_all"   id="select_all"  value="all" checked="" class="check chkhide"  autocomplete="off"> ALL
                     </label>
                  </div>
                  @endif

                  @foreach(_langList() as $key => $row)
                  
                  @if(_myLang() != 'all') 
                     @if(in_array($row->name,_myLang()))
                     <div class="col-6 col-md-3 mb-2">
                        <label id="land_{{ $row->id }}" class="btn btn-block  noradius langBox btn-outline-success">
                        <input type="checkbox" name="language[]" data-id="land_{{ $row->id }}"  class="langCheck  chkhide" value="{{ $row->name }}"  checked  autocomplete="off"> {{ $row->name }}
                        </label>
                     </div>
                     @else
                        <div class="col-6 col-md-3 mb-2">
                        <label id="land_{{ $row->id }}" class="btn btn-block btn-outline-warning  noradius langBox ">
                        <input type="checkbox" name="language[]" data-id="land_{{ $row->id }}"  class="langCheck  chkhide" value="{{ $row->name }}"    autocomplete="off"> {{ $row->name }}
                        </label>
                     </div>
                     @endif
                  @else
                   <div class="col-6 col-md-3 mb-2">
                     <label id="land_{{ $row->id }}" class="btn btn-block btn-outline-warning   noradius langBox ">
                     <input type="checkbox" name="language[]" data-id="land_{{ $row->id }}"  class="langCheck  chkhide" value="{{ $row->name }}"    autocomplete="off"> {{ $row->name }}
                     </label>
                  </div>
                  @endif
                  @endforeach   
               </div>
               <div class="text-right">
                  <button type="submit" class="btn btn-deep-orange">Continue</button>
               </div>
            </div>
         </form>

         </div>
      </div>
   </div>
</div>

