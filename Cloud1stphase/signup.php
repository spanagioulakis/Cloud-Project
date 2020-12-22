
<?php
   include("config.php");
     $errors = array();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $username = mysqli_real_escape_string($db,$_POST['username']);
      $password1 = mysqli_real_escape_string($db,$_POST['password1']); 
      $password2 = mysqli_real_escape_string($db,$_POST['password2']); 
      $name = mysqli_real_escape_string($db,$_POST['name']);
      $surname = mysqli_real_escape_string($db,$_POST['surname']); 
      $email = mysqli_real_escape_string($db,$_POST['email']); 
      $role = mysqli_real_escape_string($db,$_POST['ROLE']); 


      if(!empty($name) && !empty($surname) && !empty($email) && !empty($username) && !empty($password1)&& !empty($password2)&& !empty($role)){

         $emailCheck = $db->query( "SELECT * FROM Users WHERE EMAIL = '$email' ");
         $rowCount = mysqli_num_rows($emailCheck);

         if($rowCount==0){
            $usernameCheck = $db->query( "SELECT * FROM Users WHERE USERNAME = '$username' ");
            $rowCount = mysqli_num_rows($usernameCheck);

            if($rowCount==0){

               if($password1==$password2){
                  $SQL= $db->query( "INSERT INTO  Users (NAME,SURNAME,USERNAME, PASSWORD, EMAIL,ROLE,CONFIRMED ) 
                  VALUES ( '$name', '$surname', '$username', '$password1', '$email', '$role', '0')");
                  if($role=="CINEMAOWNER"){
                     $cinemaname=$_POST['cinemaname'];
                     $SQL= $db->query( "INSERT INTO  Cinemas (OWNER,NAME ) 
                     VALUES ( '$username', '$cinemaname')");
                  }
                  header("location: login.php");

        }else{
            array_push($errors, "Passwords don't match");
         }

            }else{
            array_push($errors, "Username already exists");
         }

            
         }else{
            array_push($errors, "Email already exists");
         }


      }else{
            array_push($errors, "Please fill in all the fields!");
         }

   }
?>

<html>
   <head>
      <meta charset="utf-8">
      <title>Sign Up</title>
      <link href="style.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
   </head>
   <body>
      <div class="login">
         <h1>Sign Up</h1>
           <div style = "font-size:16px; color:#cc0000; margin-top:10px"><?php include('errors.php'); ?></div>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <label for="username">
               <i class="fas fa-user"></i>
            </label>
            <input type="text" name="name" placeholder="Name" id="username" required>
          <label for="username">
               <i class="fas fa-user"></i>
            </label>
            <input type="text" name="surname" placeholder="Surname" id="username" required>

           <label for="username">
               <i class="fas fa-user"></i>
            </label>
            <input type="text" name="username" placeholder="Username" id="username" required>
              <label for="password">
               <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password1" placeholder="Password" id="password" required>
              <label for="password">
               <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password2" placeholder="Confirm Password" id="password" required>
           <label for="username">
               <i class="fas fa-envelope"></i>
            </label>
            <input type="text" name="email" placeholder="Email" id="username" required>

            <label for="ROLE"> <i class="fas fa-users"></i></label><br/>
            
            <select name="ROLE" id="role" onchange="changeFunc();" required>
            <option value=""></option>
            <option value="USER">USER</option>
            <option value="ADMIN ">ADMIN</option>
            <option value="CINEMAOWNER">CINEMAOWNER</option>
            </select><br/><br />
         
         
            <input type="text" name="cinemaname" placeholder="Cinema Name" class="form-control" style="display: none" id="cinema" >


            <script type="text/javascript">
            function changeFunc() {
            var selectBox = document.getElementById("role");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            if (selectedValue=="CINEMAOWNER"){
                  $('#cinema').show();
            }
            else {
               $('#cinema').hide();
            }
                  }
</script>


   
             <input type="submit" class="btn btn-primary" value="Submit">
            <div style="padding: 25px" > Already have an account?  <a href="login.php">Login here</a>.<div></div> 
         </form>
      </div>
   </body>
</html>
