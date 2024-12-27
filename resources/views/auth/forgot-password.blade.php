<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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


        .forgot-password-container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .forgot-password-container h1 {
            font-size: 1.8rem;
            color: #333333;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            font-size: 0.9rem;
            color: #555555;
            margin-bottom: 0.5rem;
        }

        input[type="email"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        input[type="email"]:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 4px rgba(0, 123, 255, 0.25);
        }

        .btn-submit {
            background-color: #007bff;
            color: #ffffff;
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            width: 100%;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .alert {
            display: none;
            margin-top: 1rem;
            padding: 0.75rem;
            font-size: 0.9rem;
            border-radius: 4px;
            text-align: center;
        }

        .alert.success {
            .alert {
                padding: 15px;
                margin: 15px 0;
                border: 1px solid transparent;
                border-radius: 4px;
            }

            .alert-success {
                color: #155724;
                background-color: #d4edda;
                border-color: #c3e6cb;
            }

            .alert-danger {
                color: #721c24;
                background-color: #f8d7da;
                border-color: #f5c6cb;
            }

        }

    </style>
</head>

<body>
    <div class="d-flex flex-column justify-content-center w-100 h-100">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="forgot-password-container" style="max-width: 400px;">
                <center><img
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8gdNrKPyr4qIaNuam3hHx6AUZorfCJlUeKQ&s"
                        alt="" width="30%"></center>
                <br>
                <h1>Forgot Password</h1>
                <form action="/forgot-password" method="POST" id="forgotPasswordForm">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="sr-only">Masukkan Email Anda:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i> <!-- Ikon email -->
                                </span>
                            </div>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Masukkan email yang terdaftar" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
                    <div class="text-end mt-2">
                        <a href="/login">Sudah Forgot Password !</a>
                    </div>
                </form>

                <!-- SweetAlert2 script -->
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <script>
                    document.getElementById('forgotPasswordForm').addEventListener('submit', function (e) {
                        e.preventDefault(); // Prevent the form from submitting the traditional way

                        let email = document.getElementById('email').value;

                        // Perform AJAX request to send the reset link
                        fetch('/forgot-password', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    email: email
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Display success alert
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Sukses!',
                                        text: data.success,
                                        showConfirmButton: true
                                    });
                                } else {
                                    // Display error alert
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: data.error || 'Terjadi kesalahan, coba lagi nanti.',
                                        showConfirmButton: true
                                    });
                                }
                            })
                            .catch(error => {
                                // Handle any network errors or unexpected issues
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Terjadi kesalahan jaringan. Coba lagi nanti.',
                                    showConfirmButton: true
                                });
                            });
                    });

                </script>
            </div>
        </div>
    </div>
</body>

</html>
