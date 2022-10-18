<?php require_once('function.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Form</title>
</head>
<body>
<div class="container">
  <form id="contact" action="" method="post" enctype="multipart/form-data">
    <h3>Registraion Form</h3>
    <h4>Please fill required fields</h4>
    <?php 
     if(isset($_SESSION['msg'])){ echo $_SESSION['msg'];
        unset($_SESSION['msg']); unset($_SESSION); session_destroy(); } ?>
    <fieldset>
      <input placeholder="Your name*" name="name" type="text" tabindex="1"  autofocus value="<?php if(isset($_SESSION['name'])) echo $_SESSION['name']; ?>">
      <?php if(isset($_SESSION['name_err'])){ echo $_SESSION['name_err']; unset($_SESSION['name_err']); } ?>
    </fieldset>
    <fieldset>
      <input placeholder="Your Email Address*" name="email" type="email" tabindex="2" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email']; ?>">
      <?php if(isset($_SESSION['eamil_err'])){ echo $_SESSION['eamil_err']; unset($_SESSION['eamil_err']); } ?>
    </fieldset>
    <fieldset>
      <input placeholder="Your Phone Number (optional)" name="mobile" type="tel" tabindex="3" value="<?php if(isset($_SESSION['mobile'])) echo $_SESSION['mobile']; ?>">
    </fieldset>
    <fieldset>
      <label><input type="radio" name="gender" value="Male" tabindex="4">Male </label>
      <label><input type="radio" name="gender" value="Female" tabindex="4">Female </label>
      <?php if(isset($_SESSION['gender'])){ echo $_SESSION['gender']; unset($_SESSION['gender']); } ?>
    </fieldset>
    <fieldset>
      <input placeholder="Your Password*" type="password" name="password" tabindex="4" value="<?php if(isset($_SESSION['password'])) echo $_SESSION['password']; ?>">
      <?php if(isset($_SESSION['password_err'])){ echo $_SESSION['password_err']; unset($_SESSION['password_err']); } ?>
    </fieldset>
    <fieldset>
      <input type="file" name="image" tabindex="4">
      <?php if(isset($_SESSION['image_err'])){ echo $_SESSION['image_err']; unset($_SESSION['image_err']); } ?>
    </fieldset>
    <fieldset>
      <button name="submit" type="submit" id="contact-submit" value="SaveData" data-submit="...Sending">Submit</button>
    </fieldset>
    <p class="copyright">Designed by <a href="# target="_blank" title="Shatrudhan kumar">Shatrudhan kumar</a></p>
  </form>
</div>
</body>
</html>
