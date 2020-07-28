# space_bar

This is a example of a blog/forum with admin, account and comments system

Clone the repo

Run composer install to dl all dependencies

change your credentials in .env for your mysql server

run php bin/console doctrine:database:create to create your database

load the fixtures : php bin/console doctrine:fixture:load, now you have fake datas.

Run the server : php bin/console server:run or symfony serve

On the homepage you can see all subjects, click on it and see the discussion

to see your user account got to https://127.0.0.1:8000/account and log with example1@spacebar.com pwd : 'engage'

to see admin page got to https://127.0.0.1:8000/admin/article/new and log with admin1@spacebar.com pwd : engage

and https://127.0.0.1:8000/admin/comment and log with the same credentials
