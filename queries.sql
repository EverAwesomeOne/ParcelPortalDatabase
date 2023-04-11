-- --------------------------------------------------------------
-- Group 4
-- Chloe Duncan, Daniil Filienko, Edwin Solis-Bruno, Jeep Naarkom
-- TCSS 445
-- --------------------------------------------------------------

-- --------------------------------------------------------------
-- HOW TO RUN
-- This file is developed for MySQL
-- --------------------------------------------------------------

START TRANSACTION;


--
-- Database: `parcelportal`
--

CREATE DATABASE IF NOT EXISTS `ParcelPortal`;
USE `ParcelPortal`;


-- --------------------------------------------------------
-- Create Tables
-- --------------------------------------------------------


-- --------------------------------------------------------
--
-- Table structure for table `building`
--

CREATE TABLE `building` (
  `Parcel_ID` int(9) NOT NULL,
  `Building_Num` int(9) NOT NULL,
  `Num_Bed` int(3) DEFAULT NULL,
  `Num_Bath` int(3) DEFAULT NULL,
  `Sqft` int(6) DEFAULT NULL,
  `Quality` varchar(20) DEFAULT NULL,
  `Property_Type` varchar(20) DEFAULT NULL
);

-- --------------------------------------------------------
--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `City` varchar(50) NOT NULL,
  `Ppl_Per_Sqmi` decimal(8,2) NOT NULL DEFAULT 0.00,
  `Pct_Age_Under_18` decimal(4,2) NOT NULL DEFAULT 0.00,
  `Pct_Age_Over_65` decimal(4,2) NOT NULL DEFAULT 0.00,
  `Pct_Unemployed` decimal(4,2) DEFAULT NULL,
  `Pct_HS_Grad` decimal(4,2) DEFAULT NULL,
  `Pct_Collg_Grad` decimal(4,2) DEFAULT NULL
);

-- --------------------------------------------------------
--
-- Table structure for table `county`
--

CREATE TABLE `county` (
  `County` varchar(50) NOT NULL,
  `Ppl_Per_Sqmi` decimal(8,2) NOT NULL DEFAULT 0.00,
  `Pct_Total_WA_Pop` decimal(4,2) NOT NULL DEFAULT 0.00,
  `Pct_Age_Under_18` decimal(4,2) NOT NULL DEFAULT 0.00,
  `Pct_Age_Over_65` decimal(4,2) NOT NULL DEFAULT 0.00,
  `Pct_Unemployed` decimal(4,2) DEFAULT NULL,
  `Pct_HS_Grad` decimal(4,2) DEFAULT NULL,
  `Pct_Collg_Grad` decimal(4,2) DEFAULT NULL
);

-- --------------------------------------------------------
--
-- Table structure for table `landparcel`
--

CREATE TABLE `landparcel` (
  `Parcel_ID` int(9) NOT NULL,
  `Street` varchar(100) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Zip` int(5) NOT NULL,
  `County` varchar(50) NOT NULL,
  `Taxpayer_ID` int(2) NOT NULL,
  `Acres` decimal(6,3) NOT NULL DEFAULT 0.000,
  `Electric` varchar(3) DEFAULT NULL,
  `Sewer` varchar(3) DEFAULT NULL,
  `Water` varchar(3) DEFAULT NULL
);

-- --------------------------------------------------------
--
-- Table structure for table `taxinfo`
--

CREATE TABLE `taxinfo` (
  `Parcel_ID` int(9) NOT NULL,
  `Assessed_Land_Val` int(7) NOT NULL DEFAULT 0,
  `Assessed_Improvements_Val` int(7) NOT NULL DEFAULT 0,
  `Tax_Yr` int(4) NOT NULL DEFAULT 2023,
  `Pct_Tax_Change` decimal(5,2) NOT NULL DEFAULT 0.00
);

-- --------------------------------------------------------
--
-- Table structure for table `taxpayer`
--

CREATE TABLE `taxpayer` (
  `Taxpayer_ID` int(2) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `LName` varchar(50) NOT NULL,
  `M_Initial` varchar(5) DEFAULT NULL,
  `Street` varchar(100) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Zip` int(5) NOT NULL,
  `County` varchar(50) NOT NULL,
  `Entity` varchar(50) NOT NULL
);


-- --------------------------------------------------------
-- Key Declaration
-- --------------------------------------------------------


-- --------------------------------------------------------
--
-- Keys for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`Parcel_ID`, `Building_Num`),
  ADD KEY `B_Parcel_ID-Foreign` (`Parcel_ID`);

-- --------------------------------------------------------
--
-- Keys for table `county`
--
ALTER TABLE `county`
  ADD PRIMARY KEY (`County`);

-- --------------------------------------------------------
--
-- Keys for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`City`);

-- --------------------------------------------------------
--
-- Keys for table `landparcel`
--
ALTER TABLE `landparcel`
  ADD PRIMARY KEY (`Parcel_ID`),
  ADD KEY `City-Foreign` (`City`),
  ADD KEY `County_Name-Foreign` (`County`),
  ADD KEY `Taxpayer_ID-Foreign` (`Taxpayer_ID`);

-- --------------------------------------------------------
--
-- Keys for table `taxinfo
--
ALTER TABLE `taxinfo`
  ADD PRIMARY KEY (`Parcel_ID`, `Tax_Yr`),
  ADD KEY `T_Parcel_ID-Foreign` (`Parcel_ID`);

-- --------------------------------------------------------
--
-- Keys for table `taxpayer`
--
ALTER TABLE `taxpayer`
  ADD PRIMARY KEY (`Taxpayer_ID`);


-- --------------------------------------------------------
-- Key Constraints
-- --------------------------------------------------------


-- --------------------------------------------------------
--
-- Constraints for table `building`
--
ALTER TABLE `building`
  ADD CONSTRAINT `B_Parcel_ID-Foreign` FOREIGN KEY (`Parcel_ID`) 
  REFERENCES `landparcel` (`Parcel_ID`)
  ON DELETE RESTRICT ON UPDATE RESTRICT;

-- --------------------------------------------------------
--
-- Constraints for table `taxinfo`
--
ALTER TABLE `taxinfo`
  ADD CONSTRAINT `T_Parcel_ID-Foreign` FOREIGN KEY (`Parcel_ID`) 
  REFERENCES `landparcel` (`Parcel_ID`)
  ON DELETE RESTRICT ON UPDATE RESTRICT;

-- --------------------------------------------------------
--
-- Constraints for table `landparcel`
--
ALTER TABLE `landparcel`
  ADD CONSTRAINT `City-Foreign` FOREIGN KEY (`City`) 
  REFERENCES `city` (`City`)
  ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `County-Foreign` FOREIGN KEY (`County`) 
  REFERENCES `county` (`County`)
  ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `Taxpayer_ID-Foreign` FOREIGN KEY (`Taxpayer_ID`) 
  REFERENCES `taxpayer` (`Taxpayer_ID`)
  ON DELETE RESTRICT ON UPDATE RESTRICT;


-- --------------------------------------------------------
-- Checks for foreign keys
-- --------------------------------------------------------


ALTER TABLE `landparcel`
  ADD CHECK (Acres >= 0);

ALTER TABLE `county` 
  ADD CHECK (Ppl_Per_sqmi >= 0), 
  ADD CHECK (Pct_Total_WA_Pop BETWEEN 0 and 100), 
  ADD CHECK (County != ''),
  ADD CHECK (Pct_Unemployed BETWEEN 0 and 100),
  ADD CHECK (Pct_HS_Grad BETWEEN 0 and 100),
  ADD CHECK (Pct_Collg_Grad BETWEEN 0 and 100),
  ADD CHECK (Pct_Age_Under_18 + Pct_Age_Over_65 BETWEEN 0 and 100);

ALTER TABLE `city` 
  ADD CHECK (Ppl_Per_sqmi >= 0),  
  ADD CHECK (City != ''), 
  ADD CHECK (Pct_Unemployed BETWEEN 0 and 100),
  ADD CHECK (Pct_HS_Grad BETWEEN 0 and 100),
  ADD CHECK (Pct_Collg_Grad BETWEEN 0 and 100),
  ADD CHECK (Pct_Age_Under_18 + Pct_Age_Over_65 BETWEEN 0 and 100);

ALTER TABLE `taxinfo`
  ADD CHECK (Assessed_Land_Val >= 0),
  ADD CHECK (Assessed_Improvements_Val >= 0),
  ADD CHECK (Tax_Yr >= 1920);



-- --------------------------------------------------------
-- Insert Data Values
-- --------------------------------------------------------





-- --------------------------------------------------------
--
-- Sample data for table `county`
--

INSERT INTO `county` (`County`, `Ppl_Per_Sqmi`, `Pct_Total_WA_Pop`, `Pct_Age_Under_18`, `Pct_Age_Over_65`, `Pct_Unemployed`, `Pct_HS_Grad`, `Pct_Collg_Grad`) VALUES
('Benton', '103.40', '2.36', '15.00', '9.80', '12.70', '1.00', '1.80'),
('Clark', '667.90', '5.67', '2.90', '23.43', '4.00', '9.00', '90.00'),
('Cowlitz', '87.50', '1.32', '9.10', '1.43', '1.12', '1.40', '21.12'),
('Island', '152.60', '1.02', '42.50', '5.30', '1.80', '90.10', '90.30'),
('King', '870.90', '25.99', '0.90', '23.43', '1.00', '90.00', '90.00'),
('Kitsap', '448.10', '3.28', '90.50', '0.30', '0.80', '19.00', '3.60'),
('Pierce', '449.90', '10.51', '2.50', '2.30', '6.00', '92.00', '9.00'),
('Snohomish', '334.80', '9.51', '1.50', '0.30', '90.80', '93.10', '63.60'),
('Spokane', '267.80', '6.17', '12.50', '54.30', '12.80', '90.10', '80.10'),
('Thurston', '335.30', '3.35', '0.50', '90.30', '60.80', '90.00', '53.60');

-- --------------------------------------------------------
--
-- Sample data for table `city`
--

INSERT INTO `city` (`City`, `Ppl_Per_Sqmi`, `Pct_Age_Under_18`, `Pct_Age_Over_65`, `Pct_Unemployed`, `Pct_HS_Grad`, `Pct_Collg_Grad`) VALUES
('Tacoma', '103.40', '15.00', '9.80', '12.70', '1.00', '1.80'),
('Olympia', '667.90', '2.90', '23.43', '4.00', '9.00', '90.00'),
('Seattle', '87.50', '9.10', '1.43', '1.12', '1.40', '21.12'),
('Ruston', '152.60', '42.50', '5.30', '1.80', '90.10', '90.30'),
('Auburn', '870.90', '0.90', '23.43', '1.00', '90.00', '90.00'),
('Puyallup', '448.10', '90.50', '0.30', '0.80', '19.00', '3.60'),
('Medina', '449.90', '2.50', '2.30', '6.00', '92.00', '9.00'),
('Lakewood', '334.80', '1.50', '0.30', '90.80', '93.10', '63.60'),
('Waller', '267.80', '12.50', '54.30', '12.80', '90.10', '80.10'),
('Federal Way', '335.30', '0.50', '90.30', '60.80', '90.00', '53.60'),
 ('Oak Harbor', '103.40', '15.00', '9.80', '12.70', '1.80', '90'), 
('Vancouver', '335.30', '55.30', '30.80', '90.00', '51.0', '86.5'), 
('Kennewick', '335.30', '46.30', '50.80', '90.00', '54.60', '87.9'), 
('Longview','335.30', '43.35', '50.80', '90.00', '90.60', '95.6'), ('Bremerton','335.30','19.30', '63.1', '90.00', '5.60', '96.5'),
 ('Everett', '335.30', '52.30', '30.80', '90.00', '3.60', '97.5'),
 ('Spokane', '335.30','56.30', '30.80', '90.00', '86.23', '98.8');
-- --------------------------------------------------------
--
-- Sample data for table `taxpayer`
--

INSERT INTO `taxpayer` (`Taxpayer_ID`, `FName`, `LName`, `M_Initial`, `Street`, `City`, `Zip`, `County`, `Entity`) VALUES
(1, 'Moises', 'Clays', 'I', '9315 Auctor Rd', 'Tacoma', 98402, 'Pierce', 'Individual'),
(2, 'Albert', 'Einstein', NULL, '416 Sid Snyder Ave SW', 'Olympia', 98504, 'Thurston', 'State'),
(3, 'Cara', 'Brown', NULL, '4954 Tortor St', 'Seattle', 98195, 'King', 'Corporation'),
(4, 'Richard', 'Marini', NULL, '3618 Duis Ave', 'Ruston', 98402, 'Pierce', 'Corporation'),
(5, 'Juan', 'Pablo', NULL, '4333 Brooklyn Ave NE', 'Seattle', 98105, 'King', 'State'),
(6, 'Chris', 'Bacon', 'P', '12401 SE 320th St', 'Auburn', 98092, 'Thurston', 'State'),
(7, 'Eyhab', 'Al-Masri', 'L', '9012 Eyhab St', 'Tacoma', 98402, 'Pierce', 'Individual'),
(8, 'Chickita', 'HotWings', NULL, '1601 39th Ave SE', 'Puyallup', 98374, 'Pierce', 'State'),
(9, 'William', 'Gates', NULL, '777 Rich St', 'Medina', 98039, 'King', 'State'),
(10, 'Mona', 'Vanderwaal', 'Y', '394 Unused Rd ', 'Puyallup', 98374, 'Pierce', 'Individual');

-- --------------------------------------------------------
--
-- Sample data for table `landparcel`
--

INSERT INTO `landparcel` (`Parcel_ID`, `Street`, `City`, `Zip`, `County`, `Taxpayer_ID`, `Acres`, `Electric`, `Sewer`, `Water`) VALUES
(100000000, '9315 Auctor Rd', 'Tacoma', 98402, 'Pierce', 1, '1', 'yes', 'yes', 'yes'),
(100000001, '416 Sid Snyder Ave SW', 'Olympia', 98504, 'Thurston', 2, '0.5', 'yes', 'yes', 'yes'),
(100000002, '4954 Tortor St', 'Seattle', 98195, 'King', 3, '0.75', 'yes', 'yes', 'yes'),
(100000003, '3618 Duis Ave', 'Ruston', 98402, 'Pierce', 4, '1.25', 'yes', 'yes', 'yes'),
(100000004, '1400 NE Campus Parkway', 'Seattle', 98195, 'King', 5, '2', 'yes', 'yes', 'yes'),
(100000005, '12401 SE 320th St', 'Auburn', 98092, 'Thurston', 6, '3.5', 'yes', 'yes', 'yes'),
(100000006, '9012 Eyhab St', 'Tacoma', 98402, 'Pierce', 7, '1.5', 'yes', 'yes', 'yes'),
(100000007, '1601 39th Ave SE', 'Puyallup', 98374, 'Pierce', 8, '3.25', 'yes', 'yes', 'yes'),
(100000008, '1999 97th Ave', 'Lakewood', 98499, 'Pierce', 9, '1.75', 'yes', 'no', 'yes'),
(100000009, '1900 Commerce S', 'Tacoma', 98402, 'Pierce', 9, '1', 'no', 'no', 'no');

-- --------------------------------------------------------
--
-- Sample data for table `taxinfo`
--

INSERT INTO `taxinfo` (`Parcel_ID`, `Assessed_Land_Val`, `Assessed_Improvements_Val`, `Tax_Yr`, `Pct_Tax_Change`) VALUES
(100000000, 150000, 250000, 2023, '6.60'),
(100000001, 99900, 305500, 2023, '14.10'),
(100000002, 172300, 314100, 2023, '9.42'),
(100000003, 208000, 212000, 2023, '5.89'),
(100000004, 400000, 1980000, 2023, '7.77'),
(100000005, 67000, 288000, 2023, '15.75'),
(100000006, 50000, 77000, 2023, '21.25'),
(100000007, 442000, 1234000, 2023, '3.50'),
(100000008, 276000, 539000, 2023, '13.80'),
(100000009, 343000, 307000, 2023, '4.20');

-- --------------------------------------------------------
--
-- Sample data for table `building`
--

INSERT INTO `building` (`Building_Num`, `Parcel_ID`, `Num_Bed`, `Num_Bath`, `Sqft`, `Quality`, `Property_Type`) VALUES
(123456789, 100000009, 0, 0, 0, NULL, NULL),
(135978544, 100000007, 2, 1, 8970, 'fair', 'single family'),
(522867347, 100000005, 3, 2, 13520, 'fair', 'single family'),
(614308726, 100000008, 0, 0, 0, NULL, NULL),
(695180040, 100000001, 2, 1, 7600, 'fair', 'single family'),
(715520493, 100000004, 2, 2, 5600, 'average', 'single family'),
(738045667, 100000003, 2, 2, 4540, 'average', 'single family'),
(812139482, 100000006, 4, 2, 6520, 'good', 'multi family'),
(843776889, 100000002, 6, 6, 8900, 'good', 'multi family'),
(982532035, 100000000, 8, 8, 15630, 'good', 'multi family');




-- --------------------------------------------------------
-- SQL Queries
-- --------------------------------------------------------




-- --------------------------------------------------------
-- Jeep

--  Query 1 
--  Purpose: To find all the buildings within a certain SQFT range for a certain taxpayer identification.
--  Expected: List all buildings that have a living area over 5500 SQFT under the taxpayer identification 5.

SELECT building.Building_num, Sqft, landparcel.Taxpayer_Id, Fname
FROM building 
JOIN landparcel
ON building.Parcel_ID = landparcel.Parcel_ID 
JOIN taxpayer 
ON taxpayer.Taxpayer_ID = landparcel.Taxpayer_ID
WHERE Sqft > 5500 AND landparcel.Taxpayer_Id = 5;
-- --------------------------------------------------------
-- Jeep

--  Query 2 
--  Purpose:  To find any single family property with its condition and group by the price.
--  Expected: List all the single family properties with its price from lowest to highest, each listed with quality.

SELECT taxinfo.Assessed_Land_Val, Building.quality, Building.property_type
FROM taxinfo 
JOIN landparcel 
ON landparcel.Parcel_ID = taxinfo.Parcel_ID 
JOIN building 
ON building.Parcel_ID = landparcel.Parcel_ID 
WHERE building.property_type IN 
	(
	SELECT property_type 
	FROM building 
	WHERE building.Property_Type LIKE 'single%'
	)     
ORDER BY taxinfo.Assessed_Land_Val ASC;

-- --------------------------------------------------------
-- Chloe

--  Query 3
--  Purpose: Get all parcels and their related tax information.
--  Expected: List of parcel IDs, parcel’s address and tax data, plus derived attribute.

SELECT LP.Parcel_ID, LP.Street, LP.City, LP.Zip, TI.Assessed_Land_Val, 
	TI.Assessed_Improvements_Val,  (TI.Assessed_Land_Val + TI.Assessed_Improvements_Val), 
	TI.Tax_Yr, TI.Pct_Tax_Change
FROM landparcel LP JOIN taxinfo TI ON LP.Parcel_ID = TI.Parcel_ID
ORDER BY LP.Parcel_ID;

-- --------------------------------------------------------
-- Daniil

-- Query 4
-- Purpose: Returning the parcels associated with a particular county
-- Expected: List of all parcels per county, NULL if none available

SELECT landparcel.Parcel_ID, county.County 
FROM landparcel LEFT JOIN county ON landparcel.County = county.County 
UNION
SELECT landparcel.Parcel_ID, county.County 
FROM landparcel RIGHT JOIN county ON landparcel.County = county.County 
GROUP BY County;


-- --------------------------------------------------------
-- Edwin

-- Query 5
-- Purpose: Find properties with buildings of over 8000 sq ft OR of good quality.
-- Expected: Taxpayer ID, first name, and last name of the owners of properties which match the above criteria.

SELECT T.Taxpayer_ID, FName, LName
FROM taxpayer T, landparcel L
WHERE L.Taxpayer_ID = T.Taxpayer_ID AND L.Parcel_ID IN 
    (
    SELECT Parcel_ID
    FROM building
    WHERE Sqft > 8000
    UNION
    SELECT Parcel_ID
    FROM building
    WHERE Quality = 'good'
    );

-- --------------------------------------------------------
-- Daniil

-- Query 6
-- Purpose:Ordering the parcels by values in the cities with high amount of college graduates, where amount of older people is below average in the city and the price of the parcel is currently below average, as a place of potentially good investment opportunity for a property, due to the possibility of gentrification with future young professionals, that could raise the price of the house and be a good investment opportunity of interest for the users of our real estate evaluator

-- Expected: underpriced parcels in the cities with the highest number of college graduates, where the amount of older people in the city is below average.

SELECT B.Building_Num BID,B.Num_Bed BN,B.Num_Bath BB,B.Sqft BSQ,B.Quality BQ, P.Parcel_ID PID, P.City PC, CT.County PCC, TX.Assessed_Land_Val TXA
                    FROM county CT, taxinfo TX, landparcel P, building B
                    WHERE P.County = CT.County AND P.Parcel_ID = TX.Parcel_ID AND P.Parcel_ID = B.Parcel_ID
                    AND CT.Pct_Age_Over_65 >
                    (SELECT AVG(Pct_Age_Over_65)
                    FROM county)
                    AND CT.Pct_Collg_Grad >
                    (SELECT AVG(Pct_Collg_Grad)
                    FROM county)                    
                    AND TX.Assessed_Land_Val <
                    (SELECT AVG(Assessed_Land_Val)
                    FROM taxinfo)
                    ORDER BY TX.Assessed_Land_Val DESC;

-- --------------------------------------------------------
-- Daniil

-- Query 7
-- Purpose: Computing N (with current N = 2) parcels located in counties more fitted for the safety-oriented home buyers, rather than traditional investors,  which may be a large portion of the potential users of a platform and are important to effectively cater to, and as safety may be rated among highest priorities by potential home buyers we return the top N safest countries calculated by a general population trends. The counties must have a percent of highschool graduates being above average percent and unemployed being in 10th lowest percentile of given counties, because of the high amount of crime in areas with a highly excessive amount of homeless youth and high unemployment statistics. The results would be ordered by increasing price, due to the value of more affordable houses for first time house buyers.

-- Expected: N (with current N = 2) parcels located in counties with a percent of highschool graduates being above average and in counties with low unemployment, unemployed being in 10th percentile of given counties, because of high amount of crime in areas with a highly excessive amount of homeless youth and high unemployment statistics.


SELECT B.Building_Num BID,B.Num_Bed BN,B.Num_Bath BB,B.Sqft BSQ,B.Quality BQ, P.Parcel_ID PID, P.City PC, CT.County PCC, TX.Assessed_Land_Val TXA
                            FROM county CT, taxinfo TX, landparcel P, building B
                            WHERE P.County = CT.County AND P.Parcel_ID = TX.Parcel_ID AND B.Parcel_ID = P.Parcel_ID
                            AND CT.Pct_HS_Grad > 
                            (SELECT AVG(Pct_Age_Under_18)
                             FROM county)
                            AND CT.Pct_Unemployed <= 0.1 *
                            (SELECT AVG(Pct_Unemployed)
                             FROM county)
LIMIT 2;

-- --------------------------------------------------------
-- Jeep


-- Query 8
-- Purpose: List 8 largest buildings and their property types, sorted by the number of sqft in descending order.
--  Expected: All 8 largest parcels, property types and sqft ready.

SELECT L.Parcel_id as 'Parcel id', 
	B.Property_Type, b.Sqft	
FROM landparcel L JOIN building B ON L.parcel_id = B.parcel_id
ORDER BY b.Sqft DESC
limit 8;


-- --------------------------------------------------------
-- Chloe

-- Query 9
-- Purpose: Find the top 5 parcels and their total values, sorting by which cities have the lowest unemployment rate.
-- Expected: The parcel ID, its total value, the city it's in, and it's associated unemployment value.

SELECT L.Parcel_ID AS 'Parcel ID', 
	(T.Assessed_Improvements_Val + T.Assessed_Land_Val) AS 'Total Value', 
	C.City, C.Pct_Unemployed AS 'City Unemployed %'
FROM landparcel L JOIN city C ON L.City = C.City, 
	taxinfo T
WHERE L.Parcel_ID = T.Parcel_ID
ORDER BY C.Pct_Unemployed ASC
LIMIT 5;

-- --------------------------------------------------------
-- Edwin

-- Query 10
-- Purpose: Finds properties with higher than average amount of acres but less than average amount of improvements for potential investment.
-- Expected: The address, city, and zip of each potential investment property.

SELECT P.Street, P.City, P.Zip
FROM landparcel P, taxinfo T
WHERE P.Parcel_ID = T.Parcel_ID
	AND P.Acres >= 
		(
		SELECT AVG(Acres)
		FROM landparcel
		)
	AND T.Assessed_Improvements_Val <= 
		(
		SELECT AVG(Assessed_Improvements_Val)
		FROM taxinfo
		);

-- --------------------------------------------------------

COMMIT;