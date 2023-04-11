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
            <p class="lead"> This section is intended for City clerk inquiries, credentials not required.<p>
            <hr class="my-4">
            <form method="GET" action="city.php">
                <select name="city" onchange='this.form.submit()'>
                    <option selected> Select taxpayer ID </option>

                    <?php
                    //Saving the connection through a set of global variables from config file
                    //establishing the credentials and testuser name necessery for connecting to the DB hosted on VM
                    //if mistake is found in connection process, the connection is not continued
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
                    if ( mysqli_connect_errno() )
                    {
                        die( mysqli_connect_error() );
                    } 
                    $sql = "SELECT Taxpayer_ID FROM taxpayer";
                    //Saving the location of the project after the sql statement through storing it in a row variable
                    // where $ is analogous to a var keyword from JS in php-->

                    if ($result = mysqli_query($connection, $sql))
                    {
                        //Stores query results as part of a row variable
                        // loop through the data
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo '<option value="' . $row['Taxpayer_ID'] . '">';
                            echo $row['Taxpayer_ID'];
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
                    if (isset($_GET['city']) )  
                    { 
                ?> 
                <p>&nbsp;</p> 
                <table class="table table-hover"> 
                    <thead> 
                        <tr class="table-success"> 
                            <th scope="col">Tax ID </th> 
                            <th scope="col">Parcel ID </th>
                            <th scope="col">Property types </th> 
                            <th scope="col">First </th> 
                            <th scope="col">Last </th> 
                            <th scope="col">Street </th> 
                            <th scope="col">City </th> 
                            <th scope="col">Zip </th> 
                            <th scope="col">Land Value </th> 
                            <th scope="col">% Tax change </th> 

                        </tr> 
                    </thead> 
                    <?php            
                        if ( mysqli_connect_errno() )  
                        { 
                            die( mysqli_connect_error() );   
                        } 


                        $sql =  "select T.Taxpayer_ID TAXID,  I.parcel_ID PID, B.Property_type PTYPE, 
                                    T.fname FN, T.lname LN, T.street S, T.city TCITY,
                                    T.zip Z, I.Assessed_land_val LVAL, I.Pct_Tax_Change PCTTAX
                                FROM taxpayer T
                                JOIN landparcel L on T.Taxpayer_ID = L.Taxpayer_ID
                                JOIN taxinfo I on L.Parcel_ID = I.Parcel_ID
                                JOIN building B on I.Parcel_ID = B.Parcel_ID
                                WHERE T.Taxpayer_ID = '{$_GET['city']}' ";

                        if ($result = mysqli_query($connection, $sql))  
                        { 
                            while($row = mysqli_fetch_assoc($result)) 
                            { 
                    ?> 
                    <tr> 
                        <td><?php echo $row['TAXID'] ?></td> 
                        <td><?php echo $row['PID'] ?></td>
                        <td><?php echo $row['PTYPE'] ?></td>
                        <td><?php echo $row['FN'] ?></td> 
                        <td><?php echo $row['LN'] ?></td>
                        <td><?php echo $row['S'] ?></td>
                        <td><?php echo $row['TCITY'] ?></td> 
                        <td><?php echo $row['Z'] ?></td>
                        <td><?php echo $row['LVAL'] ?></td> 
                        <td><?php echo $row['PCTTAX'] ?></td>
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
