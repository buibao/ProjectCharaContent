<?php
$CI = get_instance();
$db = $CI->db;


$db->query("CREATE TABLE `tblconfigcall` (
  `id` int(11) NOT NULL ,
  `Ext` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Pass` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
?>