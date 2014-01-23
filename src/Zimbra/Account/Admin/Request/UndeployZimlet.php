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

use Zimbra\Soap\Request;

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
class UndeployZimlet extends Request
{
    /**
     * Zimlet name
     * @var string
     */
    private $_name;

    /**
     * Action
     * @var string
     */
    private $_action;

    /**
     * Constructor method for UndeployZimlet
     * @param string $name
     * @param string $action
     * @return self
     */
    public function __construct($name, $action = null)
    {
        parent::__construct();
        $this->property('name', trim($name));
        $this->property('action', trim($action));
    }

    /**
     * Gets or sets name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->property('name');
        }
        return $this->property('name', trim($name));
    }

    /**
     * Gets or sets action
     *
     * @param  string $action
     * @return string|self
     */
    public function action($action = null)
    {
        if(null === $action)
        {
            return $this->property('action');
        }
        return $this->property('action', trim($action));
    }
}
