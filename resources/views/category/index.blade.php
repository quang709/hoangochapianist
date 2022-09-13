@extends('dashboard')
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
              <th>Name</th>
              <th>Name_url</th>
              <th></th>

            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Name</th>
              <th>Name_url</th>
              <th></th>

            </tr>
          </tfoot>
          <tbody>
            @foreach($category as $c)
            <tr>
              <td name="name">{{$c->name}}</td>
              <td name="name_url ">{{$c->name_url}}</td>
              <td>
                <a class="btn btn-warning js-modal-edit" data-route="{{route('categories.edit',['id'=>$c->id])}}" > <i class="fas fa-edit"></i></a>
                <a class="btn btn-danger js-modal-delete" data-route-delete="{{route('categories.destroy',['id'=>$c->id])}}" data-toggle="modal" data-target="#modalDelete"><i class="fas fa-trash"></i></a>



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

        <form action="" method="POST" data-route="{{route('categories.store')}}" id="form-create">
          @csrf

          <div class="form-group" style="text-align: left">
            <label for="email">Name:</label>
            <input type="text" name="name" class="form-control" placeholder="Enter name">
            <span class="error-form text-danger alert-message"></span>
          </div>
          <div class="form-group" >
            <label for="email">Parent:</label>
            <select  name="category_id">
            <option value="0">--Root--</option>  
              @foreach($category as $c)
              <option value="{{$c->id}}">
              @php
              $str ='';
              for($i = 0; $i < $c->level; $i++)
              {
                echo $str;
                $str.='-- ';
              }
              @endphp     
            
              {{$c->name}}
            </option>
            @endforeach
            
            </select>
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
          <input type="hidden" id="id" class="form-control">
          <div class="form-group" style="text-align: left">
            <label for="email">Name:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Enter name">
            <span class="error-form text-danger alert-message"></span>
          </div>
          <div class="form-group" >
            <label for="email">Parent:</label>
            <select  name="category_id">
            <option value="0">--Root--</option>  
              @foreach($category as $c)
              <option value="{{$c->id}}">
              @php
              $str ='';
              for($i = 0; $i < $c->level; $i++)
              {
                echo $str;
                $str.='-- ';
              }
              @endphp     
            
              {{$c->name}}
            </option>
            @endforeach
            
            </select>
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
    let url = $("#form-create").data('route');
    let $this = $(this);
    let $domForm = $this.closest('form');
    $.ajax({
        url: url,
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
        $('#name').val(response.category.name);
        $('#id').val(response.category.id);
        $("#modalEdit").modal('show');
        $('select').val(response.category.parent_id);
      }

    })
  });
  $(".js-btn-update").click(function(event) {
    event.preventDefault();
    let $this = $(this);
    let $domForm = $this.closest('form');
    var id = $("#id").val();
    var url = '{{ route("categories.update", ":id") }}';
    url = url.replace(':id', id);

    $.ajax({
        url: url,
        data: $('#form-edit').serialize(),
        method: "POST",
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            location.reload()

          }

        }

      })
      .done(function(results) {
        $("#ModalEdit").modal('hide');
        $("#form-edit")[0].reset();

      })
      .fail(function(data) {
        var errors = data.responseJSON;
        $.each(errors.errors, function(i, val) {
          $domForm.find('input[name=' + i + ']').siblings('.error-form').text(val[0]);
        });
      });

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