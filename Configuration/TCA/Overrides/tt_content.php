<?php

defined('TYPO3_MODE') or die();

(static function() {
   // List Plugin
   $pluginSignature = 'personio_list';
   \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
      'Personio',
      'List',
      'LLL:EXT:personio/Resources/Private/Language/locallang_be.xlf:element_' . $pluginSignature . '_title',
      'EXT:personio/Resources/Public/Icons/Extension.svg'
   );

   $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
   \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
       $pluginSignature,
       'FILE:EXT:personio/Configuration/FlexForms/List.xml'
   );

   // Show Plugin
   $pluginSignature = 'personio_show';
   \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
      'Personio',
      'Show',
       sprintf('LLL:EXT:personio/Resources/Private/Language/locallang_be.xlf:element_%s_title', $pluginSignature),
      'EXT:personio/Resources/Public/Icons/Extension.svg'
   );

   $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
   \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
       $pluginSignature,
       'FILE:EXT:personio/Configuration/FlexForms/Show.xml'
   );
})();
