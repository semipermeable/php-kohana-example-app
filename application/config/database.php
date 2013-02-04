<?php

// override the core settings if you're not in a local development environment
if (!empty($_SERVER['HTTP_HOST']) && isset($_ENV['CRED_FILE'])) {
    // read the credentials file
    $string = file_get_contents($_ENV['CRED_FILE'], false);
    if ($string == false) {
        throw new Exception('Could not read credentials file');
    }
    // the file contains a JSON string, decode it and return an associative array
    $creds = json_decode($string, true);
    return array(
        'default' => array(
            'type'       => 'MySQL',
            'connection' => array(
                'hostname'   => $creds["MYSQLS"]["MYSQLS_HOSTNAME"],
                'username'   => $creds["MYSQLS"]["MYSQLS_USERNAME"],
                'password'   => $creds["MYSQLS"]["MYSQLS_PASSWORD"],
                'persistent' => FALSE,
                'database'   => $creds["MYSQLS"]["MYSQLS_DATABASE"],
            ),
            'table_prefix' => '',
            'charset'      => 'utf8',
            'profiling'    => TRUE,
        ),
    );
} else {
    return array(
        'default' => array(
            'type'       => 'MySQL',
            'connection' => array(
                'hostname'   => 'localhost',
                'username'   => 'local_username',
                'password'   => 'local_username',
                'persistent' => FALSE,
                'database'   => 'local_database',
            ),
            'table_prefix' => '',
            'charset'      => 'utf8',
            'profiling'    => TRUE,
        ),
    );
}