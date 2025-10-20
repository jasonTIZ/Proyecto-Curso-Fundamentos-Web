-- ==========================================================
-- TABLA: usuario_webmaster
-- ==========================================================
CREATE TABLE usuario_webmaster (
    id_webmaster INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido1 VARCHAR(100) NOT NULL,
    apellido2 VARCHAR(100),
    email VARCHAR(150) NOT NULL UNIQUE,
    telefono VARCHAR(20),
    contrasena VARCHAR(255) NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ==========================================================
-- TABLA: categoria_producto
-- ==========================================================
CREATE TABLE categoria_producto (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(150) NOT NULL,
    descripcion TEXT
);

-- ==========================================================
-- TABLA: producto
-- ==========================================================
CREATE TABLE producto (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(150) NOT NULL,
    id_categoria INT NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    descripcion TEXT,
    FOREIGN KEY (id_categoria) REFERENCES categoria_producto(id_categoria)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

-- ==========================================================
-- TABLA: producto_imagen
-- ==========================================================
CREATE TABLE producto_imagen (
    id_imagen INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT NOT NULL,
    url_imagen VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_producto) REFERENCES producto(id_producto)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

-- ==========================================================
-- TABLA: categoria_negocio
-- ==========================================================
CREATE TABLE categoria_negocio (
    id_categoria_negocio INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(150) NOT NULL,
    descripcion TEXT
);

-- ==========================================================
-- TABLA: negocio
-- ==========================================================
CREATE TABLE negocio (
    id_negocio INT AUTO_INCREMENT PRIMARY KEY,
    nombre_negocio VARCHAR(150) NOT NULL,
    descripcion TEXT,
    id_categoria_negocio INT,
    provincia VARCHAR(100),
    canton VARCHAR(100),
    distrito VARCHAR(100),
    barrio VARCHAR(100),
    otras_senas TEXT,
    telefono VARCHAR(20),
    email VARCHAR(150),
    FOREIGN KEY (id_categoria_negocio) REFERENCES categoria_negocio(id_categoria_negocio)
        ON UPDATE CASCADE
        ON DELETE SET NULL
);

-- ==========================================================
-- TABLA RELACIONAL: negocio_producto (N:M) CON ID PROPIO
-- ==========================================================
CREATE TABLE negocio_producto (
    id_negocio_producto INT AUTO_INCREMENT PRIMARY KEY,
    id_negocio INT NOT NULL,
    id_producto INT NOT NULL,
    UNIQUE (id_negocio, id_producto),
    FOREIGN KEY (id_negocio) REFERENCES negocio(id_negocio)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES producto(id_producto)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);
