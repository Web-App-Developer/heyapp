<button title="Edit" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editAdmin-{{$content->id}}">
  <i class="fas fa-edit"></i>
</button>
<!-- Modal -->
<div class="modal fade" id="editAdmin-{{$content->id}}" tabindex="-1" aria-labelledby="editAdminlabel-{{$content->id}}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editAdminlabel-{{$content->id}}">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.admins.update', $content->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label>Name</label>
            <br>
            <input type="text" name="name" value="{{$content->name}}" class="form-control">
          </div>
          <div class="form-group">
            <label>Email</label>
            <br>
            <input type="email" name="email" value="{{$content->email}}" class="form-control">
          </div>
          <div class="form-group">
            <label>Note</label>
            <br>
            <input type="text" name="note" value="{{$content->note}}" class="form-control" maxlength="200">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>