<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>edit {{ $storageLocation->name }}</title>
</head>

<body>
    <form action="{{ route('storage-location.update', $storageLocation) }}" method="post">
        @method('PATCH')
        @csrf
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="name">name</label>
        <input type="text" name="name" id="name" value="{{ $storageLocation->name }}">

        <button type="submit">update</button>
    </form>
</body>

</html>