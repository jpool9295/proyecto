CREATE DATABASE tienda;
USE tienda;

CREATE TABLE pedidos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  telefono VARCHAR(20),
  ubicacion VARCHAR(150),
  dni VARCHAR(20),
  metodo_pago ENUM('tarjeta', 'efectivo', 'yape') NOT NULL
);
