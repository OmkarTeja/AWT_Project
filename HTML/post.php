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
    <header class="masthead" style="background-image: url('../images/post-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-heading">
              <h1 id="subject"></h1>
              <span class="meta">Posted by
                <a href="#" id="postedBy"></a>
			  </span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Post Content -->
    <article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div id="postDescription">
				
			</div><br/><hr/>
			<div id="answersDiv" style="margin-left:10%">
				<h3>Answers</h3><br/>
				
			</div><br/><hr/>
			<form>
			<div class="control-group" style="margin-left:10%">
			  <div class="form-group col-xs-12 floating-label-form-group controls">
				<label>Answer</label>
				<textarea rows="3" cols="100" class="form-control" placeholder="Write an Answer" id="answerTextarea" required data-validation-required-message="Please elaborate your issue"></textarea>
			  </div>
			</div>
			<br>
			<div class="form-group" style="margin-left:10%">
			  <button type="submit" class="btn btn-primary" id="postAnswer">Post Answer</button>
			  <p class="help-block text-danger" id="answerWarning"></p>
			</div>
			</form>
          </div>
        </div>
      </div>
    </article>

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
				if(userData.user=='null'){
					$("#postAnswer").prop('disabled', true);
					$("#answerWarning").append("Please Login to Post");
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
		}
		
		
		$(document).ready(function(){
			var id;
			var i;
			
			checkLoginStatus();
			
			$.getJSON('../APIs/getPostSession.php',function(data){
				id=data.postId;
				
				$.getJSON('../APIs/getPosts.php?post_id='+id,function(postData){
					$("#subject").append(postData.posts[0].subject);
					getUserData(postData.posts[0].user_id,'#postedBy');				
					$("#postDescription").append(postData.posts[0].description);				
				});
				
				$.getJSON('../APIs/getAnswers.php?post_id='+id,function(answersData){
					var str="";
					for(i=0;i<answersData.answers.length;i++){
						str+="<div><h5 id='"+i+"'></h5>";
						getUserData(answersData.answers[i].user_id,'#'+i);
						str+=answersData.answers[i].description+"</div><br/><hr/>";
					}
					$("#answersDiv").append(str);
				});
			});
			
			$('#postAnswer').click(function(){
				var str="";
				var description=$("#answerTextarea").val();
				str+="<div><h5 id='"+i+"'></h5>";
				str+=description+"</div><br/><hr/>";
				
				$.ajax({
					url: "../APIs/insertAnswer.php",
					type: "POST",
					data: {
						userId: parseInt(user),
						postId: parseInt(id),
						description: String(description)
					},
					success : function(){
						$("#answersDiv").append(str);
						getUserData(user,'#'+i);
						i+=1;
					}
				});
				$("#answerTextarea").val("");
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
