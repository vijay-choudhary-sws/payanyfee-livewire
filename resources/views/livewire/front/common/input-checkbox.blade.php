<div>
    <div class="row my-1">
        <div class="col-12 text-left">
            <label for="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}" class="mb-2">{{ $in_data->label}}</label>
                @foreach ($in_data->metaOption as $key => $item)
                    <input type="checkbox" class="form-check-input" wire:model="typecheckbox" value="{{ $item->option_value }}" name="{{ $in_data->input_name }}" id="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}{{$key}}" {{$item->is_default == '1' ? 'checked' : '' }}>
                    <label for="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}{{$key}}" class="form-check-label">{{ $item->label }}</label>
                @endforeach
        </div>
    </div>
</div>