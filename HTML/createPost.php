<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Student Issues Resolving Blog</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="../CSS/clean-blog.min.css" rel="stylesheet">

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
    <header class="masthead" style="background-image: url('../images/createPost-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="page-heading">
              <h1>Post an issue</h1>
              <span class="subheading">Create a post elaborating your concerns and get people to discuss about it!</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <p>Fill out the form below post an issue. Someone might get back to you with a solution!</p>
          <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
          <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
          <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
          <form name="sentMessage" id="loginForm" novalidate>
			<div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Subject</label>
                <input type="text" class="form-control" placeholder="Subject" id="subject" required data-validation-required-message="Please enter the subject" />
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group col-xs-12 floating-label-form-group controls">
                <label>Elaborate</label>
                <textarea rows="3" cols="100" class="form-control" placeholder="Elaborate your isuue" id="issue" required data-validation-required-message="Please elaborate your issue"></textarea>
				<p class="help-block text-danger"></p>
              </div>
            </div>
            <br>
            <div id="success"></div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary" id="postButton">Post</button>
			  <p class="help-block text-danger" id="postSubmitWarning"></p>
            </div>
          </form>
		</div>
    </div>

    <hr>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="../js/jqBootstrapValidation.js"></script>
    <script src="../js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="../js/clean-blog.min.js"></script>

	
	<script>
		function getUserData(id,divId){
			$.getJSON('../APIs/getUserDetails.php?id='+id,function(userDataInPostPage){
				$(divId).append(userDataInPostPage.name);
			});
		}
		$(document).ready(function(){
			var user;
			
			$.getJSON('../APIs/getSession.php',function(userData){
				if(userData.user=='null'){
					$("#postButton").prop('disabled', true);
					$("#postSubmitWarning").append("Please Login to Answer");
					$("#loggedIn").hide();
					$("#logout").hide();
					user=null;
				}
				else{
					$("#loginNavBar").hide();
					user=userData.user;
					getUserData(user,"#loggedIn");
				}
			});
			
			$('#postButton').click(function(){
				var description=$("#issue").val();
				var subject=$("#subject").val();
				$.ajax({
					url: "../APIs/insertPost.php",
					type: "POST",
					data: {
						userId: parseInt(user),
						subject: String(subject),
						description: String(description)
					},
					success: function(data){
						if(data.result==false)
							$("#postSubmitWarning").text("Something went wrong.");
						else
							$("#postSubmitWarning").text("Post Successful");
					}
				});
				$("#issue").val("");
				$("#subject").val("");
				return false;
			});
			
			$("#logout").click(function(){
				$.get("../APIs/deleteSessions.php",function(data){
					if(data=="success")
						window.location.href = "../index.php";
				});
				return false;
			});
		});
	</script>
  </body>

</html>
