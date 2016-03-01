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
 * GetYahooCookie request class
 * Get Yahoo cookie
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetYahooCookie extends Base
{
    /**
     * Constructor method for GetYahooCookie
     * @param  string $user
     * @return self
     */
    public function __construct($user)
    {
        parent::__construct();
        $this->setProperty('user', trim($user));
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
}
