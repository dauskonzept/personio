<?php

(defined('TYPO3_MODE') || defined('TYPO3')) || die();

(static function() {
   // List Plugin
   \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
      'Personio',
      'List',
      'LLL:personio.be:element_personio_list_title',
      'EXT:personio/Resources/Public/Icons/Extension.svg',
      'plugins',
      '',
      'FILE:EXT:personio/Configuration/FlexForms/List.xml'
   );

   // Show Plugin
   \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
      'Personio',
      'Show',
      'LLL:personio.be:element_personio_show_title',
      'EXT:personio/Resources/Public/Icons/Extension.svg',
      'plugins',
      '',
      'FILE:EXT:personio/Configuration/FlexForms/Show.xml'
   );
})();
