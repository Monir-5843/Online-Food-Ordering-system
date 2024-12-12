-- Create Admin Table 
CREATE TABLE Admin (
    admin_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL
);

-- Create Customer Table
CREATE TABLE Customer (
    customer_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address TEXT
);

-- Create Restaurant Table
CREATE TABLE Restaurant (
    restaurant_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    location TEXT NOT NULL,
    contact_info VARCHAR(100),
    admin_id INT NOT NULL,
    FOREIGN KEY (admin_id) REFERENCES Admin(admin_id)
);

-- Create Food Table
CREATE TABLE Food (
    food_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    restaurant_id INT NOT NULL,
    FOREIGN KEY (restaurant_id) REFERENCES Restaurant(restaurant_id)
);

-- Create Delivery Personnel Table
CREATE TABLE Delivery_Personal (
    delivery_personal_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    contact VARCHAR(15) NOT NULL,
    availability BOOLEAN DEFAULT TRUE
);

-- Create Orders Table
CREATE TABLE Orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    customer_id INT NOT NULL,
    food_id INT NOT NULL,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    total_price DECIMAL(10, 2),
    status VARCHAR(50) DEFAULT 'Pending',
    delivery_personal_id INT,
    FOREIGN KEY (customer_id) REFERENCES Customer(customer_id),
    FOREIGN KEY (food_id) REFERENCES Food(food_id),
    FOREIGN KEY (delivery_personal_id) REFERENCES Delivery_Personal(delivery_personal_id)
);

-- Create Payment Table
CREATE TABLE Payment (
    payment_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    payment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    amount DECIMAL(10, 2) NOT NULL,
    payment_mode VARCHAR(50) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES Orders(order_id)
);

-- Create Reviews Table
CREATE TABLE Reviews (
    review_id INT PRIMARY KEY AUTO_INCREMENT,
    customer_id INT NOT NULL,
    restaurant_id INT NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    comments TEXT,
    FOREIGN KEY (customer_id) REFERENCES Customer(customer_id),
    FOREIGN KEY (restaurant_id) REFERENCES Restaurant(restaurant_id)
);

-- Insert Sample Data
INSERT INTO Admin (name, email, password) 
VALUES ('Alice Johnson', 'alice@example.com', 'password123');

INSERT INTO Customer (name, email, phone, address) 
VALUES ('John Doe', 'john.doe@example.com', '1234567890', '123 Elm Street');

INSERT INTO Restaurant (name, location, contact_info, admin_id) 
VALUES ('Pizza Palace', 'Downtown', '555-1234', 1);

INSERT INTO Food (name, price, description, restaurant_id) 
VALUES ('Margherita Pizza', 10.99, 'Classic cheese pizza', 1);

INSERT INTO Delivery_Personal (name, contact, availability) 
VALUES ('Mike Johnson', '555-9999', TRUE);

INSERT INTO Orders (customer_id, food_id, total_price, status, delivery_personal_id) 
VALUES (1, 1, 10.99, 'Pending', 1);

INSERT INTO Payment (order_id, amount, payment_mode) 
VALUES (1, 10.99, 'Credit Card');

INSERT INTO Reviews (customer_id, restaurant_id, rating, comments) 
VALUES (1, 1, 5, 'Delicious pizza!');
