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
            <p class="lead"> This section is intended for prospective buyers.<p>
            <hr class="my-4">
            <form method="GET" action="buyer.php">
                <select name="propertyType" onchange='this.form.submit()'>
                    <option selected> Select a County </option>

                    <?php 
                    //Saving the connection through a set of global variables from config file
                    //establishing the credentials and testuser name necessery for connecting to the DB hosted on VM
                    //if mistake is found in connection process, the connection is not continued
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME); 
                    if ( mysqli_connect_errno() )  
                    { 
                        die( mysqli_connect_error() );   
                    }
                    $sql = "SELECT DISTINCT county FROM county";
                    //Saving the location of the project after the sql statement through storing it in a row variable
                    // where $ is analogous to a var keyword from JS in php-->

                    if ($result = mysqli_query($connection, $sql))  
                    { 
                        //Stores query results as part of a row variable
                        // loop through the data 
                        while($row = mysqli_fetch_assoc($result)) 
                        { 
                            echo '<option value="' . $row['county'] . '">';
                            echo $row['county'].' County';
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
                    if (isset($_GET['propertyType']) )
                    { 
                ?> 
                <p>&nbsp;</p> 
                <table class="table table-hover"> 
                    <thead> 
                        <tr class="table-success"> 
                            <th scope="col">County</th>
                            <th scope="col">Parcel_ID</th>
                            <th scope="col">Building Quality</th>
                            <th scope="col">Land Value</th>
                            <th scope="col">Improvements Value</th>
                        </tr> 
                    </thead> 
                    <?php            
                        if ( mysqli_connect_errno() )  
                        { 
                            die( mysqli_connect_error() );   
                        } 
                        $sql = "SELECT landparcel.County, landparcel.parcel_id, building.quality, building.property_type, taxinfo.assessed_land_val, taxinfo.assessed_improvements_val
                            FROM taxinfo, building, landparcel
                            WHERE landparcel.county = '{$_GET['propertyType']}' AND
                                  building.parcel_id = landparcel.parcel_id AND
                                  landparcel.parcel_id = taxinfo.parcel_id AND
                                  taxinfo.tax_yr = 2023;";

                        if ($result = mysqli_query($connection, $sql))  
                        { 
                            while($row = mysqli_fetch_assoc($result)) 
                            { 
                    ?> 
                    <tr> 
                        <td><?php echo $row['County'] ?></td>
                        <td><?php echo $row['parcel_id'] ?></td>
                        <td><?php echo $row['quality'] ?></td>
                        <td><?php echo $row['assessed_land_val'] ?></td>
                        <td><?php echo $row['assessed_improvements_val'] ?></td>
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
