<?php

function passhash($username,$password) {
	global $prtg_server;

		//url encode pasword
	$encoded_password = rawurlencode($password);

	$url = $prtg_server.'/api/getpasshash.htm?username='.$username.'&password='.$encoded_password.'';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents
	$data = curl_exec($ch); // execute curl request
	curl_close($ch);
		//strip HTML tags
	$no_tags = strip_tags($data);

	return $no_tags;
}


//Pause sensor
function pause($objid,$duration,$message,$session_username,$session_password) {
	global $prtg_server;
	
	$api_pause_duration = '/api/pauseobjectfor.htm?id='.$objid.'&pausemsg='.$message.'&duration='.$duration.'';
	$url = $prtg_server.$api_pause_duration.'&username='.$session_username.'&passhash='.$session_password;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents
	$data = curl_exec($ch); // execute curl request
	curl_close($ch);
	$clean = strip_tags($data);

	if (empty($clean)){
		?>
				<div class="alert alert-success fade in">
  						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  						<center><strong>Successfully Paused!</strong></center>
				</div> 

<?php
	}
	else {	
		?>
				<div class="alert alert-danger fade in">
  						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  						<center><strong>Error!</strong> Reason for failure: <?php echo $data;?></center>
				</div> 

<?php
	}
}
//Pause sensor
function acknowledge($objid,$message,$session_username,$session_password) {
	global $prtg_server;
	
	$api_acknowledge = '/api/acknowledgealarm.htm?id='.$objid.'&ackmsg='.$message.'';
	$url = $prtg_server.$api_acknowledge.'&username='.$session_username.'&passhash='.$session_password;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents
	$data = curl_exec($ch); // execute curl request
	curl_close($ch);
	$clean = strip_tags($data);

	if (empty($clean)){
		?>
				<div class="alert alert-success fade in">
  						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  						<center><strong>Successfully Acknowledged!</strong></center>
				</div> 
<?php
	}
	else {	
		?>
				<div class="alert alert-danger fade in">
  						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  						<center><strong>Error!</strong> Reason for failure: <?php echo $data;?></center>
				</div> 
<?php
	}
}

//Get XML's from server
function getXML ($xml, $userpass) {
	global $prtg_server;
	$url = $prtg_server.$xml.$userpass;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/xml'));
	$data = curl_exec($ch); // execute curl request
	curl_close($ch);

	$xml =  simplexml_load_string($data);
	return $xml;
}


//----------------Modal functions---------------


function loginModal(){ ?>
<p>
You need to be logged in to perform this action.</p>
<br>
<!--login button-->
<form action="login.php" method="post">
<input type="submit" class="btn btn-primary" value="Login">
</form>
</div>
</div>
</div>
</div>

<?php 
}

function pauseModal() { ?>

<form action="prtgerror.php" method="post">

      <input type="hidden" id="objid" name="objid" value="<?php echo $objid;?>">
   <!--Pause sensor for-->
      <p style="float:left;width:200px;">Pause server for (minutes):</p>
      <input style="float:right;" type="text" id="text" name="duration">
      <br>
      <br>
   <!--Reason for pause -->
      <p style="float:left;width:200px;">Reason for pausing:</p>
      <textarea style="float:right;" type="text" id="message_pause" name="message_pause"></textarea>
      <br>
      <br>
      <br>
      <br>
		<div class="modal-footer">
      <input type="submit" class="btn btn-primary" value="Pause">
      </div>
</form>
    	</div>
       </div>
      </div>
      </div>
<?php }

function acknowledgeModal() { ?>

<form action="prtgerror.php" method="post">

      <input type="hidden" id="objid" name="objid" value="<?php echo $objid;?>">

      <p style="float:left;width:200px;">Reason for acknowledging:</p>
      <textarea style="float:right;" type="text" id="message_ack" name="message_ack"></textarea>
      <br>
      <br>
      <br>
      <br>
		<div class="modal-footer">
      <input type="submit" class="btn btn-primary" value="Acknowledge">
      </div>
</form>
    	</div>
       </div>
      </div>
      </div>
      <?php }
?>