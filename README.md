# dsm-Comics
A PHP and AJAX webcomic page built with CodeIgniter (under development)

[Screens](#screens)

## To-Do (this list will grow)
- clean up comics home and pages views
- archive view - make some url scheme that loads the specific file in the comic view and tie it to the archives
- admin: add titles to pages
- admin: add a modal delete prompt for comics
- admin: hover / click page in pages admin shows comic
- comic view: comic download button?
- hande weird filenames like "blah.jpg-100"

## Getting Started
Just a small database setup and a few config modifications are needed

### Setup
Open and modify application/config/database.php after running the database script supplied in "dbdump" to match your database setup

Add yourself to the users table with the role as "admin"

If you want to upload a lot of files at once (or big ones), you can change some things in php.ini
```
upload_max_filesize = 14M
max_file_uploads = 200
post_max_size = 14M
```

Set the encryption_key in application/config/config.php
`$config['encryption_key'] = 'somethingelse';`

If you're using Linux, open /etc/apache2/apache2.conf and change to
`AllowOverride All`

then enable apache mod rewrite
`sudo a2enmod rewrite`

and restart Apache
`sudo service apache2 restart`

Also, set permissions for uploads directory to 777
`sudo chmod -R 777 uploads`

## Screens
[![dsm-Comics video](https://i.imgur.com/CZ2lOgO.png)](http://www.youtube.com/watch_popup?v=DYF4OVfUcmQ)
[![dsm-Comics video](https://i.imgur.com/mq7lT1z.png)](http://www.youtube.com/watch_popup?v=DYF4OVfUcmQ)
[![dsm-Comics video](https://i.imgur.com/4RJGCs8.png)](http://www.youtube.com/watch_popup?v=DYF4OVfUcmQ)
[![dsm-Comics video](https://i.imgur.com/qlUKlwL.png)](http://www.youtube.com/watch_popup?v=DYF4OVfUcmQ)

## License
This project is licensed under the MIT License - see the [license.txt](license.txt) file for details

