<?php
   include('session.php');
   error_reporting(0);

    
   $sql = "SELECT ROLE,ID FROM Users WHERE USERNAME = '$login_session'";
   $result = mysqli_query($db,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   $id = $row['ID'];
   $active = $row['ROLE'];
   $sql = "SELECT m.TITLE,m.STARTDATE,m.ENDDATE,m.CINENAME,m.CATEGORY ,f.ID FROM Movies m, Favorites f WHERE f.USERID = '$id' AND m.ID = f.MOVIEID";
   $result2 = mysqli_query($db,$sql);
   if ($active == "ADMIN"){
    $role= "Administrator";
 }else if ($active == "USER"){
    $role= "User";
 }else if ($active == "CINEMAOWNER"){
    $role= "Cinema Owner";
 }



   if($id2 = $_POST['removefav']){
    $sql2 = $db->query("DELETE FROM Favorites WHERE ID = '$id2' ");
    header("Refresh:0");
   } 


?>
<script type="text/javascript">
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>


<html>
	<head>
    <meta charset="utf-8">
		<title>Favorites</title>
		<link href="style2.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<style>

button {
width: 100%;
padding: 15px;
margin-top: 20px;
background-color: #fc0000;
border: 0;
cursor: pointer;
font-weight: bold;
color: #ffffff;
transition: background-color 0.2s;
border:1px solid #000000;
display:inline-block;
border-radius: 20px;}
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

       <div style="width: 1100px;
	background-color: #2f3947;
	box-shadow: 0px 14px 80px rgba(34, 35, 58, 0.2);
 	padding: 40px 55px 45px 55px;
  	transition: all .3s;
	border-radius: 20px;
      margin:  50px auto;">
   
     
           
            <table class="Table"></form></div>
<thead>
<tr>
<th>TITLE</th>
          <th>STARTDATE</th>
          <th>ENDDATE</th>
          <th>CINEMANAME</th>
          <th>CATEGORY</th>
          <th></th>
          <th></th>
        </tr>
        </thead>

<tr>
        <?php
       
       while($row = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {
           
          
                ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

       
    
        <tbody>
        <tr>
        <td><input type="text" name="title" value= "<?php echo  $row['TITLE']; ?>" id="id" readonly></td>
           <td><input type="text"  name ="start" value= "<?php echo  $row['STARTDATE']; ?>" id="name" readonly></td>
           <td><input type="text"  name="end" value= "<?php echo  $row['ENDDATE']; ?>" id="surname" readonly></td>
           <td><input type="text"  name="cinemaname" value= "<?php echo  $row['CINENAME']; ?>" id="password"  readonly></td>
           <td><input type="text"  name="category"value= "<?php echo  $row['CATEGORY']; ?>" id="username" readonly></td>
           
                     
                    <form action="" method="post"> 
                    <td>
                        <button class="button"  type="submit" name="removefav" value=<?php echo $row['ID']?> ><i class="fa fa-trash"></i> </button> 
                    </form>                     
                    </td></form>
           </tr>
                    
        </form>
                    
        <?php
                 
                };

                ?>
    
       </tbody>
    
       </table>
</div>
        
    
	
	</body>
</html>


