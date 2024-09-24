    {{-- <link rel="stylesheet" href="{{URL::asset('/newDashboard/app.css')}}"> --}}
    {{-- <div class="sidebar-new"> --}}
        {{-- <nav class="sidebar-new-menu"> --}}
        <div class="toggleul">

            <div class="nav-header d-flex text-align-center align-items-center justify-content-center img-container" id="menu-toggle">
                <img src="{{URL::asset('/images/dashboard/Logo.png')}}" alt="" class="menu_hidden">
            </div>
            <ul class="sidebar-nav items-menu-nav" id="nav-items-link">
                @include('layouts_new.menu')
            </ul>

        </div>


        {{-- </nav> --}}
    {{-- </div> --}}

