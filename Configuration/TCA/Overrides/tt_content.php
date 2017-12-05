<?php
defined('TYPO3_MODE') || die();
/*
 * add contentelement to "Type" dropdown
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
    array(
            'LLL:EXT:tp3mods/Resources/Private/Language/locallang_tp3backend.xlf:tp3mods_downloads.wizard.title',
            'tp3mods_downloads',
            'EXT:tp3mods/Resources/Public/Icons/tx_tp3mods_domain_model_tp3mods.gif'
        ),
    'CType',
    'tp3mods_downloads'
);