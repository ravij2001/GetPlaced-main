<?php 
    include ('connection.php');
    include ('header.php');
?>
<div class="container">

        <div class="text-left text-dark mt-4">
            <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt">Registered Students</h4>
            <h4 style="border-bottom:3px solid black;width:140px"></h4>
        </div>
        <br>
        <?php 
            $sql=$conn->prepare("SELECT * FROM `seeker_tbl`");
            $sql->execute();
            $rows = $sql->fetchAll();
        ?>
        <table class="table border border-dark table-bordered text-center text-nowrap">
            <thead>
                <th style="border-bottom:2px solid #2a2868 !important" scope="col">Name of Student</th>
                <th style="border-bottom:2px solid #2a2868 !important" scope="col">College</th>
                <th style="border-bottom:2px solid #2a2868 !important" scope="col">Branch</th>
                <th style="border-bottom:2px solid #2a2868 !important" scope="col">Contact</th>
                <th style="border-bottom:2px solid #2a2868 !important" scope="col">Email</th>
            </thead>
            <?php
                foreach($rows as $row):
                    $fname = $row['seeker_fname'];
                    $lname = $row['seeker_lname'];
                    $col = $row['seeker_college'];
                    $branch = $row['seeker_branch'];
                    $contact = $row['seeker_contact'];
                    $email = $row['seeker_mail'];
                    
                    // echo $fname." ".$lname;
            ?>
            <tbody id="table-body">
                <tr>
                    <td><?php echo $fname." ".$lname; ?></td>
                    <td><?php echo $col ?></td>
                    <td><?php echo $branch ?></td>
                    <td><?php echo $contact ?></td>
                    <td><?php echo $email ?></td>
                </tr>
            </tbody>

            <?php
            endforeach;
        ?>

        </table>

        <div class="text-left text-dark mt-4">
            <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt">Registered Colleges</h4>
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

        <div class="text-left text-dark mt-4">
            <h4 style="font-family: Product Sans;font-weight: 800;font-size: 16pt">Registered Companies</h4>
            <h4 style="border-bottom:3px solid black;width:140px"></h4>
        </div>
        <br>
        <?php 
            $sql=$conn->prepare("SELECT * FROM `company_tbl`");
            $sql->execute();
            $rows = $sql->fetchAll();
        ?>
        <table class="table border border-dark table-bordered text-center table-responsive text-nowrap">
            <thead>
                <th style="border-bottom:2px solid #2a2868 !important" scope="col">Name of Company</th>
                <th style="border-bottom:2px solid #2a2868 !important" scope="col">Address</th>
                <th style="border-bottom:2px solid #2a2868 !important" scope="col">Contact</th>
                <th style="border-bottom:2px solid #2a2868 !important" scope="col">Email</th>
                <th style="border-bottom:2px solid #2a2868 !important" scope="col">Website</th>
            </thead>
            <?php
                foreach($rows as $row):
                    $name = $row['company_name'];
                    $address = $row['company_location'];
                    $contact = $row['company_contact'];
                    $email = $row['company_mail'];
                    $website = $row['company_web'];
                    
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
    </div>
</div>
<br>
<br>
<?php 
    include('footer.php');
?>