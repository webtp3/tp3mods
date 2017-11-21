<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Tp3.Tp3mods',
            'Tp3micro',
            'tp3 microdata'
        );

        if (TYPO3_MODE === 'BE') {

            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'Tp3.Tp3mods',
                'tools', // Make module a submodule of 'tools'
                'tp3backend', // Submodule key
                '', // Position
                [
                    'Tp3Mods' => 'list, show, edit, update',
                ],
                [
                    'access' => 'user,group',
					'icon'   => 'EXT:' . $extKey . '/Resources/Public/Icons/user_mod_tp3backend.svg',
                    'labels' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_tp3backend.xlf',
                ]
            );

        }

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extKey, 'Configuration/TypoScript', 'tp3 Mods');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_tp3mods_domain_model_tp3mods', 'EXT:tp3mods/Resources/Private/Language/locallang_csh_tx_tp3mods_domain_model_tp3mods.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_tp3mods_domain_model_tp3mods');

    },
    $_EXTKEY
);
