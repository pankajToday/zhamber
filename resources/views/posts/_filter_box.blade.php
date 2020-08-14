<div class="row" id="stickyTop">
   
    <div class="col-6 col-lg-3"> 
      <a href="{{ asset('?type=recent') }}"  class="btn btn-info btn-block {{ (inArrChkKeyVal('type','recent',$param))?'active':'' }} type" value="recent">
         Recent
      </a>
    </div>

     <div class="col-6 col-lg-3"> 
      <a href="{{ asset('?type=popular') }}"  class="btn btn-info btn-block {{ (inArrChkKeyVal('type','popular',$param))?'active':'' }} type" value="popular">
         Popular
      </a>
    </div>

    <div class="col-6 col-lg-3">  

     <a href="{{ asset('?type=most-viewed') }}" class="btn btn-info btn-block {{ (inArrChkKeyVal('type','most-viewed',$param))?'active':'' }} type" value="most-viewed">
         Most Viewed
      </a>
    </div>
    <div class="col-6 col-lg-3"> 

       @if(isset($param['tfind']))
       <button type="button" class="btn btn-info w-100 dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="hlike" >
       @else
        <button type="button" class="btn btn-info w-100 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="hlike" > 
       @endif

      
       Highest Scoring

       @if(isset($param['tfind']))
       - {{ ucwords($param['tfind']) }}
       @endif
       


      </button>
     <div class="dropdown-menu hlike-menu dropdown-menu-right" style="width: 90%">
         <!--  <a href="{{ asset('?type=highest-scoring&tfind=today') }}" class="dropdown-item" >Today</a> -->
            <a href="{{ asset('?type=highest-scoring&tfind=week') }}" class="dropdown-item" >This Week</a>
            <a href="{{ asset('?type=highest-scoring&tfind=month') }}" class="dropdown-item" >This Month</a>
            <a href="{{ asset('?type=highest-scoring&tfind=ever') }}" class="dropdown-item" >Ever</a>
     </div>
   </div>
  </div>


  <style type="text/css">
    @media all and (max-width:480px) {
       .type { width: 100%; display:block; font-size: 12px;  margin-bottom: 10px;}
       #hlike { width: 100%; display:block; font-size: 12px;  margin-bottom: 10px;}
    }  

    .type{
      margin-bottom: 5px;
    } 

  </style>
