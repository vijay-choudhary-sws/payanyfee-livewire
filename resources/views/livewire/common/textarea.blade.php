<div>
  
    <div class="row my-3">
        <div class="col-12">
            <label for="{{$in_data->inputType->tag_name}}{{$in_data->id}}" class="mb-2">{{$in_data->label}}</label><a href='#' wire:click.prevent="removeInput({{ $in_data->id }})">  remove</a>
            <textarea  name="{{$in_data->name }}" id="{{$in_data->inputType->tag_name}}{{$in_data->id}}" class="form-control" placeholder="{{$in_data->placeholder}}"    ></textarea>
        </div>
    </div>
</div>
