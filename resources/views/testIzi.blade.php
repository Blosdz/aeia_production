@php
    $username = "87601604";
    $password = "testpassword_CLP3ZmDHZkXBVKbiaEovfJCx6lWHzHpzyErrYIFYWWCN5";
    $header = "Authorization: Basic " . base64_encode($username . ':' . $password);
@endphp

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const url = "https://api.micuentaweb.pe/api-payment/V4/Charge/SDKTest";
        const headers = {
            "Authorization": "{{ $header }}",
            "Content-Type": "application/json"
        };

        const body = {
            "value": "my testing value"
        };

        fetch(url, {
            method: "POST",
            headers: headers,
            body: JSON.stringify(body)
        })
        .then(response => response.json())
        .then(data => {
            console.log("Success:", data);
        })
        .catch(error => {
            console.error("Error:", error);
        });
    });
</script>

