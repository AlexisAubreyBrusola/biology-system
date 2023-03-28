<?php
session_start();
require_once '../config/dbConn.config.php';
require_once '../models/user.model.php';
require_once '../controllers/login.controller.php';

$db = new DBConn;
$model = new User($db);
$controller = new Login($model);

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($controller->adminLogin($email, $password)) {
        // Redirect to dashboard page if login successful
        header('Location: ../view/dashboard.php');
        exit;
    } 
    else {
        // Display error message if login failed
        $errorMessage = "Invalid email or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '../include/head.inc.php'?>
    <title>Login</title>
    <style>
        main {
            background-color: #fff;
        }

        h1 {
            font-size: 2rem;
        }
        
        .system-name {
            text-shadow: 2px 4px 3px rgba(0,0,0,0.3);
        }

        .login-form-section {
            display: grid;
            place-items: center;
        }

        .photo-logo-section {
            background-image: url("../assets/images/bu-bg1.jpg");
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
        }

        .grid-center {
            display: grid;
            place-items: center;
        }
    </style>
</head>
<body>
    <main class="row g-0" style="height: 100vh;">
        <section class="login-form-section col-lg-6">
            <div class="container g-0 form-grup col-lg-6">
                <h1 class="fw-bold fs-32 mb-5 text-center">Login</h1>

                <!-- Show when there's an error -->
                <?php if (isset($errorMessage)) { ?>
                    <div class="invalid-mssg container fw-semibold text-center py-3 mb-3" style="font-size: 1rem; color: #EEEEEE;">
                        <?php echo $errorMessage; ?>
                    </div>
                <?php } ?>

                <form action="./login.view.php" method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="email"><i class="fa-solid fa-user"></i></span>
                        <input type="email" name="email" id="email" class="form-control border-2" placeholder="Email" aria-label="email" aria-describedby="email" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="key-icon"><i class="fa-solid fa-key"></i></span>
                        <input type="password" name="password" id="password" class="form-control border-2 fw-normal"placeholder="Password" aria-label="password" aria-describedby="password" required>
                        <button class="input-group-text border-2" type="button" id="show-password"><i class="fa-solid fa-eye" id="eye-icon"></i></button>
                    </div>

                    <button class="btn btn-warning bg-orange text-white col-12 fw-normal" type="submit" name="submit">Login</button>
                </form>
            </div>
        </section>

        <section class="photo-logo-section col-lg-6 grid-center">
            <div class="logo mx-auto grid-center">
                <img src="../assets/images/bu-logo1.png" alt="bicol university logo" class="logo" style="max-width: 60%; max-height: 60%">
                <h1 class="system-name text-center fw-bold px-5" style="color: black">BUCS Natural Science Laboratory & Instrumentation Office Borrowing System</h1>
            </div>
        </section>
    </main>

    <script>
        const passwordInput = document.getElementById('password');
        const showPasswordBtn = document.getElementById('show-password');

        showPasswordBtn.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                showPasswordBtn.innerHTML = '<i class="fa-solid fa-eye-slash"></i>'
            } else {
                passwordInput.type = 'password';
                showPasswordBtn.innerHTML = '<i class="fa-solid fa-eye" id="eye-icon">';
            }
        })
    </script>

    <?php include_once '../include/footer.inc.php' ?>
</body>
</html>