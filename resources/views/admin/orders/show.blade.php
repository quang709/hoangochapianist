@extends('admin.dashboard')
@section('content1')
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Customer information</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
            
                    <tbody>
                        <tr>
                            <td name="name">{{$orders[0]->customer->name}}</td>
                            <td name="phone">{{$orders[0]->customer->phone}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Shipping information</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Receiver</th>
                            <th>Address</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                  
                    <tbody>
                        <tr>
                            <td name="name">{{$orders[0]->shipping->name}}</td>
                            <td name="phone">{{$orders[0]->shipping->address}}</td>
                            <td name="phone">{{$orders[0]->shipping->phone}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Products information</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantily</th>
                            <th>Price</th>
                      
                        </tr>
                    </thead>
                
                    <tbody>
                        @foreach($product as $p)
                        <tr>
                            <td name="name">{{$p->product_name}}</td>
                            <td name="">{{$p->product_quantily}}</td>
                            <td name="">{{number_format($p->product_price)}}đ</td>
                        
                        </tr>
                        @endforeach
                        <p name=""> Total = {{number_format($orders[0]->total)}}đ</p>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $('#dataTable').dataTable({
        "ordering": false,
    });
</script>
@endsection