<?php //starting session
session_start();
if(isset($_SESSION['loggedin'])==true)
{ ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Inventory Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script type="text/javascript">
        $(window).on('scroll', function () {
            if ($(window).scrollTop()) {
                $('nav').addClass('black');

            } else {
                $('nav').removeClass('black');
            }
        })
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <span class="navbar-brand mb-0 h1">Navbar</span>
        </div>
        <!-- <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto" href="#">Navbar 2</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div> -->
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Right</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
        </div>
    </nav>

    <?php 
        $rname=$quantity="";
        $type='blood';
        $name= $_SESSION['userDetails']['name'];
        $status=true;
        if (!empty($_POST)) {
            if (empty($_POST['rname'])) {
                $status=false;
            }
            else {
                $rname=$_POST['rname'];
            }
            if (empty($_POST['quantity'])) {
                $status=false;
            }
            else {
                $quantity=$_POST['quantity'];
            }
    
            $servername= "localhost";
            $username= "root";
            $password= "";
            $dbname="electrothon";
    
            //create connection
            $com= new mysqli($servername, $username, $password,$dbname);
    
            //check connection
            if ($com->connect_error ) {
                die("Connection failed ".$com->connect_error);
            }
            else{
    
            if ($status) {
                $sql="INSERT INTO resources (name, type,rname, quantity) values ('$name','$type','$rname', '$quantity')";
                if ($com->query($sql)) {
                    header ("Location: blood_bank.php");
                }
                else{
                    echo "Invalid credentials. <br>";
                }
            $com->close();
            }
        }
    
        }
    ?>
    <div>

        <h1 style="text-align:center">Add Item Here</h1><br>

        <body>
            <form method="POST" class="form-inline">
                <div class="form-group">
                    <select name="rname">
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Quantity</label>
                    <input type="number" name="quantity">
                </div>
                <button type="submit" class="btn btn-default" name="add">Add item</button>

            </form>
        </body>
        <div class="main-content-inner">
            <div class="row">

                <!-- Contextual Classes start -->
                <div class="col-lg-6 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Details</h4>
                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table text-dark text-center">
                                        <thead class="text-uppercase">
                                            <tr class="table-active">
                                                <th scope="col">ID</th>
                                                <th scope="col">Group</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Action</th>



                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
               $conn = new mysqli("localhost","root","","electrothon");
               $sql = "SELECT * FROM resources WHERE type='blood'";
               $result = $conn->query($sql);
					$count=0;
               if ($result -> num_rows >  0) {
				  
                 while ($row = $result->fetch_assoc()) 
				 {
					  $count=$count+1;
                   ?>


                                            <tr>
                                                <th><?php echo $count ?></th>
                                                <th><?php echo $row["rname"]  ?></th>
                                                <th><?php echo $row["quantity"]  ?></th>

                                                <th> <a href="up" Edit</a> <a
                                                        href="editb.php?id=<?php echo $row["product_id"] ?>">Edit</a>
                                                    <!-- <a href="up" Edit</a> <a
                                                        href="deleteb.php?id=<?php echo $row["product_id"] ?>">Delete</a> -->
                                                </th>


                                            </tr>
                                            <?php
                 
                 }
               }

            ?>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                       







                    </div>
                    <!-- page container area end -->
                    <!-- offset area start -->

                    
                    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
                        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
                        crossorigin="anonymous">
                    </script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
                        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                        crossorigin="anonymous">
                    </script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                        crossorigin="anonymous">
                    </script>
</body>
<?php }else{ header ("Location: login.php"); } ?>
</body>

</html>