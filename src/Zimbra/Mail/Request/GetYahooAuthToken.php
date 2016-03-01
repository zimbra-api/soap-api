<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

/**
 * GetYahooAuthToken request class
 * Get Yahoo Auth Token
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetYahooAuthToken extends Base
{
    /**
     * Constructor method for GetYahooAuthToken
     * @param  string $user
     * @param  string $password
     * @return self
     */
    public function __construct($user, $password)
    {
        parent::__construct();
        $this->setProperty('user', trim($user));
        $this->setProperty('password', trim($password));
    }

    /**
     * Gets user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->getProperty('user');
    }

    /**
     * Sets user
     *
     * @param  string $user
     * @return self
     */
    public function setUser($user)
    {
        return $this->setProperty('user', trim($user));
    }

    /**
     * Gets password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->getProperty('password');
    }

    /**
     * Sets password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword($password)
    {
        return $this->setProperty('password', trim($password));
    }
}
