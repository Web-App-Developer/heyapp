@extends('BackendViews.Admin.layouts.master')

@push('backend_css')
<link rel="stylesheet" type="text/css" href="/processing/form-processing-style.css">
@endpush

@section('adminContent')      
@include('BackendViews.Admin.layouts.partials.sidebar')
      
    <!-- yield content here -->
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h4 class="card-title mb-0">Manage Admins</h4>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addAdminModal">
              Add
            </button>
          </div>
          <p class="card-description">This page represent admin management.</p>
          <br>
          @include('msg.msg')


          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>SN.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Created at</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                @if(!$data->isEmpty())
                @foreach($data as $key=>$content)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$content->name}}</td>
                  <td>{{$content->email}}</td>
                  <td>{{$content->created_at->format('d/m/Y')}}</td>
                  <td>
                    @include('BackendViews.Admin.Pages.admins-partials.edit')
                    @include('BackendViews.Admin.Pages.admins-partials.update-password')
                    <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" href="{{ route('admin.deleteAdmin.post', encrypt($content->id)) }}"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                @endforeach
                <tr>
                  {!! $data->render() !!}
                </tr>

                @endif


              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="exampleModalLabelAdmin" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelAdmin">Add New Admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('admin.admins.store') }}" method="POST">
              @csrf
              <div class="form-group">
                <label>* Name</label>
                <input type="text" name="name" placeholder="Name" class="form-control">
              </div>
              <div class="form-group">
                <label>* Email</label>
                <input type="email" name="email" placeholder="Email" class="form-control">
              </div>
              <div class="form-group">
                <label>Note</label>
                <input type="text" name="note" placeholder="Note (Optional)" class="form-control" maxlength="200">
              </div>
              <div class="form-group">
                <label>* Password</label>
                <input type="password" name="password" placeholder="Password" class="form-control">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Add</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>



    @include('BackendViews.Admin.Pages.partials.reply-template')
    @include('processing.processing-gif')

@endsection

@push('adminScripts')
<script type="text/javascript">
  //reply template
  $(".reply__btn").on('click', function(){
    let toEmail = $(this).attr('toEmail')
    let toName = $(this).attr('toName')

    if (toEmail != "" && toName != "") {
      $("#setToName").val(toName)
      $("#setToName").attr('readonly', true)
      
      $("#setToEmail").val(toEmail)
      $("#setToEmail").attr('readonly', true)

      $("#getReplyTemplate").modal('show');
    }else{
      alert('Invalid Request')
      window.location.reload(true)
    }

  })
</script>

<script type="text/javascript" src="/assets/js/main.js"></script>
@endpush