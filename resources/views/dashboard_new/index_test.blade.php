@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">List</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             @include('flash::message')
             <div class="row">


                 <div class="col-lg-12">
                     
                     <div class="card">
                         <div >
                            <div class="card-header">
                                <i class="fa fa-align-justify" id="header_1" onclick="checkloaded(this.id)" ></i>
                                Mis Eventos
                            </div>
                            <div class="card-body" id="body_1" >
                                @include('dashboard.tables.table_mis_eventos')
                            </div>
                         </div>
                     </div>

                     <div class="card">
                         <div >
                            <div class="card-header">
                                <i class="fa fa-align-justify" id="header_2" onclick="checkloaded(this.id)" ></i>
                                Próximos Eventos
                            </div>
                            <div class="card-body" id="body_2" >
                                @include('dashboard.tables.table_futuros')
                            </div>
                         </div>
                     </div>

                     <div class="card">
                         <div >
                            <div class="card-header">
                                <i class="fa fa-align-justify" id="header_3" onclick="checkloaded(this.id)" ></i>
                                Eventos Pasados
                            </div>
                            <div class="card-body" id="body_3" >
                                @include('dashboard.tables.table_pasados')
                            </div>
                         </div>
                     </div>


                  </div>
             </div>
         </div>
    </div>
@endsection


<script type="text/javascript">
    function checkloaded(obj)
    {
        if("header_1" === obj)
        {
            var body = document.getElementById("body_1");
            checkProperty(body);
        }
        
        if("header_2" === obj)
        {
            var body = document.getElementById("body_2");
            checkProperty(body);
        }
        
        if("header_3" === obj)
        {
            var body = document.getElementById("body_3");
            checkProperty(body);
        }
    }
    function checkProperty(body)
    {
        if(body.style.display === 'none')
        {
          body.style.display = "block";
        }
        else{
          body.style.display = "none";
        }
    }
        
</script>