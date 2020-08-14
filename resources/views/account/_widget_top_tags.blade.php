<div class="widget">
  <h4 class="widget-title">Top Tags</h4>
  <ul class="naves">
    @foreach(_topTags() as $key => $row)
    <li class="mb-10 btn-outline-primary btn-sm text-left" >
      <i class="ti-image"></i>
      <a href="{{ asset('tag/'.$row->name) }}" class="text-white" title="">#{{ $row->name }} <small>({{ $row->no_sum_post }})</small></a>
    </li>
    @endforeach
  </ul>
</div><!-- Shortcuts -->