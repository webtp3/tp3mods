<?php
namespace Tp3\Tp3mods\Controller;

/***
 *
 * This file is part of the "tp3 Mods" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2017 Thomas Ruta &lt;email@thomasruta.de&gt;, R&amp;P IT Consulting GmbH
 *
 ***/

/**
 * Tp3AbstractController
 */
abstract class Tp3AbstractController extends \TYPO3\CMS\Extbase\Mvc\Controller\AbstractController
{
    /**
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     *
     */

    protected $persistenceManager;


    /**
     *
     * @var \TYPO3\CMS\Core\Page\PageRenderer
     */

    protected $pageRenderer;

    /**
    /**
     *
     * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
     */
    protected  $cObjRenderer;

    /**
     * @var string
     */
    protected $entityNotFoundMessage = 'The requested entity could not be found.';

    /**
     * @var string
     */
    protected $unknownErrorMessage = 'An unknown error occurred. The wild monkey horde in our basement will try to fix this as soon as possible.';

    /**
     * Initializes the current action
     *
     * @return void
     */
    public function initializeAction()
    {
        $this->setDefaultViewVars();

        //$this->Div = new Tp3Eid();
    }
    /**
     * @param \TYPO3\CMS\Extbase\Mvc\RequestInterface $request
     * @param \TYPO3\CMS\Extbase\Mvc\ResponseInterface $response
     *  @return void
     * @throws \Exception
     * @override \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
     */
    public function processRequest(\TYPO3\CMS\Extbase\Mvc\RequestInterface $request, \TYPO3\CMS\Extbase\Mvc\ResponseInterface $response) {
     /*   if (count($request->getArguments())> 0 &&  $request->getArgument("eID") == "rating" && $request->hasArgument("ratingdata") ) {
            //&& $this->resolveActionMethodName() == "ratingAction"
            $data_str = $request->getArgument("ratingdata");
            $request->SetArgument("ratingdata", unserialize(base64_decode($data_str)));
            if($request->hasArgument("check"))$request->SetArgument("check",$request->getArgument("check"));
        }*/
        try {
            parent::processRequest($request, $response);
        }
        catch(\TYPO3\CMS\Extbase\Property\Exception $e) {
            if ($e->getPrevious() instanceof \TYPO3\CMS\Extbase\Property\Exception\InvalidPropertyException) {
                $GLOBALS['TSFE']->pageNotFoundAndExit('kaputt.');
            } else {
                throw $e;
            }
        }
    }
    /**
     * @return void
     * @override \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
     */
    protected function callActionMethod() {
        try {
            parent::callActionMethod();
        }
        catch(\Exception $exception) {
            // This enables you to trigger the call of TYPO3s page-not-found handler by throwing \TYPO3\CMS\Core\Error\Http\PageNotFoundException
            if ($exception instanceof \TYPO3\CMS\Core\Error\Http\PageNotFoundException) {
                $GLOBALS['TSFE']->pageNotFoundAndExit($this->entityNotFoundMessage);
            }

            // $GLOBALS['TSFE']->pageNotFoundAndExit has not been called, so the exception is of unknown type.
            //  \Tp3\Tp3ratings\Logger\ExceptionLogger::log($exception, $this->request->getControllerExtensionKey(), \VendorName\ExtensionName\Logger\ExceptionLogger::SEVERITY_FATAL_ERROR);
            // If the plugin is configured to do so, we call the page-unavailable handler.
            if (isset($this->settings['usePageUnavailableHandler']) && $this->settings['usePageUnavailableHandler']) {
                $GLOBALS['TSFE']->pageUnavailableAndExit($this->unknownErrorMessage, 'HTTP/1.1 500 Internal Server Error');
            }
            // Else we append the error message to the response. This causes the error message to be displayed inside the normal page layout. WARNING: the plugins output may gets cached.
            if ($this->response instanceof \TYPO3\CMS\Extbase\Mvc\Web\Response) {
                $this->response->setStatus(500);
            }
            $this->response->appendContent($this->unknownErrorMessage);
        }
    }
    /**
     * This method assigns some default variables to the view
     */
    private function setDefaultViewVars() {
        if (\TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getExtensionVersion('extbase')) >= 1003000) {
            $cObjData = $this->configurationManager->getContentObject()->data;
        } else {
            $cObjData = $this->request->getContentObjectData();
        }
        //   $this->conf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']["tx_".strtolower($this->extKey)]);
        //	$this->layout = $this->settings["layout"] ? $this->settings["layout"] : "style05";
        $this->cObjRenderer = new \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer();
        $configurationManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
        $this->conf = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $this->pageRenderer = $this->objectManager->get('TYPO3\\CMS\\Core\\Page\\PageRenderer');

    }
    /**
     * action translate
     *
     * @return string
     */

    private function gettranslation($key){
        //$extensionName = "Tp3share";
        $trans = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate( $key, $this->extKey);
        return $trans != "" ? $trans : "keine translation";
    }
}
