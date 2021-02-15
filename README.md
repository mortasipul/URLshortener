# URLshortener

MySQL queries : 
  - CREATE DATABASE urls;
  - USE urls;
  - CREATE TABLE links ( id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, url VARCHAR(500) NOT NULL UNIQUE, token CHAR(5) NOT NULL UNIQUE, created_on TIMESTAMP NOT NULL, clicked INTEGER UNSIGNED NOT NULL DEFAULT 0 );


It might be necessary to allow the rewrite mode, the .htaccess file not being enough.
  - command : sudo a2enmod rewrite
  
ENJOY!
