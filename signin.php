<?php include('./connection.php'); 
session_start();
if(isset($_POST['sub_sign'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$query = $conn->prepare("SELECT seeker_uname,seeker_pass FROM seeker_tbl WHERE `seeker_uname`='$username' AND `seeker_pass`='$password'");
	$query->execute();
	if($query->rowCount()==1){
		echo "<script>window.open('./Seek.php','_self')</script>";
        $_SESSION["uname"]=$username;
        unset($_POST['sub_sign']);
	}
	$query = $conn->prepare("SELECT college_uname,college_pass FROM college_tbl WHERE `college_uname`='$username' AND `college_pass`='$password'");
	$query->execute();
	if($query->rowCount()==1){
		echo "<script>window.open('./College.php','_self')</script>";
        $_SESSION['uname']=$username;
        unset($_POST['sub_sign']);			
	}
	$query = $conn->prepare("SELECT company_uname,company_pass FROM company_tbl WHERE `company_uname`='$username' AND `company_pass`='$password'");
	$query->execute();
	if($query->rowCount()==1){
		echo "<script>window.open('./Company.php','_self')</script>";
        $_SESSION['uname']=$username;
        unset($_POST['sub_sign']);			
	}
	else{
		echo "<script>alert('Wrong Username Or Password!!')</script>";
		unset($_POST['sub_sign']);
		echo "<script>window.open('./signin.php','_self')</script>";
	}
}
?>
<link rel="icon" href="./GP_ICON.png">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<title>Sign in | GetPlaced</title>
<style type="text/css">
	body{
/*            background: rgb(221,214,248);
            background: linear-gradient(90deg, rgba(221,214,248,1) 0%, rgba(221,238,250,1) 31%, rgba(221,214,248,1) 68%, rgba(221,238,250,1) 100%);*/
			background: rgb(221,214,248);
			background: radial-gradient(circle, rgba(221,214,248,1) 5%, rgba(197,230,252,1) 56%, rgba(221,214,248,1) 90%);
            font-size: 12px;
            font-weight: 300;
            font-family: Product Sans;
        }
    div{
    	background: #2A2868;
    	color: white;
    }
</style>
<center>

<a><img src="./main_logo_dark.png" alt="logo" width="10%" style="margin-top: 120px;margin-bottom: 5px;"></a>
<h6 style="margin-bottom: 10px; color: #2A2868; font-weight: 900; ">Sign in to GetPlaced</h6>
<div class="col-3 p-3" style="border-radius: 20px;">

	
<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">

	<div>Sign in</div>
	<hr>

	<div style="text-align: left; margin-left: 36px; margin-bottom: -14px;">Username or Email-address</div>
	<br><input type="text" name="username" style="border-radius:7px; width: 240px; height: 30px;"> <br><br>

	<div class="left" style="text-align: left; margin-left: 36px; margin-bottom:-14px; margin-top:-10px;">Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="#">Forgot Password?</a></div> 
	<br><input type="password" name="password" style="border-radius:7px; width: 240px; height: 30px;">  <br><br>

	<button type="submit" name="sub_sign" class="btn btn-success" style="font-size: 12px; width: 240px; height: 30px;">Sign in</button>
	<div class="mt-1" style="margin-bottom: -15px;">
		<a href="./signup.php">Don't have an account? Sign Up!</a>
	</div>

</form>

</div>


</center>
