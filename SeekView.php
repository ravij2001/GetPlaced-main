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
    <title><?php echo $uname;?> | GetPlaced Profile </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
//for personal details...
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

<body>
    <div class="container-fluid">

        <div class="row" id="super-of-submenu">
            <!-- Vertical navbar -->
            <div class="vertical-nav bg-primary" id="sidebar" style="background-color: #2a2868 !important;">
                <div class="py-4 px-3 mb-4 bg-light">
                    <div class="media d-flex align-items-center">
                        <img loading="lazy" src="./uploads/profile_pics/<?php echo $profile;?>" alt="..." width="80" height="80" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                        <div class="media-body">
                            <h4 class="m-0"><?php echo $fname; ?></h4>
                            <!-- <p class="font-weight-normal text-muted mb-0">Data Devloper</p> -->
                        </div>
                    </div>
                </div>

                <p class="text-light font-weight-bold text-uppercase px-3 small pb-4 mb-0">Menu</p>

                <ul class="nav flex-column bg-primary mb-0" style="background-color: #2a2868 !important;">
                    <!-- <li class="sub-menu-active nav-link text-light" id="student_dashboard_submenu">
                        <i class="fa fa-th-large mr-3 text-light fa-fw"></i> Dashboard
                    </li>
                    <li class="nav-item nav-link text-light" id="student_preference_submenu">
                        <i class="fa fa-address-card mr-3 text-light fa-fw"></i> Preferences
                    </li>
                    <li class="nav-item nav-link text-light" id="student_apply_submenu">
                        <i class="fa fa-cubes mr-3 text-light fa-fw"></i> Apply
                    </li> -->
                    <li class="nav-item nav-link text-light" id="student_profile_submenu">
                        <i class="fa fa-picture-o mr-3 text-light fa-fw"></i> Profile
                    </li>
                    <!-- <li>
                        <a href="#" class="ml-2 mt-2">
                            <button type="button" class="btn btn-light" style="border-radius: 100pt ;">Sign Out</button>
                        </a>
                    </li> -->
                </ul>
            </div>
            <!-- End vertical navbar -->
            <!-- Page content holder -->
            <div class="page-content p-5 bg-white" id="content">
                <!-- Toggle button -->
                <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Toggle</small></button>

                <div class="titles" id="student_profile">
                    <!-- Demo content -->
                    <h2 class="display-4 text-primary font-weight-bold">PROFILE</h2>
                    <p class="lead text-dark mb-0"><?php echo $fname." ".$lname; ?></p>
                    <div class="separator"></div>
                    <br>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Profile</button>
                            <!-- <button class="nav-link" id="nav-editprofile-tab" data-bs-toggle="tab" data-bs-target="#nav-editprofile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Edit Profile</button> -->
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="bio-graph-heading">
                                <?php echo $about;?>
                            </div>
                            <div class="panel-body bio-graph-info">
                                <h1 class="mt-4">Details</h1>
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
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="titles" id="student_preference">
                                           <div class="info-box blue-bg">
                        <div class="text-left text-dark mt-4">
                                <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt">Preferences
                                </h4>
                                <h4 style="border-bottom:3px solid black;width:140px"></h4>
                            </div>
                            <div class="row col-md-6">
                                <div id="items" style="font-size:12pt;">
                                    <table class="table text-center table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col-md-2">SNo</th>
                                                <th scope="col-md-3">Skills</th>
                                                <th scope="col-md-3">Percentage</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>HTML</td>
                                                <td>100%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div> -->
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