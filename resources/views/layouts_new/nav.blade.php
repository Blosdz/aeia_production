<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link text-center" href="#">
       @if ($profile && $profile->profile_picture)
            <img src="/storage/{{$profile->profile_picture}}" style="border-radius:100%; width:175px; height:175px;" class="img-fluid" />
        @else
            <img src="/images/user-icon.png" class="img-fluid" style="width: 60%; border-radius:100%;">
        @endif
        <br>
        {{-- {{ $user->name }} --}}
        <br>
        {{-- {!! $badge !!} --}}
        <br>
    </a>
</li>