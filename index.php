<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Student Issues Resolving Blog</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="CSS/clean-blog.min.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="index.php">Student Blogspot</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="HTML/about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="HTML/createPost.php">Have an issue?</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="HTML/login.php">Login/Sign up</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="#" id="logout">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('images/home-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>Student Issues Resolving Blog</h1>
              <span class="subheading">A Blog by CSE Students</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="container">
      <div class="row">
	    <div class="input-group">
		  <input type="text" class="form-control" placeholder="Search Blog..">
		  <span class="input-group-btn">
		  <button class="btn btn-default" type="button">
			<span class="glyphicon glyphicon-search"></span>
		  </button>
		  </span>
		</div>
        <div class="col-lg-8 col-md-10 mx-auto" id="main_content">
          
        </div>
      </div>
    </div>

    <hr>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <ul class="list-inline text-center">
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                  </span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/clean-blog.min.js"></script>

	<script>
		function getUserData(id,tagId){
			$.getJSON('APIs/getUserDetails.php?id='+id,function(userData){
				$(tagId).append(userData.name);
			});
		}
		$.getJSON('APIs/getPosts.php',function(data){
			var str="";
			for(i=0;i<data.posts.length;i++){
				str+="<div class='post-preview'><a href='HTML/post.php' id='"+data.posts[i].id+"' class='postLinkClass'><h2 class='post-title'>";
				str+=data.posts[i].subject+"</h2></a><p class='post-meta'>Posted by <a href='#' id='postedById_"+data.posts[i].id+"'></a></p></div><hr/>";
				getUserData(data.posts[i].user_id,"#postedById_"+data.posts[i].id);
			}
			$("#main_content").append(str);
		});
		$(document).ready(function(){
			$('a.postLinkClass').click(function(){
				var id=$(this).attr("id");
				$.getJSON('APIs/setPostSession.php?id='+id,function(data){
					window.location.href = "HTML/post.php";
				});
				return false;
			});
			
			$("#logout").click(function(){
				$.get("APIs/deleteSessions.php",function(data){
					if(data=="success")
						window.location.href = "index.php";
				});
				return false;
			});
		});
	</script>
  </body>

</html>
