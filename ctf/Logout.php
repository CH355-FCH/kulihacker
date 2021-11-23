<?
  if( isset($_POST["logout"]) ){
    session_destroy();
  }
?>
<p class="text-danger">Logged Out!</p>