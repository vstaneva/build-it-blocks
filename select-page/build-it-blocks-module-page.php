<!doctype html>
<html>
<head>
  <LINK href="../biy-stylesheet.css" rel="stylesheet" type="text/css">
  <meta charset="utf-8">
  <title>Module</title>

  <!-- SlidesJS Required (if responsive): Sets the page width to the device width. -->
  <meta name="viewport" content="width=device-width">
  <!-- End SlidesJS Required -->

  <!-- CSS for slidesjs.com example -->
  <link rel="stylesheet" href="css/example.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <!-- End CSS for slidesjs.com example -->

	<script type="text/javascript">
		var row=1;
		var titleArr = new Array(); 
		var descriptionArr = new Array ();
		//ONLINE editing efficiency test
		
		<?php
			include("../db-connect.php");
			$module = $_GET["id"];
			$temp = mysqli_query($con, "SELECT * FROM `applications` WHERE `moduleID`=" . $module); //get the rows
			$i=0;
			while($app = mysqli_fetch_array($temp)){
				echo "titleArr[".$i."]='" . $app['title'] . "';" ;
				echo "descriptionArr[".$i."]='" . $app['description'] . "';" ;
				$i++;
			}
		?>
		
		var maxR=titleArr.length-1;
		
		function gotoNext(){
			row++;
			if(row>maxR) row=0;
			var newTitle = titleArr[row];
			var newDescrip = descriptionArr[row];
			document.getElementById("caption").innerHTML="<h4>" + newTitle + "</h4>"  + newDescrip;
		}
		
		function gotoPrev(){
			row--;
			if(row<0) row=maxR;
			var newTitle = titleArr[row];
			var newDescrip = descriptionArr[row];
			document.getElementById("caption").innerHTML="<h4>" + newTitle + "</h4>"  + newDescrip;
		}
			
			 
		function HideInstr(){
		$(document).ready(function() {
			document.getElementById("instr").style.display="none";
			document.getElementById("overview").style.display="inline";	//show the overview
		});
		}
		
		function DisplayInstr(){
		$(document).ready(function() {
			document.getElementById("instr").style.display="inline";
			document.getElementById("overview").style.display="none";	//hide the overview
		});
		}
	</script>
	
	
	
	<!--SlidesJS stuff vvv -->
  <style>

    #slides,
    #slides2,
    #slides3 {
      display: none;
      margin-bottom:50px;
    }

    .slidesjs-navigation {
      margin-top:3px;
    }

    .slidesjs-previous {
      margin-right: 5px;
      float: left;
	  color: #000000
    }

    .slidesjs-next {
      margin-right: 5px;
      float: left;
	  color: #00ff00
    }

    .slidesjs-pagination {
      margin: 6px 0 0;
      float: right;
      list-style: none;
    }

    .slidesjs-pagination li {
      float: left;
      margin: 0 1px;
	 
    }

    .slidesjs-pagination li a {
      display: block;
      width: 13px;
      height: 0px;
      padding-top: 13px;
      /*background-image: url(img/pagination.png);*/
      background-position: 0 0;
      float: left;
      position:relative;
      top:-20px;
      /*overflow: hidden;*/
       font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	  font-size: 14px;
	  font-weight: 600;
	  line-height: 20px;
	  color: #404040;
	  background-color: #ffffff
    }

    .slidesjs-pagination li a.active,
    .slidesjs-pagination li a:hover.active {
      background-position: 0 -13px
    }

	/* PAGE NUMBER COLOR CHANGE*/
    .slidesjs-pagination li a:hover {
      background-position: 0 -26px;
	  color: #ff4040;
    }

    a:link,
    a:visited {
      color: #404040 /*333*/
    }

    a:hover > i {
      color: #ff4040
    }

   .navbar {
      overflow: hidden
    }
  </style>
  <style>
    #slides {
      display: none
    }
	/*THIS CONTROLS THE WIDTH*/
    .container {
      margin: 0 auto;
      width:360px;
      float:left;
      
    }
    
    #c1 {
    	width: 475px;
    }
    #c2 {
    	width:800px;
    }
    
    
  </style>
</head>
<body>
  <?php include("../bib-header-menu.php"); ?>
  <div>
	<?php
		include("../db-connect.php");
		$module = $_GET["id"];
		$temp = mysqli_query($con, "SELECT * FROM `module_index` WHERE `ID`=" . $module); //get the rows
		$curr_module = mysqli_fetch_array($temp);
		$curr_title = $curr_module['name'];
		$curr_author_ID = $curr_module['authorID'];
		$curr_author = mysqli_fetch_array(mysqli_query($con, "SELECT * from `author` WHERE `authorID`=" . $curr_author_ID)); // get the author's row in the Author table
		$curr_author_name = $curr_author['name']; // get the author's name
		$curr_author_name = $curr_author['name']; // get the author's name
		$curr_date = date_format(date_create($curr_module['date-posted']), 'm/d/Y');
		
		//echoing the HTML for the title, author and date:
		echo "<span class=\"module-title\">".$curr_title . "</span ><br/><span  class=\"module-subtitle\">Added by " . $curr_author_name. " on " . $curr_date. "</span>";
	?>
	
	<div style="height:1px; width:800px; background-color:#404040; margin-bottom:-4px;"> </div>
	<br/>
  </div>
  <div id="overview">
  	<div style="width:800px; border:solid red 1px">
  		<div class="container" id="c1">
    		<div id="slides" style="border:solid 1px">
    			<?php
				include("../db-connect.php");
				$module = $_GET["id"];
				$temp = mysqli_query($con, "SELECT * FROM `applications` WHERE `moduleID`=" . $module); //get the rows
				while($app = mysqli_fetch_array($temp)){
				echo "
				<div class=\"img_wrapper\">
				<img src=\"../" .$app['picture'] ." \"alt=\" \">
				</div>";
				}
				mysqli_close($con);
				?>	
      			<a href="#" class="slidesjs-previous slidesjs-navigation" onClick="gotoPrev()"><i class="icon-chevron-left icon-large"></i></a>
      			<a href="#" class="slidesjs-next slidesjs-navigation" onClick="gotoNext()"><i class="icon-chevron-right icon-large"></i></a>
      		</div>
		</div>
    <div style="display:inline-block">
    	<br/>
    	<div id="build-button" onClick= "DisplayInstr()" style="width:300px; margin:auto">
    	<img src="images/build-it.png" width="300px"/>
    	</div>
    	
    </div>
    <div id="caption">
        		<script>
        			gotoPrev(); //
        		</script>
        	</div>
  
  </div>      	
  </div>
  <div id="instr">
  <div style="width:800px; border:solid red 1px">
  	<div class="container" id="c2">
  		<div id="slides2" style="border:solid 1px">
		<?php

				include("../db-connect.php");
				$module = $_GET["id"];
				$temp = mysqli_query($con, "SELECT * FROM `steps` WHERE `moduleID`=" . $module); //get the rows
				while($array = mysqli_fetch_array($temp)){
					echo "<div id=\"instructions-slider\" style=\"border:solid 1px; width:800px\">";
						echo "\n<div class=\"img_wrapper\"><img src=\"../" .$array['image-path'] ."\" alt=\"\" style=\"width:450px; float:left; \"></div>\n";
						echo "<div style=\"float:left; width:325px; margin-left:15px \">\n";
						echo "<div style=\"margin:auto\">";
						echo "\t<h4> Step" . $array['step-number'] . "</h4>\n";
						echo "\t\t<p>". $array['step-description'] ."</p>\n";
						echo "</div>";
						echo "\t</div>";
					echo "</div>";
				}
				mysqli_close($con);
		?>
  		<a href="#" class="slidesjs-previous slidesjs-navigation"><i class="icon-chevron-left icon-large"></i></a>
      	<a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right icon-large"></i></a>
  		</div>
  	</div>
  </div>
  </div>

  <!-- SlidesJS Required: Link to jQuery -->
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <!-- End SlidesJS Required -->

  <!-- SlidesJS Required: Link to jquery.slides.js -->
  <script src="js/jquery.slides.min.js"></script>
  <!-- End SlidesJS Required -->

  <!-- SlidesJS REQUIRED FUNCTIONS -->
  <script>
    $(function() {
      $('#slides').slidesjs({
      	width: 475,
        height: 350,
        navigation:false,
        pagination: {
        	active:false
        }
      });
    });
  </script>
  
  <script>
    $(function() {
      $('#slides2').slidesjs({
      	width: 800,
        height: 480,
        navigation: false
      });
    });
  </script>
  
  <script>
		$(document).ready(function() {
			HideInstr();
		});
		 //initially hide the instructions tab.
	</script>
  <!-- End SlidesJS Required -->
  
  
  <div style="clear:both"><?php include("../biy-bottom-info.html"); ?></div
</body>
</html>
