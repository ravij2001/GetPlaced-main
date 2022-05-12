<?php
include 'connection.php';
session_start();
//$json=json_encode($_SESSION);
//echo $json;
//echo $_SESSION["seeker_uname"];
if (!isset($_SESSION["uname"])) {
    echo "Error";
    header('Location:./signin.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo $_SESSION['uname']; ?> | GetPlaced</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style_seek.css?v=<?php echo time(); ?>">
    <?php
        $uname = $_SESSION['uname']; 
        $sql=$conn->prepare("SELECT * FROM `application_tbl` WHERE `seeker_uname`='$uname' AND `is_placed`=1");
        $sql->execute();
        if($sql->rowCount()>0){
            ?>
            <style>
                #student_apply{
                    pointer-events: none;
                }
            </style>
         <?php   
        }
    ?>
    <style>
        .bio-graph-heading {
            background: #263a4f;
            color: #fff;
            text-align: center;
            font-style: italic;
            padding: 40px 110px;
            font-size: 16px;
            font-weight: 300;
        }

        .bio-graph-info {
            color: #89817e;
        }

        .bio-graph-info h1 {
            font-size: 22px;
            font-weight: 300;
            margin: 0 0 20px;
        }

        .bio-row {
            width: 50%;
            float: left;
            margin-bottom: 10px;
            padding: 0 15px;
        }

        .bio-row p span {
            width: 100px;
            display: inline-block;
        }

        .bio-chart,
        .bio-desk {
            float: left;
        }

        .bio-chart {
            width: 40%;
        }

        .bio-desk {
            width: 60%;
        }

        .bio-desk h4 {
            font-size: 15px;
            font-weight: 400;
        }

        .bio-desk h4.terques {
            color: #34aadc;
        }

        .bio-desk h4.red {
            color: #e26b7f;
        }

        .bio-desk h4.green {
            color: #97be4b;
        }

        .bio-desk h4.purple {
            color: #caa3da;
        }

        #sidebar {
            cursor: pointer !important;
        }

        * {
            text-decoration: none !important;
        }
    </style>
</head>
<?php
//for personal details...
$uname = $_SESSION['uname'];
$sql = $conn->prepare("SELECT * FROM `seeker_tbl` WHERE `seeker_uname` = '$uname' ");
$sql->execute();
$row = $sql->fetch();
if ($row) {
    //echo json_encode($row);
    $id = $row['seeker_id'];
    $fname = $row['seeker_fname'];
    $lname = $row['seeker_lname'];
    $dob = $row['seeker_bdate'];
    $contact = $row['seeker_contact'];
    $mail = $row['seeker_mail'];
    $web = $row['seeker_web'];
    $college = $row['seeker_college'];
    $branch = $row['seeker_branch'];
    $enroll = $row['seeker_enroll'];
    $year = $row['seeker_year'];
    $about = $row['seeker_about'];
    $profile = $row['seeker_profile'];
    $cv = $row['seeker_cv'];
    $add = $row['seeker_add'];
    $achieve = explode(",", $row['seeker_achievement']);
    $approved = $row['seeker_approve'];

    //echo $id," + ",$fname," + ",$lname," + ",$dob," + ",$contact," + ",$mail," + ",$web," + ",$college,"  ";
} else {
    echo "<script>alert('Something went wrong! Please try again later.')</script>";
    echo "<script>window.open('./Logout.php','_self')</script>";
}
?>
<?php
    if (isset($_POST['apply'])) {
        $id = $_POST['apply_id'];
        $sql=$conn->prepare("SELECT * FROM `approved_drive` WHERE `drive_id`=$id ");
        $sql->execute();
        $row=$sql->fetch();
        $co=$row['company_name'];
        $pl=$row['platform'];
        $check=$conn->prepare("SELECT * FROM `application_tbl` WHERE `seeker_uname` ='$uname' AND `company_name` = '$co' ");
        $check->execute();
        //echo $check->rowCount();
        //$checkrow=$check->fetch();
        if($check->rowCount()>0){
            echo "<script>alert('You have already applied to this Drive. Please wait for confirmation from Company.')</script>";
        }else{
            $sql =$conn->prepare("INSERT INTO `application_tbl` (`seeker_uname`, `company_name`, `college_name`, `platform`) VALUES ('$uname', '$co', '$college', '$pl')");
            $sql->execute();
            echo "<script>alert('You successfully applied to this drive. Wait for Confirmation.')</script>";
        }
     }
?>
<?php ?>
<body>
    <div class="container-fluid">

        <div class="row" id="super-of-submenu">
            <!-- Vertical navbar -->
            <div class="vertical-nav bg-primary" id="sidebar" style="background-color: #2a2868 !important;">
                <div class="py-4 px-3 mb-4 bg-light">
                    <div class="media d-flex align-items-center">
                        <img loading="lazy" src="./uploads/profile_pics/<?php echo $profile; ?>" alt="..." width="100" height="140" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                        <div class="media-body">
                            <h4 class="m-0"><?php echo $fname ?></h4>
                        </div>
                    </div>
                    <div class="media d-flex align-items-center">
                        <!-- <img loading="lazy" src="./uploads/profile_pics/<?php echo $profile; ?>" alt="..." width="100" height="120" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                         -->
                    </div>
                </div>

                <p class="text-light font-weight-bold text-uppercase px-3 small pb-4 mb-0">Menu</p>

                <ul class="nav flex-column bg-primary mb-0" style="background-color: #2a2868 !important;">
                    <li class="sub-menu-active nav-link text-light" id="student_dashboard_submenu">
                        <i class="fa fa-th-large mr-3 text-light fa-fw"></i> Dashboard
                    </li>
<!--                     <li class="nav-item nav-link text-light" id="student_preference_submenu">
                        <i class="fa fa-address-card mr-3 text-light fa-fw"></i> Preferences
                    </li> -->
                    <li class="nav-item nav-link text-light" id="student_apply_submenu">
                        <i class="fa fa-cubes mr-3 text-light fa-fw"></i> Apply
                    </li>
                    <li class="nav-item nav-link text-light" id="student_profile_submenu">
                        <i class="fa fa-picture-o mr-3 text-light fa-fw"></i> Profile
                    </li>
                    <li>
                        <a href="./Logout.php" class="ml-2 mt-4 ">
                            <button type="button" class="btn btn-light" style="border-radius: 100pt ;">Sign Out</button>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End vertical navbar -->
            <!-- Page content holder -->
            <div class="page-content p-5 bg-white" id="content">
                <!-- Toggle button -->
                <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>
                <div class="titles" id="student_dashboard">
                    <!-- Demo content -->
                    <h2 class="display-4 text-primary font-weight-bold">DASHBOARD</h2>
                    <p class="lead text-dark mb-0">Welcome, <?php echo $_SESSION['uname']; ?>. </p>

                    <div class="separator"></div>
                    <div class="text-left text-dark">
                        <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt;">Current Drives</h4>
                        <h4 style="border-bottom:3px solid black;width:140px"></h4>
                    </div>
                    <br>
                    <div class="card-deck">
                        <?php
                        //echo $college;
                        //for college placement drives...
                        $sql = $conn->prepare("SELECT * FROM `approved_drive` WHERE `college_name` = '$college' ");
                        $sql->execute();
                        if ($sql->rowCount() > 0) {

                            while ($row = $sql->fetch()) {
                                //echo json_encode($row);
                                $company = $row['company_name'];
                                $start = $row['start_date'];
                                $end = $row['end_date'];
                                $time = $row['time'];
                                $req = $row['req_emp'];
                                $pack = $row['package'];
                                $file = $row['offer_file'];
                        ?>

                                <div class="card text-dark">
                                    <div class="card-header font-weight-bold">
                                        <a href="./CompanyView.php?id=<?php echo $company ;?>" target="_blank"><?php echo $company ?></a>
                                    </div>
                                    <div class="card-body">
                                        Start Date: <?php echo $start ?> <br>
                                        End Date: <?php echo $end ?> <br>
                                        Time: <?php echo $time ?> <br>
                                        <a href="#student_apply"><button type="button" class="btn btn-primary mt-3" id="student_apply_submenu2">Apply Now!</button></a>
                                    </div>
                                </div>
                                <br>
                            <?php }
                        } else { ?>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-body text-dark text-center m-0" style="font-size: 18pt;">No Current
                                        Drive Available.</h5>
                                </div>
                            </div>
                            <br>
                        <?php    }
                        ?>
                    </div>
                    <div class="text-left text-dark mt-4">
                        <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt">Scheduled Interviews
                        </h4>
                        <h4 style="border-bottom:3px solid black;width:140px"></h4>
                    </div>
                    <br>
                    <div class="card-deck mb-4">
                        <?php
                        //for scheduled interviews of drives...
                        $sql = $conn->prepare("SELECT * FROM `application_tbl` WHERE `seeker_uname` = '$uname' and `is_approved` = 1 AND `is_placed` = 0");
                        $sql->execute();

                        $sql1 = $conn->prepare("SELECT * FROM `application_tbl` WHERE `seeker_uname` = '$uname' and `is_placed` = 1");
                        $sql1->execute();

                        //$row = $sql->fetch();
                        if ($sql->rowCount() > 0) {
                            while ($row = $sql->fetch()) {
                                //echo json_encode($row);
                                $company = $row['company_name'];
                                $inter_date = $row['app_date'];
                                $inter_time = $row['app_time'];
                                $platform = $row['platform'];
                                $link = $row['link'];

                        ?>

                                <div class="card text-dark">
                                    <div class="card-header font-weight-bold">
                                        <a href="./CompanyView.php?id=<?php echo $company;?>"><?php echo $company; ?></a>
                                    </div>
                                    <div class="card-body">
                                        Date: <?php echo $inter_date; ?> <br>
                                        Time: <?php echo $inter_time; ?> <br>
                                        Platform: <?php echo $platform; ?><br>
                                        Link: <a href="<?php echo $link; ?>"><?php echo $link; ?></a>
                                    </div>
                                </div>

                            <?php }
                        } else if($sql1->rowCount()>0){ ?>
                            <div class="card">
                                <div class="card-deck">
                                    <div class="card text-dark">
                                        <div class="card-header font-weight-bold text-success" style="font-size:20pt;">
                                             Hurrey!!! You have been Placed
                                             <?php 
                                                $row1 = $sql1->fetch();
                                                $company = $row1['company_name'];
                                                $package = $row1['app_package'];
                                             ?>
                                        </div>
                                        <div class="card-body">
                                            <div style="font-size:20pt;">
                                                Company Name : <b><?php echo $company; ?></b>
                                            </div>
                                            <div style="font-size:20pt;">
                                                Package : <b><?php echo $package;?></b>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php    }
                        else{?>
                            <div class="card">
                                <div class="card-deck">
                                    <div class="card text-dark">
                                        <div class="card-header font-weight-bold">
                                            No Scheduled Interviews.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                </div>
                <?php
                if (isset($_POST['add'])) {
                    //echo json_encode($_POST);
                    $skill = $_POST['dropdown'];
                    if ($skill != "") {
                        $skill_per = $_POST['per'];
                        $skills = $conn->prepare("UPDATE `seeker_skills` SET `seeker_$skill`= $skill_per WHERE `seeker_uname`= '$uname' ");
                        if ($skills->execute()) {
                            //echo "<script>alert('Skill added Successfully!')</script>";
                        } else {
                            echo "<script>alert('Something Went wrong!')</script>";
                        }
                    }
                }
                ?>

                <div class="titles" id="student_profile">
                    <!-- Demo content -->
                    <h2 class="display-4 text-primary font-weight-bold">PROFILE</h2>
                    <p class="lead text-dark mb-0"><?php echo $fname, " ", $lname ?> </p>
                    <div class="separator"></div>
                    <br>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Profile</button>
                            <button class="nav-link" id="nav-editprofile-tab" data-bs-toggle="tab" data-bs-target="#nav-editprofile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Edit Profile</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="bio-graph-heading">
                                <?php echo $about; ?>
                            </div>
                            <div class="panel-body bio-graph-info">
                                <div class="text-left text-dark mt-4">
                                    <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt">Details
                                    </h4>
                                    <h4 style="border-bottom:3px solid black;width:140px"></h4>
                                </div>
                                <div class="row">
                                    <div class="bio-row">
                                        <p><span>First Name </span>: <?php echo $fname; ?></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Last Name </span>: <?php echo $lname; ?></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Birthday</span>: <?php echo $dob; ?></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>College</span>: <?php echo $college; ?></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Branch</span>: <?php echo $branch; ?></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>EnrollNo.</span>: <?php echo $enroll; ?></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Website </span>: <a href="<?php echo $web; ?>"> <?php echo $web; ?></a></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Email </span>: <a href="mailto:<?php echo $mail; ?>"> <?php echo $mail; ?></a></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Mobile </span>: <a href="tel:<?php echo $contact; ?>"><?php echo $contact; ?></a> </p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-left text-dark mt-4">
                                <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt">Achievements
                                </h4>
                                <h4 style="border-bottom:3px solid black;width:140px"></h4>
                            </div>
                            <br>
                            <div class="card-deck">
                                <?php
                                for ($i = 0; $i < count($achieve); $i++) {
                                    if ($achieve[$i] != null) {
                                ?>
                                        <div class="card" style="height: 30%;">
                                            <img src="<?php echo $achieve[$i]; ?>" class="card-img-top" alt="..." width="35%">
                                            <div class="card-body">
                                                <?php echo $i; ?>. Achievement
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-editprofile" role="tabpanel" aria-labelledby="nav-editprofile-tab">
                            <div id="edit-profile" class="tab-pane">
                                <section class="panel">
                                    <div class="panel-body bio-graph-info">
                                        <!-- <h1> Profile Info</h1> -->
                                        <!-- <form class="form-horizontal" role="form"> -->
                                        <form class="row g-3" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                            <div class="text-left">
                                                <h4>Personal</h4>
                                                <h4 style="border-bottom:3px solid white;width:150px "></h4>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="name" class="form-label">First Name</label>
                                                <input type="text" name="fname" class="form-control border border-dark" id="inputName" placeholder="<?php echo $fname; ?>" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="name" class="form-label">Last Name</label>
                                                <input type="text" name="lname" class="form-control border border-dark" id="inputName" placeholder="<?php echo $lname; ?>" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="user name" class="form-label" style="font-family:Product Sans">Username</label>
                                                <input type="text" name="uname" class="form-control border border-dark" id="email" placeholder="<?php echo $uname ?>" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="username" class="form-label" style="font-family:Product Sans">Mobile No.</label>
                                                <input type="tel" name="contact" class="form-control border border-dark" id="inputnumber" placeholder="<?php echo $contact; ?>" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="email" class="form-label" style="font-family:Product Sans">Email</label>
                                                <input type="email" name="email" class="form-control border border-dark" id="email" placeholder="<?php echo $mail; ?>" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="address" class="form-label" style="font-family:Product Sans">Address</label><br>
                                                <textarea rows="3" name="address" class="form-control border border-dark" id="address" placeholder="<?php echo $add; ?>"></textarea>
                                                <!-- <input type="text" class="form-control border border-dark" id="Website" placeholder="Website">  -->
                                            </div>
                                            <div class="text-left">
                                                <h4>Academics</h4>
                                                <h4 style="border-bottom:3px solid white;width:150px "></h4>
                                            </div>

                                            <div class="col-md-4">
                                                <!-- <label for="college" class="form-label">College</label> <input type="text" name="college" lass="form-control border border-dark" id="college" placeholder="College"> -->
                                                <label for="college" class="form-label">College</label>
                                                <select name="college" required class="form-control border border-dark" id="college" placeholder="College" disabled>
                                                    <option value="<?php echo $college; ?>"><?php echo $college; ?></option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="branch" class="form-label" style="font-family:Product Sans">Branch</label>
                                                <input type="text" name="branch" class="form-control border border-dark" id="branch" placeholder="<?php echo $branch; ?>" disabled>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="year" class="form-label">Passing Year</label>
                                                <input type="number" name="year" class="form-control border border-dark" id="year" placeholder="<?php echo $year; ?>" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="enrollment" class="form-label" style="font-family:Product Sans">Enrollment No.</label>
                                                <input type="number" name="enroll" maxlength="12" class="form-control border border-dark" id="enrollment" placeholder="<?php echo $enroll; ?>" disabled>
                                            </div>
                                            <br>
                                            <div class="text-left">
                                                <h4>About</h4>
                                                <h4 style="border-bottom:3px solid white;width:150px "></h4>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="about" class="form-label" style="font-family:Product Sans">About</label><br>
                                                <textarea rows="3" name="about" class="form-control border border-dark" id="about" placeholder="<?php echo $about; ?>"></textarea>
                                            </div>
                                            <div class="col-md-4">
                                                <!-- <div class="col-md-3"> -->
                                                <label for="achievements" class="form-label" style="font-family:Product Sans">Achievements</label>
                                                <input type="file" name="achieves" class="form-control" id="myFile" name="filename">
                                                <label for="file" class="form-label" style="font-family:Product Sans;font-size:12pt;margin-top:10px;">*JPG,JPEG files only</label>
                                            </div>

                                            <div class="col-md-4">
                                                <!-- <input type="submit"> -->
                                                <label for="profile" class="form-label" style="font-family:Product Sans;">Profile Picture</label>
                                                <input type="file" name="dp" class="form-control" id="myFile" name="filename">
                                                <label for="file" class="form-label" style="font-family:Product Sans;font-size:12pt;margin-top:10px;">*JPG,JPEG files only</label>
                                            </div>
                                            <div class="col-md-4">
                                                <!-- <input type="submit"> -->
                                                <label for="cv" class="form-label" style="font-family:Product Sans;">Resume</label>
                                                <input type="file" name="cv" class="form-control" id="cv">
                                                <label for="file" class="form-label" style="font-family:Product Sans;font-size:12pt;margin-top:10px;">*PDF file only</label>
                                            </div>
                                            <div class="d-grid gap-2 col-4 mx-auto">
                                                <br>
                                                <button class="btn btn-primary" name="update" type="submit" style="background-color:#28a745;border:solid 2px green">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="titles" id="student_apply">
            <h2 class="display-4 text-primary font-weight-bold">APPLY</h2>
            <p class="lead text-dark mb-0"><?php echo $fname, " ", $lname; ?></p>
            <div class="separator"></div>
            <?php if ($approved == 0) {
            ?>
                <div class="row" style="pointer-events: none;">
                    <h3>Please Contact your TPO to approve your Profile.</h3>
                <?php
            } else {
                ?>
                    <div class="row">
                    <?php
                }
                    ?>
                    <!-- profile-widget -->
                    <div class="col-md-12">
                        <div style="font-size:12pt;">
                            <table class="table text-center table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Dates</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Package</th>
                                        <th scope="col">Total Intake</th>
                                        <th scope="col">Platform</th>
                                        <th scope="col">Attachment</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <?php
                                //for college placement drives...
                                $sql = $conn->prepare("SELECT * FROM `approved_drive` WHERE `college_name` = '$college'");
                                $sql->execute();
                                if ($sql->rowCount() > 0) {
                                    while ($row = $sql->fetch()) {
                                        //echo json_encode($row);
                                        $id2=$row['drive_id'];
                                        $company_name = $row['company_name'];
                                        $dates = $row['start_date']." to ".$row['end_date'];
                                        $time = $row['time'];
                                        $package = $row['package'];
                                        $req = $row['req_emp'];
                                        $plat = $row['platform'];
                                        $attach = $row['offer_file'];

                                ?>

                                        <tr>
                                            <td><?php echo $id2; ?></td>
                                            <td><?php echo $company_name; ?></td>
                                            <td><?php echo $dates; ?></td>
                                            <td><?php echo $time; ?></td>
                                            <td><?php echo $package; ?></td>
                                            <td><?php echo $req; ?></td>
                                            <td><?php echo $plat; ?></td>
                                            <td><a href="<?php echo $attach; ?>"><button class="btn btn-primary text-light">View</button></a></td>
                                            
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td></td>
                                        <td>No Approved Profiles</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                <?php    }
                                ?>
                                    <!-- <tr>
                                        <th>1</th>
                                        <th >Google</th>
                                        <td>20-07-2021 to 31-07-2021</td>
                                        <td>12.00 - 17.00 Hrs.</td>
                                        <td>12 - 15 LPA</td>
                                        <td>200</td>
                                        <td>Google Meet</td>
                                        <td><button class="btn btn-primary">View</button></td>
                                    </tr> -->
                                </tbody>
                            </table>
                            <?php
                                    if ($sql->rowCount() > 0){
                                ?>
                                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" >
                                            <input type="number" name="apply_id" placeholder="Drive ID">
                                            <br>
                                            <button type="submit" name="apply" class="btn btn-primary mt-3">Apply</button> 
                                        </form>
                                <?php 
                                    }
                                ?>
                        </div>
                        <div class="text-left text-dark mt-4">
                                    <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt">Applied Drives
                                    </h4>
                                    <h4 style="border-bottom:3px solid black;width:140px"></h4>
                                    <div style="font-size:12pt;">
                            <table class="table text-center table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Company</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Comments By the Company</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <?php
                                //for college placement drives...
                                $sql = $conn->prepare("SELECT * FROM `application_tbl` WHERE `seeker_uname` = '$uname'");
                                $sql->execute();
                                if ($sql->rowCount() > 0) {
                                    while ($row = $sql->fetch()) {
                                        //echo json_encode($row);
                                        $company_name = $row['company_name'];
                                        $status=$row['is_approved'];
                                        $com = $row['comment'];
                                        if($status==1){
                                            $status='Approved By Company';
                                        }else if($status==0){
                                            $status='Pending Approval';
                                        }
                                        else{
                                            $status='Rejected by the company';
                                        }
                                        
                                ?>

                                        <tr>
                                            <td><?php echo $company_name; ?></td>
                                            <td><b><?php echo $status; ?></b></td>
                                            <td><?php echo $com; ?></td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td></td>
                                        <td>No Applications from you.</td>

                                    </tr>
                                <?php    }
                                ?>
                                </tbody>
                            </table>
                        </div>

                        </div>
                    </div>

                    
                    </div>

                </div>
        </div>
            </div>
        </div>
        
        <!-- End demo content -->

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {

                window.count = 3;

                $('#student_dashboard').show();
                $('#student_preference').hide();
                $('#student_profile').hide();
                $('#student_apply').hide();

                $('#student_dashboard_submenu').click(function() {
                    $('#student_dashboard').show(function() {
                        $('#student_dashboard_submenu').addClass('sub-menu-active')
                    });
                    $('#student_preference').hide(function() {
                        $('#student_preference_submenu').removeClass('sub-menu-active')
                    });
                    $('#student_profile').hide(function() {
                        $('#student_profile_submenu').removeClass('sub-menu-active')
                    });
                    $('#student_apply').hide(function() {
                        $('#student_apply_submenu').removeClass('sub-menu-active')
                    });
                })
                $('#student_preference_submenu').click(function() {
                    $('#student_dashboard').hide(function() {
                        $('#student_dashboard_submenu').removeClass('sub-menu-active')
                    });
                    $('#student_preference').show(function() {
                        $('#student_preference_submenu').addClass('sub-menu-active')
                    });
                    $('#student_profile').hide(function() {
                        $('#student_profile_submenu').removeClass('sub-menu-active')
                    });
                    $('#student_apply').hide(function() {
                        $('#student_apply_submenu').removeClass('sub-menu-active')
                    });
                })
                $('#student_profile_submenu').click(function() {
                    $('#student_dashboard').hide(function() {
                        $('#student_dashboard_submenu').removeClass('sub-menu-active')
                    });
                    $('#student_preference').hide(function() {
                        $('#student_preference_submenu').removeClass('sub-menu-active')
                    });
                    $('#student_profile').show(function() {
                        $('#student_profile_submenu').addClass('sub-menu-active')
                    });
                    $('#student_apply').hide(function() {
                        $('#student_apply_submenu').removeClass('sub-menu-active')
                    });
                })
                $('#student_apply_submenu').click(function() {
                    $('#student_dashboard').hide(function() {
                        $('#student_dashboard_submenu').removeClass('sub-menu-active')
                    });
                    $('#student_preference').hide(function() {
                        $('#student_preference_submenu').removeClass('sub-menu-active')
                    });
                    $('#student_profile').hide(function() {
                        $('#student_profile_submenu').removeClass('sub-menu-active')
                    });
                    $('#student_apply').show(function() {
                        $('#student_apply_submenu').addClass('sub-menu-active')
                    });
                })
                $('#student_apply_submenu2').click(function() {
                    $('#student_dashboard').hide(function() {
                        $('#student_dashboard_submenu').removeClass('sub-menu-active')
                    });
                    $('#student_preference').hide(function() {
                        $('#student_preference_submenu').removeClass('sub-menu-active')
                    });
                    $('#student_profile').hide(function() {
                        $('#student_profile_submenu').removeClass('sub-menu-active')
                    });
                    $('#student_apply').show(function() {
                        $('#student_apply_submenu').addClass('sub-menu-active')
                    });
                })
            })

            $(function() {
                $('#sidebarCollapse').on('click', function() {
                    $('#sidebar, #content').toggleClass('active');
                });
            });
        </script>
        <script>
            function getAndUpdate() {
                console.log("Updating List...");
                tit = document.getElementById('title').value;
                desc = document.getElementById('description').value;
                if (!tit) {
                    alert("Please select a skill");
                    document.getElementById('title').focus();
                } else if (!desc) {
                    alert("Please enter valid Percentage");
                    document.getElementById('description').focus();
                } else if (desc > 100 || desc < 0) {
                    alert("Please enter valid Percentage");
                    document.getElementById('description').focus();
                } else {
                    if (localStorage.getItem('itemsJson') == null) {
                        itemJsonArray = [];
                        itemJsonArray.push([tit, desc]);
                        localStorage.setItem('itemsJson', JSON.stringify(itemJsonArray))
                    } else {
                        itemJsonArrayStr = localStorage.getItem('itemsJson')
                        itemJsonArray = JSON.parse(itemJsonArrayStr);
                        itemJsonArray.push([tit, desc]);
                        localStorage.setItem('itemsJson', JSON.stringify(itemJsonArray))
                    }
                    update();
                }
            }

            function update() {
                if (localStorage.getItem('itemsJson') == null) {
                    itemJsonArray = [];
                    localStorage.setItem('itemsJson', JSON.stringify(itemJsonArray))
                } else {
                    itemJsonArrayStr = localStorage.getItem('itemsJson')
                    itemJsonArray = JSON.parse(itemJsonArrayStr);
                }
                // Populate the table
                let tableBody = document.getElementById("tableBody");
                let str = "";
                itemJsonArray.forEach((element, index) => {
                    str += `
                    <tr>
                    <th scope="row">${index + 1}</th>
                    <td>${element[0]}</td>
                    <td>${element[1]}</td> 
                    <td><button class="btn btn-sm btn-primary" onclick="deleted(${index})">Delete</button></td> 
                    </tr>`;
                });
                tableBody.innerHTML = str;
                document.getElementById('title').value = "";
                document.getElementById('description').value = "";
                document.getElementById('title').focus();
            }
            add = document.getElementById("add");
            add.addEventListener("click", getAndUpdate);
            document.getElementById("description").addEventListener("keydown", function(e) {
                if (e.keyCode === 13) {
                    getAndUpdate();
                }
            })
            update();

            function deleted(itemIndex) {
                console.log("Delete", itemIndex);
                itemJsonArrayStr = localStorage.getItem('itemsJson')
                itemJsonArray = JSON.parse(itemJsonArrayStr);
                // Delete itemIndex element from the array
                itemJsonArray.splice(itemIndex, 1);
                localStorage.setItem('itemsJson', JSON.stringify(itemJsonArray));
                update();

            }

            function clearStorage() {
                if (confirm("Do you areally want to clear?")) {
                    console.log('Clearing the storage')
                    localStorage.clear();
                    update()
                }
            }
        </script>

</body>

</html>