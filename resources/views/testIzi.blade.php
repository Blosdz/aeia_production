
<head>

<script type="text/javascript"
        src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js"
        kr-public-key="87601604:testpublickey_feXRj9DJp4IFcXyVk6P25ZksbQGTYHobft23o18tjNbPg"
        kr-post-url-success="{{route('izi_pay.success')}}"
        kr-language="en-EN">
 </script>

  <!--  theme NEON should be loaded in the HEAD section   -->
<link rel="stylesheet" href="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/neon-reset.min.css">
<script src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/neon.js">
 </script>
</head>

<div class="kr-smart-form" kr-popin kr-form-token="{{ $formToken ?? '' }}">



<img src="data:image/png;base64,{{$qrCode ?? ''}} " alt="QR Code">



