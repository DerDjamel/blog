<?php
include 'header.php';
?>

<section>
    <h2>Log In</h2>
    <form method="post" action="index.php" autocomplete="off">
        <input type="hidden" name="action" value="login">
        <!-- TOKEN -->
        <?php echo Token::generateHtmlToken(); ?>
        <label>E-mail</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button>submit</button>
    </form>
</section>

<?php
include 'footer.php';
?>