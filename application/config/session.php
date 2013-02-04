<?php
// configure the system to store sessions in the database

return array(
    'database' => array(
        'name' => 'cookie_name',
        'encrypted' => false,
        'lifetime' => 43200,
        'group' => 'default',
        'table' => 'sessions',
        'columns' => array(
            'session_id'  => 'session_id',
            'last_active' => 'last_active',
            'contents'    => 'contents'
        ),
        'gc' => 500,
    ),
);