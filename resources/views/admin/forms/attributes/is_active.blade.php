<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" name="is_active" role="switch" id="is_active" {{ (old('is_active', $element->is_active ?? '')==1)?'checked':''}} >
        <label class="form-check-label" for="is_active">Aktywny</label>
    </div>
</div>
