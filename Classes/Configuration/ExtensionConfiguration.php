<?php

/*
 * This file is part of the web-tp3/tp3mods.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Tp3\Tp3mods\Configuration;

/*                                                                        *
 * This script is part of the TYPO3 project - inspiring people to share!  *
 *                                                                        *
 * TYPO3 is free software; you can redistribute it and/or modify it under *
 * the terms of the GNU General Public License version 3 as published by  *
 * the Free Software Foundation.                                          *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        */

/**
 * ExtensionConfiguration.
 *
 * API to access extension configuration (ext_conf_template.txt).
 */
class ExtensionConfiguration implements \TYPO3\CMS\Core\SingletonInterface
{
    /**
     * @var string
     */
    const EXT_KEY = 'tp3mods';

    /**
     * @var array
     */
    protected $configuration = [];

    public function __construct()
    {
        if (isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][self::EXT_KEY])) {
            if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][self::EXT_KEY])) {
                $this->configuration = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][self::EXT_KEY];
            } else {
                $this->configuration = (array) unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][self::EXT_KEY]);
            }
        }
    }

    private function _get($key)
    {
        return isset($this->configuration[$key]) ? $this->configuration[$key] : null;
    }

    private function _has($key)
    {
        $value = $this->_get($key);

        return !empty($value);
    }

    private function _is($key)
    {
        $value = $this->_get($key);

        return !empty($value);
    }

    public function __call($method, $arguments)
    {
        if (method_exists($this, '_' . $method)) {
            return call_user_func_array([$this, '_' . $method], $arguments);
        }
        throw new \RuntimeException("Method $method doesn't exist", 1461958193);
    }

    public static function __callStatic($method, $arguments)
    {
        $instance = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Tp3\\Tp3mods\\Configuration\\ExtensionConfiguration');

        return call_user_func_array([$instance, $method], $arguments);
    }
}
