<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav class="nav navbar-nav">
            <ul class="navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="navbarDropdown">
                        <img src="{{ url('assets/user.png') }}" alt=""> {{ Session::get('username') }}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ url('login') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->