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
                <div class="card">
                    <div class="card-header" style="font-family: Arial, Helvetica, sans-serif">
                        <h5 class="text-center">
                            <span class="badge bg-primary">Sube los archivos que deseas para poder consultar.</span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('file') }}" enctype='multipart/form-data' method="POST" id="enviar_data">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label class="text-center mb-2" style="font-family: Arial, Helvetica, sans-serif">Subir un archivo.</label>
                                <input type="file" name="import_file" id="import_file" class="form-control"
                                    placeholder="Ingresa un archivo">
                            </div>
                            <div class="pt-2">
                                <button class="btn btn-sm btn-success" type="submit">Enviar documento</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function(){
            $("#enviar_data").submit(function(){
                Swal.fire({
                    title: 'Enviando datos...',
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    },
                });
            })
        });
    </script>
</body>

</html>