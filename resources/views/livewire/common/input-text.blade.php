<div>
    <div class="row my-1">
        <div class="col-12">
            <label for="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}" class="mb-2">{{ $in_data->label}}</label>
            <a href='#' wire:click.prevent="removeInput({{ $in_data->id }})" class="text-info">remove</a>
            <input type="text" class="form-control" name="{{ $in_data->input_name }}"
                id="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}" placeholder="{{ $in_data->placeholder }}">
        </div>
    </div>
</div>