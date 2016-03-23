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
 * CreateAlwaysOnCluster request class
 * Create a AlwaysOnCluster 
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateAlwaysOnCluster extends BaseAttr
{
    /**
     * Constructor method for CreateAlwaysOnCluster
     * @param  string $name  New server name
     * @param  array $attrs Attributes
     * @return self
     */
    public function __construct($name, array $attrs = [])
    {
        parent::__construct($attrs);
        $this->setProperty('name', trim($name));
    }

    /**
     * Gets new server name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets new server name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }
}
