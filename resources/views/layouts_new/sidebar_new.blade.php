@php
    $user_session = Auth::user();
    $user = Auth::user();
    $user_code = $user->unique_code; 
    $profile = $user->profile;

@endphp
<div class="">
    {{--sidebrand--}}
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon"> 
                <img src="{{URL::asset('/images/dashboard/Logo.png')}}" alt="" class="menu_hidden">
            </div>
        </a>
        {{-- divider --}}
        <hr class="sidebar-divider my-0">
        {{-- image client --}}


        <div class="text-center d-none d-md-block">
            @if ($profile && $profile->profile_picture)
                <div class="user-icon-pfp">
                    <img src="/storage/{{$profile->profile_picture}}" class="img-fluid profile-picture" />
                </div>
            @else 
                <div class="user-icon-pfp">
                    <img src="/images/user-icon.png" class="img-fluid profile-picture" style="width: 45px; border-radius:100%;" />
                </div>
            @endif
            <p class="ms-3 text-white font-weight-bold" style="font-weight:bolder;">
                 {{ $userProfile->first_name ?? 'User' }}
            </p>

        </div>

        <hr class="sidebar-divider my-0">

        @include('layouts_new.menu')

        <li class="nav-item" style="bottom: 0">
            <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span>
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>Log-Out

                </span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>  
        </li>

    </ul>


</div>