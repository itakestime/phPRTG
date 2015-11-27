<?php


//PRTG Read only username and password
$prtg_ro_user = '';
$prtg_ro_pass = ''; 

//Combine the two into the correct string
$prtg_ro_userpass = '&username='.$prtg_ro_user.'&passhash='.$prtg_ro_pass;

//To get XML with errors and warnings in system
$xml_errorwarning = '/api/table.xml?content=sensors&columns=objid,probe,downtimesince,device,sensor,lastvalue,status,message,priority&filter_status=5&count=2000&filter_status=4&sortby=-status&filter_tags=@tag(-NoShow)';


//Your PRTG server including HTTPS ,eg https://prtg.example.com
$prtg_server = '';


//Link to get to PRTG sensor
$sensor_id_url = '/sensor.htm?id=';



?>