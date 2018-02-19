<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Playing app</title>
        <link rel="stylesheet" href="styles/reset.css">
        <link rel="stylesheet" href="styles/login.css">
        <link rel="stylesheet" type="text/css" href="styles/fontawesome-free-5.0.4/web-fonts-with-css/css/fontawesome-all.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
    <body>

        <div id="login_box">

            <form id="form_login" action="AdminLoginService" method="post">
                <h2>Administration page</h2>
                <label>Username</label>
                <input type="text" name="username">

                <label>Password</label>
                <input type="password" name="password">

                <input type="submit" value="Login">
            </form>

        </div>

    <script src="jquery-3.2.1.min.js"></script>
    </body>
</html>