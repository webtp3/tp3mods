<?php
declare(strict_types=1);

/*
 * This file is part of the web-tp3/tp3mods.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace Tp3\Tp3mods\ErrorHandling\Error;

use TYPO3\CMS\Core\Error\ErrorHandlerInterface;
use TYPO3\CMS\Core\Error\Exception;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Alternative error handler for TYPO3
 *
 * Taken from Helmut Hummel's great TYPO3 dist package
 * @see https://github.com/helhum/TYPO3-Distribution
 */
class ErrorHandler implements ErrorHandlerInterface
{
    /**
     * Error levels which should result in an exception thrown.
     *
     * @var array
     */
    protected $exceptionalErrors = [];

    /**
     * Registers this class as default error handler
     *
     * @param int $errorHandlerErrors The integer representing the E_* error level which should be
     */
    public function __construct($errorHandlerErrors)
    {
        $excludedErrors = E_COMPILE_WARNING | E_COMPILE_ERROR | E_CORE_WARNING | E_CORE_ERROR | E_PARSE | E_ERROR;
        // reduces error types to those a custom error handler can process
        $errorHandlerErrors = $errorHandlerErrors & ~$excludedErrors;
        set_error_handler([$this, 'handleError'], $errorHandlerErrors);
    }

    /**
     * Defines which error levels should result in an exception thrown.
     *
     * @param int $exceptionalErrors The integer representing the E_* error level to handle as exceptions
     * @return void
     */
    public function setExceptionalErrors($exceptionalErrors)
    {
        $this->exceptionalErrors = (int)$exceptionalErrors;
    }

    /**
     * Handles an error.
     * If the error is registered as exceptionalError it will by converted into an exception, to be handled
     * by the configured exceptionhandler. Additionally the error message is written to the configured logs.
     * If TYPO3_MODE is 'BE' the error message is also added to the flashMessageQueue, in FE the error message
     * is displayed in the admin panel (as TsLog message)
     *
     * @param int $errorLevel The error level - one of the E_* constants
     * @param string $errorMessage The error message
     * @param string $errorFile Name of the file the error occurred in
     * @param int $errorLine Line number where the error occurred
     * @throws Exception with the data passed to this method if the error is registered as exceptionalError
     * @throws \Exception with the data passed to this method if the error is registered as exceptionalError
     * @return bool
     */
    public function handleError($errorLevel, $errorMessage, $errorFile, $errorLine)
    {
        // Don't do anything if error_reporting is disabled by an @ sign
        if (error_reporting() === 0) {
            return true;
        }
        $errorLevels = [
            E_WARNING => 'Warning',
            E_NOTICE => 'Notice',
            E_USER_ERROR => 'User Error',
            E_USER_WARNING => 'User Warning',
            E_USER_NOTICE => 'User Notice',
            E_STRICT => 'Runtime Notice',
            E_RECOVERABLE_ERROR => 'Catchable Fatal Error',
            E_DEPRECATED => 'Runtime Deprecation Notice',
        ];
        $message = 'PHP ' . $errorLevels[$errorLevel] . ': ' . $errorMessage . ' in ' . $errorFile . ' line ' . $errorLine;
        if ($errorLevel & $this->exceptionalErrors) {
            throw new Exception($message, 1);
        }
        switch ($errorLevel) {
            case E_USER_ERROR:
            case E_RECOVERABLE_ERROR:
                $severity = 2;
                break;
            case E_USER_WARNING:
            case E_WARNING:
                $severity = 1;
                break;
            default:
                $severity = 0;
        }
        $logTitle = 'Core: Error handler (' . TYPO3_MODE . ')';
        $message = $logTitle . ': ' . $message;
        GeneralUtility::sysLog($message, 'core', $severity + 1);
        return true;
    }
}
