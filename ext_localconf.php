<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
	{
        /***************
         * Make the extension configuration accessible
         */
        if (!is_array($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$extKey])) {
            $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$extKey] = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$extKey]);
        }
        $GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['bootstrap'] = 'EXT:tp3mods/Configuration/RTE/Default.yaml';

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
// Register for hook to show preview of tt_content element of CType="tp3mods_downloads" in page module
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['tp3mods_downloads'] =
            \Tp3\Tp3mods\Hooks\PageLayoutView\Downloads::class;

    //    $GLOBALS["TYPO3_CONF_VARS"]['EXTCONF']['realurl']['_DEFAULT'] = $TYPO3_CONF_VARS['EXTCONF']['realurl']['_DEFAULT'];
     //   $GLOBALS["TYPO3_CONF_VARS"]['EXTCONF']['realurl']['_DEFAULT']['pagePath']['rootpage_id'] = 0;
     //   $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['checkAlternativeIdMethods-PostProc']['realurl'] = 'Tp3\\Tp3mods\\Exception\\Error404->pageNotFound';
// wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                wizards.newContentElement.wizardItems.plugins{
                    elements {
                        tp3micro {
                            icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) . 'Resources/Public/Icons/user_plugin_tp3micro.svg
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
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
                wizards.newContentElement.wizardItems.common{
                    elements {
                        tp3mods_downloads {
                            icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) . 'Resources/Public/Icons/user_plugin_tp3micro.svg
                            title = LLL:EXT:tp3mods/Resources/Private/Language/locallang_db.xlf:tp3mods_downloads
                            description = LLL:EXT:tp3mods/Resources/Private/Language/locallang_db.xlf:tp3mods_downloads.description
                            tt_content_defValues {
                                CType = tp3mods_downloads
                                
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
