<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border:0;background:white;text-align:center">
              <img src="{{ url('assets/logo.png') }}" alt="PurpleBug" class="logo" style="width:200px;padding-left:20px;text-align:center;padding-top:auto">
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ url('assets/user.png') }}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Session::get('username') }} </h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down active"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li><a href="{{ url('password') }}"><i class="fa fa-lock"></i> Change Password</a></li>
                        @if ( Session::get('roles') == '1' )
                          <li><a href="{{ url('user') }}"><i class="fa fa-user"></i> User</a></li>
                          <li><a href="{{ url('role') }}"><i class="fa fa-users"></i> Roles</a></li>
                          <li><a href="{{ url('category') }}"><i class="fa fa-list"></i> Category</a></li>
                        @endif
                    </ul>
                  </li>
                  
                  <li><a><i class="fa fa-money"></i> Expenses <span class="fa fa-chevron-down active"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ url('expenses') }}"><i class="fa fa-money"></i> Expenses</a></li>
                        @if ( Session::get('roles') == '1' )
                          <li><a href="{{ url('category') }}"><i class="fa fa-list"></i> Category</a></li>
                        @endif
                    </ul>
                  </li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>