<?php include('./connection.php'); 

if(isset($_POST['sub_go'])){
	if($_POST['role']=='Seeker'){
                echo "<script>window.open('./signup_stud.php','_self')</script>";
                unset($_POST['sub_go']);
	}
	if($_POST['role']=='Company'){
                echo "<script>window.open('./signup_com.php','_self')</script>";
                unset($_POST['sub_go']);
	}
	if($_POST['role']=='College'){
                echo "<script>window.open('./signup_col.php','_self')</script>";
                unset($_POST['sub_go']);
	}
}




?>
<link rel="icon" href="./GP_ICON.png">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<title>Sign Up | GetPlaced</title>
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
<h6 style="margin-bottom: 10px; color: #2A2868; font-weight: 900; ">Sign up for GetPlaced</h6>
<div class="col-3 p-3" style="border-radius: 20px;">

	
<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">

	<div>Sign Up</div>
	<hr>

	<div style="text-align: left; margin-left: 36px; margin-bottom: -14px;">Role</div>
	<br><select type="text" name="role" style="border-radius:7px; width: 240px; height: 30px;" required>
		    <option value="" disabled selected>Select Role</option>
		    <option value="Seeker">Job-Seeker/Students</option>
         	<option value="College">College</option>
         	<option value="Company">Company</option>
	</select>
	<br><br>
	<br><br>
	<br>
	<button type="submit" name="sub_go" class="btn btn-success" style="font-size: 12px; width: 240px; height: 30px;">GetPlaced</button>
	<div class="mt-1" style="margin-bottom: -15px;">
		<a href="./signin.php">Already have an account? Sign In!</a>
	</div>

</form>

</div>


</center>