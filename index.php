<?php
                require_once 'vendor/autoload.php';
                            

                            use GuzzleHttp\Client;
                            
                            use Source\Model\Zoom;

                

                
                $novo = new Zoom(ZOOM_API_KEY, ZOOM_SECRET_KEY);
                // $novo->create("Video aula 1", "2021-05-22T18:30:00");

                //echo $novo->Signature(ZOOM_API_KEY, ZOOM_SECRET_KEY);

               $meet = $novo->meeting("Guilherme", "82429182978", "TDhxbjdPckY4TkVRQkZGRUpSUjcvQT09", "0");
                
                ?>
                <html>
                <head>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" >
                </head>
                <body>
                
                <div class="input-group mb-3">
                   <a href="reuniao/meeting.html?<?= $meet ?>" class="btn btn-primary" type="button"  > Reunião  </a>
                </div>

                </div>
            </div>
        </div>

    </body>
</html>




 
