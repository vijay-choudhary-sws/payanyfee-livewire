<div>
    <div class="row">
        <div class="col-12 mb-2">
            <label for="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}"
                class="mb-2 float-left">{{ $in_data->label }}</label>

            <select wire:model="typeselect" id="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}"
                class="form-control">
                <option value="">--select {{ $in_data->label }}--</option>

                @foreach ($existingdata as $item)
                    <option value="{{ $item->title }}">{{ $item->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
