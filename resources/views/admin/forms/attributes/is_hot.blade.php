<div class="form-group mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" name="required[{{$attr->attr_id}}]" role="switch" id="flexSwitchCheckDefault" @if($attr->required) required @endif>
        <label class="form-check-label" for="flexSwitchCheckDefault">Gorące @if($attr->required) * @endif</label>
    </div>
</div>
