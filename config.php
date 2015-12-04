<?php


//PRTG Read only username and password(passhashed by PRTG)
$prtg_ro_user = '';
$prtg_ro_pass = ''; 

//Your PRTG server including HTTPS ,eg https://prtg.example.com
$prtg_server = '';




//Static code


//Combine the username and passhash into the correct format
$prtg_ro_userpass = '&username='.$prtg_ro_user.'&passhash='.$prtg_ro_pass;

//API to get all of the errors and warnings in the system(Limited to 2000)
$xml_errorwarning = '/api/table.xml?content=sensors&columns=objid,probe,downtimesince,device,sensor,lastvalue,status,message,priority&filter_status=5&count=2000&filter_status=4&sortby=-status';

//Link to get to PRTG sensor
$sensor_id_url = '/sensor.htm?id=';



?>