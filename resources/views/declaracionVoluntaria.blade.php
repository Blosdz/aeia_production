<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato de administración de capital</title>
</head>
<style>
    body{
        margin:20px 10px;
    }
    table, th, td {
         border: 0px solid;
     }
  
</style>
<body>

    <div class="" style="text-align: center"> <b>  DECLARACION VOLUNTARIA DE ORIGEN DE FONDOS</b> </div>   

    <p>Yo {{$profile->first_name}}, de nacionalidad {{$profile->country_document}} identificado con documento de identidad Nº {{$profile->identification_number}}, 
        @if($user->rol==4)
        en calidad de GERENTE GENERAL de la empresa XXXXXXXXXX identificado con RUC Nº xxxxxxxxxx, inscrita en la partida N° xxxxxxxx del Registro de Personas Jurídicas de xxxxxxxxxx; 
        @endif
        en calidad de EL MANDANTE manifiesto en calidad de declaración jurada lo siguiente: </p> 


    <table>
        <tr>
            <td>a)</td>
            <td> 
                Mis recursos provienen de la actividad lícita y/o están vinculadas al giro normal de mis actividades. Por lo anterior, dichos recursos no proceden de ningún tipo de actividad ilícita de las que se encuentran contempladas en la legislación penal peruana. <br> Asimismo, declaro que los fondos estarán destinados en la adquisición de criptomonedas y otros activos digitales previo consentimiento.
            </td>
        </tr>
        <tr>
            <td>b)</td>
            <td>
                No he efectuado en mi provecho, ni en provecho de terceros, operaciones comerciales ni de ninguna otra naturaleza en las que se haya visto involucrada la ejecución de actividades ilícitas de las que se encuentran contempladas en la legislación penal peruana.
            </td>
        </tr>
        <tr>
            <td>c)</td>
            <td>
                Las comisiones y otros desembolsos que se originan por las obligaciones del contrato suscritos con EL COMISIONISTA no proceden de ningún tipo de actividad ilícita de las que se encuentran contempladas en la legislación penal peruana. Dichos desembolsos se efectuarán de manera directa y con mis recursos, vinculados al giro normal de mis actividades y no a través de terceros, ni con recursos diferentes a los propios.
            </td>
        </tr>
        <tr>
            <td>d)</td> 
            <td>
                En la ejecución del presente contrato suscritos con EL COMISIONISTA, no tendré ninguna relación contractual, comercial o de cualquier naturaleza con terceros que realicen negociaciones o cuyos recursos provengan de actividades ilícitas de las que se encuentran contempladas en la legislación penal peruana.
            </td>
        </tr>
        <tr>
            <td>e)</td>
            <td>
                Si llego a tener conocimiento de algunas de las situaciones descritas en los puntos anteriores, me comprometo a comunicarlos de inmediato a EL COMISIONISTA en un plazo no mayor a cuarenta y ocho (48) horas por medios electrónicos.
            </td>
        </tr>
        <tr>
            <td>f)</td>
            <td>
                EL COMISIONISTA está facultada para efectuar las verificaciones que considere pertinentes en las diferentes fuentes de consultas existentes para efectos de corroborar que EL MANDANTE no cometa ningún tipo de actividad ilícita.
            </td>
        </tr>
    </table>


    <p> <b>Arequipa. {{\Carbon\Carbon::now()->format('d')}} de {{\Carbon\Carbon::now()->format('m')}} del  {{\Carbon\Carbon::now()->format('Y')}}</b></p> <br>

    <table style="text-align: center">
        <tr>
            <td width="5%"></td>
            <td width="40%" style="border-top: 1px solid">
                <b>EL MANDANTE</b>
            </td>
            <td width="5%"></td>
        </tr>
    </table>

</body>