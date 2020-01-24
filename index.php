<?php
//Including Files
include 'helpers/header.php';
$errors = array();

if (isset($_POST['login'])) {
  # Declaring Variables
  $username= mysqli_real_escape_string($connections, $_POST['uname']);
  $password = mysqli_real_escape_string($connections, $_POST['pass']);
  
  # Selecting SQL Query.
  $sql= "select * from users where username = '$username' and password = '$password'";
  $result = mysqli_query($connections, $sql);
  $user = mysqli_fetch_array($result);
  $count = mysqli_num_rows($result);

  // Password Verification
  if ($user['password'] != $password) {
    $errors[] ='Password doesn\'t match in our record, Please try again with correct password';
  }
  // Password Length Verification 
  if (strlen($password) <= 8) {
    $errors[] = 'Password must be at lest 8 character.';
  }
  
  if ($count > 0 && !empty($errors)) {
    # Logging Into The Page
    $_SESSION['success_flash'] = "You Have Successfully Logged In";
    header('Location: welcome.php');
  }
  else{
    # Using Function to Display Various Errors
    ?>
    <div class="alert alert-danger alert-dismissible show" role="alert">
      <?php
      foreach($errors as $e){
        echo '<p>' . $e . '</p>';
      }
      ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>

    </div>
    <?php
    
  }  
}
?>

<!-- This Is the Start of Page and Have Put Header Here -->
<div >
  <h3 class="title">Login Page</h3>
</div>
<!-- This Part is The Beginning Of The Form. -->
  <form action="index.php" method="POST" class="form">
    <div class="form-group row">
    <label for="uname" class="col-sm-2 col-form-label-bg">Username:</label>
    <input type="text" class="name" id="uname" name="uname" required>
    <br>
    </div>
    <div class="form-group row">
    <label for="pass" class="col-sm-2 col-form-label-bg">Password:</label>
    <input type="password" class="pass" id="pass" name="pass" required>
    <br>
    </div>
    <input type="submit" class="btn-login  btn btn-primary" name="login" id="login" value="Login">
    <a href="signup.php" class="btn btn-primary">Sign UP</a>
  </form>

<?php
include 'helpers/footer.php';
?>
