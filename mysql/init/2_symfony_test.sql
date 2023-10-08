CREATE DATABASE symfony_test;
CREATE USER 'symfony_test'@'%' IDENTIFIED BY 'YoUqXUKBjFG3';
GRANT ALL PRIVILEGES ON symfony_test.* TO 'symfony_test'@'%';
GRANT REFERENCES ON symfony_test.* TO 'symfony_test'@'%';
