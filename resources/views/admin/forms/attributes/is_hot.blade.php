<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" name="is_hot" role="switch" id="is_hot" {{ (old('is_hot', $element->is_hot ?? '')==1)?'checked':''}} >
        <label class="form-check-label" for="is_hot">Gorące</label>
    </div>
</div>
