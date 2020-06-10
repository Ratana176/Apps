
CREATE DATABASE apps;

USE apps;

CREATE TABLE  companies(
    id INTEGER AUTO_INCREMENT,
    name VARCHAR (100),
    address VARCHAR (100),
    license_no VARCHAR (14),
    CONSTRAINT PK_Companies PRIMARY KEY (id)
);


CREATE TABLE employees (
    id INTEGER AUTO_INCREMENT,
    company_id INTEGER,
    name VARCHAR (100),
    surname VARCHAR (100),
    telephone VARCHAR (20),
    salary DECIMAL,
    CONSTRAINT PK_Employees PRIMARY KEY (id),
    CONSTRAINT FK_CompaniesEmployees FOREIGN KEY ( company_id)
    REFERENCES companies(id)
);

CREATE TABLE products (
    id INTEGER AUTO_INCREMENT,
    company_id INTEGER,
    name VARCHAR (100),
    price DECIMAL,
    quantity INTEGER,
    CONSTRAINT PK_Products PRIMARY KEY (id),
    CONSTRAINT FK_CompaniesProducts FOREIGN KEY ( company_id)
    REFERENCES companies(id)
);