<div class="form-group mb-3">
    <label class="form-label">Data @if($attr->required) * @endif</label>
    <input type="datetime-local" class="form-control" name="publish_date" value="{{ old('publish_date', $element->publish_date ?? '') }}" placeholder="" @if($attr->required) required @endif />
</div>
