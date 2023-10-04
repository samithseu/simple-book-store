@extends('admin.layouts.app')

@section('title', 'Edit Order')

@section('option-title', 'Edit Order')

@section('content')
<div class="order-form">
  <span style="margin-top: 1em">
    @include('admin.includes.success')
  </span>
  <form data-order-id="{{$order->id}}" method="POST" action="{{route('orders.update', $order->id)}}" class="order-info">
    @csrf
    @method("PUT")

    <div class="order-customer">
      <label for="customer_id">Select Customer : </label>
      @if ($errors->has('customer_id'))
      <span class="error-msg">{{$errors->first('customer_id')}}</span>
      @endif
      <select name="customer_id" id="customer_id">

        @foreach ($customers as $cus)
        @if ($cus->id == $order->customer_id)
        <option selected value="{{$cus->id}}">{{$cus->name}}</option>
        @else
        <option value="{{$cus->id}}">{{$cus->name}}</option>
        @endif
        @endforeach

      </select>
    </div>
    <div class="order-note">
      <label for="note">Order Note : </label>
      @if ($errors->has('note'))
      <span class="error-msg">{{$errors->first('note')}}</span>
      @endif
      <textarea name="note" placeholder="Order note..." id="note">{{$order->note}}</textarea>
    </div>
  </form>
  <h2 style="font-size: 1.4rem; padding-top: 1em">Book List : </h2>
  <div class="book-container">
      @php
          for ($i=0; $i < count($books) ; $i++) { 
            for($j=0; $j < count($order_details); $j++) {
              if($books[$i]->id == $order_details[$j]->book_id) {
                echo 
                '<div class="book">
                  <input checked type="checkbox" name="choose" class="choose" />
                  <p class="book-name" data-id="'.$books[$i]->id.'">'.$books[$i]->name.'</p>
                  <p class="book-price">'.$books[$i]->unit_price.'</p>
                  <input type="number" title="QTY" name="qty" class="qty" value="'.$order_details[$j]->qty.'" min="1" required />
                </div>';
              }
            }
            
          }
      @endphp
  </div>
  <div class="total">
    <p>Selected Item : <span class="selected-item">{{count($order_details)}}</span></p>
    <p>Total : $<span class="money">@php $total = 0.00;
          foreach ($order_details as $order_detail) {
            $total += App\Models\Book::find($order_detail->book_id)->unit_price * $order_detail->qty;
          }
          echo $total;@endphp</span>
    </p>
  </div>
  <div class="btn-list">
    <a href="" class="btn select-all">Select All</a>
    <a href="" class="btn select-none">Deselect All</a>
    <a href="" class="btn refresh">Refresh</a>
    <a href="" class="btn order-now" id="update-now">Update Now!</a>
  </div>
</div>
@endsection



@push('js')
<script>
  const books = document.querySelectorAll(".book");
  const refreshBtn = document.querySelector(".refresh");
  const selectAllBtn = document.querySelector(".select-all");
  const deselectAllBtn = document.querySelector(".select-none");
  const showTotal = document.querySelector(".money");
  const selectedItem = document.querySelector(".selected-item");
  
  let order_id = document.querySelector('.order-info').dataset.orderId;
  
  let arrStore = [];
  
  // FUNCTIONS

  
  function selectAllItems(e) {
    e.preventDefault();
    books.forEach((book) => {
      book.querySelector(".choose").checked = true;
    });
  }
  
  function deselectAllItems(e) {
    e.preventDefault();
    books.forEach((book) => {
      book.querySelector(".choose").checked = false;
    });
  }
  
  function showElements() {
    alert(arrStore);
  }
  
  function updateTotalMoney(arr) {
    let total = 0;
    arr.forEach((item) => {
      total += item.tempTotalPrice;
    });
    // return total;
    return Number(total.toFixed(2));
  }
  
  function countSelected(arr) {
    let items = arr.length;
    selectedItem.innerText = items;
  }
  
  function getTotalMoney() {
    showTotal.innerText = updateTotalMoney(arrStore);
  }
  
  function getAllSelected(e) {
    e.preventDefault();
    let tempID, tempName, tempQty, tempPrice, tempTotalPrice;
    arrStore = [];
    books.forEach((book) => {
      let checkBox = book.querySelector(".choose");
      if (checkBox.checked) {
      tempID = parseInt(book.querySelector(".book-name").dataset.id);
      tempName = book.querySelector(".book-name").innerText;
      tempQty = parseInt(book.querySelector(".qty").value);
      tempPrice = parseFloat(book.querySelector(".book-price").innerText);
      tempTotalPrice = parseFloat(tempQty) * parseFloat(tempPrice);
      arrStore.push({tempID, tempName, tempQty, tempPrice, tempTotalPrice });
      }
    });
    getTotalMoney();
    countSelected(arrStore);
  }
  
  // EVENT LISTENERS

  // select all items
  selectAllBtn.addEventListener("click", selectAllItems);
  // deselect all items
  deselectAllBtn.addEventListener("click", deselectAllItems);
  // checkout button
  refreshBtn.addEventListener("click", getAllSelected);
  
  books.forEach((book) => {
    let qtySelect = book.lastElementChild;
    book.addEventListener("click", (e) => {
      if (e.target == qtySelect) {
          e.preventDefault();
      } else {
        if (book.firstElementChild.checked == true) {
          book.firstElementChild.checked = false;
        } else {
          book.firstElementChild.checked = true;
        }
      }
    });
  });
</script>
<script>
  $(document).ready(function () {
    $('#update-now').on('click', function (e) {
      e.preventDefault();
      // data for creating order (Customer ID, NOTE)
      var data = {
        'customer_id': $('#customer_id').val(),
        'note': ($('#note').val()) ? $('#note').val() : 'No note!',
        'order_id' : order_id
      };
      
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      // first we create an ORDER to add more ORDER DETAIL
      if (arrStore.length > 0) {
        $.ajax({
          type: "PUT",
          url: "{{route('orders.update',".order_id.")}}",
          data: data,
          dataType: "json",
          success: function (response) {
            // create ORDER DETAIL based on number of books selected
            $.each(arrStore, function (index, item) {
              $.ajax({
                type: "POST",
                url: "{{route('order-details.store')}}",
                data: {"data":item, "order_id" : order_id},
                dataType: "json",
                success: function (response) {
  
                }
              });
            });
            window.location.assign("http://"+window.location.host+"/admin/home");
          }
        });
      }
    });
  });
</script>
@endpush