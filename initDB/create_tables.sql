CREATE TABLE IF NOT EXISTS city (
  id INT PRIMARY KEY,
  name CHAR(255)
);

CREATE TABLE IF NOT EXISTS flights (
  id INT PRIMARY KEY,
  flight_number VARCHAR(255),
  departure_city_id INT,
  arrival_city_id INT,
  departure_time TIMESTAMP,
  arrival_time TIMESTAMP,
  count_of_seats INT,
  company_name VARCHAR(255),
  FOREIGN KEY (departure_city_id) REFERENCES city (id),
  FOREIGN KEY (arrival_city_id) REFERENCES city (id)
);

CREATE TABLE IF NOT EXISTS tickets (
  id INT PRIMARY KEY,
  flight_id INT,
  price DECIMAL(10, 2),
  FOREIGN KEY (flight_id) REFERENCES flights (id)
);

CREATE TABLE IF NOT EXISTS schedule (
  id INT PRIMARY KEY,
  departure_time TIME,
  arrival_time TIME,
  waypoints VARCHAR(255),
  departure_time_destination TIME,
  arrival_time_destination TIME,
  city_id INT,
  FOREIGN KEY (city_id) REFERENCES city (id)
);

INSERT INTO city (id, name)
SELECT *
FROM (
  VALUES
    (1, 'Муром'),
    (2, 'Москва'),
    (3, 'Санкт-Петербург'),
    (4, 'Навашино'),
    (5, 'Нижний Новгород'),
    (6, 'Владимир')
) AS new_rows
WHERE NOT EXISTS (
  SELECT 1
  FROM city
  WHERE city.id = new_rows.column1
);

INSERT INTO schedule (
  id,
  departure_time,
  arrival_time,
  waypoints,
  departure_time_destination,
  arrival_time_destination,
  city_id
)
SELECT
  *
FROM (
  VALUES
    (
      1,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      1
    ),
    (
      2,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      1
    ),
    (
      3,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      1
    ),
    (
      4,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      1
    ),
    (
      5,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      1
    ),
    (
      6,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      1
    ),
    (
      7,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      2
    ),
    (
      8,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      2
    ),
    (
      9,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      2
    ),
    (
      10,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      2
    ),
    (
      11,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      2
    ),
    (
      12,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      2
    ),
    (
      13,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      3
    ),
    (
      14,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      3
    ),
    (
      15,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      3
    ),
    (
      16,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      3
    ),
    (
      17,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      3
    ),
    (
      18,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      3
    ),
    (
      19,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      4
    ),
    (
      20,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      4
    ),
    (
      21,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      4
    ),
    (
      22,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      4
    ),
    (
      23,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      4
    ),
    (
      24,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      4
    ),
    (
      25,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      5
    ),
    (
      26,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      5
    ),
    (
      27,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      5
    ),
    (
      28,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      5
    ),
    (
      29,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      5
    ),
    (
      30,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      5
    ),
    (
      31,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      6
    ),
    (
      32,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      6
    ),
    (
      33,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      6
    ),
    (
      34,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      6
    ),
    (
      35,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      6
    ),
    (
      36,
      TIME '10:00:00',
      TIME '10:30:00',
      'Москва, Санкт-Петербург',
      TIME '10:00:00',
      TIME '10:30:00',
      6
    )
) AS new_rows
WHERE NOT EXISTS (
  SELECT 1
  FROM schedule
  WHERE schedule.id = new_rows.column1
);

-- Generate 20 flights
INSERT INTO flights (
  id,
  flight_number,
  departure_city_id,
  arrival_city_id,
  departure_time,
  arrival_time,
  count_of_seats,
  company_name
)
SELECT *
FROM (
  VALUES
    (
      1,
      'FL001',
      1,
      2,
      TIMESTAMP '2023-06-20 13:30:00',
      TIMESTAMP '2023-06-20 17:45:00',
      200,
      'Airline A'
    ),
    (
      2,
      'FL002',
      3,
      4,
      TIMESTAMP '2023-06-20 09:15:00',
      TIMESTAMP '2023-06-20 12:30:00',
      150,
      'Airline B'
    ),
    (
      3,
      'FL003',
      2,
      5,
      TIMESTAMP '2023-06-20 16:00:00',
      TIMESTAMP '2023-06-20 18:30:00',
      180,
      'Airline C'
    ),
    (
      4,
      'FL003',
      3,
      5,
      TIMESTAMP '2023-06-20 16:00:00',
      TIMESTAMP '2023-06-20 18:30:00',
      180,
      'Airline C'
    ),
    (
      5,
      'FL003',
      5,
      5,
      TIMESTAMP '2023-06-20 16:00:00',
      TIMESTAMP '2023-06-20 18:30:00',
      180,
      'Airline C'
    ),
    (
      6,
      'FL003',
      4,
      5,
      TIMESTAMP '2023-06-20 16:00:00',
      TIMESTAMP '2023-06-20 18:30:00',
      180,
      'Airline C'
    ),
    (
      7,
      'FL003',
      1,
      3,
      TIMESTAMP '2023-06-20 16:00:00',
      TIMESTAMP '2023-06-20 18:30:00',
      180,
      'Airline C'
    ),
    (
      8,
      'FL003',
      2,
      3,
      TIMESTAMP '2023-06-20 16:00:00',
      TIMESTAMP '2023-06-20 18:30:00',
      180,
      'Airline C'
    ),
    (
      9,
      'FL003',
      2,
      2,
      TIMESTAMP '2023-06-20 16:00:00',
      TIMESTAMP '2023-06-20 18:30:00',
      180,
      'Airline C'
    ),
    (
      10,
      'FL003',
      2,
      6,
      TIMESTAMP '2023-06-20 16:00:00',
      TIMESTAMP '2023-06-20 18:30:00',
      180,
      'Airline C'
    ),
    (
      11,
      'FL003',
      4,
      1,
      TIMESTAMP '2023-06-20 16:00:00',
      TIMESTAMP '2023-06-20 18:30:00',
      180,
      'Airline C'
    ),
    (
      12,
      'FL003',
      4,
      2,
      TIMESTAMP '2023-06-20 16:00:00',
      TIMESTAMP '2023-06-20 18:30:00',
      180,
      'Airline C'
    ),
    (
      13,
      'FL003',
      4,
      3,
      TIMESTAMP '2023-06-20 16:00:00',
      TIMESTAMP '2023-06-20 18:30:00',
      180,
      'Airline C'
    ),
    (
      14,
      'FL003',
      4,
      6,
      TIMESTAMP '2023-06-20 16:00:00',
      TIMESTAMP '2023-06-20 18:30:00',
      180,
      'Airline C'
    ),
    (
      15,
      'FL003',
      5,
      1,
      TIMESTAMP '2023-06-20 16:00:00',
      TIMESTAMP '2023-06-20 18:30:00',
      180,
      'Airline C'
    ),
    (
      16,
      'FL003',
      3,
      1,
      TIMESTAMP '2023-06-20 16:00:00',
      TIMESTAMP '2023-06-20 18:30:00',
      180,
      'Airline C'
    ),
    (
      17,
      'FL003',
      2,
      5,
      TIMESTAMP '2023-06-20 16:00:00',
      TIMESTAMP '2023-06-20 18:30:00',
      180,
      'Airline C'
    ),
    (
      18,
      'FL003',
      1,
      4,
      TIMESTAMP '2023-06-20 16:00:00',
      TIMESTAMP '2023-06-20 18:30:00',
      180,
      'Airline C'
    ),
    (
      19,
      'FL003',
      2,
      6,
      TIMESTAMP '2023-06-20 16:00:00',
      TIMESTAMP '2023-06-20 18:30:00',
      180,
      'Airline C'
    ),
    (
      20,
      'FL020',
      4,
      6,
      TIMESTAMP '2023-06-20 11:45:00',
      TIMESTAMP '2023-06-20 14:20:00',
      220,
      'Airline D'
    )
) AS new_rows
WHERE NOT EXISTS (
  SELECT 1
  FROM flights
  WHERE flights.id = new_rows.column1
);

-- Generate 50 tickets
INSERT INTO tickets (id, flight_id, price)
SELECT *
FROM (
  SELECT
    seq AS id,
    FLOOR(RANDOM() * 20) + 1 AS flight_id,
    CAST((RANDOM() * 2000 + 500) AS numeric(10, 2)) AS price
  FROM generate_series(1, 50) AS seq
) AS new_rows
WHERE NOT EXISTS (
  SELECT 1
  FROM tickets
  WHERE tickets.id = new_rows.id
);
