<div>
    <div class="row">
        <div class="col-12 mb-2">
            <label for="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}" class="mb-2 float-left">{{
                $in_data->label }}</label>

            <select wire:model="typeselect" id="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}"
                class="form-control" @if($in_data->amountchange == 1) wire:change="amountchange"
                @elseif($in_data->is_multiple_required == 1)   wire:change="multipledataselect" @endif>
                <option value="">--select {{ $in_data->label }}--</option>

                @foreach ($existingdata as $item)
                <option value="{{ $item->id }}">{{ $item->title }}</option>
                @endforeach
            </select>
            {{-- <pre>
                {{ print_r($in_data->toArray()) }}
          {{die}} --}}
        </pre>
        </div>
    </div>
</div>