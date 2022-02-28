<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create storage location</title>
</head>

<body>
    <form action="{{ route('storage-location.store') }}" method="post">
        @method('PUT')
        @csrf
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="name">name</label>
        <input type="text" name="name" id="storage-location-name">

        <button type="submit">save</button>
    </form>
</body>

</html>
