-- ==========================================================
-- CREACIÓN DE LA BASE DE DATOS
-- ==========================================================
CREATE DATABASE IF NOT EXISTS sistema_negocios;
USE sistema_negocios;

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
    provincia VARCHAR(100),
    canton VARCHAR(100),
    distrito VARCHAR(100),
    barrio VARCHAR(100),
    otras_senas TEXT,
    telefono VARCHAR(20),
    email VARCHAR(150),
    facebook_url VARCHAR(255),
    instagram_url VARCHAR(255),
    tiktok_url VARCHAR(255),
    iframe_ubicacion TEXT
);

-- ==========================================================
-- TABLA RELACIONAL: negocio_categoria_rel (N:M) con ID propio
-- ==========================================================
CREATE TABLE negocio_categoria_rel (
    id_rel INT AUTO_INCREMENT PRIMARY KEY,
    id_negocio INT NOT NULL,
    id_categoria_negocio INT NOT NULL,
    FOREIGN KEY (id_negocio) REFERENCES negocio(id_negocio)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    FOREIGN KEY (id_categoria_negocio) REFERENCES categoria_negocio(id_categoria_negocio)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

-- ==========================================================
-- TABLA: negocio_imagen (1:N con negocio)
-- ==========================================================
CREATE TABLE negocio_imagen (
    id_imagen_negocio INT AUTO_INCREMENT PRIMARY KEY,
    id_negocio INT NOT NULL,
    url_imagen VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_negocio) REFERENCES negocio(id_negocio)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

-- ==========================================================
-- TABLA: producto (1:N con negocio)
-- ==========================================================
CREATE TABLE producto (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(150) NOT NULL,
    id_categoria INT NOT NULL,
    id_negocio INT NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    descripcion TEXT,
    FOREIGN KEY (id_categoria) REFERENCES categoria_producto(id_categoria)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY (id_negocio) REFERENCES negocio(id_negocio)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

-- ==========================================================
-- TABLA: producto_imagen (1:N con producto)
-- ==========================================================
CREATE TABLE producto_imagen (
    id_imagen INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT NOT NULL,
    url_imagen VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_producto) REFERENCES producto(id_producto)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);
