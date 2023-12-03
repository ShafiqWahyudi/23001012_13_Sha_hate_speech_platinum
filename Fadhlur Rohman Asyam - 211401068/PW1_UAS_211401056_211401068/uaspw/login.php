<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!--link css sendiri-->
    <link rel="stylesheet" href="login.css">

    <!--Google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <title>Log In</title>
</head>

<body>
    
    <section class="login d-flex">
        <div class="login-center w-50 h-100 justify-content-center align-items-center">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-6 tes">
                    <div class="header">
                        <h1>Welcome</h1>
                        <p>Please enter your account.</p>
                    </div>
        
                    <div class="login-form">
                        <form action="aksi_login.php" method="post">
                            <label for="email" class="form-label">Username</label>
                            <input type="text" class="form-control" id="email" placeholder="Enter your email" name="username">
            
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password">
                            <a href="#" class="text-decoration-none text-center">Forgot password?</a>
                            <button class="signin" type="submit">Sign In</button>
                            
                            <div class="text-center">
                                <span class="d-inline">Don't have an account <a href="#" class="signup d-inline text-decoration-none">Sign up for free</a> </span>
                            </div>
                        </form>        
                    </div>
                </div>
            </div>
            
        </div>
        <!-- <div class="login-right w-50 h-100">
            <img src="/img/gamabr 4.png" alt="" srcset="">
        </div> -->
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>