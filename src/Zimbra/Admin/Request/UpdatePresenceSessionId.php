<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Admin\Struct\UcServiceSelector as UcService;

/**
 * UpdatePresenceSessionId reqeust class
 * Generate a new Cisco Presence server session ID and persist the newly generated session id in zimbraUCCiscoPresenceSessionId attribute for the specified UC service.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class UpdatePresenceSessionId extends BaseAttr
{
    /**
     * Constructor method for UpdatePresenceSessionId
     * @param UcService $ucservice The UC service
     * @param string $username App username
     * @param string $password App password
     * @param array  $attrs
     * @return self
     */
    public function __construct(
        UcService $ucservice,
        $username,
        $password,
        array $attrs = []
    )
    {
        parent::__construct($attrs);
        $this->setChild('ucservice', $ucservice);
        $this->setChild('username', trim($username));
        $this->setChild('password', trim($password));
    }

    /**
     * Gets the ucservice.
     *
     * @return UcService
     */
    public function getUcService()
    {
        return $this->getChild('ucservice');
    }

    /**
     * Sets the ucservice.
     *
     * @param  UcService $ucservice
     * @return self
     */
    public function setUcService(UcService $ucservice)
    {
        return $this->setChild('ucservice', $ucservice);
    }

    /**
     * Gets username
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->getChild('username');
    }

    /**
     * Sets username
     *
     * @param  string $username
     * @return self
     */
    public function setUserName($username)
    {
        return $this->setChild('username', trim($username));
    }

    /**
     * Gets password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->getChild('password');
    }

    /**
     * Sets password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword($password)
    {
        return $this->setChild('password', trim($password));
    }
}
