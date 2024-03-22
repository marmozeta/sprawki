<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" name="is_donation" role="switch" id="is_donation" {{ (old('is_donation', $element->is_donation ?? '')==1)?'checked':''}} >
        <label class="form-check-label" for="is_donation">Darowizna</label>
    </div>
</div>
