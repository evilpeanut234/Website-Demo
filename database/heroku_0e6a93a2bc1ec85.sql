/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `categories` (
  `id_Cat` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_Cat`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_comment`,`id_product`,`id_user`,`time`),
  KEY `FK_Comments_Users` (`id_user`) USING BTREE,
  KEY `FK_Comment_Products` (`id_product`),
  CONSTRAINT `FK_Comments_Users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_Comment_Products` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `image` (
  `id_image` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `image` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_image`,`id_product`),
  KEY `FK_Image_Product` (`id_product`),
  CONSTRAINT `FK_Image_Product` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2421 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_Cat` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `liked` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default.jpg',
  PRIMARY KEY (`id_product`),
  KEY `id_Cat` (`id_Cat`),
  CONSTRAINT `FK_Product_Categories` FOREIGN KEY (`id_Cat`) REFERENCES `categories` (`id_Cat`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=691 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `purchasedetail` (
  `id_purchase` int(11) NOT NULL,
  `id_detail` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_purchase`,`id_detail`,`id_product`),
  KEY `FK_Details_Products` (`id_product`),
  CONSTRAINT `FK_Details_Products` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE,
  CONSTRAINT `FK_Details_Purchase` FOREIGN KEY (`id_purchase`) REFERENCES `purchases` (`id_purchase`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `purchases` (
  `id_purchase` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `status` int(11) NOT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `thanhtoan` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_purchase`),
  KEY `id_user` (`id_user`),
  KEY `status` (`status`),
  CONSTRAINT `FK_Purchases_Status` FOREIGN KEY (`status`) REFERENCES `status` (`id_stt`) ON DELETE CASCADE,
  CONSTRAINT `FK_Purchases_Users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `status` (
  `id_stt` int(11) NOT NULL AUTO_INCREMENT,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_stt`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `userlikeproduct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `role` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`,`username`,`email`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `categories` (`id_Cat`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Điện thoại', '2021-01-08 04:43:16', '2020-12-21 14:56:17');
INSERT INTO `categories` (`id_Cat`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Máy tính bảng', '2021-01-08 04:43:16', '2020-12-21 14:56:47');
INSERT INTO `categories` (`id_Cat`, `name`, `created_at`, `updated_at`) VALUES
(3, 'Laptop', '2021-01-08 04:43:16', '2020-12-21 14:56:47');
INSERT INTO `categories` (`id_Cat`, `name`, `created_at`, `updated_at`) VALUES
(6, 'Tivi', '2021-01-08 04:43:16', '2020-12-22 07:13:28'),
(7, 'Loa, Karaoke', '2021-01-08 04:43:16', '2020-12-22 07:13:28');

INSERT INTO `comments` (`id_comment`, `id_product`, `id_user`, `time`, `content`) VALUES
(11, 1, 13, '2021-01-10 14:34:37', '123');
INSERT INTO `comments` (`id_comment`, `id_product`, `id_user`, `time`, `content`) VALUES
(21, 1, 13, '2021-01-10 14:34:43', 'test');
INSERT INTO `comments` (`id_comment`, `id_product`, `id_user`, `time`, `content`) VALUES
(31, 1, 13, '2021-01-10 14:34:51', 'test4');
INSERT INTO `comments` (`id_comment`, `id_product`, `id_user`, `time`, `content`) VALUES
(41, 1, 13, '2021-01-10 14:34:57', 'test'),
(51, 1, 13, '2021-01-10 14:35:17', 'test'),
(61, 1, 13, '2021-01-10 14:35:22', 'test'),
(71, 1, 91, '2021-01-10 14:45:58', 'test'),
(81, 1, 91, '2021-01-10 14:46:12', 'test bình luận'),
(101, 1, 13, '2021-01-11 11:27:24', 'test bình luận');

INSERT INTO `image` (`id_image`, `id_product`, `image`) VALUES
(1, 1, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260704/ugpyy4pcwb81wrqvdvcg.jpg');
INSERT INTO `image` (`id_image`, `id_product`, `image`) VALUES
(11, 1, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260705/trmuubtxxea0mii9o2od.jpg');
INSERT INTO `image` (`id_image`, `id_product`, `image`) VALUES
(21, 1, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260705/jdtongtjzrwrm9lwkvpd.jpg');
INSERT INTO `image` (`id_image`, `id_product`, `image`) VALUES
(31, 11, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260747/kgo6alsed1wd0zruudhv.jpg'),
(41, 11, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260747/epbgrsv3zrcl450cixmc.jpg'),
(51, 11, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260747/qo5qhzrdg5fhalfbp0uo.jpg'),
(61, 11, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260748/huxeucyi70frqhho69sh.jpg'),
(111, 31, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260794/tjsorpc2sjkektwclnmm.jpg'),
(121, 31, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260795/hmhcon6mn99iawgmd7uz.jpg'),
(131, 31, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260795/zf6ozpjycfrjjliw2har.jpg'),
(141, 31, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260796/j8l72omikygvz3u72fht.jpg'),
(181, 51, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260873/iae3dqt8md06c8yxrpge.jpg'),
(191, 51, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260874/cye5dutpjzhzimiwifhe.jpg'),
(201, 51, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260874/oda4xijprqpjcede9pxd.jpg'),
(211, 51, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260875/zifglxic8castnvhnkjc.jpg'),
(221, 61, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260914/opj8a4tv6re37ynjlyix.jpg'),
(231, 61, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260914/qixh9di4zi5assynpwlr.jpg'),
(241, 61, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260915/hxnclyuobvgwr52twcb7.jpg'),
(251, 61, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260915/mwgbgnri6xjb8irgh79p.jpg'),
(261, 61, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260916/xonkpqaeflgngovfkapw.jpg'),
(381, 101, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261303/uevlxcs62olezbrnukmz.jpg'),
(391, 101, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261304/yjffwvu3bvxlyq2rs1pa.jpg'),
(401, 101, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261304/xldfpuvnjde9luzou3x6.jpg'),
(411, 101, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261304/wplo5k0hdninbfwhdutp.jpg'),
(421, 111, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261637/laftr4x63rufrjov74hg.jpg'),
(431, 111, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261637/qk7pk8h1g6oo1wul3ypw.jpg'),
(441, 111, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261637/ngvjkb2raltunlg2syqy.jpg'),
(451, 111, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261638/fihylhwpg2rhix3owplq.jpg'),
(461, 121, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261675/aasqakaigfx4urgmo7jg.jpg'),
(471, 121, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261675/aagnivgh9mcmghkqao60.jpg'),
(481, 121, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261676/lxzgxswcitzrrwvr0we3.jpg'),
(491, 121, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261676/rvuwmwe1rkurzqk6hugp.jpg'),
(501, 131, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261734/ycqfttlsttx28niqf8bl.jpg'),
(511, 131, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261734/utuf4otnuz7nzqc11e1b.jpg'),
(521, 131, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261735/ig8exqmedic1xuvcca3e.jpg'),
(531, 131, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261735/kyuz6o1l2xxqzcnfsp3e.jpg'),
(541, 141, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261791/nnijw1sw43smh7q6ikfc.jpg'),
(551, 141, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261792/brsaxzowpo83ylgotito.jpg'),
(561, 141, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261792/xtajk7llfgaiie3ybmkd.jpg'),
(571, 141, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261793/pzqyzzojssrwmf04xapn.jpg'),
(581, 151, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261835/aaqhpkck9vx5remz5iwk.jpg'),
(591, 151, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261836/gq1djcjiv34ov1bxvq5g.jpg'),
(601, 151, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261836/gcmetxl1rsmqwj3ilafq.jpg'),
(611, 151, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261837/zxltprnot27rxndk4b9m.jpg'),
(621, 161, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261869/oihffqczareeomvq5zfv.jpg'),
(631, 161, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261870/mggeb0mr3agdkvenvntq.jpg'),
(641, 161, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261870/r1scqkxlykja8y2rpyi9.jpg'),
(651, 161, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261870/kzljxebol5lsrrr1bqxw.jpg'),
(661, 161, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261871/unqqdpad5lpvtxt0muoh.jpg'),
(671, 171, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261907/irdsqbkc3tkdhdkbllcx.jpg'),
(681, 171, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261907/d8xas6yv6sdnhgnbrqrg.jpg'),
(691, 171, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261907/ahpednbvpsf30n0vfaop.jpg'),
(701, 171, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261908/zifnzi4rs0owuaghlcbn.jpg'),
(711, 181, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261946/t2gcngvzes8jhqhijkxa.jpg'),
(721, 181, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261946/ik167emjqcxakhb835fu.jpg'),
(731, 181, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261947/ogadsskf3opv39xgxgzw.jpg'),
(741, 181, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261947/wfzwadth03mtchmiz4ji.jpg'),
(751, 181, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261947/nwrvmerwzwacquvad3bv.jpg'),
(761, 191, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261999/xkjokfvuzkno4r1881u0.jpg'),
(771, 191, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261999/qjf3x6encdqajruymygq.jpg'),
(781, 191, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262000/otmcheevnsw6b3rqeli9.jpg'),
(791, 191, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262000/ofyeo8psdwiurxm0ju3o.jpg'),
(801, 201, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262073/lhtsyhb2gpkqzm5ay541.jpg'),
(811, 201, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262074/bncwiifw63hdhleovla0.jpg'),
(821, 201, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262074/iv36otlazyep4uablg4v.jpg'),
(831, 211, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262109/k1vfedrm6cfmwhczkmlw.jpg'),
(841, 211, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262110/de5etmr751mydsfgx0wd.jpg'),
(851, 211, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262110/i8ttf0nrpnlzqzgdhvha.jpg'),
(861, 211, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262110/yshgx2k2z0dwakjopyq5.jpg'),
(871, 221, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262147/lcd9dxixozlj0tcxwuwu.jpg'),
(881, 221, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262147/cgznpoydwvqk978pii77.jpg'),
(891, 221, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262148/olhgncunlxm4yszoaqez.jpg'),
(901, 221, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262148/nupiu7yxmrr5pgmwlq8n.jpg'),
(911, 231, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262184/sq0bbs4ntz7tfbijzn3u.jpg'),
(921, 231, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262184/zoy71l8syebclniyrsli.jpg'),
(931, 231, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262185/lir01yydtvmml1ifwtio.jpg'),
(941, 231, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262185/agcgmp6kjpk5i6x7i5u1.jpg'),
(951, 241, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262219/d87qnjjz4ct5ph40aroc.jpg'),
(961, 241, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262219/mu6s8ljqvvluprmwgaou.jpg'),
(971, 241, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262219/lhozlxnb7fzl1l8q03cn.jpg'),
(981, 241, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262220/ailx0flob7qzjoqdhpir.jpg'),
(991, 251, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262264/xk8derkispqomlftw8ad.jpg'),
(1001, 251, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262265/owcyfazyf0jfgoge1ozv.jpg'),
(1011, 251, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262265/jh7h1imqjiohteaufhfi.jpg'),
(1021, 251, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262266/ojjckymysiky0hngzhyd.jpg'),
(1031, 261, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262299/nnbal0wyvo2pa6w8htwq.jpg'),
(1041, 261, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262299/j86zzxizt0qrbfpm2fjy.jpg'),
(1051, 261, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262300/rrg8y7f08yzb3cmgjtgw.jpg'),
(1061, 261, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262301/csvmj62jbs62zrc2wbof.jpg'),
(1151, 291, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262547/ytalclk4fpjefwv2ayck.jpg'),
(1161, 291, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262547/umzlnmyq8ggukdyrcuib.jpg'),
(1171, 291, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262548/oczkeynej52ezbuigiyd.jpg'),
(1181, 301, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262648/lrjbugjeqmtzfwnahbgq.jpg'),
(1191, 301, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262649/fsnq2i2wk3c3byhxzokt.jpg'),
(1201, 301, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262649/p3ffa0ajncwmrsibo60q.jpg'),
(1211, 311, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262682/qvyuvp1tyvflc7mzvldr.jpg'),
(1221, 311, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262682/hy7xpewaokf241yo7dq6.jpg'),
(1231, 311, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262682/bw0htbacqcczkiew85vy.jpg'),
(1241, 321, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262750/zyv4cvmxdtxgjgjefyfy.jpg'),
(1251, 321, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262751/zripyh8ylbi44qksdvuj.jpg'),
(1261, 321, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262753/wgszazefzlq2ljcijrlt.jpg'),
(1271, 331, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262792/td4zz66wn6asmrsh6x6z.jpg'),
(1281, 331, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262793/izdunscwv48wnjabjupa.jpg'),
(1291, 331, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262795/npcdzbfmirlzulqhxw21.jpg'),
(1301, 341, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262835/p2qt1ty7puuncyempdot.jpg'),
(1311, 341, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262836/fqmdpqwva3hs6jm8qy6w.jpg'),
(1321, 341, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262836/wjcszlc8eyomldbcf6ie.jpg'),
(1331, 341, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262837/d5hf2c3xspmxyzgu6tld.jpg'),
(1341, 351, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262871/zuq2ht8w7lo09sjsmkaf.jpg'),
(1351, 351, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262875/nalkca7uilrimtrhbmnm.jpg'),
(1361, 351, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262876/pjdkomdpc7fh0olkzbrj.jpg'),
(1371, 351, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262876/is7iucbyjc1byaibyojz.jpg'),
(1471, 401, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610269638/io3pchwys5t8scpiiyzc.jpg'),
(1481, 401, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610269638/a2nuilebw4hk4hrnegby.jpg'),
(1491, 401, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610269639/ux1aueahdpthitvylfph.jpg'),
(1501, 401, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610269639/j0rcjtkykpxzx6jbbdwh.jpg'),
(1511, 411, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610269692/m0oeoilwx0rn894iyhvn.jpg'),
(1521, 411, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610269693/owjo7jfh778uojfcd8h9.jpg'),
(1531, 411, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610269693/w8wb0d8sskufxbrzdod2.jpg'),
(1541, 411, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610269694/pzvfxxxnwhlppfrswcnj.jpg'),
(1551, 421, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610269790/qsaeiu0djjixevrjpgco.jpg'),
(1561, 421, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610269790/mpq6tf5kqesynnxh0uwu.jpg'),
(1571, 421, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610269790/bgxxhruh8pfkp862cgnk.jpg'),
(1581, 421, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610269791/dhbnt6nhooiwill01y0l.jpg'),
(1591, 431, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270155/oe7ydsc8dgu2s1wtytuu.jpg'),
(1601, 431, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270156/hjiky0lw7cg51lan1jic.jpg'),
(1611, 431, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270156/jjz67idkpwqelajbv9ao.jpg'),
(1621, 431, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270156/qhp1co0q8rljcgws0hxl.jpg'),
(1631, 441, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270231/lruuwtbbprttwcv2wnaj.jpg'),
(1641, 441, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270231/m8rmdeqdlxmfhsi9h5ie.jpg'),
(1651, 441, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270231/xz1kld6klc17iww1lrbd.jpg'),
(1661, 451, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270303/ccawa9hetifs954mddww.jpg'),
(1671, 451, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270304/ghbscmmnqifimzwa3ayn.jpg'),
(1681, 451, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270304/s0up7p2vbpacmmkf1ib5.jpg'),
(1691, 461, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270356/b8n3yrhh4yaic4iv3czk.jpg'),
(1701, 461, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270356/gqruwfsna4cqykwfsb0y.jpg'),
(1711, 461, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270357/jvhewuoffrkleaq5pvlh.jpg'),
(1721, 471, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270412/lfj2t4riswtfoqczdsvv.jpg'),
(1731, 471, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270412/aypa1eaqidcjehsvlmxj.jpg'),
(1741, 471, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270413/p8mhtgh8f7mganp9cmqg.jpg'),
(1751, 481, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270513/g3jzcnmrlivnbhh5bbny.jpg'),
(1761, 481, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270513/z7ta9kkqwloshukinomp.jpg'),
(1771, 481, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270514/cysb6jhorncpezbijdgu.jpg'),
(1781, 491, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270599/u2ixlfoiimsctnixukfj.jpg'),
(1791, 491, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270599/vyprjmi3flhy8o1paygc.jpg'),
(1801, 491, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270600/ghmnw4dmxp7hukpuzyah.jpg'),
(1811, 501, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270659/dkjfqkyegzel5ydzpubu.jpg'),
(1821, 501, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270659/q6v5hi09w60e4ktnwiji.jpg'),
(1831, 501, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270660/wxv9qiniyvzp3o7k6h6y.jpg'),
(1841, 511, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270710/cmzd2y8kj3eqjubthp83.jpg'),
(1851, 511, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270710/ah7kh0varrs0w52hjjgg.jpg'),
(1861, 511, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270711/wjjdfqvsnxoqxpnzagpt.jpg'),
(1871, 521, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270796/kklpayojh1xrevdascay.jpg'),
(1881, 521, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270796/dc2zs7ekm7uo9kzfeojy.jpg'),
(1891, 521, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270796/qq8hixnvdnpe8iuopmhz.jpg'),
(1901, 531, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270855/lekv2oq14mtoxaruqsjo.jpg'),
(1911, 531, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270856/psqnmi1l0mbzbqoeikby.jpg'),
(1921, 531, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270856/rjyje7ypchwqvov3mag9.jpg'),
(1931, 541, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270908/kz2gz93o1nmy1feskvp5.jpg'),
(1941, 541, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270908/zkopejat79qf4nm7f6mt.jpg'),
(1951, 541, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270909/qbhriv9rqp6yhf2zmtma.jpg'),
(1961, 551, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270964/hicubcxifb2vy2d1h81e.jpg'),
(1971, 551, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270964/uitfccwfxieesjduqemu.jpg'),
(1981, 551, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270965/mv7s2ak2crs87741uuhv.jpg'),
(1991, 561, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610271046/rlwcp80nnalgrgep7srt.jpg'),
(2001, 561, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610271047/tmya9polky5upfypuudm.jpg'),
(2011, 561, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610271047/qgeohhutfbnavw7mf1jv.jpg'),
(2021, 571, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610271178/qtznsxacr3q6gr6lwory.jpg'),
(2031, 571, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610271178/tjzrt78uh3ickdsczfyp.jpg'),
(2041, 571, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610271178/vwhhj2qgkebdaf4uzvje.jpg'),
(2051, 581, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610271239/epueeulwr1ggrzote16h.jpg'),
(2061, 581, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610271239/e5un4ch0xd8b3mwhytfn.jpg'),
(2071, 581, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610271239/v3yttjuoaxgplis4aoy8.jpg'),
(2081, 591, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610271300/b9hlwjsjbq19gobtpxnt.jpg'),
(2091, 591, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610271301/p8y7wnfs5ds3hkwbuva1.jpg'),
(2101, 591, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610271301/henilq0ogivwcqafm0sw.jpg'),
(2361, 671, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610290319/rdoz8rumr8lew82bpcrz.jpg'),
(2371, 671, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610290319/uzpegsmwe73sahqubie4.jpg'),
(2381, 671, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610290320/vvqd6q42zq3wh4o3jhbj.jpg'),
(2391, 681, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610364547/ju6x8shloreb9sgq5bdc.jpg'),
(2401, 681, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610364547/vbenfetc6l2uabns04se.jpg'),
(2411, 681, 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610364547/ufp4ytab3dgukm2tdw0t.jpg');

INSERT INTO `products` (`id_product`, `name`, `id_Cat`, `quantity`, `description`, `price`, `liked`, `created_at`, `updated_at`, `avatar`) VALUES
(1, 'Điện thoại OPPO A92', 1, 10, 'OPPO A92 là điện thoại tầm trung đến từ OPPO, ấn tượng với cụm 4 camera độc đáo, thiết kế tràn viền và hiệu năng mạnh mẽ, đặc biệt phù hợp với những người dùng thích chơi game, chụp hình trên smartphone.\r\nThiết kế cao cấp, cảm biến vân tay tích hợp với nút nguồn\r\nOPPO A92 với màn hình NEO Display độc đáo với cụm camera selfie khoét lỗ nhỏ gọn, giúp tổng thể chiếc máy rất sang trọng như những chiếc điện thoại flagship hiện tại.', 5990000, 5, '2021-01-10 13:38:24', '2021-01-11 18:26:23', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260705/trmuubtxxea0mii9o2od.jpg');
INSERT INTO `products` (`id_product`, `name`, `id_Cat`, `quantity`, `description`, `price`, `liked`, `created_at`, `updated_at`, `avatar`) VALUES
(11, 'Điện thoại iPhone 12 64GB', 1, -1, 'Cùng chào đón iPhone 12 64 GB, chiếc điện thoại được ra mắt với nhiều sự nâng cấp. Từ thiết kế sang chảnh cho đến con chip Apple A14 Bionic mang năng lượng hoạt động mạnh mẽ bên trong đầy hứa hẹn.\r\nMang vẻ ngoài hoài niệm\r\niPhone 12 khoác lên chiếc áo với 5 màu sắc trang nhã, khung viền nhôm cao cấp và mặt trước được phủ lớp kính Ceramic Shield có độ bền gấp 4 lần các thế hệ iPhone tiền nhiệm.\r\nKết cấu nguyên khối bền chắc, trọng lượng chỉ nhẹ vô cùng vừa tay và không gây khó khăn ở phần cạnh vuông (giống iPhone 4) trong thiết kế mới của Apple.', 22990000, 2, '2021-01-10 13:39:07', '2021-01-10 22:50:43', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260747/epbgrsv3zrcl450cixmc.jpg');
INSERT INTO `products` (`id_product`, `name`, `id_Cat`, `quantity`, `description`, `price`, `liked`, `created_at`, `updated_at`, `avatar`) VALUES
(31, 'Điện thoại Xiaomi Redmi 9 (4GB/64GB)', 1, 13, 'Xiaomi tiếp tục ra mắt Redmi 9, phiên bản kế nhiệm Redmi 8 “lột xác” với diện mạo tươi mới trẻ trung, cấu hình mạnh hơn cùng một viên pin siêu “trâu”, mẫu smartphone này hứa hẹn sẽ là lựa chọn hấp dẫn phân khúc giá rẻ.\r\nNâng cấp gấp đôi với 4 camera sau\r\nNếu như “người anh” Redmi 8 chỉ trang bị cụm camera kép, thì đến Redmi 9 số lượng camera đã tăng lên gấp đôi, để bạn tha hồ chụp những kiểu ảnh ưa thích với 4 camera sau bao gồm: camera chính 13 MP, camera góc siêu rộng 8 MP, camera macro 5 MP và cảm biến đo độ sâu 2 MP.', 3490000, 1, '2021-01-10 13:39:54', '2021-01-10 13:39:54', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260794/tjsorpc2sjkektwclnmm.jpg');
INSERT INTO `products` (`id_product`, `name`, `id_Cat`, `quantity`, `description`, `price`, `liked`, `created_at`, `updated_at`, `avatar`) VALUES
(51, 'Điện thoại Realme C17', 1, 10, 'Sau sự thành công của Realme C15, thương hiệu Realme tiếp tục cho ra mắt Realme C17, với mức pin khủng và cải tiến hiệu năng mang lại khả năng gaming tuyệt vời.\r\nVẫn là những “bộ cánh” bắt mắt\r\nRealme C17 được thiết kế nguyên khối cùng mặt kính cường lực Corning Gorilla Glass 3 chống chịu tốt các tác động bên ngoài, đem lại cảm giác rắn chắc. Cạnh viền bo cong duyên dáng, thon gọn giúp người dùng cầm nắm thoải mái, thuận tiện hơn.', 4990000, 0, '2021-01-10 13:41:13', '2021-01-10 13:41:13', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260873/iae3dqt8md06c8yxrpge.jpg'),
(61, 'Điện thoại Samsung Galaxy Note 20 Ultra 5G Trắng', 1, 16, 'Samsung Galaxy Note 20 Ultra 5G Trắng là mẫu flagship cao cấp nhất trong series Note 20 của Samsung. Không chỉ đơn giản là có thêm kết nối 5G, siêu phẩm này còn trang bị phần cứng nhỉnh hơn về hiệu năng lẫn camera.\r\nThiết kế đơn giản tạo nên đẳng cấp\r\nSamsung Galaxy Note 20 Ultra 5G có thiết kế tương tự như Note 20 Ultra, máy được tạo nên từ phần khung nhôm và 2 mặt kính, có độ hoàn thiện cao, tỉ mỉ đến từng chi tiết nhỏ nhất.', 28990000, 2, '2021-01-10 13:41:54', '2021-01-10 13:41:54', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610260914/opj8a4tv6re37ynjlyix.jpg'),
(101, 'Laptop Acer Swift 3 SF315 52 38YQ i3 8130U/4GB/1TB/Win10 (NX.GZBSV.003)', 1, 3, 'Laptop Acer Swift SF315 52 38YQ i3 (NX.GZBSV.003) là một lựa chọn tốt cho những ai đang tìm kiếm một chiếc máy cho nhu cầu học tập văn phòng có cấu hình ổn, thiết kế gọn nhẹ, sang trọng mà lại có mức giá vừa phải.\r\nAcer Swift SF315 52 38YQ i3 với diện mạo được trau chuốt tỉ mỉ với vỏ kim loại nguyên khối vừa mang vẻ sang trọng, tinh tế mà lại rất chắc chắn.\r\nNgoài ra laptop có trọng lượng 1.7 kg và độ dày 16.9 mm giúp người dùng dễ dàng mang theo thiết bị này bên mình để sử dụng khi cần thiết.', 9440000, 1, '2021-01-10 13:48:23', '2021-01-10 13:48:23', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261303/uevlxcs62olezbrnukmz.jpg'),
(111, 'Laptop Acer Swift 3 SF315 52 38YQ i3 8130U/4GB/1TB/Win10 (NX.GZBSV.003)', 3, 17, 'Laptop Acer Swift SF315 52 38YQ i3 (NX.GZBSV.003) là một lựa chọn tốt cho những ai đang tìm kiếm một chiếc máy cho nhu cầu học tập văn phòng có cấu hình ổn, thiết kế gọn nhẹ, sang trọng mà lại có mức giá vừa phải.\r\nAcer Swift SF315 52 38YQ i3 với diện mạo được trau chuốt tỉ mỉ với vỏ kim loại nguyên khối vừa mang vẻ sang trọng, tinh tế mà lại rất chắc chắn.\r\nNgoài ra laptop có trọng lượng 1.7 kg và độ dày 16.9 mm giúp người dùng dễ dàng mang theo thiết bị này bên mình để sử dụng khi cần thiết.', 9440000, 0, '2021-01-10 13:53:56', '2021-01-10 13:53:56', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261637/laftr4x63rufrjov74hg.jpg'),
(121, 'Laptop HP 15s du0042TX i3 7020U/4GB/1TB/2GB MX110/Win10 (6ZF75PA)', 3, 18, 'Laptop HP 15s du0042TX đáp ứng hầu hết nhu cầu văn phòng và học tập hằng ngày. Sản phẩm được tích hợp thêm card đồ họa rời giúp hình ảnh hiển thị thêm mượt mà.\r\nThiết kế thanh lịch, trang nhã\r\nLaptop HP màu bạc, thiết kế đơn giản mang lại nét thanh lịch cho máy, phù hợp với dân văn phòng, sinh viên,... Trọng lượng máy 1.74 kg không quá nặng để mang đi làm hằng ngày.', 9910000, 1, '2021-01-10 13:54:35', '2021-01-10 13:54:35', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261675/aasqakaigfx4urgmo7jg.jpg'),
(131, 'Laptop Lenovo IdeaPad S340 14IIL i5 1035G1/8GB/512GB/Win10 (81VV003SVN)', 1, 20, 'Laptop Lenovo IdeaPad S340 14IIL i5 (81VV003SVN) có thiết kế năng động, gọn nhẹ phù hợp cho giới trẻ đặc biệt là nhân viên văn phòng và học sinh sinh viên. Laptop có cấu hình khỏe, được trang bị chip Core i5 thế hệ 10, ổ cứng SSD xử lí nhanh, chiếc máy này có thể cùng bạn giải quyết công việc, giải trí hàng ngày.', 11590000, 0, '2021-01-10 13:55:34', '2021-01-10 13:55:34', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261734/ycqfttlsttx28niqf8bl.jpg'),
(141, 'Laptop Dell Inspiron 5593 i5 1035G1/8GB/256GB/2GB MX230/Win10 (N5I5513W)', 3, 18, 'Laptop Dell Inspiron 5593 có thiết kế tinh tế, thời trang và hiệu năng mạnh mẽ, hứa hẹn sẽ đem đến cho người dùng những trải nghiệm tốt nhất.\r\nMàn hình lớn 15.6 inch, xem phim cực đã\r\nLaptop Dell Inspiron 5593 với màn hình kích thước 15.6 inch, độ phân giải Full HD sắc nét, viền màn hình mỏng đem đến những trải nghiệm cày phim, lướt web hay làm việc trên máy tính hết sức tuyệt vời. Hơn thế nữa, công nghệ Anti-Glare hỗ trợ chống chói khi bạn làm việc ngoài trời.', 17990000, 0, '2021-01-10 13:56:31', '2021-01-10 13:56:31', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261791/nnijw1sw43smh7q6ikfc.jpg'),
(151, 'Laptop Lenovo IdeaPad S145 15IIL i5 1035G1/8GB/512GB/Win10 (81W80021VN)', 3, 18, 'Lenovo IdeaPad S145 15IIL i5 (81W80021VN) có thiết kế mỏng nhẹ hợp thời trang, thuận tiện cho những ai cần di chuyển nhiều như học sinh, sinh viên, dân văn phòng. Với chip Intel Core i5 thế hệ mới nhất và ổ cứng SSD, laptop đem đến hiệu năng làm việc nhanh chóng, hiệu quả cao.\r\nThiết kế hiện đại, mỏng gọn\r\nMáy có thiết kế khá mỏng nhẹ so với những chiếc laptop 15.6 inch cùng phân khúc, trọng lượng 1.79 kg dễ dàng để mang máy tính bên mình hàng ngày. Mặt lưng được làm tối giản, chỉ có logo hãng đặt lệch bên cạnh trái cho vẻ đẹp hiện đại và tinh tế.', 15290000, 0, '2021-01-10 13:57:15', '2021-01-10 13:57:15', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261835/aaqhpkck9vx5remz5iwk.jpg'),
(161, 'Laptop Lenovo ThinkBook 14IIL i5 1035G1/8GB/512GB/Win10 (20SL00MFVN)', 3, 15, 'Lenovo ThinkBook 14 IIL i5 (20SL00MFVN) là dòng laptop doanh nhân với thiết kế di động, cấu hình mạnh mẽ cùng với khả năng bảo mật cao.\r\nCấu hình lý tưởng cho các công việc văn phòng\r\nLenovo ThinkBook 14 được trang bị chip Intel Core i5 thế hệ thứ 10 với xung nhịp tối đa 3.6 GHz kết hợp cùng RAM 8 GB cho khả năng vận hành trơn tru các công việc của bạn, tăng cường đa nhiệm giúp duyệt web cùng lúc nhiều cửa sổ làm việc mà không lo tình trạng giật hay đơ.', 15990000, 0, '2021-01-10 13:57:49', '2021-01-10 13:57:49', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261869/oihffqczareeomvq5zfv.jpg'),
(171, 'Laptop Dell Vostro 3491 i3 1005G1/4GB/256GB/Win10 (70223127)', 3, 15, 'Laptop Dell Vostro 3491 i3 (70223127) có thiết kế cứng cáp, đơn giản cùng cấu hình ổn định, sử dụng mượt với các phần mềm học tập văn phòng, làm việc, giải trí hằng ngày phù hợp với những bạn sinh viên có kinh phí thấp muốn tìm kiếm một chiếc laptop đồng hành trong việc học.\r\nThiết kế sang trọng, cứng cáp\r\nLaptop Dell Vostro 3491 với vỏ nhựa màu đen sang trọng, cứng cáp, thiết kế đậm chất Dell. Chiếc laptop có trọng lượng 1.66 kg, dễ dàng để bạn mang theo thiết bị này suốt ngày dài.', 10990000, 0, '2021-01-10 13:58:27', '2021-01-10 13:58:27', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261907/irdsqbkc3tkdhdkbllcx.jpg'),
(181, 'Laptop Asus Gaming Rog Strix G512 i5 10300H/8GB/512GB/144Hz/4GB GTX1650Ti/Win10 (IAL013T)', 3, 25, 'Laptop Asus Gaming Rog Strix G512 - IAL013T với thiết kế tối giản nhưng trải nghiệm chơi game chẳng thể xem thường bởi nó dư sức để chiến những tựa game nặng, xử lý đa nhiệm siêu mượt nhờ có bộ cấu hình cùng các tính năng đi kèm siêu hiện đại.\r\nThiết kế tối ưu hóa tính năng\r\nAsus Gaming Rog Strix G512 với màu đen huyền bí kết hợp với những đường phây xước làm nên một sự mạnh mẽ cho chiếc laptop.', 24490000, 0, '2021-01-10 13:59:06', '2021-01-10 13:59:06', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261946/t2gcngvzes8jhqhijkxa.jpg'),
(191, 'Loa kéo Karaoke Dalton TS-15G600X 600W', 7, 10, 'Thiết kế vững chắc, sang trọng.\r\nLoa di chuyển linh hoạt cùng với 4 bánh xe và tay kéo chắc chắn.\r\nÂm thanh vang dội, mạnh mẽ với loa 2 đường 1 tiếng bao gồm 1 loa bass 3,8 tấc (đường kính 38 cm) và 1 loa treble tổng công suất 600 W.\r\nDễ dàng hát karaoke mọi lúc mọi nơi với 2 micro tặng kèm và ứng dụng Dkara.\r\nĐiều khiển loa kéo Dalton nhanh chóng tiện lợi với remote điều khiển từ xa.\r\nLoa hỗ trợ FM, Bluetooth cổng kết nối USB, thẻ SD, Jack bông sen,...', 7650000, 0, '2021-01-10 13:59:59', '2021-01-10 13:59:59', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610261999/xkjokfvuzkno4r1881u0.jpg'),
(201, 'Loa kéo Karaoke Nanomax S-1000 450W', 7, 20, 'Thiết kế sang trọng, dễ dàng di chuyển.\r\nTổng công suất 450 W, loa 2 đường tiếng với 1 loa Bass và 1 loa Treble cho âm thanh vang dội.\r\nTặng kèm 2 micro karaoke mọi lúc mọi nơi.\r\nHỗ trợ kết nối đa dạng: Bluetooth, USB, Jack Micro 6.5 mm.', 5790000, 0, '2021-01-10 14:01:13', '2021-01-10 14:01:13', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262073/lhtsyhb2gpkqzm5ay541.jpg'),
(211, 'Loa Kéo Karaoke Enkor L0810K Đen 25W', 7, 18, 'Thời gian sử dụng 3-4h với mức âm lượng 60-70%.\r\nTích hợp mic rời và remote giúp thuận tiện cho người dùng.\r\nCông suất 25W cho âm thanh sắc nét và mạnh mẽ. Dải tần số 40Hz-20kHz.\r\nThời gian sạc từ 8 đến 10 giờ, nếu không sử dụng thời gian dài, cần sạc lại ít nhất 3 tháng/lần để không bị hư pin.\r\nTích hợp màn hình LED hiển thị, FM nghe nhạc.\r\nKhông bảo hành phụ kiện kèm theo.', 1400000, 0, '2021-01-10 14:01:49', '2021-01-10 14:01:49', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262109/k1vfedrm6cfmwhczkmlw.jpg'),
(221, 'Loa Kéo Bluetooth Mozard L0629K Đen Xám', 7, 10, 'Công suất 24 W cho âm thanh sắc nét và mạnh mẽ. Dải tần số 40 Hz - 20 kHz.\r\nThời gian sử dụng 2 giờ - 3 giờ, thời gian sạc khoảng 5 - 8 giờ.\r\nHát karaoke thả ga với 2 micro tặng kèm.\r\nHỗ trợ đa dạng kết nối.\r\nKhông bảo hành phụ kiện kèm theo.', 1540000, 0, '2021-01-10 14:02:27', '2021-01-10 14:02:27', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262147/lcd9dxixozlj0tcxwuwu.jpg'),
(231, 'Loa điện Karaoke Birici MX-700 450W', 7, 20, 'Thiết kế chữ nhật chắc chắn, cứng cáp.\r\nLoa 2 đường tiếng có 2 loa Bass đường kính 3,8 tấc, 2 loa Treble và tổng công suất lên tới 450 W cho âm thanh sống động.\r\nKết nối Bluetooth, nghe đài FM,... tiện lợi.\r\nCắm dùng trực tiếp, không lo ngại hết pin.\r\nĐa dạng các cổng kết nối như USB, jack micro, cổng bông sen,...\r\nTặng kèm 2 micro không dây.', 15390000, 0, '2021-01-10 14:03:04', '2021-01-10 14:03:04', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262184/sq0bbs4ntz7tfbijzn3u.jpg'),
(241, 'Loa karaoke LG OL45 220W', 7, 10, 'Thiết kế dạng hộp nhỏ gọn.\r\nCông suất 220 W cho trải nghiệm âm thanh sôi động.\r\nChế độ Multi Color Lighting đèn cho \"tiệc\".\r\nĐiều khiển từ xa với ứng dụng LG Xboom cài đặt ngay trên điện thoại.\r\nCa hát thật dễ dàng và thú vị hơn với 18 hiệu ứng giọng hát khác nhau.\r\nKết nối 2 loa không dây nhanh chóng.\r\nHỗ trợ nhiều kết nối: Bluetooth, USB,...', 2390000, 0, '2021-01-10 14:03:39', '2021-01-10 14:03:39', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262219/d87qnjjz4ct5ph40aroc.jpg'),
(251, 'Loa kéo Karaoke Mobell K1507 1000W', 7, 20, 'Thiết kế chắc chắn, sang trọng.\r\nLoa 3 đường tiếng âm thanh sống động với 1 loa Bass 3,8 tấc (đường kính 38 cm), 1 loa Mid, 1 loa Treble, tổng công suất 1000 W.\r\nHỗ trợ nhiều kết nối tiện lợi: Bluetooth, Jack Micro, Jack bông sen, Thẻ nhớ, USB.\r\nTặng kèm remote và 2 micro karaoke chuyên dụng', 6790000, 0, '2021-01-10 14:04:24', '2021-01-10 14:04:24', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262264/xk8derkispqomlftw8ad.jpg'),
(261, 'Dàn âm thanh Sony 5.1 HT-RT40 600W', 7, 16, 'Hệ thống âm thanh vòm 5.1 kênh với công suất 600 W cho âm thanh lan tỏa khắp căn phòng.\r\nÂm thanh rõ ràng, tách bạch nhờ công nghệ ClearAudio+.\r\nKết nối không dây: Bluetooth, NFC chia sẻ âm nhạc nhanh chóng.\r\nHỗ trợ nhiều cổng kết nối phổ biến: HDMI, USB, Optical, Jack 3.5 mm.', 7690000, 0, '2021-01-10 14:04:59', '2021-01-10 14:04:59', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262299/nnbal0wyvo2pa6w8htwq.jpg');
INSERT INTO `products` (`id_product`, `name`, `id_Cat`, `quantity`, `description`, `price`, `liked`, `created_at`, `updated_at`, `avatar`) VALUES
(291, 'Dàn âm thanh Sony 5.1 BDV-E4100 1000W', 7, 7, 'Giao diện Sony-Sony Entertainment Network tính năng giải trí phong phú.\r\nKết nối NFC, Bluetooth, và Wi-Fi tiện lợi, nhanh chóng.\r\nChế độ Football mode giúp các chương trình bóng đá thêm hấp dẫn.', 5590000, 2, '2021-01-10 14:09:07', '2021-01-10 14:58:04', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262547/umzlnmyq8ggukdyrcuib.jpg'),
(301, 'Smart Tivi Samsung 4K 55 inch UA55TU7000', 6, 10, 'Thiết kế không viền 3 cạnh tinh tế, kích thước tivi 55 inch. Độ phân giải Ultra HD 4K rõ nét.\r\nHình ảnh hiển thị rõ ràng, sắc sảo hơn với công nghệ HDR10+.\r\nDải màu đa dạng, rực rỡ sống động hơn với công nghệ màu sắc Crystal Display.\r\nCải thiện độ chi tiết, màu sắc hình ảnh tối ưu nhờ bộ xử lý Crystal 4K.\r\nHình ảnh có độ tương phản vượt trội nhờ công nghệ Mega Contrast.\r\nChơi màn game mượt mà, hạn chế hiện tượng mờ nhòe hay rung lắc nhờ công nghệ Real Game Enhancer.\r\nGiao diện phẳng, thân thiện với hệ điều hành Tizen OS.\r\nHỗ trợ nhiều cổng kết nối phổ biến: HDMI, USB,...', 11700000, 0, '2021-01-10 14:10:48', '2021-01-10 14:10:48', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262648/lrjbugjeqmtzfwnahbgq.jpg'),
(311, 'Smart Tivi LG 4K 55 inch 55UN7290PTF', 6, 15, 'Thiết kế hiện đại, chân đế chữ V úp ngược vững chắc phù hợp cho phòng khách, phòng họp,...\r\nĐộ phân giải Ultra HD 4K với màn hình 55 inch và tấm nền IPS cho hình ảnh hiển thị sắc nét, không bị biến đổi màu sắc.\r\nNâng cấp hình ảnh nhờ chip xử lý Quad Core 4K.\r\nĐiều khiển tivi và những thiết bị thông minh khác ngay trên màn hình tivi bằng giọng nói với Magic Remote và trí tuệ nhân tạo AI ThinQ.\r\nTăng cường độ tương phản, thưởng thức nội dung có độ nét cao nhờ công nghệ Active HDR.\r\nGiả lập âm thanh vòm sống động qua công nghệ Ultra Surround.\r\nHỗ trợ điều khiển tivi bằng điện thoại với ứng dụng LG TV Plus.\r\nChiếu màn hình điện thoại Android và iPhone lên tivi dễ dàng bằng tính năng Screen Mirroring và AirPlay 2.', 11990000, 0, '2021-01-10 14:11:21', '2021-01-10 14:11:21', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262682/qvyuvp1tyvflc7mzvldr.jpg'),
(321, 'Smart Tivi LG 4K 49 inch 49UN7290PTF', 6, 20, 'Màn hình 49 inch, độ phân giải Ultra HD 4K trên tấm nền IPS cho hình ảnh hiển thị sắc nét, đồng nhất, không bị biến đổi.\r\nKhử nhiễu, hình ảnh trung thực hơn nhờ bộ xử lý Quad Core 4K.\r\nĐiều khiển tivi bằng giọng nói hỗ trợ tiếng Việt thông qua Magic Remote và cuộc sống tiện lợi hơn với AI ThinQ.\r\nHình ảnh có độ nét và độ tương phản vượt trội hơn nhờ công nghệ 4K Active HDR.\r\nThưởng thức trọn vẹn nội dung các bộ phim điện ảnh với công nghệ Filmmaker Mode.\r\nÂm thanh lan tỏa mạnh mẽ khắp không gian phòng nhờ công nghệ Ultra Surround.\r\nGiao diện gọn gàng, dễ sử dụng hơn trên hệ điều hành WebOS 5.0.\r\nTiện lợi khi điều khiển tivi bằng điện thoại qua ứng dụng LG TV Plus.\r\nChiếu màn hình điện thoại lên tivi qua tính năng Screen Mirroring (thiết bị Android) và Airplay 2 (iPhone).', 11290000, 0, '2021-01-10 14:12:30', '2021-01-10 14:12:30', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262750/zyv4cvmxdtxgjgjefyfy.jpg'),
(331, 'Android Tivi Sony 4K 49 inch KD-49X8000H', 6, 18, 'Thiết kế sang trọng, chân đế bằng kim loại, kích thước tivi 49 inch, độ phân giải Ultra HD 4K.\r\nGiảm nhiễu hình ảnh, màu sắc và độ tương phản được tăng cường nhờ bộ xử lí chip X1 4K HDR Processor.\r\nDải màu rộng hơn, hình ảnh hiển thị tự nhiên và chính xác nhờ công nghệ TRILUMINOS Display.\r\nDải tương phản động và dải sắc màu hiển thị mở rộng nhờ công nghệ Dolby Vision.\r\nÂm thanh đa chiều mạnh mẽ nhờ công nghệ âm thanh Dolby Atmos.\r\nDễ dàng điều khiển tivi bằng điện thoại với ứng dụng Android TV.\r\nChia sẻ nội dung trên màn hình điện thoại lên tivi nhờ Apple Homekit/Apple Airplay.', 15900000, 0, '2021-01-10 14:13:12', '2021-01-10 14:13:12', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262792/td4zz66wn6asmrsh6x6z.jpg'),
(341, 'Smart Tivi QLED Samsung 4K 43 inch QA43Q60T', 6, 9, 'Tivi 43 inch, thiết kế không viền 3 cạnh·thanh mảnh, độ phân giải Ultra HD 4K sắc nét gấp 4 lần Full HD.\r\nHiển thị 100% dải màu bằng công nghệ màn hình chấm lượng tử Quantum Dot.\r\nTăng cường độ tương phản và độ chính xác của màu sắc bằng công nghệ đèn nền Dual Led và Quantum HDR.\r\nHình ảnh rõ nét với sắc đen sâu thẳm, sắc trắng tinh khiết qua công nghệ Supreme UHD Dimming.\r\nHình ảnh chất lượng và màu sắc trọn vẹn với mọi góc nhìn với công nghệ Wide Viewing Angle.\r\nHệ điều hành Tizen OS đơn giản, dễ sử dụng và kho ứng dụng phong phú.\r\nChiếu màn hình điện thoại lên tivi qua Tap View và AirPlay 2, xem nhiều nội dung cùng lúc với tính năng Multi View (Trình chiếu đa màn hình).', 15900000, 0, '2021-01-10 14:13:55', '2021-01-10 14:13:55', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262835/p2qt1ty7puuncyempdot.jpg'),
(351, 'Smart Tivi Samsung 4K 55 inch UA55TU8500', 6, 13, 'Thiết kế không viền 3 cạnh tinh tế, kích thước tivi 55 inch. Độ phân giải Ultra HD 4K sắc nét gấp 4 lần Full HD.\r\nDải màu rộng lên đến 1 tỷ sắc màu, sống động như thật với công nghệ Dynamic Crystal Display.\r\nMàu sắc, độ tương phản được tăng cường, cải thiện góc nhìn với công nghệ đèn nền kép Dual LED.\r\nHình ảnh có độ tương phản cao, sắc nét đến từng chi tiết nhờ công nghệ Mega Contrast.\r\nHình ảnh chi tiết, sắc sảo hơn với công nghệ HDR10+.\r\nMàn hình chơi game mượt mà, làm giảm hiện tượng mờ nhòe, rung lắc nhờ công nghệ Real Game Enhancer.\r\nĐiều khiển tivi bằng điện thoại dễ dàng với ứng dụng SmartThings.\r\nTrải nghiệm xem nhiều nội dung giải trí cùng lúc trên màn hình TV với công nghệ Multi View.\r\nTrình chiếu màn hình điện thoại lên tivi qua tính năng Tap View, AirPlay 2 và Screen Mirroring.', 15400000, 0, '2021-01-10 14:14:31', '2021-01-10 14:14:31', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610262871/zuq2ht8w7lo09sjsmkaf.jpg'),
(401, 'Máy tính bảng Samsung Galaxy Tab A8 8\" T295 (2019)', 2, 10, 'Samsung Galaxy Tab A8 8 inch T295 (2019) là một chiếc máy tính bảng gọn nhẹ, với màn hình vừa đủ có thể giúp bạn giải trí hay hỗ trợ trẻ nhỏ trong việc học tập.', 3690000, 0, '2021-01-10 16:07:18', '2021-01-10 16:07:18', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610269638/io3pchwys5t8scpiiyzc.jpg'),
(411, 'Máy tính bảng iPad Pro 12.9 inch Wifi Cellular 128GB (2020)', 2, 15, 'Sau bao ngày chờ đợi, chiếc máy tính bảng iPad Pro 12.9 inch Wifi Cellular 128GB (2020) đã được trình làng. Với thiết kế không mấy khác biệt so với người anh em iPad Pro 2018 nhưng được Apple nâng cấp hệ thống camera, cùng con chip A12Z giúp iPad Pro 12.9 (2020) mang đến hiệu năng ấn tượng cho người dùng những trải nghiệm tuyệt vời.', 30990000, 0, '2021-01-10 16:08:12', '2021-01-10 16:08:12', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610269692/m0oeoilwx0rn894iyhvn.jpg'),
(421, 'Máy tính bảng Samsung Galaxy Tab A 10.1 T515 (2019)', 2, 20, 'Samsung Galaxy Tab A 10.1 T515 (2019) là chiếc máy tính bảng có màn hình lớn cùng cấu hình vừa phải đáp ứng tốt cho bạn trong hầu hết các nhu cầu giải trí hằng ngày.', 7090000, 0, '2021-01-10 16:09:49', '2021-01-10 16:09:49', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610269790/qsaeiu0djjixevrjpgco.jpg'),
(431, 'Điện thoại OPPO Reno5', 1, 18, 'OPPO vừa kịp ra mắt thế hệ OPPO Reno mới nhất của mình vào dịp cuối năm 2020. OPPO Reno5 là sự kết hợp đầy ấn tượng giữa hiệu năng và thiết kế, mang đến cho người dùng một chiếc điện thoại tích hợp nhiều công nghệ camera, sạc pin hàng đầu của OPPO trong một mức giá tầm trung.', 8690000, 0, '2021-01-10 16:15:55', '2021-01-10 16:15:55', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270155/oe7ydsc8dgu2s1wtytuu.jpg'),
(441, 'Điện thoại OPPO Reno4', 1, 20, 'OPPO Reno4 - Chiếc điện thoại có thiết kế thời thượng, hiệu năng mạnh mẽ cùng bộ 4 camera siêu ấn tượng, tối ưu hóa cho chụp ảnh và quay phim siêu sắc nét, hứa hẹn sẽ là sản phẩm đáng để nâng cấp của hãng OPPO trong năm nay.', 7490000, 0, '2021-01-10 16:17:10', '2021-01-10 16:17:10', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270231/lruuwtbbprttwcv2wnaj.jpg'),
(451, 'Điện thoại OPPO A93', 1, 10, 'Đặc điểm nổi bật của OPPO A93\r\n\r\nBộ sản phẩm chuẩn: Hộp, Sạc, Tai nghe, Sách hướng dẫn, Cáp, Cây lấy sim, Ốp lưng\r\n\r\nTháng 9/2020, OPPO tiếp tục cho ra mắt dòng sản phẩm thuộc phân khúc điện thoại tầm trung được xem là tiếp nối từ OPPO A92 với nhiều điểm được nâng cấp như hiệu năng, hệ thống camera cùng khả năng sạc nhanh 18W với tên gọi OPPO A93.', 7490000, 0, '2021-01-10 16:18:23', '2021-01-10 16:18:23', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270303/ccawa9hetifs954mddww.jpg'),
(461, 'Điện thoại OPPO A31 (4GB/128GB)', 1, 18, 'Chiếc điện thoại OPPO A31 2020 4GB/128 GB nổi bật với thiết kế màn hình giọt nước tràn viền, bộ ba camera ấn tượng đi kèm hiệu năng tốt với mức giá bán cực kỳ phải chăng.', 4090000, 0, '2021-01-10 16:19:16', '2021-01-10 16:19:16', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270356/b8n3yrhh4yaic4iv3czk.jpg'),
(471, 'Điện thoại OPPO A12 (3GB/32GB)', 1, 10, 'OPPO A12 là chiếc điện thoại phổ thông rất đáng mua từ nhà OPPO. Những điểm đáng tiền phải kể đến trên thiết bị này bao gồm thiết kế đẹp với màn hình giọt nước, hiệu năng mượt mà và thời lượng pin dùng thoải mái.', 2990000, 0, '2021-01-10 16:20:12', '2021-01-10 16:20:12', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270412/lfj2t4riswtfoqczdsvv.jpg'),
(481, 'Điện thoại Xiaomi Redmi Note 9S', 1, 18, 'Redmi Note 9s là điện thoại thông minh tầm trung của nhà Xiaomi, gây ấn tượng với thiết kế tràn viền độc đáo, cấu hình mạnh mẽ và hệ thống bốn camera sau chất lượng.\r\n\r\nRedmi Note 9s là điện thoại thông minh tầm trung của nhà Xiaomi, gây ấn tượng với thiết kế tràn viền độc đáo, cấu hình mạnh mẽ và hệ thống bốn camera sau chất lượng.', 5690000, 0, '2021-01-10 16:21:53', '2021-01-10 16:21:53', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270513/g3jzcnmrlivnbhh5bbny.jpg'),
(491, 'Điện thoại Xiaomi Redmi Note 9 Pro (6GB/64GB)', 1, 18, 'Kế thừa truyền thống tích hợp nhiều tính năng cực hấp dẫn trong mức giá cực tốt, Redmi Note 9 Pro đã ra mắt với nhiều trang bị ấn tượng: Vi xử lý Snapdragon 720G, màn hình nốt ruồi siêu tràn viền, cụm 4 camera 64 “chấm” và một viên pin khủng 5020 mAh.', 6190000, 0, '2021-01-10 16:23:19', '2021-01-10 16:23:19', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270599/u2ixlfoiimsctnixukfj.jpg'),
(501, 'Điện thoại Xiaomi Redmi 9 (4GB/64GB)', 1, 15, 'Nhanh như một cơn gió, sức hot của Redmi Note 9 Pro chưa có dấu hiệu hạ nhiệt thì Xiaomi Redmi 9 vừa bất ngờ ra mắt sớm. Thiết bị mang một thiết kế mới, thời trang và nhỏ gọn, phần cứng được nâng cấp cùng thời lượng pin ấn tượng, đặc biệt đi kèm một mức giá bán không thể nào hấp dẫn hơn.', 3490000, 0, '2021-01-10 16:24:19', '2021-01-10 16:24:19', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270659/dkjfqkyegzel5ydzpubu.jpg'),
(511, 'Điện thoại Vivo Y51 (2020)', 1, 17, 'Vivo đã mang chiếc điện thoại Vivo Y51 một lần nữa quay trở lại với người dùng trong một thiết kế hoàn toàn mới, nâng cấp từ công nghệ màn hình, cụm camera đến hệ điều hành với tên gọi Vivo Y51 (2020).', 5990000, 0, '2021-01-10 16:25:10', '2021-01-10 16:25:10', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270710/cmzd2y8kj3eqjubthp83.jpg'),
(521, 'Điện thoại Vivo X50 Pro', 1, 10, 'Trong cuộc đua của các hãng điện thoại đang dần trở nên ngày càng khốc liệt, Vivo vừa mang tới một \"làn gió mới\" mang tên Vivo X50 Pro nổi bật với hệ thống camera chống rung độc đáo như trên một chiếc gimbal thực sự, lần đầu tiên được trang bị trên smartphone hiện đại.', 17990000, 0, '2021-01-10 16:26:36', '2021-01-10 16:26:36', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270796/kklpayojh1xrevdascay.jpg'),
(531, 'Điện thoại Vivo V20 SE', 1, 10, 'Mặc dù được định vị ở phân khúc điện thoại tầm trung, Vivo V20 SE vẫn sở hữu những nét riêng biệt, đủ để thu hút sự chú ý của những ai yêu công nghệ. Hãy cùng tìm hiểu xem chiếc smartphone này có gì khác biệt với các đối thủ khác.', 6790000, 0, '2021-01-10 16:27:35', '2021-01-10 16:27:35', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270855/lekv2oq14mtoxaruqsjo.jpg'),
(541, 'Điện thoại Realme C15', 1, 17, 'Realme vừa cho ra mắt sản phẩm mới nhất là Realme C15 với mức giá vô cùng phải chăng. Chiếc điện thoại thông minh này đi kèm 4 camera sau và dung lượng pin lên đến 6000 mAh sẵn sàng đồng hành cùng bạn trong mọi lúc.', 3990000, 0, '2021-01-10 16:28:28', '2021-01-10 16:28:28', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270908/kz2gz93o1nmy1feskvp5.jpg'),
(551, 'Điện thoại Realme 7 Pro', 1, 10, 'Trong cuộc đua của những chiếc điện thoại thông minh, smartphone tầm trung đang có sự cạnh tranh khốc liệt, mới đây mẫu smartphone cao cấp của nhà Realme là Realme 7 Pro chính thức ra mắt. Nổi bật với 4 camera sau AI chuyên nghiệp, cấu hình mạnh mẽ và công nghệ sạc cực nhanh SuperDart 65W đi kèm nhiều tính năng nổi trội khác.', 8490000, 0, '2021-01-10 16:29:24', '2021-01-10 16:29:24', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610270964/hicubcxifb2vy2d1h81e.jpg'),
(561, 'Điện thoại Realme 6 Pro', 1, 20, 'Realme 6 Pro là mẫu smartphone cao cấp hơn trong bộ đôi Realme 6 Series mới ra mắt của Realme. Vẫn với tiêu chí smartphone cấu hình mạnh - giá tốt, Realme 6 Pro còn nổi bật với cụm 6 camera ấn tượng, màn hình siêu mượt 90 Hz theo xu hướng.', 7390000, 1, '2021-01-10 16:30:46', '2021-01-10 21:51:01', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610271047/qgeohhutfbnavw7mf1jv.jpg'),
(571, 'Điện thoại Samsung Galaxy A12 (6GB/128GB)', 1, 15, 'Gây ấn tượng với bộ tứ camera thời thượng, hiệu năng ổn định mang đến sự mượt mà trong mọi tác vụ, cùng thời lượng pin ấn tượng, Samsung Galaxy A12 (6GB/128GB) sẽ là mẫu smartphone đáng mua nhất trong phân khúc tầm trung giá rẻ của Samsung.', 4690000, 0, '2021-01-10 16:32:57', '2021-01-10 16:32:57', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610271178/qtznsxacr3q6gr6lwory.jpg'),
(581, 'Điện thoại Samsung Galaxy Z Flip', 1, 19, 'Cuối cùng sau bao nhiêu thời gian chờ đợi, chiếc điện thoại Samsung Galaxy Z Flip đã được Samsung ra mắt tại sự kiện Unpacked 2020. Siêu phẩm với thiết kế màn hình gập vỏ sò độc đáo, hiệu năng tuyệt đỉnh cùng nhiều công nghệ thời thượng, dẫn dầu 2020.', 36000000, 0, '2021-01-10 16:33:58', '2021-01-10 16:33:58', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610271239/epueeulwr1ggrzote16h.jpg'),
(591, 'Điện thoại Samsung Galaxy S20+', 1, 20, 'Chiếc điện thoại Samsung Galaxy S20 Plus - Siêu phẩm với thiết kế màn hình tràn viền, hiệu năng đỉnh cao kết hợp cùng nhiều đột phá về công nghệ dẫn đầu thế giới smartphone.', 23990000, 0, '2021-01-10 16:35:00', '2021-01-10 16:35:00', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610271300/b9hlwjsjbq19gobtpxnt.jpg'),
(671, 'Điện thoại Iphone', 1, 20, 'Đẹp, sang ,xịn', 18490000, 0, '2021-01-10 21:51:58', '2021-01-10 21:51:58', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610290319/rdoz8rumr8lew82bpcrz.jpg'),
(681, 'test điện thoại', 1, 10, 'cơ bản', 200000, 0, '2021-01-11 18:29:06', '2021-01-11 18:29:06', 'http://res.cloudinary.com/ecommerce18ck/image/upload/v1610364547/ju6x8shloreb9sgq5bdc.jpg');

INSERT INTO `purchasedetail` (`id_purchase`, `id_detail`, `id_product`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, 1, 351, 1, 15400000, '2021-01-10 07:18:33', '0000-00-00 00:00:00');
INSERT INTO `purchasedetail` (`id_purchase`, `id_detail`, `id_product`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 5990000, '2021-01-10 07:18:33', '0000-00-00 00:00:00');
INSERT INTO `purchasedetail` (`id_purchase`, `id_detail`, `id_product`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, 3, 101, 1, 9440000, '2021-01-10 07:18:33', '0000-00-00 00:00:00');
INSERT INTO `purchasedetail` (`id_purchase`, `id_detail`, `id_product`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, 4, 291, 1, 5590000, '2021-01-10 07:18:33', '0000-00-00 00:00:00'),
(1, 5, 341, 1, 15900000, '2021-01-10 07:18:33', '0000-00-00 00:00:00'),
(11, 1, 291, 1, 5590000, '2021-01-10 12:10:47', '0000-00-00 00:00:00'),
(11, 2, 351, 1, 15400000, '2021-01-10 12:10:47', '0000-00-00 00:00:00'),
(11, 3, 11, 1, 22990000, '2021-01-10 12:10:47', '0000-00-00 00:00:00'),
(21, 1, 11, 1, 22990000, '2021-01-10 13:24:02', '0000-00-00 00:00:00'),
(21, 2, 31, 1, 3490000, '2021-01-10 13:24:02', '0000-00-00 00:00:00'),
(21, 3, 1, 1, 5990000, '2021-01-10 13:24:02', '0000-00-00 00:00:00'),
(31, 1, 1, 1, 5990000, '2021-01-10 13:25:50', '0000-00-00 00:00:00'),
(31, 2, 61, 1, 28990000, '2021-01-10 13:25:50', '0000-00-00 00:00:00'),
(31, 3, 101, 3, 9440000, '2021-01-10 13:25:50', '0000-00-00 00:00:00'),
(41, 1, 1, 1, 5990000, '2021-01-10 13:30:19', '0000-00-00 00:00:00'),
(41, 2, 541, 1, 3990000, '2021-01-10 13:30:19', '0000-00-00 00:00:00'),
(41, 3, 581, 1, 36000000, '2021-01-10 13:30:19', '0000-00-00 00:00:00'),
(41, 4, 11, 2, 22990000, '2021-01-10 13:30:19', '0000-00-00 00:00:00'),
(51, 1, 31, 3, 3490000, '2021-01-10 13:31:29', '0000-00-00 00:00:00'),
(61, 1, 11, 1, 22990000, '2021-01-10 13:34:50', '0000-00-00 00:00:00'),
(81, 1, 31, 1, 3490000, '2021-01-10 13:43:21', '0000-00-00 00:00:00'),
(81, 2, 1, 1, 5990000, '2021-01-10 13:43:21', '0000-00-00 00:00:00'),
(81, 3, 11, 5, 22990000, '2021-01-10 13:43:21', '0000-00-00 00:00:00'),
(111, 1, 1, 2, 5990000, '2021-01-10 14:49:05', '0000-00-00 00:00:00'),
(111, 2, 61, 1, 28990000, '2021-01-10 14:49:05', '0000-00-00 00:00:00'),
(111, 3, 111, 1, 9440000, '2021-01-10 14:49:05', '0000-00-00 00:00:00'),
(121, 1, 11, 2, 22990000, '2021-01-10 15:49:12', '0000-00-00 00:00:00'),
(131, 1, 11, 1, 22990000, '2021-01-11 03:44:09', '0000-00-00 00:00:00'),
(151, 1, 291, 2, 5590000, '2021-01-11 11:27:55', '0000-00-00 00:00:00'),
(151, 2, 571, 3, 4690000, '2021-01-11 11:27:55', '0000-00-00 00:00:00'),
(161, 1, 11, 1, 22990000, '2021-01-11 12:44:23', '0000-00-00 00:00:00'),
(171, 1, 11, 1, 22990000, '2021-01-11 12:44:49', '0000-00-00 00:00:00');

INSERT INTO `purchases` (`id_purchase`, `id_user`, `name`, `phone`, `address`, `total`, `status`, `note`, `thanhtoan`, `created_at`, `updated_at`) VALUES
(1, 13, 'Trần Văn A', '0122124', 'Việt Nam', 52320000, 1, NULL, 1, '2021-01-09 07:18:33', '0000-00-00 00:00:00');
INSERT INTO `purchases` (`id_purchase`, `id_user`, `name`, `phone`, `address`, `total`, `status`, `note`, `thanhtoan`, `created_at`, `updated_at`) VALUES
(11, 15, 'cường', '123', 'test', 43980000, 5, NULL, 1, '2020-12-08 12:10:47', '0000-00-00 00:00:00');
INSERT INTO `purchases` (`id_purchase`, `id_user`, `name`, `phone`, `address`, `total`, `status`, `note`, `thanhtoan`, `created_at`, `updated_at`) VALUES
(21, 9, 'Nguyễn Thị A', '098945236', 'Giao đâu cũng được', 32470000, 3, 'hihihi', 1, '2021-01-07 13:24:02', '0000-00-00 00:00:00');
INSERT INTO `purchases` (`id_purchase`, `id_user`, `name`, `phone`, `address`, `total`, `status`, `note`, `thanhtoan`, `created_at`, `updated_at`) VALUES
(31, 17, 'mai thanh nhân', '0909999888', '227 Nguyễn Văn Cừ Phường 4 Quận 5 TPHCM', 63300000, 1, 'tốc hành', 1, '2020-06-10 13:25:50', '0000-00-00 00:00:00'),
(41, 9, 'Nguyễn Văn Tèo', '0989665083', 'Thôn 2 Bình Thái Bình Phước', 91960000, 5, NULL, 1, '2021-01-10 13:30:19', '0000-00-00 00:00:00'),
(51, 9, 'Trần Tí', '023647895', 'Thôn 2 Bình Thái Bình Phước', 10470000, 4, '123456', 1, '2020-02-10 13:31:29', '0000-00-00 00:00:00'),
(61, 17, 'Nguyễn Văn Tèo', '09009009090', '777 Cộng Hòa', 22990000, 1, 'không thích trễ', 1, '2021-01-10 13:34:50', '0000-00-00 00:00:00'),
(71, 15, 'Tềo', '0964123547', '551 Hoàng Hoa Thám', 22000000, 5, NULL, NULL, '2020-08-10 13:36:10', '0000-00-00 00:00:00'),
(81, 15, 'Cường', '0945045154', 'Việt Nam', 124430000, 1, NULL, 1, '2021-01-10 13:43:21', '0000-00-00 00:00:00'),
(111, 91, 'Lê Văn C', '123456', 'Việt Nam', 50410000, 1, 'cẩn thận', 1, '2021-01-10 14:49:05', '0000-00-00 00:00:00'),
(121, 17, 'Nguyễn Văn Tèo', '09009009090', '227 Nguyễ Văn Cừ Phường 4 Quận 5 TPHCM', 45980000, 1, 'vvv', 1, '2021-01-10 15:49:12', '0000-00-00 00:00:00'),
(131, 13, 'Trần Văn A', '1121212', 'Việt Nam', 22990000, 1, NULL, 1, '2021-01-11 03:44:09', '0000-00-00 00:00:00'),
(151, 13, 'Lê Văn C', '232321312', 'Việt Nam', 25250000, 1, NULL, 1, '2021-01-11 11:27:55', '0000-00-00 00:00:00'),
(161, 15, 'cường', '1234567890', 'test', 22990000, 1, NULL, 1, '2021-01-11 12:44:23', '0000-00-00 00:00:00'),
(171, 17, 'mai thanh nhân', '09009009090', '777 Cộng Hòa', 22990000, 1, 'test', 1, '2021-01-11 12:44:49', '0000-00-00 00:00:00');

INSERT INTO `status` (`id_stt`, `description`) VALUES
(1, 'Chờ xử lý');
INSERT INTO `status` (`id_stt`, `description`) VALUES
(2, 'Huỷ');
INSERT INTO `status` (`id_stt`, `description`) VALUES
(3, 'Đang xử lý');
INSERT INTO `status` (`id_stt`, `description`) VALUES
(4, 'Đang giao hàng'),
(5, 'Hoàn thành');

INSERT INTO `userlikeproduct` (`id`, `user_id`, `product_id`, `created_at`) VALUES
(1, 17, 291, '2021-01-10 07:34:39');
INSERT INTO `userlikeproduct` (`id`, `user_id`, `product_id`, `created_at`) VALUES
(31, 17, 561, '2021-01-10 10:09:58');
INSERT INTO `userlikeproduct` (`id`, `user_id`, `product_id`, `created_at`) VALUES
(41, 71, 1, '2021-01-10 14:17:42');
INSERT INTO `userlikeproduct` (`id`, `user_id`, `product_id`, `created_at`) VALUES
(51, 71, 101, '2021-01-10 14:19:05'),
(81, 91, 31, '2021-01-10 14:43:51'),
(91, 91, 1, '2021-01-10 14:45:37'),
(101, 15, 1, '2021-01-10 15:02:36'),
(111, 15, 11, '2021-01-10 15:03:28'),
(121, 9, 61, '2021-01-11 09:11:44'),
(131, 131, 1, '2021-01-11 10:41:00'),
(141, 131, 121, '2021-01-11 10:56:53'),
(151, 13, 1, '2021-01-11 11:26:18'),
(161, 13, 61, '2021-01-11 11:26:44'),
(171, 13, 291, '2021-01-11 11:26:59'),
(191, 17, 11, '2021-01-11 12:28:52');

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `updated_at`, `email_verified_at`, `role`) VALUES
(9, '12345', 'ntrongquyet37@gmail.com', '$2y$10$9kHNj5f0asxtYVR60v.gauVwfsJCFJQYg6RW4tFIQb0ZpHbAO3WzO', '2021-01-08 04:43:20', '2020-12-09 15:49:58', '2020-12-14 17:00:14', 1);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `updated_at`, `email_verified_at`, `role`) VALUES
(13, 'tongo0209', 'tongo0209@gmail.com', '$2y$10$XHJ3ONql9ninRd8PG8HIx.nrROtojM27ygxthKyLTd5FDQPf6iBaW', '2021-01-08 04:43:20', '2020-12-22 10:09:48', '2020-12-22 10:10:06', 1);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `updated_at`, `email_verified_at`, `role`) VALUES
(15, '18600038', 'phamcuong2751@gmail.com', '$2y$10$uwkSUDUab24q1G02x9j/7ePwJcIBPsUcPpa83wtX8/.GyFynx7YXK', '2021-01-08 04:43:20', '2020-12-30 18:37:50', '2021-01-08 04:43:20', 1);
INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `updated_at`, `email_verified_at`, `role`) VALUES
(17, 'mainhan', 'mainhan.mtn93@gmail.com', '$2y$10$Z3aiWTLPNGCM680RAleIjudnRncSBo0RJ8KlOMPmTfTNRBjaEnReC', '2021-01-08 04:43:20', '2021-01-07 23:23:29', '2021-01-07 23:23:54', 1),
(91, 'tongo0000', 'tongo02090@gmail.com', '$2y$10$fNVHsao1QKOuS7Dbm31S0.jd/gxrdZ10qHDkiJQx/w5b6hou8s8QC', '2021-01-10 21:39:00', '2021-01-10 21:39:00', '0000-00-00 00:00:00', -1),
(121, 'admin', 'ntq20030807@gmail.com', '$2y$10$W38hIr25l9Di3HgMArxvW.xv8w36PZgyH/tIgqcXljB3RcY4v7GzG', '2021-01-11 17:32:19', '2021-01-11 17:32:19', '2021-01-11 17:37:59', -1),
(141, 'testtaikhoannguoidung', 'tranconcho6969@gmail.com', '$2y$10$sTcU3X8rbGVePx8vBiKqkePt/DQTjgbW7HAo.kOO00A0Lsg0SJFJO', '2021-01-11 18:32:34', '2021-01-11 18:32:34', '2021-01-11 18:32:54', -1);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
