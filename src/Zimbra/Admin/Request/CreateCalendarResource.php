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
 * CreateCalendarResource request class
 * Create a calendar resource.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateCalendarResource extends BaseAttr
{
    /**
     * Constructor method for CreateCalendarResource
     * @param string $name The name
     * @param string $password The password
     * @param array  $attrs
     * @return self
     */
    public function __construct($name = null, $password = null, array $attrs = [])
    {
        parent::__construct($attrs);
        if(null !== $name)
        {
            $this->setProperty('name', trim($name));
        }
        if(null !== $password)
        {
            $this->setProperty('password', trim($password));
        }
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
