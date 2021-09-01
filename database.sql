DROP DATABASE IF EXISTS CCMP_VM; 

CREATE DATABASE IF NOT EXISTS CCMP_VM;

USE CCMP_VM;

CREATE TABLE IF NOT EXISTS Customer (
  customer_ID CHAR(8),
  first_name VARCHAR(30) NOT NULL,
  last_name VARCHAR(40) NOT NULL,
  address_line_1 VARCHAR(40) NOT NULL,
  address_line_2 VARCHAR(40),
  postcode VARCHAR(11) NOT NULL,
  city VARCHAR(20),
  county VARCHAR(20),
  main_phone VARCHAR(11) UNIQUE,
  mobile_phone VARCHAR(11) NOT NULL UNIQUE,
  email VARCHAR(40) NOT NULL UNIQUE,
  CONSTRAINT cust_pk_index PRIMARY KEY(Customer_ID),
  CONSTRAINT check_cust_email_format CHECK (email LIKE '%___@___%')
);


/* Triggers for Customer Table input validation - using Regular Expressions for the correct format */

DELIMITER $$

CREATE TRIGGER trig_cust_main_phone_check BEFORE INSERT ON Customer
FOR EACH ROW 
BEGIN 
IF (NEW.main_phone REGEXP '[0-9]{11}' ) = 0 THEN 
  SIGNAL SQLSTATE '11111'
     SET MESSAGE_TEXT = 'Invalid Main Number Format';
END IF; 
END$$

CREATE TRIGGER trig_cust_mobile_phone_check BEFORE INSERT ON Customer
FOR EACH ROW
BEGIN 
IF (NEW.mobile_phone REGEXP '[0-9]{11}') = 0 THEN
   SIGNAL SQLSTATE '11111'
      SET MESSAGE_TEXT = 'Invalid Mobile Number Format';
END IF;
END$$

CREATE TRIGGER trig_cust_postcode_check BEFORE INSERT ON  Customer
FOR EACH ROW
BEGIN
IF (NEW.Postcode NOT REGEXP '[^A-Za-z0-9 ]') = 0 THEN
    SIGNAL SQLSTATE '11111'
        SET MESSAGE_TEXT = 'Invalid Postcode Format';
END IF;
END$$

DELIMITER ;



CREATE TABLE IF NOT EXISTS Company ( 
  company_ID CHAR(8),
  company_name VARCHAR(30) NOT NULL,
  address_line_1 VARCHAR(40) NOT NULL,
  address_line_2 VARCHAR(40),
  postcode VARCHAR(11) NOT NULL,
  city VARCHAR(20),
  county VARCHAR(20),
  main_phone VARCHAR(11),
  mobile_phone VARCHAR(11),
  email VARCHAR(40),
  CONSTRAINT company_pk_index PRIMARY KEY(company_ID),
  CONSTRAINT check_cmpy_email_format CHECK (email LIKE "%___@___%")
);

/* Triggers for Company Table input validation - using Regular Expressions for the correct format */

DELIMITER $$

CREATE TRIGGER trig_cmpy_main_phone_check BEFORE INSERT ON Company
FOR EACH ROW 
BEGIN 
IF (NEW.main_phone REGEXP '[0-9]{11}' ) = 0 THEN 
  SIGNAL SQLSTATE '11111'
     SET MESSAGE_TEXT = 'Invalid Main Number Format';
END IF; 
END$$

CREATE TRIGGER trig_cmpy_mobile_phone_check BEFORE INSERT ON Company
FOR EACH ROW
BEGIN 
IF (NEW.mobile_phone REGEXP '[0-9]{11}') = 0 THEN
   SIGNAL SQLSTATE '11111'
      SET MESSAGE_TEXT = 'Invalid Mobile Number Format';
END IF;
END$$

CREATE TRIGGER trig_cmpy_postcode_check BEFORE INSERT ON  Company
FOR EACH ROW
BEGIN
IF (NEW.Postcode NOT REGEXP '[^A-Za-z0-9 ]') = 0 THEN
    SIGNAL SQLSTATE '11111'
        SET MESSAGE_TEXT = 'Invalid Postcode Format';
END IF;
END$$

DELIMITER ;


CREATE TABLE IF NOT EXISTS Company_Contact ( 
  company_contact_ID CHAR(8),
  first_name VARCHAR(30) NOT NULL,
  last_name VARCHAR(40) NOT NULL,
  address_line_1 VARCHAR(40) NOT NULL,
  address_line_2 VARCHAR(40),
  postcode VARCHAR(11) NOT NULL,
  city VARCHAR(20),
  county VARCHAR(20),
  main_phone VARCHAR(11) UNIQUE,
  mobile_phone VARCHAR(11) UNIQUE,
  email VARCHAR(40) NOT NULL UNIQUE,
  company_ID CHAR(8) NOT NULL,
  CONSTRAINT cmpy_con_ID_pk_index PRIMARY KEY(company_contact_ID),
  CONSTRAINT cmpy_ID_fk_index FOREIGN KEY(company_ID) REFERENCES Company(company_ID),
  CONSTRAINT check_cmpy_con_email_format CHECK (email LIKE "%___@___%")
);

/* Triggers for Company Table input validation - using Regular Expressions for the correct format */

DELIMITER $$

CREATE TRIGGER trig_cmpy_con_main_phone_check BEFORE INSERT ON Company_Contact
FOR EACH ROW 
BEGIN 
IF (NEW.main_phone REGEXP '[0-9]{11}' ) = 0 THEN 
  SIGNAL SQLSTATE '11111'
     SET MESSAGE_TEXT = 'Invalid Main Number Format';
END IF; 
END$$

CREATE TRIGGER trig_cmpy_con_mobile_phone_check BEFORE INSERT ON Company_Contact
FOR EACH ROW
BEGIN 
IF (NEW.mobile_phone REGEXP '[0-9]{11}') = 0 THEN
   SIGNAL SQLSTATE '11111'
      SET MESSAGE_TEXT = 'Invalid Mobile Number Format';
END IF;
END$$

CREATE TRIGGER trig_cmpy_con_postcode_check BEFORE INSERT ON Company_Contact
FOR EACH ROW
BEGIN
IF (NEW.Postcode NOT REGEXP '[^A-Za-z0-9 ]') = 0 THEN
    SIGNAL SQLSTATE '11111'
        SET MESSAGE_TEXT = 'Invalid Postcode Format';
END IF;
END$$

DELIMITER ;


CREATE TABLE IF NOT EXISTS Plan (
    plan_ID CHAR(7),
    plan_name VARCHAR(20) NOT NULL UNIQUE,
    plan_price_annual DECIMAL(6,2) NOT NULL,
    plan_price_monthly DECIMAL(5,2) NOT NULL,
    plan_vcore VARCHAR(2) NOT NULL,
    plan_ram VARCHAR(6) NOT NULL,
    plan_storage_GB VARCHAR(3) NOT NULL,
    CONSTRAINT plan_ID_pk_index PRIMARY KEY(plan_ID)
);

CREATE TABLE IF NOT EXISTS Operating_System (
    operating_system_ID CHAR(5),
    name VARCHAR(15) NOT NULL,
    version VARCHAR(10) NOT NULL,
    CONSTRAINT os_ID_pk_index PRIMARY KEY(operating_system_ID)
);

CREATE TABLE IF NOT EXISTS Data_Site (
  data_site_ID CHAR(5),
  address_line_1 VARCHAR(40) NOT NULL,
  address_line_2 VARCHAR(40),
  postcode VARCHAR(11) NOT NULL,
  city VARCHAR(20),
  county VARCHAR(20),
  main_phone VARCHAR(11),
  email VARCHAR(40) NOT NULL,
  CONSTRAINT data_site_ID_pk_index PRIMARY KEY(data_site_ID),
  CONSTRAINT check_data_site_email_format CHECK (email LIKE "%___@___%")
);

/* Triggers for Company Table input validation - using Regular Expressions for the correct format */

DELIMITER $$

CREATE TRIGGER trig_data_site_main_phone_check BEFORE INSERT ON Data_Site
FOR EACH ROW 
BEGIN 
IF (NEW.main_phone REGEXP '[0-9]{11}' ) = 0 THEN 
  SIGNAL SQLSTATE '11111'
     SET MESSAGE_TEXT = 'Invalid Main Number Format';
END IF; 
END$$

CREATE TRIGGER trig_data_site_postcode_check BEFORE INSERT ON Data_Site
FOR EACH ROW
BEGIN
IF (NEW.Postcode NOT REGEXP '[^A-Za-z0-9 ]') = 0 THEN
    SIGNAL SQLSTATE '11111'
        SET MESSAGE_TEXT = 'Invalid Postcode Format';
END IF;
END$$

DELIMITER ;


CREATE TABLE IF NOT EXISTS Host_Server (
    server_name CHAR(6),
    server_cores VARCHAR(2) NOT NULL,
    server_ram VARCHAR(6) NOT NULL,
    server_storage VARCHAR(8) NOT NULL,
    data_site_ID CHAR(5),
    CONSTRAINT server_name_pk_index PRIMARY KEY(server_name),
    CONSTRAINT host_server_data_site_pk_index FOREIGN KEY(data_site_ID) REFERENCES data_site(data_site_ID)
);


CREATE TABLE IF NOT EXISTS Chosen_Plan (
    chosen_plan_ID CHAR(7),
    plan_payment_method VARCHAR(10),
    virtual_server CHAR(5) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    operating_system_ID CHAR(5),
    plan_ID CHAR(7),
    customer_ID CHAR(8),
    company_ID CHAR(8),
    server_name CHAR(6),
    CONSTRAINT chosen_plan_ID_pk_index PRIMARY KEY(chosen_plan_ID),
    CONSTRAINT chosen_plan_payment_check CHECK(plan_payment_method IN ('Monthly', 'Annual')),
    CONSTRAINT chosen_plan_os_fk_index FOREIGN KEY(operating_system_ID) REFERENCES Operating_System(operating_system_ID),
    CONSTRAINT chosen_plan_plan_fk_index FOREIGN KEY(plan_ID) REFERENCES plan(plan_ID),
    CONSTRAINT chosen_plan_cust_ID_fk_index FOREIGN KEY(customer_ID) REFERENCES Customer(customer_ID),
    CONSTRAINT chosen_plan_cmpy_ID_fk_index FOREIGN KEY(company_ID) REFERENCES Company(company_ID),
    CONSTRAINT chosen_plan_server_host_fk_index FOREIGN KEY(server_name) REFERENCES Host_Server(server_name)
);


CREATE TABLE IF NOT EXISTS Backup (
    backup_ID CHAR(10),
    backup_date DATE NOT NULL,
    backup_status VARCHAR(10),
    removal_date DATE,
    error_description TEXT,
    server_name CHAR(6),
    CONSTRAINT backup_ID_pk_index PRIMARY KEY(backup_ID),
    CONSTRAINT backup_status_check CHECK(backup_status IN ('successful', 'failed')),
    CONSTRAINT backup_server_name_fk_index FOREIGN KEY(server_name) REFERENCES Host_Server(server_name) 
);

CREATE TABLE IF NOT EXISTS Staff (
    staff_ID CHAR(6),
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    job_title VARCHAR(20),
    main_phone VARCHAR(11) UNIQUE,
    mobile_phone VARCHAR(11) UNIQUE,
    email VARCHAR(40) UNIQUE,
    data_site_ID CHAR(5),
    CONSTRAINT staff_ID_pk_index PRIMARY KEY(staff_ID),
    CONSTRAINT check_staff_email CHECK(email LIKE '%___@___%'),
    CONSTRAINT staff_data_site_fk_index FOREIGN KEY(data_site_id) REFERENCES data_site(data_site_ID)
);

DELIMITER $$

CREATE TRIGGER trig_staff_main_phone_check BEFORE INSERT ON Staff
FOR EACH ROW 
BEGIN 
IF (NEW.main_phone REGEXP '[0-9]{11}' ) = 0 THEN 
  SIGNAL SQLSTATE '11111'
     SET MESSAGE_TEXT = 'Invalid Main Number Format';
END IF; 
END$$

CREATE TRIGGER trig_staff_mobile_phone_check BEFORE INSERT ON Staff
FOR EACH ROW
BEGIN 
IF (NEW.mobile_phone REGEXP '[0-9]{11}') = 0 THEN
   SIGNAL SQLSTATE '11111'
      SET MESSAGE_TEXT = 'Invalid Mobile Number Format';
END IF;
END$$

DELIMITER ;


CREATE TABLE IF NOT EXISTS Hardware_Supplier (
  supplier_ID CHAR(5),
  address_line_1 VARCHAR(40) NOT NULL,
  address_line_2 VARCHAR(40),
  postcode VARCHAR(11) NOT NULL,
  city VARCHAR(20),
  county VARCHAR(20),
  main_phone VARCHAR(11) UNIQUE,
  email VARCHAR(40) UNIQUE,
  data_site_ID CHAR(5),
  CONSTRAINT splr_ID_pk_index PRIMARY KEY(supplier_ID),
  CONSTRAINT check_splr_email_format CHECK (email LIKE "%___@___%"),
  CONSTRAINT splr_data_site_fk_index FOREIGN KEY(data_site_ID) REFERENCES data_site(data_site_ID)
);

DELIMITER $$

CREATE TRIGGER trig_splr_postcode_check BEFORE INSERT ON Hardware_Supplier
FOR EACH ROW
BEGIN
IF (NEW.Postcode NOT REGEXP '[^A-Za-z0-9 ]') = 0 THEN
    SIGNAL SQLSTATE '11111'
        SET MESSAGE_TEXT = 'Invalid Postcode Format';
END IF;
END$$

CREATE TRIGGER trig_splr_main_phone_check BEFORE INSERT ON Hardware_Supplier
FOR EACH ROW 
BEGIN 
IF (NEW.main_phone REGEXP '[0-9]{11}' ) = 0 THEN 
  SIGNAL SQLSTATE '11111'
     SET MESSAGE_TEXT = 'Invalid Main Number Format';
END IF; 
END$$

DELIMITER ;


CREATE TABLE IF NOT EXISTS Supplier_Contact (
    supplier_contact_ID CHAR(6),
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    job_title VARCHAR(20),
    main_phone VARCHAR(11),
    mobile_phone VARCHAR(11),
    email VARCHAR(40),
    supplier_ID CHAR(5),
    CONSTRAINT splr_con_ID_pk_index PRIMARY KEY(supplier_contact_ID),
    CONSTRAINT check_splr_con_email CHECK(email LIKE '%___@___%'),
    CONSTRAINT splr_fk_index FOREIGN KEY(supplier_ID) REFERENCES hardware_supplier(supplier_ID)
);

DELIMITER $$

CREATE TRIGGER trig_splr_con_main_phone_check BEFORE INSERT ON Supplier_Contact
FOR EACH ROW 
BEGIN 
IF (NEW.main_phone REGEXP '[0-9]{11}' ) = 0 THEN 
  SIGNAL SQLSTATE '11111'
     SET MESSAGE_TEXT = 'Invalid Main Number Format';
END IF; 
END$$

CREATE TRIGGER trig_splr_con_mobile_phone_check BEFORE INSERT ON Supplier_Contact
FOR EACH ROW
BEGIN 
IF (NEW.mobile_phone REGEXP '[0-9]{11}') = 0 THEN
   SIGNAL SQLSTATE '11111'
      SET MESSAGE_TEXT = 'Invalid Mobile Number Format';
END IF;
END$$

DELIMITER ;

/* Database Inserts */

/* Customer Table Inserts */

insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000001', 'Eleni', 'McLay', '5665 Arapahoe Lane', null, 'MH221D', 'Madang', null, null, '07165641305', 'rhendonson0@mediafire.com');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000002', 'Casey', 'Beek', '9285 Meadow Valley Street', null, 'SD89940', 'Simajia', null, null, '07101408613', 'anewlands1@timesonline.co.uk');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000003', 'Ingrid', 'Golby', '916 Dakota Avenue', null, 'BS56825', 'Buden', null, null, '07937223884', 'thassard2@shinystat.com');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000004', 'Ag', 'Baldrick', '47316 Sommers Parkway', null, 'SM221H', 'Zhongba', 'Ddmashen', '01282271797', '07013865859', 'rbrimming3@1und1.com');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000005', 'Evania', 'Brumble', '1810 Tony Place', null, 'BH221D', 'Bourneville', null, null, '07351614100', 'nmunt4@webeden.co.uk');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000006', 'Kaiser', 'Rodgerson', '00138 Anderson Lane', null, 'LU221H', 'Lughaye', null, '01263351711', '07649352814', 'lslayford5@pagesperso-orange.com');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000007', 'Sallie', 'Odell', '3 Judy Trail', null, 'ME94324', 'Mate', null, '01106939780', '07391127231', 'abadam6@ehow.com');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000008', 'Kassia', 'Twigger', '344 Lakeland Avenue', '0', 'BA33100', 'Bordeaux', 'Wodzierady', '01887520071', '07391469485', 'bgiraudoux7@newyorker.com');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000009', 'Mei', 'Gillease', '9538 Loomis Street', '3', 'MI788EH', 'Marianowo', null, '01934590956', '07234670164', 'ccalbrathe8@netlog.com');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000010', 'Elianora', 'De Cruze', '2 Esker Pass', null, 'OR112EH', 'Obispos', null, null, '07186904084', 'ccleyburn9@shareasale.com');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000011', 'Robers', 'Shallcrass', '63734 Mayfield Junction', null, 'PH22EK', 'Pekuwon', 'Ivanishchi', null, '07231403826', 'spaddlea@apache.org');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000012', 'Michaella', 'Bruhnke', '726 Bobwhite Way', null, '641E22', null, 'Tomohon', null, '07518819671', 'dstrakerb@seesaa.net');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000013', 'Tiffani', 'Croxley', '441 American Ash Way', null, 'FR9732', 'Ficksburg', null, null, '07449357809', 'trodolicoc@cyberchimps.com');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000014', 'Rosie', 'Banat', '48 Comanche Way', null, 'JJ18AH', null, null, '01028735612', '07806232192',  'abourbond@techcrunch.com');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000015', 'Lura', 'Portis', '32136 Fremont Center', null, 'H56EJ36', 'Huskvarna', 'Young America', null, '07523982691', 'sbrutone@time.com');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000016', 'Saul', 'Mehmet', '4380 Hermina Road', null, 'F458E92', 'Farge', null, null, '07095620594', 'jocorrf@unc.com');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000017', 'Rockie', 'Welden', '29 Melody Point', null, 'A051818', 'Angostura', null, null, '07731496375', 'fbrydoneg@dss.com');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000018', 'Maryanne', 'Jeffes', '44 La Follette Crossing', '07852', 'P88TH1', 'Puger', null, null, '07723656251', 'ccharloth@cpanel.net');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000019', 'Bev', 'Gawen', '6926 Beilfuss Place', '90655', 'J32630', 'Juran', null, null, '07106403031', 'bgniewoszi@bigcartel.com');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000020', 'Arte', 'Lidgely', '70486 Bluejay Alley', null, 'E6J77K', 'Greenwood', null, null, '07759039549', 'cstallebrassj@t-online.uk');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000021', 'Bianka', 'Rothwell', '6 Towne Junction', '6', 'PJ22H1', 'Pilpichaca', null, '01590584508', '07368235232', 'ttraysk@arstechnica.com');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000022', 'Shane', 'Dungay', '8 Loomis Court', null, 'FR9830', 'Frankfort', null, null, '07362875734', 'mnowaczykl@ask.com');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000023', 'Tierney', 'Stoakley', '2 Anhalt Way', null, 'TE881RH', 'Telford', null, null, '07991753796', 'mtomneym@t-online.com');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000024', 'Olvan', 'Sapir', '76 Bluestem Parkway', '38338', 'C59073', null, null, '01385396170', '07891615699', 'mtallantn@hao123.com');
insert into customer (customer_id, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CU000025', 'Maurizia', 'Medway', '1 Rutledge Lane', null, 'AS4312', 'Mulanay', null, '01554467787', '07378711455', 'nsootso@loc.com');


/* Company Table Inserts */


insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000001', 'Yata', '0309 Corry Hill', null, 'W438 01A', 'Worcester', 'Worcestershire', '01013875884', null, 'dpepall0@twitpic.com');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000002', 'Trunyx', '50 Fairfield Circle', '07', 'AK112ED', null, null, '01194919264', '07154624377', 'udursley1@gnu.com');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000003', 'Oyoyo', '234 West Pass', null, 'ME50281', 'Medhaven', null, null, '07142505354', 'mcrosscombe2@simplemachines.com');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000004', 'Photojam', '3081 Prairie Rose Avenue', null, 'AW5510', null, null, null, '07679385256', 'dsaward3@opa.com');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000005', 'Tagfeed', '5 Pawling Center', null, 'M673201', 'Milhow', 'North Umbria', null, null, 'kcristofvao4@prweb.com');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000006', 'Dablist', '6 Anderson Court', null, 'M600201', 'Menuma', null, '01457879788', '07851179202', 'mblumson5@hao123.com');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000007', 'Realcube', '578 Brickson Park Place', '98012', 'JH1876', null, null, '01023155782', null, 'fprover6@amazon.co.uk');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000008', 'Topdrive', '09105 Thompson Parkway', null, 'RH87721', 'Racaven', null, '03376411363', '07942013909', 'hrosson7@businesswire.com');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000009', 'Eidel', '64940 Badeau Crossing', null, 'WQ88TVR', null, null, '01171870282', null, 'hevenden8@plala.co.uk');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000010', 'Yodoo', '9 Golf View Junction', null, 'MJ80804', 'Machen', null, '01996482284', '07795366159', 'lmonnery9@blinklist.com');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000011', 'Brainbox', '552 Northport Plaza', '4549', 'BR77h21', null, null, '01716420845', '07695871650', 'lgulleforda@gnu.org');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000012', 'Thoughtstorm', '3 Warner Junction', null, 'CN11HH', 'Cansas', null, null, '07443561562', 'fsaintsburyb@google.com');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000013', 'Shufflebeat', '43547 Rockefeller Avenue', null, 'J352604', null, null, '06137638425', null, 'ahadcroftc@networksolutions.com');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000014', 'Voolia', '4 Northland Way', '12255', 'SL221JH', 'Shropshire', null, null, '07891513189', 'ghlavacd@shareasale.com');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000015', 'Tavu', '9756 Saint Paul Terrace', '37', 'EV77JE', 'Enville', null, '01074656198', null, 'cjoselevitze@w3.org');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000016', 'Zoombox', '819 Goodland Trail', '6', 'NO771ER', 'Nottingham', null, '01246972591', null, 'akinforthf@freewebs.com');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000017', 'Linktype', '0 Gateway Trail', null, 'ER22L90', null, null, '018368429395', null, 'hwoolfallg@google.com');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000018', 'Realight', '0077 Kennedy Circle', null, 'CED991', null, null, '01001996335', '07316915039', 'srollingh@live.com');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000019', 'Snaptags', '7 Randy Hill', null, 'MJR9112', 'Montego', null, '01559190049', '07968620802', 'kkylei@tuttocitta.com');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000020', 'Trilith', '0 Browning Drive', null, 'D498522', 'Date', null, '01431680817', null, 'pbernardotj@bandcamp.com');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000021', 'Blogpad', '43 Melody Street', '5', 'A6038', null, null, '01205160934', null, 'akemberyk@purevolume.com');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000022', 'Livetube', '9 Carpenter Place', null, 'GM88112', null, null, '01474243072', '07104978837', 'walloml@rambler.com');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000023', 'Jayo', '4 Namekagon Alley', '6', 'JJA112D', 'Hobbington', 'Shire', null, '07251101885', 'jjenckenm@google.uk');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000024', 'Blogtag', '068 Bashford Pass', '0', 'LB3374', 'Libertad', null, '01743531207', '07171729972', 'cgallyonn@abc.net');
insert into company (company_id, company_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email) values ('CO000025', 'Roomm', '90835 Division Crossing', null, 'YO7712S', 'Dategang', null, '01367158826', '07994368205', 'amaccroaryo@mysql.com');


/* Company Contact Table Inserts */


insert into company_contact (company_contact_ID, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email, company_ID) values ('CON00001', 'Meagan', 'Coppen', '0309 Corry Hill', null, 'W438 01A', 'Worcester', 'Worcestershire', null, '07507341365', 'mcoppen0@bloomberg.com', 'CO000001');
insert into company_contact (company_contact_ID, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email, company_ID) values ('CON00002', 'Franky', 'Soutter', '50 Fairfield Circle', null, 'AK112ED', null, null, '01995532091', '07324383804', 'fsoutter1@pagesperso.com', 'CO000002');
insert into company_contact (company_contact_ID, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email, company_ID) values ('CON00003', 'Daniele', 'Ragbourne', '234 West Pass', null, 'ME50281', 'Medhaven', null, null, '07803815281', 'dragbourne2@fema.com', 'CO000003');

insert into company_contact (company_contact_ID, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email, company_ID) values ('CON00004', 'Carola', 'Seago', '09105 Thompson Parkway', null, 'RH87721', 'Racaven', null, null, null, 'cseago3@salon.com', 'CO000008');

insert into company_contact (company_contact_ID, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email, company_ID) values ('CON00005', 'Papagena', 'Parkhouse', '64940 Badeau Crossing', null, 'WQ88TVR', null, null, null, null, 'pparkhouse4@samsung.com', 'CO000009');

insert into company_contact (company_contact_ID, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email, company_ID) values ('CON00006', 'Doralyn', 'Hemshall', '552 Northport Plaza', '4549', 'BR77h21', null, null, null, '07714686691', 'dhemshall5@alibaba.com', 'CO000010');
insert into company_contact (company_contact_ID, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email, company_ID) values ('CON00007', 'Katrinka', 'Scanes', '3 Warner Junction', null, 'CN11HH', 'Cansas', null, '01603388862', '07045648794', 'kscanes6@usgs.com', 'CO000012');

insert into company_contact (company_contact_ID, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email, company_ID) values ('CON00008', 'Adora', 'Norvell', '43547 Rockefeller Avenue', null, 'J352604', null, null, null, '07945530865', 'anorvell7@shon.com', 'CO000013');

insert into company_contact (company_contact_ID, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email, company_ID) values ('CON00009', 'Leese', 'Hugenin', '4 Northland Way', '12255', 'SL221JH', 'Shropshire', null, null, '07008389526', 'lhugenin8@deviantart.com', 'CO000014');

insert into company_contact (company_contact_ID, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email, company_ID) values ('CON00010', 'Rhianna', 'Husband', '9756 Saint Paul Terrace', '37', 'EV77JE', 'Enville', null, '01946012258', '07024933283', 'rhusband9@vinaora.com', 'CO000015');

insert into company_contact (company_contact_ID, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email, company_ID) values ('CON00011', 'Galina', 'Lear', '0 Gateway Trail', null, 'ER22L90', null, null, null, null, 'gleara@springer.com', 'CO000017');

insert into company_contact (company_contact_ID, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email, company_ID) values ('CON00012', 'Emmie', 'Acton', '0 Browning Drive', null, 'D498522', 'Date', null, '01618304523', null, 'eactonb@studiopress.com', 'CO000020');

insert into company_contact (company_contact_ID, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email, company_ID) values ('CON00013', 'Falito', 'Provis', '43 Melody Street', '5', 'A6038', null, null, null, '07391333949', 'fprovisc@reddit.com', 'CO000021');

insert into company_contact (company_contact_ID, first_name, last_name, address_line_1, address_line_2, postcode, city, county, main_phone, mobile_phone, email, company_ID) values ('CON00014', 'Traver', 'Husset', '4 Namekagon Alley', '6', 'JJA112D', 'Hobbington', 'Shire', null, '07968165416', 'thussetd@networksolutions.com', 'CO000023');



/* Plan Table Inserts */


insert into plan (plan_ID, plan_name, plan_price_annual, plan_price_monthly, plan_vcore, plan_ram, plan_storage_GB) values ('PLN0001', 'Basic', '24.00', '2.00', '1', '1GB', '20');
insert into plan (plan_ID, plan_name, plan_price_annual, plan_price_monthly, plan_vcore, plan_ram, plan_storage_GB) values ('PLN0002', 'BasicPlus', '48.00', '4.00', '1', '2GB', '50');
insert into plan (plan_ID, plan_name, plan_price_annual, plan_price_monthly, plan_vcore, plan_ram, plan_storage_GB) values ('PLN0003', 'CloudSpeed', '120.00', '12.00', '4', '4GB', '100');
insert into plan (plan_ID, plan_name, plan_price_annual, plan_price_monthly, plan_vcore, plan_ram, plan_storage_GB) values ('PLN0004', 'CloudRacer', '216.00', '18.00', '8', '8GB', '150');
insert into plan (plan_ID, plan_name, plan_price_annual, plan_price_monthly, plan_vcore, plan_ram, plan_storage_GB) values ('PLN0005', 'CloudMaster', '288.00', '24.00', '8', '16GB', '200');


/* Operating System Table Inserts */


insert into operating_system (operating_system_ID, name, version) values ('OS001', 'Windows', '10');
insert into operating_system (operating_system_ID, name, version) values ('OS002', 'Windows', '8.1');
insert into operating_system (operating_system_ID, name, version) values ('OS003', 'Windows', '7');
insert into operating_system (operating_system_ID, name, version) values ('OS004', 'Linux', 'Ubuntu');
insert into operating_system (operating_system_ID, name, version) values ('OS005', 'Linux', 'Mint ');


/* Data Site Table Inserts */


insert into data_site (data_site_ID, address_line_1, address_line_2, postcode, city, county, main_phone, email) values ('DS001', '42662 Maple Plaza', null, 'WO90557', 'Worcester', 'Worcestershire', '01741934748', 'selks0@ifeng.com');
insert into data_site (data_site_ID, address_line_1, address_line_2, postcode, city, county, main_phone, email) values ('DS002', '0 Superior Lane', null, 'NH221JK', 'Nottingham', 'Nottinghamshire', '01571309166', 'kottery1@sonet.com');
insert into data_site (data_site_ID, address_line_1, address_line_2, postcode, city, county, main_phone, email) values ('DS003', '82 Nancy Junction', '845', 'BH7230', 'Birmingham', 'West Midlands', '01989355696', 'npawlicki2@etsy.com');
insert into data_site (data_site_ID, address_line_1, address_line_2, postcode, city, county, main_phone, email) values ('DS004', '64 Twin Pines Place', '45239', 'A84', 'Leeds', 'West Yorkshire', '01089280486', 'eallain3@moonnet.com');
insert into data_site (data_site_ID, address_line_1, address_line_2, postcode, city, county, main_phone, email) values ('DS005', '4581 Kedzie Road', null, 'NW87789', 'Newcastle', 'Tyne and Wear', '01968116907', 'emckillop4@trellian.com');
insert into data_site (data_site_ID, address_line_1, address_line_2, postcode, city, county, main_phone, email) values ('DS006', '40 Cardinal Park', null, 'PY88E31', 'Plymouth', 'Devon', '01147375176', 'ibartkiewicz5@netstarter.com');
insert into data_site (data_site_ID, address_line_1, address_line_2, postcode, city, county, main_phone, email) values ('DS007', '5086 Novick Hill', null, 'CA1560', 'Cambridge', 'Cambridgeshire', '01251359358', 'mmedina6@constantcontact.com');


/* Host Server Table Inserts */


insert into host_server (server_name, server_cores, server_ram, server_storage, data_site_ID) values ('SVH001', '8', '32GB', '5TB', 'DS001');
insert into host_server (server_name, server_cores, server_ram, server_storage, data_site_ID) values ('SVH002', '12', '32GB', '5TB', 'DS001');
insert into host_server (server_name, server_cores, server_ram, server_storage, data_site_ID) values ('SVH003', '8', '32GB', '5TB', 'DS002');
insert into host_server (server_name, server_cores, server_ram, server_storage, data_site_ID) values ('SVH004', '18', '64GB', '6TB', 'DS002');
insert into host_server (server_name, server_cores, server_ram, server_storage, data_site_ID) values ('SVH005', '16', '64GB', '8TB', 'DS003');
insert into host_server (server_name, server_cores, server_ram, server_storage, data_site_ID) values ('SVH006', '8', '32GB', '4TB', 'DS003');
insert into host_server (server_name, server_cores, server_ram, server_storage, data_site_ID) values ('SVH007', '8', '32GB', '4TB', 'DS003');
insert into host_server (server_name, server_cores, server_ram, server_storage, data_site_ID) values ('SVH008', '8', '32GB', '5TB', 'DS004');
insert into host_server (server_name, server_cores, server_ram, server_storage, data_site_ID) values ('SVH009', '8', '32GB', '4TB', 'DS004');
insert into host_server (server_name, server_cores, server_ram, server_storage, data_site_ID) values ('SVH010', '16', '32GB', '6TB', 'DS005');
insert into host_server (server_name, server_cores, server_ram, server_storage, data_site_ID) values ('SVH011', '8', '32GB', '4TB', 'DS005');
insert into host_server (server_name, server_cores, server_ram, server_storage, data_site_ID) values ('SVH012', '8', '32GB', '4TB', 'DS006');
insert into host_server (server_name, server_cores, server_ram, server_storage, data_site_ID) values ('SVH013', '8', '32GB', '5TB', 'DS006');
insert into host_server (server_name, server_cores, server_ram, server_storage, data_site_ID) values ('SVH014', '8', '32GB', '4TB', 'DS007');
insert into host_server (server_name, server_cores, server_ram, server_storage, data_site_ID) values ('SVH015', '8', '32GB', '4TB', 'DS007');


/* Chosen Plan Table Inserts */


insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00001', 'Monthly', 'VM001', '2020-12-10', '2021-01-10', 'OS001', 'PLN0002', 'CU000001', null, 'SVH001');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00002', 'Monthly', 'VM002', '2020-10-06', '2021-02-06', 'OS001', 'PLN0003', 'CU000002', null, 'SVH001');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00003', 'Annual', 'VM003', '2018-04-02', '2025-04-02', 'OS001', 'PLN0004', 'CU000003', null, 'SVH002');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00004', 'Monthly', 'VM004', '2019-05-06', '2021-05-06', 'OS005', 'PLN0004', 'CU000004', null, 'SVH002');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00005', 'Annual', 'VM005', '2019-01-14', '2022-01-14', 'OS002', 'PLN0001', 'CU000005', null, 'SVH003');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00006', 'Monthly', 'VM006', '2020-12-12', '2021-02-12', 'OS003', 'PLN0005', 'CU000006', null, 'SVH004');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00007', 'Monthly', 'VM007', '2019-10-14', '2021-01-14', 'OS004', 'PLN0003', 'CU000007', null, 'SVH004');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00008', 'Annual', 'VM008', '2019-07-22', '2021-07-22', 'OS003', 'PLN0001', 'CU000008', null, 'SVH004');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00009', 'Annual', 'VM009', '2020-03-08', '2022-03-08', 'OS001', 'PLN0003', 'CU000009', null, 'SVH005');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00010', 'Monthly', 'VM010', '2019-11-02', '2022-01-02', 'OS001', 'PLN0005', 'CU000010', null, 'SVH005');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00011', 'Annual', 'VM011', '2020-02-19', '2021-02-19', 'OS003', 'PLN0005', 'CU000011', null, 'SVH006');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00012', 'Annual', 'VM012', '2018-12-26', '2021-12-26', 'OS001', 'PLN0001', 'CU000012', null, 'SVH007');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00013', 'Monthly', 'VM013', '2019-12-31', '2022-01-31', 'OS003', 'PLN0003', 'CU000013', null, 'SVH007');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00014', 'Annual', 'VM014', '2019-01-06', '2021-01-06', 'OS005', 'PLN0005', 'CU000014', null, 'SVH008');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00015', 'Monthly', 'VM015', '2019-09-18', '2021-05-18', 'OS004', 'PLN0001', 'CU000015', null, 'SVH009');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00016', 'Annual', 'VM016', '2019-03-18', '2021-03-18', 'OS005', 'PLN0004', 'CU000016', null, 'SVH009');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00017', 'Annual', 'VM017', '2019-03-16', '2021-03-16', 'OS005', 'PLN0003', 'CU000017', null, 'SVH009');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00018', 'Annual', 'VM018', '2019-06-14', '2021-06-14', 'OS004', 'PLN0005', 'CU000018', null, 'SVH010');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00019', 'Monthly', 'VM019', '2019-11-18', '2021-02-18', 'OS002', 'PLN0001', 'CU000019', null, 'SVH010');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00020', 'Annual', 'VM020', '2020-11-07', '2021-11-07', 'OS003', 'PLN0005', 'CU000020', null, 'SVH010');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00021', 'Monthly', 'VM021', '2020-08-30', '2021-01-30', 'OS002', 'PLN0001', 'CU000021', null, 'SVH011');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00022', 'Annual', 'VM022', '2019-05-16', '2021-05-16', 'OS005', 'PLN0004', 'CU000022', null, 'SVH011');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00023', 'Monthly', 'VM023', '2020-11-25', '2021-01-25', 'OS005', 'PLN0001', 'CU000023', null, 'SVH012');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00024', 'Annual', 'VM024', '2020-08-01', '2021-08-01', 'OS004', 'PLN0002', 'CU000024', null, 'SVH013');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00025', 'Annual', 'VM025', '2020-08-06', '2021-08-06', 'OS001', 'PLN0005', 'CU000025', null, 'SVH013');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00026', 'Annual', 'VM026', '2019-08-26', '2021-08-26', 'OS004', 'PLN0001', null, 'CO000001', 'SVH001');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00027', 'Annual', 'VM027', '2020-09-02', '2021-09-02', 'OS005', 'PLN0003', null, 'CO000002', 'SVH002');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00028', 'Annual', 'VM028', '2019-05-10', '2021-05-10', 'OS003', 'PLN0003', null, 'CO000003', 'SVH003');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00029', 'Annual', 'VM029', '2020-02-26', '2021-02-26', 'OS001', 'PLN0001', null, 'CO000004', 'SVH003');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00030', 'Annual', 'VM030', '2019-05-03', '2021-05-03', 'OS005', 'PLN0001', null, 'CO000005', 'SVH005');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00031', 'Annual', 'VM031', '2019-02-06', '2021-02-06', 'OS003', 'PLN0002', null, 'CO000006', 'SVH005');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00032', 'Annual', 'VM032', '2018-12-17', '2021-12-17', 'OS001', 'PLN0002', null, 'CO000007', 'SVH005');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00033', 'Annual', 'VM033', '2020-08-06', '2021-08-06', 'OS002', 'PLN0004', null, 'CO000008', 'SVH006');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00034', 'Annual', 'VM034', '2020-08-19', '2021-08-19', 'OS003', 'PLN0002', null, 'CO000009', 'SVH006');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00035', 'Annual', 'VM035', '2020-10-30', '2021-10-30', 'OS004', 'PLN0004', null, 'CO000010', 'SVH007');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00036', 'Annual', 'VM036', '2019-07-24', '2021-07-24', 'OS002', 'PLN0004', null, 'CO000011', 'SVH008');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00037', 'Annual', 'VM037', '2018-12-25', '2021-12-25', 'OS003', 'PLN0002', null, 'CO000012', 'SVH008');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00038', 'Annual', 'VM038', '2020-11-08', '2021-11-08', 'OS003', 'PLN0004', null, 'CO000013', 'SVH010');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00039', 'Annual', 'VM039', '2020-03-12', '2021-03-12', 'OS004', 'PLN0004', null, 'CO000014', 'SVH010');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00040', 'Annual', 'VM040', '2019-06-26', '2021-06-26', 'OS005', 'PLN0002', null, 'CO000015', 'SVH011');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00041', 'Monthly', 'VM041', '2020-12-05', '2021-01-05', 'OS004', 'PLN0002', null, 'CO000016', 'SVH012');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00042', 'Annual', 'VM042', '2019-07-15', '2021-07-15', 'OS002', 'PLN0005', null, 'CO000017', 'SVH012');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00043', 'Annual', 'VM043', '2020-10-30', '2021-10-30', 'OS004', 'PLN0004', null, 'CO000018', 'SVH013');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00044', 'Monthly', 'VM044', '2020-12-01', '2021-01-01', 'OS004', 'PLN0004', null, 'CO000019', 'SVH014');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00045', 'Annual', 'VM045', '2020-06-03', '2021-06-03', 'OS005', 'PLN0003', null, 'CO000020', 'SVH014');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00046', 'Annual', 'VM046', '2020-11-11', '2021-11-11', 'OS005', 'PLN0005', null, 'CO000021', 'SVH014');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00047', 'Annual', 'VM047', '2019-09-08', '2021-09-08', 'OS003', 'PLN0004', null, 'CO000022', 'SVH015');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00048', 'Annual', 'VM048', '2020-06-23', '2021-06-23', 'OS002', 'PLN0003', null, 'CO000023', 'SVH015');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00049', 'Annual', 'VM049', '2019-12-04', '2021-06-23', 'OS002', 'PLN0003', null, 'CO000024', 'SVH015');
insert into chosen_plan (chosen_plan_ID, plan_payment_method, virtual_server, start_date, end_date, operating_system_ID, plan_ID, customer_ID, company_ID, server_name) values ('CP00050', 'Monthly', 'VM050', '2020-11-30', '2021-01-30', 'OS003', 'PLN0001', null, 'CO000025', 'SVH015');

/* Triggers for Chosen Plan after inserts to allow for older entries to be added */


DELIMITER $$

CREATE TRIGGER trig_chosen_plan_start_date_check
BEFORE INSERT ON Chosen_Plan
FOR EACH ROW
BEGIN
IF NEW.start_date < CURDATE() THEN
    SIGNAL SQLSTATE '11111'
        SET MESSAGE_TEXT = 'Invalid start date';
END IF;
END $$

CREATE TRIGGER trig_chosen_plan_end_date_check
BEFORE INSERT ON Chosen_Plan
FOR EACH ROW
BEGIN
IF NEW.end_date < NEW.start_date THEN
    SIGNAL SQLSTATE '11111'
        SET MESSAGE_TEXT = 'Invalid end date';
END IF;
END $$

DELIMITER ;


/* Inserts for the backup table */


insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000001', '2020-11-20', 'Successful', '2020-12-20', null, 'SVH001');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000002', '2020-11-19', 'Successful', '2020-12-19', null, 'SVH001');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000003', '2020-12-04', 'Successful', '2021-01-03', 'Warning - Error 99', 'SVH001');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000004', '2020-12-13', 'Successful', '2021-01-12', null, 'SVH001');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000005', '2020-11-28', 'Successful', '2020-12-28', null, 'SVH001');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000006', '2020-12-11', 'Successful', '2021-01-10', null, 'SVH002');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000007', '2020-11-24', 'Successful', '2020-12-24', null, 'SVH002');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000008', '2020-12-02', 'Successful', '2021-01-01', null, 'SVH002');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000009', '2020-12-05', 'Successful', '2021-01-04', null, 'SVH002');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000010', '2020-12-15', 'Successful', '2021-01-14', 'Error - 102 please contact an administrator', 'SVH002');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000011', '2020-12-13', 'Successful', '2021-01-12', null, 'SVH003');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000012', '2020-11-22', 'Successful', '2020-12-22', null, 'SVH003');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000013', '2020-12-08', 'Successful', '2021-01-07', null, 'SVH003');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000014', '2020-12-08', 'Successful', '2021-01-07', null, 'SVH003');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000015', '2020-12-14', 'Successful', '2021-01-13', null, 'SVH003');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000016', '2020-12-13', 'Successful', '2021-01-12', 'Warning - Error 99', 'SVH004');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000017', '2020-11-27', 'Successful', '2020-12-27', null, 'SVH004');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000018', '2020-12-15', 'Successful', '2021-01-14', null, 'SVH004');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000019', '2020-11-23', 'Successful', '2020-12-23', null, 'SVH004');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000020', '2020-12-07', 'Successful', '2021-01-06', null, 'SVH004');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000021', '2020-12-01', 'Successful', '2020-12-31', null, 'SVH005');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000022', '2020-12-02', 'Successful', '2021-01-01', null, 'SVH005');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000023', '2020-12-03', 'Successful', '2021-01-02', null, 'SVH005');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000024', '2020-12-11', 'Successful', '2021-01-10', null, 'SVH005');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000025', '2020-11-23', 'Successful', '2020-12-23', null, 'SVH005');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000026', '2020-11-21', 'Successful', '2020-12-21', null, 'SVH007');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000027', '2020-12-15', 'Successful', '2021-01-14', null, 'SVH007');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000028', '2020-12-11', 'Successful', '2021-01-10', null, 'SVH007');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000029', '2020-11-25', 'Successful', '2020-12-25', null, 'SVH007');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000030', '2020-11-20', 'Successful', '2020-12-20', 'Warning - Error 99', 'SVH007');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000031', '2020-12-10', 'Successful', '2021-01-09', null, 'SVH008');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000032', '2020-12-13', 'Successful', '2021-01-12', null, 'SVH008');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000033', '2020-12-16', 'Successful', '2021-01-15', 'Warning - Error 99', 'SVH008');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000034', '2020-11-25', 'Successful', '2020-12-25', null, 'SVH008');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000035', '2020-11-23', 'Successful', '2020-12-23', null, 'SVH008');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000036', '2020-12-02', 'Successful', '2021-01-01', null, 'SVH009');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000037', '2020-11-23', 'Successful', '2020-12-23', null, 'SVH009');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000038', '2020-11-28', 'Successful', '2020-12-28', null, 'SVH009');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000039', '2020-12-08', 'Successful', '2021-01-07', 'Warning - Error 441, Error 99', 'SVH009');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000040', '2020-11-22', 'Successful', '2020-12-22', null, 'SVH009');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000041', '2020-12-16', 'Successful', '2021-01-15', null, 'SVH010');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000042', '2020-11-20', 'Successful', '2020-12-20', null, 'SVH010');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000043', '2020-12-15', 'Successful', '2021-01-14', null, 'SVH010');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000044', '2020-12-06', 'Successful', '2021-01-05', 'Warning - Error 002', 'SVH010');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000045', '2020-12-15', 'Successful', '2021-01-14', null, 'SVH010');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000046', '2020-11-20', 'Successful', '2020-12-20', 'Warning - Error 002', 'SVH011');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000047', '2020-12-05', 'Successful', '2021-01-04', null, 'SVH011');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000048', '2020-12-10', 'Successful', '2021-01-09', null, 'SVH011');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000049', '2020-11-28', 'Successful', '2020-12-28', null, 'SVH011');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000050', '2020-11-27', 'Successful', '2020-12-27', 'Warning - Error 002', 'SVH011');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000051', '2020-11-25', 'Successful', '2020-12-25', null, 'SVH012');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000052', '2020-11-23', 'Successful', '2020-12-23', null, 'SVH012');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000053', '2020-12-03', 'Successful', '2021-01-02', null, 'SVH012');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000054', '2020-12-09', 'Successful', '2021-01-08', null, 'SVH012');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000055', '2020-11-21', 'Successful', '2020-12-21', null, 'SVH012');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000056', '2020-12-16', 'Successful', '2021-01-15', null, 'SVH013');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000057', '2020-12-11', 'Successful', '2021-01-10', null, 'SVH013');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000058', '2020-11-25', 'Failed', '2020-12-25', 'Error 1024', 'SVH013');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000059', '2020-12-07', 'Successful', '2021-01-06', 'Warning - Error 99', 'SVH013');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000060', '2020-12-05', 'Successful', '2021-01-04', null, 'SVH013');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000061', '2020-11-30', 'Successful', '2020-12-30', null, 'SVH014');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000062', '2020-11-30', 'Successful', '2020-12-30', null, 'SVH014');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000063', '2020-12-11', 'Successful', '2021-01-10', null, 'SVH014');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000064', '2020-12-03', 'Successful', '2021-01-02', null, 'SVH014');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000065', '2020-12-04', 'Successful', '2021-01-03', null, 'SVH014');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000066', '2020-12-08', 'Successful', '2021-01-07', null, 'SVH015');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000067', '2020-11-29', 'Successful', '2020-12-29', null, 'SVH015');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000068', '2020-12-11', 'Successful', '2021-01-10', 'Warning - Error 12', 'SVH015');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000069', '2020-11-19', 'Successful', '2020-12-19', null, 'SVH015');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000070', '2020-11-29', 'Successful', '2020-12-29', null, 'SVH015');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000071', '2020-10-01', 'Successful', '2020-10-30', null, 'SVH006');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000072', '2020-12-06', 'Successful', '2021-01-0', 'Warning - Error 12', 'SVH006');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000073', '2020-12-05', 'Successful', '2021-01-05', null, 'SVH006');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000074', '2020-12-11', 'Successful', '2021-01-10', null, 'SVH006');
insert into backup (backup_id, backup_date, backup_status, removal_date, error_description, server_name) values ('B000000075', '2020-11-23', 'Successful', '2020-12-23', null, 'SVH006');

/* Triggers for backup table validation after inserts to allow for older dates to be added */

DELIMITER $$ 

CREATE TRIGGER trig_backup_removal_date_check
BEFORE INSERT ON backup
FOR EACH ROW
BEGIN
IF NEW.removal_date < CURDATE() THEN
    SIGNAL SQLSTATE '11111'
        SET MESSAGE_TEXT = 'Invalid removal date';
END IF;
END $$

DELIMITER ;


/* Staff Table Inserts */


insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST001', 'Sabina', 'Danilishin', 'Manager', null, null, 'sdanilishin0@vnet.com', 'DS001');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST002', 'Illa', 'Rawson', 'Network Technician', '01282749562', null, 'irawson1@vnet.com', 'DS001');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST003', 'Tatiania', 'Eustis', 'Network Technician', null, null, 'teustis2@vnet.com', 'DS001');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST004', 'Irvin', 'Petley', 'IT Manager', null, '07219628349', 'ipetley3@vnet.com', 'DS001');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST005', 'Marianne', 'Bader', 'Communications Manager', '01954283306', null, 'mbader4@vnet.com', 'DS001');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST006', 'Solly', 'Toffanini', 'Manager', '01919966547', '07471428167', 'stoffanini5@snet.com', 'DS002');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST007', 'Mead', 'Stirley', 'Network Technician', null, null, 'mstirley6@snet.com', 'DS002');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST008', 'Ty', 'Gilhooley', 'Network Technician', null, '07701097617', 'tgilhooley7@snet.com', 'DS002');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST009', 'Leonora', 'McOnie', 'IT Manager', null, null, 'lmconie8@snet.com', 'DS002');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST010', 'Noah', 'Cockland', null, '01989397125', null, 'ncockland9@snet.com', 'DS002');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST011', 'Zea', 'L''Episcopio', 'Manager', '01261654905', '07983635715', 'zlepiscopioa@rnet.com', 'DS003');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST012', 'Amity', 'Tootal', 'Networking Engineer', null, null, 'atootalb@rnet.com', 'DS003');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST013', 'Anastassia', 'Venables', 'Infrastructure Manager', null, null, 'avenablesc@rnet.com', 'DS003');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST014', 'Nathanil', 'Ticic', 'Network Technician', null, null, 'nticicd@rnet.com', 'DS003');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST015', 'Vassili', 'Chimienti', null, null, null, 'vchimientie@rnet.com', 'DS003');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST016', 'Margot', 'Rechert', 'Manager', null, null, 'mrechertf@anet.com', 'DS004');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST017', 'Sandy', 'Boyd', null, null, null, 'sboydg@anet.com', 'DS004');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST018', 'Phoebe', 'Tortoise', 'IT Technician', null, '07788223970', 'ptortoiseh@anet.com', 'DS004');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST019', 'Kristofer', 'Coan', 'Communications Manager', '01338595798', null, 'kcoani@anet.com', 'DS004');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST020', 'Calley', 'Muirden', 'Network Engineer', null, null, 'cmuirdenj@anet.com', 'DS004');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST021', 'Lora', 'O''Dougherty', null, null, null, 'lodoughertyk@knet.com', 'DS005');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST022', 'Olenka', 'Darter', 'IT Engineer', null, '07727177544', 'odarterl@knet.com', 'DS005');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST023', 'Joanne', 'Delamaine', null, null, '07841417108', 'jdelamainem@knet.com', 'DS005');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST024', 'Miles', 'Waldera', 'Communications Manager', null, null, 'mwalderan@knet.com', 'DS005');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST025', 'Lorena', 'Archbell', 'IT Technician', null, null, 'larchbello@knet.com', 'DS005');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST026', 'Robbin', 'Ackred', null, null, null, 'rackredp@qnet.com', 'DS006');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST027', 'Philomena', 'Elcocks', 'Network Infrastructure Manager', null, null, 'pelcocksq@qnet.com', 'DS006');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST028', 'Tommie', 'Bollum', null, null, '07434082586', 'tbollumr@qnet.com', 'DS006');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST029', 'Dag', 'Limb', 'Network Engineer', null, null, 'dlimbs@qnet.com', 'DS006');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST030', 'Bethena', 'Mustard', null, null, '07438758373', 'bmustardt@qnet.com', 'DS006');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST031', 'Cody', 'Fosten', 'Infrastructure Manager', null, null, 'cfostenu@arpnet.com', 'DS007');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST032', 'Betteanne', 'Uglow', null, null, null, 'buglowv@arpnet.com', 'DS007');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST033', 'Marjy', 'Lapsley', null, null, null, 'mlapsleyw@arpnet.com', 'DS007');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST034', 'Leena', 'Wyles', 'Network Engineer', '01425165328', null, 'lwylesx@arpnet.com', 'DS007');
insert into staff (staff_id, first_name, last_name, job_title, main_phone, mobile_phone, email, data_site_ID) values ('ST035', 'Johnath', 'Lumb', null, null, '07708148471', 'jlumby@arpnet.com', 'DS007');


/* Hardware Supplier Table Inserts */


insert into hardware_supplier (supplier_id, address_line_1, address_line_2, postcode, city, county, email, data_site_ID) values ('SPL01', '8644 Daystar Plaza', '62', 'WO2244F', 'Worcester', 'Worcestershire', 'info0@4shared.com', 'DS001');
insert into hardware_supplier (supplier_id, address_line_1, address_line_2, postcode, city, county, email, data_site_ID) values ('SPL02', '5 Petterle Crossing', null, 'NH22D1', 'Nottingham', 'Nottinghamshire', null, 'DS002');
insert into hardware_supplier (supplier_id, address_line_1, address_line_2, postcode, city, county, email, data_site_ID) values ('SPL03', '08541 Duke Place', null, 'NH77S1', 'Nottingham', null, 'request@illenet.com', 'DS002');
insert into hardware_supplier (supplier_id, address_line_1, address_line_2, postcode, city, county, email, data_site_ID) values ('SPL04', '65 Springview Trail', null, 'BH881ER', 'Birmingham', null, null, 'DS003');
insert into hardware_supplier (supplier_id, address_line_1, address_line_2, postcode, city, county, email, data_site_ID) values ('SPL05', '46 Talmadge Avenue', null, 'A991E', null, null, 'info@sington.com', 'DS004');
insert into hardware_supplier (supplier_id, address_line_1, address_line_2, postcode, city, county, email, data_site_ID) values ('SPL06', '48 Little Fleur Alley', '13', 'NW91742', 'Newcastle', null, 'contact@koldson.com', 'DS005');
insert into hardware_supplier (supplier_id, address_line_1, address_line_2, postcode, city, county, email, data_site_ID) values ('SPL07', '092 Esch Junction', null, 'NW13399', 'Newcastle', null, null, 'DS005');
insert into hardware_supplier (supplier_id, address_line_1, address_line_2, postcode, city, county, email, data_site_ID) values ('SPL08', '61198 Tony Lane', null, 'PY1096', 'Plymouth', null, 'contact@resder.com', 'DS006');
insert into hardware_supplier (supplier_id, address_line_1, address_line_2, postcode, city, county, email, data_site_ID) values ('SPL09', '634 Sachtjen Point', '27', 'PY11130', 'Plymouth', null, 'info@squarenet.com', 'DS006');
insert into hardware_supplier (supplier_id, address_line_1, address_line_2, postcode, city, county, email, data_site_ID) values ('SPL10', '8 Victoria Center', null, 'CA93439', 'Cambridge', 'Cambridgeshire', 'contact@breaknet.com', 'DS007');


/* Supplier Contact Table Inserts */


insert into supplier_contact (supplier_contact_ID, first_name, last_name, job_title, main_phone, mobile_phone, email, supplier_ID) values ('SPC001', 'Brew', 'Bewlay', null, '01585359259', '07728901166', 'bbewlay0@4shared.com', 'SPL01');
insert into supplier_contact (supplier_contact_ID, first_name, last_name, job_title, main_phone, mobile_phone, email, supplier_ID) values ('SPC002', 'Meta', 'Surgey', null, null, '01531554992', null, 'SPL02');
insert into supplier_contact (supplier_contact_ID, first_name, last_name, job_title, main_phone, mobile_phone, email, supplier_ID) values ('SPC003', 'Mehetabel', 'Volke', null, '01332846272', '07257426994', 'mvolke2@illenet.com', 'SPL03');
insert into supplier_contact (supplier_contact_ID, first_name, last_name, job_title, main_phone, mobile_phone, email, supplier_ID) values ('SPC004', 'Lilas', 'Shallcrass', 'Communications Manager', null, '07228461892', null, 'SPL04');
insert into supplier_contact (supplier_contact_ID, first_name, last_name, job_title, main_phone, mobile_phone, email, supplier_ID) values ('SPC005', 'Torry', 'Ivakin', 'Business Communciations Organiser', null, '07552431735', 'tivakin4@sington.com', 'SPL05');
insert into supplier_contact (supplier_contact_ID, first_name, last_name, job_title, main_phone, mobile_phone, email, supplier_ID) values ('SPC006', 'Gallard', 'Nasi', null, null, null, 'gnasi5@koldson.com', 'SPL06');
insert into supplier_contact (supplier_contact_ID, first_name, last_name, job_title, main_phone, mobile_phone, email, supplier_ID) values ('SPC007', 'Dniren', 'Ardling', 'Buisiness Relations Manager', null, '07437198806', null, 'SPL07');
insert into supplier_contact (supplier_contact_ID, first_name, last_name, job_title, main_phone, mobile_phone, email, supplier_ID) values ('SPC008', 'Kelly', 'Kingerby', null, null, null, 'kkingerby7@resder.com', 'SPL08');
insert into supplier_contact (supplier_contact_ID, first_name, last_name, job_title, main_phone, mobile_phone, email, supplier_ID) values ('SPC009', 'Tobias', 'Tittershill', 'Relations Manager', '01585353484', null, 'ttittershill8@squarenet.com', 'SPL09');
insert into supplier_contact (supplier_contact_ID, first_name, last_name, job_title, main_phone, mobile_phone, email, supplier_ID) values ('SPC010', 'Polly', 'Duguid', null, '01544027450', '07497544790', 'pduguid9@breaknet.com', 'SPL10');

/*** STORED PROCEDURES & VIEWS ***/

/* Server information for CRUD */

CREATE VIEW host_server_info_view AS 
SELECT * FROM host_server;

/* Backup information for CRUD */

CREATE VIEW backup_info_view AS 
SELECT * FROM backup;

/* Supplier Information for CRUD */

CREATE VIEW data_site_supplier_info_view AS 
SELECT * FROM hardware_supplier;

/* Supplier Contact information for CRUD */

CREATE VIEW data_site_supplier_contact_info_view AS 
SELECT sct.supplier_contact_ID, sct.first_name, sct.last_name, sct.job_title, sct.main_phone, sct.mobile_phone, sct.email, sct.supplier_ID AS contact_supplier_ID, hsp.data_site_ID FROM supplier_contact sct
LEFT JOIN hardware_supplier hsp ON sct.supplier_ID = hsp.supplier_ID;

/* Company Contact Information for CRUD */

CREATE VIEW company_contact_info_view AS 
SELECT * FROM company_contact;

/* Company Information for CRUD */

CREATE VIEW company_info_view AS 
SELECT cpy.*, cpl.chosen_plan_ID, cpl.start_date, cpl.end_date, cpl.plan_payment_method, pln.plan_price_annual, pln.plan_price_monthly FROM chosen_plan cpl
INNER JOIN company cpy ON cpl.company_ID = cpy.company_ID
INNER JOIN plan pln ON cpl.plan_ID = pln.plan_ID;


/* Customer information for CRUD */

CREATE VIEW customer_info_view AS 
SELECT cus.*, cpl.chosen_plan_ID, cpl.start_date, cpl.end_date, cpl.plan_payment_method, pln.plan_price_annual, pln.plan_price_monthly FROM chosen_plan cpl
INNER JOIN customer cus ON cpl.customer_ID = cus.customer_ID
INNER JOIN plan pln ON cpl.plan_ID = pln.plan_ID;

/* Data Site info for CRUD */

CREATE VIEW data_site_full_info_view AS
SELECT * FROM data_site;

/* Staff info for CRUD */
CREATE VIEW staff_full_info_view AS
SELECT staff_ID, CONCAT(first_name, " ", last_name) AS name, job_title, main_phone, mobile_phone, email, data_site_ID FROM staff;

/* Show all supplier information for CRUD */

CREATE VIEW supplier_full_info_view AS
SELECT * FROM hardware_supplier;

/* get distinct vm count for each server */

CREATE VIEW vm_count_view AS
SELECT server_name, COUNT(*) AS vmCount FROM chosen_plan
GROUP BY server_name
ORDER BY vmCount DESC;

/* Show all basic server information */

DROP PROCEDURE IF EXISTS server_and_backup_sp;
DELIMITER $$
CREATE PROCEDURE server_and_backup_sp()
BEGIN
SELECT svr.server_name, MAX(bkp.backup_date) as last_backup, vcm.vmCount AS virtual_server_num, svr.server_storage
FROM host_server_info_view svr
LEFT JOIN backup bkp ON svr.server_name = bkp.server_name
LEFT JOIN vm_count_view vcm ON svr.server_name = vcm.server_name
GROUP BY svr.server_name;
END $$
DELIMITER ;

/* AS correlated subquery tested not faster 

SELECT svr.server_name, 
	(SELECT MAX(bkp.backup_date)
     FROM backup bkp
     WHERE svr.server_name = bkp.server_name)  AS last_backup,
     (SELECT vcm.vmCount
      FROM vm_count_view vcm
      WHERE svr.server_name = vcm.server_name) AS virtual_server_num,
      svr.server_storage
FROM host_server_info_view svr
GROUP BY svr.server_name;

*/

/* Show all Company plan information */

CREATE VIEW company_plan_info_view AS
SELECT cpl.chosen_plan_ID, cpy.company_ID, cpy.company_name, pln.plan_name, cpl.start_date, cpl.end_date, cpl.server_name, CONCAT(os.name, " ", os.version) AS operating_system, svr.data_site_ID, MAX(bkp.backup_date) AS latest_backup, CONCAT(cpc.first_name, " ", cpc.last_name) AS company_contact_full_name FROM company_info_view cpy
LEFT JOIN company_contact cpc ON cpy.company_ID = cpc.company_ID
INNER JOIN chosen_plan cpl ON cpy.company_ID = cpl.company_ID
INNER JOIN operating_system os ON cpl.operating_system_ID = os.operating_system_ID
INNER JOIN plan pln ON cpl.plan_ID = pln.plan_ID
INNER JOIN host_server svr ON cpl.server_name = svr.server_name
INNER JOIN backup bkp ON svr.server_name = bkp.server_name
GROUP BY cpl.chosen_plan_ID
ORDER BY start_date ASC;

/* Show all Customer plan information */

CREATE VIEW customer_plan_info_view AS
SELECT cpl.chosen_plan_ID, cus.customer_ID, cus.first_name, cus.last_name, pln.plan_name, cpl.start_date, cpl.end_date, cpl.server_name, CONCAT(os.name, " ", os.version) AS operating_system, svr.data_site_ID, MAX(bkp.backup_date) AS latest_backup FROM customer cus 
INNER JOIN chosen_plan cpl ON cus.customer_ID = cpl.customer_ID 
INNER JOIN operating_system os ON cpl.operating_system_ID = os.operating_system_ID 
INNER JOIN plan pln ON cpl.plan_ID = pln.plan_ID 
INNER JOIN host_server svr ON cpl.server_name = svr.server_name 
LEFT JOIN backup bkp ON svr.server_name = bkp.server_name 
GROUP BY cpl.chosen_plan_ID 
ORDER BY start_date ASC;

/* Show all Backup Information */

DROP PROCEDURE IF EXISTS backup_information_sp
DELIMITER $$
CREATE PROCEDURE backup_information_sp()
BEGIN
SELECT * FROM backup_info_view
ORDER BY backup_date DESC;
END $$
DELIMITER ;

/* Show all Data Sites */

CREATE VIEW data_site_info_view AS
SELECT ds.data_site_ID, ds.main_phone, ds.email, CONCAT(stf.first_name, " ", stf.last_name) AS site_manager, stf.main_phone AS staff_phone, stf.mobile_phone, GROUP_CONCAT( sup.supplier_ID ) AS supplier_ID FROM data_site ds
LEFT JOIN staff stf ON ds.data_site_ID = stf.data_site_ID AND stf.job_title = "Manager"
LEFT JOIN hardware_supplier sup ON ds.data_site_ID = sup.data_site_ID
GROUP BY ds.data_site_ID;

/* Show backup by date */

DROP PROCEDURE IF EXISTS backup_by_date_sp;
DELIMITER $$
CREATE PROCEDURE backup_by_date_sp(sDate DATE, eDate DATE)
BEGIN
SELECT * FROM backup_info_view 
WHERE backup_date BETWEEN sDate AND eDate;
END $$
DELIMITER ;

/* Show backup error details */

DROP PROCEDURE IF EXISTS backup_err_info_sp;
DELIMITER $$
CREATE PROCEDURE backup_err_info_sp(bID CHAR(10))
BEGIN
SELECT error_description FROM backup_info_view 
WHERE backup_ID LIKE bID;
END $$
DELIMITER ;

/* VIEW for edit company form  */
/* 
CREATE VIEW cpy_plan_edit_form_view AS 
SELECT cpl.chosen_plan_ID, cpl.plan_payment_method, cpl.plan_ID, pln.plan_name, cpl.virtual_server, cpl.start_date, cpl.end_date, cpl.operating_system_ID, cpl.company_ID, cpl.server_name, os.name, os.version FROM chosen_plan cpl
INNER JOIN operating_system os ON cpl.operating_system_ID = os.operating_system_ID
INNER JOIN plan pln ON cpl.plan_ID = pln.plan_ID; */

/*** As Correlated Subquery ***/

CREATE VIEW cpy_plan_edit_form_view AS 
SELECT cpl.chosen_plan_ID, 
	cpl.plan_payment_method, 
    cpl.plan_ID,
	(SELECT pln.plan_name
     FROM plan pln
     WHERE pln.plan_ID = cpl.plan_ID) AS plan_name,
     cpl.virtual_server, 
     cpl.start_date, 
     cpl.end_date, 
     cpl.operating_system_ID, 
     cpl.company_ID, 
     cpl.server_name,
     (SELECT CONCAT(os.name, " ", os.version)
      FROM operating_system os
      WHERE cpl.operating_system_ID = os.operating_system_ID)  AS operating_system_name
FROM chosen_plan cpl;



/* VIEW for edit customer form */
/*

CREATE VIEW cus_plan_edit_form_view AS 
SELECT cpl.chosen_plan_ID, cpl.plan_payment_method, cpl.plan_ID, pln.plan_name, cpl.virtual_server, cpl.start_date, cpl.end_date, cpl.operating_system_ID, cpl.customer_ID, cpl.server_name, os.name, os.version FROM chosen_plan cpl
INNER JOIN operating_system os ON cpl.operating_system_ID = os.operating_system_ID
INNER JOIN plan pln ON cpl.plan_ID = pln.plan_ID; */

/*** As Correlated Subquery ***/

CREATE VIEW cus_plan_edit_form_view AS
SELECT cpl.chosen_plan_ID, 
	cpl.plan_payment_method, 
    cpl.plan_ID,
	(SELECT pln.plan_name
     FROM plan pln
     WHERE pln.plan_ID = cpl.plan_ID) AS plan_name,
     cpl.virtual_server, 
     cpl.start_date, 
     cpl.end_date, 
     cpl.operating_system_ID, 
     cpl.customer_ID, 
     cpl.server_name,
     (SELECT CONCAT(os.name, " ", os.version)
      FROM operating_system os
      WHERE cpl.operating_system_ID = os.operating_system_ID)  AS operating_system_name
FROM chosen_plan cpl;


/* SP for editing company contact */

DROP PROCEDURE IF EXISTS edit_cpy_contact_sp;
DELIMITER $$
CREATE PROCEDURE edit_cpy_contact_sp(conID CHAR(8))
BEGIN
SELECT * FROM company_contact_info_view WHERE company_contact_ID LIKE conID;
END $$
DELIMITER ;

/* Show all listed Server Information */

DROP PROCEDURE IF EXISTS specific_server_sp;
DELIMITER $$
CREATE PROCEDURE specific_server_sp(hsid CHAR(6))
BEGIN
SELECT svr.server_name, vcm.vmCount AS virtual_server_num, svr.server_cores, svr.server_ram, svr.server_storage, svr.data_site_ID
FROM host_server_info_view svr
LEFT JOIN vm_count_view vcm ON svr.server_name = vcm.server_name
WHERE svr.server_name LIKE hsid;
END $$
DELIMITER ;

/* Get payment details for full payment calc */


CREATE VIEW cus_payment_view AS
SELECT chosen_plan_ID, customer_ID, start_date, end_date, plan_payment_method, plan_price_monthly, plan_price_annual, TIMESTAMPDIFF(YEAR, start_date, CURDATE()) AS yearDIFF, TIMESTAMPDIFF(MONTH, start_date, CURDATE()) AS monthDIFF,  CURDATE() AS currentDate
FROM customer_info_view;


CREATE VIEW cpy_payment_view AS
SELECT chosen_plan_ID, company_ID, start_date, end_date, plan_payment_method, plan_price_monthly, plan_price_annual, TIMESTAMPDIFF(YEAR, start_date, CURDATE()) AS yearDIFF, TIMESTAMPDIFF(MONTH, start_date, CURDATE()) AS monthDIFF, CURDATE() AS currentDate 
FROM company_info_view;


/*** INDEXES ***/

/* Indexes for Company Table */

CREATE INDEX IND_Cpy_X ON company(company_name, address_line_1, postcode, email);

/* Indexes for Company Contact Table */

CREATE INDEX IND_Cpy_Con_X ON company_contact(first_name, last_name);

/* Indexes for Customer Table */

CREATE INDEX IND_Cus_X ON customer(first_name, last_name);

/* Indexes for Chosen Plan Table */

CREATE INDEX IND_Cpl_X ON chosen_plan(plan_payment_method, start_date, end_date);

/* Indexes for Plan Table */

CREATE INDEX IND_Pln_X ON plan(plan_name, plan_price_annual, plan_price_monthly);

/* Indexes for Operating System Table */

CREATE INDEX IND_Os_X ON operating_system(name, version);

/* Indexes for Backup Table */

CREATE INDEX IND_Bkp_X ON backup(backup_date, removal_date, backup_status);

/* Indexes for Data Site Table */

CREATE INDEX IND_Ds_X ON data_site(address_line_1, postcode, city, county);

/* Indexes for Staff Table */

CREATE INDEX IND_Stf_X ON staff(first_name, last_name, job_title);

/* Indexes for Hardware Supplier Table */

CREATE INDEX IND_Spl_X ON hardware_supplier(address_line_1, postcode, city, county);

/* Indexes for Supplier Contact Table */

CREATE INDEX IND_Spl_Con_X ON supplier_contact(first_name, last_name);

/**** Role and user creation have been disabled as my version of phpmyadmin/Xampp wasn't functioning correctly. The syntax has been validated. ****/
      

/*** USER PERMISSIONS ***/

/** CREATING ROLES & USERS **/

/* Customer Service User, for answering basic customer queries */

/* CREATE ROLE 'customer_service'; */

/* GRANT SELECT ON ccmp_vm.company_plan_info_view TO 'customer_service';*/
/* GRANT SELECT ON ccmp_vm.customer_plan_info_view TO 'customer_service';*/

/* GRANT SELECT, UPDATE ON ccmp_vm.chosen_plan TO 'customer_service';*/
/* GRANT SELECT, UPDATE ON ccmp_vm.company_info_view TO 'customer_service';*/
/* GRANT SELECT, UPDATE ON ccmp_vm.company_contact_info_view TO 'customer_service';*/
/* GRANT SELECT, UPDATE ON ccmp_vm.customer_info_view TO 'customer_service';*/

/* FLUSH PRIVILEGES; */

/* Customer Service Users */

/* CREATE USER 'Millie_Gould'@'localhost' IDENTIFIED BY 'MGPass123';*/
/* GRANT 'customer_service' TO 'Millie_Gould'@'localhost';*/

/* CREATE USER 'Thomas_Lakes'@'localhost' IDENTIFIED BY 'TLPass123';*/
/* GRANT 'customer_service' TO 'Thomas_Lakes'@'localhost';*/

/* CREATE USER 'Mary_Cain'@'localhost' IDENTIFIED BY 'MCPass123';*/
/* GRANT 'customer_service' TO 'Louise_Knott'@'localhost';*/

/* CREATE USER 'Ellie_Holz'@'localhost' IDENTIFIED BY 'EHPass123';*/
/* GRANT 'customer_service' TO 'Ellie_Holz'@'localhost';*/

/* CREATE USER 'Peter_Shields'@'localhost' IDENTIFIED BY 'PSPass123';*/
/* GRANT 'customer_service' TO 'Peter_Shields'@'localhost';*/

/* FLUSH PRIVILEGES;*/


/* Customer Service Admin, further access to accounts and plans being able to insert new users and plans */

/* CREATE ROLE 'customer_service_admin';*/

/* GRANT SELECT ON ccmp_vm.company_plan_info_view TO 'customer_service_admin';*/
/* GRANT SELECT ON ccmp_vm.customer_plan_info_view TO 'customer_service_admin';*/
/* GRANT SELECT ON ccmp_vm.backup_info_view TO 'customer_service_admin';*/


/* SELECT, UPDATE, INSERT ON ccmp_vm.chosen_plan TO 'customer_service_admin';*/
/* GRANT SELECT, UPDATE, INSERT ON ccmp_vm.company_info_view TO 'customer_service_admin'; */
/* GRANT SELECT, UPDATE, INSERT ON ccmp_vm.company_contact_info_view TO 'customer_service_admin'; */
/* GRANT SELECT, UPDATE, INSERT ON ccmp_vm.customer_info_view TO 'customer_service_admin';*/

/* FLUSH PRIVILEGES;*/

/* Customer Service Admin Users */

/* CREATE USER 'Matthew_Brewer'@'localhost' IDENTIFIED BY 'MVPass123';*/
/* GRANT 'customer_service_admin' TO 'Matthew_Brewer'@'localhost';*/

/* CREATE USER 'Jordan_Jenkins'@'localhost' IDENTIFIED BY 'JJPass123';*/
/* GRANT 'customer_service_admin' TO 'Jordan_Jenkins'@'localhost';*/

/* CREATE USER 'Louise_Knott'@'localhost' IDENTIFIED BY 'LKPass123';*/
/* GRANT 'customer_service_admin' TO 'Louise_Knott'@'localhost';*/

/* CREATE USER 'Ellie_Holz'@'localhost' IDENTIFIED BY 'EHPass123';*/
/* GRANT 'customer_service_admin' TO 'Ellie_Holz'@'localhost';*/

/* CREATE USER 'Nick_Garner'@'localhost' IDENTIFIED BY 'SNGass123';*/
/* GRANT 'customer_service_admin' TO 'Nick_Garner'@'localhost';*/

/* FLUSH PRIVILEGES;*/


/* Server Moderator, access to server and backup information, able to assist customers with technical issues and queries */

/* CREATE ROLE 'server_moderator';*/

/* GRANT SELECT ON ccmp_vm.backup_info_view TO 'server_moderator';*/
/* GRANT SELECT ON ccmp_vm.company_plan_info_view TO 'server_moderator';*/
/* GRANT SELECT ON ccmp_vm.customer_plan_info_view TO 'server_moderator';*/
/* GRANT SELECT ON ccmp_vm.data_site_info_view TO 'server_moderator';*/
/* GRANT SELECT ON ccmp_vm.staff_full_info_view TO 'server_moderator'; */


/* GRANT SELECT, UPDATE ON ccmp_vm.host_server_info_view TO 'server_moderator';*/
/* GRANT SELECT, UPDATE ON ccmp_vm.data_site_full_info_view TO 'server_moderator';*/
/* GRANT SELECT, UPDATE ON ccmp_vm.data_site_supplier_info_view TO 'server_moderator';*/
/* GRANT SELECT, UPDATE ON ccmp_vm.data_site_supplier_contact_info_view TO 'server_moderator';*/

/* GRANT SELECT, UPDATE, INSERT ON ccmp_vm.chosen_plan TO 'server_moderator';*/

/* FLUSH PRIVILEGES;*/

/* Server Moderator Users */

/* CREATE USER 'Michael_Vincent'@'localhost' IDENTIFIED BY 'MVPass123';*/
/* GRANT 'server_moderator' TO 'Michael_Vincent'@'localhost';*/

/* CREATE USER 'Tamera_Jenkins'@'localhost' IDENTIFIED BY 'TJPass123';*/
/* GRANT 'server_moderator' TO 'Tamera_Jenkins'@'localhost';*/

/* CREATE USER 'Kelsie_Best'@'localhost' IDENTIFIED BY 'KBPass123';*/
/* GRANT 'server_moderator' TO 'Kelsie_Best'@'localhost';*/

/* CREATE USER 'Erik_Hills'@'localhost' IDENTIFIED BY 'EHPass123';*/
/* GRANT 'server_moderator' TO 'Erik_Hills'@'localhost';*/

/* CREATE USER 'Sharon_Wharton'@'localhost' IDENTIFIED BY 'SWPass123';*/
/* GRANT 'server_moderator' TO 'Erik_Hills'@'localhost';*/

/* FLUSH PRIVILEGES;*/

/* Server Adnministrator, full access to information in the database with limited abilites to edit and remove from specific tables */

/* CREATE ROLE 'server_administrator';*/

/* GRANT SELECT ON ccmp_vm.* TO 'server_administrator';*/

/* GRANT SELECT, UPDATE ON ccmp_vm.host_server_info_view TO 'server_administrator';*/
/* GRANT SELECT, UPDATE ON ccmp_vm.data_site_full_info_view TO 'server_administrator';*/

/* GRANT SELECT, UPDATE, INSERT, DELETE ON ccmp_vm.data_site_supplier_info_view TO 'server_administrator';*/
/* GRANT SELECT, UPDATE, INSERT, DELETE ON ccmp_vm.data_site_supplier_contact_info_view TO 'server_administrator';*/
/* GRANT SELECT, UPDATE, INSERT, DELETE ON ccmp_vm.chosen_plan TO 'server_administrator';*/
/* GRANT SELECT, UPDATE, INSERT, DELETE ON ccmp_vm.staff_full_info_view TO 'server_administrator'; */

/* FLUSH PRIVILEGES;*/

/* Server Administrator Users */

/* CREATE USER 'Deacon_Weaver'@'localhost' IDENTIFIED BY 'DWpass123';*/
/* GRANT 'server_administrator' TO 'Deacon_Weaver'@'localhost';*/

/* CREATE USER 'Vicky_North'@'loclahost' IDENTIFIED BY 'VNpass123';*/
/* GRANT 'server_administrator' TO 'Vicky_North'@'loclahost';*/

/* CREATE USER 'Karis_lara'@'localhost' IDENTIFIED BY 'KLPass123';*/
/* GRANT 'server_administrator' TO 'Karis_lara'@'localhost';*/

/* FLUSH PRIVILEGES;*/

/* Super Admin full access to CRUD operations within the application, yet not all as with the root user */

/* CREATE ROLE 'super_admin';*/

/* GRANT SELECT, INSERT, UPDATE, DELETE ON ccmp_vm.* TO 'super_admin';*/
/* FLUSH PRIVILEGES;*/

/* Super Admin Users */


/* CREATE USER 'Aaron_Gold'@'localhost' IDENTIFIED BY '200hhi';*/

/* GRANT 'super_admin' TO 'Aaron_Gold'@'localhost';*/
/* FLUSH PRIVILEGES;*/



