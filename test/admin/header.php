
	<?php
	$con=mysqli_connect("localhost","ossai","ossai","quiz");
	if(isset($_SESSION['alogin']))
	{
	 echo "<ol class='breadcrumb '>
			 		<li >
						<a href='index.php'>Home</a>
			 		</li>
					<li >
						<a href='signout.php'>Sign Out</a>
			 		</li>

			 	</ol>";
	 }
	 else
	 {
	 	echo "&nbsp;";
	 }
	?>
