<html>
    <head>
        <title> zoom</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    
                <p>Nome: Guilherme de sousa</p>
                <p>User: Guilherme</p>


                <?php
                require_once 'vendor/autoload.php';
                

                use GuzzleHttp\Client;
                use Source\Model\Zoom;


                $novo = new Zoom();
                //$novo->create(ZOOM_API_KEY, ZOOM_SECRET_KEY);
                
                ?>

                <div class="input-group mb-3">
                   <a href="reuniao" class="btn btn-primary" type="button"  > Reunião  </a>
                </div>

                </div>
            </div>
        </div>

    </body>
</html>




 
