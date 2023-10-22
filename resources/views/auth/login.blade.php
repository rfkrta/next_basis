<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="stylesheet" type="text/css" href="admin/style.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="img">
            <img src="img/1.png">
        </div>
        <div class="login-content">
            <form action="" method="POST">
                @if($errors -> any ())
                <div class="alert">
                    <ul>
                        @foreach($errors -> all() as $item)
                        <li>
                            {{ $item }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @csrf
                <h2 class="title">Login</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Email</h5>
                        <input type="email" value="{{ Session::get('email') }}" name="email" class="input">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>
                <div class="mb-3 d-grid">
                    <button type="submit" name="submit" class="btn">Login</button>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/login.js"></script>
</body>

</html>