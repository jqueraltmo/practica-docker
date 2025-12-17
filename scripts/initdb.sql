-- Crear taula Hosts (ajustada per PostgreSQL)
CREATE TABLE IF NOT EXISTS Hosts (
    Id SERIAL PRIMARY KEY,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    Email VARCHAR(100) UNIQUE NOT NULL,
    Phone VARCHAR(20),
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserir dades d'exemple
INSERT INTO Hosts (FirstName, LastName, Email, Phone) VALUES
('Anna', 'Garcia', 'anna@example.com', '612345678'),
('Pere', 'Martínez', 'pere@example.com', '623456789'),
('Maria', 'López', 'maria@example.com', '634567890'),
('Joan', 'Sánchez', 'joan@example.com', '645678901'),
('Laura', 'Fernández', 'laura@example.com', '656789012');

-- Crear taula Habitacions
CREATE TABLE IF NOT EXISTS Rooms (
    Id SERIAL PRIMARY KEY,
    RoomNumber VARCHAR(10) UNIQUE NOT NULL,
    Type VARCHAR(50) NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    Available BOOLEAN DEFAULT true
);

-- Crear taula Reserves
CREATE TABLE IF NOT EXISTS Bookings (
    Id SERIAL PRIMARY KEY,
    HostId INT REFERENCES Hosts(Id) ON DELETE CASCADE,
    RoomId INT REFERENCES Rooms(Id) ON DELETE CASCADE,
    CheckIn DATE NOT NULL,
    CheckOut DATE NOT NULL,
    TotalPrice DECIMAL(10, 2) NOT NULL,
    Status VARCHAR(20) DEFAULT 'confirmed'
);

