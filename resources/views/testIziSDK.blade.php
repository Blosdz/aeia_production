<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IziPay Payment</title>
    <script src="https://sandbox-checkout.izipay.pe/payments/v1/js/index.js"></script>
</head>
<body>
    <h2>Payment Form</h2>

    <button id="payButton">Pagar</button>

    <script>
        document.getElementById('payButton').addEventListener('click', function () {
            // Realizar la solicitud al backend para obtener el Token de Sesión
            fetch('{{ route('izi_pay_token') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                const iziConfig = {
  config: {
    transactionId: '{TRANSACTION_ID}',
    action: 'pay',
    merchantCode: '{MERCHANT_CODE}',
    order: {
      orderNumber: '{ORDER_NUMBER}',
      currency: 'PEN',
      amount: '1.50',
      processType: 'AT',
      merchantBuyerId: '{MERCHANT_CODE}',
      dateTimeTransaction: '1670258741603000',
    },
    billing: {
      firstName: 'Juan',
      lastName: 'Wick Quispe',
      email: 'jwickq@izi.com',
      phoneNumber: '958745896',
      street: 'Av. Jorge Chávez 275',
      city: 'Lima',
      state: 'Lima',
      country: 'PE',
      postalCode: '15038',
      documentType: 'DNI',
      document: '21458796',
    }
  },
};


                try {
                    const checkout = new Izipay({ config: iziConfig });

                    // Mostrar el formulario de pago
                    checkout.LoadForm({
                        authorization: data.token, // El token de sesión devuelto por el backend
                        keyRSA: 'testpublickey_feXRj9DJp4IFcXyVk6P25ZksbQGTYHobft23o18tjNbPg',
                        callbackResponse: (response) => {
                            console.log('Pago exitoso:', response);
                            alert('Pago realizado con éxito');
                        }
                    });
                } catch ({ Errors, message, date }) {
                    console.error('Error en IziPay:', { Errors, message, date });
                }
            })
            .catch(error => {
                console.error('Error al obtener el token:', error);
            });
        });
    </script>
</body>
</html>

