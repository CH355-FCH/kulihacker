<?
$error_regist = '';
$validate     = '';
if( isset($_POST['registe']) ){
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $email    = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $password = md5(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
        $repass   = md5(filter_input(INPUT_POST, 'repassword', FILTER_SANITIZE_STRING));
        if($password == $repass){
                if( cek_nama($username,$conn) == 0 ){
                    $pass   = password_hash($password, PASSWORD_DEFAULT);
                    $query  = "INSERT INTO players (username,email,password) VALUES ('$username','$email','$pass')";
                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        $_SESSION['username'] = $username;
                        #header('Location: ./Login');
                    } else {
                        $error = 'Register User Failed!';
                    }
                }else{
                        $error = 'Username already registered, enter another !';
                }
            }else{
                $validate = 'Wrong Type while you re-entered your password!';
            }
    } 
    function cek_nama($username,$conn){
        $nama = mysqli_real_escape_string($conn, $username);
        $query = "SELECT * FROM players WHERE username = '$nama'";
        if( $result = mysqli_query($conn, $query) ) return mysqli_num_rows($result);
    }
?>

        <div class="card mt-5">
          <div class="card-header">Register Ground</div>
          <div class="card-body">
            <h5 class="card-title">Register & Get Ready</h5>
            <p class="card-text">Just sign-up bellow and continue to sign-in!</p>
            <? if ($error_regist != '') {?> <p class="alert alert-danger"><?=$error_regist;?></p><?}?>
            <? if ($validate != '') {?> <p class="alert alert-danger"><?=$validate;?></p><?}?>
            <form method="POST" action="" class="needs-validation" novalidate>
              <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="UserAlert" required>
                <div class="invalid-feedback">Please enter a username</div>
                <div id="UserAlert" class="form-text">Your username must be a unique one and named like a Hacker</div>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="EmailAlert" required>
                <div class="invalid-feedback">Please enter your email</div>
                <div id="EmailAlert" class="form-text">Don't worry, no spoofer here.</div>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="invalid-feedback">Please enter a password</div>
              </div>
              <div class="mb-3">
                <label for="repassword" class="form-label">Retype Password:</label>
                <input type="password" class="form-control" id="password" name="repassword" required>
                <div class="invalid-feedback">Please re-enter your password</div>
              </div>
              <button type="submit" class="btn btn-primary" name="register" required>Submit</button>
            </form>
            <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
            </script>
          </div>
        </div>