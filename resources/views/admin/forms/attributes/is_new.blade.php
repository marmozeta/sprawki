<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" name="is_new" role="switch" id="is_new" {{ (old('is_new', $element->is_new ?? '')==1)?'checked':''}} >
        <label class="form-check-label" for="is_new">Nowość</label>
    </div>
</div>
