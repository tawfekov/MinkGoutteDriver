<?php

namespace Behat\Mink\Driver;

use Behat\Mink\Driver\Goutte\Client;

/*
 * This file is part of the Behat\Mink.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Goutte driver.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class GoutteDriver extends BrowserKitDriver
{
    /**
     * Initializes Goutte driver.
     *
     * @param Client $client HttpKernel client instance
     */
    public function __construct(Client $client = null)
    {
        parent::__construct($client ?: new Client());
    }

    /**
     * Sets HTTP Basic authentication parameters
     *
     * @param string|Boolean $user     user name or false to disable authentication
     * @param string         $password password
     */
    public function setBasicAuth($user, $password)
    {
        $this->getClient()->setAuth($user, $password);
    }

    /**
     * Sets specific request header on client.
     *
     * @param string $name
     * @param string $value
     */
    public function setRequestHeader($name, $value)
    {
        $this->getClient()->setHeader($name, $value);
    }

    /**
     * Returns last response headers.
     *
     * @return array
     */
    public function getResponseHeaders()
    {
        return $this->getClient()->getResponse()->getHeaders();
    }

    /**
     * {@inheritdoc}
     */
    public function getStatusCode()
    {
        return $this->getClient()->getResponse()->getStatus();
    }
     

   /**
    * Capture a screenshot of the current window.
    *
    * @throws UnsupportedDriverActionException
    */
    public function getScreenshot()
    {
        throw new UnsupportedDriverActionException('Screenshots are not supported by %s', $this);
    }

    /**
     * Attaches file path to file field located by it's XPath query.
     *
     * @param string $xpath
     * @param string $path
     */
    public function attachFile($xpath, $path)
    {
        $field = $this->getFormField($xpath);
        // a way to set raw path to the file is available from Symfony 2.2
        if (is_callable(array($field, 'setFilePath'))) {
            $field->setFilePath($path);
        } else {
            $field->setValue($path);
        }
    }

    /**
     * Prepares URL for visiting.
     *
     * @param string $url
     *
     * @return string
     */
    protected function prepareUrl($url)
    {
        return $url;
    }
}
