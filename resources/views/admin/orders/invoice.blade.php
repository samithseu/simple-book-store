
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{url('admin/img/cj.png')}}" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>CJ Book Store | Order# {{$order->id}} invoice</title>
    <style>
      :root {
        --green: rgb(75, 184, 117);
        --green-low: rgb(183, 254, 210);
      }
      *,
      ::after,
      ::before {
        box-sizing: border-box;
      }
      * {
        margin: 0;
        padding: 0;
        font: inherit;
      }
      h1,
      h2,
      h3,
      h4,
      h5,
      h6 {
        margin-inline: 0;
        margin-block: 0;
      }
      html {
        font-size: 87.5%;
        font-family: "Poppins", sans-serif;
      }
      body {
        min-height: 100vh;
        overflow-x: hidden;
      }
      img,
      picture,
      svg,
      video {
        display: block;
        max-width: 100%;
      }
      .print-btn {
        position: sticky;
        top: 20px;
        left: 20px;
        color: var(--green);
        text-decoration: none;
        font-size: 1.4rem;
        border: 2px solid var(--green);
        padding: .5em 1.5em;
        border-radius: .5em;
        font-weight: 600;
        transition: .25s ease-out;
        &:hover {
          background-color: var(--green);
          color: white;
        }
        @media print {
          display: none;
        }
      }
      .wrapper {
        width: 100vw;
        min-height: 100dvh;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        margin-top: 5em;
        @media print {
          margin-top: 0;
          padding: 1em;
        }
      }
      header,
      main {
        max-width: 800px;
        width: 100%;
        margin-inline: auto;
      }
      header {
        display: grid;
        grid-template-columns: 1fr 1fr;
        align-items: flex-start;
      }
      .logo {
        width: 100%;
        height: max-content;
        display: flex;
        justify-content: flex-start;
        gap: 1em;
        align-items: flex-end;
      }
      .logo-img {
        aspect-ratio: 1/1;
        width: 70px;
        pointer-events: none
      }
      .logo-info h1 {
        font-size: 1.4rem;
        font-weight: bold;
        color: var(--green);
      }
      .order {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: flex-end;
      }
      .order-id {
        font-weight: bold;
        color: var(--green);
      }
      .order-date {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        align-items: flex-end;
      }

      hr {
        width: 100%;
        height: 5px;
        outline: none;
        border: none;
        margin-block: 2em;
        background-color: var(--green);
      }

      main {
        width: 100%;
        height: max-content;
      }

      .brand {
        width: 100%;
        height: max-content;
        margin-bottom: 2em;
      }
      .brand h1 {
        font-size: 2.2rem;
        font-weight: bold;
        color: var(--green);
      }
      .brand p {
        margin-top: 0.5em;
        font-size: 1.2rem;
        color: var(--green);
        font-style: italic;
      }

      .order-detail {
        width: 100%;
        height: max-content;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2em;
        margin-bottom: 2em;
        border-bottom: 2px solid var(--green-low);
        padding-bottom: 1em;
      }
      .order-dest,
      .order-note {
        border-top: 2px solid var(--green-low);
        padding-top: 1em;
      }
      .order-detail h2 {
        font-size: 1.2rem;
        font-weight: bold;
      }

      .order-list {
        width: 100%;
        height: max-content;
      }
      .order-list table {
        width: 100%;
      }
      .order-list table thead tr td {
        font-size: 1.3rem;
        font-weight: bold;
        text-transform: uppercase;
        border-bottom: 2px solid var(--green-low);
        padding-block: 1em;
      }

      .order-list table thead tr td:last-child {
        text-align: right;
      }
      .order-list table tbody tr td {
        padding-block: 0.5em;
        font-size: 1.2rem;
      }
      .order-list table tbody tr td:last-child {
        text-align: right;
      }
      .order-list table tbody tr:not(:last-child) td {
        border-bottom: 2px solid var(--green-low);
      }

      .order-list table thead tr td:nth-of-type(2) {
        text-align: left;
      }

      .order-list table thead tr td:nth-of-type(3) {
        text-align: left;
        padding-left: 2.5em
      }
      .order-list table tbody tr td:nth-of-type(3) {
        text-align: left;
        padding-left: 2.5em
      }

      .total-due {
        border-top: 2px solid var(--green-low);
        border-bottom: 2px solid var(--green-low);
        padding-block: 0.5em;
        width: 100%;
        display: flex;
        justify-content: space-between;
      }
      .total-due p:not(.actual-total) {
        font-size: 1.25rem;
        font-weight: bold;
      }
      .total-due p:is(.actual-total) {
        font-weight: bold;
        color: var(--green);
        font-size: 1.25rem;
      }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <a href="#" class="print-btn">
        <i class="fa-solid fa-print" style="margin-right: .6em"></i>Print</a>
      <header>
        <!-- logo  -->
        <div class="logo">
          <div class="logo-img">
            <img draggable="false" src="{{url('admin/img/cj.png')}}" alt="" />
          </div>
          <div class="logo-info">
            <h1>CJ Book Store</h1>
            <h2>Angk Serie, Rokathom, Chbarmon</h2>
            <h3>Kompong Speu</h3>
          </div>
        </div>
        <!-- end logo -->

        <!-- order -->
        <div class="order">
          <div class="order-id">Order# <span class="actual-id">{{$order->id}}</span></div>
          <div class="order-date">
            Issue date
            <span class="actual-date">{{$order->created_at}}</span>
          </div>
        </div>
        <!-- end order -->
      </header>
      <hr />
      <main>
        <!-- brand name -->
        <div class="brand">
          <h1>CJ Book Store</h1>
          <p>Thanks for purchasing our books. Have a great day! :)</p>
        </div>
        <!-- end brand -->
        <!-- order detail -->
        <div class="order-detail">
          <div class="order-dest">
            <h2>BILL TO</h2>
            <p class="cus-name">Name : {{App\Models\Customer::find($order->customer_id)->name}}</p>
            <p class="cus-contact">Tel : {{App\Models\Customer::find($order->customer_id)->phone}}</p>
          </div>
          <div class="order-note">
            <h2>ORDER NOTE</h2>
            <p class="actual-note">{{$order->note}}</p>
          </div>
        </div>
        <!-- end order detail -->

        <!-- order list -->
        <div class="order-list">
          <table cellspacing="0">
            <thead>
              <tr>
                <td style="width: 60%">Item</td>
                <td style="width: 10%">QTY</td>
                <td style="width: 10%">Price</td>
                <td style="width: 20%">Amount</td>
              </tr>
            </thead>
            <tbody>
              @foreach ($order_details as $index => $order_detail)    
                <tr>
                  <td>{{$index + 1}}. {{App\Models\Book::find($order_detail->book_id)->name}}</td>
                  <td>{{$order_detail->qty}}</td>
                  <td>${{App\Models\Book::find($order_detail->book_id)->unit_price}}</td>
                  <td>${{($order_detail->qty) * (App\Models\Book::find($order_detail->book_id)->unit_price)}}</td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td colspan="4">
                  <div class="total-due">
                    <p>Total Due : </p>
                    <p class="actual-total">$
                      @php
                        $total = 0.00;
                        foreach ($order_details as $order_detail) {
                          $current_book = App\Models\Book::find($order_detail->book_id);
                          $total += $current_book->unit_price * $order_detail->qty;
                        }
                        echo $total;
                      @endphp
                    </p>
                  </div>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      </main>
    </div>
  </body>
  <script>
    const printBtn = document.querySelector('.print-btn');
    printBtn.addEventListener("click", (e) => {
      e.preventDefault();
      window.print();
    });
  </script>
</html>
