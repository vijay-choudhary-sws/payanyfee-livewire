<div>
    <div class="row my-1">
        <div class="col-12">
            <label for="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}" class="mb-2 float-left">{{ $in_data->label}}</label>
            <input wire:model="typenumber" type="number" class="form-control" id="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}"
                    placeholder="{{ $in_data->placeholder }}">
        </div>
    </div>
</div>