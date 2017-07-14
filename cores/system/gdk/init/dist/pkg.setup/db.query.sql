

CREATE TABLE IF NOT EXISTS `%DBPREFIX%native_users` (
  `VERS` bigint(20) NOT NULL AUTO_INCREMENT,
  `UKEY` varchar(199) NOT NULL,
  `ACCOUNT_TYPE` int(3) NOT NULL DEFAULT '2' COMMENT '0-Visiteur | 1-Utilisateur Temporaire | 2-Utilisateur Permanent | 3-Moderateur | 4-Administrateur | 5-Super-Administrateur | 6-System',
  `USERNAME` varchar(255) NOT NULL,
  `EMAIL` text NOT NULL,
  `PHONE` varchar(64) NOT NULL,
  `PASSWORD` text NOT NULL,
  `CAPACITY` varchar(255) DEFAULT 'read:0;write:0;copy:0;share:0;update:0;cut:0;rename:0;modify:0;',
  `DECRYPKEY` text NOT NULL,
  `IDACCESS` text NOT NULL,
  `EXPIRE` bigint(20) NOT NULL DEFAULT '0',
  `ACCEPT` int(1) NOT NULL DEFAULT '0',
  `DATETIME` varchar(64) NOT NULL,
  PRIMARY KEY (`VERS`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `%DBPREFIX%native_users_identity` (
  `VERS` int(12) NOT NULL AUTO_INCREMENT,
  `UKEY` varchar(199) NOT NULL,
  `FIRSTNAME` varchar(48) NOT NULL,
  `LASTNAME` varchar(48) NOT NULL,
  `NICKNAME` varchar(32) NOT NULL,
  `SEXE` int(1) NOT NULL DEFAULT '9',
  `NAISSANCE` year(4) NOT NULL,
  `DATETIMES` datetime NOT NULL,
  `AVAILABLE` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`VERS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `%DBPREFIX%native_users_identity_active` (
  `VERS` int(11) NOT NULL AUTO_INCREMENT,
  `UKEY` text NOT NULL,
  `AKEY` text NOT NULL,
  `EXPIRE` bigint(20) NOT NULL,
  `AVAILABLE` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`VERS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

