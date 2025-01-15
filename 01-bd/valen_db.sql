CREATE DATABASE  IF NOT EXISTS `valen_db`;
USE `valen_db`;

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `name` text NOT NULL,
                        `cnpj` varchar(14) NOT NULL,
                        `state` text NOT NULL,
                        `nation` text NOT NULL,
                        `description` text NOT NULL,
                        `link` text NOT NULL,
                        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                        `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO `clients`(id, name, cnpj, state, nation, description, link) VALUES ('1', 'Prefeitura Municipal de Charqueadas', '88743604000179', 'Rio Grande do Sul', 'Brasil', 'Prefeitura de uma cidade chamada Charqueadas, está que decidiu trabalhar com Valen após seu sistema ficar reconhecido pelo seu alto padrão de eficiência em prefeituras pertos de sua região.', 'https://www.charqueadas.rs.gov.br/');
INSERT INTO `clients`(id, name, cnpj, state, nation, description, link) VALUES ('2', 'Prefeitura Municipal de Arroio dos Ratos', '88363072000144', 'Rio Grande do Sul', 'Brasil', 'Prefeitura responsável por uma cidade pequena do interior do Rio Grande do Sul, eles desde 2020 trabalham com Valen em uma parceria para melhorar o desenvolvimento de sua cidade.', 'https://www.arroiodosratos.rs.gov.br/');

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
                         `id` int(11) NOT NULL AUTO_INCREMENT,
                         `id_client` int(11) NOT NULL,
                         `name` varchar(45) NOT NULL,
                         `email` varchar(45) NOT NULL,
                         `password` varchar(255) NOT NULL,
                         `document` varchar(45) DEFAULT NULL,
                         `photo` varchar(255) NOT NULL,
                         `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                         `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `email_UNIQUE` (`email`),
                         CONSTRAINT fk_CliUsers FOREIGN KEY (id_client) REFERENCES clients (id)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO `users`(id, id_client, name, email, password, document) 
VALUES('1', '2', 'Elano Tavares do Nascimento', 'elano.tavares.ncs@gmail.com', '$2y$10$su.8ZfjbcLIPFi3PPB7IMOXlPRQlS7FA3WOD8GPvccpADOpOJOR6K', "6234880928");

INSERT INTO `users`(id, id_client, name, email, password, document) 
VALUES('2', '1', 'Teste de Desenvolvimento', 'teste@gmail.com', '$2y$10$PpEITMc5Ylby/Wkx8nILQOZFXUBP4J0WTxq0P2PlFPaPA2iQvICCy', "6234880928");

DROP TABLE IF EXISTS `notes`;

CREATE TABLE `notes` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `id_user` int(11) NOT NULL,
                        `name` text NOT NULL,
                        `description` text NOT NULL,
                        `time` text NOT NULL,
                        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                        `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
                        PRIMARY KEY (`id`),
                        CONSTRAINT fk_UserNotes FOREIGN KEY (id_user) REFERENCES users (id)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

DROP TABLE IF EXISTS `archives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `archives` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `id_client` int(11) NOT NULL,
                        `name` text NOT NULL,
                        `description` text NOT NULL,
                        `category` text NOT NULL,
                        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                        `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
                        PRIMARY KEY (`id`),
                        CONSTRAINT fk_CliArchives FOREIGN KEY (id_client) REFERENCES clients (id)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO `archives`(id_client, name, description, category) 
VALUES('2', 'Edital 0001/2022', 'Edital referente ao recesso de Verão', 'Editais');

INSERT INTO `archives`(id_client, name, description, category) 
VALUES('2', 'Edital 0002/2022', 'Edital referente as férias dos concursados', 'Editais');

DROP TABLE IF EXISTS `faqs`;

CREATE TABLE `faqs` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `question` text NOT NULL,
                        `answer` text NOT NULL,
                        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                        `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `faqs`(question, answer) 
VALUES('Quem nasceu primeiro, o ovo ou a galinha?', 'Não sei... Cara faça perguntas melhores, este site gerencia arquivos, 
então como iremos saber qual destes nasceu primeiro? 
Mas se eu tivesse que chutar, chutaria o ovo!');

INSERT INTO `faqs`(question, answer) 
VALUES('Quem nasceu primeiro, o ovo ou a galinha?', 'Não sei... Cara faça perguntas melhores, este site gerencia arquivos, 
então como iremos saber qual destes nasceu primeiro? 
Mas se eu tivesse que chutar, chutaria o ovo!');