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
use Zimbra\Soap\Request\Attr;

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
class UpdatePresenceSessionId extends Attr
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
        array $attrs = array()
    )
    {
        parent::__construct($attrs);
        $this->child('ucservice', $ucservice);
        $this->child('username', trim($username));
        $this->child('password', trim($password));
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
            return $this->child('ucservice');
        }
        return $this->child('ucservice', $ucservice);
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
            return $this->child('username');
        }
        return $this->child('username', trim($username));
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
            return $this->child('password');
        }
        return $this->child('password', trim($password));
    }
}
