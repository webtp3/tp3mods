<?php

/*
 * This file is part of the web-tp3/tp3mods.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3_MODE') || die();
/*
 * // Add an entry in the static template list found in sys_templates for static TS
 *
 */

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('tp3mods', 'Configuration/TypoScript', 'tp3mods std');
//\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('tp3mods', 'Configuration/TypoScript/RichSnippets', 'tp3mods RichSnippets');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('tp3mods', 'Configuration/TypoScript/Newsletter', 'tp3mods newsletter');
