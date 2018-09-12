<?php
include 'header.php';
?>

<section>
    <h2>Register</h2>
    <form method="post" action="index.php" autocomplete="off">
        <input type="hidden" name="action" value="register">
        <!-- TOKEN -->
        
        <label>Firstname</label>
        <input type="text" name="firstName">
        <br>
        <label>Lastname</label>
        <input type="text" name="lastName">
        <br>
        <label>E-mail</label>
        <input type="email" name="email" required>
        <br>
        <label>Password</label>
        <input type="password" name="password" required>
        <br>
        <label>Password again</label>
        <input type="password" name="password_again" required>
        <br>
        <label>BirthDate</label>
        <input type="date" name="birthdate">
        <br>
        <label>Sexe</label>
        <input type="radio" name="sexe" value="male" checked> Male 
        <input type="radio" name="sexe" value="female"> Female
        
        <button>submit</button>
    </form>
</section>

<?php
include 'footer.php';
?>