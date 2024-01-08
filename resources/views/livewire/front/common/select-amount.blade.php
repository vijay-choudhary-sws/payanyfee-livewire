<div>
    
    <div class="py-2">
        <label for="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}" class="mb-2 float-left">{{ $in_data->label }}</label>
    
        <select wire:model="typeselect" id="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}" class="form-control" wire:change="amountchange">
           <option value="">--select {{ $in_data->label }}--</option>
           @foreach ($in_data->metaOption as $item)
               <option value="{{$item->option_value}}" >{{$item->label}}</option>
           @endforeach
        </select>
     </div>
</div>
