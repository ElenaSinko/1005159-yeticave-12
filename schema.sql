CREATE DATABASE IF NOT EXISTS YetiCave
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;
USE YetiCave;

CREATE TABLE IF NOT EXISTS users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       date_registration TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                       name VARCHAR(128) NOT NULL UNIQUE,
                       email VARCHAR(128) NOT NULL UNIQUE,
                       pass VARCHAR(255) NOT NULL,
                       contacts VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS categories (
                           id INT AUTO_INCREMENT PRIMARY KEY,
                           title VARCHAR(50) NOT NULL,
                           character_code VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS lots (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      date_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                      title VARCHAR(50) NOT NULL,
                      description TEXT,
                      img TEXT,
                      base_price DECIMAL(8,2) NOT NULL,
                      closing_date DATETIME NOT NULL,
                      step_price DECIMAL(8,2),
                      userID INT,
                      winnerID INT,
                      categoryID INT,

                      FOREIGN KEY(userID) REFERENCES users(id),
                      FOREIGN KEY(categoryID) REFERENCES categories(id),
                      FOREIGN KEY(winnerID) REFERENCES users(id)
);

CREATE FULLTEXT INDEX lot_ft_search ON lots(title, description);

CREATE INDEX TIndex ON lots(title);
CREATE INDEX PIndex ON lots(base_price);

CREATE TABLE IF NOT EXISTS bets (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      date_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                      amount DECIMAL(8,2) NOT NULL,
                      lotID INT,
                      userID INT,
                      FOREIGN KEY(userID) REFERENCES users(id),
                      FOREIGN KEY(lotID) REFERENCES lots(id)
);

