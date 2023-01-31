CREATE TABLE `user` (
  `IDm` varchar(16) NOT NULL,
  `user_name` varchar(16) DEFAULT NULL,
  `balance` int(11) DEFAULT 100000,
  PRIMARY KEY (`IDm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `product` (
  `product_ID` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(16) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) DEFAULT 999999,
  PRIMARY KEY (`product_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `user_log` (
  `log_ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDm` varchar(16) NOT NULL,
  `command` varchar(16) NOT NULL,
  `point_balance` int(11) NOT NULL,
  PRIMARY KEY (`log_ID`),
  KEY `IDm` (`IDm`),
  CONSTRAINT `user_log_ibfk_1` FOREIGN KEY (`IDm`) REFERENCES `user` (`IDm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `purchase` (
  `log_ID` int(11) NOT NULL AUTO_INCREMENT,
  `product_ID` int(11) NOT NULL,
  `purchase_date` datetime DEFAULT current_timestamp(),
  `point_stock` int(11) NOT NULL,
  PRIMARY KEY (`log_ID`),
  KEY `product_ID` (`product_ID`),
  CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`product_ID`) REFERENCES `product` (`product_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

Insert into user (IDm,user_name) value ('012e50e6944444','test1');
Insert into user (IDm,user_name) value ('012e50e694443b','test2');
Insert into user (IDm,user_name) value ('012e50e6944439','test3');
Insert into user (IDm,user_name) value ('012e50e694447d','test4');
Insert into user (IDm,user_name) value ('012e50e6944477','test5');

Insert into product (product_name,price) value ('コカ・コーラ',160);
Insert into product (product_name,price) value ('三ツ矢サイダー',160);
Insert into product (product_name,price) value ('おーいお茶',120);
Insert into product (product_name,price) value ('Boss Coffee Black',110);
Insert into product (product_name,price) value ('いろはす',100);
Insert into product (product_name,price) value ('Zone',210);
