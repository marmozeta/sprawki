<div class="container-fluid" id="filter-bar">
    <div class="container">
        <div class="row">
    <div class="col-7 filters">
    @if(isset($tags_space) && !$tags_space->isEmpty())
        <ul class="filter option-set" data-filter-group="status">
          <li><span>Przestrzeń</span></li>
          @foreach($tags_space as $i=>$tag)
            @if($i>0) &nbsp;&#9679;&nbsp; @endif<li><a href="#" data-filter-value=".{{$tag->slug}}">{{$tag->name}}</a></li>
          @endforeach
        </ul>
    @endif
    
    @if(isset($tags_region) && !$tags_region->isEmpty())
        <ul class="filter option-set" data-filter-group="fandom">
          <li><span>Region geograficzny</span></li>
          @foreach($tags_region as $i=>$tag)
            @if($i>0) &nbsp;&#9679;&nbsp; @endif<li><a href="#" data-filter-value=".{{$tag->slug}}">{{$tag->name}}</a></li>
          @endforeach
        </ul>
    @endif
    
    @if(isset($menu) && $menu->is_social)
        <ul class="filter option-set exclusive" data-filter-group="social">
          <li class="mx-0"><a href="#" data-filter-value=".twoje">twoje</a></li>
        &nbsp;&#9679;&nbsp; <li><a href="#" data-filter-value=".obserwowanych">obserwowanych</a></li>
          &nbsp;&#9679;&nbsp; <li><a href="#" data-filter-value=".innych">innych</a></li>
        </ul>
    @endif
    </div>
        <div class="col-5 py-2 text-right">
        @yield('top_buttons')
        <button class="btn btn-primary btn-sm filter-button text-bold" id="filter-button" data-bs-toggle="modal" data-bs-target="#filterModal" >Filtrowanie zaawansowane <i class="fa fa-filter"></i></button>
        </div>
        </div>
  </div>
</div>
@include('front.layouts.partials.advanced')  