<?php
   include("session.php");
   error_reporting(0);
// We need to use sessions, so you should always start sessions using the below code.
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['login_user'])) {

	header('Location: index.html');
	exit;
}
if ($_SESSION['user_type']!= "CINEMAOWNER") {
    
    header('Location: badrequest.php');


}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$sql = "SELECT OWNER,NAME FROM Cinemas WHERE OWNER = '$login_session '   " ;
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$cinema=$row["NAME"];
$owner=$row["OWNER"];

 $sql = "SELECT PASSWORD,EMAIL,ROLE FROM Users WHERE USERNAME = '$login_session ' " ;
 $result = mysqli_query($db,$sql);
 $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
 $email= $row["EMAIL"];
 $password= $row["PASSWORD"];


 $query2 = mysqli_query($db, "SELECT * FROM Movies WHERE CINENAME LIKE '%$cinema%' " ) or die (mysqli_error($db));

 $start  = $_POST["start"];
 $end = $_POST["end"];
 
 if(isset($_POST['button'])) {
  
    $id=$_POST['button'];
    $title = $_POST["title"];
    $start      = $_POST["start"];
    $sqlstart = date("Y-m-d H:i:s",strtotime($startd));
    $end         = $_POST["end"];
    $sqlend =date("Y-m-d H:i:s",strtotime($endd));
    $category  = $_POST["category"];
    $sql2 = $db->query("UPDATE Movies SET TITLE = '$title',STARTDATE = '$sqlstart',ENDDATE = '$sqlend',CATEGORY = '$category' WHERE ID = '$id'");
 
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
           $sql2 = $db->query("DELETE FROM Movies WHERE ID = '$id'"); 
           $sql2 = $db->query("DELETE FROM Favorites WHERE MOVIEID = '$id'"); 
           header("Refresh:0");
   }

   if(isset($_POST['Add'])){
       $title=$_POST['title2'];
       $start      = $_POST["startd"];
       $sqlstart = date("Y-m-d H:i:s",strtotime($start));
       $end         = $_POST["endd"];
       $sqlend =date("Y-m-d H:i:s",strtotime($end));
       $category=$_POST['category2'];

    $SQL= $db->query( "INSERT INTO  Movies (TITLE,STARTDATE,ENDDATE, CINENAME, CATEGORY ) 
                  VALUES ('$title', '$sqlstart', '$sqlend', '$cinema', '$category')");
                  header ("Refresh:0") ;

}


    if(isset($_POST['name'])){
        $cinename=$_POST['cinemaname'];
        $sql3 = $db->query("UPDATE Cinemas SET NAME = '$cinename' WHERE OWNER = '$owner' ");
        $sql3 = $db->query("UPDATE Movies SET CINENAME = '$cinename' WHERE CINENAME = '$cinema' ");
        header ("Refresh:0") ;

}


?>
<html>
	<head>
    <meta charset="utf-8">
		<title>Owners</title>
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
    width: 30%;
    height:40%;
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
    .container {
	
	position: absolute;
    margin-left: -90px;
    top: 180px;

  }
  .container2 {
	float: right;

  }
  input[type=date] {
	width: 70%;
	min-height:65%;
    padding: 12px 20px;
    margin: 0px 0;
	background-color: #afd4ff;
    border: 1px solid #000;
    border-radius: 10px;
    box-sizing: border-box;
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

<div class="container">
            <form action="" method="post">
            <label for="username"><i class="fas fa-plus"></i> </label>
            <input type="text" name="title2" placeholder="Title" required>
          
            <input style="width:20%" type="date" name="startd" placeholder="Start Date" required>
    
            <input style="width:20% " type="date" name="endd" placeholder="End Date" required>
    
           
            <input type="text" name="category2" placeholder="Category" required>
            <button class="bt2" type="submit" name="Add" >Add Movie</button> 
            </form></div>

      <div class=container2>
       <form action="" method="post">
      <h>Cinema<h>
       <input type="text" name="cinemaname" placeholder="Cinema Name" value= "<?php echo  $cinema; ?>" required>
            <button class="bt3" type="submit" name="name" > Save </button> 
            </form></div>

            
           
           
           
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
          <th></th>
        </tr>
        </thead>

<tr>
        <?php
        while ($row = mysqli_fetch_array($query2)) {
          
                ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

       
    
        <tbody>
        <tr>
        <td><input type="text" name="title" value= "<?php echo  $row['TITLE']; ?>" id="id"required ></td>
           <td><input type="date"  name ="start" value= "<?php echo  $row['STARTDATE']; ?>" id="name"required ></td>
           <td><input type="date"  name="end" value= "<?php echo  $row['ENDDATE']; ?>" id="surname" required></td>
           <td><input type="text"  name="cinemaname" value= "<?php echo  $row['CINENAME']; ?>" id="password" readonly required></td>
           <td><input type="text"  name="category"value= "<?php echo  $row['CATEGORY']; ?>" id="username" required></td>
            <td>
                     
                    <?php 
                    
                    $data = $row['ID'];?>
                 

        
            <td><button class="bt" type="submit" value="<?php echo  $data ?>" name='button'>Save </button>  </td>

           <?php
                      
                  
                  $data = $row['ID'];?>
                    
                  
                
                  <td><button class="button"type="submit" name="Delete" value=<?php echo $data;?>><i class="fa fa-trash"></i> </button> 
                                     
                  </td></tr>
                    
        </form>
                    
        
       <?php };?>
       </tbody>
    
       </table>
</div>
        
    
	
	</body>
</html>


