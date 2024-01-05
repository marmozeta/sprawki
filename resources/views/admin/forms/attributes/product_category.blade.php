<div class="form-group mb-3">
    <label class="form-label">Kategorie produktu @if($attr->required) * @endif</label>
    @foreach($categories as $cat)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="product_categories[{{$cat->cat_id}}]" id="product_categories{{$cat->cat_id}}" {{ (isset($element->product_categories) && in_array($cat->cat_id, $element->product_categories))?'checked':''}} />
            <label class="form-check-label" for="product_categories{{$cat->cat_id}}">{{ $cat->name }}</label>
        </div>
     @endforeach
</div>
