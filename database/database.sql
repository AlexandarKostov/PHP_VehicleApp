-- My database sql name is "vehicle"


1.
CREATE TABLE admins (
id INT UNSIGNED AUTO_INCREMENT,
    email VARCHAR(32),
    username VARCHAR(32),
    password VARCHAR(255),
CONSTRAINT PRIMARY KEY (id)
);

INSERT INTO admins (`username` , `email`, `password`) VALUES ('admin', 'admin@example.com' , '$2y$10$J0d0Xj3p5.3QRoAjj7nLP.Ev8snX3Y8XOFJyWy1UuAHF9pXpDWE/m');

CREATE TABLE `vehicle_model` (
	`id` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `vehicle_model_dropdown` varchar(32) NOT NULL
);
INSERT INTO `vehicle_model` (`id`, `vehicle_model_dropdown`) VALUES (NULL, 'BMW'), (NULL, 'Audi'), (NULL, 'VW'), (NULL, 'Bugatti');


CREATE TABLE `vehicle_type` (
	`id` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `vehicle_type_dropdown` varchar(32) NOT NULL
);

INSERT INTO vehicle_type (`id`, `vehicle_type_dropdown`) VALUES (NULL , 'Sedan'), (NULL, 'Coupe') , (NULL, 'Suv');

CREATE TABLE `fuel_type` (
	`id` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `fuel_type_dropdown` varchar(32) NOT NULL
);

INSERT INTO fuel_type (`id`, `fuel_type_dropdown`) VALUES (NULL, 'Gasoline'), (NULL, 'Diesel'), (NULL, 'Electric');

CREATE TABLE `registrations` (
	`id` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    vehicle_model_id int UNSIGNED NOT NULL,
    vehicle_type_id int UNSIGNED NOT NULL,
    fuel_type_id int UNSIGNED NOT NULL,
    chasis_number VARCHAR(16),
    reg_number VARCHAR(16),
    reg_to datetime,
    product_year datetime,
    FOREIGN KEY(`vehicle_model_id`) REFERENCES `vehicle_model`(`id`),
    FOREIGN KEY(`vehicle_type_id`) REFERENCES `vehicle_type`(`id`),
    FOREIGN KEY (`fuel_type_id`) REFERENCES `fuel_type`(`id`)
    
    
);






SELECT `registrations`.*, `vehicle_model`.`vehicle_model_dropdown` AS `vehicle_model_id`, `vehicle_type`.`vehicle_type_dropdown` AS `vehicle_type_id`, `fuel_type`.`fuel_type_dropdown` AS `fuel_type_id`, chasis_number, reg_number, reg_to , product_year FROM `registrations` JOIN `vehicle_model` ON `registrations`.`vehicle_model_id`=`vehicle_model`.`id` JOIN `vehicle_type` ON `registrations`.`vehicle_type_id` = `vehicle_type`.`id` JOIN `fuel_type` ON `registrations`.`fuel_type_id` = `fuel_type`.`id`
