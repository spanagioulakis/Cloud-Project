<?php
   include('session.php');
   error_reporting(0);
   $sql = "SELECT ROLE FROM Users WHERE USERNAME = '$login_session'";
   $result = mysqli_query($db,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   $active = $row['ROLE'];

   if ($active == "ADMIN"){
      $role= "Administrator";
   }else if ($active == "USER"){
      $role= "User";
   }else if ($active == "CINEMAOWNER"){
      $role= "Cinema Owner";
   }
    
   $sql = "SELECT ID FROM Users WHERE USERNAME = '$login_session'";
   $result = mysqli_query($db,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   $id = $row['ID'];
 
   $sql = "SELECT MOVIEID FROM Favorites WHERE USERID = '$id'";
   $result2 = mysqli_query($db,$sql);
   if ($result2->num_rows > 0) {
  
    $i=0;
    while($row = $result2->fetch_assoc()) {
      $id_m[$i] = $row['MOVIEID'];
     
      $i = $i+1;
    }
  }

   
    if(isset($_POST["date"])){
        $filterdate = $_POST["date"];}
        
 else{
    $filterdate = "NOW()";
}
$filtert = $_POST["stitle"];
$filtercin = $_POST["scinema"];
$filtercat =$_POST["scat"];
$now=(new \DateTime())->format('Y-m-d ');




    if($filterdate!="NOW()"  ){
   $sql = "SELECT * FROM Movies m WHERE TITLE LIKE '%$filtert%' AND CINENAME LIKE '%$filtercin%' AND CATEGORY LIKE '%$filtercat%'
   AND ('$filterdate' BETWEEN m.STARTDATE AND m.ENDDATE)" ;
   $result = mysqli_query($db,$sql)or die (mysqli_error($db));}
   
   else if(isset($_POST['Show'])){
    $sql = "SELECT * FROM Movies  WHERE ENDDATE >= '$now' " ;
    $result = mysqli_query($db,$sql)or die (mysqli_error($db));

 }
   else {
    $sql = "SELECT * FROM Movies m WHERE TITLE LIKE '%$filtert%' AND CINENAME LIKE '%$filtercin%' AND CATEGORY LIKE '%$filtercat%'
    AND ($filterdate BETWEEN m.STARTDATE AND m.ENDDATE)";
    $result = mysqli_query($db,$sql);

   }

   if(isset($_POST['favorite'])){
    $id2 = $_POST['favorite'];
    $sql2 = $db->query("INSERT INTO Favorites (USERID, MOVIEID) VALUES ('$id' , '$id2') ");
    header("Refresh:0");
   } 

   if(isset($_POST['removefav'])){
    $id2 = $_POST['removefav'];
    $sql2 = $db->query("DELETE FROM Favorites WHERE MOVIEID = '$id2' AND USERID = '$id' ");
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
		<title>Movies</title>
		<link href="style2.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<style>
             input[type="text2"] {
width: 130px;
height: 40px;
border: 2px solid #000;
font-weight: bold;
margin-bottom: 0px;
font-size: 17px;
padding: 0 0px;
border-radius: 20px;
background-color: #afd4ff;
text-align: center;

}
.container {
	
	position: absolute;
    margin-left: 0px;
    top: 180px;

  }
  .container2 {
	float: right;

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
                  <label for="username"><i class="fas fa-search"></i> </label>
                      <input type="text2" placeholder="Title" name = "stitle"> 
                     
                      <input type="text2" placeholder="Cinema" name = "scinema"> 
                      
                      <input type="text2" placeholder="Category" name = "scat"> 
                      
                      <button class="bt2"  type="submit" name="searchbtn" >Search</button> 
                  </form>  
                  </div>
                  <div class="container2">
                    <form action="" method="post"> 
                    <input type="date" name="date"required> 
                    
                      <button class="bt4"  type="submit" name="datebtn" value='<?php echo $data?>'>Search </button>  
                      </form>           </div>     
                      <div class="container3">
                      <form action="" method="post">
            <button class="bt3" type="submit" name="Show" > Show All </button> 
            </form></div>
   
     
           
            <table class="Table"></form>
<thead>
<tr>

          <th>TITLE</th>
          <th>STARTDATE</th>
          <th>ENDDATE</th>
          <th>CINEMANAME</th>
          <th>CATEGORY</th>
          <th></th>
        </tr>
        </thead>

<tr>
        <?php
        while ($row = mysqli_fetch_array($result)) {
            foreach ($id_m as $r ) {
                $id_mo = $r;
                if ($id_mo ==  $row['ID']){
                  $tag=1;
                  }
          }
          
                ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

       
    
        <tbody>
        <tr>
           <td><input type="text" name="title" value= "<?php echo  $row['TITLE']; ?>" id="id" readonly></td>
           <td><input type="text"  name ="start" value= "<?php echo  $row['STARTDATE']; ?>" id="name" readonly></td>
           <td><input type="text"  name="end" value= "<?php echo  $row['ENDDATE']; ?>" id="surname" readonly></td>
           <td><input type="text"  name="cinemaname" value= "<?php echo  $row['CINENAME']; ?>" id="password"  readonly></td>
           <td><input type="text"  name="category"value= "<?php echo  $row['CATEGORY']; ?>" id="username" readonly></td>
         
            
                      <?php
                   if ($tag ==1 ){
                    $data = $row['ID'];
                    ?>     
                        
                    <form method="post"> 
       
                   <td> <button class="button"  type="submit" name="removefav" value=<?php echo $data?>>Remove form favorites </button></td>
                    </form> 
                    <?php }else{
                    $data = $row['ID'];?>                    
                    <form method="post"> 
        
                        
                       <td> <button class="bt"  type="submit" name="favorite" value=<?php echo $data?>>Add to favourites </button></td> 
</td></form>
           </tr>
                    
        </form>
                    
        <?php
                  } $tag=0; 
                }

        echo "</tbody></table>"
                ?>
    
       </tbody>
    
       </table>
</div>
        
    </div>
	
	</body>
</html>


