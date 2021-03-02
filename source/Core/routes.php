<?php

    return [

        /** GET routes */
        'GET' => [

            '' => 'all',

            '/wapper:(wid)' => 'byID'
        ],

        /** POST routes */
        'POST' => [

            '/wapper' => 'create'
        ],

        /** PUT routes */
        'PUT' => [],

        /** DELETE routes */
        'DELETE' => [],
    ];
