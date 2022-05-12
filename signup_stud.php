<?php include('./connection.php'); 
session_start();
if(isset($_POST['submit']))
    {
        //echo "hi";
        $uploadsDir = "./uploads/";
        $uploadsDir_dp = "./uploads/profile_pics";
        $uploadsDir_ach = "./uploads/achieves";
        $uploadsDir_cv = "./uploads/cvs";
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $uname = $_POST["uname"];
        $pass = $_POST["pass"];
        $confirmpass = $_POST['confirmpass'];
        $email = $_POST['email'];
        $web = $_POST["web"];
        $dob = $_POST['dob'];
        $college = $_POST['college'];
        $branch = $_POST['branch'];
        $year = $_POST['year'];
        $enroll = $_POST['enroll'];
        $about = $_POST['about'];
        $contact = $_POST["contact"];
        $address = $_POST["address"];
        $achieve=null;
        if($pass!=$confirmpass)
        {
            echo "<script>alert('Please Enter Same Password!')</script>";
            unset($_POST['submit']);
            //exit();
        }
        else
        {
            $query = $conn->prepare("SELECT seeker_uname FROM seeker_tbl WHERE `seeker_uname`='$uname'");
            $query->execute();
            if($query->rowCount()==1) 
            {
                echo "<script>alert('Username not available. Please try another one.')</script>";
                unset($_POST['submit']);
                echo "<script>window.open('./signup_stud.php','_self')</script>";
            }
            $query = $conn->prepare("SELECT college_uname FROM college_tbl WHERE `college_uname`='$uname'");
            $query->execute();
            if($query->rowCount()==1)
            {
                echo "<script>alert('Username not available. Please try another one.')</script>";
                unset($_POST['submit']);
                echo "<script>window.open('./signup_stud.php','_self')</script>";
            }
            $query = $conn->prepare("SELECT company_uname FROM company_tbl WHERE `company_uname`='$uname'");
            $query->execute();
            if($query->rowCount()==1)
            {
                echo "<script>alert('Username not available. Please try another one.')</script>";
                unset($_POST['submit']);
                echo "<script>window.open('./signup_stud.php','_self')</script>";
            }
            else
            {
                //echo json_encode($_FILES);
                if(!empty($_FILES['dp']['name'])){
                $dpFile=$_FILES['dp']['name'];
                $tmp_name = $_FILES['dp']['tmp_name'];
                $targetFilePath  = $uploadsDir_dp. $dpFile;
                $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $path = "./uploads/profile_pics/" .time(). "_". basename($dpFile);
                $dpName = time(). "_".basename($dpFile);
                if(move_uploaded_file($_FILES["dp"]["tmp_name"], $path)){         
                  }else{
                      echo "<script>alert('Error In Uploading Display Picture!!!')</script>";
                      exit();
                  }
                }else{
                    echo "<script>alert('Error In Uploading Display Picture')</script>";
                    exit();
                }

                if(!empty($_FILES['cv']['name'])){
                $cvFile=$_FILES['cv']['name'];
                $tmp_name = $_FILES['cv']['tmp_name'];
                $targetFilePath  = $uploadsDir_cv. $cvFile;
                $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $path = "./uploads/cvs/" .time(). "_". basename($cvFile);
                $cvName = time(). "_".basename($cvFile);
                if(move_uploaded_file($_FILES["cv"]["tmp_name"], $path)){         
                  }else{
                      echo "<script>alert('Error In Uploading CV!!!')</script>";
                      exit();
                  }
                }else{
                    echo "<script>alert('Error In Uploading CV')</script>";
                    exit();
                }

                  $uploadsDir_ach = './uploads/achieves/';
                  $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
                    
                  // Define maxsize for files i.e 2MB
                  //$maxsize = 2 * 1024 * 1024; 
                
                  // Checks if user sent an empty form 
                  if(!empty(array_filter($_FILES['achieves']['name']))) {
                      // Loop through each file in files[] array
                      foreach ($_FILES['achieves']['tmp_name'] as $key => $value) {
                            
                          $file_tmpname = $_FILES['achieves']['tmp_name'][$key];
                          $file_name = $_FILES['achieves']['name'][$key];
                          $file_size = $_FILES['achieves']['size'][$key];
                          $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                          $filepath = $uploadsDir_ach.time()."_".$file_name;
                          if(in_array(strtolower($file_ext), $allowed_types)) {
                              if(file_exists($filepath)) {
                                  $filepath = $uploadsDir_ach.time()."_".$file_name;
                                    
                                  if( move_uploaded_file($file_tmpname, $filepath)) {
                                      $achieve = $achieve."<br>".$filepath;
                                      //echo "{$file_name} successfully uploaded <br />";
                                  } 
                                  else {                     
                                      echo "<script>alert('Error In Uploading Achievements!!!')</script>";
                                      exit(); 
                                  }
                              }
                              else {
                                
                                  if( move_uploaded_file($file_tmpname, $filepath)) {
                                      //echo "{$file_name} successfully uploaded <br />";
                                      $achieve = $achieve.",".$filepath;
                                  }
                                  else {                     
                                      echo "<script>alert('Error In Uploading Achievements')</script>";
                                      exit(); 
                                  }
                              }
                          }
                          else {
                                
                              // If file extention not valid
                              echo "<script>alert('Error In Uploading')</script>";
                              exit();
                          } 
                      }
                  } 
              } 
              //echo "INSERT INTO `seeker_tbl`( `seeker_fname`, `seeker_lname`, `seeker_uname`,`seeker_pass`,`seeker_bdate`,`seeker_contact`, `seeker_mail`, `seeker_web`, `seeker_add`,  `seeker_college`, `seeker_branch`, `seeker_enroll`, `seeker_year`, `seeker_about`, `seeker_profile`, `seeker_cv`, `seeker_achievement` ) VALUES ('$fname' , '$lname' , '$uname' , '$pass', $dob , '$contact' , '$email' , '$web', '$address', '$college', '$branch', '$enroll', $year, '$about', '$dpName', '$cvName', '$achieve' )";
                $sql = $conn->prepare("INSERT INTO `seeker_tbl`( `seeker_fname`, `seeker_lname`, `seeker_uname`,`seeker_pass`,`seeker_bdate`,`seeker_contact`, `seeker_mail`, `seeker_web`, `seeker_add`,  `seeker_college`, `seeker_branch`, `seeker_enroll`, `seeker_year`, `seeker_about`, `seeker_profile`, `seeker_cv`, `seeker_achievement` ) VALUES ('$fname' , '$lname' , '$uname' , '$pass', '$dob' , '$contact' , '$email' , '$web', '$address', '$college', '$branch', '$enroll', $year, '$about', '$dpName', '$cvName', '$achieve' )");
                $skills=$conn->prepare("INSERT INTO `seeker_skills` (`seeker_uname`) VALUES ('$uname')");
                if($sql->execute() && $skills->execute())
                {
                    echo "<script>alert('You are signed Up!')</script>";
                    echo "<script>window.open('./signin.php','_self')</script>";
                }
                else
                {
                    echo "<script>alert('Sign Up Failed. Please try again after Sometime.')</script>";
                }
            }
        }

    //}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="style1.css?v=<?php echo time(); ?>">

  <title>Sign Up | GetPlaced</title>
</head>

<body>
  <div class="container">
    <div class="row text-center">
      <div class="text-center">
        <img src="main_logo_dark.png" class="rounded img-fluid" alt="Logo">
      </div>
      <h6>Create an Account for Get Placed</h6>
    </div>
  </div>
  <div class="container info">
    <div class="row">
      <div class="text-center">
        <h2>Student Sign up</h2>
      </div>
      <div class="text-left" style="margin-bottom: -2%;">
        <h4>Personal info</h4>
        <h4 style="border-bottom:3px solid white;width:150px"></h4>
      </div>
      <form class="row g-3" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" enctype="multipart/form-data">
        <div class="col-md-6">
          <label for="name" class="form-label">First Name</label>
          <input type="text" name="fname" class="form-control border border-dark" id="inputName" placeholder="First Name">
        </div>
        <div class="col-md-6">
          <label for="username" class="form-label" style="font-family:Product Sans">Mobile No.</label>
          <input type="tel" name="contact" class="form-control border border-dark" id="inputnumber" placeholder="9876543210">
        </div>
        <div class="col-md-6">
          <label for="name" class="form-label">Last Name</label>
          <input type="text"  name="lname" class="form-control border border-dark" id="inputName" placeholder="Last Name">
        </div>
        <div class="col-md-6">
          <label for="email" class="form-label" style="font-family:Product Sans">Email</label>
          <input type="email" name="email" class="form-control border border-dark" id="email" placeholder="Email">
        </div>
        <div class="col-md-6">
          <label for="user name" class="form-label" style="font-family:Product Sans">Username</label>
          <input type="text" name="uname" class="form-control border border-dark" id="email" placeholder="Username">
        </div>
        <div class="col-md-6">
          <label for="date" class="form-label" style="font-family:Product Sans">DOB</label>
          <input type="date" name="dob" class="form-control border border-dark" id="date" placeholder="DOB">
        </div>
        <div class="col-md-6">
          <label for="address" class="form-label" style="font-family:Product Sans">Address</label><br>
          <textarea rows="5" name="address" class="form-control border border-dark" id="address"></textarea>
          <!-- <input type="text" class="form-control border border-dark" id="Website" placeholder="Website">  -->
        </div>
        <div class="col-md-6">
          <label for="website" class="form-label" style="font-family:Product Sans">Website URL</label>
          <input type="text" name="web" class="form-control border border-dark" id="Web" placeholder="Website">
        </div>
        <div class="text-left">
          <h4>Academics</h4>
          <h4 style="border-bottom:3px solid white;width:150px "></h4>
        </div>

        <div class="col-md-6">
          <!-- <label for="college" class="form-label">College</label>
          <input type="text" name="college" class="form-control border border-dark" id="college" placeholder="College"> -->
            <label for="college" class="form-label">College</label>
                <select name="college" required class="form-control border border-dark" id="college" placeholder="College">
                  <option value="select">Select</option>
                  <?php
                    $sql = $conn->prepare("SELECT college_name FROM college_tbl");
                    $sql->execute();
                    while($row = $sql->fetch())
                    {
                      echo "<option value = '".$row['college_name']."'>".htmlspecialchars($row['college_name'])."</option>";
                    }
                  ?>
                  <option value="other">Other</option>
                </select>
        </div>
        <div class="col-md-6">
          <label for="branch" class="form-label" style="font-family:Product Sans">Branch</label>
          <input type="text" name="branch" class="form-control border border-dark" id="branch" placeholder="Branch">
        </div>

        <div class="col-md-6">
          <label for="year" class="form-label">Passing Year</label>
          <input type="number" name="year" class="form-control border border-dark" id="year" placeholder="Passing Year">
        </div>
        <div class="col-md-6">
          <label for="enrollment" class="form-label" style="font-family:Product Sans">Enrollnment No.</label>
          <input type="number" name="enroll" maxlength="12" class="form-control border border-dark" id="enrollment"
            placeholder="Enrollnment">
        </div>

        <div class="col-md-6">
          <label for="about" class="form-label" style="font-family:Product Sans">About</label><br>
          <textarea rows="5" name="about" class="form-control border border-dark" id="about"></textarea>
        </div>

        <div class="col-md-2">
          <!-- <div class="col-md-3"> -->
          <label for="achievements" class="form-label" style="font-family:Product Sans">Achievements</label>
          <input type="file" name="achieves[]" class="form-control" id="myFile" multiple>
          <label for="file" class="form-label" style="font-family:Product Sans;font-size:12pt;margin-top:10px;">*JPG,JPEG files only</label>
        </div>

        <div class="col-md-2">
          <!-- <input type="submit"> -->
          <label for="dp" class="form-label" style="font-family:Product Sans;">Profile Picture</label>
          <input type="file" name="dp" class="form-control" id="dp">
          <label for="file" class="form-label" style="font-family:Product Sans;font-size:12pt;margin-top:10px;">*JPG,JPEG files only</label>
        </div>
        <!-- <div class="col-md-9">
        </div> -->
        <div class="col-md-2">
          <!-- <input type="submit"> -->
          <label for="cv" class="form-label" style="font-family:Product Sans;">Resume</label>
          <input type="file" name="cv" class="form-control" id="cv">
          <label for="file" class="form-label" style="font-family:Product Sans;font-size:12pt;margin-top:10px;">*PDF file only</label>
        </div>
        <!-- <div class="col-md-3">
        </div> -->
        <div class="col-md-6">
          <label for="password" class="form-label" style="font-family:Product Sans">Password</label>
          <input type="password" name="pass" class="form-control border border-dark" id="password" placeholder="Password">
        </div>

        <div class="col-md-6">
          <label for="password" class="form-label" style="font-family:Product Sans">Confirm Password</label>
          <input type="password" name="confirmpass" class="form-control border border-dark" id="password" placeholder="Confirm Password">
        </div>
        <br>
        
        <div class="d-grid gap-2 col-6 mx-auto">
          <br>
          <button class="btn btn-primary" name="submit" type="submit" style="background-color:#28a745;border:solid 2px green">Sign Up</button>
          <a href="./signin.php" class="text-center" style="text-decoration:none">Already Have an Account? Sign In</a>
        </div>
      </form>

    </div>
  </div>
<br>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
  </script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  <!-- <script>var myNodelist = document.getElementsByTagName("LI");
        var i;
        for (i = 0; i < myNodelist.length; i++) {
          var span = document.createElement("SPAN");
          var txt = document.createTextNode("\u00D7");
          span.className = "close";
          span.appendChild(txt);
          myNodelist[i].appendChild(span);
        }
        

        var close = document.getElementsByClassName("close");
        var i;
        for (i = 0; i < close.length; i++) {
          close[i].onclick = function() {
            var div = this.parentElement;
            div.style.display = "none";
          }
        }
        
        var list = document.querySelector('ul');
        list.addEventListener('click', function(ev) {
          if (ev.target.tagName === 'LI') {
            ev.target.classList.toggle('checked');
          }
        }, false);
        
        function newElement() {
          var li = document.createElement("li");
          var inputValue = document.getElementById("myInput").value;
          var t = document.createTextNode(inputValue);
          li.appendChild(t);
          if (inputValue === '') {
            alert("You must write something!");
          } else {
            document.getElementById("myUL").appendChild(li);
          }
          document.getElementById("myInput").value = "";
        
          var span = document.createElement("SPAN");
          var txt = document.createTextNode("\u00D7");
          span.className = "close";
          span.appendChild(txt);
          li.appendChild(span);
        
          for (i = 0; i < close.length; i++) {
            close[i].onclick = function() {
              var div = this.parentElement;
              div.style.display = "none";
            }
          }
        }</script> -->
</body>

</html>