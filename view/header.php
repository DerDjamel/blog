<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <link rel="stylesheet" href="<?php echo $relative_path ?>css\normalize.css">
    <link rel="stylesheet" href="<?php echo $relative_path ?>css\style.css">
</head>
    
    <div class="container">
    <header>
        <h1>BLOG</h1>
        <nav>
            <ul>
                <?php if(isset($_SESSION['loggedIn'])):?>
                    <li><a href="<?php $relative_path ?>user">Profile</a></li>
                <?php else: ?>
                    <li><a href="?action=login_v">Log in</a></li>
                    <li><a href="?action=register_v">register</a></li>
                <?php endif; ?>
                
            </ul>
        </nav>
    </header>
<body>
    
