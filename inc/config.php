<?php

// PHP Grid database connection settings, Only need to update these in new project

define("PHPGRID_DBTYPE","sqlsrv"); // mysql,oci8(for oracle),mssql,postgres,sybase
define("PHPGRID_DBHOST","VHAMSQL10SVR");
define("PHPGRID_DBUSER",null);
define("PHPGRID_DBPASS",null);
// define("PHPGRID_DBUSER","dmonzon@auxiliomutuo.com");
// define("PHPGRID_DBPASS","Salud@2023");
define("PHPGRID_DBNAME","WebReports");

// $db_conf = array();
// $db_conf["type"] = "mssqlnative";
// $db_conf["server"] = "VHAMSQL10SVR";
// $db_conf["user"] = null;
// $db_conf["password"] = null;
// $db_conf["database"] = "WebReports";

// $g = new jqgrid($db_conf);

// $g->table = "[msdb].[dbo].[syscategories]";
// Basepath for lib
define("PHPGRID_LIBPATH",dirname(__FILE__).DIRECTORY_SEPARATOR."inc".DIRECTORY_SEPARATOR);