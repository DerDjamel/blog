<?php
include APP_PATH . '/view/header.php';
?>

<header class="user-header">
    <h2><?php   echo $user->getName(); ?> Profile</h2>
    <p><?php    echo $user->getBio(); ?></p>
    
    <nav>
        <ul>
            <li><a href="?action=edit_profile_v">Edit Profile</a></li>
            <li><a href="?action=delete_profile">Delete Profile</a></li>
            <li><a href="?action=add_post">Add Post</a></li>
            <li><a href="?action=logout">Log out</a></li>
        </ul>
    </nav>
</header>


<section class="my-posts">
    <h2>My Posts</h2>
    <?php
        foreach($posts as $post){
            echo $post->generateMinPost();
        }
    ?>
</section>



<?php
include APP_PATH . '/view/footer.php';
?>