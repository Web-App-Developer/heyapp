<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>HeyApp</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- assets -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('processing/form-processing-style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
        
    </head>

    <body>

      <section class="header">
         <div class="container">
            <div class="row justify-content-between">
                  <div class="left_logo">
                      <div class="__left_logo_text">
                          <h3><span class="h_letter">hey!</span>&nbsp;</h3>
                      </div>
                      <span class="p_letter">powered by</span>
                     <img class="__left_logo_img" src="{{ asset('img/logo-images/left-logo.jpeg') }}" alt="">
                  </div>
                  <div class="right_logo"> 
                     <img class= "__rigt_logo_1" src="{{ asset('img/logo-images/right-logo.jpeg') }}" alt="">
                     <img class= "__rigt_logo_2" src="{{ asset('img/logo-images/right-logo-2.png') }}" alt="">
                  </div>
            </div>
         </div>
      </section>


      <section class="p-5  __desktop-p-5">
          <div class="container ">
              <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12"></div>

                <div class="col-lg-6 col-md-6 col-sm-12 tablet-only">
                    <div class="content--wrapper">
                      <h3 class="text-center heading">HeyApp!</h3>
                      <div class="trigger-points">
                          <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Student</a>
                            </li>
                            <li class="nav-item" role="presentation">
                              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Alumni</a>
                            </li>
                            <li class="nav-item" role="presentation">
                              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Other</a>
                            </li>
                            <li class="nav-item" role="presentation">
                              <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">Documents</a>
                            </li>
                          </ul>
                      </div> <!-- .trigger-points end here -->

                      <div class="display--contents">
                          <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                @include('frontend.partials.student.student-index')
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                @include('frontend.partials.alumni.alumni-index')
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                @include('frontend.partials.other.other-index')
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                @include('frontend.partials.documents.documents-index')
                            </div>
                          </div>
                      </div> <!-- .display--contents end here -->
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12"></div>
              </div>
          </div>
      </section>




        <!-- Modal -->
        <div class="modal fade" id="alerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="msgbox text-danger"></div>
              </div>
            </div>
          </div>
        </div>

        @include('processing.processing-gif')
        <!-- scripts -->
        <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}" defer></script>
        <script type="text/javascript" src="{{ asset('assets/js/popper.min.js') }}" defer></script>
        <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}" defer></script>
        <script type="text/javascript" src="{{ asset('assets/js/main.js') }}" defer></script>
        @stack('scritps')
    </body>
 
</html>
