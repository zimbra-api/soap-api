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
 * CreateDistributionList request class
 * Create a distribution list.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateDistributionList extends BaseAttr
{
    /**
     * Constructor method for CreateDistributionList
     * @param string $name Name for distribution list
     * @param bool   $dynamic If 1 (true) then create a dynamic distribution list
     * @param array  $attrs
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
     * Gets dynamic
     *
     * @return bool
     */
    public function getDynamic()
    {
        return $this->getProperty('dynamic');
    }

    /**
     * Sets dynamic
     *
     * @param  bool $dynamic
     * @return self
     */
    public function setDynamic($dynamic)
    {
        return $this->setProperty('dynamic', (bool) $dynamic);
    }
}
