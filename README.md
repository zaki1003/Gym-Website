# Gym-Website
A website built using Laravel for managing a Gym. With our application, users can book into a training session. Coaches can add their training sessions and get list of users who booked into their sessions. The admin can check reservations and manage users, sessions, coaches and Ban users.
- You can find also the code of a mobile application coded using java in "Android App".


## Screenshots
### Home

![Screenshot from 2023-05-21 20-51-15](https://github.com/zaki1003/Gym-Website/assets/65148928/98005f31-992c-4671-8b52-8330271f1b5b)


### Dashboard

![Screenshot from 2023-05-21 21-12-27](https://github.com/zaki1003/Gym-Website/assets/65148928/4f07b3d2-daf1-4001-81dd-1563ecc5dec8)
![Screenshot from 2023-05-21 20-52-28](https://github.com/zaki1003/Gym-Website/assets/65148928/0e7a4b00-5705-4a38-aa8f-3343f860475e)
![Screenshot from 2023-05-21 21-26-00](https://github.com/zaki1003/Gym-Website/assets/65148928/aba2c17f-2e49-48c6-b3cd-efefadc3601e)

![Screenshot from 2023-05-21 21-24-51](https://github.com/zaki1003/Gym-Website/assets/65148928/c780076d-c8d3-463c-b638-c88999060134)





## Getting Started
1. Install Laravel.
2. Pull this repository
3. Create database and link it in the project .env file 
4. Update composer by using this command ` $ composer update `.  
5. Run migration and seeding command:
	- php artisan migrate
	- php artisan db:seed


- Now `161` Accounts have been created on the system, distributed as follows :  
The first account is for `admin`.     
From 2 to 61 are `coach`.  
From 62 to 161 are `user`.  
All created accounts have a unified password `123456789`. 


6. Run laravel application
	- php artisan server



8. To create a new admin account use a command  `  $ php artisan create:admin --email=admin2@admin.com --password=123456789   ` `.  
 


### Prerequisites
1. Knowledge of Laravel framework
2. Working knowledge of PHP, MySQL & Apache
