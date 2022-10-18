@extends('admin.dashboard')
@section('content1')
<div class="container-fluid">




  <!-- DataTales Example -->
  <div class="card shadow mb-4">

    <div class="card-header py-3">

      <h6 class="m-0 font-weight-bold text-primary">News Of Category</h6>
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">
        Create
      </button>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Title</th>
              <th>Title_url</th>
              <th>summary</th>
              <th>Image</th>
              <th>Category</th>
              <th></th>

            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Title</th>
              <th>Title_url</th>
              <th>summary</th>
              <th>Image</th>
              <th>Category</th>
              <th></th>

            </tr>
          </tfoot>
          <tbody>
            @foreach($newsOfCategory as $n)
          
            <tr>
              <td name="title">{{$n[0]->title??''}}</td>
              <td name="title_url">{{$n[0]->title_url??''}}</td>
              <td name="content">{!!$n[0]->summary??''!!}</td>
              <td name="image"><img src="upload/news/{{$n[0]->image}}" ></td>
              <td name="content">{{$n[0]->category[0]->name??''}}</td>
              <td>
                <a class="btn btn-warning js-modal-edit" data-route="{{route('news.edit',['id'=>$n[0]->id])}}"><i class="fas fa-edit"></i></a>
                <a class="btn btn-danger js-modal-delete" data-route-delete="{{route('news.destroy',['id'=>$n[0]->id])}}" data-toggle="modal" data-target="#modalDelete"><i class="fas fa-trash"></i></a>
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- create -->
<div class="modal " id="modalCreate">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Create</h4>
        <button type="button reset" class="close " data-dismiss="modal">&times;</button>
      </div>


      <div class="modal-body">

        <form action="" method="POST" data-route="{{route('news.store')}}" id="form-create" enctype="multipart/form-data">
          @csrf
          <label for="email">Category:</label>
          <div class="form-group" style="text-align: left">      
            <select  name="category_id">
              @foreach($category as $c)
              <option value="{{$c->id}}">{{$c->name}}</option>            
              @endforeach
            </select>
          </div>
          <div class="form-group" style="text-align: left">
            <label for="email">Title:</label>
            <input type="text" name="title" id="title" class=" form-control" placeholder="Enter title">
            <span class="error-form text-danger alert-message"></span>
          </div>
          <div class="form-group" style="text-align: left">
            <label for="email">Title:</label>
            <input type="text" name="summary" id="summary" class=" form-control" placeholder="Enter summary">
            <span class="error-form text-danger alert-message"></span>
          </div>
          <div class="form-group" style="text-align: left">
            <label for="email">Content:</label>
            <textarea type="text" id="content1" name="content" class="form-control  " placeholder="Enter content"></textarea>
            <span class="error-form text-danger alert-message"></span>
          </div>
          <div class="form-group" style="text-align: left">
            <label for="email">Image:</label>
            <input type="file" name="image" class="form-control">
            <span class="error-form text-danger alert-message"></span>
          </div>
          <button type="submit" class="btn btn-primary js-btn-create">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- edit -->
<div class="modal " id="modalEdit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit</h4>
        <button type="button reset" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

        <form action="" method="POST" id="form-edit" enctype="multipart/form-data">
          @csrf
          <label for="email">Category:</label>
          <div class="form-group" style="text-align: left">      
            <select  name="category_id">
              @foreach($category as $c)
              <option value="{{$c->id}}">{{$c->name}}</option>            
              @endforeach
            </select>
          </div>
          <input type="hidden" id="id1" class="form-control">
          <div class="form-group" style="text-align: left">
            <label for="email">Title:</label>
            <input type="text" id="title1" name="title" class="form-control" placeholder="Enter title">
            <span class="error-form text-danger alert-message"></span>
          </div>
          <div class="form-group" style="text-align: left">
            <label for="email">Summary:</label>
            <input type="text" id="summary1" name="summary" class="form-control" placeholder="Enter summary">
            <span class="error-form text-danger alert-message"></span>
          </div>
          <div class="form-group" style="text-align: left">
            <label for="email">Content:</label>
            <textarea type="text" id="content2" name="content" class="form-control " placeholder="Enter content"></textarea>
            <span class="error-form text-danger alert-message"></span>
          </div>
          <div class="form-group" style="text-align: left">
            <label for="email">Image:</label>
            <input type="file" id="imgInp" name="image" class="form-control">
            <span class="error-form text-danger alert-message"></span>
          </div>
          <img  id="image1">
          <button type="submit" class="btn btn-primary js-btn-update">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- delete -->
<div class="modal" id="modalDelete" tabindex="-1" role="dialog">
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
    e.preventDefault();
    let url = $("#form-create").data('route');
    var data = new FormData(document.getElementById("form-create"));
    data.append('content', CKEDITOR.instances['content1'].getData());
  
     
    let $this = $(this);
    let $domForm = $this.closest('form');
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {
          if (response.success) {
            location.reload()

          }

        }

      })

      .done(function(results) {
        $("#myModal").modal('hide');
        $("#form-create")[0].reset();


      })
      .fail(function(data) {
        var errors = data.responseJSON;
        $.each(errors.errors, function(i, val) {
          $domForm.find('input[name=' + i + ']').siblings('.error-form').text(val[0]);
        });
      });


  });
  $(".js-modal-edit").click(function(event) {
    event.preventDefault();
    $.ajax({
      url: $(this).data('route'),
      method: "GET",
      dataType: 'json',
      success: function(response) {           
        $('select').val(response.news[0].category[0].id);
        $('#image1').attr('src','upload/news/'+response.news[0].image);
       // $('#content2').val(response.news[0].content);
        $('#summary1').val(response.news[0].summary);
        CKEDITOR.instances.content2.setData( response.news[0].content);
        $('#title1').val(response.news[0].title);
        $('#id1').val(response.news[0].id);
        $("#modalEdit").modal('show');

      }

    })

    imgInp.onchange = evt => {
      const [file] = imgInp.files
      if (file) {
        image1.src = URL.createObjectURL(file)
      }
    }
  });
  $(".js-btn-update").click(function(event) {
    event.preventDefault();
    var data = new FormData(document.getElementById("form-edit"));
    data.append('content', CKEDITOR.instances['content2'].getData());
  
    let $this = $(this);
    let $domForm = $this.closest('form');
    var id = $("#id1").val();
    var url = '{{ route("news.update", ":id") }}';
    url = url.replace(':id', id);
    $.ajax({
      type: 'POST',
        url: url,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
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

  CKEDITOR.replace( 'content1' );        
  CKEDITOR.replace( 'content2' );                      
</script>

@endsection