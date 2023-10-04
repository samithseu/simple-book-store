@extends('admin.layouts.app')

@section('title', 'Create Customer')

@section('option-title', 'Create Customer')

@section('content')
<div class="form" style="margin-top: 3em">
  @include('admin.includes.success')
  <form method="POST" action="{{route('customers.store')}}">
    @csrf
    <div class="form-header">
      <h2>create customer</h2>
    </div>
    <div class="form-body">
      <div class="input-group">
        <label for="name">name</label>
        @if ($errors->has('name'))
        <span class="error-msg">{{$errors->first('name')}}</span>
        @endif
        <input type="text" autofocus name="name" id="name" placeholder="Enter name..." value="{{old('name')}}" />
      </div>
      <div class="input-group">
        <label for="address">address</label>
        @if ($errors->has('address'))
        <span class="error-msg">{{$errors->first('address')}}</span>
        @endif
        <input type="text" name="address" id="address" placeholder="Enter address..." value="{{old('address')}}" />
      </div>
      <div class="input-group">
        <label for="phone">phone</label>
        @if ($errors->has('phone'))
        <span class="error-msg">{{$errors->first('phone')}}</span>
        @endif
        <input type="text" name="phone" id="phone" placeholder="Enter phone..." value="{{old('phone')}}" />
      </div>
    </div>
    <div class="form-footer">
      <button type="submit">Create</button>
    </div>
  </form>
</div>
@endsection