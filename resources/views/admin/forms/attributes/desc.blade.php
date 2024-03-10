<div class="form-group mb-3">
    <label class="form-label">Opis @if($attr->required) * @endif</label>
    <textarea id="tinymce" class="tinymce">{{ old('description', $element->description ?? '') }}</textarea>
    <input type="hidden" id="desc" name="desc" value="{{ old('description', $element->description ?? '') }}" />
</div>
