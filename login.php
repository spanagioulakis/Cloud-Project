<?php
   include("config.php");
   session_start();
   $errors = array(); 
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT ID,CONFIRMED,ROLE FROM Users WHERE USERNAME = '$myusername'  " ;
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
      
      if($count == 1) {
      $sql = "SELECT ID,CONFIRMED,ROLE FROM Users WHERE USERNAME = '$myusername' and PASSWORD ='$mypassword' " ;
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      $count = mysqli_num_rows($result);
      if($count == 1) {
         if($row["CONFIRMED"]==1){
         $_SESSION['login_user'] = $myusername;
         
         header("location: welcome.php");
      }else{
         array_push($errors, "You have no permision yet");
      }
   }
   else {
       array_push($errors, "Your Login Name or Password is invalid");
        } 
   }else {
      array_push($errors, "User does not exist");
   }
}
?>
 
<html>
   <head>
      <meta charset="utf-8">
      <title>Login</title>
      <link href="style.css" rel="stylesheet" type="text/css">
         <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
   </head>
   <body>
      <div class="login">
         <h1>Login</h1>
           <div style = "font-size:16px; color:#cc0000; margin-top:10px"><?php include('errors.php'); ?></div>
         <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">
               <i class="fas fa-user"></i>
            </label>
            <input type="text" name="username" placeholder="Username" id="username" required>
            <label for="password">
               <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <input type="submit" class="btn btn-primary" value="Login">
            <div style="padding: 25px" > Don't have an account? <a href="signup.php">Sign up now</a>.<div></div> 
         </form>
      </div>
   </body>
</html>

