<!-- Button trigger modal -->
<button title="Change Password" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updatePassModal-{{$content->id}}">
  <i class="fas fa-key"></i>
</button>
<!-- Modal -->
<div class="modal fade" id="updatePassModal-{{$content->id}}" tabindex="-1" aria-labelledby="exampleModalLabel-{{$content->id}}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel-{{$content->id}}">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.updateAdminPassword.post', $content->id) }}" method="POST">
          @csrf
          <div class="form-group">
            <label>New Password</label>
            <br>
            <input required="1" type="password" name="password" placeholder="Enter new password" class="form-control">
          </div>
          <div class="form-group">
            <button class="btn btn-primary btn-sm" type="submit">Change</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>