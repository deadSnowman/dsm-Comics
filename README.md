# dsm-Comics
A PHP and AJAX webcomic page built with CodeIgniter (under development)

## To-Do (this list will grow)
- clean up comics home and pages views
- archive view
- admin: add delete for cover photos
- admin: add titles to pages
- admin: add a modal delete prompt for comics
- admin: hover / click page in pages admin shows comic
- home: do something about squished cover images
- comic view: comic download button?

## Getting Started
Just a small database setup and a few config modifications are needed

### Setup
Open and modify application/config/database.php after running the database script supplied in "dbdump" to match your database setup

Set the encryption_key in application/config/config.php
'''
$config['encryption_key'] = 'somethingelse';
'''

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

