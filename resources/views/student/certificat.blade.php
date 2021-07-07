<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @page {
            margin: 0cm 0cm;
        }



        .size {
            width: 1100px;
            height: 750px;
        }

        img {
            width: 100%;
            height: 100%;
            object-fit: cover
        }

        .centered {
            position: absolute;
            top: 38%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .title {
            position: absolute;
            top: 48%;
            left: 50%;
            width: 950px;
            text-align: center;
            font-size: 25px;
            transform: translate(-50%, -50%);
        }

    </style>
</head>

<body>
    <div class="size">
        <img style="align-items:center;" src="{{ public_path('storage/certificat.jpg') }}">
        <div class="centered" style="font-size: 40px; text-align: center;">
            {{ Auth::user()->name }}
        </div>
        <div class="title">{{ $title }}</div>
    </div>
</body>

</html>
