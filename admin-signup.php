<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once './include/head.inc.php'?>
    <title>Admin Signup</title>
</head>
<body style="height: 100vh; display: grid; place-items: center">
    <div class="container-fuild mx-auto border rounded border-2 border-opacity-50 fw-semibold p-5 col-lg-4">
        <form action="./controllers/admin-signup.controller.php" method="POST">
            <input type="hidden" name="type" value="register">
            <div class="mb-3">
                <label for="">First Name</label>
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter first name">
            </div>
            
            <div class="mb-3">
                <label for="">Last Name</label>
                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter last name">
            </div>

            <div class="mb-3">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
            </div>

            <div class="mb-3">
                <label for="">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
            </div>

            <button class="btn btn-warning bg-orange text-white col-12 fw-normal" type="submit" name="submit">Sign Up</button>
        </form>
    </div>
</body>
</html>