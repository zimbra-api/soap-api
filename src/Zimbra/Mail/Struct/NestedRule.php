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
 * NestedRule struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class NestedRule extends Base
{
    /**
     * Constructor method for NestedRule
     * @param FilterTests $filterTests Filter tests
     * @param FilterActions $filterActions Filter actions
     * @param NestedRule $child NestedRule child
     * @return self
     */
    public function __construct(
        FilterTests $filterTests,
        FilterActions $filterActions = NULL,
        NestedRule $child = NULL
    )
    {
        parent::__construct();
        $this->setChild('filterTests', $filterTests);
        if($filterActions instanceof FilterActions)
        {
            $this->setChild('filterActions', $filterActions);
        }
        if($child instanceof NestedRule)
        {
            $this->setChild('nestedRule', $child);
        }
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
     * Gets child
     *
     * @return NestedRule
     */
    public function getChildRule()
    {
        return $this->getChild('nestedRule');
    }

    /**
     * Sets child
     *
     * @param  NestedRule $child
     * @return self
     */
    public function setChildRule(NestedRule $child)
    {
        return $this->setChild('nestedRule', $child);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'nestedRule')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'nestedRule')
    {
        return parent::toXml($name);
    }
}
