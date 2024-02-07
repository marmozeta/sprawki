<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" name="is_virtual" role="switch" id="is_virtual" {{ (old('is_virtual', $element->is_virtual ?? '')==1)?'checked':''}} >
        <label class="form-check-label" for="is_new">Produkt wirtualny</label>
    </div>
</div>
