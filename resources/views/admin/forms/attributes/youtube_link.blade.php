<div class="form-group mb-3 col-6">
    <label class="form-label">Link do YouTube @if($attr->required) * @endif</label>
    <input type="text" class="form-control" name="youtube" value="{{ old('youtube', $element->youtube ?? '') }}" placeholder="" @if($attr->required) required @endif/>
</div>
