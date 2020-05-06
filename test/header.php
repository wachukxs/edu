<style type="text/css">

</style>


	<?php
	if(isset($_SESSION['login']))
	{
		 "Hi " .($_SESSION['login']);

	 echo "<ol class='breadcrumb '>
			 		<li >
						<a href='index.html'>Home</a>
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
