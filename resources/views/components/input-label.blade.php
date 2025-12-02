@props([
    'name' => 'name',
    'type' => 'text',
    'title' => 'Nombre',
])
<label for="{{ $name }}">{{$title}}</label>
<div class="input-group ">
    <input type="{{$type}}" wire:model="{{$name}}" id={{ $name }} class="form-control @error($name) is-invalid  @enderror" placeholder="{{ $title }}" aria-label="{{$title}}" aria-describedby="name-addon">
</div>
@error($name)
    <span class="text-danger" > {{$message}}</span>
@enderror
