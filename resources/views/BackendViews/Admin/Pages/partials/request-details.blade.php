<div class="details--page">
	<div class="header_">
		<div class="d-flex justify-content-between">
			<div>
				<h4><span>{{$content->registration_type}}</span>, <span>{{ $content->created_at->format('d/m/Y') }}</span>, <span>#{{$content->request_id}}</span></h4>
			</div>
			@if(Request::is('admin/inbox'))
			<div>
				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#adminListModal_in_progress-{{$content->id}}">
				  In Progress
				</button>
				<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#adminListModal_solved-{{$content->id}}">
				  Solved
				</button>
				<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#adminListModal_trashed-{{$content->id}}">
				  Trash
				</button>
			</div>
			@endif

			@if(Request::is('admin/trashed'))
				@if(Auth::user()->type === "SuperAdmin")
					<form action="{{ route('admin.moveTo.post', $content->id) }}" method="POST">
			        	@csrf
			        	<input type="hidden" name="move_to" value="Delete">
			        	<input type="hidden" name="transfer_by" value="Self">
			        	<div class="form-group">
			        		<button onclick="return confirm('Are you sure to Delete Permanently?')" class="btn btn-danger btn-sm" type="submit">Delete</button>
			        	</div>
			        </form>
				@endif
			@endif

		</div>
	</div>

	<div class="details--wrapper">
		@if(Request::is('admin/in-progress'))
		<div class="text-right">
			<button type="button" class="reply__btn btn btn-primary"
				toEmail="{{$content->email}}" toName="{{$content->full_name}}">Reply
			</button>
			<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#adminListModal_solved-{{$content->id}}">
			  Solved
			</button>
			<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#adminListModal_trashed-{{$content->id}}">
			  Trash
			</button>
		</div>
		@endif

		@if(Request::is('admin/solved'))
		<div class="text-right">
			<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#adminListModal_trashed-{{$content->id}}">
			  Trash
			</button>
		</div>
		@endif


		@if(!Request::is('admin/inbox'))
		<div class="text-right">
			<small><span>{{ $content->status }} By : @if(intval($content->get_transfer_by->id) === Auth::user()->id) {{ 'Self' }} @else {{ $content->get_transfer_by->name }} @endif</span></small>
		</div>
		@endif

		<div class="table-responsive no--boder-tbl">
			<table class="table">
				<tr>
					<th colspan="2">Summary</th>
				</tr>
				<tr>
					<th>Full Name</th>
					<td>{{ $content->full_name }}</td>
				</tr>


				@if($content->registration_type === "Other")
				<tr>
					<th>Request By</th>
					<td>{{ $content->you_are }}</td>
				</tr>
				@endif

				@if($content->registration_type !== "Other")
					<tr>
						<th>Degree</th>
						<td>{{ $content->degree }}</td>
					</tr>

					@if($content->degree === "Bachelor")
					<tr>
						<th>Learning System</th>
						<td>{{ $content->learning_stream }}</td>
					</tr>
					@endif

					@if($content->degree === "Master")
					<tr>
						<th>Master Name</th>
						<td>{{ $content->master_name }}</td>
					</tr>
					@endif

					<tr>
						<th>Year</th>
						<td>{{ $content->year }}</td>
					</tr>

					@if($content->registration_type === "Student" && $content->degree === "Bachelor")
					<tr>
						<th>Group</th>
						<td>{{ $content->group }}</td>
					</tr>
					@endif
				@endif


				<tr>
					<th>Email</th>
					<td>{{ $content->email  }}</td>
				</tr>
				<tr>
					<th>Telephone</th>
					<td>{{ $content->telephone  }}</td>
				</tr>
				<tr>
					<th>Request Type</th>
					<td>{{ $content->request_type  }}</td>
				</tr>
				<tr>
					<th>Message</th>
					<td>
						<div>
							{{ $content->message  }}
						</div>
					</td>
				</tr>
				<tr>
					<th>Status</th>
					<td>
						<span class="badge badge-danger">{{ $content->status  }}</span>
					</td>
				</tr>
				<tr>
					<th>Request at</th>
					<td>
						{{ $content->created_at->format('d/m/Y')  }}
					</td>
				</tr>

				@if($content->request_file != NULL)
				<tr>
					<th>Attachment's</th>
					<td>
						<a target="_blank" href="{{ route('admin.viewFile.get', [$content->id, $content->request_file]) }}">
						<i class="fas fa-paperclip"></i> View Attachment
						</a>
					</td>
				</tr>
				@endif
			</table>
		</div>
	</div>
</div>





<!-- Modal -->
<div class="modal fade" id="adminListModal_in_progress-{{$content->id}}" tabindex="-1" aria-labelledby="exampleModalLabel-{{$content->id}}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel-{{$content->id}}">Transfer By</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.moveTo.post', $content->id) }}" method="POST">
        	@csrf
        	<input type="hidden" name="move_to" value="In progress">
        	<div class="form-group">
        		<select name="transfer_by" class="form-control">
        			<option value="">Choose One</option>
        			<option value="Self">Self</option>
        			@foreach($admins as $key=>$user)
        			<option value="{{$user->id}}">{{$user->name}}</option>
        			@endforeach
        		</select>
        	</div>
        	<div class="form-group">
        		<button onclick="return confirm('Are you sure to move to In progress?')" class="btn btn-primary btn-sm" type="submit">Transfer</button>
        	</div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="adminListModal_solved-{{$content->id}}" tabindex="-1" aria-labelledby="exampleModalLabel1-{{$content->id}}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Transfer By</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.moveTo.post', $content->id) }}" method="POST">
        	@csrf
        	<input type="hidden" name="move_to" value="Solved">
        	<div class="form-group">
        		<select name="transfer_by" class="form-control">
        			<option value="">Choose One</option>
        			<option value="Self">Self</option>
        			@foreach($admins as $key=>$user)
        			<option value="{{$user->id}}">{{$user->name}}</option>
        			@endforeach
        		</select>
        	</div>
        	<div class="form-group">
        		<button onclick="return confirm('Are you sure to move to Solved?')" class="btn btn-primary btn-sm" type="submit">Transfer</button>
        	</div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="adminListModal_trashed-{{$content->id}}" tabindex="-1" aria-labelledby="exampleModalLabel1-{{$content->id}}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1-{{$content->id}}">Transfer By</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.moveTo.post', $content->id) }}" method="POST">
        	@csrf
        	<input type="hidden" name="move_to" value="Trash">
        	<div class="form-group">
        		<select name="transfer_by" class="form-control">
        			<option value="">Choose One</option>
        			<option value="Self">Self</option>
        			@foreach($admins as $key=>$user)
        			<option value="{{$user->id}}">{{$user->name}}</option>
        			@endforeach
        		</select>
        	</div>
        	<div class="form-group">
        		<button onclick="return confirm('Are you sure to move to Trash?')" class="btn btn-primary btn-sm" type="submit">Transfer</button>
        	</div>
        </form>
      </div>
    </div>
  </div>
</div>
