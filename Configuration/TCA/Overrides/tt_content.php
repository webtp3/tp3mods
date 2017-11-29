<?php
defined('TYPO3_MODE') || die();
/*
 * add contentelement to "Type" dropdown
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
    array(
            'LLL:EXT:tp3mods/Resources/Private/Language/Tca.xlf:tp3mods_downloads',
            'tp3mods_downloads',
            'EXT:tp3mods/Resources/Public/Icons/tx_tp3mods_domain.model_tp3mods.gif'
        ),
    'CType',
    'tp3mods_downloads'
);