 README FOR COMPOSER INSTALLATION WITH EMAIL PROTOCOL 


1)DOWNLOAD COMPOSER ( INSTALL TO THE PHP DIR IN YOUR FILE SYSTEM) LINK : https://getcomposer.org/download/

2)UNZIP COPY FOLDER PHPMAILER TO PROJECT DIR

3) GO TO PHPMAILER ( create folder name it to "vendor" then  create new file call  composer.json into that folder)

4) edit that composer.json by following code :
{
"require":{

  "phpmailer/phpmailer": "dev-master"
}

}

5) go to terminal then path to the  vendor folder 
command :  composer install

6) now done all set ( need to change the path if need it from notify_password.php ) example  ".vendor/......"