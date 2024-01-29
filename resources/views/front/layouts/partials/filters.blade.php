<div class="container-fluid" id="filter-bar">
    <div class="container filters">
    
    @if(isset($tags_space) && !$tags_space->isEmpty())
        <ul class="filter option-set exclusive" data-filter-group="status">
          <li><span>Przestrzeń</span></li>
          <li><a href="#" data-filter-value="" class="selected">wszystkie</a></li>
          @foreach($tags_space as $tag)
            &nbsp;&#9679;&nbsp; <li><a href="#" data-filter-value=".{{$tag->slug}}">{{$tag->name}}</a></li>
          @endforeach
        </ul>
    @endif
    
    @if(isset($tags_region) && !$tags_region->isEmpty())
        <ul class="filter option-set" data-filter-group="fandom">
          <li><span>Region geograficzny</span></li>
          <li><a href="#" data-filter-value="" class="selected">wszystkie</a></li>
          @foreach($tags_region as $tag)
           &nbsp;&#9679;&nbsp; <li><a href="#" data-filter-value=".{{$tag->slug}}">{{$tag->name}}</a></li>
          @endforeach
        </ul>
    @endif
       
    @if(isset($tags_tags) && !$tags_tags->isEmpty())
        <ul class="filter option-set combine" data-filter-group="content">
          <li><span>Tagi</span></li>
          <li><a href="#" data-filter-value="" class="selected">wszystkie</a></li>
          @foreach($tags_tags as $tag)
           &nbsp;&#9679;&nbsp; <li><a href="#" data-filter-value=".{{$tag->slug}}">{{$tag->name}}</a></li>
          @endforeach
        </ul>
    @endif
        <div class="d-flex" style="margin-right: -70px; column-gap: 10px;">
        @yield('top_buttons')
        <button class="btn btn-primary btn-sm filter-button text-bold">Filtrowanie zaawansowane <i class="fa fa-filter"></i></button>
        </div>
  </div>
</div>