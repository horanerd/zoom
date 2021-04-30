<?php
                require_once 'vendor/autoload.php';
                            

                            use GuzzleHttp\Client;
                            use \Firebase\JWT\JWT;
                            use Source\Model\Zoom;

                

                function getZoomAccessToken() {
                $key = ZOOM_SECRET_KEY;
                $payload = array(
                    "iss" => ZOOM_API_KEY,
                    'exp' => time() + 3600,
                );
                return JWT::encode($payload, $key);    
                }   

                            function createZoomMeeting() {
                $client = new Client([
                            // Base URI is used with relative requests
                            'base_uri' => 'https://api.zoom.us',
                        ]);

                        $response = $client->request('POST', '/v2/users/me/meetings', [
                            "headers" => [
                                "Authorization" => "Bearer " . getZoomAccessToken()
                            ],
                            'json' => [
                                "topic" => "Let's Learn WordPress",
                                "type" => 2,
                                "start_time" => "2021-01-30T20:30:00",
                                "duration" => "30", // 30 mins
                                "password" => "123456"
                            ],
                        ]);

                        $data = json_decode($response->getBody());
                        echo "Join URL: ". $data->join_url;
                        echo "<br>";
                        echo "Meeting Password: ". $data->password;
                    }

                    createZoomMeeting();
                 
                

                //$novo = new Zoom();
                 // echo $novo->create();

                //echo $novo->Signature(ZOOM_API_KEY, ZOOM_SECRET_KEY);

               //$meet = $novo->meeting("Guilherme", "82429182978", "TDhxbjdPckY4TkVRQkZGRUpSUjcvQT09", "0");
                
                ?>
                <!--
                <div class="input-group mb-3">
                   <a href="reuniao/meeting.html?<?= $meet ?>" class="btn btn-primary" type="button"  > Reunião  </a>
                </div>

                </div>
            </div>
        </div>

    </body>
</html>


<---> 

 
