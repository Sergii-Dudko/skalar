@extends('/home')

@section('content')

    <style>
        .layer {
            overflow: auto; /* Добавляем полосы прокрутки */
            width: 100%; /* Ширина блока */
            height: 500px; /* Высота блока */
        }

        td select,
        td input {
            width: 150px;
        }

        label {
            display: block;
        }

        .error input,
        .error textarea {
            border: 1px solid red;
        }

        .error {
            color: red;
        }
    </style>

    <!-- Текущие комментарии -->
    @if (count($comments) > 0)
        <div class="container layer">
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <!-- Заголовок таблицы -->
                    <thead class="head">
                    <th>ID</th>
                    <th>Дата</th>
                    <th>Имя</th>
                    <th>Отзыв</th>
                    </thead>
                    <!-- Тело таблицы -->
                    <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <!-- ID Комента -->
                            <td class="table-text">
                                <div>{{ $comment->id }}</div>
                            </td>
                            <!-- Дата время коммента -->
                            <td class="table-text">
                                <div>{{ $comment->date_time_in }}</div>
                            </td>
                            <!-- Имя комментатора -->
                            <td class="table-text">
                                <div>{{ $comment->user_name }}</div>
                            </td>
                            <!-- Текст коммента -->
                            <td class="table-text">
                                <div>{{ $comment->comment }}</div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif


    <form action="{{ url('comments') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <table>
            <tr>
                <td>От кого</td>
                <td>
                    <input name="from" type="text">
                </td>
            </tr>
        </table>
        Сообщение:
        <label>
            <textarea name="message" style="display:block;width:400px;height:80px"></textarea>
        </label>
        <input type="button" onclick="validate(this.form)" value="Отозваться">
    </form>

    <script>
        function showError(container, errorMessage) {
            container.className = 'error';
            var msgElem = document.createElement('span');
            msgElem.className = "error-message";
            msgElem.innerHTML = errorMessage;
            container.appendChild(msgElem);
        }

        function resetError(container) {
            container.className = '';
            if (container.lastChild.className == "error-message") {
                container.removeChild(container.lastChild);
            }
        }

        function validate(form) {
            var elems = form.elements;
            var countErrors = 0;
            resetError(elems.from.parentNode);
            if (!elems.from.value) {
                countErrors++;
                showError(elems.from.parentNode, ' Укажите от кого.');
            }


            resetError(elems.message.parentNode);
            if (!elems.message.value) {
                countErrors++;
                showError(elems.message.parentNode, ' Отсутствует текст.');
            }

            if (!countErrors)
                form.submit();
        }
    </script>


@endsection