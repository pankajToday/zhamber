 <section class="fgap bg-444 tags d-none d-sm-block" style="border:solid 1px #535353;">
  <div class="container">
     <div class="row">
      <div class="col-lg-1" style="border-radius: 0px;">
        <div class="btag text-center no-cursor w-100" >
             <span class="text-right"> Tags:</span>
      </div>
                      
      </div>

        <div class="col-lg-11 col-sm-10 col-xs-1  h-scrollable">
           <div class="tagbox">
          @foreach(_topTags() as $key => $row)
           <a class="mr-15" href="{{ asset('tag/'.$row->name) }}">#{{ $row->name }}<small>
            <!--  ({{ $row->no_sum_post }}) --></small> </a>
          @endforeach
         </div>
        </div>
     </div>
  </div>
</section>

