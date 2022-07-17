<?php
global $wpdb; 
$table_name = $wpdb->prefix . "gcz_order";
if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name){
    $sql = "CREATE TABLE " . $table_name . "(
            `gcz_id`      bigint(20)      NOT NULL AUTO_INCREMENT,
            `gcz_name`    varchar(255)    CHARACTER SET utf8 NOT NULL,
            `gcz_money`   varchar(255)    CHARACTER SET utf8 NOT NULL,
            `gcz_order`   varchar(255)    CHARACTER SET utf8 NOT NULL,
            `gcz_status`  int(1)          NOT NULL DEFAULT '1',
            `gcz_time`    varchar(255)    NOT NULL DEFAULT '0000-00-00 00:00:00',
            `gcz_user`    varchar(255)    CHARACTER SET utf8 NOT NULL,
            `gcz_xunhuid` varchar(255)    CHARACTER SET utf8 NOT NULL,
            `gcz_type`    varchar(255)    CHARACTER SET utf8 NOT NULL,
            PRIMARY KEY (`gcz_id`),
            UNIQUE KEY `gcz_id` (`gcz_id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
    ";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}