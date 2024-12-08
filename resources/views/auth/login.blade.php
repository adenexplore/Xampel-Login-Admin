<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Aplikasi</title>
    <link rel="icon" href="{{ asset('adminlte/img/iconlg.png') }}" type="image/gif" sizes="16x16">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .kotak_login {
            border: 0;
            width: 350px;
            background: white;
            border-radius: 9px;
            margin: 50px auto;
            padding: 30px 20px;
            border: 1px solid #e2e2e2;
        }

        .form_login {
            background: rgb(255, 255, 255);
            margin: 10px auto;
            border: 1px solid #e2e2e2;
            box-sizing: border-box;
            border-radius: 5px;
            width: 100%;
            padding: 14px 10px;
            font-size: 11pt;
        }

        .tombol_login {
            background: #C40C0C;
            color: white;
            font-size: 11pt;
            width: 100%;
            margin: 9px auto;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            font-weight: bold;
        }

        .tombol_login[type="submit"]:hover {
            background: #FF0000;
        }

        .password-container {
            position: relative;
        }

        #password {
            width: 100%;
        }

        #togglePassword {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 1.2em;
        }

        .login-container {
            width: 300px;
            /* adjust as needed */
            margin: 0 auto;
        }

        .input-container {
            position: relative;
            margin-bottom: 15px;
        }

        .input-container i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #aaa;
            /* adjust color as needed */
        }

        .input-container input {
            padding-left: 30px;
            /* adjust padding to make room for the icon */
        }

        .email-container i {
            left: 10px;
            /* position icon for email input */
        }

        .password-container i {
            left: 10px;
            /* position icon for password input */
            right: 10px;
            /* position eye icon for password input */
        }

        .password-container .fa-eye {
            cursor: pointer;
        }

    </style>
</head>

<body>
    <div class="d-flex flex-column justify-content-center w-100 h-100">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="kotak_login">
                <form action="postlogin" method="POST">
                    @csrf
                    <div class="login-container">
                        <div class="input-container email-container">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" class="form_login" placeholder="name@gmail.com" required>
                        </div>
                        <div class="input-container password-container">
                            <i class="fas fa-lock"></i>
                            <input id="password" type="password" name="password" class="form_login"
                                placeholder="password" required>

                            <p id="togglePassword" class="fas fa-eye"></p>
                        </div>
                        <button type="submit" class="tombol_login">Login</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.getElementById("togglePassword").addEventListener("click", function () {
            var passwordInput = document.getElementById("password");
            var toggleIcon = document.getElementById("togglePassword");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        });

    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
