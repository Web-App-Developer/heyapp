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
            <h4 class="card-title mb-0">{{ $pageTitle }}</h4>
          </div>
          <p class="card-description">You are viewing all {{$pageTitle}} data.</p>
          <br>
          @include('msg.msg')


          <div class="row">
            <div class="col-3">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                @foreach($data as $key=>$content)
                <a class="nav-link @if($key == 0) active @endif" id="v-pills-home-tab-{{$content->id}}" data-toggle="pill" href="#v-pills-home-{{$content->id}}" role="tab" aria-controls="v-pills-home-{{$content->id}}" aria-selected="@if($key ==0)true @else false @endif">
                  {{$content->registration_type}} #{{$content->request_id}}
                </a>
                @endforeach
              </div>
            </div>
            <div class="col-9">
              <div class="tab-content" id="v-pills-tabContent">
                @foreach($data as $key=>$content)
                <div class="tab-pane fade @if($key == 0)show active @endif" id="v-pills-home-{{$content->id}}" role="tabpanel" aria-labelledby="v-pills-home-tab-{{$content->id}}">
                  @include('BackendViews.Admin.Pages.partials.request-details')
                </div>
                @endforeach
              </div>
            </div>
          </div>

          <div class="p-2">{!! $data->render() !!}</div>
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