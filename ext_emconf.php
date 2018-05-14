<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "tp3mods"
 *
 * Auto generated by Extension Builder 2017-11-20
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
    'title' => 'tp3 Mods',
    'description' => '',
    'category' => 'module',
    'author' => 'Thomas Ruta',
    'author_email' => 'email@thomasruta.de',
    'author_company' => 'tp3',
    'state' => 'alpha',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.10',
    'author_company' => 'tp3',
    'constraints' =>
        array (
            'depends' =>
                array (
                    'typo3' => '8.7.0-9.0.99',
                    'bootstrap_package' => '8.0.0-8.9.99',
                ),
            'conflicts' =>
                array (

                ),
            'suggests' =>
                array (
                ),
        ),
    'autoload' =>
        array (
            'psr-4' =>
                array (
                    'Tp3\\Tp3mods\\' => 'Classes',
                ),
        ),

];
