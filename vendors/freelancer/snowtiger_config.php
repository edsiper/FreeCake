<?php
/*
WARNING: Modify the file must be saved as no BOM header file
*/

require("config.php");

//Set the data environment
//true: sandbox environment ;false: formal environment
$apiConfig['TestMode'] = $fl_test_mode;

//Your Consumer Token
$apiConfig['ConsumerToken'] = $fl_consumer_token;
//Your Consumer Secret
$apiConfig['ConsumerSecret'] = $fl_consumer_secret;
//Callback url
$apiConfig['CallBack'] = $fl_callback;

//result format xml/json
$apiConfig['Format'] = 'xml';

//Set the signature method,only support hmac now
$apiConfig['SignMethod'] = 'hmac';

//Turn on or off the error tips
//True: turn off ;False: turn on
$apiConfig['CloseError'] = false;

//Turn on or off the API call logs
//True: turn on ;False: turn off
$apiConfig['ApiLog'] = false;

//Turn on or off the error logs
//True: turn on ;False: turn off
$apiConfig['Errorlog'] = false;

//Set the number of retries when failed to call the API
//This can improve the stability of API
$apiConfig['RestNumberic'] = 3;

/***************************************
 *http connection config
 **************************************/
// Set connect timeout
$apiConfig['connecttimeout'] = 30;
// Set timeout default
$apiConfig['timeout'] = 30;
//Set the useragnet
$apiConfig['useragent'] = 'AzulNews.com - SnowTigerLib v0.1';

return $apiConfig;
