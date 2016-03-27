<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Struct\Base;

/**
 * FilterRule struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class FilterRule extends Base
{
    /**
     * Constructor method for FilterRule
     * @param string $name Rule name
     * @param bool $active Active flag. Set by default.
     * @param FilterTests $filterTests Filter tests
     * @param FilterActions $filterActions Filter actions
     * @return self
     */
    public function __construct(
        $name,
        $active,
        FilterTests $filterTests,
        FilterActions $filterActions = NULL
    )
    {
        parent::__construct();
        $this->setProperty('name', trim($name));
        $this->setProperty('active', (bool) $active);
        $this->setChild('filterTests', $filterTests);
        if($filterActions instanceof FilterActions)
        {
            $this->setChild('filterActions', $filterActions);
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
     * Gets active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->getProperty('active');
    }

    /**
     * Sets active
     *
     * @param  bool $active
     * @return self
     */
    public function setActive($active)
    {
        return $this->setProperty('active', (bool) $active);
    }

    /**
     * Gets filter tests
     *
     * @return FilterTests
     */
    public function getFilterTests()
    {
        return $this->getChild('filterTests');
    }

    /**
     * Sets filter tests
     *
     * @param  FilterTests $filterTests
     * @return self
     */
    public function setFilterTests(FilterTests $filterTests)
    {
        return $this->setChild('filterTests', $filterTests);
    }

    /**
     * Gets filter actions
     *
     * @return FilterActions
     */
    public function getFilterActions()
    {
        return $this->getChild('filterActions');
    }

    /**
     * Sets filter actions
     *
     * @param  FilterActions $filterActions
     * @return self
     */
    public function setFilterActions(FilterActions $filterActions)
    {
        return $this->setChild('filterActions', $filterActions);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'filterRule')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'filterRule')
    {
        return parent::toXml($name);
    }
}
