<?php

@include 'config.php';
$var=$_GET["uID"];
$edit=mysqli_query($conn,"SELECT * FROM `user_form` WHERE `id`='$var'");
$row=mysqli_fetch_array($edit);

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];
   $image = $_FILES['img']['name'];
   $imgurl= $_POST['img'];
   echo $imgurl; 
   $path = $_FILES['img']['tmp_name'];
   if($image=='')
	{
		 $sql = "UPDATE `user_form` SET `name`='$name',`email`='$email',`password`='$pass',`user_type`='$user_type',`profile`='$imgurl' WHERE `id`= '$var'";
	}
	else
	{
		 unlink(realpath("images/".$_POST['img']));
		 move_uploaded_file( $_FILES['img']['tmp_name'],"images/".$_FILES['img']['name']);
		 $sql = "UPDATE `user_form` SET `name`='$name',`email`='$email',`password`='$pass',`user_type`='$user_type',`profile`='$imgurl' WHERE `id`= '$var'";
		  
		
	}
   
	$r = mysqli_query($conn,$sql);
	if($r==1)
	{
		echo "Inserted ";
        header( "Location: view_table.php" ); 
	}
	else
	{
		echo "not inserted ";
	}  

   if(mysqli_num_rows($r) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $edit = "UPDATE `user_form`SET `name`='$name',`email`='$name', `password`='$name', `user_type`='$name',`profile`='$imgurl' WHERE `id`='$var'";
         mysqli_query($conn, $edit);
         header('location:view_table.php');
      }
   }
 
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="box">
  <div class="inner">
    <span>Register Here</span>
  </div>
  <div class="inner">
    <span>Register Here</span>
  </div>
</div>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Register Here</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="enter your name" value="<?php echo $row["name"]; ?>">
      <input type="email" name="email" required placeholder="enter your email" value="<?php echo $row["email"]; ?>">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <select name="user_type">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select>
	  <label>Choose Your Profile</label>
	  <input type="file" name="img" required placeholder="Choose Your Profile Picture">
	  <p><img src="images/<?php echo $row["profile"]; ?>" height="100px" width="100px"></p>
      <input type="submit" name="submit" value="Register Now" class="form-btn">
      <p>Already have an account? <a href="login_form.php">login now</a></p>
   </form>

</div>

</body>
</html>