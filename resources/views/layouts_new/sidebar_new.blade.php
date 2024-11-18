
@php
    $user_session = Auth::user();
    $user = Auth::user();
    $user_code = $user->unique_code; 
    $profile = $user->profile;

@endphp
<div class="toggleul">

    <div class="nav-header d-flex text-align-center align-items-center justify-content-center img-container" id="menu-toggle">
        <img src="{{URL::asset('/images/dashboard/Logo.png')}}" alt="" class="menu_hidden">
    </div>
    <ul class="sidebar-nav items-menu-nav" id="nav-items-link">
        @include('layouts_new.menu')
    </ul>

</div>
<span>

    <div class="d-flex justify-content-end" style="bottom: 5% ; position: absolute ">
        @if ($profile && $profile->profile_picture)
            <img src="/storage/{{$profile->profile_picture}}" class="img-fluid profile-picture" style="width:45px !important; border-radius:100%;" />
        @else 
            <img src="/images/user-icon.png" class="img-fluid profile-picture" style="width: 45px; border-radius:100%;" />
        @endif
        <p class="ms-3 text-white font-weight-bold" style="font-weight:bolder;">
             {{ $userProfile->first_name ?? 'User' }}
        </p>
    </div>

</span>
