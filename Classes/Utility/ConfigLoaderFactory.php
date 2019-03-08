<?php
namespace Tp3\Tp3mods\Utility;

/**
 * Class ConfigLoaderFactory
 *
 * Taken from Helmut Hummel's great work for the php dotenv way of add env config
 * @see https://github.com/helhum/TYPO3-Distribution
 *
 *
 */
class ConfigLoaderFactory
{
    /**
     * @param string $context
     * @param string $rootDir
     * @param array $additionalFileWatches
     * @param string $fixedCacheIdentifier
     * @return \Helhum\ConfigLoader\CachedConfigurationLoader
     */
    public static function buildLoader($context, $rootDir, $fixedCacheIdentifier = null, array $additionalFileWatches = array()) {

        $confDir = $rootDir . '../web/typo3conf/ext/tmpl/Configuration/Typo3ConfVars/'; // add trailing slash!
        $cacheDir = $rootDir . '/build/var/cache';
        $contextConfFile = ucfirst($context) . '.php'; // eg. Development.php, Production.php
        $defaultConfFile = 'Default.php';
        $overrideConfFile = 'Override.php';

        if ($fixedCacheIdentifier) {
            // Freeze configuration with fixed identifier if requested
            $cacheIdentifier = $fixedCacheIdentifier;
        } else {
            $fileWatches = array_merge(
                [
                    $rootDir . '../web/typo3conf/LocalConfiguration.php',
                    $rootDir . '../web/typo3conf/AdditionalConfiguration.php',
                    $rootDir . '/.env',
                    $confDir . $defaultConfFile,
                    $confDir . $contextConfFile,
                    $confDir . $overrideConfFile
                ],
                $additionalFileWatches
            );
            $cacheIdentifier = self::getCacheIdentifier($context, $fileWatches);
        }
        return new \Helhum\ConfigLoader\CachedConfigurationLoader
        (
            $cacheDir,
            $cacheIdentifier,
            function() use ($confDir, $defaultConfFile, $contextConfFile, $overrideConfFile) {
                return new \Helhum\ConfigLoader\ConfigurationLoader(
                    array(
                        new \Helhum\ConfigLoader\Reader\PhpFileReader($confDir . $defaultConfFile),
                        new \Helhum\ConfigLoader\Reader\PhpFileReader($confDir . $contextConfFile),
                        new \Helhum\ConfigLoader\Reader\EnvironmentReader('TYPO3'),
                        new \Helhum\ConfigLoader\Reader\PhpFileReader($confDir . $overrideConfFile),
                    )
                );
            }
        );
    }

    /**
     * @param string $context
     * @param array $fileWatches
     * @return string
     */
    protected static function getCacheIdentifier($context, array $fileWatches = array())
    {
        $identifier = $context;
        foreach ($fileWatches as $fileWatch) {
            if (file_exists($fileWatch)) {
                $identifier .= filemtime($fileWatch);
            }
        }
        return md5($identifier);
    }
}
