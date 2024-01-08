<div>
    <div class="row">
        <div class="col-12 mb-2">
            <label for="{{$in_data->inputType->tag_name}}{{$in_data->id}}"
                class="mb-2 float-left">{{$in_data->label}}</label>

            <textarea wire:model="typetextarea" name="{{$in_data->name }}"
                id="{{$in_data->inputType->tag_name}}{{$in_data->id}}" class="form-control"
                placeholder="{{$in_data->placeholder}}"></textarea>
        </div>
    </div>
</div>