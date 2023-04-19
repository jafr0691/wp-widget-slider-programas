<?php
/****************** Crear tabla con la clase wpdb *****************/
global $wpdb;

// Con esto creamos el nombre de la tabla y nos aseguramos que se cree con el mismo prefijo que ya tienen las otras tablas creadas (wp_form).
$table_programacion    = $wpdb->prefix . 'Wgt_programacion';

$sqlprograma = "CREATE TABLE $table_programacion  (
`id_programacion` int(11) NOT NULL AUTO_INCREMENT,
`programa` varchar(200) NOT NULL,
`conductores` text NOT NULL,
`enlace` text NOT NULL,
`horai` varchar(8) NOT NULL,
`horaf` varchar(8) NOT NULL,
`img` varchar(300) NOT NULL,
UNIQUE KEY id_programacion (id_programacion)

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";



// upgrade contiene la función dbDelta la cuál revisará si existe la tabla.
require_once ABSPATH . 'wp-admin/includes/upgrade.php';
// Creamos la tabla
dbDelta($sqlprograma);