<div>
    <div class="row">
        <div class="col-12 mb-2 text-left">

            <label for="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}" class="mb-2">{{ $in_data->label}}</label>
            @foreach ($in_data->metaOption as $key => $item)
            <input type="radio" wire:model="typeradio" name="{{ $in_data->label }}" class="form-check-input"
                value="{{$item->option_value}}" id="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}{{$key}}"
                {{$item->is_default == '1' ? 'checked' : '' }}>
            <label for="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}{{$key}}" class="form-check-label">{{
                $item->label }}</label>
            @endforeach
            </ul>
        </div>
    </div>
</div>