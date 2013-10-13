<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request\Attr;
use Zimbra\Soap\Struct\UcServiceSelector as UcService;


/**
 * UpdatePresenceSessionId class
 * Generate a new Cisco Presence server session ID and persist the newly generated session id in zimbraUCCiscoPresenceSessionId attribute for the specified UC service.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class UpdatePresenceSessionId extends Attr
{
    /**
     * The UC service
     * @var UCService
     */
    private $_ucservice;

    /**
     * App username
     * @var string
     */
    private $_username;

    /**
     * App password
     * @var string
     */
    private $_password;

    /**
     * Constructor method for UpdatePresenceSessionId
     * @param UcService $ucservice
     * @param string $username
     * @param string $password
     * @param array  $attrs
     * @return self
     */
    public function __construct(
        UcService $ucservice,
        $username,
        $password,
        array $attrs = array())
    {
        parent::__construct($attrs);
        $this->_ucservice = $ucservice;
        $this->_username = trim($username);
        $this->_password = trim($password);
    }

    /**
     * Gets or sets ucservice
     *
     * @param  UcService $ucservice
     * @return UcService|self
     */
    public function ucservice(UcService $ucservice = null)
    {
        if(null === $ucservice)
        {
            return $this->_ucservice;
        }
        $this->_ucservice = $ucservice;
        return $this;
    }

    /**
     * Gets or sets username
     *
     * @param  string $username
     * @return string|self
     */
    public function username($username = null)
    {
        if(null === $username)
        {
            return $this->_username;
        }
        $this->_username = trim($username);
        return $this;
    }

    /**
     * Gets or sets password
     *
     * @param  string $password
     * @return string|self
     */
    public function password($password = null)
    {
        if(null === $password)
        {
            return $this->_password;
        }
        $this->_password = trim($password);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'username' => $this->_username,
            'password' => $this->_password,
        );
        $this->array += $this->_ucservice->toArray();
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_ucservice->toXml());
        $this->xml->addChild('username', $this->_username);
        $this->xml->addChild('password', $this->_password);
        return parent::toXml();
    }
}
