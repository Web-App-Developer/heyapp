<div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">
                  <!-- <img class="img-xs rounded-circle" src="{{ asset('images/backend/images/profile-images/05.jpg') }}" alt="profile image"> -->
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">{{ Auth::user()->name }}</p>
                  <p class="designation text-center">Admin</p>
                </div>
              </a>
            </li>
            <li class="nav-item nav-category">Main Menu</li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home') }}">
                <span class="menu-title">Dashboard</span>
              </a>
            </li>

            <li class="nav-item">
              @php
                $getTotalNew = (\App\OnlineRegistration::where('status', 'New')->count());
                $getTotalInProgress = (\App\OnlineRegistration::where('status', 'In progress')->count());
                $getTotalSolved = (\App\OnlineRegistration::where('status', 'Solved')->count());
                $getTotalTrash = (\App\OnlineRegistration::where('status', 'Trash')->count());
              @endphp
              <a class="nav-link" data-toggle="collapse" href="#ads" aria-expanded="false" aria-controls="ads">
                <span class="menu-title">Online Requests @if($getTotalNew > 0) <span class="badge badge-pill badge-info">{{ $getTotalNew }}</span>@endif</span>
                <i class="fas fa-angle-down menu_down_icons"></i>
              </a>
              <div class="collapse" id="ads">
                <ul class="nav flex-column sub-menu">
                    <!--in table page_contents must be the content for file name will be the same to same page url-->
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.newRequests.get') }}">Inbox {{$getTotalNew}}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.inProgressRequests.get') }}">In Progress {{$getTotalInProgress}}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.solvedRequests.get') }}">Solved {{$getTotalSolved}}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.trashedRequests.get') }}">Trashed {{$getTotalTrash}}</a>
                  </li>
                </ul>
              </div>
            </li>


            @if(Auth::user()->type === "SuperAdmin")
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#admins" aria-expanded="false" aria-controls="admins">
                <span class="menu-title">Admins</span>
                <i class="fas fa-angle-down menu_down_icons"></i>
              </a>
              <div class="collapse" id="admins">
                <ul class="nav flex-column sub-menu">
                    <!--in table page_contents must be the content for file name will be the same to same page url-->
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.admins.index') }}">Admins</a>
                  </li>
                </ul>
              </div>
            </li>
            @endif
            
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
        <div id="display_top_search_result_here"></div>