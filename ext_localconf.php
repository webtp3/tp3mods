<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
	{

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Tp3.Tp3mods',
            'Tp3micro',
            [
                'Tp3Mods' => 'list, show, edit, update'
            ],
            // non-cacheable actions
            [
                'Tp3Mods' => 'update'
            ]
        );

	// wizards
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
		'mod {
			wizards.newContentElement.wizardItems.plugins {
				elements {
					tp3micro {
						icon = &#039; . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) . &#039;Resources/Public/Icons/user_plugin_tp3micro.svg
						title = LLL:EXT:tp3mods/Resources/Private/Language/locallang_db.xlf:tx_tp3mods_domain_model_tp3micro
						description = LLL:EXT:tp3mods/Resources/Private/Language/locallang_db.xlf:tx_tp3mods_domain_model_tp3micro.description
						tt_content_defValues {
							CType = list
							list_type = tp3mods_tp3micro
						}
					}
				}
				show = *
			}
	   }'
	);
    },
    $_EXTKEY
);
