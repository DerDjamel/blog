<?php
include 'header.php';
?>

    
    <section class="blog-posts">
        <h2>Recent Blog Posts</h2>
        <?php
        foreach($posts as $post){
            echo $post->generateMinPost();
        }
        ?>
    </section>
    

<?php
include 'footer.php';
?>