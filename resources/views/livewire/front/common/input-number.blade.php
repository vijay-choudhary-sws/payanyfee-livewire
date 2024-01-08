<div>
    <div class="row">
        <div class="col-12 mb-2">
            <label for="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}" class="mb-2 float-left">{{
                $in_data->label}}</label>
            <input wire:model="typenumber" type="number" class="form-control"
                id="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}" placeholder="{{ $in_data->placeholder }}">
        </div>
    </div>
</div>