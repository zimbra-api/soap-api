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

/**
 * CheckAuthConfig request class
 * Check Auth Config.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckAuthConfig extends BaseAttr
{
    /**
     * Constructor method for CheckAuthConfig
     * @param string $name The name
     * @param string $password The password
     * @param array  $attrs
     * @return self
     */
    public function __construct($name, $password, array $attrs = [])
    {
        parent::__construct($attrs);
        $this->setProperty('name', trim($name));
        $this->setProperty('password', trim($password));
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
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
