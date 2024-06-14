@extends('layouts_new.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Invitar a nuevos usuarios</div>

                <div class="card-body">
                    <p>Invita a nuevos usuarios utilizando el siguiente enlace:</p>
                    <div class="form-group">
                        <input type="text" class="form-control" id="inviteLink" value="{{ $inviteLink }}" readonly>
                    </div>
                    <button class="btn btn-primary" onclick="copyToClipboard('#inviteLink')">Copiar Enlace</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).val()).select();
        document.execCommand("copy");
        $temp.remove();
        alert("Enlace copiado al portapapeles.");
    }
</script>
@endsection

