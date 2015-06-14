<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap;

/**
 * Header context class
 *
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class HeaderContext
{
    /**
     * The auth token
     * @var string
     */
    private $_authToken;

    /**
     * The session id
     * @var string
     */
    private $_sessionId;

    /**
     * The account
     * @var string
     */
    private $_account;

    /**
     * The change
     * @var string
     */
    private $_change;

    /**
     * The target server
     * @var string
     */
    private $_targetServer;

    /**
     * The user agent
     * @var string
     */
    private $_userAgent;

    /**
     * Gets auth token
     *
     * @return string
     */
    public function getAuthToken() {
        return $this->_authToken;
    }

    /**
     * Sets auth token
     *
     * @param  string $authToken
     * @return self
     */
    public function setAuthToken($authToken) {
        $this->_authToken = $authToken;
        return $this;
    }

    /**
     * Gets session id
     *
     * @return string
     */
    public function getSessionId() {
        return $this->_sessionId;
    }

    /**
     * Sets session id
     *
     * @param  string $sessionId
     * @return self
     */
    public function setSessionId($sessionId) {
        $this->_sessionId = $sessionId;
        return $this;
    }

    /**
     * Gets account
     *
     * @return string
     */
    public function getAccount() {
        return $this->_account;
    }

    /**
     * Sets account
     *
     * @param  string $account
     * @return self
     */
    public function setAccount($account) {
        $this->_account = $account;
    }

    /**
     * Gets change
     *
     * @return string
     */
    public function getChange() {
        return $this->_change;
    }

    /**
     * Sets change
     *
     * @param  string $change
     * @return self
     */
    public function setChange($change) {
        $this->_change = $change;
        return $this;
    }

    /**
     * Gets target server
     *
     * @return string
     */
    public function getTargetServer() {
        return $this->_targetServer;
    }

    /**
     * Sets target server
     *
     * @param  string $targetServer
     * @return self
     */
    public function setTargetServer($targetServer) {
        $this->_targetServer = $targetServer;
        return $this;
    }

    /**
     * Gets user agent
     *
     * @return string
     */
    public function getUserAgent() {
        return $this->_userAgent;
    }

    /**
     * Sets user agent
     *
     * @param  string $userAgent
     * @return self
     */
    public function setUserAgent($userAgent) {
        $this->_userAgent = $userAgent;
        return $this;
    }
}
