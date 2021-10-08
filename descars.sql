CREATE TABLE IF NOT EXISTS `client` (
    `cli_id` INTEGER AUTO_INCREMENT,
    `nom` VARCHAR(64) NOT NULL,
    `pseudo` VARCHAR(32) NOT NULL,
    `mdp` VARCHAR(64) NOT NULL,
    `email` VARCHAR(64) UNIQUE NOT NULL,
    `adresse` TEXT NOT NULL,
    `role` VARCHAR(30) NOT NULL,
    CHECK (`role` IN ('admin', 'client', 'loueur')),
    CONSTRAINT `PK_CLIENTID` PRIMARY KEY(`cli_id`)
);

CREATE TABLE IF NOT EXISTS `vehicule` (
    `veh_id` INTEGER AUTO_INCREMENT,
    `type` VARCHAR(64) NOT NULL,
    `nb` INTEGER NOT NULL,
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
    `etatL` VARCHAR(64),
    CONSTRAINT `PK_FACTUREID` PRIMARY KEY(`fac_id`),
    CONSTRAINT `FK_FACTURECLI` FOREIGN KEY(`cli_id`) REFERENCES `client`(`cli_id`),
    CONSTRAINT `FK_FACTUREVEH` FOREIGN KEY(`veh_id`) REFERENCES `vehicule`(`veh_id`)
);

INSERT INTO `client` (`cli_id`, `nom`, `pseudo`, `mdp`, `email`, `adresse`) VALUES
(1, 'Fatih', 'kilifa', '123', 'fatih@gmail.com', '143 avenue de Versailles');

INSERT INTO `vehicule` (`veh_id`, `type`, `nb`, `caract`, `photo`, `etatL`) VALUES
(1, 'Audi Q4 e-tron', 2, '[‘moteur’ :\'hybride\', ‘vitesse’ :\'automatique\']', 'https://www.audi.fr/content/dam/nemo/models/q4-e-tron/q4-e-tron/my-2022/NeMo-Derivate-Startpage/stage/audi-q4-e-tron-stage-desktop.jpg?downsize=1440px:*', 1),
(2, 'Mercedes-Benz Classe S Berline 2021', 3, '[‘vitesse’ :\'automatique\']', 'https://www.mercedes-benz.fr/passengercars/mercedes-benz-cars/models/s-class/saloon-wv223/design/exterior-gallery/_jcr_content/contentgallerycontainer/par/contentgallery/par/contentgallerytile/image.MQ4.8.2x.20200909162659.jpeg', 0),
(3, 'Ferrari SF90 2021', 1, '[‘moteur’:\'diesel\', ‘vitesse’:\'automatique\']', 'https://media.gqmagazine.fr/photos/5cef9a8a9950eb2d919f96ff/16:9/w_2560%2Cc_limit/Ferrari_SF90_Stradale_2019_83e03-1800-1200.jpg', 0),
(4, 'LAMBORGHINI HURACÁN EVO RWD SPYDER', 1, '[‘moteur’:\'diesel\', ‘vitesse’:\'automatique\']', 'https://www.lamborghini.com/sites/it-en/files/DAM/lamborghini/facelift_2019/model_detail/huracan/evo_rwd_spyder/2021/06_22/rwd_spyder_s02.jpg', 0),
(5, 'BWM M4 CSL', 2, '[‘vitesse’:\'diesel\']', 'https://cdn.motor1.com/images/mgl/RPrgg/s1/bmw-m4-competition-kith-design-study-edition-lead-image.webp', 0),
(6, 'Bugatti Bolide', 1, '[‘vitesse’:\'diesel\']', 'https://www.bugatti.com/fileadmin/_processed_/sei/p581/se-image-c90c599f8a59cdc39317cef56ca693cb.jpg', 1);
