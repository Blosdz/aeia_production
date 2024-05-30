<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .content {
      text-align: center;
      padding: 20px;
    }
    .purple-background {
      background-color: #2E1D74;
      color: white;
    }
    .button-link {
      display: inline-block;
      padding: 10px 20px;
      font-size: 16px;
      color: white;
      background-color: #2E1D74;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 20px;
    }
    .text-content {
      padding: 20px;
      text-align: center;
      font-size: 16px;
      line-height: 1.5;
    }
    .svg-image {
      width: 100%;
      height: auto;
      max-width: 600px;
    }
  </style>
</head>
<body>
  <table width="40%" cellspacing="0" cellpadding="0">
    <tr>
      <td class="content purple-background">
        <h1>Registro de AEIA</h1>
      </td>
    </tr>
    <tr>
      <td class="content">
        <img src="https://www.cronista.com/files/image/479/479199/6329f3b9eed90.jpg" alt="Team Investing" class="svg-image">
      </td>
    </tr>
    <tr>
      <td class="text-content">
        Nos da un gusto que eligiera a nuestra compañía. Esperamos que pueda generar los ingresos que espera y nos dedicaremos para que esto suceda. Ahora empieza nuestra historia juntos. ¡Bienvenido a AEIA!
        <br><br>
        AEIA se dedica a proporcionar las mejores oportunidades de inversión con un enfoque en la transparencia y el crecimiento sostenible. Creemos firmemente en construir relaciones duraderas con nuestros clientes y ofrecerles las herramientas necesarias para alcanzar el éxito financiero.
        <br><br>
        En las próximas semanas, recibirá información sobre cómo maximizar sus inversiones y acceder a recursos exclusivos. Nuestro equipo de expertos está siempre disponible para asesorarle y resolver cualquier duda que pueda tener. Juntos, trabajaremos para asegurar que cada decisión que tome esté bien informada y alineada con sus objetivos financieros.
        <br><br>
        Gracias por confiar en nosotros. Estamos emocionados de comenzar este viaje con usted y comprometidos a apoyarle en cada paso del camino. ¡Bienvenido a bordo!
      </td>
    </tr>
    <tr>
      <td class="content">
        Confirme su correo dándole click en el siguiente link:
      </td>
    </tr>
    <tr>
      <td class="content">
        <a href="{{config('app.url')}}/confirmation-email/{{$data['token']}}" class="button-link">
          Confirmación email
        </a>
      </td>
    </tr>
  </table>
</body>
</html>

