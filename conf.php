<?php
/* Configure application settings here. 
 * - Debug mode set on or off
 * - Logging level and function to call to log
*/
if (!defined('DEBUG_MODE')) define('DEBUG_MODE', true);


define('LOG_LVL_DEBUG', 4);
define('LOG_LVL_VERBOSE', 3);
define('LOG_LVL_INFO',  2);
define('LOG_LVL_WARN',  1);
define('LOG_LVL_ERROR', 0);

if (!defined('CURRENT_LOG_LEVEL')) define('CURRENT_LOG_LEVEL', DEBUG_MODE ? LOG_LVL_DEBUG : LOG_LVL_INFO);

function internal_error(){
	header('HTTP/1.1 503 Service Unavailable');
	die('Internal Error' . PHP_EOL);
}

function logMessage ($message, $level) {
	if(CURRENT_LOG_LEVEL >= $level ) {
		if(is_array($message) || is_object($message)) $message = print_r($message, 1);
		error_log($message);
	}
}

logMessage("Configuration Loaded", LOG_LVL_DEBUG);
logMessage("Current log level is: " . CURRENT_LOG_LEVEL, LOG_LVL_DEBUG);

//TODO: Later on, if apc cache used, cache conf so to avoid I.O.

if (!defined('CONFIG_FILE_PATH')) define('CONFIG_FILE_PATH', dirname(__FILE__) . '/conf.json');

$confFileContents = @file_get_contents(CONFIG_FILE_PATH);

if ($confFileContents === FALSE) {
	logMessage("Could not open configuration file. Please check CONFIG_FILE_PATH", LOG_LVL_ERROR);
	internal_error();
}

$configuration = json_decode($confFileContents);

if (!defined('DB_HOST')) define('DB_HOST', $configuration->database->host);
if (!defined('DB_NAME')) define('DB_NAME', $configuration->database->name);
if (!defined('DB_USER')) define('DB_USER', $configuration->database->user);
if (!defined('DB_PASS')) define('DB_PASS', $configuration->database->pass);

//TODO: Could connect to database and verify defines here, but that can come later

/* Destroy sensitive variables, only defines should be used from here out */
unset($confFileContents);
unset($configuration);