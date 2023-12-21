<div class="form-group mb-3">
    <label class="form-label">Obrazek @if($attr->required) * @endif</label>
    <div class="input-group flex-nowrap">
        <div class="custom-file w-100">
            <input class="form-control" type="file" id="image" name="image" @if($attr->required) required @endif />
        </div>
    </div>
</div>
