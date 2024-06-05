<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>FileUpload Excel</title>
</head>

<body>

    <div class="container pt-5">
        <div class="row">
            <div class="col-sm-8">
                <form action="{{ route('file') }}" enctype='multipart/form-data' method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <input type="file" name="import_file" class="form-control" placeholder="Ingresa un archivo">
                    </div>
                    <div>
                        <button class="btn btn-sm btn-success" type="submit">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>
</html>