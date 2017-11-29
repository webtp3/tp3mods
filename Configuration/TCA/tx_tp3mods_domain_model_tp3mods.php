<?php
return [
    'ctrl' => [
        'title'	=> 'LLL:EXT:tp3mods/Resources/Private/Language/locallang_db.xlf:tx_tp3mods_domain_model_tp3mods',
        'label' => 'microdata',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
		'enablecolumns' => [
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
		'searchFields' => 'microdata,konfiguration,address',
        'iconfile' => 'EXT:tp3mods/Resources/Public/Icons/tx_tp3mods_domain_model_tp3mods.gif'
    ],
    'interface' => [
		'showRecordFieldList' => 'microdata, konfiguration, address',
    ],
    'types' => [
		'1' => ['showitem' => 'microdata, konfiguration, address, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
		'starttime' => [
            'exclude' => true,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
            ]
        ],
        'endtime' => [
            'exclude' => true,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ]
            ],
        ],
       'microdata' => [ 
	        'exclude' => true,
	        'label' => 'LLL:EXT:tp3mods/Resources/Private/Language/locallang_db.xlf:tx_tp3mods_domain_model_tp3mods.microdata',
	        'config' => [
			    'type' => 'text',
			    'cols' => 40,
			    'rows' => 15,
			    'eval' => 'trim'
			]
	    ],
	    'konfiguration' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:tp3mods/Resources/Private/Language/locallang_db.xlf:tx_tp3mods_domain_model_tp3mods.konfiguration',
	        'config' => [
			    'type' => 'text',
			    'cols' => 40,
			    'rows' => 15,
			    'eval' => 'trim'
			]
	    ],
	    'address' => [
	        'exclude' => true,
	        'label' => 'LLL:EXT:tp3mods/Resources/Private/Language/locallang_db.xlf:tx_tp3mods_domain_model_tp3mods.address',
	        'config' => [
			    'type' => 'inline',
			    'foreign_table' => '',
			    'foreign_field' => 'tp3mods',
			    'maxitems' => 9999,
			    'appearance' => [
			        'collapseAll' => 0,
			        'levelLinksPosition' => 'top',
			        'showSynchronizationLink' => 1,
			        'showPossibleLocalizationRecords' => 1,
			        'showAllLocalizationLink' => 1
			    ],
			],
	    ],
    ],
];
// Configure the default backend fields for the content element
$GLOBALS['TCA']['tt_content']['types']['tp3mods_downloads'] = array(
    'showitem' => '
         --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.general;general,
         --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.header;header,
      --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.appearance,
         --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.frames;frames,
      --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.access,
         --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.visibility;visibility,
         --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.access;access,
      --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.extended
');