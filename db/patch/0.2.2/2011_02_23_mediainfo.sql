DROP TABLE IF EXISTS `releasefiles`;
CREATE TABLE `releasefiles` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `releaseID` INT(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NULL,
  `size` BIGINT UNSIGNED NOT NULL DEFAULT '0',
  `createddate` DATETIME DEFAULT NULL,
  `passworded` tinyint(1) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE INDEX ix_releasefiles_releaseID ON releasefiles (`releaseID`);
CREATE INDEX ix_releasefiles_name ON releasefiles (`name`);

DROP TABLE IF EXISTS `releaseextra`;
CREATE TABLE `releaseextra` (
  `releaseID` INT(11) UNSIGNED NOT NULL,
  `containerformat` varchar(50) COLLATE utf8_unicode_ci NULL,
  `overallbitrate` varchar(20) COLLATE utf8_unicode_ci NULL,
  `videoduration` varchar(20) COLLATE utf8_unicode_ci NULL,
  `videoformat` varchar(50) COLLATE utf8_unicode_ci NULL, 
  `videocodec` varchar(50) COLLATE utf8_unicode_ci NULL, 
  `videowidth` int(10) NULL, 
  `videoheight` int(10) NULL,
  `videoaspect` varchar(10) COLLATE utf8_unicode_ci NULL, 
  `videoframerate` float(7,4) NULL,
  `videolibrary` varchar(50) NULL,
  `audioformat` varchar(50) COLLATE utf8_unicode_ci NULL,
  `audiomode` varchar(50) COLLATE utf8_unicode_ci NULL,
  `audiobitratemode` varchar(50) COLLATE utf8_unicode_ci NULL,
  `audiobitrate` varchar(10) COLLATE utf8_unicode_ci NULL,
  `audiochannels` varchar(25) COLLATE utf8_unicode_ci NULL,
  `audiosamplerate` varchar(25) COLLATE utf8_unicode_ci NULL, 
  `audiolibrary` varchar(50) COLLATE utf8_unicode_ci NULL, 
  PRIMARY KEY (`releaseID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;

DROP TABLE IF EXISTS `releaseextrafull`;
CREATE TABLE `releaseextrafull` (
  `releaseID` INT(11) UNSIGNED NOT NULL,
  `mediainfo` TEXT NULL,
  PRIMARY KEY (`releaseID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;