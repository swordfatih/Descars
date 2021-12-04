CREATE TABLE IF NOT EXISTS `client` (
    `cli_id` INTEGER AUTO_INCREMENT,
    `nom` VARCHAR(64) NOT NULL,
    `pseudo` VARCHAR(32) NOT NULL,
    `email` VARCHAR(64) UNIQUE NOT NULL,
    `mdp` VARCHAR(64) NOT NULL,
    `nomE` VARCHAR(32) NOT NULL,
    `adresseE` TEXT NOT NULL,
    CONSTRAINT `PK_UTILISATEURID` PRIMARY KEY(`cli_id`)
);

CREATE TABLE IF NOT EXISTS `loueur` (
    `cli_id` INTEGER AUTO_INCREMENT,
    CONSTRAINT `PK_LOUEURID` PRIMARY KEY(`cli_id`),
    CONSTRAINT `FK_LOUEURID` FOREIGN KEY(`cli_id`) REFERENCES `client`(`cli_id`)
);

CREATE TABLE IF NOT EXISTS `vehicule` (
    `veh_id` INTEGER AUTO_INCREMENT,
    `type` VARCHAR(64) NOT NULL,
    `tarif` INTEGER NOT NULL,
    `caract` TEXT,
    `photo` TEXT NOT NULL,
    `etatL` VARCHAR(64) NOT NULL,
    CONSTRAINT `PK_VEHICULEID` PRIMARY KEY(`veh_id`)
);

CREATE TABLE IF NOT EXISTS `facture` (
    `fac_id` INTEGER AUTO_INCREMENT,
    `cli_id` INTEGER NOT NULL,
    `veh_id` INTEGER NOT NULL,
    `dateD` DATE NOT NULL,
    `dateF` DATE,
    `valeur` INTEGER NOT NULL,
    `etatR` TINYINT(1) NOT NULL,
    CONSTRAINT `PK_FACTUREID` PRIMARY KEY(`fac_id`),
    CONSTRAINT `FK_FACTURECLI` FOREIGN KEY(`cli_id`) REFERENCES `client`(`cli_id`),
    CONSTRAINT `FK_FACTUREVEH` FOREIGN KEY(`veh_id`) REFERENCES `vehicule`(`veh_id`)    
);

INSERT INTO `client` (`cli_id`, `nom`, `pseudo`, `email`, `mdp`, `nomE`, `adresseE`) VALUES
(1, 'Fatih', 'kilifa', 'fatih@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'Descars', '143 avenue de Versailles'), -- 123
(2, 'Berger', 'jberger', 'berger@free.fr', 'cf772c5c32871ccc862ddb1c328590ede5f214e540a94107415a06a7b414c459', 'Apple', '17 avenue Georges-V'), -- all99
(3, 'Mendy', 'bmendy', 'mendy@london-prison.uk', '22e4f6912a6980d6fd59e0c5409247407491282cc8dbd009734066b8393a5761', 'Manchester City', '7 street of London'); -- foot

INSERT INTO `loueur` (`cli_id`) VALUES
(1);

INSERT INTO `vehicule` (`veh_id`, `type`, `tarif`, `caract`, `photo`, `etatL`) VALUES
(1, 'Audi Q4 e-tron', 135, '{"vitesse":"manuelle","moteur":"automatique"}', 'audi_q4.jpg', 'en_revision'),
(2, 'Mercedes-Benz Classe S Berline 2021', 102, '{"vitesse":"automatique","moteur":"hybride"}', 'mercedes_s.jpg', 'disponible'),
(3, 'Ferrari SF90 2021', 90, '{"vitesse":"manuelle","moteur":"diesel"}', 'ferrari_sf90.jpg', 'disponible'),
(4, 'LAMBORGHINI HURACÁN EVO RWD SPYDER', 98, '{"moteur":"diesel", "vitesse":"automatique"}', 'lamborghini_huracan.jpg', 'disponible'),
(5, 'BWM M4 CSL', 124, '{"vitesse":"automatique"}', 'bmw_m4.jpg', 'disponible'),
(6, 'Bugatti Bolide', 80, '{"vitesse":"manuelle"}', 'bugatti_bolide.jpg', 'en_revision');