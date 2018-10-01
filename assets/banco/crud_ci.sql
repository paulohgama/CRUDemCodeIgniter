CREATE TABLE categorias(
	categoria_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	categoria_nome VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE subcategorias(
	subcategoria_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	subcategoria_nome VARCHAR(50) NOT NULL UNIQUE,
	categoria_fk INT NOT NULL,
	FOREIGN KEY (categoria_fk) REFERENCES categorias (categoria_id)
);

CREATE TABLE usuarios(
	usuario_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	usuario_nome VARCHAR(50) NOT NULL,
	usuario_email VARCHAR(50) NOT NULL UNIQUE,
	usuario_data VARCHAR(20) NOT NULL,
	subcategoria_fk INT NOT NULL,
	FOREIGN KEY (subcategoria_fk) REFERENCES subcategorias (subcategoria_id)
);