<?php
include 'connection.php';
if (isset($_GET['id'])) {
    $uname = $_GET['id'];
}else{
    header('location: error.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo $uname; ?> | GetPlaced Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style_seek.css">
    <style>
        #sidebar {
            cursor: pointer !important;
        }
    </style>
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
//$uname = $_SESSION["uname"];
$sql = $conn->prepare("SELECT * FROM `company_tbl` WHERE `company_name` = '$uname' ");
$sql->execute();
$row = $sql->fetch();
$name = $row['company_name'];
//echo $name;
$contact = $row['company_contact'];
$web = $row['company_web'];
$mail = $row['company_mail'];
$about = $row['company_about'];
$loc = $row['company_location'];
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
                    <li class="nav-item nav-link text-light" id="company_profile_submenu">
                        <i class="fa fa-cubes mr-3 text-light fa-fw"></i> Profile
                </ul>
            </div>
            <!-- End vertical navbar -->
            <!-- Page content holder -->
            <div class="page-content p-5 bg-white" id="content">
                <!-- Toggle button -->
                <div class="toggle">
                    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>
                </div>
                        

                <div class="titles" id="company_profile">
                    <h2 class="display-4 text-primary font-weight-bold">PROFILE</h2>
                    <p class="lead text-dark mb-0"><?php echo $name; ?> </p>
                    <div class="separator"></div>
                    <br>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Profile</button>
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
                                        <p><span>Name  </span>: <?php echo $name;?></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Location </span>: <?php echo $loc; ?></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Contact</span>: <a href="tel:<?php echo $contact; ?>"><?php echo $contact; ?></a></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Email</span>: <a href="mailto:<?php echo $mail; ?>"><?php echo $mail; ?></a></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span>Website</span>: <a href="<?php echo $web; ?>"><?php echo $web; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    <div class="text-left text-dark" style="margin-top:30px;">
                        <h4 style="font-family: Product Sans;font-weight: 800;font-size: 18pt;">Past Year Placement Drives</h4>
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
                                        <h5 class="card-body text-dark text-center m-0" style="font-size: 18pt;">No Past Drives with Us.<br>
                                        </h5>
                                    </div>
                                </div>
                                <br>
                            <?php    }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
                if (isset($_POST['drive'])) {
                    $uploadsDir = "./uploads/drives";
                    $college = $_POST["college"];
                    $start_date = $_POST["Drivestart_date"];
                    $end_date = $_POST["Driveend_date"];
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
                    $sql = $conn->prepare("INSERT INTO `schedule_drive`( `college_name`, `company_name`, `start_date`,`end_date`,`time`,`platform`, `req_emp`, `package`, `offer_file`) VALUES ('$college' , '$name' , $start , $end, '$time' , '$platform' , $req , '$pack', '$path')");
                    if ($sql->execute()) {
                        echo "<script>alert('Drive Scheduled! Wait for College to Accept.')</script>";
                    } else {
                        echo "<script>alert('Something went wrong. Please try again after Sometime.')</script>";
                    }
                }


                //}
                ?>

                
            </div>
            <div>
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

            $('#company_dashboard').hide();
            $('#company_student_details').hide();
            $('#company_profile').show();
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
    </script>
</body>

</html>