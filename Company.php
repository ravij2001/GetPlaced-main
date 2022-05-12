<?php
include 'connection.php';
session_start();
$company_name="";
//$json=json_encode($_SESSION);
//echo $json;
//echo $_SESSION["uname"];
if (!isset($_SESSION["uname"])) {
    echo "Error";
    header('Location:./signin.php');
}
?>
<?php
if (isset($_POST['app_stud'])) {
    //$id = $_POST['id'];
    //echo json_encode($_POST);
    $app_id = $_POST['app_id'];
    //$app_date=date('Y-m-d', strtotime($_POST['app_date']));
    $app_date = $_POST['app_date'];
    $com = $_POST['comments'];
    $app_time = $_POST['app_time'];
    $link = $_POST['link'];
    $sql = $conn->prepare("UPDATE `application_tbl` SET `is_approved`= 1 , `link`='$link' , `app_date`= '$app_date' , `app_time`= '$app_time', `comment` = '$com' where `app_id` = $app_id ");
    $sql->execute();
    //$query=$conn->prepare("SELECT * FROM `schedule_drive` WHERE `sd_id` =$id ");
    //$query->execute();
}

if (isset($_POST['app_stud_disapprove'])) {
    //$id = $_POST['id'];
    //echo json_encode($_POST);
    $app_id = $_POST['app_id'];
    $com = $_POST['comments'];
    //$app_date=date('Y-m-d', strtotime($_POST['app_date']));
    //echo $app_date;
    $sql = $conn->prepare("UPDATE `application_tbl` SET `is_approved`= -1, `comment`='$com' where `app_id` = $app_id ");
    $sql->execute();
    //$query=$conn->prepare("SELECT * FROM `schedule_drive` WHERE `sd_id` =$id ");
    //$query->execute();
}

if (isset($_POST['Approve_Drive'])) {
    $id = $_POST['id'];
    $sql = $conn->prepare("UPDATE `schedule_drive` SET `is_app_company`=1 where `sd_id` = '$id' ");
    $sql->execute();
    $query = $conn->prepare("SELECT * FROM `schedule_drive` WHERE `sd_id` =$id ");
    $query->execute();
    $r = $query->fetch();
    $company_name = $r['company_name'];
    $college_name = $r['college_name'];
    $start_date = $r['start_date'];
    $end_date = $r['end_date'];
    $time = $r['time'];
    $platform = $r['platform'];
    $req_emp = $r['req_emp'];
    $package = $r['package'];
    $offer_file = $r['offer_file'];
    //echo json_encode($r);
    //echo $r['start_date'];
    $query = $conn->prepare("INSERT INTO `approved_drive` (`company_name`, `college_name`, `start_date`, `end_date`, `time`, `platform`, `req_emp`, `package`, `offer_file`) VALUES ('$company_name', '$college_name', '$start_date', '$end_date', '$time', '$platform', $req_emp, '$package', '$offer_file' )");
    $query->execute();
}
?>


<!DOCTYPE html>
<html>

<head>
    <title><?php echo $_SESSION['uname']; ?> | GetPlaced</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" href="style_seek.css">
    <style>
    #sidebar {
        cursor: pointer !important;
    }
    </style>
</head>
<?php
$uname = $_SESSION["uname"];
$sql = $conn->prepare("SELECT * FROM `company_tbl` WHERE `company_uname` = '$uname' ");
$sql->execute();
$row = $sql->fetch();
$name = $row['company_name'];
$company_name = $name;
//echo $name;
$contact = $row['company_contact'];
$web = $row['company_web'];
$mail = $row['company_mail'];
$about = $row['company_about'];
$loc = $row['company_location'];

if (isset($_POST['drive_reschedule'])) {
    $id10 = $_POST['id10'];
    $re_start_date = $_POST['reschedule_date_start'];
    $re_end_date = $_POST['reschedule_date_end'];
    $re_time = $_POST['reschedule_date_time'];
    $re_platform = $_POST['reschedule_date_platform'];
    $comment = $_POST['comment'];

    $sql = $conn->prepare("UPDATE `schedule_drive` SET `is_app_college`= '0', `is_app_company`='1', `start_date`='$re_start_date', `end_date`='$re_end_date', `time`='$re_time', `platform`='$re_platform', `comment_com`='$comment' where `sd_id` = '$id10' ");
    if ($sql->execute()) {
        echo "<script>alert('Drive has been rescheduled. Wait for College Approval')</script>";
    } else {
        echo "<script>alert('Error')</script>";
    }
}
?>


<body>
    <div class="container-fluid">

        <div class="row">
            <!-- Vertical navbar -->
            <div class="vertical-nav bg-primary" id="sidebar" style="background-color: #2a2868 !important;">
                <div class="py-4 px-3 mb-4 bg-light">
                    <div class="media d-flex align-items-center">
                        <div class="media-body">
                            <h4 class="m-0">
                                <?php
                                echo $name;
                                ?>
                            </h4>
                            <p class="font-weight-normal text-muted mb-0 "><?php echo $loc; ?></p>
                        </div>
                    </div>
                </div>

                <p class="text-light font-weight-bold text-uppercase px-3 small pb-4 mb-0">Menu</p>

                <ul class="nav flex-column bg-primary mb-0" style="background-color: #2a2868 !important;">
                    <li class="sub-menu-active nav-link text-light" id="company_dashboard_submenu">
                        <i class="fa fa-th-large mr-3 text-light fa-fw"></i> Dashboard
                    </li>
                    <li class="nav-item nav-link text-light" id="company_student_details_submenu">
                        <i class="fa fa-address-card mr-3 text-light fa-fw"></i> Applied Students
                    </li>
                    <li class="nav-item nav-link text-light" id="company_profile_submenu">
                        <i class="fa fa-cubes mr-3 text-light fa-fw"></i> Profile
                    </li>
                    <li class="nav-item nav-link text-light" id="company_drive_submenu">
                        <i class="fa fa-picture-o mr-3 text-light fa-fw"></i> Schedule a Drive
                    </li>
                    <a href="./index.html" target="_blank" style="text-decoration: none !important; color:white;"><li class="nav-item nav-link text-light">
                        <i class="fa fa-video-camera mr-3 text-light fa-fw"></i>Meet Now
                    </li></a>
                    <li>
                        <a href="./Logout.php">
                            <button type="button" class="btn btn-light" style="border-radius: 100pt ;">Sign Out</button>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End vertical navbar -->
            <!-- Page content holder -->
            <div class="page-content p-5 bg-white" id="content">
                <!-- Toggle button -->
                <div class="toggle">
                    <button id="sidebarCollapse" type="button"
                        class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i
                            class="fa fa-bars mr-2"></i><small
                            class="text-uppercase font-weight-bold">Toggle</small></button>
                </div>
                <div class="titles" id="company_dashboard">
                    <!-- Demo content -->
                    <h2 class="display-4 text-primary font-weight-bold">DASHBOARD</h2>
                    <p class="lead text-dark mb-0">Welcome, <?php echo $uname; ?>.</p>
                    <div class="separator"></div>
                    <div class="text-left text-dark">
                        <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt;">Current Drives</h4>
                        <h4 style="border-bottom:3px solid black;width:140px"></h4>
                    </div>
                    <br>
                    <div class="card-deck">
                        <?php
                        //for college placement drives...
                        $sql = $conn->prepare("SELECT * FROM `approved_drive` WHERE `company_name` = '$name' ");
                        $sql->execute();
                        if ($sql->rowCount() > 0) {

                            while ($row = $sql->fetch()) {
                                //echo json_encode($row);
                                $college = $row['college_name'];
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
                                College : <?php echo $college; ?>
                            </div>
                            <div class="card-body">
                                Start Date: <?php echo $start; ?> <br>
                                End Date: <?php echo $end; ?> <br>
                                Time: <?php echo $time; ?> <br>
                                <!-- <button type="button" class="btn btn-primary mt-3" id="student_apply_submenu2">Apply Now!!</button> -->
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
                    <br>
                    <div class="text-left text-dark mt-4">
                        <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt">Scheduled Interviews
                        </h4>
                        <h4 style="border-bottom:3px solid black;width:140px"></h4>
                    </div>
                    <br>
                    <div class="card-deck mb-4">
                        <?php
                        if (isset($_POST['placed'])) {
                            $placeuname = $_POST['placed_uname'];
                            $placepack = $_POST['placed_pack'];
                            $pl = $conn->prepare("UPDATE `application_tbl` SET `is_placed`=1 , `app_package`='$placepack' where `seeker_uname`='$placeuname' ");
                            $pl->execute();
                        }
                        ?>
                        <?php
                        //for scheduled interviews of drives...
                        $sql = $conn->prepare("SELECT * FROM `application_tbl` WHERE `company_name` = '$name' and `is_approved` = 1 and `is_placed`= 0");
                        $sql->execute();
                        //$row = $sql->fetch();
                        if ($sql->rowCount() > 0) {
                            while ($row = $sql->fetch()) {
                                //echo json_encode($row);
                                $applicant = $row['seeker_uname'];
                                $company = $row['company_name'];
                                $inter_date = $row['app_date'];
                                $inter_time = $row['app_time'];
                                $platform = $row['platform'];
                                $link = $row['link'];

                        ?>

                        <div class="card text-dark">
                            <div class="card-header font-weight-bold">
                                Applicant : <a href="./SeekView.php?id=<?php echo $applicant; ?>"
                                    target="_blank"><?php echo $applicant; ?></a>
                            </div>
                            <div class="card-body">
                                Date: <?php echo $inter_date; ?> <br>
                                Time: <?php echo $inter_time; ?> <br>
                                Platform: <?php echo $platform; ?><br>
                                Link: <?php echo $link; ?><br>
                            </div>
                        </div>

                        <?php }
                        } else { ?>
                        <div class="card">
                            <div class="card-deck">
                                <div class="card text-dark">
                                    <div class="card-header font-weight-bold">
                                        No Scheduled Interviews.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php    }
                        ?>
                    </div>
                    <?php
                    if ($sql->rowCount() > 0) {
                    ?>
                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                        <input type="text" name="placed_uname" placeholder="User Name">
                        <br>
                        <input type="text" name="placed_pack" placeholder="Package">
                        <br>
                        <button type="submit" name="placed" class="btn btn-primary mt-3">Placed!</button>
                    </form>
                    <?php
                    }
                    ?>
                    <br><br>
                    <div class="text-left text-dark">
                        <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt;">Recently Placed
                            Candidates</h4>
                        <h4 style="border-bottom:3px solid black;width:140px"></h4>
                    </div>
                    <div class="col-md-12 p-0">
                        <div style="font-size:12pt; color: #2a2868;">
                            <table class="table text-center table-bordered" id="recently_placed">
                                <thead>
                                    <tr>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Name of
                                            Student</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">College
                                        </th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Branch
                                        </th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Package
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <?php
                                    //for college placement drives...
                                    //echo $name;
                                    $sql = $conn->prepare("SELECT * FROM `application_tbl` WHERE `company_name` = '$name' AND `is_placed`=1");
                                    $sql->execute();
                                    if ($sql->rowCount() > 0) {
                                        $rows=$sql->fetchAll();
                                        foreach($rows as $row):
                                            //echo json_encode($row);
                                            $name = $row['seeker_uname'];
                                            $college = $row['college_name'];
                                            $pack = $row['app_package'];

                                    ?>
                                    <tr>
                                        <td>
                                            <?php 
                                                        $sql=$conn->prepare("SELECT * FROM `seeker_tbl` WHERE `seeker_uname`='$name'");
                                                        $sql->execute();
                                                        $row=$sql->fetch();
                                                        $fname = $row['seeker_fname'];
                                                        $lname = $row['seeker_lname'];
                                                        echo $fname." ".$lname;
                                                    ?>
                                        </td>
                                        <td><?php echo $college; ?></td>
                                        <td>
                                            <?php 
                                                        $sql=$conn->prepare("SELECT `seeker_branch` FROM `seeker_tbl` WHERE `seeker_uname`='$name'");
                                                        $sql->execute();
                                                        $row=$sql->fetch();
                                                        $branch = $row['seeker_branch'];
                                                        echo $branch;
                                                    ?>
                                        </td>
                                        <td><?php echo $pack; ?></td>
                                    </tr>
                                    <?php endforeach;
                                    } else { ?>
                                    <tr>
                                        <td>No Previously Placed Students</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php } 
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="titles" id="company_student_details">
                    <div class="row">
                        <h2 class="display-4 text-primary font-weight-bold">APPLIED CANDIDATES</h2>
                        <!-- Demo content -->
                        <div class="separator"></div>
                        <br>
                        <div class="col-lg-10">
                            <div style="font-size:12pt;">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th style="border-bottom:2px solid #2a2868 !important" scope="col">
                                                Application ID</th>
                                            <th style="border-bottom:2px solid #2a2868 !important" scope="col">Name</th>
                                            <th style="border-bottom:2px solid #2a2868 !important" scope="col">College
                                            </th>
                                            <th style="border-bottom:2px solid #2a2868 !important" scope="col">Branch
                                            </th>
                                            <th style="border-bottom:2px solid #2a2868 !important" scope="col">
                                                Enrollment No.</th>
                                            <th style="border-bottom:2px solid #2a2868 !important" scope="col">Email
                                            </th>
                                            <th style="border-bottom:2px solid #2a2868 !important" scope="col">View CV
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">

                                        <?php 
                                                $sql = $conn->prepare("SELECT * FROM `application_tbl` WHERE `company_name` = '$company_name' AND `is_approved`=0");
                                                $sql->execute();
                                                if ($sql->rowCount() > 0) {
                                                    while ($row = $sql->fetch()) {
                                                        $uname = $row['seeker_uname'];
                                                        $app_id = $row['app_id'];
                                                        $sql2 = $conn->prepare("SELECT * FROM `seeker_tbl` WHERE `seeker_uname`='$uname' ");
                                                        $sql2->execute();
                                                        $row2 = $sql2->fetch();
                                                        $id = $row2['seeker_id'];
                                                        $name2 = $row2['seeker_fname'] . " " . $row2['seeker_lname'];
                                                        $college = $row2['seeker_college'];
                                                        $branch = $row2['seeker_branch'];
                                                        $enroll = $row2['seeker_enroll'];
                                                        $mail = $row2['seeker_mail'];
                                                        $cv = $row2['seeker_cv'];

                                                ?>

                                        <tr>
                                            <td><?php echo $app_id; ?></td>
                                            <td><a href="./SeekView.php?id=<?php echo $uname; ?>"
                                                    target="_blank"><?php echo $name2; ?></a></th>
                                            <td><?php echo $college; ?></td>
                                            <td><?php echo $branch; ?></td>
                                            <td><?php echo $enroll; ?></td>
                                            <td><?php echo $mail; ?></td>
                                            <td><a href="./uploads/cvs/<?php echo $cv; ?>" target="_blank"><button
                                                        class="btn btn-primary text-light">View</button></a></td>
                                        </tr>
                                        <?php
                                                    }
                                                    ?>
                                        <?php    } else {
                                                ?> <tr>
                                            <td>No Pending Applications</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <?php
                                                }
                                                ?>


                                    </tbody>
                                </table>
                            </div>
                            <?php if ($sql->rowCount() > 0) {
                                    ?>

                            <button class="btn btn-primary text-light" type="submit"
                                onclick="showFunction1()">Approve</button>
                            <button class="btn btn-primary text-light" type="submit"
                                onclick="showFunction2()">Disapprove</button>
                            <br><br>
                            <div id="disapprove" style="display:none">
                                <form class="g-1" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>"
                                    enctype="multipart/form-data">
                                    <div class="col-md-6">
                                        <label for="app_id" class="form-label"
                                            style="font-family:Product Sans">Application ID</label>
                                        <input type="number" class="form-control border border-dark" name="app_id"
                                            placeholder="Application ID in First Column">
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <label for="comments" class="form-label"
                                            style="font-family:Product Sans">Comments</label>
                                        <textarea name="comments" class="form-control border border-dark"
                                            rows="10"></textarea>
                                    </div><br>
                                    <div class="col-md-6">
                                        <button class="btn btn-primary text-light" type="submit"
                                            name="app_stud_disapprove">Dispprove</button>
                                    </div>
                                </form>
                            </div>
                            <div id="approve" style="display:none">
                                <form class="g-1" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>"
                                    enctype="multipart/form-data">
                                    <div class="col-md-6">
                                        <label for="app_id" class="form-label"
                                            style="font-family:Product Sans">Application ID</label>
                                        <input type="number" class="form-control border border-dark" name="app_id"
                                            placeholder="Application ID in First Column">
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <label for="date" class="form-label" style="font-family:Product Sans">Date Of
                                            Interview</label>
                                        <input type="date" class="form-control border border-dark" name="app_date"
                                            placeholder="Date of Interview">
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <label for="time" class="form-label" style="font-family:Product Sans">Time of
                                            Interview</label>
                                        <input type="time" class="form-control border border-dark" name="app_time"
                                            placeholder="Time of Interview">
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <label for="time" class="form-label" style="font-family:Product Sans">Link for
                                            Interview</label>
                                        <input type="text" class="form-control border border-dark" name="link"
                                            placeholder="Link for Interview">
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <label for="comments" class="form-label"
                                            style="font-family:Product Sans">Comments</label>
                                        <textarea name="comments" class="form-control border border-dark"
                                            rows="3"></textarea>
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <button class="btn btn-primary text-light" type="submit"
                                            name="app_stud">Approve</button>
                                    </div>
                                    <br>

                                </form>

                            </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>

                <div class="titles" id="company_profile">
                    <div class="row">
                        <!-- Demo content -->
                        <h2 class="display-4 text-primary font-weight-bold">PROFILE</h2>
                        <br><br><br>
                        <div class="text-left text-dark">
                            <h4 style="font-family: Product Sans;font-weight: 800;font-size: 18pt;">About</h4>
                            <h4 style="border-bottom:3px solid black;width:140px;margin-bottom:20px"></h4>
                            <h4
                                style="font-family: Product Sans;font-weight: 800;font-size: 16pt;color:#2a2868;margin-bottom:30px;">
                                <?php echo $about; ?></h4>
                        </div>
                        <div class="col-lg-5 col-md-6"
                            style="font-family: Product Sans;font-weight: 100;font-size: 16pt;color:#2a2868">
                            Name : <?php echo $name; ?>
                            <br>
                            <br>
                            Location : <?php echo $loc; ?>
                            <br>
                            <br>
                            Contact : <a href="tel:<?php echo $contact; ?>"><?php echo $contact; ?></a>
                            <br>
                            <br>
                            Email : <a href="mailto:<?php echo $mail; ?>"><?php echo $mail; ?></a>
                            <br>
                            <br>
                            Website : <a href="<?php echo $web; ?>"><?php echo $web; ?></a>
                        </div>

                        <div class="text-left text-dark" style="margin-top:30px;">
                            <h4 style="font-family: Product Sans;font-weight: 800;font-size: 18pt;">Past Year Placement
                                Drives</h4>
                            <h4 style="border-bottom:3px solid black;width:140px;margin-bottom:20px"></h4>
                            <div class="card-deck">
                                <?php
                                        //for college placement drives...
                                        $sql = $conn->prepare("SELECT * FROM `approved_drive` WHERE `company_name` = '$name'  and `start_date` < '2021-06-31' ");
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
                                    </div>
                                </div>
                                <br>
                                <?php }
                                        } else { ?>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-body text-dark text-center m-0" style="font-size: 18pt;">No Past
                                            Drives with Us.<br>
                                            Schedule Now.
                                        </h5>
                                    </div>
                                </div>
                                <br>
                                <?php    }
                                        ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                        if (isset($_POST['drive'])) {
                            $uploadsDir = "./uploads/drives";
                            $college = $_POST["college"];
                            $start = $_POST["Drivestart_date"];
                            $end = $_POST["Driveend_date"];
                            $time = $_POST["Drivetime"];
                            $platform = $_POST['platform'];
                            $req = $_POST['require'];
                            $pack = $_POST["package"];
                            if (!empty($_FILES['attach']['name'])) {
                                $atFile = $_FILES['attach']['name'];
                                $tmp_name = $_FILES['attach']['tmp_name'];
                                $targetFilePath  = $uploadsDir . $atFile;
                                $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                                $path = "./uploads/drives/" . time() . "_" . basename($atFile);
                                $atName = time() . "_" . basename($atFile);
                                if (move_uploaded_file($_FILES["attach"]["tmp_name"], $path)) {
                                } else {
                                    echo "<script>alert('Error In Uploading Attachment!!!')</script>";
                                    exit();
                                }
                            } else {
                                echo "<script>alert('Error In Uploading Attachment')</script>";
                                exit();
                            }
                            $sql = $conn->prepare("INSERT INTO `schedule_drive`( `college_name`, `company_name`, `start_date`,`end_date`,`time`,`platform`, `req_emp`, `package`, `offer_file`) VALUES ('$college' , '$company_name' , '$start' , '$end', '$time' , '$platform' , $req , '$pack', '$path')");
                            if ($sql->execute()) {
                                echo "<script>alert('Drive Scheduled! Wait for College to Accept.')</script>";
                            } else {
                                echo "<script>alert('Something went wrong. Please try again after Sometime.')</script>";
                            }
                        }


                        //}
                        ?>

                <div class="titles" id="company_apply">
                    <div class="row">
                        <h2 class="display-4 text-primary font-weight-bold">SCHEDULE A DRIVE</h2>
                        <br><br><br>
                        <div class="text-left text-dark mt-4">
                            <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt">Registered Colleges
                            </h4>
                            <h4 style="border-bottom:3px solid black;width:140px"></h4>
                        </div>
                        <?php 
            $sql=$conn->prepare("SELECT * FROM `college_tbl`");
            $sql->execute();
            $rows = $sql->fetchAll();
        ?>
                        <br>
                        <table class="table border border-dark table-bordered text-center text-nowrap">
                            <thead>
                                <th style="border-bottom:2px solid #2a2868 !important" scope="col">Name of College</th>
                                <th style="border-bottom:2px solid #2a2868 !important" scope="col">Address</th>
                                <th style="border-bottom:2px solid #2a2868 !important" scope="col">Contact</th>
                                <th style="border-bottom:2px solid #2a2868 !important" scope="col">Email</th>
                                <th style="border-bottom:2px solid #2a2868 !important" scope="col">Website</th>
                            </thead>
                            <?php
                foreach($rows as $row):
                    $name = $row['college_name'];
                    $address = $row['college_address'];
                    $contact = $row['college_contact'];
                    $email = $row['college_mail'];
                    $website = $row['college_web'];
                    
                    // echo $fname." ".$lname;
            ?>
                            <tbody id="table-body">
                                <tr>
                                    <td><?php echo $name ?></td>
                                    <td><?php echo $address ?></td>
                                    <td><?php echo $contact ?></td>
                                    <td><?php echo $email ?></td>
                                    <td><?php echo $website ?></td>
                                </tr>
                            </tbody>

                            <?php
            endforeach;
        ?>

                        </table>
                        <br><br><br>
                        <form class="row g-3" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>"
                            enctype="multipart/form-data">
                            <div class="col-md-6">
                                <label for="college" class="form-label">College</label>
                                <select name="college" required class="form-control border border-dark" id="college"
                                    placeholder="College">
                                    <option value="select">Select</option>
                                    <?php
                                            $sql = $conn->prepare("SELECT college_name FROM college_tbl");
                                            $sql->execute();
                                            while ($row = $sql->fetch()) {
                                                echo "<option value = '" . $row['college_name'] . "'>" . htmlspecialchars($row['college_name']) . "</option>";
                                            }
                                            ?>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="date" class="form-label" style="font-family:Product Sans">Start Date</label>
                                <input type="date" name="Drivestart_date" class="form-control border border-dark"
                                    id="inputdate">
                            </div>
                            <div class="col-md-6">
                                <label for="date" class="form-label" style="font-family:Product Sans">End Date</label>
                                <input type="date" name="Driveend_date" class="form-control border border-dark"
                                    id="inputdate">
                            </div>
                            <div class="col-md-6">
                                <label for="time" class="form-label" style="font-family:Product Sans">Time</label>
                                <input type="text" name="Drivetime" class="form-control border border-dark"
                                    id="password" placeholder="12.00 - 17.00 Hrs.">
                            </div>
                            <div class="col-md-6">
                                <label for="requirements" class="form-label"
                                    style="font-family:Product Sans">Platform</label>
                                <input type="text" name="platform" class="form-control border border-dark"
                                    id="requirements" placeholder="Platform">
                            </div>
                            <div class="col-md-6">
                                <label for="requirements" class="form-label" style="font-family:Product Sans">Total
                                    Number of Requirements</label>
                                <input type="number" name="require" placeholder="Number of Intake"
                                    class="form-control border border-dark" id="requirements">
                            </div>
                            <div class="col-md-6">
                                <label for="requirements" class="form-label"
                                    style="font-family:Product Sans">Package</label>
                                <input type="text" name="package" placeholder="4.00 to 8.00 LPA"
                                    class="form-control border border-dark" id="requirements">
                            </div>
                            <div class="col-md-6">
                                <label for="requirements" class="form-label"
                                    style="font-family:Product Sans">Attachment</label>
                                <input type="file" name="attach" class="form-control border border-dark"
                                    id="requirements">
                            </div>
                            <div class="col-6">
                                <br>
                                <button class="btn btn-primary" type="submit" name="drive"
                                    style="background-color:#2a2868;border:solid 2px green">Schedule Drive</button>
                            </div>
                        </form>

                    </div>

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
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">College</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Package</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Dates</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Time</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Attachments
                                        </th>
                                        <!-- <th style="border-bottom:2px solid #2a2868 !important" scope="col">Delete</th> -->
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <?php
                                            if (isset($_POST['Deldrive'])) {
                                                $id = $_POST['id'];
                                                $sql = $conn->prepare("DELETE FROM `approved_drive` where `drive_id` = '$id' ");
                                                $sql->execute();
                                            }
                                            ?>
                                    <?php
                                            //for college placement drives...
                                            //echo $name;
                                            $sql = $conn->prepare("SELECT * FROM `approved_drive` WHERE `company_name` = '$company_name'");
                                            $sql->execute();
                                            if ($sql->rowCount() > 0) {
                                                while ($row = $sql->fetch()) {
                                                    //echo json_encode($row);
                                                    $id = $row['drive_id'];
                                                    $college = $row['college_name'];
                                                    $pack = $row['package'];
                                                    $dates = $row['start_date'] . " to " . $row['end_date'];
                                                    $time = $row['time'];
                                                    $att = $row['offer_file'];
                                                    //$pack=$row['package'];
                                                    //$file=$row['offer_file'];

                                            ?>
                                    <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $college; ?></td>
                                        <td><?php echo $pack; ?></td>
                                        <td><?php echo $dates; ?></td>
                                        <td><?php echo $time; ?></td>
                                        <td><a href="<?php echo $att; ?>"><button
                                                    class="btn btn-primary text-light">View</button></a></td>
                                    </tr>
                                    <?php }
                                            } else { ?>
                                    <tr>
                                        <td>No Drives right Now</td>
                                        <td></td>
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
                                    if ($sql->rowCount() > 0) {
                                    ?>
                            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                <input type="number" name="id" placeholder="Drive ID">
                                <br>
                                <button type="submit" name="Deldrive" class="btn btn-primary mt-3">Delete</button>
                            </form>
                            <?php
                                    }
                                    ?>
                        </div>
                    </div>
                    <br>
                    <div class="text-left text-dark">
                        <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt;">Pending Drives</h4>
                        <h4 style="border-bottom:3px solid black;width:140px"></h4>
                    </div>
                    <br>
                    <div class="col-md-12 p-0">
                        <div style="font-size:12pt; color: #2a2868;">
                            <table class="table text-center table-bordered">
                                <thead>
                                    <tr>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">ID</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">College</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Package</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Dates</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Time</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Attachments
                                        </th>
                                        <!-- <th style="border-bottom:2px solid #2a2868 !important" scope="col">Delete</th> -->
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <?php
                                            if (isset($_POST['Delete_Drive'])) {
                                                $id = $_POST['id'];
                                                $sql = $conn->prepare("DELETE FROM `schedule_drive` where `sd_id` = '$id' ");
                                                $sql->execute();
                                            }
                                            ?>
                                    <?php
                                            //for college placement drives...
                                            $sql = $conn->prepare("SELECT * FROM `schedule_drive` WHERE `company_name` = '$company_name' and `is_app_college`= 0");
                                            $sql->execute();
                                            if ($sql->rowCount() > 0) {
                                                while ($row = $sql->fetch()) {
                                                    //echo json_encode($row);
                                                    $id = $row['sd_id'];
                                                    $college = $row['college_name'];
                                                    $pack = $row['package'];
                                                    $dates = $row['start_date'] . " to " . $row['end_date'];
                                                    $time = $row['time'];
                                                    $att = $row['offer_file'];
                                                    //$pack=$row['package'];
                                                    //$file=$row['offer_file'];

                                            ?>
                                    <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $college; ?></td>
                                        <td><?php echo $pack; ?></td>
                                        <td><?php echo $dates; ?></td>
                                        <td><?php echo $time; ?></td>
                                        <td><a href="<?php echo $att; ?>" target='_blank'><button
                                                    class="btn btn-primary text-light">View</button></a></td>
                                        <!--  -->

                                    </tr>
                                    <?php }
                                            } else { ?>
                                    <tr>
                                        <td>No Drives right Now</td>
                                        <td></td>
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
                                    if ($sql->rowCount() > 0) {
                                    ?>
                            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                <input type="number" name="id" placeholder="Drive ID">
                                <br>
                                <button type="submit" name="Delete_Drive" class="btn btn-primary mt-3">Delete</button>
                            </form>
                            <?php
                                    }
                                    ?>
                        </div>
                    </div>

                    <div class="text-left text-dark">
                        <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt;">Rescheduled Drives by
                            College</h4>
                        <h4 style="border-bottom:3px solid black;width:140px"></h4>
                    </div>
                    <br>
                    <div class="col-md-12 p-0">
                        <div style="font-size:12pt; color: #2a2868;">
                            <table class="table text-center table-bordered">
                                <thead>
                                    <tr>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">ID</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">College</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Package</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Dates</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Time</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Comments By
                                            College</th>
                                        <th style="border-bottom:2px solid #2a2868 !important" scope="col">Attachments
                                        </th>
                                        <!-- <th style="border-bottom:2px solid #2a2868 !important" scope="col">Delete</th> -->
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <?php
                                            //for college placement drives...
                                            $sql = $conn->prepare("SELECT * FROM `schedule_drive` WHERE `company_name` = '$company_name' and `is_app_college`= 1 and `is_app_company`= 0");
                                            $sql->execute();
                                            if ($sql->rowCount() > 0) {
                                                while ($row = $sql->fetch()) {
                                                    //echo json_encode($row);
                                                    $id = $row['sd_id'];
                                                    $college = $row['college_name'];
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
                                        <td><?php echo $college; ?></td>
                                        <td><?php echo $pack; ?></td>
                                        <td><?php echo $dates; ?></td>
                                        <td><?php echo $time; ?></td>
                                        <td><?php echo $com; ?></td>
                                        <td><a href="<?php echo $att; ?>" target='_blank'><button
                                                    class="btn btn-primary text-light">View</button></a></td>
                                        <!--  -->

                                    </tr>
                                    <?php }
                                            } else { ?>
                                    <tr>
                                        <td>No Drives right Now</td>
                                        <td></td>
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
                                    if ($sql->rowCount() > 0) {
                                    ?>
                            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                <input type="number" name="id" placeholder="Seeker ID">
                                <br>

                                <button type="submit" name="Approve_Drive" class="btn btn-primary mt-3">Approve</button>
                                <button type="submit" name="Delete_Drive" class="btn btn-primary mt-3">Delete</button>
                            </form>
                            <button type="submit" name="reschedule" onclick="showFunction()"
                                class="btn btn-primary mt-3">Reschedule</button>
                            <div id="reschedule" style="display:none">
                                <form class="row g-3" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>"
                                    enctype="multipart/form-data">
                                    <div class="col-md-6">
                                        <label for="date" class="form-label" style="font-family:Product Sans">Drive
                                            ID</label>
                                        <input type="number" class="form-control border border-dark" name="id10"
                                            placeholder="Drive ID">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="date" class="form-label" style="font-family:Product Sans">Start
                                            Date</label>
                                        <input type="date" name="reschedule_date_start"
                                            class="form-control border border-dark" id="inputdate">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="date" class="form-label" style="font-family:Product Sans">End
                                            Date</label>
                                        <input type="date" name="reschedule_date_end"
                                            class="form-control border border-dark" id="inputdate">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="time" class="form-label"
                                            style="font-family:Product Sans">Time</label>
                                        <input type="text" name="reschedule_date_time"
                                            class="form-control border border-dark" id="password"
                                            placeholder="12.00 - 17.00 Hrs.">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="requirements" class="form-label"
                                            style="font-family:Product Sans">Platform</label>
                                        <input type="text" name="reschedule_date_platform"
                                            class="form-control border border-dark" id="requirements"
                                            placeholder="Platform">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="comment" class="form-label"
                                            style="font-family:Product Sans">Comments</label>
                                        <textarea name="comment" class="form-control border border-dark"
                                            rows="3"></textarea>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-primary" type="submit" name="drive_reschedule"
                                            style="background-color:#2a2868;border:solid 2px green">Reschedule
                                            Drive</button>
                                    </div>
                                </form>
                            </div>
                            <?php
                                    }
                                    ?>
                        </div>
                    </div>

                </div>
            </div>
            <div>
            </div>

        </div>

    </div>

    <!-- End demo content -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js">
    </script>
    <script>
    $(document).ready(function() {

        window.count = 3;

        $('#company_dashboard').show();
        $('#company_student_details').hide();
        $('#company_profile').hide();
        $('#company_apply').hide();

        $('#company_dashboard_submenu').click(function() {
            $('#company_dashboard').show(function() {
                $('#company_dashboard_submenu').addClass('sub-menu-active')
            });
            $('#company_student_details').hide(function() {
                $('#company_student_details_submenu').removeClass('sub-menu-active')
            });
            $('#company_profile').hide(function() {
                $('#company_profile_submenu').removeClass('sub-menu-active')
            });
            $('#company_apply').hide(function() {
                $('#company_drive_submenu').removeClass('sub-menu-active')
            });
        })
        $('#company_student_details_submenu').click(function() {
            $('#company_dashboard').hide(function() {
                $('#company_dashboard_submenu').removeClass('sub-menu-active')
            });
            $('#company_student_details').show(function() {
                $('#company_student_details_submenu').addClass('sub-menu-active')
            });
            $('#company_profile').hide(function() {
                $('#company_profile_submenu').removeClass('sub-menu-active')
            });
            $('#company_apply').hide(function() {
                $('#company_drive_submenu').removeClass('sub-menu-active')
            });
        })
        $('#company_profile_submenu').click(function() {
            $('#company_dashboard').hide(function() {
                $('#company_dashboard_submenu').removeClass('sub-menu-active')
            });
            $('#company_student_details').hide(function() {
                $('#company_student_details_submenu').removeClass('sub-menu-active')
            });
            $('#company_profile').show(function() {
                $('#company_profile_submenu').addClass('sub-menu-active')
            });
            $('#company_apply').hide(function() {
                $('#company_drive_submenu').removeClass('sub-menu-active')
            });
        })
        $('#company_drive_submenu').click(function() {
            $('#company_dashboard').hide(function() {
                $('#company_dashboard_submenu').removeClass('sub-menu-active')
            });
            $('#company_student_details').hide(function() {
                $('#company_student_details_submenu').removeClass('sub-menu-active')
            });
            $('#company_profile').hide(function() {
                $('#company_profile_submenu').removeClass('sub-menu-active')
            });
            $('#company_apply').show(function() {
                $('#company_drive_submenu').addClass('sub-menu-active')
            });
        })
    })

    $(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar, #content').toggleClass('active');
        });
    });

    $(document).ready(function() {
        $('#recently_placed').DataTable();
    });

    function show(divId) {
        $("#" + divId).show();
    }

    function hide(divId) {
        $("#" + divId).hide();
    }

    function showFunction() {
        show('reschedule');
    }

    function showFunction1() {
        show('approve');
        hide('disapprove');
    }

    function showFunction2() {
        show('disapprove');
        hide('approve');
    }
    </script>
</body>

</html>