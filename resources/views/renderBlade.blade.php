<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Styles -->
    <style>
      body {
        font-family: 'Nunito', sans-serif;
      }
      .red {
        color: #ff0000;
      }
    </style>
  </head>
  <body class="antialiased">
    <div>
        <input type="text">
        <button>Add list</button>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
            @for ($i = 1; $i <= 2; $i++)
                <tr>
                    <td>{{ $i }}</td>
                    <td>name at {{ $i }}</td>
                </tr>
            @endfor
        </table>
    </div>
  </body>
</html>
