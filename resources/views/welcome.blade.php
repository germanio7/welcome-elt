<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome English Language Teaching</title>

    <link rel="icon" type="image/jpeg" href="{{asset('./welcome.jpeg')}}" />

    <link href="{{mix('/css/main.css')}}" rel="stylesheet">

    <script src='https://meet.jit.si/external_api.js' defer></script>
</head>

<body class="bg-gray-100">
    <nav class="flex items-center justify-between flex-wrap bg-gradient-to-r from-red-500 to-blue-500 p-6">
        <div class="flex items-center flex-shrink-0 text-white mr-6">
            <img src="./welcome.jpeg" class="rounded-full fill-current h-8 w-8 mr-2" width="54" height="54" alt="img">
            <span class="font-semibold text-xl tracking-tight">Welcome ELT</span>
        </div>
    </nav>
    <div class="container m-auto p-auto flex justify-center m-4 p-4">
        <div class="w-full max-w-xs">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Contraseña Sala
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="contraseña" type="password" placeholder="Password">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Nombre de Usuario
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="name" type="text" placeholder="User Name">
                </div>
                @php
                $room = Str::random(30);
                @endphp
                <div class="flex items-center justify-center">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="button" onclick="iniciar()">
                        Iniciar Videollamada
                    </button>
                </div>
            </div>
            <p class="text-center text-gray-500 text-xs">
                &copy;2020 Welcome English Language Teaching - Powered Jitsi
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
            var sala = @json($room);
            var name = document.getElementById('name');
            var contraseña = document.getElementById('contraseña');
            var jitsi = document.getElementById('jitsi-container');
            var ancho = 1000;
            var alto = 800;
            if (screen.width <= 640) {
                ancho = 300;
                alto = 400;
            } else if(screen.width <= 768){
                ancho = 700;
                alto = 600
            }
            jitsi.scrollIntoView();
            var options = {
                "roomName": sala,
                "parentNode": container,
                "width": ancho,
                "height": alto,
                userInfo: {
                    displayName: name.value
                }
            };
            api = new JitsiMeetExternalAPI(domain, options);

            api.addEventListener('participantRoleChanged', function(event) {
            if (event.role === "moderator") {
                    api.executeCommand('password', contraseña.value);
                }
            });

            api.addEventListener('readyToClose', function(e){
                api.dispose();
                contraseña.value='';
                name.value='';
                location.reload();
            });
        }
    
</script>

</html>