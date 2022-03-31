<x-layout.standard>
    @slot('title')
        login
    @endslot
    @section('content')
        <script>
            function logout() {
                document.getElementById('logout-form').submit();
            }
        </script>
    @endsection
</x-layout.standard>
