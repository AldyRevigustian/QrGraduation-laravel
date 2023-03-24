<!DOCTYPE html>
<html>

<head>
</head>

<style>
    @font-face {
        font-family: 'Montserrat-Black';
        src: url({{ storage_path('fonts/Montserrat-Black.ttf') }}) format("truetype");
        font-weight: normal;
        font-style: normal;
        font-variant: normal;
    }

    @font-face {
        font-family: 'Montserrat';
        src: url({{ storage_path('fonts/Montserrat-Medium.ttf') }}) format("truetype");
        font-weight: normal;
        font-style: normal;
        font-variant: normal;
    }

    @page {
        size: 595px 1000px;
        margin: 0 !important;
        padding: 0 !important
    }

    body {
        background-repeat: no-repeat;
        background-size: cover;
        margin: 0px;
    }

    img {
        position: relative;
        top: 330px;
        left: 130px;
        background-color: white;
        padding: 10px;
    }

    .text {
        display: block;
        margin: 0px 50px;
        text-align: center;
        position: relative;
        top: 360px
    }

    .nama {
        margin: 0px;
        padding: 0px;
        font-size: 30px;
        color: #ff66c4;
        font-family: Montserrat-Black;
        line-height: 30px;
    }

    .ket {
        margin: 0px;
        margin-bottom: 5px;
        padding: 0px;
        font-size: 20px;
        color: #ff66c4;
        font-family: Montserrat;
    }
</style>

<body style="background-image: url({{ public_path('bg2.png') }})">
    <div class="gambar">
        <img src="{{ public_path('storage/' . $foto_barcode) }}" alt="" height="320px" width="320px">
    </div>
    <div class="text">
        <p class="ket">
            {{ $nis . ' | ' . $kelas }}
        </p>
        <p class="nama">
            {{ $nama }}
        </p>
    </div>
</body>

</html>
