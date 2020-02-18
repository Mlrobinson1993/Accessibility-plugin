<?php

/**
 * Plugin Name
 *
 * @package           myPLuginPractice
 * @author            Michael Robinson
 * @copyright         2019 MRobinsonWebDev
 * @license           GPL-2.0-or-later
 *
 * */

namespace PluginConfig\Data;

class APIData {

function __construct(){
}


public function register(){
    $this->setParams();
    $this->curlConfig();
    $this->getData();
}

function setParams(){
    $siteURL = get_site_url();
    $textMatch = 'localhost';
    $numMatch = '127.0.0.1';

    if(strpos($siteURL, $textMatch) !== false || strpos($siteURL, $numMatch) !== false){
        var_dump('NOT AVILABLE FOR LOCALHOST');
        return false;
    } else {
        var_dump('WE ARE ONLINE');
        $opts['key'] = 'd09209ba558bb0999d3dcaa235cb2484';
        $opts['url'] = $siteURL;
    }
}


function curlConfig(){
    // open connection
    $ch = curl_init();
    // set our curl options
    curl_setopt($ch, CURLOPT_URL, 'https://tenon.io/api/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $opts);
}

function getData(){
    //execute post and get results
    $result = curl_exec($ch);
    $this->closeConnection();
    //this convers the JSON API response to a PHP array
    $result = json_decode($result, true);


    return $result;
}

function closeConnection(){
    //close connection
    curl_close($ch);
}
}

//now do something useful with the array of data
if( class_exists('APIData'))
{
    $DATA = new APIData();
}