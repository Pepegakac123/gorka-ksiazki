CREATE TABLE `books_mountain`.`messages` (
`id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, 
`message` TEXT NOT NULL , 
`sender_id` INT(11) NOT NULL , 
`reciver_id` INT(11) NOT NULL , 
`send_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP) ENGINE = InnoDB;