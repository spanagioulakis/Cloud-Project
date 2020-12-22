<?php
   include("session.php");
// We need to use sessions, so you should always start sessions using the below code.
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['login_user'])) {

	header('Location: index.html');
	exit;
}
if ($_SESSION['user_type']!= "ADMIN") {
    
    header('Location: badrequest.php');


}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.


 $sql = "SELECT PASSWORD,EMAIL,ROLE FROM Users WHERE USERNAME = '$login_session ' " ;
 $result = mysqli_query($db,$sql);
 $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
 $email= $row["EMAIL"];
 $password= $row["PASSWORD"];
 $query = mysqli_query($db, "SELECT * FROM Users") or die (mysqli_error($db));


 if(isset($_POST['button'])) {
    // username and password sent from form 
    $id=$_POST['button'];
    $username = mysqli_real_escape_string($db,$_POST['username']);
    $password = mysqli_real_escape_string($db,$_POST['password']); 
    $name = mysqli_real_escape_string($db,$_POST['name']);
    $surname = mysqli_real_escape_string($db,$_POST['surname']); 
    $email = mysqli_real_escape_string($db,$_POST['email']); 
    $role = mysqli_real_escape_string($db,$_POST['role']); 
    $SQL= $db->query( "UPDATE  Users SET ID= '$id', NAME= '$name',SURNAME= '$surname',USERNAME= '$username', PASSWORD= '$password',EMAIL= '$email', ROLE='$role' WHERE ID ='$id'"  );
 
     header ("Refresh:0") ;

     
    }

    if(isset($_POST['Confirm'])) {
        // username and password sent from form 
        $id=$_POST['Confirm'];
        $sql2 = $db->query("UPDATE Users SET CONFIRMED = 1 WHERE ID = '$id'");
        header("Refresh:0");
        }


    if(isset($_POST['Delete'])) {
            // username and password sent from form 
            $id=$_POST['Delete'];
          $role = $_POST["role"];
         if ($role == "CINEMAOWNER"){
           $sql2 = $db->query("DELETE FROM Movies WHERE CINEMANAME = (SELECT NAME FROM Cinemas WHERE OWNERID ='$id')");
           $sql = $db->query("DELETE FROM Cinemas  WHERE OWNERID = '$id' ");   
     
        }

    $sql2 = $db->query("DELETE FROM Users WHERE ID = '$id'");
    header("Refresh:0");
   } 

   if(isset($_POST['Search'])){
    $search = mysqli_real_escape_string($db,$_POST['susername']);
 
    $query = mysqli_query($db,"SELECT * FROM Users WHERE USERNAME = '$search ' " )or die (mysqli_error($db));;
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

}
    if(isset($_POST['Show'])){
         $query = mysqli_query($db,"SELECT * FROM Users " )or die (mysqli_error($db));;
         $result = mysqli_query($db,$sql);
         $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

}


?>
<html>
	<head>
    <meta charset="utf-8">
		<title>Home Page</title>
		<link href="style2.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<style>
            .bt2 {
	box-shadow: 0px 0px 0px 2px #3274d6;
	background:linear-gradient(to bottom, #3274d6 5%, #3274d6 100%);
	background-color:#3274d6;
	border-radius:20px;
	border:2px solid #000000;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	text-decoration:none;
	text-shadow:0px 1px 0px #3274d6;
	display: flex;
	justify-content: center;
	align-items: center;
	width: 20%;
	float: left;
	padding: 6px;
	margin-top: 8px;
	margin-right: 0px;
	font-size: 17px;
	border: none;
	cursor: pointer;
	display: flex;
	justify-content: center;
	align-items: center;

	
	
    }
    .bt3 {
	box-shadow: 0px 0px 0px 2px #3274d6;
	background:linear-gradient(to bottom, #3274d6 5%, #3274d6 100%);
	background-color:#3274d6;
	border-radius:20px;
	border:2px solid #000000;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	text-decoration:none;
	text-shadow:0px 1px 0px #3274d6;
	display: flex;
	justify-content: center;
	align-items: center;
	width: 100%;
	float: left;
	padding: 6px;
	margin-top: 8px;
	margin-right: 0px;
	font-size: 17px;
	border: none;
	cursor: pointer;
	display: flex;
	justify-content: center;
	align-items: center;

	
	
    }


    </style>
	</head>
    <body   class="loggedin"> 

<title>Show Hide Dropdown Using CSS</title>
   
    	<ul>
        <li><a href="#"><i class="fas fa-bars"></i> MENU  ▾</a>
            <ul class="dropdown">
            <li><a href="welcome.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
            <li><a href="Favorites.php"><i class="fa fa-star" aria-hidden="true"></i> Favorites</a></li>
            <li><a href="movies.php"><i class="fa fa-film" aria-hidden="true"></i> Movies</a></li>
            <li><a href="owner.php"><i class="fa fa-user" aria-hidden="true"></i> Owners</a></li>
            <li><a href="administration.php"><i class="fa fa-user-shield" aria-hidden="true"></i> Admin</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a></li>


          </ul></li>
           
        	<nav class="navtop">
<div>
					<h1>Cinema Manager</h1>

				<a href="profile.php"><i class="fas fa-user-cog"></i><?=$_SESSION['login_user'] ?>(<?=$_SESSION['user_type'] ?>)</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
	
       </div></nav></ul></li></ul>

       <div style="width: 1780px;
	background-color: #2f3947;
	box-shadow: 0px 14px 80px rgba(34, 35, 58, 0.2);
 	padding: 40px 55px 45px 55px;
  	transition: all .3s;
	border-radius: 20px;
      margin:  50px auto;">

      <div class=container2>
       <form action="" method="post">
            <button class="bt3" type="submit" name="Show" > Show All </button> 
            </form></div>

            <div class="container">
            <form action="" method="post">
            <label for="username"><i class="fas fa-search"></i> </label>
            <input type="text" name="susername" placeholder="Search By Username" required>
            <button class="bt2" type="submit" name="Search" >Search</button> 
            </form></div>
           
           
           
            <table class="Table"></form></div>
<thead>
<tr>
          <th>ID</th>
          <th>NAME</th>
          <th>SURNAME</th>
          <th>USERNAME</th>
          <th>PASSWORD</th>
          <th>EMAIL</th>
          <th>ROLE</th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
        </thead>

<tr>
        <?php
        while ($row = mysqli_fetch_array($query)) {
          
                ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

       
    
        <tbody>
        <tr>
           <td><input type="text" name="id" value= "<?php echo  $row['ID']; ?>" id="id" required></td>
           <td><input type="text"  name ="name" value= "<?php echo  $row['NAME']; ?>" id="name" required></td>
           <td><input type="text"  name="surname" value= "<?php echo  $row['SURNAME']; ?>" id="surname" required></td>
           <td><input type="text"  name="username"value= "<?php echo  $row['USERNAME']; ?>" id="username" required></td>
           <td><input type="text"  name="password" value= "<?php echo  $row['PASSWORD']; ?>" id="password"  required></td>
           <td><input type="text"  name="email"value= "<?php echo  $row['EMAIL']; ?>" id="email"  required></td>
           <td><select name="role" id="role" value= "<?php echo  $row['ROLE']; ?>" required>
            <option value= "<?php echo  $row['ROLE']; ?>" selected><?php echo  $row['ROLE']; ?></option>
            <option value="USER" >USER</option>
            <option value="ADMIN ">ADMIN</option>
            <option value="CINEMAOWNER">CINEMAOWNER</option>
            </select> </td>
            <td>
                      <?php
                  if ( $row['CONFIRMED'] == 1){
                      echo "<div class='txt'>CONFRIRMED!</div>";
                  }else{
                      $data = $row['ID'];?>
                        
                    <form method="post"> 
                    
                        <button class="bt" type="submit" name="Confirm" value=<?php echo $data?>>Confirm </button>      </td>
                    </form> 
                    <?php };
                    
                    $data = $row['ID'];?>
                 

        
            <td><button class="bt" type="submit" value="<?php echo  $data ?>" name='button'>Save </button>  </td>

           <?php
                      
                  
                  $data = $row['ID'];?>
                    
                  
                
                  <td><button class="button"type="submit" name="Delete" value=<?php echo $data?>><i class="fa fa-trash"></i> </button> 
                                     
                  </td></tr>
                    
        </form>
                    
        
       <?php };?>
       </tbody>
    
       </table>
</div>
        
    
	
	</body>
</html>


