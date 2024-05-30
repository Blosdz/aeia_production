<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <embed src="{{ asset($document->file_path) }}" type="application/pdf" width="100%" height="600px" />
    </div>

</body>
</html>
