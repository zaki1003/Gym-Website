# Gym-Website
A website built using Laravel for managing a Gym. With our application, users can book into a training session. Coaches can add their training sessions and get list of users who booked into their sessions. The admin can check reservations and manage users, sessions, coaches and Ban users.
- You can find also the code of a mobile application coded using java in "Android App".


## Screenshots
### Home


![1](https://github.com/zaki1003/Gym-Website/assets/65148928/69677398-9dc4-4cbc-9e8b-2a944e61be90)

### Dashboard

![2](https://github.com/zaki1003/Gym-Website/assets/65148928/efd5fab6-8259-420e-832d-ac71959b4703)
![3](https://github.com/zaki1003/Gym-Website/assets/65148928/e8b34b09-1ac9-48be-9e41-628f145cb9ce)
![4](https://github.com/zaki1003/Gym-Website/assets/65148928/0df9e6f3-a1c3-40d7-839c-9083b449c4c5)
![5](https://github.com/zaki1003/Gym-Website/assets/65148928/552cf19d-74bc-4a34-9e69-5059d0cada7c)




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
