<?php
//start session
session_start();

//get required files
require('functions.php');
require('config.php');

//Check if acknowledging
if (isset($_POST['message_ack'])) {
	$ack_message = $_POST['message_ack'];
	$ack_objid = $_POST['objid'];
	$session_username = $_SESSION["username"];
	$session_password = $_SESSION["password"];

	echo acknowledge($ack_objid,$ack_message,$session_username,$session_password);
   
}


//Check if pausing
if (isset($_POST['message_pause'])) {
	$pause_message = $_POST['message_pause'];
	$pause_duration = $_POST['duration'];
	$pause_objid = $_POST['objid'];
	$session_username = $_SESSION["username"];
	$session_password = $_SESSION["password"];

    echo pause($pause_objid,$pause_duration,$pause_message,$session_username,$session_password);
}


//get the XML file
$xml1 = getXML($xml_error,$prtg_ro_userpass);
$xml2 = getXML($xml_warning,$prtg_ro_userpass);


//Function to parse the XML
function showErrors($xml) {
foreach($xml->item as $item) {
		
		$objid = $item->objid;
		$probe = $item->probe;
		$device = $item->device;
		$sensor = $item->sensor;
		$status = $item->status;
		$priority = $item->priority;
		$downtimesince = $item->downtimesince;
		$message = $item->message_raw;


		//This is the URL string to get to the sensor page in PRTG Web UI, eg https://yourPRTGserver/sensor?id=
		global $prtg_server;
		global $sensor_id_url;

		$link_to_sensor = $prtg_server.$sensor_id_url;


		//Sets the background & font colour of the row depending on whether it is warning or down
		$background_colour = ($status == 'Warning ')?"#E6E600":"#B20000";
		$font_colour = ($status == 'Warning ')?"#000000":"#FFFFFF";

		//Turning the Object ID into a hyperlink to sensor in on PRTG
				echo '<tr style="background-color:'.$background_colour.'"/>';
				echo '<td style="color:'.$font_colour.'"><a href='.$link_to_sensor. $objid.' target="_blank">'.$objid.'</td>';
		?> 
				<td>
				<div style="width:100px" class="btn-group" role="group">
					<button type="button" class="btn btn-default" data-toggle="modal" data-target="#<?php echo $objid;?>_pause">
						<span class="glyphicon glyphicon-pause" aria-hidden="true"></span>
					</button>

					<button type="button" class="btn btn-default" data-toggle="modal" data-target="#<?php echo $objid;?>_ack">
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
					</button>
				</div>
		


<!--Call the Pause modal-->
	<div id="<?php echo $objid;?>_pause" class="modal fade" role="dialog">
	<div class="modal-dialog">

    <!-- Modal content-->
<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pause sensor: <?php echo $device;?> </h4>
      </div>
      <div class="modal-body">
      

      <!--Check if logged in-->
      <?php if (empty($_SESSION["password"])){
      	//Show the login modal if not logged in.
      	loginModal();

 } else { 
 	pauseModal($objid);
  } ?>
 <!--Acknowledge notification modal-->
 <div id="<?php echo $objid;?>_ack" class="modal fade" role="dialog">
	<div class="modal-dialog">

    <!-- Modal content-->
<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Acknowledge sensor: <?php echo $device;?> </h4>
      </div>
      <div class="modal-body">



      <!--Check if logged in-->
      <?php if (empty($_SESSION["password"])){ 
      	loginModal();
} else {
      acknowledgeModal($objid);
} ?>
      
</td>
		<?php
		echo '<td style="color:'.$font_colour.'">'.$probe.'</td>';
		?>


	<td>
	<a  href="modal.php?id=<?php echo $objid;?>" style="color: <?php echo $font_colour;?>" data-toggle="modal" data-target="#<?php echo $objid;?>_graph"><?php echo $device;?></a>
	   <div id="<?php echo $objid;?>_graph" class="modal fade" role="dialog">
  		<div class="modal-dialog modal-lg">
    <!-- Modal content-->
   	 <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Graphs for device: <?php echo $device;?> </h4>
      </div>
      <div class="modal-body">
       </div>
      </div>
  </div>
</div>
</td>

<?php
		echo '<td style="color:'.$font_colour.'">'.$sensor.'</td>';
		echo '<td style="color:'.$font_colour.'">'.$status.'</td>';
		echo '<td style="color:'.$font_colour.'">'.$priority.'</td>';
		echo '<td style="color:'.$font_colour.'">'.$downtimesince.'</td>';
		echo '<td style="white-space:nowrap;color:'.$font_colour.'">'.$message.'</td>';

	}
	

	}
?>


<!--HTML Section -->
<html>
<head>
<!--Make sure the cache expires-->
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="icon" type="img/ico" href="/favicon.ico">
<title> PRTG Errors and warnings </title>
<style>
a:link {
   color:inherit;
}
a:active {
	color:inherit;
}
a:visited {
	color:inherit;
}
</style>
</head>
<input type="text" id="search" placeholder="Type to search"/>
<button style="float:right" class="btn btn-primary btn-xs" onclick="StopTheClock()">Stop Refresh</button>
<div style="float:right">
<body onload="InitializeTimer(120)">
    <form id="form1" runat="server">
    <div>
        Refresh in 
            <asp:Label ID="lbltime" runat="server" Style="font-weight: bold;"></asp:Label>
        seconds
    </div>
    </form>
</body>
</div>
	
	<?php if (!empty($_SESSION["password"])){

	echo '<a href="session.php?logoff=1">Log Off</a>';
}
	else {
		echo '<a href="login.php">Login</a>';
	}
?>
</a>
	<table class="table" style="width:100%" id="tblData">
		<div class="table-responsive">
			<tr style="background-color:#efefef">
				<th>ObjectID</th>
				<th></th>
				<th>Probe</th>
				<th>Device</th>
				<th>Sensor</th>
				<th>Status</th>
				<th>Priority</th>
				<th>DowntimeSince</th>
				<th>Message</th>
			</tr>
				<?php showErrors($xml1)?>
				<?php showErrors($xml2)?>
		</div>
	</table>
<!--Search box -->
<script>
$(document).ready(function()
{
	$('#search').keyup(function()
	{
		searchTable($(this).val());
	});
});

function searchTable(inputVal)
{
	var table = $('#tblData');
	table.find('tr').each(function(index, row)
	{
		var allCells = $(row).find('td');
		if(allCells.length > 0)
		{
			var found = false;
			allCells.each(function(index, td)
			{
				var regExp = new RegExp(inputVal, 'i');
				if(regExp.test($(td).text()))
				{
					found = true;
					return false;
				}
			});
			if(found == true)$(row).show();else $(row).hide();
		}
	});
}
</script>

<script type="text/javascript" language="JavaScript">
 
        var secs;
        var timerID = null;
        var timerRunning = false;
        var delay = 1000;
 
        function InitializeTimer(seconds) {
            // Set the length of the timer, in seconds
            secs = seconds;
            StopTheClock();
            StartTheTimer();
        }
 
        function StopTheClock() {
            if (timerRunning)
                clearTimeout(timerID);
            timerRunning = false;
        }
 
        function StartTheTimer() {
            if (secs == 0) {
                StopTheClock();
                // Here's where you put something useful that's
                // supposed to happen after the allotted time.
                // For example, you could display a message:
                window.location.href = window.location.href;
            }
            else {
                //self.status = 'Remaining: ' + secs;
                document.getElementById("lbltime").innerText = secs + " ";
                secs = secs - 1;
                timerRunning = true;
                timerID = self.setTimeout("StartTheTimer()", delay);
            }
        }
    </script>
</html>