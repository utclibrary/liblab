<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<link href="https://www.utc.edu/_resources/css/kickstrap.css" rel="stylesheet" media="screen">
	<script src="https://code.jquery.com/jquery.js"></script>
	<?php
		error_reporting(0);
		date_default_timezone_set('America/New_York');
		$ip = $_SERVER['REMOTE_ADDR'];
		$micro1 = '10.52.9.87';
		$micro2 = '10.52.12.244';
		$microA1 = '10.52.80.238';
		$microA2 = '10.52.80.154';
		$officeAS = '10.52.242.188';
		$officeBR = '10.52.242.254';
		$officeJB = '10.52.234.254';
		$allowedComps = array($micro1, $micro2, $microA1, $microA2, $officeAS, $officeBR, $officeJB);
		$errorMessage = "Your file upload has failed because: ";
		$helpMessage = "Please contact the library circulation desk at 423-425-2501 for assistance.";
		$today = date('YmdHis');
		$todayPretty = date('l, F jS, Y, h:i a');
		$fromName = 'UTC Library Scanning Station';
		$filesAllowed = 10;
		$maxFileSizeMB = 2.5;
		$maxTotalFileSizeMB = 5.0;
		$fileLimits = "<h3>Upload Limits:</h3>
			<p>Only gif, jpg, png, tif, bmp, and pdf files are accepted.</p>
			<p>Individual files are limited to $maxFileSizeMB MB.</p>
			<p>Combined file size limit is $maxTotalFileSizeMB MB.</p>";
	?>
	<script>
		<?php
		for ($i=1; $i<=$filesAllowed; $i++)
		{
			echo "function resetFile$i()
	  				{
	  					var x=document.getElementById('file$i');
	  					x.value = '';
	  				}";
		}
	  	?>
	</script>
	<style>
		body { background-color:#F5F5F5; }
	</style>
	<title>UTC Library Upload and Email Scans</title>
</head>
<body>
<div class="container">
<h1>UTC Library</h1>
<h2>Upload and Email Scans</h2>
<p><font color="red">Please be aware that files delivered to Gmail accounts (including mocs.utc.edu) are sometimes sent to the spam folder and/or delayed. We apologize for any inconvenience.</font></p>
<?php
//if (in_array($ip, $allowedComps))
//{
	if (empty($_POST['email']))
	{ ?>
		<form class='form-inline' role='form' action='<?php $_SERVER['PHP_SELF']; ?>' method='post' enctype='multipart/form-data'>
			<div class='form-group'>
				<label for='email'>Email Address:</label><input required type='email' class='form-control' id='email'  name='email'>
				<label for='subject'>Email Subject:</label><input required type='text' class='form-control' id='subject'  name='subject'>
			</div><br/>
			<?php
				for ($i=1; $i<=$filesAllowed; $i++)
				{
					echo "<div class='form-group'><label for='file$i'><strong>File ";
					if ($i<10) echo "0";
					echo "$i: </strong></label>";
						echo "<input ";
						if ($i==1) echo "required ";
						echo "type='file' name='file$i' id='file$i' style='border: 0px' onclick='resetFile$i()'/>";
					echo "</div><br/>";
				 }
			echo "<button type='submit' class='btn btn-default'>Send Files</button>";
		echo "</form>";
		echo $fileLimits;
	}
	else
	{
		$fileAllowed = '';
		$allowedExts = array("gif", "jpeg", "jpg", "png", "tif", "bmp", "pdf");
		$allowedTypes = array("image/gif", "image/jpeg", "image/jpg", "image/pjpeg", "image/x-png", "image/png", "image/tiff", "image/bmp", "application/pdf");
		$totalFileSize = 0;
		$fileCount = 0;
		for ($i=1; $i<=$filesAllowed; $i++)
		{
			$file = 'file' . $i;
			if ($_FILES[$file]["error"] != 4)
			{
				$temp = explode(".", $_FILES[$file]["name"]);
				$extension = end($temp);
				$extension = strtolower($extension);
				if (!in_array($_FILES[$file]["type"], $allowedTypes))
					$fileAllowed .= "<p><b>File " . $i . " (" . $_FILES["file$i"]["name"] . ") is not in an allowed file format:</b> " . $_FILES[$file]["type"] . "</p>";
				if ($_FILES[$file]["size"] > ($maxFileSizeMB*1024*1024))
					$fileAllowed .= "<p><b>File " . $i . " (" . $_FILES["file$i"]["name"] . ")  is too large:</b> " . round(($_FILES["file$i"]["size"]/(1000*1000)),2) . " MB</p>";
				if (!in_array($extension, $allowedExts))
					$fileAllowed .= "<p><b>File " . $i . " (" . $_FILES["file$i"]["name"] . ")  does not have an allowed extension:</b> " . $extension . "</p>";
				if ($_FILES[$file]["error"] > 0)
					$fileAllowed .= "<p><b>An undefined error has occurred (" . $_FILES[$file]["error"] . ") for File $i (" . $_FILES["file$i"]["name"] . ").</b></p><br/>";
				$totalFileSize += $_FILES[$file]["size"];
				$fileCount++;
			}
		}
		if ($totalFileSize > ($maxTotalFileSizeMB*1024*1024))
				$fileAllowed .= "<p><b>The total file size is too large:</b> " . round(($totalFileSize /(1000*1000)),2) . " MB</p><br/>";

		if ($fileAllowed == '')
		{
			require_once($_SERVER['DOCUMENT_ROOT'].'/includes/phpmailer/PHPMailerAutoload.php');

			$email = new PHPMailer();
			$email->From = $_POST['email'];
			$email->FromName = $fromName;
			$email->Subject = $_POST['subject'];
			$email->Body = "The following files you sent from the UTC Library Scanner Station are attached.\n\n";
			for ($i=1; $i<=$filesAllowed; $i++)
			{
				if ($_FILES["file$i"]["size"] > 0)
				{
					$email->Body .= "File $i:\nUpload: " . $_FILES["file$i"]["name"] . "\n";
					$email->Body .= "Type: " . $_FILES["file$i"]["type"] . "\nSize: " . round(($_FILES["file$i"]["size"]/(1000*1000)),2) . " MB\n\n";
				}
			}
			$email->AddAddress($_POST['email']);
			for ($i=1; $i<=$filesAllowed; $i++)
			{
				if ($_FILES["file$i"]["size"] > 0)
					$email->AddAttachment($_FILES["file$i"]["tmp_name"], $_FILES["file$i"]["name"]);
			}
			if (!$email->send()) $fileAllowed .= '<p><b>The email could not send.</b></p>';
			else
			{
				echo "<h3>$fileCount files have been sent to: " . $_POST["email"] . "</h3>";
				echo "<p>Total File Size: " . round(($totalFileSize /(1000*1000)),2) . " MB</p><br/>";
				for ($i=1; $i<=$filesAllowed; $i++)
				{
					if ($_FILES["file$i"]["size"] > 0)
					{
						echo "<p><b>File $i: " . $_FILES["file$i"]["name"] . "</b></p>";
						echo "<p>Type: " . $_FILES["file$i"]["type"] . "</p>";
						echo "<p>Size: " . round(($_FILES["file$i"]["size"]/(1000*1000)),2) . " MB</p><br/>";
					}
				}
				echo "<h3>" . $helpMessage . "</h3>";
				//echo "<h3><a href='".$_SERVER['PHP_SELF']."'>Return to Form</a></h3>";
				echo "<form action='".$_SERVER['PHP_SELF']."'><button type='submit' class='btn btn-default'>Return to Upload and Email Scans Form</button></form>";
			}
		}
		if ($fileAllowed != '')
		{
			echo "<h3>" . $errorMessage . "</h3>";
			echo $fileAllowed;
			echo $fileLimits;
			echo "<br/><h3>" . $helpMessage . "</h3>";
		}
	}
//}
//else echo "Access Forbidden From This Computer!";
?>
</div>
</body>
</html>
