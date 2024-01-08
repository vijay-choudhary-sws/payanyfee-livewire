<div>
    <div class="row  my-2 mb-2">
        <div class="col-12">
            <label for="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}" class="mb-2">{{ $in_data->label }}</label>
                <a href='#' wire:click.prevent="removeInput({{ $in_data->id }})">remove</a>
                
            <select name="{{ $in_data->name }}" id="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}"
                class="form-control">
                <option value="" selected disabled>--select {{ $in_data->label }}--</option>
                @foreach ($in_data->metaOption as $item)
                    <option value="{{ $item->option_value }}" {{ $item->is_default == '1' ? 'selected' : '' }}>
                        {{ $item->label }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
