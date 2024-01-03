<div>
    <div class="row my-1">
        <div class="col-12">
            <label for="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}" class="mb-2">{{ $in_data->label}}</label>
            <a href='#' wire:click.prevent="removeInput({{ $in_data->id }})" class="text-info">remove</a>
           
            @foreach ($in_data->metaOption as $key => $item)

                    <input type="radio"  class="form-check-input" value="{{$in_data->option_value}}" name="{{ $in_data->label }}" id="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}{{$key}}" {{$item->is_default == '1' ? 'checked' : '' }}>

                    <label for="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}{{$key}}" class="form-check-label">{{ $item->label }}</label>
            @endforeach
        </div>
    </div>
</div>