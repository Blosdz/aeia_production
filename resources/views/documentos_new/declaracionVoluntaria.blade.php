<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato de administración de capital</title>
</head>
<style>
    .date{
        position: fixed;
        top:3px;
        right:20px;
        font-size:14px;
        font-weight:bold;
    }
    .image-container {
        position: absolute;
        z-index: -1; /* Asegura que el contenedor esté por encima de los elementos con menor z-index */
        /* top:-4px; */
        /* top:-1000vw; */
    }
    .signature-img {
        /* bottom: 40vw; */
        width: 300px; /* Ajusta el tamaño de la imagen si es necesario */
        height: 200px;
        /* bottom: -8%; */
        z-index: -1;
        position:relative;
        /* top: -300000vw; */
        /* bottom: -45555px; */
    }
    body {
        margin: 20px 10px;
    }

    table,
    th,
    td {
        border: 0px solid;
    }

    .background-container {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('{{ public_path("images/dashboard/brand2.png") }}'); /* URL absoluta usando public_path */
        background-size: cover; /* Ajusta la imagen para cubrir el contenedor */
        background-position: center; /* Centra la imagen */
        opacity: 0.1; /* Ajusta la opacidad */
        z-index: -1; /* Asegura que la imagen esté detrás del contenido */
    }


    p,
    td {
        text-align: justify;
    }

    .center-text {
        text-align: center;
    }
</style>

<body>
    <div class="date">{{$timestamp}}</div>
    <div class="background-container"></div>
    <div class="" style="text-align: center"> <b> DECLARACION VOLUNTARIA DE ORIGEN DE FONDOS</b> </div>

    <p>Yo {{ $profile->first_name }}, de nacionalidad {{ $profile->country_document }} identificado con documento de
        identidad Nº {{ $profile->identification_number }},
        en calidad de EL MANDANTE manifiesto en calidad de declaración jurada lo siguiente:
    </p>


    <table>
        <tr>
            <td>a)</td>
            <td>
                Mis recursos provienen de la actividad lícita y/o están vinculadas al giro normal de mis actividades.
                Por lo anterior, dichos recursos no proceden de ningún tipo de actividad ilícita de las que se
                encuentran contempladas en la legislación penal peruana. <br> Asimismo, declaro que los fondos estarán
                destinados en la adquisición de criptomonedas y otros activos digitales previo consentimiento.
            </td>
        </tr>
        <tr>
            <td>b)</td>
            <td>
                No he efectuado en mi provecho, ni en provecho de terceros, operaciones comerciales ni de ninguna otra
                naturaleza en las que se haya visto involucrada la ejecución de actividades ilícitas de las que se
                encuentran contempladas en la legislación penal peruana.
            </td>
        </tr>
        <tr>
            <td>c)</td>
            <td>
                Las comisiones y otros desembolsos que se originan por las obligaciones del contrato suscritos con EL
                COMISIONISTA no proceden de ningún tipo de actividad ilícita de las que se encuentran contempladas en la
                legislación penal peruana. Dichos desembolsos se efectuarán de manera directa y con mis recursos,
                vinculados al giro normal de mis actividades y no a través de terceros, ni con recursos diferentes a los
                propios.
            </td>
        </tr>
        <tr>
            <td>d)</td>
            <td>
                En la ejecución del presente contrato suscritos con EL COMISIONISTA, no tendré ninguna relación
                contractual, comercial o de cualquier naturaleza con terceros que realicen negociaciones o cuyos
                recursos provengan de actividades ilícitas de las que se encuentran contempladas en la legislación penal
                peruana.
            </td>
        </tr>
        <tr>
            <td>e)</td>
            <td>
                Si llego a tener conocimiento de algunas de las situaciones descritas en los puntos anteriores, me
                comprometo a comunicarlos de inmediato a EL COMISIONISTA en un plazo no mayor a cuarenta y ocho (48)
                horas por medios electrónicos.
            </td>
        </tr>
        <tr>
            <td>f)</td>
            <td>
                EL COMISIONISTA está facultada para efectuar las verificaciones que considere pertinentes en las
                diferentes fuentes de consultas existentes para efectos de corroborar que EL MANDANTE no cometa ningún
                tipo de actividad ilícita.
            </td>
        </tr>
    </table>


    <p><b> Arequipa {{ $declaracion->created_at->format('d')  }} del mes de {{ $months[$declaracion->created_at->format('n')] }} del {{$declaracion->created_at->format('Y') }}.</b></p><br>

    <?php
        $path2 = storage_path('app/public/' . $declaracion->signature_image); // Ajusta la ruta si es necesario
        
        if (file_exists($path2)) {
            $type2 = pathinfo($path2, PATHINFO_EXTENSION);
            $data2 = file_get_contents($path2);
            $base642 = 'data:image/' . $type2 . ';base64,' . base64_encode($data2);
        } else {
            $base642 = null; // Si no existe la imagen, evita errores
        }
    ?>

    <table style="text-align: center">
        
        <tr>
            <td width="5%">
            </td>
            <td width="40%">
                <img src="<?php echo $base642; ?>" alt="Firma del Cliente" class="signature-img">
            </td>
        </tr>
        <tr>
            <td width="5%"></td>
            <td width="40%" style="border-top: 1px solid">
                <b>EL MANDANTE</b> <br>
                <b>{{$profile->first_name}} {{$profile->lastname}}</b><br>
                <b>{{$profile->identification_number}}</b>
            </td>
            <td width="5%"></td>
        </tr>
    </table>

</body>
