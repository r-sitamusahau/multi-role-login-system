### You can clone this project from GitHub from git clone 
https://github.com/your-username/multi-role-login-system.git 


This a multi-role login system where by you can either register or login as admin or user

remember to create database of your ownn follow refer to the SQL file in the zip code

### Start Your Local Server
Place the project folder in the htdocs directory
Start Apache and MySQL from your control panel 

### access the project 
http://localhost/multi-role-login-system/

###  Create an Admin User (Optional)
INSERT INTO users (username, email, password, role) 
VALUES ('admin', 'admin@example.com', MD5('password123'), 'admin');

Feel to make any adjustments to make the project meet your requirements or even modify where you find something missing 