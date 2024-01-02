<div>
    <div class="row my-1">
        <div class="col-12">
            <label for="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}"
                class="mb-2">{{ $in_data->label }}</label><a href='#'
                wire:click.prevent="removeInput({{ $in_data->id }})">remove</a>

            @if ($in_data->inputType->type == 'checkbox')
                @foreach ($in_data->metaOption as $key => $item)
                    {{-- <input type="checkbox" class="form-check-input" name="check{{ $key }}"> --}}

                    <input type="checkbox" class="form-check-input" name="{{ $in_data->name }}" id="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}{{$key}}" {{$item->is_default == '1' ? 'checked' : '' }}>

                    <label for="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}{{$key}}" class="form-check-label">{{ $item->label }}</label>
                @endforeach
            @elseif ($in_data->inputType->type == 'radio')
                @foreach ($in_data->metaOption as $key => $item)
                    {{-- <input type="radio" class="form-check-input"> --}}

                    <input type="radio" class="form-check-input" value="{{$in_data->option_value}}" name="{{ $in_data->label }}" id="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}{{$key}}" {{$item->is_default == '1' ? 'checked' : '' }}>

                    <label for="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}{{$key}}" class="form-check-label">{{ $item->label }}</label>
                @endforeach
            @else
                <input type="{{ $in_data->inputType->type }}" class="form-control" name="{{ $in_data->name }}"
                    id="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}"
                    placeholder="{{ $in_data->placeholder }}">
            @endif
        </div>
    </div>
</div>
