<div class="form-group mb-3">
    <label class="form-label">Opis @if($attr->required) * @endif</label>
    <textarea class="form-control tinymce" name="desc" @if($attr->required) required @endif>{{ old('desc', $element->desc ?? '') }}</textarea>
</div>
