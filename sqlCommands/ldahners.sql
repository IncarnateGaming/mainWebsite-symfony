SHOW DATABASES;
USE ldahners;
SHOW TABLES;
SELECT * FROM book;
SELECT * FROM merchandise;
SELECT * FROM series;
SELECT * FROM updates;
SELECT * FROM user;
SELECT * FROM migration_versions;


SELECT * FROM upload_file;
INSERT INTO upload_file (name1, description1, order1, type1, file_name, file_size, file_updated_at)
VALUES ("Hands", "A sculpted hand, painting a painted hand, which is drawing a drawn hand", 2, "physical", "art hands - touched up.jpg", 196156, "2020-02-07 15:53:28");
SELECT * FROM upload_file;


CREATE USER 'admin3'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';
GRANT ALL PRIVILEGES ON *.* TO 'admin3'@'localhost' WITH GRANT OPTION;

CREATE DATABASE ldahners;
