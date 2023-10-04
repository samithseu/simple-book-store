@extends('admin.layouts.app')

@section('title', 'Create Order')

@section('option-title', 'Create Order')

@section('content')
<div class="order-form">
  <span style="margin-top: 1em">
    @include('admin.includes.success')
  </span>
  <form method="POST" action="{{route('orders.store')}}" class="order-info" id="order-info">
    @csrf
    <div class="order-customer">
      <label for="customer_id">Select Customer : </label>
      @if ($errors->has('customer_id'))
      <span class="error-msg">{{$errors->first('customer_id')}}</span>
      @endif
      <select name="customer_id" id="customer_id">
        <option selected hidden disabled>Choose Customer...</option>
        @foreach ($customers as $cus)
        <option value="{{$cus->id}}">{{$cus->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="order-note">
      <label for="note">Order Note : </label>
      @if ($errors->has('note'))
      <span class="error-msg">{{$errors->first('note')}}</span>
      @endif
      <textarea name="note" placeholder="Order note..." id="note"></textarea>
    </div>
  </form>
  <h2 style="font-size: 1.4rem; padding-top: 1em">Book List : </h2>
  <div class="book-container">
    @foreach ($books as $book)
    <!-- each book -->
    <div class="book">
      <input type="checkbox" name="choose" class="choose" />
      <p class="book-name" data-id="{{$book->id}}">{{$book->name}}</p>
      <p class="book-price">{{$book->unit_price}}</p>
      <input type="number" title="QTY" name="qty" class="qty" value="1" min="1" required />
    </div>
    @endforeach
  </div>
  <div class="total">
    <p>Selected Item : <span class="selected-item">0</span></p>
    <p>Total : $<span class="money">00.00</span></p>
  </div>
  <div class="btn-list">
    <a href="" class="btn select-all">Select All</a>
    <a href="" class="btn select-none">Deselect All</a>
    <a href="" class="btn refresh">Refresh</a>
    <a href="" class="btn order-now" id="order-now">Order Now!</a>
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
    $('#order-now').on('click', function (e) {
      e.preventDefault();
      // data for creating order (Customer ID, NOTE)
      var data = {
        'customer_id': $('#customer_id').val(),
        'note': ($('#note').val()) ? $('#note').val() : 'No note!',
      };
      
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      // first we create an ORDER to add more ORDER DETAIL
      if (arrStore.length > 0) {
        $.ajax({
          type: "POST",
          url: "{{route('orders.store')}}",
          data: data,
          dataType: "json",
          success: function (response) {
            // create ORDER DETAIL based on number of books selected
            var orderID = response.order_id;
            $.each(arrStore, function (index, item) {
              $.ajax({
                type: "POST",
                url: "{{route('order-details.store')}}",
                data: {"data":item, "order_id" : response.order_id},
                dataType: "json",
                success: function (response) {
                
                }
              });
            });
            window.location.assign("http://"+window.location.host+"/admin/orders/"+orderID+"/edit");
          }
        });
      }

    });
  });
</script>
@endpush