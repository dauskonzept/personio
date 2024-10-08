<?php

(defined('TYPO3_MODE') || defined('TYPO3')) || die();

(static function () {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Personio',
        'list',
        [
            \DSKZPT\Personio\Controller\PersonioController::class => 'list',
        ],
        // non-cacheable actions
        [
            \DSKZPT\Personio\Controller\PersonioController::class => '',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Personio',
        'show',
        [
            \DSKZPT\Personio\Controller\PersonioController::class => 'show',
        ],
        // non-cacheable actions
        [
            \DSKZPT\Personio\Controller\PersonioController::class => '',
        ]
    );
})();
