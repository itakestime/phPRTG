# phPRTG

So this my bunch php pages to interface with PRTG's API.


Current features:

* Listing all failures and warnings in the system
* Showing two day and thirty day graphs (click the device)
* Authentication against the PRTG API
* Ability to acknowledge and pause sensors (once authenticated)
* Link to the object in PRTG (click the object ID)



Once downloaded, put all files onto a web server.


To connect to the API, you will need a username and password.
I recommend creating a read-only account to access the API.
Passhash the password, you can see how to do this in the API pages of your PRTG server.

Add your chosen user and their passhash to the config.php file.
Add your PRTG server to the config file.



Requirements:

php and curl




The main page is currently called 'prtgerror.php' which i guess is a bad name...it should be index.php but i developed this along side a lot of other pages...one of which was already called 'index.php'

