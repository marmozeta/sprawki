<div class="form-group mb-3">
    <label class="form-label">Data @if($attr->required) * @endif</label>
    <input type="date" class="form-control" name="date" value="{{ old('date', $element->date ?? '') }}" placeholder="" @if($attr->required) required @endif />
</div>
