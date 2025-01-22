export async function GetTokenSession(transactionId, {
    requestSource = 'ECOMMERCE',
    merchantCode = '5781017',
    orderNumber = '1736642361',
    publicKey = 'Basic ODc2MDE2MDQ6dGVzdHBhc3N3b3JkX0NMUDNabURIWmtYQlZLYmlhRW92ZkpDeDZsV0h6SHB6eUVycllJRllXV0NONQ==',
    amount = '123',
}) {

    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const response = await fetch('/checkout/token', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken, // Incluye el token CSRF
                'transactionId': transactionId, // Enviar transactionId como encabezado
            },
            body: JSON.stringify({
                requestSource,
                merchantCode,
                orderNumber,
                publicKey,
                amount,
            }),
        });

        if (response.ok) {
            return await response.json();
        } else {
            console.error('Error en la solicitud al backend:', await response.text());
            return {
                response: {
                    token: undefined,
                    error: `Error ${response.status}: ${response.statusText}`,
                },
            };
        }
    } catch (e) {
        console.error('Error al intentar obtener el token:', e);
        return {
            response: {
                token: undefined,
                error: '01_LARAVEL_API',
            },
        };
    }
}
