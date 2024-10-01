@php
    $verified_list = [0=>'En validacion', 1=>'Informacion enviada', 2=>'Validado', 3=>'Rechazado'];
    $user_type=[ 1=>'admin',2=>'suscriptor',3=>'cliente',4=>'business',5=>'gerente',6=>'verificador'];
@endphp
<!-- <div class="app-content w-100"> -->

    <div class="app-content-actions">
        <input class="search-bar" placeholder="Search..." type="text" value="{{ request('search') }}">
        <div class="app-content-actions-wrapper">
            <div class="filter-button-wrapper">
            <button class="action-button filter jsFilter"><span>Filter</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg></button>
            <div class="filter-menu">
                <label>Category</label>
                <select id="userTypeFilter">
                    <option value="">All Categories</option>
                    @foreach ($user_type as $key => $type)
                        <option value="{{ $key }}" {{ request('userType') == $key ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>

                <label>Status</label>
                <select id="statusFilter">
                    <option value="">All Status</option>
                    @foreach ($verified_list as $key => $status)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>

                <div class="filter-menu-buttons">
                    <button class="filter-button reset" id="resetFilter">
                        Reset
                    </button>
                    <button class="filter-button apply" id="applyFilter">
                        Apply
                    </button>
                </div>
            </div>


            </button>
            </div>
        </div>
    </div>

    <div class="product-area-wrapper tableView">
        <div class="products-header">
            <div class="product-cell">Nombres</div>
            <div class="product-cell">Estado</div>
            <div class="product-cell">Rol</div>
            <div class="product-cell">Documento</div>
            <div class="product-cell">Accion</div>
            <div class="product-cell">Mas Información</div>
        </div>

        @foreach($profiles as $profile)
        <div class="products-row">
                <div class="product-cell">{{$profile->first_name . ' ' . $profile->lastname}}</div>
                @if($profile->verified == 2)
                        <div class="product-cell status-cell">
                            <div class="status active">Verificado</div>
                        </div>
                    @elseif( $profile->verified == 0)
                        <div class="product-cell status-cell">
                            <div class="status disabled">Sin datos</div>
                        </div>
                    @elseif($profile->verified==1)
                        <div class="product-cell status-cell">
                            <div class="status sent">Validar</div>
                        </div>
                    @elseif($profile->verified==3)
                        <div class="product-cell status-cell">
                            <div class="status refused">Rechazado</div>
                        </div>
                @endif
                <div class="product-cell">
                    {{$user_type[$profile->user->rol]}}
                </div>           
                <div class="product-cell">{{$profile->identification_number}}</div>
                <div class="product-cell">
                    <div class='btn-group'>
                        <a href="{{ route('profiles.edit', [$profile->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit d-flex text-align-center align-items-center justify-content-center  "></i></a>
                        <a href="{{ route('rejectionHistory', [$profile->user_id]) }}" class='btn btn-ghost-info'><i class="fa fa-file d-flex text-align-center align-items-center justify-content-center  "></i></a>
                        <!-- agregado mas no funcional -->
                        <form action="{{ route('deleteUser', [$profile->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-ghost-info">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="product-cell">
                    <div class="btn">
                        @if ($profile->user->rol == 3) <!-- admin -->
                            <a href="{{ route('data_user', [$profile->user_id]) }}">
                                <i class="fa-solid fa-plus"></i>
                            </a>
                        @elseif ($profile->user->rol == 2) <!-- suscriptor -->
                            <a href="{{ route('data_suscriptor', [$profile->user_id]) }}">
                                <i class="fa-solid fa-plus"></i>
                            </a>
                        @elseif ($profile->user->rol == 5) <!-- gerente -->
                            <a href="{{ route('data_gerente', [$profile->user_id]) }}">
                                <i class="fa-solid fa-plus"></i>
                            </a>
                        @endif
                    </div>

                </div>


        </div>
        @endforeach
    </div>
<!-- </div> -->

{{--!
<div class="table-responsive-sm">
    <table class="table table-striped" id="profiles-table">
        <thead>
            <tr>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Pais Emisor</th>
        <th>Tipo de documento</th>
        <th>Fecha Nacimiento</th>
        <th>Nacionalidad</th>
        <th>Estado</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($profiles as $profile)
            <tr>
            <td>{{ $profile->first_name }}</td>
            <td>{{ $profile->lastname }}</td>
            <td>{{ $profile->country_document }}</td>
            <td>{{ $profile->type_document }}</td>
            <td>{{ $profile->birthdate }}</td>
            <td>{{ $profile->nacionality }}</td>
            <td>{{ $verified_list[$profile->verified] }}</td>
            @php
            if (auth()->user()->rol !== 5){
            @endphp
            <td>
                <div class='btn-group'>
                    <a href="{{ route('profiles.edit', [$profile->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit d-flex text-align-center align-items-center justify-content-center  "></i></a>
                    <a href="{{ route('rejectionHistory', [$profile->user_id]) }}" class='btn btn-ghost-info'><i class="fa fa-file d-flex text-align-center align-items-center justify-content-center  "></i></a>
                </div>
            </td>
            </tr>
            @php
            }
            @endphp

            @php
            if(auth()->user()->rol === 5){ //gestor
            @endphp
            <td>
                <div class='btn-group'>
                    <a href="{{ route('profiles.show', [$profile->id]) }}" class='btn btn-ghost-info'><i class="fa fa-eye"></i></a>
                </div>
            </td>
            @php
            }
            @endphp
        @endforeach
        </tbody>
    </table>
</div>
--}}