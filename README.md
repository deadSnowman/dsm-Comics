# dsm-Comics
A webcomic webpage built with codeigniter (under development)

## To-Do (this list will grow)
- comics home and pages views
- admin login / admin page security
- page and cover image upload
- users admin, comics admin, and pages admin
- update cover in comic admin page

## Getting Started
Just a small database setup and a few config modifications are needed

### Setup
Open and modify application/config/database.php after running the database script supplied in "dbdump" to match your database setup

If you're using Linux, open /etc/apache2/apache2.conf and change to
```
AllowOverride All
```

then enable apache mod rewrite
```
sudo a2enmod rewrite
```
and restart Apache
```
sudo service apache2 restart
```

Also, set permissions for uploads directory to 777
```
sudo chmod -R 777 uploads
```

## License
This project is licensed under the MIT License - see the [license.txt](license.txt) file for details

