<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Student Issues Resolving Blog</title>
	
	<!-- Linked in profile-->
	<script type="text/javascript" src="https://platform.linkedin.com/badges/js/profile.js" async defer></script>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="../css/clean-blog.min.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="../index.php">Student Blogspot</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="../index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="createPost.php">Have an issue?</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php" id="loginNavBar">Login/Sign up</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="#" id="loggedIn">Logged in as </a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="#" id="logout">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('../images/about-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="page-heading">
              <h1>About</h1>
              <span class="subheading"></span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="container">
		<h2>About Website</h2><br/>
		<div>
		Are you a BMSCE Student? Then you shall definitely have problems.
		Issues related to students, faculty, administration, problems with the infrastructure of college, inadequate/improper hostel facilities and the list goes on.
		You're at right place to find someone who can give solutions to your problem. Go ahead and Sign in and Stay connected.
		</div><br/><hr/>
		<h2>About us</h2><br/>
		<div class="row">
		  <div class="col-sm-3" style="margin-left=10%">
			<div class="LI-profile-badge"  data-version="v1" data-size="medium" data-locale="en_US" data-type="vertical" data-theme="dark" data-vanity="omkar-teja">
				<a class="LI-simple-link" href='https://in.linkedin.com/in/omkar-teja?trk=profile-badge'>Omkar Teja</a>
			</div>
		  </div>
		  <div class="col-sm-3" style="margin-left=10%">
			<div class="LI-profile-badge"  data-version="v1" data-size="medium" data-locale="en_US" data-type="vertical" data-theme="dark" data-vanity="sparsha-b-m-5a3650121">
				<a class="LI-simple-link" href='https://www.linkedin.com/in/sparsha-b-m-5a3650121?trk=profile-badge'>Sparsha B M</a>
			</div>
		  </div>
		  <div class="col-sm-3" style="margin-left=10%">
			<div class="LI-profile-badge"  data-version="v1" data-size="medium" data-locale="en_US" data-type="vertical" data-theme="dark" data-vanity="nithya-arumugam-ba9b16b1">
				<a class="LI-simple-link" href='https://www.linkedin.com/in/nithya-arumugam-ba9b16b1?trk=profile-badge'>Nithya A</a>
			</div>
		  </div>
		  <div class="col-sm-3" style="margin-left=10%">
			<div class="LI-profile-badge"  data-version="v1" data-size="medium" data-locale="en_US" data-type="vertical" data-theme="dark" data-vanity="sudipto-singha-61b46a154">
				<a class="LI-simple-link" href='https://in.linkedin.com/in/sudipto-singha-61b46a154?trk=profile-badge'>Sudipto Sinha</a>
			</div>
		  </div>
		</div>
    </div>

    <hr>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="../js/clean-blog.min.js"></script>

	<script>
		var user;
		
		function getUserData(id,divId){
			$.getJSON('../APIs/getUserDetails.php?id='+id,function(userDataInPostPage){
				$(divId).append(userDataInPostPage.name);
			});
		}
		function checkLoginStatus(){
			$.getJSON('../APIs/getSession.php',function(userData){
				if(userData.user!='null'){
					$("#loginNavBar").hide();
					user=userData.user;
					getUserData(user,"#loggedIn");
				}
				else{
					$("#loggedIn").hide();
					$("#logout").hide();
					user=null;
				}
			});
		}
		
		checkLoginStatus();
		
		$("#logout").click(function(){
			$.get("../APIs/deleteSessions.php",function(data){
				if(data=="success")
					window.location.href = "../index.php";
			});
			return false;
		});
	</script>
  </body>

</html>
