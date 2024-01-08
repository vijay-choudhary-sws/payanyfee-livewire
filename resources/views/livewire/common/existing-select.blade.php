<div>
    <div class="row  my-2 mb-2">
        <div class="col-12">
            <label for="{{ $in_data->existingSelect->table_name }}{{ $in_data->id }}" class="mb-2">{{ $in_data->existingSelect->table_name }}</label>
            <a href='#' wire:click.prevent="removeInput({{ $in_data->id }})">remove</a>
            
            <select name="{{ $in_data->name }}" id="{{ $in_data->existingSelect->table_name }}{{ $in_data->id }}"
                class="form-control">
                <option value="" selected disabled>-- select {{ $in_data->existingSelect->table_name }} --</option>

                @foreach ($existingdata as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
</div>
