CREATE DATABASE rent_car_db;

USE rent_car_db;

-- Admin table
CREATE TABLE admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL
);

-- User table
CREATE TABLE user (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(100) NOT NULL,
  contact_number VARCHAR(15) NOT NULL
);

CREATE TABLE cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_model VARCHAR(100) NOT NULL,
    vehicle_number INT NOT NULL,
    seating_capacity INT NOT NULL,
    rent_per_day INT NOT NULL,
    vehicle_image VARCHAR(255) NOT NULL,
    vehicle_description TEXT NOT NULL,
    is_rented BOOLEAN DEFAULT 0
);

CREATE TABLE bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  car_id INT NOT NULL,
  rent_days INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES user(id),
  FOREIGN KEY (car_id) REFERENCES cars(id)
);
