<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>$title</title>
</head>
<body>
<div>{{$title}}</div>
<div>
    <div>
        <div>
            @if (count($collection) === 0)
                <div class="container px-0" id="table-message">
                    <div class="alert alert-warning" role="alert">
                        <strong>Warning!</strong> No data to display.
                    </div>
                </div>
            @else
                <div>
                    <thead>
                    <tr role="row">
                        @foreach($attributes as $attr)
                            <th>
                                {{ $attr }}
                            </th>
                        @endforeach
                    </thead>
                    <tbody>
                    @foreach ($collection as $item)
                        <tr>
                            @foreach($columns as $column)
                                <td>{{ $item->{$column} }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </div>
            @endif
        </div>
    </div>
</div>
</body>
</html>
