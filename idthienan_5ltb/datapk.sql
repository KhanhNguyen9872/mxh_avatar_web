CREATE TABLE `pkmchien1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `sm` int(11) NOT NULL DEFAULT '1',
  `exp` int(11) NOT NULL,
  `lv` int(11) NOT NULL,
  `hpfull` int(11) NOT NULL,
  `time` varchar(1024) DEFAULT NULL,
  `img` text NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO pkmchien1 VALUES("1","0","30000","500","0","0","30000","1465112586","http://i.imgur.com/VIrRI0L.png","Heracross");
INSERT INTO pkmchien1 VALUES("2","0","35000","1000","0","0","35000","1465112620","http://i.imgur.com/iLkgdbP.png","Skarmory");
INSERT INTO pkmchien1 VALUES("3","0","50000","2000","0","0","50000","1465112679","http://i.imgur.com/HblYwtO.png","Golem");
INSERT INTO pkmchien1 VALUES("4","0","20000","5000","0","0","20000","1465112700","http://i.imgur.com/VoLU568.png","Kingdra");
INSERT INTO pkmchien1 VALUES("5","0","40000","5000","0","0","40000","1465112722","http://i.imgur.com/t2ReXzz.png","Arcanine");



DROP TABLE IF EXISTS pkmn1;

CREATE TABLE `pkmn1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `sm` int(11) NOT NULL DEFAULT '1',
  `exp` int(11) NOT NULL,
  `lv` int(11) NOT NULL,
  `hpfull` int(11) NOT NULL,
  `name` text NOT NULL,
  `time` varchar(1024) DEFAULT NULL,
  `img` text NOT NULL,
  `idpk` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=151 DEFAULT CHARSET=utf8;
CREATE TABLE `tuipkm1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hp` int(11) NOT NULL DEFAULT '0',
  `sm` int(11) NOT NULL DEFAULT '1500',
  `exp` int(11) NOT NULL DEFAULT '0',
  `lv` int(11) NOT NULL DEFAULT '1',
  `time` varchar(1024) DEFAULT NULL,
  `img` text NOT NULL,
  `name` text NOT NULL,
  `hpfull` int(11) NOT NULL DEFAULT '0',
  `checklv` int(11) NOT NULL DEFAULT '0',
  `idpkm` int(11) NOT NULL DEFAULT '0',
  `dath` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=173 DEFAULT CHARSET=utf8;
CREATE TABLE `shoppkm1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `img` text NOT NULL,
  `sm` int(11) NOT NULL DEFAULT '0',
  `exp` int(11) NOT NULL,
  `lv` int(11) NOT NULL,
  `hp` int(11) NOT NULL,
  `hpfull` int(11) NOT NULL,
  `idpkm` int(11) NOT NULL,
  `time` varchar(1024) DEFAULT NULL,
  `gia` int(11) NOT NULL DEFAULT '0',
  `check` int(11) NOT NULL DEFAULT '0',
  `tenth` text NOT NULL,
  `imgth` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO shoppkm1 VALUES("1","Charmander","http://i.imgur.com/gEN8O5y.png","1100","0","0","1500","0","1","1465104434","320","0","Charmeleon","http://i.imgur.com/PmjfCgu.png");
INSERT INTO shoppkm1 VALUES("2","Bubasaur","http://i.imgur.com/FPfoPQi.png","1000","0","0","1200","0","2","1465104575","230","0","Ivysaur","http://i.imgur.com/OqxuDG4.png");
INSERT INTO shoppkm1 VALUES("3","Scizor","http://i.imgur.com/yEMoKM8.png","1000","0","0","1800","0","3","1465104606","400","0","Scyther","http://i.imgur.com/LEQeOH4.png");
INSERT INTO shoppkm1 VALUES("4","Bayleef","http://i.imgur.com/XGgRofR.png","1500","0","0","700","0","4","1465108573","240","0","Meganium","http://i.imgur.com/xaJcUsf.png");
INSERT INTO shoppkm1 VALUES("5","Totodile","http://i.imgur.com/ZADdjwR.png","1300","0","0","1300","0","5","1465108623","300","0","Croconaw","http://i.imgur.com/P1viryk.png");
INSERT INTO shoppkm1 VALUES("6","Cyndaquil","http://i.imgur.com/RXbc2SG.png","1200","0","0","800","0","6","1465108648","200","0","Quilava","http://i.imgur.com/9rGpQGj.png");
INSERT INTO shoppkm1 VALUES("7","Pikachu","http://i.imgur.com/aM7iHIJ.png","1500","0","0","1000","0","7","1465108679","250","0","Raichu","http://i.imgur.com/7maOGvH.png");
