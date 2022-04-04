<x-layout.admin>
    @slot('title')
        select ingredients
    @endslot
    @section('content')
        <div class="selected-ingredients">
            @foreach ($recipe->ingredients as $ingredient)
                <p>{{ $ingredient->name }}</p>
            @endforeach
        </div>
        <div class="add-ingredients">
            <div class="search">
                <input type="text" class="form-controller" id="search" name="search" />
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                    </tr>
                </thead>
                <tbody id="result-ingredients">
                </tbody>
            </table>
            <form class="crud-form wrap-over" action="{{ route('admin.recipe.ingredient.store', $recipe) }}" method="post">
                @csrf
                @method('PUT')
                <div id="selected-ingredients-form">
                </div>
                <div id="selected-ingredients">
                </div>
                <button type="submit">Save</button>
            </form>
        </div>
    @endsection
    @section('scripts')
        <script type="text/javascript">
            function actionButton(name, id) {
                return `<button onclick="javascript:selectIngredient('${name}',${id})">choose</button>`;
            }

            function selectIngredient(name, id) {
                if ($(`p:contains(${name})`).length > 0) {
                    console.log([name, id])
                    return;
                }
                $('#selected-ingredients-form').append(`<input value="${id}" name="ingredient[]" hidden>`);
                $('#selected-ingredients').append(`<p>${name}</p>`);
            }
            $('#search').on('keyup', function() {
                $value = $(this).val();

                $.ajax({
                    type: 'get',
                    url: '{{ route('ajax.ingredient') }}',
                    data: {
                        'query': $value
                    },
                    success: function(results) {
                        let resultInner = '';
                        results.data.forEach(ingredient => {
                            resultInner += "<div class='ingredient-result'>" + ingredient.name +
                                "</div>"
                        });
                        // $('.results').html(resultInner);

                        let tableInner = '';
                        results.data.forEach(ingredient => {
                            tableInner += "<tr>"
                            tableInner += "<td>" + ingredient.id + "</td>"
                            tableInner += "<td>" + ingredient.name + "</td>"
                            tableInner += "<td>" + ingredient.unit + "</td>"
                            tableInner += "<td>" + actionButton(ingredient.name, ingredient.id) +
                                "</td>"
                            tableInner += "</tr>"
                        });
                        $('#result-ingredients').html(tableInner);
                    }
                });
            })
        </script>

        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'csrftoken': '{{ csrf_token() }}'
                }
            });
        </script>
    @endsection
</x-layout.admin>
