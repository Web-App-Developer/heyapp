@extends('BackendViews.Admin.layouts.master')

@section('adminContent')      
@include('BackendViews.Admin.layouts.partials.sidebar')
      
    <!-- yield content here -->
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h4 class="card-title mb-0">Messages</h4>
          </div>
          <p class="card-description">This page represent all contact messages</p>
          <br>
          @include('msg.msg')

          <div class="table-responsive">
            <table class="table table-striped table-hover text-center">
              <thead>
                <tr>
                  <th>SL.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Message</th>
                  <th>Status</th>
                  <th>At</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @if(!$data->isEmpty())
                @foreach($data as $key=>$content)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>
                    {{ $content->name }}
                  </td>
                  <td>
                    {{ $content->email }}
                  </td>
                  <td>
                    {{ str_limit($content->message, 25) }}
                  </td>
                  <td>
                    @if($content->stauts == 0)
                      <span class="badge badge-danger">New</span>
                    @endif
                  </td>
                  <td>
                    @if($content->created_at != NULL)
                      {{ $content->created_at->format('m/d/Y H:m') }}
                    @endif
                  </td>

                  <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" 
                      data-target="#mediaEdit-{{ $content->id }}">
                      VIEW
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="mediaEdit-{{ $content->id }}" tabindex="-1" role="dialog" aria-labelledby="mediaEditLabel-{{ $content->id }}" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="mediaEditLabel-{{ $content->id }}">Contact Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body text-left">
                            <table class="table">
                              <tr>
                                <th>Name</th>
                                <td>{{ $content->name }}</td>
                              </tr>
                              <tr>
                                <th>Email</th>
                                <td>{{ $content->email }}</td>
                              </tr>
                              <tr>
                                <th>Message</th>
                                <td>
                                  <textarea cols="5" rows="5" class="form-control" readonly="1">{{ $content->message }}</textarea>
                                </td>
                              </tr>
                              <tr>
                                <th>Contact at</th>
                                <td>
                                  @if($content->created_at != NULL)
                                    {{ $content->created_at->format('m/d/Y H:m') }}
                                  @endif
                                </td>
                              </tr>
                            </table>
                          </div>
                          <div class="modal-footer">
                            @if($content->status == 0)
                              <form action="{{ route('admin.messages.update', $content->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button onclick="return confirm('Are you sure?')" class="btn btn-primary btn-sm" type="submit">Mark as Seen</button>
                              </form>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
                @else
                <td colspan="7">No Data Found</td>
                @endif
              </tbody>
            </table>
          </div>
          {!! $data->render() !!}
        </div>
      </div>
    </div>

@endsection

@push('adminScripts')

@endpush