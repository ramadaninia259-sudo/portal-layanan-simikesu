<?php

session_start();

if (isset($_SESSION['admin_login']) && $_SESSION['admin_login'] === true) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    /*
    |-----------------------------------------------------------
    | AKUN ADMIN
    |-----------------------------------------------------------
    */

    $admin_username = 'admin';
    $admin_password = 'admin123';

    if (
        $username === $admin_username &&
        $password === $admin_password
    ) {

        $_SESSION['admin_login'] = true;
        $_SESSION['admin_username'] = $username;

        header('Location: index.php');
        exit;

    } else {

        $error = 'Username atau password salah.';

    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login Admin - SI MIKE SU</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <style>

        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f4f7fb;
            font-family: Arial, sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            background: #ffffff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
        }

        .logo-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0d47a1;
            color: white;
            font-size: 30px;
        }

        .title {
            color: #0d47a1;
            font-weight: 700;
            text-align: center;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            color: #6c757d;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 600;
        }

        .btn-login {
            width: 100%;
            background: #0d47a1;
            border: none;
            color: white;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-login:hover {
            background: #083b88;
            color: white;
        }

    </style>

</head>

<body>

    <div class="login-card">

        <div class="logo-icon">
            <i class="bi bi-speedometer2"></i>
        </div>

        <h2 class="title">
            SI MIKE SU
        </h2>

        <p class="subtitle">
            Login Admin Panel
        </p>


        <?php if ($error !== ''): ?>

            <div
                class="alert alert-danger"
                role="alert"
            >
                <i class="bi bi-exclamation-circle me-2"></i>
                <?= htmlspecialchars($error) ?>
            </div>

        <?php endif; ?>


        <form
            method="POST"
            action=""
        >

            <div class="mb-3">

                <label
                    for="username"
                    class="form-label"
                >
                    Username
                </label>

                <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    placeholder="Masukkan username"
                    required
                    autofocus
                >

            </div>


            <div class="mb-4">

                <label
                    for="password"
                    class="form-label"
                >
                    Password
                </label>

                <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >

            </div>


            <button
                type="submit"
                class="btn btn-login"
            >

                <i class="bi bi-box-arrow-in-right me-2"></i>

                Login

            </button>

        </form>

    </div>

</body>

</html>