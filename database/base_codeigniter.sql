-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 13 Jun 2020 pada 12.57
-- Versi server: 10.4.10-MariaDB
-- Versi PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `base_codeigniter`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_name` varchar(20) NOT NULL,
  `account_username` varchar(12) NOT NULL,
  `account_password` varchar(250) NOT NULL,
  `account_lastpassword` varchar(250) NOT NULL,
  `account_isactive` enum('true','false') NOT NULL,
  `account_createat` timestamp NULL DEFAULT NULL,
  `account_modifyat` timestamp NULL DEFAULT NULL,
  `account_level` enum('root','admin','user','') NOT NULL,
  `account_image` varchar(250) NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `account`
--

INSERT INTO `account` (`account_id`, `account_name`, `account_username`, `account_password`, `account_lastpassword`, `account_isactive`, `account_createat`, `account_modifyat`, `account_level`, `account_image`) VALUES
(1, 'Super User', 'root', '$2y$08$kRQEMVMk9B1jp25Q9HUCs.k3wpO95IVOiHXsezjPMJYy3O0QCkm/i', '$2y$08$plSNCSRiwH.ZjLvPWexqQ.ZsGo896W7kox7v/eFzN8pUo.mfkfaMu', 'true', '2020-05-15 08:00:00', '2020-05-15 08:00:00', 'root', 'default.png'),
(2, 'Admin', 'admin', '$2y$08$qkWbNrRZhQTpF1mq0wpmEOtKKVdb/ElU6B.kLneoHoJqMxIrn1.1O', '$2y$08$imtrmNQYKRmee67/9k5quehniKdNB9DRvtDESVixxcnkGsBj7XS2y', 'true', '2020-05-15 08:00:00', '2020-05-15 08:00:00', 'admin', 'default.png'),
(3, 'User', 'user', '$2y$08$HVoMt5jaJNtqbuTyz0R63.3JBSmyypnpGJFoQmj2a5j/zulUwqNeK', '$2y$08$mepQyFyHK.W9AaUqxnnareyvF7SlHCozU5Q09VploXDPDkBWWIszC', 'false', '2020-05-15 08:00:00', '2020-05-15 08:00:00', 'user', 'default.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `commodity`
--

DROP TABLE IF EXISTS `commodity`;
CREATE TABLE IF NOT EXISTS `commodity` (
  `commodity_id` int(11) NOT NULL AUTO_INCREMENT,
  `commodity_name` varchar(50) NOT NULL,
  `commodity_type` varchar(50) NOT NULL,
  `commodity_price` bigint(20) NOT NULL,
  PRIMARY KEY (`commodity_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `commodity`
--

INSERT INTO `commodity` (`commodity_id`, `commodity_name`, `commodity_type`, `commodity_price`) VALUES
(1, 'Major Pharmaceuticals', 'Agricultural', 976029),
(2, 'Automotive Aftermarket', 'Metals', 1779194),
(3, 'Major Banks', 'Energy', 7527323),
(4, 'Building operators', 'Metals', 2942597),
(5, 'Oil & Gas Production', 'Agricultural', 7032724),
(6, 'Aerospace', 'Agricultural', 4268245),
(7, 'Power Generation', 'Agricultural', 3883281),
(8, 'Trucking Freight/Courier Services', 'Metals', 6656801),
(9, 'Real Estate Investment Trusts', 'Agricultural', 3055439),
(10, 'Major Pharmaceuticals', 'Agricultural', 4004279),
(11, 'n/a', 'Agricultural', 1192862),
(12, 'Major Banks', 'Agricultural', 1847284),
(13, 'Natural Gas Distribution', 'Metals', 5076171),
(14, 'Natural Gas Distribution', 'Agricultural', 360726),
(15, 'Telecommunications Equipment', 'Metals', 9560611),
(16, 'Fluid Controls', 'Energy', 4015332),
(17, 'n/a', 'Agricultural', 5849366),
(18, 'n/a', 'Agricultural', 5326895),
(19, 'Major Pharmaceuticals', 'Metals', 8494094),
(20, 'Farming/Seeds/Milling', 'Agricultural', 4601766),
(21, 'Semiconductors', 'Agricultural', 6059008),
(22, 'Electronic Components', 'Energy', 3765790),
(23, 'Industrial Machinery/Components', 'Metals', 9527735),
(24, 'Services-Misc. Amusement & Recreation', 'Agricultural', 6987822),
(25, 'Commercial Banks', 'Agricultural', 735019),
(26, 'Marine Transportation', 'Agricultural', 2037950),
(27, 'Business Services', 'Agricultural', 3965177),
(28, 'n/a', 'Metals', 8631863),
(29, 'Metal Fabrications', 'Energy', 3920327),
(30, 'Oil & Gas Production', 'Energy', 1125947);

-- --------------------------------------------------------

--
-- Struktur dari tabel `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_number` varchar(50) DEFAULT NULL,
  `student_name` varchar(50) DEFAULT NULL,
  `student_gender` varchar(50) DEFAULT NULL,
  `student_bornin` date DEFAULT NULL,
  `student_address` varchar(50) DEFAULT NULL,
  `student_majors` varchar(20) DEFAULT NULL,
  `student_email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `student`
--

INSERT INTO `student` (`student_id`, `student_number`, `student_name`, `student_gender`, `student_bornin`, `student_address`, `student_majors`, `student_email`) VALUES
(1, '14-2636789', 'Christy Skoggings', 'Female', '2020-05-01', '6309 Upham Trail', 'Economics', 'cskoggings0@blog.com'),
(2, '10-0239108', 'Linda Copplestone', 'Female', '2019-12-24', '8 Gale Circle', 'Chemistry', 'lcopplestone1@edublogs.org'),
(3, '08-2425467', 'Nichols Wodham', 'Male', '2019-12-16', '175 Manley Circle', 'Accounting', 'nwodham2@list-manage.com'),
(4, '74-5869195', 'Tallie Seavers', 'Female', '2019-08-30', '318 Rigney Trail', 'Software Engineering', 'tseavers3@cdbaby.com'),
(5, '08-6868179', 'Ethelbert Giannasi', 'Male', '2019-12-27', '87155 Harper Circle', 'Chemistry', 'egiannasi4@youku.com'),
(6, '21-4760780', 'Tedmund Giovannacci', 'Male', '2019-07-25', '902 Grasskamp Court', 'Biological Science', 'tgiovannacci5@fotki.com'),
(7, '19-5819868', 'Almeria Fawcett', 'Female', '2020-05-31', '11098 Straubel Parkway', 'Computer Science', 'afawcett6@mozilla.org'),
(8, '56-6338322', 'Maddie Malinowski', 'Male', '2019-10-11', '5227 Monterey Plaza', 'Chemistry', 'mmalinowski7@businessweek.com'),
(9, '53-0404641', 'Dare Breckin', 'Male', '2020-03-04', '1154 Petterle Court', 'Computer Science', 'dbreckin8@fema.gov'),
(10, '19-4366018', 'Nola Kadd', 'Female', '2020-02-10', '8 Chinook Way', 'Economics', 'nkadd9@bloomberg.com'),
(11, '80-4026846', 'Boigie Khomin', 'Male', '2019-10-04', '79 Loomis Terrace', 'English', 'bkhomina@buzzfeed.com'),
(12, '91-3342864', 'Germayne Doxsey', 'Male', '2019-06-28', '6 Oriole Junction', 'Biological Science', 'gdoxseyb@disqus.com'),
(13, '90-9535375', 'Sunny Primarolo', 'Female', '2019-07-26', '4534 Washington Terrace', 'Computer Science', 'sprimaroloc@intel.com'),
(14, '44-0356847', 'Eberhard Cake', 'Male', '2020-02-18', '12518 Mccormick Terrace', 'English', 'ecaked@java.com'),
(15, '30-5095903', 'Kip Probin', 'Male', '2020-02-10', '17478 Weeping Birch Hill', 'Economics', 'kprobine@vistaprint.com'),
(16, '22-7838723', 'Agathe Oager', 'Female', '2019-10-27', '7988 Duke Plaza', 'Food Science', 'aoagerf@irs.gov'),
(17, '40-4487664', 'Gipsy Dunsmore', 'Female', '2019-07-28', '317 Sundown Point', 'Food Science', 'gdunsmoreg@zimbio.com'),
(18, '99-3675210', 'Blaine Skellington', 'Male', '2019-07-11', '96141 Tomscot Way', 'Chemistry', 'bskellingtonh@wordpress.com'),
(19, '13-6429163', 'Wally McTaggart', 'Male', '2019-06-20', '91 Lukken Trail', 'Neuroscience', 'wmctaggarti@tamu.edu'),
(20, '84-2477256', 'Gardie Gerson', 'Male', '2019-10-18', '2545 Monica Court', 'Geography', 'ggersonj@redcross.org'),
(21, '16-4481177', 'Camile Lemoir', 'Female', '2020-01-17', '94 Knutson Center', 'Studio Art', 'clemoirk@fda.gov'),
(22, '36-2939095', 'Lillis Slowey', 'Female', '2019-10-31', '0 Northfield Terrace', 'English', 'lsloweyl@harvard.edu'),
(23, '10-6259826', 'Hilary O\'Kennavain', 'Female', '2020-06-05', '62969 Calypso Alley', 'Chemistry', 'hokennavainm@psu.edu'),
(24, '50-5702010', 'Jefferson Bartolomeoni', 'Male', '2020-01-27', '0 Heath Point', 'Chemistry', 'jbartolomeonin@wp.com'),
(25, '12-1863247', 'Glendon Muddle', 'Male', '2019-11-30', '183 Becker Parkway', 'Economics', 'gmuddleo@privacy.gov.au'),
(26, '59-5776058', 'Jacob Corkill', 'Male', '2019-09-18', '744 Saint Paul Center', 'Geography', 'jcorkillp@printfriendly.com'),
(27, '30-5280460', 'Howie Thecham', 'Male', '2019-06-24', '23402 Oxford Court', 'Biological Science', 'hthechamq@a8.net'),
(28, '19-7240077', 'Niel Flieger', 'Male', '2019-06-11', '24120 Esch Drive', 'Computer Science', 'nfliegerr@oakley.com'),
(29, '11-1058234', 'Willard Crole', 'Male', '2020-03-27', '3437 Quincy Place', 'Food Science', 'wcroles@va.gov'),
(30, '09-3123953', 'Godwin L\' Estrange', 'Male', '2019-06-15', '3138 Hanover Circle', 'English', 'glt@hexun.com'),
(31, '93-7040753', 'Roma Boddymead', 'Male', '2020-02-14', '01 Carpenter Avenue', 'English', 'rboddymeadu@army.mil'),
(32, '47-8383434', 'Nathaniel Allbones', 'Male', '2020-03-15', '2482 Reinke Park', 'Geography', 'nallbonesv@home.pl'),
(33, '45-4696880', 'Bernhard Power', 'Male', '2019-07-30', '8 Menomonie Street', 'Food Science', 'bpowerw@mayoclinic.com'),
(34, '42-6957023', 'Erik Naden', 'Male', '2020-03-13', '6130 Algoma Pass', 'Accounting', 'enadenx@youtu.be'),
(35, '24-6569007', 'Hortensia Blooman', 'Female', '2019-06-30', '1 Rieder Place', 'Economics', 'hbloomany@cargocollective.com'),
(36, '53-5848463', 'Truda Camoys', 'Female', '2019-06-17', '099 Dawn Parkway', 'English', 'tcamoysz@usda.gov'),
(37, '37-8830708', 'Taddeusz Bankhurst', 'Male', '2019-12-25', '216 Brown Court', 'Software Engineering', 'tbankhurst10@zimbio.com'),
(38, '89-1366850', 'Shepard Bakhrushin', 'Male', '2019-12-12', '838 Maple Wood Way', 'Biological Science', 'sbakhrushin11@seattletimes.com'),
(39, '66-1548483', 'Noach Albinson', 'Male', '2019-12-27', '76577 Brentwood Center', 'Studio Art', 'nalbinson12@nymag.com'),
(40, '47-9172922', 'Jacki Rabbet', 'Female', '2019-10-11', '61 Darwin Plaza', 'Biological Science', 'jrabbet13@seesaa.net'),
(41, '39-7206696', 'Stanfield Linskey', 'Male', '2019-12-05', '1981 Union Place', 'Geography', 'slinskey14@irs.gov'),
(42, '60-3088357', 'Filberto Farley', 'Male', '2019-08-27', '25 Iowa Crossing', 'Economics', 'ffarley15@sciencedaily.com'),
(43, '46-3343292', 'Justin Stonard', 'Male', '2019-06-10', '5 Fieldstone Street', 'Biological Science', 'jstonard16@economist.com'),
(44, '12-8880649', 'Anton Smaling', 'Male', '2020-04-02', '05464 Myrtle Trail', 'Studio Art', 'asmaling17@webs.com'),
(45, '27-6548547', 'Fifi Molyneux', 'Female', '2020-03-15', '178 Westport Way', 'Biological Science', 'fmolyneux18@hp.com'),
(46, '17-0522724', 'Antonino Caplan', 'Male', '2019-07-26', '17 Mcguire Parkway', 'Food Science', 'acaplan19@reference.com'),
(47, '78-2402863', 'Eli Nevin', 'Male', '2020-04-07', '75806 Milwaukee Road', 'Geography', 'enevin1a@unblog.fr'),
(48, '50-2160069', 'Ignatius Hedditch', 'Male', '2019-11-07', '7 Sugar Court', 'Accounting', 'ihedditch1b@themeforest.net'),
(49, '70-2720892', 'Joelle McGinley', 'Female', '2019-11-11', '61 Redwing Road', 'English', 'jmcginley1c@telegraph.co.uk'),
(50, '19-3874301', 'Hal Yurukhin', 'Male', '2019-07-16', '14236 Northview Parkway', 'Biological Science', 'hyurukhin1d@seesaa.net'),
(51, '23-1554511', 'Matthus Gitsham', 'Male', '2020-04-19', '2273 Stuart Road', 'Studio Art', 'mgitsham1e@blogtalkradio.com'),
(52, '24-9169951', 'Birch D\'Onise', 'Male', '2020-01-31', '79329 Fallview Circle', 'Management', 'bdonise1f@businessinsider.com'),
(53, '29-2901126', 'Teodoro Monks', 'Male', '2019-12-14', '0486 Gerald Junction', 'Neuroscience', 'tmonks1g@angelfire.com'),
(54, '72-0601603', 'Ambrosio Drowsfield', 'Male', '2019-07-25', '63 Holmberg Way', 'Economics', 'adrowsfield1h@harvard.edu'),
(55, '72-9411438', 'Waverley Aaronsohn', 'Male', '2019-09-10', '4 Swallow Trail', 'Chemistry', 'waaronsohn1i@barnesandnoble.com'),
(56, '82-6698951', 'Camel Arter', 'Female', '2020-05-19', '35085 Rieder Parkway', 'Economics', 'carter1j@youtube.com'),
(57, '05-8544767', 'Helaine Asple', 'Female', '2019-12-21', '70116 Arrowood Center', 'English', 'hasple1k@gov.uk'),
(58, '30-3309736', 'Arabelle Cammis', 'Female', '2019-11-10', '9 Ridgeway Alley', 'English', 'acammis1l@wiley.com'),
(59, '42-8482814', 'Obadiah Inder', 'Male', '2019-07-24', '3 Coleman Parkway', 'Management', 'oinder1m@digg.com'),
(60, '06-6945232', 'Mart Stolz', 'Male', '2019-12-11', '4 Oneill Avenue', 'Computer Science', 'mstolz1n@wix.com'),
(61, '48-4029123', 'Trever Di Ruggero', 'Male', '2020-01-14', '3 Carey Street', 'Management', 'tdi1o@si.edu'),
(62, '33-6620077', 'Fredi Whightman', 'Female', '2019-09-04', '4586 Granby Point', 'English', 'fwhightman1p@hibu.com'),
(63, '36-2040421', 'Heddi Paver', 'Female', '2019-12-12', '27302 Summit Point', 'Economics', 'hpaver1q@oaic.gov.au'),
(64, '84-0838982', 'Ezequiel Hatz', 'Male', '2019-10-09', '2 Schiller Parkway', 'Chemistry', 'ehatz1r@abc.net.au'),
(65, '98-2399745', 'Alex Pinock', 'Female', '2020-05-31', '9 Petterle Court', 'Chemistry', 'apinock1s@goodreads.com'),
(66, '22-0946214', 'Bonny Newbegin', 'Female', '2020-05-27', '42578 Nancy Place', 'Economics', 'bnewbegin1t@bluehost.com'),
(67, '51-7927744', 'Priscilla Durtnel', 'Female', '2020-06-03', '2618 Vera Street', 'Accounting', 'pdurtnel1u@prnewswire.com'),
(68, '00-7674261', 'Victoir Brugsma', 'Male', '2019-12-09', '88852 Warbler Hill', 'Accounting', 'vbrugsma1v@microsoft.com'),
(69, '46-3703500', 'Naoma Sybry', 'Female', '2020-03-20', '597 Dwight Point', 'Biological Science', 'nsybry1w@ezinearticles.com'),
(70, '10-1696814', 'Krystle Sisnett', 'Female', '2020-05-18', '38094 Northport Park', 'Management', 'ksisnett1x@google.com.hk'),
(71, '66-5528850', 'Rodi Purchon', 'Female', '2020-05-08', '7 Menomonie Center', 'History', 'rpurchon1y@cmu.edu'),
(72, '37-1900395', 'Jody Bouchard', 'Female', '2019-09-04', '98 Westerfield Alley', 'Biological Science', 'jbouchard1z@ebay.com'),
(73, '60-0003704', 'Briana Haggish', 'Female', '2019-07-09', '95770 Ludington Plaza', 'History', 'bhaggish20@geocities.jp'),
(74, '91-8529989', 'Ron Gaine', 'Male', '2020-04-12', '3 Lakewood Gardens Plaza', 'Chemistry', 'rgaine21@mayoclinic.com'),
(75, '05-3625176', 'Auroora Rickerby', 'Female', '2019-10-24', '4 Loftsgordon Way', 'Studio Art', 'arickerby22@homestead.com'),
(76, '41-4244284', 'Cletis Levane', 'Male', '2020-04-06', '012 Toban Junction', 'English', 'clevane23@reuters.com'),
(77, '82-1497476', 'Lilli Rozzier', 'Female', '2019-10-24', '10 Macpherson Street', 'Chemistry', 'lrozzier24@liveinternet.ru'),
(78, '26-7793373', 'Rickert Kann', 'Male', '2020-04-03', '4 Golden Leaf Parkway', 'Biological Science', 'rkann25@cocolog-nifty.com'),
(79, '40-7554480', 'Shayla Moon', 'Female', '2020-03-16', '63 Summerview Parkway', 'Geography', 'smoon26@statcounter.com'),
(80, '79-9638028', 'Vincenty Loding', 'Male', '2019-06-23', '47968 Warbler Trail', 'Neuroscience', 'vloding27@earthlink.net'),
(81, '48-8990062', 'Farley Craisford', 'Male', '2019-10-14', '20 Coleman Trail', 'Neuroscience', 'fcraisford28@devhub.com'),
(82, '43-6510513', 'Peadar Hugonneau', 'Male', '2019-11-10', '95 Vidon Road', 'English', 'phugonneau29@edublogs.org'),
(83, '87-2242129', 'George Chevis', 'Female', '2019-10-09', '11673 Basil Crossing', 'History', 'gchevis2a@yandex.ru'),
(84, '40-2540123', 'Ruggiero Toffaloni', 'Male', '2020-01-13', '6008 Buhler Center', 'Studio Art', 'rtoffaloni2b@dailymotion.com'),
(85, '65-5786525', 'Caddric Chartman', 'Male', '2019-07-13', '42179 High Crossing Parkway', 'Chemistry', 'cchartman2c@ftc.gov'),
(86, '96-1086678', 'Joete Draper', 'Female', '2019-12-05', '0 Redwing Point', 'History', 'jdraper2d@pen.io'),
(87, '11-7100916', 'Worthington Grumell', 'Male', '2020-03-15', '79 Nova Place', 'Chemistry', 'wgrumell2e@slideshare.net'),
(88, '22-1712645', 'Delia Jordin', 'Female', '2019-12-12', '41392 Hooker Center', 'Software Engineering', 'djordin2f@disqus.com'),
(89, '52-4799307', 'Jacquette Duddy', 'Female', '2019-11-10', '5 Cody Drive', 'History', 'jduddy2g@cbslocal.com'),
(90, '70-9568307', 'Jenni Penna', 'Female', '2020-05-21', '34 Barnett Center', 'Studio Art', 'jpenna2h@sun.com'),
(91, '83-4123696', 'Fowler McPike', 'Male', '2019-09-12', '99 Stephen Street', 'Geography', 'fmcpike2i@cmu.edu'),
(92, '22-7950472', 'Puff Emmanueli', 'Male', '2020-05-02', '07308 Barnett Plaza', 'Software Engineering', 'pemmanueli2j@bandcamp.com'),
(93, '41-7735995', 'Lion Blaxter', 'Male', '2020-05-22', '07 Carioca Place', 'English', 'lblaxter2k@t-online.de'),
(94, '22-9529250', 'Hieronymus Mathissen', 'Male', '2019-08-15', '37053 Farmco Junction', 'Management', 'hmathissen2l@home.pl'),
(95, '68-1756611', 'Ulric Cockle', 'Male', '2019-07-03', '9 Esker Pass', 'English', 'ucockle2m@ebay.com'),
(96, '53-4687051', 'Annabelle Latham', 'Female', '2019-11-20', '62 3rd Parkway', 'Accounting', 'alatham2n@skype.com'),
(97, '21-8555204', 'Kingsly Lantry', 'Male', '2019-08-11', '1 Longview Alley', 'Accounting', 'klantry2o@alexa.com'),
(98, '90-4035774', 'Sherm Farnhill', 'Male', '2020-01-03', '209 Amoth Park', 'Economics', 'sfarnhill2p@newsvine.com'),
(99, '19-6160044', 'Marmaduke Peasby', 'Male', '2020-01-27', '4536 Scoville Circle', 'Computer Science', 'mpeasby2q@indiatimes.com'),
(100, '76-1123606', 'Melisande Drew', 'Female', '2020-02-28', '0 Hagan Drive', 'Computer Science', 'mdrew2r@apache.org');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
