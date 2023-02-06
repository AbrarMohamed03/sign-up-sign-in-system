<?php
require("config.php");
try {
    $conx = new PDO("mysql:host=$host;dbname=$dbname", $Login, $PW);
} catch (PDOException $e) {
    echo $e->getMessage();
}

session_start();
$name = $_SESSION['name'];

$sql = "SELECT * FROM userinfo WHERE Name = '" . $name . "';";
$table = $conx->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

</head>

<body>
    <?php while ($row = $table->fetch(PDO::FETCH_ASSOC)) { ?>
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px" <?php echo '<img src="data:image;base64,' . base64_encode($row['photo']); ?>>
                        <span class="font-weight-bold"><?PHP echo $name; ?></span>
                        <span class="text-black-50"><?php echo $row['Email']; ?></span><span>

                        </span>
                    </div>
                </div>
                <div class="col-md-5 border-right">

                    <form enctype="multipart/form-data" method="POST" action="userUpdate.php">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile Settings</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">First name</label>
                                    <input type="text" class="form-control" placeholder="first name" name="FirstNa" value="<?php echo $row['FirstNa']; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Last name</label>
                                    <input type="text" class="form-control" placeholder="Last name" name="LastNa" value="<?php echo $row['LastNa ']; ?>">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <label class="labels">Username</label>
                                    <input type="text" class="form-control" name="Name" value="<?php echo $row['Name']; ?>" readonly>
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Email</label>
                                    <input type="text" class="form-control" name="Email" value="<?php echo $row['Email']; ?>" readonly>
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Mobile Number</label>
                                    <input type="text" class="form-control" placeholder="enter phone number" name="Phone" value="<?php echo $row['Phone']; ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Address</label>
                                    <input type="text" class="form-control" placeholder="enter address" name="Adress" value="<?php echo $row['Adress']; ?>">
                                </div>
                                <div class="col-md-12">
                                    <label class="labels">Photo Profile</label>
                                    <input type="file" class="form-control" placeholder="Change profile photo" name="photo">
                                </div>
                            </div>
                            <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
                    </form>

                </div>
            </div>
            <div class="col-md-4">

                <form action="">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <h4 class="text-right">Change password</h4>
                        </div><br>
                        <div class="col-md-12">
                            <label class="labels">Old password</label>
                            <input type="text" class="form-control" placeholder="enter Old password" name="pass1">
                        </div> <br>
                        <div class="col-md-12">
                            <label class="labels">New password</label>
                            <input type="text" class="form-control" placeholder="enter New password" name="pass2">
                        </div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">change password</button></div>
                    </div>
                </form>

            </div>
        </div>
        </div>
        </div>
        </div>
    <?php } ?>
</body>

</html>