<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>info Order</title>
</head>

<body>
  <h1>{{ $title }}</h1>
  <p>{{ $date }}</p>


  <style>
    body {
      font-family: 'DejaVu Sans';
    }

    table {

      border-collapse: collapse;
      width: 100%;
    }

    td,
    th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }
  </style>
  </head>




  <h2>Customer information</h2>

  <table>
    <tr>
      <th>Customer</th>
      <th>Phone</th>
    </tr>
    <tr>
      <td>{{$orders[0]->customer->name}}</td>
      <td>{{$orders[0]->customer->phone}}</td>
    </tr>


  </table>

  <h2>Shipping information</h2>

  <table>
    <tr>
      <th>Receiver</th>
      <th>Address</th>
      <th>Phone</th>
    </tr>
    <tr>
      <td name="name">{{$orders[0]->shipping->name}}</td>
      <td name="phone">{{$orders[0]->shipping->address}}</td>
      <td name="phone">{{$orders[0]->shipping->phone}}</td>
    </tr>


  </table>

  <h2>Products information</h2>

  <table>
    <tr>
      <th>Name</th>
      <th>Quantily</th>
      <th>Price</th>
    </tr>
    <tr>
      @foreach($product as $p)
    <tr>
      <td name="name">{{$p->product_name}}</td>
      <td name="">{{$p->product_quantily}}</td>
      <td name="">{{number_format($p->product_price)}}đ</td>

    </tr>
    @endforeach

    </tr>


  </table>

  <p> Total = {{number_format($orders[0]->total)}}đ</p>
</body>

</html>