<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>register</title>
</head>

<body>
    <form action="{{ route('register.store') }}" method="post">
        @method('PUT')
        @csrf
        <label for="name">name</label>
        <input type="text" name="name" id="name" autocomplete="name">

        <label for="email">email</label>
        <input type="text" name="email" id="email" autocomplete="email">

        <label for="password">password</label>
        <input type="password" name="password" id="password" autocomplete="password">

        <button type="submit">register</button>
    </form>
</body>

</html>
