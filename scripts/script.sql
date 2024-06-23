CREATE TABLE report (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    animal VARCHAR(255) NOT NULL,
    creatd_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

CREATE TABLE report (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    animal VARCHAR(255) NOT NULL,
    created_at DATE CURRENT_TIMESTAMP

);

CREATE TABLE habitat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    commentaire_habitat VARCHAR(255) NOT NULL
);

CREATE TABLE avis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    avis VARCHAR(255) NOT NULL,
    isVisible boolean NOT NULL
);

CREATE TABLE service (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,   
);

CREATE TABLE animal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(255) NOT NULL,
    etat VARCHAR(255) NOT NULL,
    race VARCHAR(255) NOT NULL
);