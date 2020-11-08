              </div>
                <!-- content-wrapper ends -->
<!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © <?echo date('Y'); ?> <a href="#" target="_blank">Company Name</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Developed By <b></b><i class="far fa-heart"></i>
              </span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    
    
    <!-- container-scroller -->
    <!-- Modal -->
    <div class="modal fade" id="__media_updates_modal__" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="mediaModalTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="mediaModalTitle">Media Uploaded Successfully</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h6 class='text-center mb-10'>Media URL</h6>
            <p id='diplay_media_path_'></p>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <!-- container-scroller -->
    
  </div>
    <!-- plugins:js -->
    <!-- plugins:js -->
    
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    
    <!-- inject:js 'required off-canvas js for getting responsive menu in mobile'-->
    <script src="{{ asset('js/backend/js/shared/off-canvas.js') }}"></script>
    <!-- endinject -->


    <!-- Custom js for this page-->
    <script src="{{ asset('js/backend/js/dashboard-main/dashboard.js') }}"></script>
    <script src="{{ asset('js/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/backend/js/tutorial-page.js') }}"></script>
    <script src="{{ asset('js/backend/js/media-handler.js') }}"></script>
    
   
    <!--ck editor-->
    <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>

    @stack('adminScripts')
    <!-- End custom js for this page-->
  </body>
</html>