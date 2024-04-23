<?php

(defined('TYPO3_MODE') || defined('TYPO3')) || die();

(static function() {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        'personio',
        'Configuration/TypoScript',
        'Personio'
    );
})();
