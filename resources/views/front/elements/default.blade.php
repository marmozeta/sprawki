<div class="container">
    <div class="row mt-5">
        <div class="@if(!empty($element->image) || !empty($element->youtube)) col-4 @else col-12 @endif">
            <h1 class="element_title mt-4 pt-5">{{ $element->title }}</h1>
            <div class="divide"><i class="fa-solid fa-video"></i></div>
            <h4 class="teaser text-justify">{{ $element->teaser }}</h4>
        </div>
        @if(!empty($element->image))
        <div class="col-8 image my-4">
            <img class="img-fluid rounded mx-5" src="{{ asset('images/elements/'.$element->image) }}" />
        </div>
        @elseif(!empty($element->youtube))
        <div class="col-8 image my-4">
            <iframe class="mx-5 rounded" id="ytplayer" type="text/html" width="100%" height="480" src="{{ $element->youtube }}" frameborder="0"></iframe>
        </div>
        @endif
        
    </div>
    <div class="row">
        <div class="col-12">
            {!! $element->description !!}
        </div>
    </div>
</div>