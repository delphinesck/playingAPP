<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Playing app</title>
    <link rel="stylesheet" href="styles/reset.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/mediascreen.css">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/mediascreen.css">
    <link rel="stylesheet" href="../../styles/reset.css">
    <link rel="stylesheet" href="../../styles/style.css">
    <link rel="stylesheet" href="../../styles/mediascreen.css">
    <link rel="stylesheet" type="text/css" href="styles/fontawesome-free-5.0.4/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="../styles/fontawesome-free-5.0.4/web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="../../styles/fontawesome-free-5.0.4/web-fonts-with-css/css/fontawesome-all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>

<!-- HEADER -->
<header>
    <div id="header_title">
        Playing app - admin page
    </div>

    <div id="logout">
        <i class="fas fa-sign-in-alt"></i> 
        <span id="logout_text">Logout</span>
    </div>
</header>

<!-- NAVIGATION -->
<nav>
    <div>
        <a href="/WWW/PlayingAPP/API/admin">
        <div class="nav_link">
            <div class="nav_icon active">
                <i class="fa fa-home" aria-hidden="true"></i>
            </div>
            <div class="nav_title active">
                Dashboard
            </div>
        </div>
        </a>
    </div>

    <div class="nav_item">
        <a href="/WWW/PlayingAPP/API/admin/games">
        <div class="nav_link">
            <div class="nav_icon">
                <i class="fa fa-gamepad" aria-hidden="true"></i>
            </div>
            <div class="nav_title">
                Games
            </div>
        </div>
        </a>
    </div>

    <div class="nav_item">
        <a href="/WWW/PlayingAPP/API/admin/attributes">
        <div class="nav_link">
            <div class="nav_icon">
                <i class="fas fa-tags"></i>
            </div>
            <div class="nav_title">
                Attributes
            </div>
        </div>
        </a>
    </div>

    <div class="nav_item">
        <a href="/WWW/PlayingAPP/API/admin/users">
        <div class="nav_link">
            <div class="nav_icon">
                <i class="fa fa-users" aria-hidden="true"></i>
            </div>
            <div class="nav_title">
                Users
            </div>
        </div>
        </a>
    </div>

    <div class="nav_item">
        <a href="/WWW/PlayingAPP/API/admin/forum">
        <div class="nav_link">
            <div class="nav_icon">
                <i class="fa fa-comments" aria-hidden="true"></i>
            </div>
            <div class="nav_title">
                Forum
            </div>
        </div>
        </a>
    </div>

    <div class="nav_item">
        <a href="/WWW/PlayingAPP/API/admin/statistics">
        <div class="nav_link">
            <div class="nav_icon">
                <i class="fas fa-chart-bar"></i>
            </div>
            <div class="nav_title">
                Statistics
            </div>
        </div>
        </a>
    </div>
</nav>