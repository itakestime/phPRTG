<?php 

require('config.php');

$objid =  $_GET['id'];


$graph_2day = $prtg_server.'/chart.png?type=graph&width=750&height=350&graphid=1&id='.$objid.'&graphstyling=showLegend%3D%271%27'.$prtg_ro_userpass.'';
$graph_30day = $prtg_server.'/chart.png?type=graph&width=750&height=350&graphid=2&id='.$objid.'&graphstyling=showLegend%3D%271%27'.$prtg_ro_userpass.'';



?>


    <!-- Modal content-->
   	 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Graphs for object ID: <?php echo $objid;?></h4>
      </div>
      <div class="modal-body">
      	<center>
      	<h5>2 day graph</h5>
    	<img src="<?php echo $graph_2day;?>">
    	<br>
    	<br>
    	<h5>30 day graph</h5>
    	<img src="<?php echo $graph_30day;?>">
    	<br>
    	</center>
       </div>

     
<?php 

?>
