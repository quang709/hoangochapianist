@extends('admin.dashboard')
@section('content1')
<div class="container-fluid">




  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">   
      <h6 class="m-0 font-weight-bold text-primary">Category</h6>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">
        Create
      </button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
                      
              <th>Code</th>
              <th>quantity</th>
              <th>condition</th>
              <th>number</th>
              <th>start date</th>
              <th>expery date</th>
              <th></th>

            </tr>
          </thead>
          <tfoot>
            <tr>
        
              <th>Code</th>
              <th>quantity</th>
              <th>condition</th>
              <th>number</th>
              <th>start date</th>
              <th>expery date</th>
              <th></th>

            </tr>
          </tfoot>
          <tbody>
          @foreach($coupons as $c)
            <tr>
            
              <td name=" ">{{$c->code}}</td>
              <td name=" ">{{$c->quantity}}</td>
              @if($c->condition==0)    
               <td name=" " > % discount </td> 
               @elseif($c->condition==1)    
               <td name=" " > discount by price </td> 
               @endif
               @if($c->condition==0)    
               <td name=" ">{{$c->number}}%</td>
               @elseif($c->condition==1)    
               <td name=" ">{{number_format($c->number)}}đ</td>
               @endif
               <td name=" ">{{$c->start_date}}</td>
               <td name=" ">{{$c->expery_date}}</td>
              <td>
                <a class="btn btn-warning js-modal-edit" data-route="{{route('coupon.edit',['id'=>$c->id])}}" > <i class="fas fa-edit"></i></a>
                <a class="btn btn-danger js-modal-delete" data-route-delete="{{route('coupon.destroy',['id'=>$c->id])}}" data-toggle="modal" data-target="#modalDelete"><i class="fas fa-trash"></i></a>



              </td>

            </tr>
          
           @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

<div class="modal " id="modalCreate">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Create</h4>
        <button type="button reset" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- create -->
      <div class="modal-body">

        <form action="" method="POST"  id="form-create">
          @csrf

          <div class="form-group" style="text-align: left">
            <label for="email">Code:</label>
            <input type="text" name="code" class="form-control"  placeholder="Enter code"
            style="text-transform: uppercase">
            <span class="error-form text-danger alert-message"></span>
           
          </div>
          
          <div class="form-group" style="text-align: left">
            <label for="email">Quantity:</label>
            <input type="number" name="quantity" class="form-control" placeholder="Enter quantity">
            <span class="error-form text-danger alert-message"></span>
          </div>
          
          <div class="form-group">
            <label for="email">Condition:</label>
            <select  name="condition">
            <option value="0">% discount</option>  
            <option value="1">discount by price</option>      
            </select>
          </div>
          <div class="form-group" style="text-align: left">
            <label for="email">	Number:</label>
            <input type="text" name="number" class="form-control" placeholder="Enter number">
            <span class="error-form text-danger alert-message"></span>
          </div>
          <div class="input-group input-group-static mb-4" style="text-align: left">
                    <label>start date</label>
                    <input type="date" value="{{ old('expery_date') }}" name="start_date" class="form-control">
                    <span class="error-form text-danger alert-message"></span>                  
                </div>

          <div class="input-group input-group-static mb-4" style="text-align: left">
                    <label>Expery date</label>
                    <input type="date" value="{{ old('expery_date') }}" name="expery_date" class="form-control">
                    <span class="error-form text-danger alert-message"></span>    
                </div>        
          <button type="submit" class="btn btn-primary js-btn-create">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal " id="modalEdit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit</h4>
        <button type="button reset" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- edit -->
      <div class="modal-body">

        <form action="" method="POST" id="form-edit">
          @csrf
          <div class="form-group" style="text-align: left">
            <label for="email">Code:</label>
            <input type="text" name="code" id="code" class="form-control"  placeholder="Enter code"
            style="text-transform: uppercase">
            <span class="error-form text-danger alert-message"></span>
           
          </div>
          
          <div class="form-group" style="text-align: left">
            <label for="email">Quantity:</label>
            <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Enter quantity">
            <span class="error-form text-danger alert-message"></span>
          </div>
          
          <div class="form-group">
            <label for="email">Condition:</label>
            <select  name="condition" id="condition">
            <option value="0">% discount</option>  
            <option value="1">discount by price</option>      
            </select>
          </div>
          <div class="form-group" style="text-align: left">
            <label for="email">	Number:</label>
            <input type="text" name="number"  id="number" class="form-control" placeholder="Enter number">
            <span class="error-form text-danger alert-message"></span>
          </div>
          <div class="input-group input-group-static mb-4" style="text-align: left">
                    <label>start date</label>
                    <input type="date" id="start_date" value="{{ old('start_date') }}" name="start_date" class="form-control">
                    <span class="error-form text-danger alert-message"></span>                  
                </div>

          <div class="input-group input-group-static mb-4" style="text-align: left">
                    <label>Expery date</label>
                    <input type="date" id="expery_date" value="{{ old('expery_date') }}" name="expery_date" class="form-control">
                    <span class="error-form text-danger alert-message"></span>    
                </div>  
          <button type="submit" class="btn btn-primary js-btn-update">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- delete -->
<div class="modal"  id="modalDelete" tabindex="-1" role="dialog">
  @csrf

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <p> Are you sure?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger js-btn-delete">Delete</button>
        <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


@endsection
@section('script')
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('.close').click(function() {
    $('#form-create')[0].reset();

    $("#modalEdit").modal('hide');

  });
  $('.js-btn-create').click(function(e) {
    let $this = $(this);
    let $domForm = $this.closest('form');
    $.ajax({
        url: "{{route('coupon.store')}}",
        data: $('#form-create').serialize(),
        method: "POST",
        success: function(data) {
          if (data.success) {
            location.reload()

          }

        }

      })

      .done(function(results) {
        $('#modalCreate').modal('hide');
      })


      .fail(function(data) {
        var errors = data.responseJSON;
        $.each(errors.errors, function(i, val) {
          $domForm.find('input[name=' + i + ']').siblings('.error-form').text(val[0]);

        });
      });
    e.preventDefault();

  });
  $(".js-modal-edit").click(function(event) {
    event.preventDefault();
    $.ajax({
      url: $(this).data('route'),
      
      method: "GET",
      dataType: 'json',
      success: function(response) {
        console.log(response)
        $('#code').val(response.coupon.code);
        $('#id').val(response.coupon.id);
        $("#modalEdit").modal('show');
        $('select').val(response.coupon.condition);
        $('#quantity').val(response.coupon.quantity);
        $('#number').val(response.coupon.number);
        $('#start_date').val(response.coupon.start_date);
        $('#expery_date').val(response.coupon.expery_date)
      }

    })
  });
  $('.js-modal-delete').click(function(e) {
    e.preventDefault();
    let url = $(this).data('route-delete');
  

    $('.js-btn-delete').click(function(e) {
    e.preventDefault();
    $.ajax({

        url: url,
        dataType: 'json',
        type: 'post',
        method: "GET",
        success: function(response) {
          if (response.success) {
            location.reload()

          }

        }

      })
      .done(function(results) {
        $("#myModalDelete").modal('hide');


      })
  });
   
  });






  $('#dataTable').dataTable({

    "ordering": false,

  });
</script>
@endsection