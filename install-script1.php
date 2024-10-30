<?php
global $wpdb;
//1. create sendmail_lordlinus table
$AppointmentsTableName = "sendmail_lordlinus";
$AppointmentsTable_sql = "CREATE TABLE IF NOT EXISTS `$AppointmentsTableName` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) NOT NULL,
  `subject` text NOT NULL,
  `body` text NOT NULL,
  `sent` varchar(200) NOT NULL,
   PRIMARY KEY (`id`)
);";
$wpdb->query($AppointmentsTable_sql); 
?>