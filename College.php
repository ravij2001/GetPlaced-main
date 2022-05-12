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
<?php
//for personal details...
$uname = $_SESSION['uname'];
$sql = $conn->prepare("SELECT * FROM `college_tbl` WHERE `college_uname` = '$uname' ");
$sql->execute();
$row = $sql->fetch();
if ($row) {
    //echo json_encode($row);
    $id = $row['college_id'];
    $name = $row['college_name'];
    $contact = $row['college_contact'];
    $mail = $row['college_mail'];
    $web = $row['college_web'];
    //$profile=$row['seeker_profile'];
    $add = $row['college_address'];
    //echo $id," + ",$fname," + ",$lname," + ",$dob," + ",$contact," + ",$mail," + ",$web," + ",$college,"  ";
} else {
    echo "<script>alert('Something went wrong! Please try again later.')</script>";
    echo "<script>window.open('./Logout.php','_self')</script>";
}
?>
<?php 
if(isset($_POST['app_pending'])){
    echo json_encode($_POST);
    $app_id=$_POST['app_id'];
    $app =$conn->prepare("UPDATE `seeker_tbl` SET `seeker_approve`= 1 WHERE `seeker_id` = $app_id"); 
    $app->execute();
}
if(isset($_POST['del_pending'])){
    $app_id=$_POST['app_id'];
    echo $app_id;
    $app=$conn->prepare("DELETE FROM `seeker_tbl` where `seeker_id` = $app_id ");
    $app->execute();
if(isset($_POST['del_app'])){
    $app_id=$_POST['app_id'];
    $app=$conn->prepare("UPDATE `seeker_tbl` SET `seeker_college`='Other' where `seeker_id` = $app_id");
    $app->execute();
}
}
?>
<?php
                                    if (isset($_POST['del_app_drive'])) {
                                        $id = $_POST['del_app_id'];
                                        $sql = $conn->prepare("DELETE FROM `approved_drive` WHERE `drive_id` = '$id' ");
                                        $sql->execute();
                                    }
                                    ?>
<head>
    <title>College Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" href="style_seek.css?v=<?php echo time(); ?>">
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
                                    if (isset($_POST['Delete_Drive'])) {
                                        $id = $_POST['id'];
                                        $sql = $conn->prepare("DELETE FROM `schedule_drive` WHERE `sd_id` = $id ");
                                        $sql->execute();
                                    }
                                    if (isset($_POST['Approve_Drive'])) {
                                        $id = $_POST['id'];
                                        $sql = $conn->prepare("UPDATE `schedule_drive` SET `is_app_college`=1 where `sd_id` = '$id' ");
                                        $sql->execute();
                                        $query = $conn->prepare("SELECT * FROM `schedule_drive` WHERE `sd_id` =$id ");
                                        $query->execute();
                                        $r = $query->fetch();
                                        $company_name=$r['company_name'];
                                        $college_name=$r['college_name'];
                                        $start_date=$r['start_date'];
                                        $end_date=$r['end_date'];
                                        $time=$r['time'];
                                        $platform=$r['platform'];
                                        $req_emp=$r['req_emp'];
                                        $package=$r['package'];
                                        $offer_file=$r['offer_file'];
                                        //echo json_encode($r);
                                        //echo $r['start_date'];
                                        $query= $conn->prepare("INSERT INTO `approved_drive` (`company_name`, `college_name`, `start_date`, `end_date`, `time`, `platform`, `req_emp`, `package`, `offer_file`) VALUES ('$company_name', '$college_name', '$start_date', '$end_date', '$time', '$platform', $req_emp, '$package', '$offer_file' )");
                                        $query->execute();
                                    }

                                    if(isset($_POST['drive_reschedule'])){
                                        $id10 = $_POST['id10'];
                                        $re_start_date = $_POST['reschedule_date_start'];
                                        $re_end_date = $_POST['reschedule_date_end'];
                                        $re_time = $_POST['reschedule_date_time'];
                                        $re_platform = $_POST['reschedule_date_platform'];
                                        $comment = $_POST['comment'];

                                        $sql = $conn->prepare("UPDATE `schedule_drive` SET `is_app_college`= '1', `is_app_company`='0', `start_date`='$re_start_date', `end_date`='$re_end_date', `time`='$re_time', `platform`='$re_platform', `comment_col`='$comment' where `sd_id` = '$id10' ");
                                        if($sql->execute()){
                                            echo "<script>alert('Drive has been rescheduled. Wait for Company Approval')</script>";
                                        }else{
                                            echo "<script>alert('Error')</script>";
                                        }
                                    }
                                    ?>
<body>
    <div class="container-fluid">

        <div class="row" id="super-of-submenu">
            <!-- Vertical navbar -->
            <div class="vertical-nav bg-primary" id="sidebar" style="background-color: #2a2868 !important;">
                <div class="py-4 px-3 mb-4 bg-light">
                    <div class="media d-flex align-items-center">
                        <!-- <img loading="lazy" src="images/logo.jpg" alt="..." width="80" height="80" class="mr-3 rounded-circle img-thumbnail shadow-sm"> -->
                        <div class="media-body">
                            <h4 class="m-0"><?php echo $name; ?></h4>
                            <p class="font-weight-normal text-muted mb-0"><?php echo $add; ?></p>
                        </div>
                    </div>
                </div>

                <p class="text-light font-weight-bold text-uppercase px-3 small pb-4 mb-0">Menu</p>

                <ul class="nav flex-column bg-primary mb-0" style="background-color: #2a2868 !important;">
                    <li class="sub-menu-active nav-link text-light" id="college_dashboard_submenu">
                        <i class="fa fa-th-large mr-3 text-light fa-fw"></i> Dashboard
                    </li>
                    <li class="nav-item nav-link text-light" id="student_details_submenu">
                        <i class="fa fa-address-card mr-3 text-light fa-fw"></i> Student Details
                    </li>
                    <li class="nav-item nav-link text-light" id="college_comp_details_submenu">
                        <i class="fa fa-cubes mr-3 text-light fa-fw"></i> Company Details
                    </li>
                    <!--                     <li class="nav-item nav-link text-light" id="college_profile_submenu">
                        <i class="fa fa-picture-o mr-3 text-light fa-fw"></i> Profile
                    </li> -->
                    <li>
                        <a href="./Logout.php" class="ml-2 mt-2">
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
                <div class="titles" id="college_dashboard">

                    <!-- Demo content -->
                    <h2 class="display-4 text-primary font-weight-bold">DASHBOARD</h2>
                    <p class="lead text-dark mb-0"><?php echo $name; ?></p>
                    <div class="separator"></div>
                    <div class="text-left text-dark">
                        <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt;">Current Drives</h4>
                        <h4 style="border-bottom:3px solid black;width:140px"></h4>
                    </div>

                    <br>
                    <div class="card-deck">
                        <?php
                        //for college placement drives...
                        $sql = $conn->prepare("SELECT * FROM `approved_drive` WHERE `college_name` = '$name' ");
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
                                        <?php echo $company ?>
                                    </div>
                                    <div class="card-body">
                                        Start Date: <?php echo $start ?> <br>
                                        End Date: <?php echo $end ?> <br>
                                        Time: <?php echo $time ?> <br>
                                        Package: <?php echo $pack ?>
                                    </div>
                                </div>
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
                    <br>
                    <div class="text-left text-dark">
                        <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt;">Recently Placed Students</h4>
                        <h4 style="border-bottom:3px solid black;width:140px"></h4>
                    </div>
                    <br>
                    <!-- profile-widget -->
                    <div class="col">
                        <div style="font-size:12pt; color: #2a2868;">
                            <table class="table text-center table-bordered" id="recently_placed">
                                <thead>
                                    <tr>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Name</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Branch</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Company</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Package</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <?php
                                    //for college placement drives...
                                    $sql = $conn->prepare("SELECT * FROM `application_tbl` WHERE `college_name` = '$name' and `is_placed`=1");
                                    $sql->execute();
                                    if ($sql->rowCount() > 0) {
                                        while ($row = $sql->fetch()) {
                                            //echo json_encode($row);
                                            $user = $row['seeker_uname'];
                                            $query = $conn->prepare("SELECT * FROM `seeker_tbl` WHERE `seeker_uname`='$user' ");
                                            $query->execute();
                                            $show=$query->fetch();
                                    ?>

                                            <tr>
                                                <td><?php echo $show['seeker_fname'] . " " . $show['seeker_lname']; ?></td>
                                                <td><?php echo $show['seeker_branch']; ?></td>
                                                <td><?php echo $row['company_name']; ?></td>
                                                <td><?php echo $row['app_package']; ?></td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>

                                            <td>No Recent Placements</td>

                                        </tr>
                                    <?php    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>

                <div class="titles" id="student_details">
                    <!-- Demo content -->
                    <h2 class="display-4 text-primary font-weight-bold">STUDENT DETAILS</h2>
                    <p class="lead text-dark mb-0"><?php echo $name; ?></p>
                    <div class="separator"></div>
                    <div class="text-left text-dark">
                        <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt;">Approval Pending Student List</h4>
                        <h4 style="border-bottom:3px solid black;width:140px"></h4>
                        <p>Please approve or disapprove students.</p>
                    </div>

                    <div class="col-md-12 p-0">
                        <table class="table text-center table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Branch</th>
                                    <th>Enrollment No.</th>
                                    <th>Passing Year</th>
                                    <th>Contact</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <?php
                                //for college placement drives...
                                $sql = $conn->prepare("SELECT * FROM `seeker_tbl` WHERE `seeker_college` = '$name' and `seeker_approve`= 0");
                                $sql->execute();
                                if ($sql->rowCount() > 0) {
                                    while ($row = $sql->fetch()) {
                                        //echo json_encode($row);
                                        $id = $row['seeker_id'];
                                        $name1 = $row['seeker_fname'] . " " . $row['seeker_lname'];
                                        $branch = $row['seeker_branch'];
                                        $enroll = $row['seeker_enroll'];
                                        $dob = $row['seeker_bdate'];
                                        $contact = $row['seeker_contact'];
                                        //$pack=$row['package'];
                                        //$file=$row['offer_file'];

                                ?>

                                        <tr>
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $name1; ?></td>
                                            <td><?php echo $branch; ?></td>
                                            <td><?php echo $enroll; ?></td>
                                            <td><?php echo $dob; ?></td>
                                            <td><?php echo $contact; ?></td>
                                        </tr>
                                    <?php }
                                } else { ?>
                                    <tr>
                                        <td>-</td>
                                        <td>No Pending Approvals</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    </tr>
                                <?php    }
                                ?>
                                
                            </tbody>
                        </table>
                        <?php
                                    if ($sql->rowCount() > 0){
                                ?>
                                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" >
                                            <input type="number" name="app_id" placeholder="Drive ID">
                                            <br>
                                            <button type="submit" name="app_pending" class="btn btn-primary mt-3">Approve</button>
                                            <button type="submit" name="del_pending" class="btn btn-primary mt-3">Delete</button> 
                                        </form>
                                <?php 
                                    }
                                ?>
                    </div>
                    <br>
                    <div class="text-left text-dark">
                        <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt;">Approved Student List</h4>
                        <h4 style="border-bottom:3px solid black;width:140px"></h4>

                    </div>
                    <br>
                    <div class="col-md-12 p-0">
                        <table class="table text-center table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Branch</th>
                                    <th>Enrollment No.</th>
                                    <th>Passing Year</th>
                                    <th>Contact</th>
                                    <!-- <th>Delete</th> -->
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <?php
                                //for college placement drives...
                                $sql = $conn->prepare("SELECT * FROM `seeker_tbl` WHERE `seeker_college` = '$name' and `seeker_approve`= 1");
                                $sql->execute();
                                if ($sql->rowCount() > 0) {
                                    while ($row = $sql->fetch()) {
                                        //echo json_encode($row);
                                        $id2=$row['seeker_id'];
                                        $name2 = $row['seeker_fname'] . " " . $row['seeker_lname'];
                                        $branch = $row['seeker_branch'];
                                        $enroll = $row['seeker_enroll'];
                                        $dob = $row['seeker_bdate'];
                                        $contact = $row['seeker_contact'];
                                        //$pack=$row['package'];
                                        //$file=$row['offer_file'];

                                ?>

                                        <tr>
                                            <td><?php echo $id2; ?></td>
                                            <td><?php echo $name2; ?></td>
                                            <td><?php echo $branch; ?></td>
                                            <td><?php echo $enroll; ?></td>
                                            <td><?php echo $dob; ?></td>
                                            <td><?php echo $contact; ?></td>
                                            
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
                                    </tr>
                                <?php    }
                                ?>
                            </tbody>
                        </table>
                        <?php
                                    if ($sql->rowCount() > 0){
                                ?>
                                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" >
                                            <input type="number" name="app_id" placeholder="Seeker ID">
                                            <br>
                                            <button type="submit" name="del_app" class="btn btn-primary mt-3">Delete</button> 
                                        </form>
                                <?php 
                                    }
                                ?>
                    </div>

                </div>

                <div class="titles" id="college_comp_details">
                    <h2 class="display-4 text-primary font-weight-bold">COMPANY DETAILS</h2>
                    <p class="lead text-dark mb-0"><?php echo $name; ?></p>
                    <div class="separator"></div>
                    <div class="text-left text-dark">
                        <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt;">Approved Drives</h4>
                        <h4 style="border-bottom:3px solid black;width:140px"></h4>
                    </div>
                    <br>
                    <div class="col-md-12 p-0">
                        <div style="font-size:12pt; color: #2a2868;">
                            <table class="table text-center table-bordered">
                                <thead>
                                    <tr>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">ID</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Company</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Package</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Dates</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Time</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Achievements</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <?php
                                    //for college placement drives...
                                    $sql = $conn->prepare("SELECT * FROM `approved_drive` WHERE `college_name` = '$name'");
                                    $sql->execute();
                                    if ($sql->rowCount() > 0) {
                                        while ($row = $sql->fetch()) {
                                            //echo json_encode($row);
                                            $id = $row['drive_id'];
                                            $company = $row['company_name'];
                                            $pack = $row['package'];
                                            $dates = $row['start_date'] . " to " . $row['end_date'];
                                            $time = $row['time'];
                                            $att = $row['offer_file'];
                                            //$pack=$row['package'];
                                            //$file=$row['offer_file'];

                                    ?>
                                            <tr>
                                                <td><?php echo $id; ?></td>
                                                <td><?php echo $company; ?></td>
                                                <td><?php echo $pack; ?></td>
                                                <td><?php echo $dates; ?></td>
                                                <td><?php echo $time; ?></td>
                                                <td><a href="<?php echo $att; ?>"><button class="btn btn-primary text-light">View</button></a></td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td></td>
                                            <td>No Drives right Now</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php    }
                                    ?>
                                </tbody>
                            </table>
                            <?php if ($sql->rowCount() > 0){
                                ?>
                                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" >
                                            <input type="number" name="del_app_id" placeholder="Drive ID">
                                            <br>
                                            <button type="submit" name="del_app_drive" class="btn btn-primary mt-3">Delete</button> 
                                        </form>
                                <?php 
                                    }
                                ?>
                        </div>
                    </div>
                    <br>
                    <div class="text-left text-dark">
                        <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt;">Pending Companies</h4>
                        <h4 style="border-bottom:3px solid black;width:140px"></h4>
                    </div>
                    <br>
                    <div class="col-md-12 p-0">
                        <div style="font-size:12pt; color: #2a2868;">
                            <table class="table text-center table-bordered">
                                <thead>
                                    <tr>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">ID</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Company</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Package</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Dates</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Time</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Attachments</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    
                                    <?php
                                    //for college placement drives...
                                    $sql = $conn->prepare("SELECT * FROM `schedule_drive` WHERE `college_name` = '$name' and `is_app_college`= 0 and `is_app_company`= 1");
                                    $sql->execute();
                                    if ($sql->rowCount() > 0) {
                                        while ($row = $sql->fetch()) {
                                            //echo json_encode($row);
                                            $id = $row['sd_id'];
                                            $company = $row['company_name'];
                                            $pack = $row['package'];
                                            $dates = $row['start_date'] . " to " . $row['end_date'];
                                            $time = $row['time'];
                                            $att = $row['offer_file'];
                                            $com = $row['comment_col'];
                                            //$pack=$row['package'];
                                            //$file=$row['offer_file'];

                                    ?>
                                            <tr>
                                                <td><?php echo $id; ?></td>
                                                <td><?php echo $company; ?></td>
                                                <td><?php echo $pack; ?></td>
                                                <td><?php echo $dates; ?></td>
                                                <td><?php echo $time; ?></td>
                                                <td><a href="<?php echo $att; ?>"><button class="btn btn-primary text-light">View</button></a></td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td></td>
                                            <td>No Drives right Now</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                                    if ($sql->rowCount() > 0){
                                ?>
                                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" >
                                            <input type="number" name="id" placeholder="Drive ID">
                                            <br>
                                            
                                            <button type="submit" name="Approve_Drive" class="btn btn-primary mt-3">Approve</button>
                                            <button type="submit" name="Delete_Drive" class="btn btn-primary mt-3">Delete</button> 
                                        </form>
                                        <button type="submit" name="reschedule" onclick="showFunction()" class="btn btn-primary mt-3">Reschedule</button>
                                        <div id="reschedule" style="display:none">
                                            <form class="row g-3" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" enctype="multipart/form-data" >
                                                <div class="col-md-6">
                                                    <label for="date" class="form-label" style="font-family:Product Sans">Drive ID</label>
                                                    <input type="number" class="form-control border border-dark" name="id10" placeholder="Drive ID">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="date" class="form-label" style="font-family:Product Sans">Start Date</label>
                                                    <input type="date" name="reschedule_date_start" class="form-control border border-dark" id="inputdate">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="date" class="form-label" style="font-family:Product Sans">End Date</label>
                                                    <input type="date" name="reschedule_date_end" class="form-control border border-dark" id="inputdate">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="time" class="form-label" style="font-family:Product Sans">Time</label>
                                                    <input type="text" name="reschedule_date_time" class="form-control border border-dark" id="password" placeholder="12.00 - 17.00 Hrs.">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="requirements" class="form-label" style="font-family:Product Sans">Platform</label>
                                                    <input type="text" name="reschedule_date_platform" class="form-control border border-dark" id="requirements" placeholder="Platform">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="comment" class="form-label" style="font-family:Product Sans">Comments</label>
                                                    <textarea name="comment" class="form-control border border-dark" rows="3"></textarea>
                                                </div>
                                                <div class="col-6">
                                                    <button class="btn btn-primary" type="submit" name="drive_reschedule" style="background-color:#2a2868;border:solid 2px green">Reschedule Drive</button>
                                                </div>
                                            </form>
                                        </div>
                                <?php 
                                    }
                                ?>

                            <div class="text-left text-dark">
                                <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt;">Reschedules Pending by Company</h4>
                                <h4 style="border-bottom:3px solid black;width:140px"></h4>
                            </div>
                            <table class="table text-center table-bordered">
                                <thead>
                                    <tr>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">ID</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Company</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Package</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Dates</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Time</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Comments by College</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Attachments</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    
                                    <?php
                                    //for college placement drives...
                                    $sql = $conn->prepare("SELECT * FROM `schedule_drive` WHERE `college_name` = '$name' and `is_app_college`= '0' or `is_app_company`= '0'");
                                    $sql->execute();
                                    if ($sql->rowCount() > 0) {
                                        while ($row = $sql->fetch()) {
                                            //echo json_encode($row);
                                            $id = $row['sd_id'];
                                            $company = $row['company_name'];
                                            $pack = $row['package'];
                                            $dates = $row['start_date'] . " to " . $row['end_date'];
                                            $time = $row['time'];
                                            $att = $row['offer_file'];
                                            $com = $row['comment_com'];
                                            //$pack=$row['package'];
                                            //$file=$row['offer_file'];

                                    ?>
                                            <tr>
                                                <td><?php echo $id; ?></td>
                                                <td><?php echo $company; ?></td>
                                                <td><?php echo $pack; ?></td>
                                                <td><?php echo $dates; ?></td>
                                                <td><?php echo $time; ?></td>
                                                <td><?php echo $com; ?></td>
                                                <td><a href="<?php echo $att; ?>"><button class="btn btn-primary text-light">View</button></a></td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td></td>
                                            <td>No Drives right Now</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
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

        <!-- End demo content -->

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
        <script>
            $(document).ready(function() {

                window.count = 3;

                $('#college_dashboard').show();
                $('#student_details').hide();
                $('#college_profile').hide();
                $('#college_comp_details').hide();

                $('#college_dashboard_submenu').click(function() {
                    $('#college_dashboard').show(function() {
                        $('#college_dashboard_submenu').addClass('sub-menu-active')
                    });
                    $('#student_details').hide(function() {
                        $('#student_details_submenu').removeClass('sub-menu-active')
                    });
                    $('#college_profile').hide(function() {
                        $('#college_profile_submenu').removeClass('sub-menu-active')
                    });
                    $('#college_comp_details').hide(function() {
                        $('#college_comp_details_submenu').removeClass('sub-menu-active')
                    });
                })
                $('#student_details_submenu').click(function() {
                    $('#college_dashboard').hide(function() {
                        $('#college_dashboard_submenu').removeClass('sub-menu-active')
                    });
                    $('#student_details').show(function() {
                        $('#student_details_submenu').addClass('sub-menu-active')
                    });
                    $('#college_profile').hide(function() {
                        $('#college_profile_submenu').removeClass('sub-menu-active')
                    });
                    $('#college_comp_details').hide(function() {
                        $('#college_comp_details_submenu').removeClass('sub-menu-active')
                    });
                })
                $('#college_profile_submenu').click(function() {
                    $('#college_dashboard').hide(function() {
                        $('#college_dashboard_submenu').removeClass('sub-menu-active')
                    });
                    $('#student_details').hide(function() {
                        $('#student_details_submenu').removeClass('sub-menu-active')
                    });
                    $('#college_profile').show(function() {
                        $('#college_profile_submenu').addClass('sub-menu-active')
                    });
                    $('#college_comp_details').hide(function() {
                        $('#college_comp_details_submenu').removeClass('sub-menu-active')
                    });
                })
                $('#college_comp_details_submenu').click(function() {
                    $('#college_dashboard').hide(function() {
                        $('#college_dashboard_submenu').removeClass('sub-menu-active')
                    });
                    $('#student_details').hide(function() {
                        $('#student_details_submenu').removeClass('sub-menu-active')
                    });
                    $('#college_profile').hide(function() {
                        $('#college_profile_submenu').removeClass('sub-menu-active')
                    });
                    $('#college_comp_details').show(function() {
                        $('#college_comp_details_submenu').addClass('sub-menu-active')
                    });
                })
            })

            $(document).ready( function () {
                $('#recently_placed').DataTable();
            } );


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

            function show(divId) {
                $("#" + divId).show();
            }
  
            function showFunction() {
                show('reschedule');
            }

        </script>
</body>

</html>