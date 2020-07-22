INSERT INTO categories(title, character_code)
  VALUES
  ('Доски и лыжи', 'boards'),
  ('Крепления', 'attachment'),
  ('Ботинки', 'boots'),
  ('Одежда', 'clothing'),
  ('Инструменты', 'tools'),
  ('Разное', 'other');

INSERT INTO users(name, email, pass, contacts)
  VALUES
  ('Bob', 'Bob123@mail.com', 'superpass', 'phone'),
  ('John', 'John123@mail.com', 'superpass', 'phone');

INSERT INTO lots(userID, title, categoryID, description, img, base_price, step_price, closing_date)
VALUES
(1, '2014 Rossignol District Snowboard', 1, 'awesome, stylish, cheap', 'img/lot-1.jpg', 10999, 600, '2020-07-21'),
(2, 'DC Ply Mens 2016/2017 Snowboard', 1, 'awesome, stylish, cheap', 'img/lot-2.jpg', 159999, 500, '2020-07-21'),
(1, 'Крепления Union Contact Pro 2015 года размер L/XL', 2, 'awesome, stylish, cheap', 'img/lot-3.jpg', 8000, 400, '2020-07-22'),
(2, 'Ботинки для сноуборда DC Mutiny Charocal', 3, 'awesome, stylish, cheap', 'img/lot-4.jpg', 10999, 300, '2020-07-23'),
(1, 'Куртка для сноуборда DC Mutiny Charocal', 4, 'awesome, stylish, cheap', 'img/lot-5.jpg', 7500, 200, '2020-07-24'),
(2, 'Маска Oakley Canopy', 6, 'awesome, stylish, cheap', 'img/lot-6.jpg', 5400, 100, '2020-07-25');

INSERT INTO bets(lotID, userID, amount)
VALUES
(3, 1, 8500),
(3, 2, 9000);

-- получить все категории
SELECT title FROM categories;

-- получить самые новые, открытые лоты
SELECT title, base_price, img, categoryID FROM lots WHERE closing_date > CURRENT_TIMESTAMP ORDER BY date_time DESC;

-- показать лот по его id
SELECT * FROM lots WHERE id = 4;
-- название категории, к которой принадлежит этот лот
SELECT lots.*, categories.title FROM lots JOIN categories ON lots.categoryID = categories.id WHERE lots.id = 4;

-- обновить название лота по его идентификатору
UPDATE lots SET title = 'Новое имя' WHERE id = 6;

-- получить список ставок для лота по его идентификатору с сортировкой по дате
SELECT * FROM bets WHERE lotID = 3 ORDER BY date_time;


