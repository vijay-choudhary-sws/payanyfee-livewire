<div>
    <div class="row  my-2 mb-2">
        <div class="col-12">
            <label for="{{ $in_data->label }}{{ $in_data->id }}"
                class="mb-2">{{ $in_data->label }}</label>
            <a href='#' wire:click.prevent="removeInput({{ $in_data->id }})">remove</a>
                <select name="{{ $in_data->name }}"
                    id="{{ $in_data->existingSelect->name }}{{ $in_data->id }}" class="form-control">
                    <option value="">-- select {{ $in_data->label }} --
                    </option>

                    @foreach ($existingdata as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                    @endforeach
                </select>

        </div>
    </div>
</div>
