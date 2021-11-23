<?
session_start();
require('db_xon.php');
$web_title    = 'KuliCTF';
$web_desc     = 'A challenge  game to learn hacking and test human\'s natural intelligence';
$ptitle       = 'BattleGround';
$servername   = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://'.$_SERVER["HTTP_HOST"];
?>
<!doctype html>
<html lang="en" class="theme-hack">
<head>
 <meta charset="utf-8">
 <title><?=$ptitle." - ".$web_title;?></title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="<?=$web_desc;?>">
 <meta name="robots" content="index,nofollow">
 
 <!-- JQuery -->
 <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
 
 <!-- Style -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
 <link rel="stylesheet" href="<?=$servername;?>/ctf/custom.css" type="text/css">
</head>
<body>
  <div class="container-fluid">
    <header>
      <h5><a class="navbar-brand" href="#"><?=$web_title?></a></h5>
      <script>
        function setTheme(themeName) {
            localStorage.setItem('theme', themeName);
            document.documentElement.className = themeName;
        }

        function toggleTheme() {
            if (localStorage.getItem('theme') === 'theme-crack') {
                setTheme('theme-hack');
            } else {
                setTheme('theme-crack');
            }
        }

        (function () {
            var slide = document.getElementById('slider');
            if (localStorage.getItem('theme') === 'theme-crack') {
                setTheme('theme-crack');
                slide.checked = false;
            } else {
                setTheme('theme-hack');
                slide.checked = true;
            }
        })();
      </script>
      <label id="switcher" class="switcher mt-3">
        <input type="checkbox" onchange="toggleTheme()" id="slider">
        <span class="slider round"></span>
      </label>
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
        </li>
        <li class="nav-item">
          <button class="nav-link" id="challenge-tab" data-bs-toggle="tab" data-bs-target="#challenge" type="button" role="tab" aria-controls="challenge">Challenges</button>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Join</a>
          <ul class="dropdown-menu">
            <li><button class="dropdown-item" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab">Login</button></li>
            <li><button class="dropdown-item" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab">Register</button></li>
          </ul>
        </li>
      </ul>
    </header>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <script>
        $(document).ready(function(){
          $.getJSON("data.json", function(data){
            var logo = `<div class="card mt-3">
              <img src=`+data.home.theLogo+`" class="card-img-top" alt="Logo">
            </div>`;
            $('#home').append(logo);
            $.each(data.home.content, function(key, value){
              var datas = `<div class="card mt-3 mb-3">
                <div class="card-header">`+value.headerContent+`</div>
                <div class="card-body">
                  <h5 class="card-title">`+value.cardTitle+`</h5>
                  <p class="card-text">`+value.textParagraf+`</div>
                </div>
              </div>`;
              $('#home').append(datas);
            });
          });
        });
        </script>
      </div>
      <div class="tab-pane fade show" id="challenge" role="tabpanel" aria-labelledby="challenge-tab">
        <div id="app-challenge"></div>
      </div>
      <script>
      $(document).ready(function (){
        $.getJSON('data.json', function(data){
          var appchall = '';
          $.each(data.category, function(key, cat){
            appchall += `<div class="card">
              <div class="card-header text-center app-challenge">`+key.toUpperCase()+`</div>
            </div>
            <div class="row">`;
            $.each(cat, function(cat, challenge){
              appchall += `<a class="link-challenge" href="#`+challenge[0]+`"><div class="col-md-3">
                <figure class="text-center">
                  <blockquote class="blockquote title-challenge">
                    <p>`+challenge[0]+`</p>
                  </blockquote>
                  <figcaption class="blockquote-footer poin-challenge">`+challenge[1]+`</figcaption>
                </figure>
              </div></a>`;
            });
            appchall += '</div>';
            $('#app-challenge').append(appchall);
          });
        });
      });
      </script>
      <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab">
        <? require('Login.php'); ?>
      </div>
      <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
        <? require('Register.php') ?>
      </div>
    </div>
   </div>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>