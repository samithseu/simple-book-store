@extends('admin.layouts.app')

@section('title', 'Search Customer')

@section('option-title', 'Search Customer')

@section('content')
<div class="search-form" style="
                  margin-top: 3em;
                  border-radius: 1.5em;
                  width: 100%;
                ">
  @include('admin.includes.success')
  <form action="{{route('customers.index')}}" method="GET">
    <div class="form-header" style="
                      text-transform: capitalize;
                      font-size: 1.4rem;
                      padding: 1em 1.5em; line-height: 1;
                      border-top-left-radius: 1.5em; border-top-right-radius: 1.5em
                    ">
      <i class="fa-solid fa-filter" style="margin-right: 0.5em"></i>
      search customer
    </div>
    <div class="form-body" style="
                      display: grid;
                      grid-template-columns: 1fr 3fr;
                      column-gap: 1.5em;
                      padding-bottom: 0;
                    ">
      <div class="input-group">
        <label for="filter_by">Filter By</label>
        <select name="filter_by" id="filter_by">

          @if ($formData['filter_by'] == 'name')
          <option value="name" selected>Name</option>
          <option value="address">Address</option>
          <option value="phone">Phone</option>
          @elseif ($formData['filter_by'] == 'address')
          <option value="name">Name</option>
          <option value="address" selected>Address</option>
          <option value="phone">Phone</option>
          @elseif ($formData['filter_by'] == 'phone')
          <option value="name">Name</option>
          <option value="address">Address</option>
          <option value="phone" selected>Phone</option>
          @else
          <option selected value="name">Name</option>
          <option value="address">Address</option>
          <option value="phone">Phone</option>
          @endif
        </select>
      </div>
      <div class="input-group">
        <label for="search_value">Value</label>
        <input type="text" name="search_value" id="search_value" placeholder="Type to search..."
          value="{{$formData['search_value']}}" />
      </div>
    </div>
    <div class="form-footer"
      style="padding-top: 0; display: flex; justify-content: center; border-bottom-left-radius: 1.5em; border-bottom-right-radius: 1.5em">
      <button type="submit" style="text-transform: capitalize; margin-right: 1em">
        <i class="fa-solid fa-magnifying-glass" style="margin-right: 0.5em"></i>
        search
      </button>
      <a href="{{route('customers.index')}}">
        <i class="fa-solid fa-trash" style="margin-right: 0.5em"></i>
        Clear</a>
    </div>
  </form>
</div>

@if (request('filter_by'))
@if (count($customers) > 0)
<table class="table" style="margin-top: 3em" width="100%" cellspacing='0'>
  <thead>
    <tr>
      <th style="width: 10%">Nº</th>
      <th style="width: 10%">ID</th>
      <th style="width: 20%">Name</th>
      <th style="width: 15%">Phone</th>
      <th style="width: 35%">Options</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($customers as $index => $customer)
    <tr>
      <td>{{$index + 1}}</td>
      <td>{{$customer->id}}</td>
      <td>{{$customer->name}}</td>
      <td>{{$customer->phone}}</td>
      <td style="display: flex; justify-content: center; gap: .5em">
        <a href="{{route('customers.edit', $customer->id)}}" class="btn"><i class="fas fa-edit"
            style="margin-right: .5em"></i>Edit</a>
        <form id="delete-form" method="POST" action="{{route('customers.destroy', $customer->id)}}">
          @csrf
          @method('DELETE')
          <button class="btn" type="submit">
            <i class="fas fa-trash" style="margin-right: .5em"></i>
            Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="page">
  @if ($customers->hasPages())
  {{$customers->appends(Request::except('page'))->render('pagination::simple-bootstrap-4')}}
  @endif
</div>
@else
<table class="table" style="margin-top: 3em" width="100%" cellspacing='0'>
  <thead>
    <tr>
      <th style="width: 10%">Nº</th>
      <th style="width: 10%">ID</th>
      <th style="width: 20%">Name</th>
      <th style="width: 15%">Phone</th>
      <th style="width: 35%">Options</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="5" style="padding: 1.5em 0">No search result found...!</td>
    </tr>
  </tbody>
</table>
@endif
@endif

@endsection