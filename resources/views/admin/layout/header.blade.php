
<div class="header py-4">
    <div class="container">
        <div class="d-flex">
            <a class="header-brand" href="#">
                <img src="{{asset('public/logo.jpg')}}" class="header-brand-img" alt="tabler logo">
            </a>
            <div class="d-flex order-lg-2 ml-auto">
            
                <div class="dropdown">
                    <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                        <span class="avatar" style="background-image: url({{asset('public/logo.jpg')}})"></span>
                        <span class="ml-2 d-none d-lg-block">
                            <span class="text-default">{{Auth::guard('admin')->user()->name}}</span>

                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <!-- <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-user"></i> Profile
                    </a>
                    <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-settings"></i> Settings
                    </a>
                    <a class="dropdown-item" href="#">
                      <span class="float-right"><span class="badge badge-primary">6</span></span>
                      <i class="dropdown-icon fe fe-mail"></i> Inbox
                    </a>
                    <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-send"></i> Message
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-help-circle"></i> Need help?
                    </a> -->
                        <a class="dropdown-item" href="{{ url('/admin/logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                            <i class="dropdown-icon fe fe-log-out"></i> Sign out
                        </a>
                          
                        
                        <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
            <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse"
                data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
            </a>
        </div>
    </div>
</div>
<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="{{route('admin.home')}}" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="{{route('admin.users')}}" class="nav-link "><i class="fa fa-user"
                                aria-hidden="true"></i>User</a>
                    </li>

                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fa fa-user"></i>
                            Member Request </a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                            <a href="{{route('admin.approved_members')}}" class="dropdown-item ">Approved Members</a>
                            <a href="{{route('admin.pending_members')}}" class="dropdown-item ">Pending Members</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fa fa-user"></i>
                            Need help </a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                        <a href="{{route('admin.help.open')}}" class="dropdown-item"><i class="fa fa-user"
                                aria-hidden="true"></i>Open Issue</a>
                        <a href="{{route('admin.help.close')}}" class="dropdown-item"><i class="fa fa-user"
                                aria-hidden="true"></i>Closed Issue</a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fa fa-user"></i>
                            Donations </a>
                        <div class="dropdown-menu dropdown-menu-arrow">
                        <a href="{{route('admin.donation.cash_donation')}}" class="dropdown-item"><i class="fa fa-user"
                                aria-hidden="true"></i>Cash Donation</a>
                        <a href="{{route('admin.donation.blood_donation')}}" class="dropdown-item"><i class="fa fa-user"
                                aria-hidden="true"></i>Blood Donation</a>
                        </div>
                    </li>
                    
                   
                    
                    

                </ul>
            </div>
        </div>
    </div>
</div>
