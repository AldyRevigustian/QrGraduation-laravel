<!DOCTYPE html>
<html>

<head>
</head>

<style>
    @page {size: 595px 1000px; margin:0!important; padding:0!important}


    body {
        background-repeat: no-repeat;
        background-size: cover;
        margin: 0px;
    }

    .gambar {
        justify-content: center;
        align-items: center;
    }

    img {
        position: relative;
        top: 330px;
        left: 130px;
        background-color: white;
        padding: 10px;
    }
</style>

<body style="background-image: url({{ public_path('bg.png') }})">
    <div class="gambar">
        <img src="{{ public_path('storage/' . $foto_barcode) }}" alt="" height="320px" width="320px">
    </div>
</body>

</html>
