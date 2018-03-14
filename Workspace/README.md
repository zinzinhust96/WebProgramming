# Library Manager Guide
## Install project guide

Step 1: `git clone --rescursive https://ttluong1993@bitbucket.org/t3min4l/isd.ict.20171-07.git`<br>
	if use 'git pull', run 'git submodule init && git submodule update`<br>

Step 3: `cd <project-path>/application`<br>

Step 3: `cp .env.example .env` then edit `APP_NAME, APP_URL, DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD` config<br>

Step 4: `cd <project-path>/laradock`<br>
	``cp env-example .env` then change `APPLICATION=../` to `APPLICATION=../application`<br>

Step 5: `docker-compose up -d nginx mysql`<br>

Step 6:<br>
`docker exec -it laradock_mysql_1 bash`<br>
`mysql -u'root' -p'root'`<br>
`CREATE DATABASE library;`<br>
`exit`<br>
`exit`<br>

Step 6:<br>
`docker exec -it laradock_workspace_1 bash`<br>
`composer install`<br>
`php artisan storage:link`<br>
`php artisan migrate`<br>
`php artisan db:seed`<br>

`exit`<br>

Step 7:<br>
* `cd <project-path>/application`<br>
* `chmod -R [mode] .` into begin edit source code<br>
* `git config core.fileMode false` into ignore file mode submition.<br>

Step 8: go to `localhost` (or another local domain) on your browser.