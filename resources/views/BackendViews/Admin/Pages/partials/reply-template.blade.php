
<!-- Modal -->
<div class="modal fade" id="getReplyTemplate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reply Email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="reply-email--form" class="myForm__" action="{{ route('admin.replyEmail.post') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>To Name</label>
                <input id="setToName" type="text" name="name" class="form-control" value="" required="1">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>To Email</label>
                <input id="setToEmail" type="email" name="email" class="form-control" value="" required="1">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Subject</label>
            <input type="text" name="subject" placeholder="Subject" required="1" class="form-control">
          </div>

          <div class="form-group">
            <label>Message</label>
            <textarea placeholder="Message" class="form-control" rows="5" cols="5" name="message" required="1"></textarea>
          </div>

          <div class="form-group">
            <label>Attachment's</label>
            <input type="file" name="attach_file" class="form-control">
            <small>Supported - PDF,PNG,JPG,GIF,DOCX</small>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-paper-plane"></i> Send</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>