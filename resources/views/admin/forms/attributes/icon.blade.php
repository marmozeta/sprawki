<div class="form-group mb-3 col-6">
    <label class="form-label">Ikona (gdy brak obrazka) @if($attr->required) * @endif</label>
    <input type="text" class="form-control" name="icon" value="{{ old('icon', $element->icon ?? '') }}" placeholder="np. fa-solid fa-quote-right" @if($attr->required) required @endif/>
</div>
