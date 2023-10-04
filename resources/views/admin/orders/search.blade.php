@extends('admin.layouts.app')

@section('title', 'Search Order')

@section('option-title', 'Search Order')

@section('content')
<div class="search-form" style="
                  margin-top: 3em;
                  border-radius: 1.5em;
                  width: 100%;
                ">
  @include('admin.includes.success')
  <form action="{{route('orders.index')}}" method="GET">
    <div class="form-header" style="
                      text-transform: capitalize;
                      font-size: 1.4rem;
                      padding: 1em 1.5em; line-height: 1;
                      border-top-left-radius: 1.5em; border-top-right-radius: 1.5em
                    ">
      <i class="fa-solid fa-filter" style="margin-right: 0.5em"></i>
      search book
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

          @if ($formData['filter_by'] == 'id')
          <option value="id" selected>Order ID</option>
          <option value="customer_id">Customer ID</option>
          @elseif ($formData['filter_by'] == 'customer_id')
          <option value="id">Order ID</option>
          <option value="customer_id" selected>Customer ID</option>
          @else
          <option value="id" selected>Order ID</option>
          <option value="customer_id">Customer ID</option>
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
      <a href="{{route('orders.index')}}">
        <i class="fa-solid fa-trash" style="margin-right: 0.5em"></i>
        Clear</a>
    </div>
  </form>
</div>

@if (request('filter_by'))
@if (count($orders) > 0)
<table class="table" style="margin-top: 3em" width="100%" cellspacing='0'>
  <thead>
    <tr>
      <th style="width: 5%">Nº</th>
      <th style="width: 5%">ID</th>
      <th style="width: 12%">Customer Name</th>
      <th style="width: 12%">Created At</th>
      <th style="width: 10%">Total</th>
      <th style="width: 25%">Options</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($orders as $index => $order)
    <tr>
      <td>{{$index + 1}}</td>
      <td>{{$order->id}}</td>
      <td>{{App\Models\Customer::find($order->customer_id)->name}}</td>
      <td style="font-size: 1rem">{{$order->created_at}}</td>
      <td> $
        @php
            $all_order_details = App\Models\OrderDetail::where('order_id', 'like', $order->id)->get();
            $total = 0.00;
            foreach ($all_order_details as $order_detail) {
              $current_book = App\Models\Book::find($order_detail->book_id);
              $total += $current_book->unit_price * $order_detail->qty;
            }
            echo $total;
        @endphp
      </td>
      <td style="display: flex; justify-content: center; gap: .5em">
          <a href="{{route('orders.show', $order->id)}}" target="_blank" class="btn"><i class="fa-solid fa-file-invoice" style="margin-right: .5em"></i>Invoice</a>
          <a href="{{route('orders.edit', $order->id)}}" class="btn"><i class="fas fa-edit"
            style="margin-right: .5em"></i>Edit
          </a>
          <form id="delete-form" method="POST" action="{{route('orders.destroy', $order->id)}}">
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
  @if ($orders->hasPages())
  {{$orders->appends(Request::except('page'))->render('pagination::simple-bootstrap-4')}}
  @endif
</div>
@else
<table class="table" style="margin-top: 3em" width="100%" cellspacing='0'>
  <thead>
    <tr>
      <th style="width: 5%">Nº</th>
      <th style="width: 5%">ID</th>
      <th style="width: 12%">Customer Name</th>
      <th style="width: 12%">Created At</th>
      <th style="width: 10%">Total</th>
      <th style="width: 25%">Options</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td colspan="6" style="padding: 1.5em 0">No search result found...!</td>
    </tr>
  </tbody>
</table>
@endif
@endif

@endsection