<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <script src='https://meet.jit.si/external_api.js'></script>
    </head>
    <body>
        <div class="container m-auto p-auto flex justify-center m-4 p-4">
        <div class="w-full max-w-xs">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                  Room Name
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="sala" type="text" placeholder="Room Name">
              </div>
              <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                  Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="contraseña" type="password" placeholder="******">
              </div>
              <div class="flex items-center justify-center">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" onclick="iniciar()">
                  Start
                </button>
              </div>
            </div>
            <p class="text-center text-gray-500 text-xs">
              &copy;2020 Test Jitsi
            </p>
          </div>
        </div>

        <div class="container m-auto p-auto flex justify-center m-4 p-4">
            <div id="jitsi-container"></div>
        </div>
    </body>

    <script>
        function iniciar(){
            var container = document.getElementById('jitsi-container');
            var domain = "meet.jit.si";
            var sala = document.getElementById('sala');
            var contraseña = document.getElementById('contraseña');
            var options = {
                "roomName": sala.value,
                "parentNode": container,
                "width": 800,
                "height": 600,
                userInfo: {
                    email: 'german@mail.com',
                    displayName: 'german'
                },
                devices: {
                    audioInput: '<deviceLabel>',
                    audioOutput: '<deviceLabel>',
                    videoInput: '<deviceLabel>'
                },
            };
            api = new JitsiMeetExternalAPI(domain, options);

            api.addEventListener('participantRoleChanged', function(event) {
            if (event.role === "moderator") {
                    api.executeCommand('password', contraseña.value);
                }
            });

            api.addEventListener('readyToClose', function(e){
                api.dispose();
                sala.value='';
                contraseña.value='';
            });
        }
    
    </script>
</html>
