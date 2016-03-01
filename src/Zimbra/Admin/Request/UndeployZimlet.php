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
 * UndeployZimlet request class
 * Undeploy Zimlet.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class UndeployZimlet extends Base
{
    /**
     * Constructor method for UndeployZimlet
     * @param string $name Zimlet name
     * @param string $action Action
     * @return self
     */
    public function __construct($name, $action = null)
    {
        parent::__construct();
        $this->setProperty('name', trim($name));
        $this->setProperty('action', trim($action));
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
     * Gets action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->getProperty('action');
    }

    /**
     * Sets action
     *
     * @param  string $action
     * @return self
     */
    public function setAction($action)
    {
        return $this->setProperty('action', trim($action));
    }
}
