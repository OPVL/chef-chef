<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Uh Oh!</title>
    <script src="https://kit.fontawesome.com/d83d45983d.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{ asset('wip/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('wip/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('wip/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('wip/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('wip/site.webmanifest') }}">
</head>

<body>
    <div class="hero">
        <div class="under-construction-otter">
            <i class="fa-solid fa-helmet-safety"></i>
            <i class="fa-solid fa-otter"></i>
        </div>
        <div class="text">
            <div class="subtext">under construction otter apologises for the disruption</div>
            <a class="subtext" href="javascript:back()"><i class="fa-solid fa-caret-left"></i> return to safer
                waters? <i class="fa-solid fa-caret-left"></i></a>
        </div>
    </div>
</body>
<script>
    function back() {
        window.history.back()
    }
</script>
<style>
    * {
        margin: 0;
        padding: 0;
        color: #2E3532;
    }

    body {
        overflow: hidden;
    }

    .hero {
        width: 100vw;
        height: 100vh;
        display: flex;
        align-items: center;
        background: #CAD8DE;
        justify-content: center;
        flex-direction: column;
    }

    .under-construction-otter {
        max-width: 50vw;
        display: flex;
    }

    i.fa-solid.fa-otter {
        font-size: 22vw;
        color: #8F5C38;
    }

    i.fa-solid.fa-helmet-safety {
        font-size: 7vw;
        color: #F7B538;
        position: absolute;
        margin-left: 2%;
        margin-top: -3%;
    }

    .text {
        margin-top: 40px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .subtext {
        font-size: 20px;
        line-height: 2;
        font-family: sans-serif;
        letter-spacing: -0.6px;
        font-weight: 600;
        text-decoration: none;
    }

    a.subtext {
        transition: color ease-in-out 0.1s;
    }

    a.subtext:hover {
        color: #fff;
    }

</style>

</html>
