<?php require_once('config.php');?>
<!-- Assignment 4 Template -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="/images/logo.jpeg"/>
        <title>ParcelPortal</title>
        <!-- add a reference to the external stylesheet -->
        <link rel="stylesheet" href="https://bootswatch.com/4/journal/bootstrap.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>

            body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
            .myLink {display: none}
        </style>
    </head>
    <body>
        <!-- START -- Add HTML code for the top menu section (navigation bar) -->
<div class="w3-bar w3-white w3-border-bottom w3-xlarge">
    <a href="index.php" class="w3-bar-item w3-button w3-text-blue w3-hover-blue"><b>ParcelPortal</b></a>
</div>

    <!-- END -- Add HTML code for the top menu section (navigation bar) -->
    <div class="jumbotron"> 
        <p class="lead"> We found the following data to be of value for home owners <p> 
        <hr class="my-4"> 
        <form method="GET" action="owner.php"> 
            <select name="parcel" onchange='this.form.submit()'> 
                <option selected> Select Address </option> 

                    <?php 
                    //Saving the connection through a set of global variables from config file
                    //establishing the credentials and testuser name necessery for connecting to the DB hosted on VM
                    //if mistake is found in connection process, the connection is not continued

                    // Drop Down Menu Query:
                    // As a parcel owner, chose your parcel address (street, city, zip, county) to see tax information.
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME); 
                    if ( mysqli_connect_errno() )  
                    { 
                        die( mysqli_connect_error() );   
                    } 
                    $sql = "select Parcel_ID, Street, City, Zip, County from landparcel";
                    //Saving the location of the project after the sql statement through storing it in a row variable
                    // where $ is analogous to a var keyword from JS in php-->

                    // Result Query From Drop Down Menu Query:
                    // Show relevant tax information from chosen parcel.
                    if ($result = mysqli_query($connection, $sql))  
                    { 
                        //Stores query results as part of a row variable
                        // loop through the data 
                        while($row = mysqli_fetch_assoc($result)) 
                        { 
                            echo '<option value="' . $row['Parcel_ID'] . '">';
                            echo $row['Street']. ' '. $row['City']. ' ' . $row['Zip'] . ' ' . $row['County'] . ', WA';
                            echo "</option>"; 
                        } 
                        // release the memory used by the result set 
                        mysqli_free_result($result);  
                    }  
                    ?>  
                </select> 
                <?php 
                if ($_SERVER["REQUEST_METHOD"] == "GET")  
                { 
                    if (isset($_GET['parcel']) )
                    { 
                ?> 
                <p>&nbsp;</p> 
                <table class="table table-hover"> 
                    <thead> 
                        <tr class="table-success"> 
                            <th scope="col">Parcel ID</th>
                            <th scope="col">Street</th>
                            <th scope="col">City</th>
                            <th scope="col">Zip</th>
                            <th scope="col">Assessed Land Value</th>
                            <th scope="col">Assessed Improvements Value</th>
                            <th scope="col">Total Assessed Value</th>
                            <th scope="col">Tax Year</th>
                            <th scope="col">% Tax Incr. From Previous Year</th>
                        </tr> 
                    </thead> 
                    <?php            
                        if ( mysqli_connect_errno() )  
                        { 
                            die( mysqli_connect_error() );   
                        } 
                        $sql = "SELECT LP.Parcel_ID PID, Street, City, Zip, 
                                    Assessed_Land_Val LAND, Assessed_Improvements_Val IMP, 
                                    (Assessed_Land_Val + Assessed_Improvements_Val) TOT,
                                    Tax_Yr TY, TI.Pct_Tax_Change TINC
                            FROM landparcel LP JOIN taxinfo TI ON LP.Parcel_ID = TI.Parcel_ID
                            WHERE LP.Parcel_ID = {$_GET['parcel']};";


                        if ($result = mysqli_query($connection, $sql))  
                        { 
                            while($row = mysqli_fetch_assoc($result)) 
                            { 
                    ?> 
                    <tr> 
                        <td><?php echo $row['PID'] ?></td>
                        <td><?php echo $row['Street'] ?></td>
                        <td><?php echo $row['City'] ?></td>
                        <td><?php echo $row['Zip'] ?></td>
                        <td><?php echo $row['LAND'] ?></td>
                        <td><?php echo $row['IMP'] ?></td>
                        <td><?php echo $row['TOT'] ?></td>
                        <td><?php echo $row['TY'] ?></td>
                        <td><?php echo $row['TINC'] ?></td>
                    </tr> 
                    <?php 
                            } 
                            // release the memory used by the result set 
                            mysqli_free_result($result);  
                        }  
                    } // end if (isset) 
                } // end if ($_SERVER) 
                    ?> 
                </table> 
            </form> 
            </div>
        </body>
        </html>
