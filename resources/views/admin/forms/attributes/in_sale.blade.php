<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" name="in_sale" role="switch" id="in_sale" {{ (old('in_sale', $element->in_sale ?? '')==1)?'checked':''}} >
        <label class="form-check-label" for="in_sale">Wyprzedaż</label>
    </div>
</div>
