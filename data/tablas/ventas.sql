CREATE TABLE ventas(
id_venta INT AUTO_INCREMENT PRIMARY KEY,
id_usuario INT,
total DECIMAL (10,2), 
pago DECIMAL (10,2),   
cambio DECIMAL (10,2),
metodo_pago VARCHAR (50),
estado VARCHAR (20) DEFAULT 'completada',
fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);