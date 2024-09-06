<?php
session_start();
require "../koneksi.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .main {
            height: 100vh;
        }

        .login-box {
            width: 500px;
            height: 300px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box p-5 shadow">
            <form action="" method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div>
                    <button type="submit" class="btn btn-success form-control mt-3" name="login-btn">Login</button>
                </div>
            </form>
            <div class="my-2 text-center">
                <?php
                if (isset($_POST['login-btn'])) {
                    $username = htmlspecialchars(($_POST['username']));
                    $password = htmlspecialchars(($_POST['password']));

                    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
                    $countdata = mysqli_num_rows($query);
                    $data = mysqli_fetch_array($query);

                    if ($countdata>0) {
                        if (password_verify($password, $data['password'])){
                            $_SESSION['username'] = $data['username'];
                            $_SESSION['login'] = true;
                            header('location: index.php');
                        }
                        else{
                            ?>
                        <div class="alert alert-dark" role="alert">
                            Password Salah
                        </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class="alert alert-dark" role="alert">
                            Akun tidak ditemukan
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>