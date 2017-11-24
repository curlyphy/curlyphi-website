<?php
$link=mysqli_connect("localhost","Participants","Uwk@Rqm,^hP3","Registered Participants");
if(mysqli_connect_error()){
	die("There was an error connecting to the database");
}
$success = "";
$error = "";
if($_POST)
{
		if(!$_POST['name']){
			$error .= "The Name Field is Required.<br>";
		}

		if(!$_POST['email']){
			$error .= "The Email is Required.<br>";
		}

		if(!$_POST['phone']){
			$error .= "The Contact Field is Required.<br>";
		}

		if(!$_POST['clg']){
			$error .= "The College Name Field is Required.<br>";
		}

		if(!$_POST['crs']){
			$error .= "The Course Name Field is Required.";
		}
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $error .= "The Email is Invalid.<br>";
			}
			if($error != "")
		{
			$error='<div class="alert alert-danger" role="alert" ><p><strong>There were some error(s) in your form!</strong></p>' . $error .'</div>';
	  	} else{
	  		$query="SELECT id FROM users WHERE email='".mysqli_real_escape_string($link,$_POST['email'])."'";
	  		$result= mysqli_query($link,$query);

	  		if(mysqli_num_rows($result) > 0)
	  		{
	  			$error.="The email Address has already Being taken.";
	  		}
	  		else{
                              $query="SELECT id FROM users WHERE phone='".mysqli_real_escape_string($link,$_POST['phone'])."'";
	  		$result= mysqli_query($link,$query);


	  		if(mysqli_num_rows($result) > 0)
	  		{
	  			$error.="The Phone Number has already Being taken.";
	  		}else{
	  			$query="INSERT into users(name,email,phone,category,college,course,suggestion) VALUES('".mysqli_real_escape_string($link,$_POST['name'])."','".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['phone'])."','".mysqli_real_escape_string($link,$_POST['cat'])."','".mysqli_real_escape_string($link,$_POST['clg'])."','".mysqli_real_escape_string($link,$_POST['crs'])."','".mysqli_real_escape_string($link,$_POST['text'])."')";
	  			if(mysqli_query($link,$query)){
	  				$success='<div class="alert alert-success" role="alert" >Your Form Submitted Sucessfully.</div>';
	  				$to=$_POST['email'];
                                          $Sub="Registration Update";
                                           $con=$_POST['name']." ,Thank you for Registering with us.We will Update You About the Event.To Get More Regular Updates Please Visit our Website www.theappletalks.com.Also Visit Us on Facebook at https://m.facebook.com/Talksapple/?ref=bookmarks. Instagram Page -https://www.instagram.com/theappletalk/ and stay updated with our youtube channel https://www.youtube.com/channel/UCoyJKj09CBw33E0ioPU12Cg.Regards TheAppleTalks Team.";
                                            $headers="From: letsbeginthen@theappletalks.com";
                                            if(mail($to,$Sub,,$con,$headers)){
                                            $success.='<div class="alert alert-success" role="alert" >Email is Sent Successfully.</div>';
                                            }
                                            else{
                                             $error.='<div class="alert alert-danger" role="alert" >Email Couldn\'t be Sent.</div>';
                                            }
	  			}
	  			else{
	  				$error='<div class="alert alert-danger" role="alert" >Some Error Occured,Couldn\'t Register.Please Try Again Later!</div>';
	  			}
	  		}
                     }
	  		
	  	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Form</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width , initial-scale=1 , shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	 <link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
			<link rel="stylesheet" href="css/form.css" /> 
</head>
<body>
<body id="top">

		
		<header id="header" class="skel-layers-fixed">
				<nav class="nav">
				<div class="container">
	    <div class="navbar-header">
	    	<a href="test.html" class="pull-left ">
	    <div id="logo" alt="TheAppleTalks Logo"></div>
	    </a>
	    <div class="navbar-brand">
		<a href="index.html"><h1>The Apple Talks</h1></a>
	    </div></div></div></nav>
				<nav id="nav" class="">
					<ul>
						<li><a href="index.html">Home</a></li>
						<li><a href="About.html">About Us</a></li>
						<li><a href="event.html">About Event</a></li>
						<li><a href="#" class="button special">Register</a></li>
					</ul>
				</nav>
			</header>

		<section id="banner">
				<div class="inner">
					<h2>The Apple Talks</h2>
					<p>-Organised by Ace(Association of Computer Enthusiasts),<a href="http://templated.co">SGGSCC</a></p>
					<ul class="actions">
						<li><a href="index.html" class="button big special">Home</a></li>
						<li><a href="About.html" class="button big alt">About Us</a></li>
					</ul>
				</div>
			</section> 
<div class="container-fluid main">
<div id="error"><? echo $error.$success; ?></div>
<form method="post" action="form.php">
<fieldset class="form-group row">
<label for="name" class="col-sm-2">Name</label>
<div class="col-sm-4">
<input id="name" type="text" name ="name" class="form-control" placeholder="Your Name">
</div>
</fieldset>
<fieldset class="form-group row">
<label for="email" class="col-sm-2">Email Address</label>
<div class="col-sm-4">
<input id="email" type="email" name="email" class="form-control" placeholder="username@xyz.com">
</div>
</fieldset>
<fieldset class="form-group row">
<label for="phone" class="col-sm-2">Phone</label>
<div class="col-sm-4">
<input id="phone" type="tel" name="phone" class="form-control" placeholder="eg. 98554xxxxx">
<span id="helpBlock" class="help-block">*Probably with Active WhatsApp.</span>
</div></fieldset>
<fieldset class="form-group row">
<label for="cat" class="col-sm-2">Category</label>
<div class="col-sm-4">
<select id="cat" name="cat" class="form-control">
 <option>Student</option>
  <option>Teacher</option>
  <option>Other</option>
</select></div>
</fieldset>
<fieldset class="form-group row">
<label for="clg" class="col-sm-2">College Name</label>
<div class="col-sm-4">
<input id="clg" type="text" name="clg" class="form-control" placeholder="eg.Sri Guru Gobind Singh College of Commerce">
</div></fieldset>
<fieldset class="form-group row">
<label for="crs" class="col-sm-2">Course Name</label>
<div class="col-sm-4">
<input id="crs" name="crs" type="text" class="form-control" placeholder="eg.BSc.(H) Computer Science">
</div></fieldset>
<fieldset class="form-group row">
<label for="txt" class="col-sm-2">What do you Expect?</label>
<div class="col-sm-4">
<textarea id="txt" name="text" class="form-control" rows=3 placeholder="What you want from such an event.">
</textarea>
</div></fieldset>
<fieldset class="form-group">
	<button type="submit" class="btn btn-primary btn-lg btn-block">
  Register Now
</button></fieldset>
</form>
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script src="js/skel.min.js"></script>
<script src="js/skel-layers.min.js"></script> 
<script src="js/init.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/form.js">
</script>
</body>
</html>