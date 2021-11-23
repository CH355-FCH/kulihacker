<?
$error_login = '';

if( isset($_POST['login']) ){
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = md5(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
    $query    = "SELECT * FROM players WHERE username = '$username'";
    $result   = mysqli_query($conn, $query);
    $rows     = mysqli_num_rows($result);
    if ($rows != 0) {
      $hash = mysqli_fetch_assoc($result)['password'];
        if(password_verify($password, $hash)){
          $_SESSION['username']   = $username;
          $_SESSION['logged_in']  = true;
        }
      } else {
        $error = 'Login credential is invalid!!';
      }
             
    }
?>

        <div class="card mt-5">
          <div class="card-header">Login Session</div>
          <div class="card-body">
            <h5 class="card-title">Login and Continue Playing</h5>
            <p class="card-text">Just sign-in bellow and hack the challenge!</p>
            <? if ($error_login != '') {?> <p class="alert alert-danger"><?=$error_login;?></p><?}?>
            <form method="POST" action="" class="needs-validation" novalidate>
              <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="UserAlert" required>
                <div class="invalid-feedback">Please enter your own username</div>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="invalid-feedback">Please enter your own password</div>
              </div>
              <button type="submit" class="btn btn-primary" name="login" required>Submit</button>
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