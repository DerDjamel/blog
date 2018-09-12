<?php
include APP_PATH . '/view/header.php';
?>

<section>
    <h2>Edit</h2>
    <form method="post" action="index.php" autocomplete="off">
        <input type="hidden" name="action" value="edit_profile">
        <!-- TOKEN -->
        
        <label>Firstname</label>
        <input type="text" name="firstName" value="<?php echo $user->getFirstName(); ?>" autofocus>
        <br>
        <label>Lastname</label>
        <input type="text" name="lastName" value="<?php echo $user->getLastName(); ?>">
        <br>
        <label>E-mail</label>
        <input type="email" name="email"  value="<?php echo $user->getEmail(); ?>">
        <br>
        <label>Password</label>
        <input type="password" name="password">
        <br>
        <label>Password again</label>
        <input type="password" name="password_again">
        <br>

        <label>Bio : </label>
        <textarea rows="4" cols="50" name="bio">
        <?php echo $user->getBio(); ?>
        </textarea>
        
        <button>submit</button>
    </form>
</section>



<?php
include APP_PATH . '/view/footer.php';
?>