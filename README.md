# dsm-Comics
A webcomic webpage built with codeigniter (under development)

## To-Do (this list will grow)
- comics, chapters, and pages views
- admin login / admin page security
- page and cover image upload
- users admin, comics admin, and pages admin
- menu bar breaks for mobile under home page

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

## License
This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

