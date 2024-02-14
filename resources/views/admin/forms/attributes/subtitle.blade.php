<div class="form-group mb-3">
    <label class="form-label">Podtytuł @if($attr->required) * @endif</label>
    <input type="text" class="form-control" name="subtitle" value="{{ old('subtitle', $element->subtitle ?? '') }}" placeholder="" @if($attr->required) required @endif />
</div>
