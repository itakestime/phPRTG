<?php


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

<?php }



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