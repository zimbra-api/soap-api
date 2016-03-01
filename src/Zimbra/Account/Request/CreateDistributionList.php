<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Request;

/**
 * CreateDistributionList request class
 * Create a Distribution List
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateDistributionList extends BaseAttr
{
    /**
     * Constructor method for createDistributionList
     * @param  string $name    Name for the new Distribution List
     * @param  bool   $dynamic Flag type of distribution list to create
     * @param  array  $attrs   Attributes specified as key value pairs
     * @return self
     */
    public function __construct($name, $dynamic = null, array $attrs = [])
    {
        parent::__construct($attrs);
        $this->setProperty('name', trim($name));
        if(null !== $dynamic)
        {
            $this->setProperty('dynamic', (bool) $dynamic);
        }
    }

    /**
     * Gets name
     *
     * @return bool
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
     * Gets dynamic flag
     *
     * @return bool
     */
    public function getDynamic()
    {
        return $this->getProperty('dynamic');
    }

    /**
     * Sets dynamic flag
     *
     * @param  string $dynamic
     * @return self
     */
    public function setDynamic($dynamic)
    {
        return $this->setProperty('dynamic', (bool) $dynamic);
    }
}
