CREATE DATABASE YetiCave
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;
USE YetiCave;

CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       date_registration DATETIME,
                       name VARCHAR(30) NOT NULL UNIQUE,
                       email VARCHAR(32) NOT NULL UNIQUE,
                       pass VARCHAR(32) NOT NULL,
                       contacts VARCHAR(100)
);

CREATE TABLE categories (
                           id INT AUTO_INCREMENT PRIMARY KEY,
                           title VARCHAR(50) NOT NULL,
                           character_code VARCHAR(50) NOT NULL
);

CREATE TABLE lots (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      date_time DATETIME DEFAULT CURRENT_TIMESTAMP,
                      title VARCHAR(50) NOT NULL,
                      description TEXT,
                      img VARCHAR(50),
                      base_price INT NOT NULL,
                      closing_date DATETIME NOT NULL,
                      step_price INT,
                      userID INT,
                      winner INT,
                      categoryID INT,

                      FOREIGN KEY(userID) REFERENCES users(id),
                      FOREIGN KEY(categoryID) REFERENCES categories(id)
);

CREATE INDEX TIndex ON lots(title);
CREATE INDEX PIndex ON lots(base_price);

CREATE TABLE bets (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      date_time DATETIME DEFAULT CURRENT_TIMESTAMP,
                      amount INT NOT NULL,
                      lotID INT,
                      userID INT,
                      FOREIGN KEY(userID) REFERENCES users(id),
                      FOREIGN KEY(lotID) REFERENCES lots(id)
);

