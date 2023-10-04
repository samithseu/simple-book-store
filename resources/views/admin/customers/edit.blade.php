@extends('admin.layouts.app')

@section('title', 'Edit Customer')

@section('option-title', 'Edit Customer')

@section('content')
<div class="form" style="margin-top: 3em">
  @include('admin.includes.success')
  <form method="POST" action="{{route('customers.update', $customer->id)}}">
    @csrf
    @method('PUT')
    <div class="form-header">
      <h2>update customer</h2>
    </div>
    <div class="form-body">
      <div class="input-group">
        <label for="name">name</label>
        @if ($errors->has('name'))
        <span class="error-msg">{{$errors->first('name')}}</span>
        @endif
        <input type="text" name="name" id="name" placeholder="Enter name..." value="{{$customer->name}}" />
      </div>
      <div class="input-group">
        <label for="address">address</label>
        @if ($errors->has('address'))
        <span class="error-msg">{{$errors->first('address')}}</span>
        @endif
        <input type="text" name="address" id="address" placeholder="Enter address..." value="{{$customer->address}}" />
      </div>
      <div class="input-group">
        <label for="phone">phone</label>
        @if ($errors->has('phone'))
        <span class="error-msg">{{$errors->first('phone')}}</span>
        @endif
        <input type="text" name="phone" id="phone" placeholder="Enter phone..." value="{{$customer->phone}}" />
      </div>
    </div>
    <div class="form-footer">
      <button type="submit">Update</button>
    </div>
  </form>
</div>
@endsection