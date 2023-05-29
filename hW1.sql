Create DATABASE hW1;
USE hW1;

CREATE TABLE users(
    id INT AUTO_INCREMENT primary key,
    username varchar(16) not null unique,
    email varchar(255) not null unique,
    password varchar(255) not null
);

