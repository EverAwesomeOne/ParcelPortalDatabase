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
        <p class="lead"> We found the following categories to be of value for investors <p> 
        <hr class="my-4"> 
        <form method="get" action="investor.php">
            <select name="option" id="query" onchange='this.form.submit()'>
                <option selected>Select Category</option>
                <option value="oh">One Family Houses</option>
                <option value="mh">Multi Family Houses</option>
                <option value="up">Undervalued Properties</option>
                <option value="gc">Gentrifying Cities</option>
                <option value="sc">In a Safe County</option>
                <option value="hc">In High Class City</option>
            </select>
        </form>

        <form method="GET"> 
            <?php 
            if ($_SERVER["REQUEST_METHOD"] == "GET")  
            { 
                if (isset($_GET['option']) )  
                { 
            ?> 
            <p>&nbsp;</p> 
            <table class="table table-hover"> 
                <thead> 
                    <tr class="table-success"> 
                        <th scope="col">Building ID </th> 
                        <th scope="col">Parcel ID </th> 
                        <th scope="col">Number of Beds </th> 
                        <th scope="col">Number of Bathrooms </th> 
                        <th scope="col">SQFT size of the building </th> 
                        <th scope="col">Quality state of the building </th> 
                        <th scope="col">Parcel City </th> 
                        <th scope="col">Parcel County </th> 
                        <th scope="col">Current Land Value </th> 
                    </tr> 
                </thead> 
                <?php           
                    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME); 

                    if ( mysqli_connect_errno() )  
                    { 
                        die( mysqli_connect_error() );   
                    } 
                    
                    $query = ($_GET['option']);
                    $oh = "oh";
                    $mh = "mh";
                    $gc = "gc";
                    $up = "up";
                    $sc = "sc";
                    $hc = "hc";

                    if(strpos($query, $oh) !== false)
                    {
                        $sql =  "SELECT B.Building_Num BID,B.Num_Bed BN,B.Num_Bath BB,B.Sqft BSQ,B.Quality BQ, P.Parcel_ID PID, P.City PC, CT.County PCC, TX.Assessed_Land_Val TXA
                    FROM county CT, taxinfo TX, landparcel P, building B
                    WHERE P.County = CT.County AND P.Parcel_ID = TX.Parcel_ID AND B.Parcel_ID = P.Parcel_ID
                    AND B.Property_Type = 'single family'
                    GROUP BY CT.COUNTY
                    ORDER BY TX.Assessed_Land_Val DESC";
                    } else if(strpos($query, $mh) !== false) {
                    $sql =  "SELECT B.Building_Num BID,B.Num_Bed BN,B.Num_Bath BB,B.Sqft BSQ,B.Quality BQ, P.Parcel_ID PID, P.City PC, CT.County PCC, TX.Assessed_Land_Val TXA
                    FROM county CT, taxinfo TX, landparcel P, building B
                    WHERE P.County = CT.County AND P.Parcel_ID = TX.Parcel_ID AND B.Parcel_ID = P.Parcel_ID
                    AND B.Property_Type = 'multi family'
                    GROUP BY CT.COUNTY
                    ORDER BY TX.Assessed_Land_Val DESC";

                    } else if(strpos($query, $gc) !== false) {
                        $sql =  "SELECT B.Building_Num BID,B.Num_Bed BN,B.Num_Bath BB,B.Sqft BSQ,B.Quality BQ, P.Parcel_ID PID, P.City PC, CT.County PCC, TX.Assessed_Land_Val TXA
                    FROM county CT, taxinfo TX, landparcel P, building B
                    WHERE P.County = CT.County AND P.Parcel_ID = TX.Parcel_ID AND P.Parcel_ID = B.Parcel_ID
                    AND CT.Pct_Age_Over_65 >
                    (SELECT AVG(Pct_Age_Over_65)
                    FROM county)
                    AND CT.Pct_Collg_Grad >
                    (SELECT AVG(Pct_Collg_Grad)
                    FROM county)                    
                    AND TX.Assessed_Land_Val <
                    (SELECT AVG(Assessed_Land_Val)
                    FROM taxinfo)
                    ORDER BY TX.Assessed_Land_Val DESC";
                    } else if(strpos($query, $up) !== false) {
                        $sql =  "SELECT B.Building_Num BID,B.Num_Bed BN,B.Num_Bath BB,B.Sqft BSQ,B.Quality BQ, P.Parcel_ID PID, P.City PC, CT.County PCC, TX.Assessed_Land_Val TXA
                    FROM county CT, taxinfo TX, landparcel P, building B
                    WHERE P.County = CT.County AND P.Parcel_ID = TX.Parcel_ID AND P.Parcel_ID = B.Parcel_ID
                    AND TX.Assessed_Land_Val <
                    (SELECT AVG(Assessed_Land_Val)
                    FROM taxinfo)
                    ORDER BY TX.Assessed_Land_Val DESC";

                    } else if(strpos($query, $sc) !== false) {
                        $sql =  "SELECT B.Building_Num BID,B.Num_Bed BN,B.Num_Bath BB,B.Sqft BSQ,B.Quality BQ, P.Parcel_ID PID, P.City PC, CT.County PCC, TX.Assessed_Land_Val TXA
                            FROM county CT, taxinfo TX, landparcel P, building B
                            WHERE P.County = CT.County AND P.Parcel_ID = TX.Parcel_ID AND B.Parcel_ID = P.Parcel_ID
                            AND CT.Pct_HS_Grad > 
                            (SELECT AVG(Pct_Age_Under_18)
                             FROM county)
                            AND CT.Pct_Unemployed <= 0.1 *
                            (SELECT AVG(Pct_Unemployed)
                             FROM county)";

                    } else if(strpos($query, $hc) !== false){
                        $sql =  "SELECT B.Building_Num BID,B.Num_Bed BN,B.Num_Bath BB,B.Sqft BSQ,B.Quality BQ, P.Parcel_ID PID, P.City PC, CT.County PCC, TX.Assessed_Land_Val TXA
                    FROM county CT, taxinfo TX, landparcel P, building B
                    WHERE P.County = CT.County AND P.Parcel_ID = TX.Parcel_ID AND B.Parcel_ID = P.Parcel_ID
                    AND CT.Pct_HS_Grad >= 70
                    AND CT.Pct_Collg_Grad >= 70";
                }
                                if ($result = mysqli_query($connection, $sql))  
                                { 
                        while($row = mysqli_fetch_assoc($result)) 
                        { 
                ?> 
                <tr> 
                    <td><?php echo $row['BID'] ?></td> 
                    <td><?php echo $row['PID'] ?></td> 
                    <td><?php echo $row['BB'] ?></td> 
                    <td><?php echo $row['BN'] ?></td> 
                    <td><?php echo $row['BSQ'] ?></td> 
                    <td><?php echo $row['BQ'] ?></td> 
                    <td><?php echo $row['PC'] ?></td> 
                    <td><?php echo $row['PCC'] ?></td> 
                    <td><?php echo $row['TXA'] ?></td> 

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
