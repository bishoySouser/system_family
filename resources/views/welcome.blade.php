<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        {{-- css --}}
        <link rel="stylesheet" href="css/app.css">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <div id='app'>
           
                <div class="container-fluid">
                    
                    {{-- <div class='sidebar bg-danger position-fixed' style='width:20%; height: 100vh;'>
                        <ul>
                            <li>home</li>
                            <li>home</li>
                            <li>header</li>
                        </ul>
                    </div> --}}
                    <div class='row'>
                        <ul class="nav col-2 flex-column position-fixed bg-danger p-3" style='height: 100%; left:0'>
                            <a class="navbar-brand" href="#">
                                <img src="data:image/png;base64,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" width="30" height="30" alt="">
                                <span>Brand</span>
                            </a>
                            <hr>
                            <li class="nav-item">
                              <a class="nav-link active" href="#">Active</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="#">Link</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                            </li>
                          </ul>
                        <div class='col-10 offset-2 content-body'>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                            content body<br>
                        </div>
                    </div>
                </div>
                
          
        </div>
        {{-- js --}}
        <script src="js/app.js" charset="utf-8"></script>

    </body>
</html>
