<?php
include 'header.php';
echo $post->generatePost();
?>

<section class="comments">
    <h2>COMMENTS</h2>
    <?php
    foreach($comments as $comment){
        echo $comment->generateComment();
    }
    ?>
</section>



<?php
include 'footer.php';
?>