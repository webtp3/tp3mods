<?php
defined('TYPO3_MODE') || die();
/*
 * // Add an entry in the static template list found in sys_templates for static TS
 *
 */

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile("tp3mods", 'Configuration/TypoScript', 'tp3mods std');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile("tp3mods", 'Configuration/TypoScript/Newsletter', 'tp3mods newsletter');

