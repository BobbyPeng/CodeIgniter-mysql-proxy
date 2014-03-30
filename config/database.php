<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default_master';
$active_record = TRUE;

$_master_slave_relation = array(
    'default_master' => array('default_slave'),
);

$db['default_master']['hostname'] = '127.0.0.1';
$db['default_master']['username'] = 'root';
$db['default_master']['password'] = '123456';
$db['default_master']['database'] = 'test';
$db['default_master']['dbdriver'] = 'mysql';
$db['default_master']['dbprefix'] = '';
$db['default_master']['pconnect'] = FALSE;
$db['default_master']['db_debug'] = FALSE;
$db['default_master']['cache_on'] = FALSE;
$db['default_master']['cachedir'] = '';
$db['default_master']['char_set'] = 'utf8';
$db['default_master']['dbcollat'] = 'utf8_general_ci';
$db['default_master']['swap_pre'] = '';
$db['default_master']['autoinit'] = FALSE;
$db['default_master']['stricton'] = FALSE;

$db['default_slave']['hostname'] = '127.0.0.1';
$db['default_slave']['username'] = 'root';
$db['default_slave']['password'] = '123456';
$db['default_slave']['database'] = 'test_slave';
$db['default_slave']['dbdriver'] = 'mysql';
$db['default_slave']['dbprefix'] = '';
$db['default_slave']['pconnect'] = FALSE;
$db['default_slave']['db_debug'] = FALSE;
$db['default_slave']['cache_on'] = FALSE;
$db['default_slave']['cachedir'] = '';
$db['default_slave']['char_set'] = 'utf8';
$db['default_slave']['dbcollat'] = 'utf8_general_ci';
$db['default_slave']['swap_pre'] = '';
$db['default_slave']['autoinit'] = FALSE;
$db['default_slave']['stricton'] = FALSE;


/* End of file database.php */
/* Location: ./application/config/database.php */