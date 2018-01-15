@if(Auth::check())
    <!-- start: NAVBAR HEADER -->
    <div class="navbar-header">
        <a href="#" class="sidebar-mobile-toggler pull-left hidden-md hidden-lg" class="btn btn-navbar sidebar-toggle" data-toggle-class="app-slide-off" data-toggle-target="#app" data-toggle-click-outside="#sidebar">
            <i class="ti-align-justify"></i>
        </a>
        <a class="navbar-brand" href="{{ route('home') }}">
            <img  src="{{asset('')}}/assets/images/logo.png" width="150" alt="Soft Pyramid"/>
        </a>
        <a href="#" class="sidebar-toggler pull-right visible-md visible-lg" data-toggle-class="app-sidebar-closed" data-toggle-target="#app">
            <i class="ti-align-justify"></i>
        </a>
        <a class="pull-right menu-toggler visible-xs-block" id="menu-toggler" data-toggle="collapse" href=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <i class="ti-view-grid"></i>
        </a>
    </div>
    <!-- end: NAVBAR HEADER -->
    <!-- start: NAVBAR COLLAPSE -->
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-left">
            <li class="company_name">
                <h2>{{Auth::user()->office->company->name}} </h2>
                <h5 class="text-right text-bold"><em>{{Auth::user()->office->name}}</em></h5>
            </li>
        </ul>
        {{--<ul class="nav navbar-left">--}}
            {{--<li class="padding-left-20 padding-top-15">--}}
                {{--<a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">--}}
                    {{--<i class="fa fa-toggle-on fa-3" aria-hidden="true"></i>--}}
                    {{--<span>Switch Company</span>--}}
                {{--</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
        <ul class="nav navbar-right">
            <!-- start: MESSAGES DROPDOWN -->
          {{--  <li class="dropdown">
                <a href class="dropdown-toggle" data-toggle="dropdown">
                    <span class="dot-badge partition-red"></span> <i class="ti-comment"></i> <span>MESSAGES</span>
                </a>
                <ul class="dropdown-menu dropdown-light dropdown-messages dropdown-large">
                    <li>
                        <span class="dropdown-header"> Unread messages</span>
                    </li>
                    <li>
                        <div class="drop-down-wrapper ps-container">
                            <ul>
                                <li class="unread">
                                    <a href="javascript:;" class="unread">
                                        <div class="clearfix">
                                            <div class="thread-image">
                                                <img src="{{asset('')}}/assets/images/avatar-2.jpg" alt="">
                                            </div>
                                            <div class="thread-content">
                                                <span class="author">Nicole Bell</span>
                                                <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
                                                <span class="time"> Just Now</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;" class="unread">
                                        <div class="clearfix">
                                            <div class="thread-image">
                                                <img src="{{asset('')}}/assets/images/avatar-3.jpg" alt="">
                                            </div>
                                            <div class="thread-content">
                                                <span class="author">Steven Thompson</span>
                                                <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
                                                <span class="time">8 hrs</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <div class="clearfix">
                                            <div class="thread-image">
                                                <img src="{{asset('')}}/assets/images/avatar-5.jpg" alt="">
                                            </div>
                                            <div class="thread-content">
                                                <span class="author">Kenneth Ross</span>
                                                <span class="preview">Duis mollis, est non commodo luctus, nisi erat porttitor ligula...</span>
                                                <span class="time">14 hrs</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="view-all">
                        <a href="#">
                            See All
                        </a>
                    </li>
                </ul>
            </li>--}}
            <!-- end: MESSAGES DROPDOWN -->
            <!-- start: ACTIVITIES DROPDOWN -->
            {{--<li>
                <a href data-toggle="modal" data-target="#myModal">
                    <i class="fa fa-toggle-on fa-3" aria-hidden="true"></i>
                    <span>Switch Company</span>
                </a>
            </li>--}}
            <li class="dropdown">
                <a href class="dropdown-toggle" data-toggle="dropdown">
                    <i class="ti-check-box"></i> <span>ACTIVITIES</span>
                </a>
                <ul class="dropdown-menu dropdown-light dropdown-messages dropdown-large">
                    <li>
                        <span class="dropdown-header"> You have new notifications</span>
                    </li>
                    @foreach($latestActivities as $activity)
                        <li>
                            <div class="drop-down-wrapper ps-container">
                                <div class="list-group no-margin">
                                    <a class="media list-group-item" href="">
                                        <span class="media-body block no-margin"> {{$activity->text}} <small class="block text-grey">{{$activity->created_at->diffForHumans()}}</small> </span>
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </li>
            <!-- end: ACTIVITIES DROPDOWN -->
            <!-- start: LANGUAGE SWITCHER -->
            <li class="dropdown">
                <a href class="dropdown-toggle" data-toggle="dropdown">
                    <i class="ti-world"></i> English
                </a>
                <ul role="menu" class="dropdown-menu dropdown-light fadeInUpShort">
                    <li>
                        <a href="#" class="menu-toggler">
                            English
                        </a>
                    </li>
                </ul>
            </li>
            <!-- start: LANGUAGE SWITCHER -->
            <!-- start: USER OPTIONS DROPDOWN -->
            <li class="dropdown current-user">
                <a href class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{auth()->user()->image}}" alt="{{auth()->user()->name}}"> <span class="username">{{auth()->user()->name}} <i class="ti-angle-down"></i></span>
                </a>
                <ul class="dropdown-menu dropdown-dark">
                    <li>
                        <a href="{{route('profile')}}">
                            My Profile
                        </a>
                    </li>
                    <li>
                        <a href="{{route('lockScreen')}}">
                            Lock Screen
                        </a>
                    </li>
                    <li>
                        <a href="/logout">
                            Log Out
                        </a>
                    </li>
                </ul>
            </li>
            <!-- end: USER OPTIONS DROPDOWN -->
        </ul>
        <!-- start: MENU TOGGLER FOR MOBILE DEVICES -->
        <div class="close-handle visible-xs-block menu-toggler" data-toggle="collapse" href=".navbar-collapse">
            <div class="arrow-left"></div>
            <div class="arrow-right"></div>
        </div>
        <!-- end: MENU TOGGLER FOR MOBILE DEVICES -->
    </div>
    <a class="dropdown-off-sidebar sidebar-mobile-toggler hidden-md hidden-lg" data-toggle-class="app-offsidebar-open" data-toggle-target="#app" data-toggle-click-outside="#off-sidebar">
        &nbsp;
    </a>
    <a class="dropdown-off-sidebar hidden-sm hidden-xs" data-toggle-class="app-offsidebar-open" data-toggle-target="#app" data-toggle-click-outside="#off-sidebar">
        &nbsp;
    </a>
    <!-- end: NAVBAR COLLAPSE -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-right:0px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'voucher.preview_listing','method' => 'GET' ,'class' => '', 'id'=>'vouchers-form']) !!}

                        @select('trans'=> 'accounts', 'name' => 'active_company_id', 'list' => [], 'options' => ['label-size'=>'3','class' =>'form-control'])

                    {!! Form::close()!!}
                </div>
                <div class="clear10"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-o" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>

@endif