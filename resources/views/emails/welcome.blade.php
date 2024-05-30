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
        <h1>Bienvenido a AEIA</h1>
      </td>
    </tr>
    <tr>
      <td class="content">
        <img src="https://blog.monex.com.mx/hubfs/Conoce-las-inversiones-alternativas-para-potenciar-tu-inversion-P.jpg" alt="Team Investing" class="svg-image">
      </td>
    </tr>
    <tr>
      <td class="text-content">
        ¡Nos alegra darle la bienvenida a AEIA! Nos enorgullece que haya elegido nuestra plataforma para gestionar sus inversiones. En AEIA, nos dedicamos a proporcionarle las mejores oportunidades de inversión y a acompañarlo en cada paso del camino hacia el éxito financiero.
        <br><br>
        Nuestro objetivo es asegurarnos de que tenga una experiencia positiva y rentable con nosotros. Estamos comprometidos a brindarle apoyo continuo, asesoramiento experto y recursos exclusivos que le ayudarán a maximizar sus ganancias.
        <br><br>
        Esperamos que tenga un excelente tiempo con nosotros y estamos aquí para asistirle en todo lo que necesite. Si tiene alguna pregunta o necesita asistencia, no dude en ponerse en contacto con nuestro equipo de soporte.
        <br><br>
        ¡Bienvenido a bordo! Estamos emocionados de comenzar este viaje juntos.
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

