@if(session()->has('success'))
<div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ session()->get('success') }}
</div>
@endif


@if(session()->has('error'))
<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{ session()->get('error') }}
</div>
@endif


@if(!Request::is('login'))
  @if ($errors->any())
  <div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

      @foreach ($errors->all() as $error)
         <p> {{ $error }} </p>
      @endforeach

  </div>
  @endif
@endif
