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
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span id="contactInfoData" class="alert-count">

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
                                    <p class="msg-header-clear ms-auto" id="markasreads">Marks all as read</p>
                                </div>
                            </a>
                            <div class="header-notifications-list" id="contactInfo">

                                @php

                                $user = Auth::user();

                                @endphp

                                @forelse($user->notifications->where('type','!=','App\Notifications\contactNotification')->where('read_at', NULL) as $notification)

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
                            <div class="header-message-list" id="contact-message-lists">
                                @php
                                    $contactnotification= Auth::user()->notifications->where('type','App\Notifications\contactNotification')->where('read_at',null);
                                @endphp
                                @forelse($contactnotification as $notification)
                                @php
                                $userData= App\Models\User::where('id',$notification->data['user_id'])->first();

                            @endphp
                                <a class="dropdown-item" href="javascript:;" >
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
                    console.log(response);
                    toastr.success("All contact Notification Marked as Read");
                    $('#contactnotificationcount').html(response['unreadcount']);
                    $('#contact-message-lists').html('');
                }else if(response['marked']=="already"){
                        toastr.info("No unread notifications");
                }

            },
            error:function()
            {
                toastr.error('error');

            }
    });
});

</script>

<script>
    
$('#markasreads').click(function(){
    $.ajax({
            type:'post',
            url:'/contact/markasreads',
            data: {
              _token: '{{csrf_token()}}'
            },
            success:function(response){
                if(response['marked']=="marked"){
                    console.log(response);
                    toastr.success("All contact Notification Marked as Read");
                    $('#contactInfoData').html(response['unreadcount']);
                    $('#contactInfo').html('');
                }else if(response['marked']=="already"){
                        toastr.info("No unread notifications");
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
