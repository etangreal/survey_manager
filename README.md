survey_manager
==============

To setup the website you will require:

   - build/sql_script.txt : Contains the sql statements for creating the database, tables and sample data.
   - src/public : Contains all the files necessary to run the website
   - src/public/core/database/connect.php : Is the file that stores the mysql connection info

_________________________________________________________________________________________________________________
Alternatively: 

You can launch and configure a Virtual Machine using Vagrant (its really quite simple!) on Mac (hopefully you have a Mac).
    
Requirements: You need to have Vagrant (vagrantup.com & virtualbox.org) installed on your system 
and I would recommend "sequel pro" on mac (sequelpro.com).

To Use:  You can simply go the projects root folder (in the command console) and issue the command "vagrant up".
This will then download and boot the required Virtual Machine (the downloading might take a while, but its a "once off").

To setup the database: 
  I would recommend downloading and installing "sequel pro" from sequelpro.com

  To setup SequelPro db connection select the SSH connection option (i.e. [Standard][Socket][SSH <==] ) and fill in the following:
  (Note: if for some reason all the SSH properties do not display, select one of the other tabs (e.g. Standard) and then re-select the SSH tab)

Name: scotch box
MySQL Host:	127.0.0.1
Username: root
Password: root
Database: (optional)
Port: 3306
SSH Host: 192.168.33.10
SSH User: vagrant
SSH Pass: vagrant
SSH Port: (optional)

As soon as the VM is booted you can connect to the database..
- select the Query icon from the menu
- load the MySQL.spf file with Sequel Pro (from the project's "build" folder)
- execute it: this will create the database, tables and sample data.
(to execute : select "run all queries" from the drop down in the bottom right hand corner)

After and you have created the database you can visit the website:
http://192.168.33.10 

To login as administrator use:
  username: admin
  password: admin

Alternatively you can login as any of the other users as seen in the SQL script:

Note: you first have to "create a new survey" with the admin user before you login with the user.
(by clicking on a user in the list of users and then clicking the "create new survey" link) 

username: GWSSam.SKDF7
password: 3ZL4CYDWBL

username: GWSSam.KLDFD
password: RWXX9DETSM

username: GWSSam.67FDS
password: 2M8CDMTGC5

username: GWSSam.7LKD8
password: MW7H38T2SE

username: GWSSam.LKD88
password: G3MNAULVKB

username: GWSSam.ASD9F
password: 8774ZE5E89

username: GWSSam.MNC56
password: C8UE54QBZP

username: GWSSam.LSNV3
password: 3PE8EDZTV5

username: GWSSam.DDVV2
password: Y55WPRBVUZ

username: GWSSam.NXCXD
password: MK4DV8NLPP
