<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글내용</title>
</head>
<body class="bg-blue-300">
    <div class="container p-5">
    <h3 class="text-2xl mb-5">글내용</h3>
        {{ $data->content }}
    </div>
</body>
</html>