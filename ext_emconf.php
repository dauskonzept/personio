<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Personio',
    'description' => 'TYPO3 Extension to display personio job data via XML feed',
    'category' => 'plugin',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-11.5.99',
            'php' => '7.4.0-8.0.99'
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'DSKZPT\\Personio\\' => 'Classes',
        ],
    ],
    'state' => 'stable',
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Sven Petersen',
    'author_email' => 'info@dauskonzept.de',
    'author_company' => 'Dauskonzept GmbH',
    'version' => '1.0.0'
];
