<?php
include 'helpers/header.php';

if ($_POST) {
    # Declaring Variables for Database
    $username= mysqli_real_escape_string($connections, $_POST['uname']);
    $password= mysqli_real_escape_string($connections, $_POST['pass']);
    $cpassword = mysqli_real_escape_string($connections, $_POST['cpass']);
    $email= mysqli_real_escape_string($connections, $_POST['email']);
    $name= mysqli_real_escape_string($connections, $_POST['fname']);

    // Validating SignUp Form
    if (empty($username)) {
        $errors[] = "Must Enter A Proper Username.";
    }
    if (strlen($password) < 8) {
        $errors[] = "Password Must be 8 or More Characters";
    }
    if ($password != $cpassword) {
        $errors[] = "Comfirm Password And Password Doesn't Match.";
    }


    // Checking if user Already Exists

    $cusr = "SELECT * FROM users WHERE username = '$username' and email = '$email'";
    $result = mysqli_query($connections, $cusr);
    $usercheck = mysqli_fetch_assoc($result);

    # If user Exists
    if ($usercheck['username'] == $username) {
        $errors[] =  "Username Already Exists.";
    }

    # if Email Exists
    if ($usercheck['email'] == $email) {
        $errors[] =  "Email Already Exists.";
    }
    # Adding User To Datababse

    if (empty($errors)) {
        $sql = "INSERT INTO users SET name = '$name', username = '$username', password = '$password', email = '$email'";
        mysqli_query($connections, $sql);
        $_SESSION['success_flash'] = 'Congrats! You have Successfully Become a Member.';
		header('Location: welcome.php');
    }
    else{
        ?>
        <div class="error">
          <?php
          foreach($errors as $e){
            echo '<p>' . $e . '</p>';
          }
          ?>
        </div>
        <?php
        
      }

}

?>


<!-- Sign UP Title -->
<div>
    <h2 class="title">Sign UP</h2>
</div>
<!-- This is the beggining of the signup page form -->
<form action="signup.php" method="POST" class="form">
    <div class="form-group">
        <label for="fname" class="col-sm-2 col-form-label-bg">Full Name:</label>
            <input type="text" id="fname" name="fname" class="name" placeholder="Full Name">
    </div>
    <div class="form-group">
        <label for="uname" class="col-sm-2 col-form-label-bg">Username:</label>
        <input type="text" id="uname" class="name" name="uname" required>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-2 col-form-label-bg">Email:</label>
        <input type="email" id="email" name="email" class="name">
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-2 col-form-label-bg">Password:</label>
        <input type="password" class="" id="pass" name="pass" required>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-2 col-form-label-bg">Confirm Password:</label>
        <input type="password" class="name" id="cpass" name="cpass" required>
    </div>
    <div>
        <input type="submit" class="btn-login btn btn-primary" name="signup" id="signup" value="Sign Up">
        <p>Already A Member <a href="index.php" class="back">Login</a></p>
    </div>
</form>

<?php
include 'helpers/footer.php';
?>