CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT DEFAULT 0,
    categoria INT NOT NULL,
    activo TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (categoria) REFERENCES categorias(id_categoria)
);
INSERT INTO productos (nombre, descripcion, precio, stock, categoria, activo) VALUES

-- CREPAS (id_categoria = 1)
('Crepa Nutella', 'Crepa con crema de avellana', 85.00, 100, 1, 1),
('Crepa Fresa', 'Crepa con fresas naturales', 90.00, 100, 1, 1),

-- FRESAS (id_categoria = 2)
('Fresas con crema chica', 'Vaso chico de fresas con crema', 65.00, 100, 2, 1),
('Fresas con crema grande', 'Vaso grande de fresas con crema', 85.00, 100, 2, 1),

-- HELADOS (id_categoria = 3)
('Helado sencillo', '1 bola de helado', 35.00, 50, 3, 1),
('Helado doble', '2 bolas de helado', 60.00, 50, 3, 1),

-- BEBIDAS (id_categoria = 4)
('Capuchino', 'Café capuchino caliente', 45.00, 100, 4, 1),
('Refresco 600ml', 'Refresco individual', 25.00, 24, 4, 1),

-- WAFFLES (id_categoria = 5)
('Waffle Oreo', 'Waffle con topping de Oreo', 95.00, 100, 5, 1),

-- POSTRES (id_categoria = 6)
('Rebanada de pastel', 'Pastel del día', 55.00, 10, 6, 1);


CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    icono VARCHAR(50) NULL,
    activo TINYINT(1) DEFAULT 1,
    fecha_creacion  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO categorias (nombre, icono, activo) VALUES
('Crepas', '🫔', 1),
('Fresas', '🍓', 1),
('Helados', '🍦', 1),
('Bebidas', '🥤', 1),
('Waffles', '🧇', 1),
('Postres', '🍮', 1);



/**/