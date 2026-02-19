CREATE TABLE usuarios(
id_usurio INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(100) NOT NULL, 
usuario VARCHAR(70) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL, 
rol ENUM ('admin', 'vendedor') NOT NULL, 
activo TINYINT(1) DEFAULT 1, 
fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


/* Usuario principal y primer creado*/
INSERT INTO usuarios (nombre, usuario, password, rol, activo) 
VALUES ('Daniela del Rosario', 'daniela', '$2y$10$Rde7eiK90Vz21QnoM496v.53lmIXipvA3q22vnwMI03B60u2.9u32', 'admin', 1);