<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="/images/logo.jpeg"/>

<title>ParcelPortal</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .parallax {
        /* The image used */
        background-image: url("/images/BG_w.jpg");

        /* Set a specific height */
        min-height: 500px;

        /* Create the parallax scrolling effect */
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
}
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
.myLink {display: none}
</style>
</head>
<body class="w3-light-grey">

<!-- Navigation Bar -->
<div class="w3-bar w3-white w3-border-bottom w3-xlarge">
    <a href="#" class="w3-bar-item w3-button w3-text-blue w3-hover-blue"><b>ParcelPortal</b></a>
    <div class="logo-image" >
        <img src="/images/logo.jpeg" class="img-fluid" style="width: auto; height: auto;max-width: 40px;max-height: 40px;  padding-top: 8px;">
    </div>
</div>

<!-- Header -->
<header class="w3-display-container w3-content w3-hide-small" style="max-width:1500px">
    <div class="parallax"  src="/BG_w.jpg" alt="Background" style="max-width:1500px;max-height:400px" width="1500" height="100">

    </div>
    <div class="w3-display-middle" style="width:65%">
    <div class="w3-bar w3-black">
      <button class="w3-bar-item w3-button tablink" onclick="openLink(event, 'investor');"><i class="fa fa-map-marker w3-margin-right"></i>Invest</button>
        <button class="w3-bar-item w3-button tablink" onclick="openLink(event, 'owner');"><i class="fa fa-address-book w3-margin-right"></i>Evaluate your House</button>
        <button class="w3-bar-item w3-button tablink" onclick="openLink(event, 'buyer');"><i class="fa fa-user-circle-o w3-margin-right"></i>Buy your first House</button>
      <button class="w3-bar-item w3-button tablink" onclick="openLink(event, 'city');"><i class="fa fa-car w3-margin-right"></i>City Staff</button>
    </div>

    <!-- Tabs -->
    <div id="investor" class="w3-container w3-white w3-padding-16 myLink">
      <h3>Invest with us!</h3>
        <p><a class="w3-button w3-dark-grey" href="investor.php">Search investment opportunities</a></p>
      </div>


    <div id="buyer" class="w3-container w3-white w3-padding-16 myLink">
      <h3>Find the best houses in a city!</h3>
        <p><a class="w3-button w3-dark-grey" href="buyer.php">Search Houses</a></p>
    </div>


    <div id="owner" class="w3-container w3-white w3-padding-16 myLink">
      <h3>Find information about your house!</h3>
        <p><a class="w3-button w3-dark-grey" href="owner.php">Proceed to the database</a></p>
      </div>

     <div id="city" class="w3-container w3-white w3-padding-16 myLink">
      <h3>Find the information about your city!</h3>
         <p><a class="w3-button w3-dark-grey"  href="city.php">Look up the information about your city</a></p>
      </div>
    </div>
</header>

<!-- Page content -->
<div class="w3-content" style="max-width:1100px;">

  <!-- Good offers -->
  <div class="w3-container w3-margin-top">
    <h3>Good Offers Right Now</h3>
    <h6><strong>Best</strong> Lots in Washington.</h6>
  </div>
  <div class="w3-row-padding w3-text-white w3-large">
    <div class="w3-half w3-margin-bottom">
      <div class="w3-display-container">
        <img src="/images/k1.jpg" alt="Cinque Terre" style="width:100%">
        <span class="w3-display-bottomleft w3-padding">King County</span>
      </div>
    </div>
    <div class="w3-half">
      <div class="w3-row-padding" style="margin:0 -16px">
        <div class="w3-half w3-margin-bottom">
          <div class="w3-display-container">
            <img src="/images/land_p.jpg" alt="New York" style="width:100%">
            <span class="w3-display-bottomleft w3-padding">Pierce County</span>
          </div>
        </div>
        <div class="w3-half w3-margin-bottom">
          <div class="w3-display-container">
            <img src="/images/p2.jpg" alt="San Francisco" style="width:100%">
            <span class="w3-display-bottomleft w3-padding">Pierce County</span>
          </div>
        </div>
      </div>
      <div class="w3-row-padding" style="margin:0 -16px">
        <div class="w3-half w3-margin-bottom">
          <div class="w3-display-container">
              <img src="/images/land_k.jpg" alt="Pisa" style="width:100%">
            <span class="w3-display-bottomleft w3-padding">King County</span>
          </div>
        </div>
        <div class="w3-half w3-margin-bottom">
          <div class="w3-display-container">
            <img src="/images/p3.jpg" alt="Paris" style="width:100%">
            <span class="w3-display-bottomleft w3-padding">Pierce County</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Explore Nature -->
  <div class="w3-container">
    <h3>Explore Washington Housing Market </h3>
    <p> Look at these amazing opportunities.</p>
  </div>
  <div class="w3-row-padding">
    <div class="w3-half w3-margin-bottom">
      <img src="/images/se1.jpg" alt="King County House" style="width:100%">
      <div class="w3-container w3-white">
        <h3>Seattle, King </h3>
        <p class="w3-opacity">Evaluated at 1.2 million dollars</p>
        <p>Beautiful house outside of Seattle.</p>
        <button class="w3-button w3-margin-bottom">Get Report</button>
      </div>
    </div>
    <div class="w3-half w3-margin-bottom">
      <img src="/images/tacoma_land.jpg" alt="Austria" style="width:100%">
      <div class="w3-container w3-white">
        <h3>Tacoma, Pierce</h3>
        <p class="w3-opacity">Evaluated at 250000 dollars</p>
        <p>Piece of land perfectly fitted for the first house for a young family in Tacoma metro.</p>
        <button class="w3-button w3-margin-bottom">Get Report</button>
      </div>
    </div>
  </div>

  <!-- Contact -->
    <div class="w3-container">
    <h2 class="w3-text-blue">Contact</h2>
    <p>Let us find your next home!</p>
    <i class="fa fa-map-marker" style="width:30px"></i> Tacoma, WA<br>
        <i class="fa fa-envelope" style="width:30px"> </i> <b class="w3-text-blue">Email</b>: daniilf@uw.edu<br>
        <i class="fa fa-envelope" style="width:30px"> </i> <b class="w3-text-blue">Email</b>: chloed27@uw.edu<br>
        <i class="fa fa-envelope" style="width:30px"> </i> <b class="w3-text-blue">Email</b>: edwinsb@uw.edu<br>
        <i class="fa fa-envelope" style="width:30px"> </i> <b class="w3-text-blue">Email</b>: jpnm@uw.edu<br>
    <form action="/action_page.php" target="_blank">
        <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Name" required name="Name"></p>
        <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Email" required name="Email"></p>
      <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Message" required name="Message"></p>
      <p><button class="w3-button w3-black w3-padding-large" type="submit">SEND MESSAGE</button></p>
    </form>
  </div>
  
<!-- End page content -->
</div>

<!-- Footer -->
<footer class="w3-container w3-center w3-opacity w3-margin-bottom">
  <h5>Find Us On</h5>
  <div class="w3-xlarge w3-padding-16">
      <a href = "https://github.com/Filienko/parcelPortal" style="text-decoration:none" class="fa fa-github w3-hover-opacity"></a>
  </div>
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank" class="w3-hover-text-green">UWT</a></p>
</footer>

<script>
// Tabs
function openLink(evt, linkName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("myLink");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-blue", "");
  }
  document.getElementById(linkName).style.display = "block";
  evt.currentTarget.className += " w3-blue";
}

// Click on the first tablink on load
document.getElementsByClassName("tablink")[0].click();
</script>

</body>
</html>
