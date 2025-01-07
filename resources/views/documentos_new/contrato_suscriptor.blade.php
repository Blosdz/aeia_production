<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato de Suscriptor</title>
</head>
<style>
    body {
        margin: 20px 10px;
    }
    table,
    th,
    td {
        border: 0px solid;
    }
    .image-container {
        position: absolute;
        z-index: -1; /* Asegura que el contenedor esté por encima de los elementos con menor z-index */
        /* top:-4px; */
        /* top:-1000vw; */
    }

    .overlay-image {
        position: absolute;
        top: -400px; /* Ajusta la posición según sea necesario */
        left: 0; /* Ajusta la posición según sea necesario */
        z-index: -1; /* Asegura que la imagen esté encima del contenido */
    }
    .background-container {
        position: fixed;
        top: -14px;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('{{ public_path("images/dashboard/brand2.png") }}'); /* URL absoluta usando public_path */
        background-size: cover; /* Ajusta la imagen para cubrir el contenedor */
        background-position: center; /* Centra la imagen */
        opacity: 0.1; /* Ajusta la opacidad */
        z-index: -1; /* Asegura que la imagen esté detrás del contenido */
    }

    .date{
        position: fixed;
        top:3px;
        right:20px;
        font-size:14px;
        font-weight:bold;
    }

    p,
    td {
        text-align: justify;
    }
    .footer-table {
        position: absolute;
        bottom: 90%;
        width: 100%;
    }

    .signature-left {
        text-align: left;
        border-top: 1px solid;
        /* bottom: 50vw; */
        padding-left: 20px; /* Ajusta si necesitas más separación */
    }

    .signature-right {
        text-align: right;
        /* bottom: 50vw; */
        border-top: 1px solid;
        padding-right: 20px; /* Ajusta si necesitas más separación */
    }

    .signature-img {
        /* bottom: 40vw; */
        width: 300px; /* Ajusta el tamaño de la imagen si es necesario */
        height: 200px;
        bottom: -8%;
        z-index: -1;
        position:relative;
        /* top: -300000vw; */
        /* bottom: -45555px; */
    }
</style>
<body>
    <div class="date">{{$timestamp}}</div>
    <div class="background-container"></div>
    <p>
        Conste por el presente Contrato para Administración de Capital, que celebran de una parte AEIA INVESTMENT E.I.R.L. identificado con RUC Nº 20608381741, provincia y departamento de Arequipa país Perú, a quien en adelante se le denominará LA EMPRESA; y de otra parte el Sr(a) {{ $profile->name . $profile->lastname}}, con DNI Nº {{}}, con domicilio fiscal {{$donde_vive}}, {{$distrito}}, provincia y departamento de {{$country}}, a quien en lo sucesivo se le denominará EL SUSCRIPTOR. El presente contrato, se celebra en los términos y condiciones siguientes:
    </p>
    <p><u><b>PRIMERA: ANTECEDENTES</b></u></p><br>

    <table>
        <tr>
            <td>1.1</td>
            <td><b>EL SUSCRIPTOR</b> </td>
        </tr>
    </table>


</body>
</html>
