<?php
   include("session.php");
// We need to use sessions, so you should always start sessions using the below code.
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['login_user'])) {
	header('Location: index.html');
	exit;
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.


 $sql = "SELECT PASSWORD,EMAIL,ROLE FROM Users WHERE USERNAME = '$login_session ' " ;
 $result = mysqli_query($db,$sql);
 $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
 $email= $row["EMAIL"];
 $password= $row["PASSWORD"];

?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile</title>
		<link href="style2.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<style>
    ul {
        padding: 15px;
        list-style: none;
        background: #2f3947;
        
    }
    ul li {
        display: inline-block;
        position: relative;
        line-height: 21px;
        text-align: left;
        background: #2f3947;

    }
    ul li a {
        display: block;
        padding: 8px 25px;
        color: #fff;
        text-decoration: none;
        background: #2f3947;
        position: relative;
       right: 10px;

    }
    ul li a:hover {
        color: #fff;
        background: #2f3947;
       align-items: right; 
	 
          }
    ul li ul.dropdown {
        min-width: 100%; /* Set width of the dropdown */
        background: #2f3947;
        display: none;
        position: absolute;
        z-index: 999;
        left: 0;

    }
    ul li:hover ul.dropdown {
        display: block; /* Display the dropdown */
    }
    ul li ul.dropdown li {
        display: block;

    }
</style>
	</head>
	<body  class="loggedin"> 

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
       
   
		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['login_user']?>(<?=$_SESSION['user_type'] ?>)</td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>