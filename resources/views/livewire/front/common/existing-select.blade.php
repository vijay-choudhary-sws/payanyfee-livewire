<div>
    <label for="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}" class="mb-2 float-left">{{ $in_data->label }}</label>
   
    <select wire:model="typeselect" id="{{ $in_data->inputType->tag_name }}{{ $in_data->id }}" class="form-control">
       <option value="">--select {{ $in_data->label }}--</option>
       @foreach ($existingdata as $item)
           <option value="{{$item->name}}" >{{$item->name}}</option>
       @endforeach
    </select>
</div>
