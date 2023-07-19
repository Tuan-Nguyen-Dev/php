-- tạo database

create database if not exists MD17306;

use MD17306;

-- tạo bảng

create table
    if not exists users (
        id INT PRIMARY KEY AUTO_INCREMENT,
        password VARCHAR(200) NOT NULL,
        name VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL UNIQUE
    );

insert into
    users (id, password, name, email)
values (
        1,
        'Andra',
        'Brim',
        'abrim0@opera.com'
    );

insert into
    users (id, password, name, email)
values (
        2,
        'Blondie',
        'Iannuzzi',
        'biannuzzi1@foxnews.com'
    );

insert into
    users (id, password, name, email)
values (
        3,
        'Hewie',
        'Mellers',
        'hmellers2@com.com'
    );

insert into
    users (id, password, name, email)
values (
        4,
        'Shadow',
        'Dubery',
        'sdubery3@weather.com'
    );

insert into
    users (id, password, name, email)
values (
        5,
        'Rodrick',
        'Thomason',
        'rthomason4@ucsd.edu'
    );

create table
    reset_password (
        id INT PRIMARY KEY AUTO_INCREMENT,
        token VARCHAR(50) NOT NULL,
        createdAt DATETIME NOT NULL DEFAULT NOW(),
        email VARCHAR(50) NOT NULL,
        avaiable BIT DEFAULT 1
    );

create table
    if not exists categories (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        image VARCHAR(1000) NOT NULL
    );

insert into
    categories (id, name, image)
values (
        1,
        'Điện thoại',
        'https://3.bp.blogspot.com/-z2czL0i3IgU/V3-ftGkyPCI/AAAAAAAAfwM/V0j1PR4Eqw4XG2nBN03OXR0vHik5TWdRwCLcB/s640/12802766_1737596069796829_5688116151203310490_n.jpg'
    );

insert into
    categories (id, name, image)
values (
        2,
        'Laptop',
        'https://3.bp.blogspot.com/-z2czL0i3IgU/V3-ftGkyPCI/AAAAAAAAfwM/V0j1PR4Eqw4XG2nBN03OXR0vHik5TWdRwCLcB/s640/12802766_1737596069796829_5688116151203310490_n.jpg'
    );

insert into
    categories (id, name, image)
values (
        3,
        'Phụ kiện',
        'https://3.bp.blogspot.com/-z2czL0i3IgU/V3-ftGkyPCI/AAAAAAAAfwM/V0j1PR4Eqw4XG2nBN03OXR0vHik5TWdRwCLcB/s640/12802766_1737596069796829_5688116151203310490_n.jpg'
    );

create table
    if not exists products (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        price INT NOT NULL,
        image VARCHAR(1000) NOT NULL,
        description VARCHAR(500) NOT NULL,
        quantity INT NOT NULL,
        categoryId INT NOT NULL,
        FOREIGN KEY (categoryId) REFERENCES categories(id)
    );

insert into
    products (
        id,
        name,
        price,
        image,
        description,
        quantity,
        categoryId
    )
values (
        1,
        'Điện thoại 1',
        1000,
        'https://3.bp.blogspot.com/-z2czL0i3IgU/V3-ftGkyPCI/AAAAAAAAfwM/V0j1PR4Eqw4XG2nBN03OXR0vHik5TWdRwCLcB/s640/12802766_1737596069796829_5688116151203310490_n.jpg',
        'Điện thoại 1',
        10,
        1
    );

insert into
    products (
        id,
        name,
        price,
        image,
        description,
        quantity,
        categoryId
    )
values (
        2,
        'Điện thoại 2',
        2000,
        'https://3.bp.blogspot.com/-z2czL0i3IgU/V3-ftGkyPCI/AAAAAAAAfwM/V0j1PR4Eqw4XG2nBN03OXR0vHik5TWdRwCLcB/s640/12802766_1737596069796829_5688116151203310490_n.jpg',
        'Điện thoại 2',
        20,
        2
    );

insert into
    products (
        id,
        name,
        price,
        image,
        description,
        quantity,
        categoryId
    )
values (
        3,
        'Điện thoại 3',
        3000,
        'https://3.bp.blogspot.com/-z2czL0i3IgU/V3-ftGkyPCI/AAAAAAAAfwM/V0j1PR4Eqw4XG2nBN03OXR0vHik5TWdRwCLcB/s640/12802766_1737596069796829_5688116151203310490_n.jpg',
        'Điện thoại 3',
        30,
        3
    );