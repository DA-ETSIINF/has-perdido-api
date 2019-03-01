CREATE TABLE IF NOT EXISTS `objects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `category` ENUM('books','keys','clothes','glasses','coats','cases','technology','calculators','bottles','other') NOT NULL,
  `description` text,
  `color` text NOT NULL,
  `createdAt` date NOT NULL,
  `place` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1; 