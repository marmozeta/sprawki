<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content modal-filled bg-dark">
      <div class="modal-header">
        <h5 class="modal-title text-white" id="filterModalLabel">Filtry wyszukiwania</h5>
        <button type="button" class="btn-dark bg-transparent border-0 text-white" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-remove"></i></button>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col-3 px-5"><legend class="text-white">Przestrzeń</legend>
              @if(isset($tags_space) && !$tags_space->isEmpty())
                <ul class="filter option-set exclusive" data-filter-group="status">
                  @foreach($tags_space as $tag)
                    <li><a href="#" data-filter-value=".{{$tag->slug}}">{{$tag->name}}</a></li>
                  @endforeach
                </ul>
                @endif
              </div>
              <div class="col-3 px-5"><legend class="text-white">Region</legend>
              @if(isset($tags_region) && !$tags_region->isEmpty())
                <ul class="filter option-set" data-filter-group="fandom">
                  @foreach($tags_region as $tag)
                   <li><a href="#" data-filter-value=".{{$tag->slug}}">{{$tag->name}}</a></li>
                  @endforeach
                </ul>
            @endif
              </div>
              <div class="col-3 px-5"><legend class="text-white">Dotyczy</legend>
                @if(isset($tags_tags) && !$tags_tags->isEmpty())
                    <ul class="filter option-set combine" data-filter-group="content">
                      @foreach($tags_tags as $tag)
                       <li><a href="#" data-filter-value=".{{$tag->slug}}">{{$tag->name}}</a></li>
                      @endforeach
                    </ul>
                @endif
              </div>
              <div class="col-3 px-5"><legend class="text-white">Sortuj według</legend>
                  <ul class="filter">
                      <li>Data</li>
                      <li>Poczytność</li>
                  </ul></div>
          </div>
      </div>
    </div>
  </div>
</div>