<header>

    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="search-bar flex-grow-1">
                <div class="position-relative search-bar-box">
                    <input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
                    <span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
                </div>
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item mobile-search-icon">
                        <a class="nav-link" href="#">	<i class='bx bx-search'></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">	<i class='bx bx-category'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="row row-cols-3 g-3 p-3">
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-cosmic text-white"><i class='bx bx-group'></i>
                                    </div>
                                    <div class="app-title">Teams</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-burning text-white"><i class='bx bx-atom'></i>
                                    </div>
                                    <div class="app-title">Projects</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-lush text-white"><i class='bx bx-shield'></i>
                                    </div>
                                    <div class="app-title">Tasks</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-kyoto text-dark"><i class='bx bx-notification'></i>
                                    </div>
                                    <div class="app-title">Feeds</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-blues text-dark"><i class='bx bx-file'></i>
                                    </div>
                                    <div class="app-title">Files</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-moonlit text-white"><i class='bx bx-filter-alt'></i>
                                    </div>
                                    <div class="app-title">Alerts</div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">

                            @php
                                $ncount = Auth::user()->unreadNotifications()->whereNot('type','App\Notifications\contactNotification')->count();
                            @endphp
                            {{ $ncount }}

                        </span>
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Notifications</p>
                                </div>
                            </a>
                            <div class="header-notifications-list">

                                @php

                                $user = Auth::user();

                                @endphp

                                @forelse($user->notifications as $notification)

                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="notify bg-light-warning text-warning"><i class="bx bx-send"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">Message<span class="msg-time float-end">{{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span></h6>
                                            <p class="msg-info">{{ $notification->data['message'] }}</p>
                                        </div>
                                    </div>
                                </a>
                                @empty

                                @endforelse

                            </div>
                            <a href="javascript:;">
                                <div class="text-center msg-footer">View All Notifications</div>
                            </a>
                        </div>
                    </li>
                    @php
                    $cncount = Auth::user()->unreadNotifications()->where('type','App\Notifications\contactNotification')->count();

                    @endphp
                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count" id="contactnotificationcount">{{ $cncount }}</span>
                            <i class='bx bx-comment'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Messages</p>
                                    <p class="msg-header-clear ms-auto" id="markasread">Marks all as read</p>
                                </div>
                            </a>
                            <div class="header-message-list">
                                @php
                                    $contactnotification= Auth::user()->notifications->where('type','App\Notifications\contactNotification');
                                @endphp
                                @forelse($contactnotification as $notification)
                                @php
                                $userData= App\Models\User::where('id',$notification->data['user_id'])->first();

                            @endphp
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div >
                                            <img src=@if(!empty($userData->photo)) {{ asset('upload/user_images/'.$userData->photo) }} @elseif(!empty($userData->social_avatar)) "{{ $userData->social_avatar }}"  @else "{{ url('upload/no_image.jpg') }}" @endif class="msg-avatar" alt="user avatar">


                                        </div>
                                        <div class="flex-grow-1">

                                            <h6 class="msg-name"> @if(!empty($userData->username)) {{ $userData->username }}@else{{ $userData->name }} @endif <span class="msg-time float-end">{{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</span></h6>
                                            <p class="msg-info">{{ $notification->data['message']}}</p>
                                        </div>
                                    </div>
                                </a>
                                @empty
                                @endforelse

                            </div>
                            <a href="javascript:;">
                                <div class="text-center msg-footer">View All Messages</div>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>


            @php

            $id = Auth::user()->id;
            $adminData = App\Models\User::find($id);

            @endphp


            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ (!empty($adminData->photo)) ? url('upload/admin_images/'.$adminData->photo) : url('upload/no_image.jpg') }}" class="user-img" alt="user avatar">
                    <div class="user-info ps-3">
                        <p class="user-name mb-0">{{ Auth::user()->name }}</p>
                        <p class="designattion mb-0">{{ Auth::user()->username }}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="bx bx-user"></i><span>Profile</span></a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('admin.change.password') }}"><i class="bx bx-cog"></i><span>Change Password</span></a>
                    </li>
                    <li><a class="dropdown-item" href="javascript:;"><i class='bx bx-home-circle'></i><span>Dashboard</span></a>
                    </li>
                    <li><a class="dropdown-item" href="javascript:;"><i class='bx bx-dollar-circle'></i><span>Earnings</span></a>
                    </li>
                    <li><a class="dropdown-item" href="javascript:;"><i class='bx bx-download'></i><span>Downloads</span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('admin.logout') }}"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
<script src="{{ asset('adminbackend/assets/js/jquery.min.js') }}"></script>
<script>

$('#markasread').click(function(){
    $.ajax({
            type:'post',
            url:'/contact/markasread',
            data: {
              _token: '{{csrf_token()}}'
            },
            success:function(response){
                if(response['marked']=="marked"){
                    toastr.success("All contact Notification Marked as Read");
                    $('#contactnotificationcount').html(response['unreadcount']);
                }elseif(response['marked'=="already"]){
                        toastr.info("Notifications marked as read");
                }

            },
            error:function()
            {
                toastr.error('error');

            }
    });
});

</script>
</header>
