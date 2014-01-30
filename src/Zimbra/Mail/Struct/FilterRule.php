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
     * Constructor method for FilterActions
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
        $this->property('name', trim($name));
        $this->property('active', (bool) $active);
        $this->child('filterTests', $filterTests);
        if($filterActions instanceof FilterActions)
        {
            $this->child('filterActions', $filterActions);
        }
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
     * Gets or sets active
     *
     * @param  bool $active
     * @return bool|self
     */
    public function active($active = null)
    {
        if(null === $active)
        {
            return $this->property('active');
        }
        return $this->property('active', (bool) $active);
    }

    /**
     * Gets or sets filterTests
     *
     * @param  FilterTests $filterTests
     * @return FilterTests|self
     */
    public function filterTests(FilterTests $filterTests = null)
    {
        if(null === $filterTests)
        {
            return $this->child('filterTests');
        }
        return $this->child('filterTests', $filterTests);
    }

    /**
     * Gets or sets filterActions
     *
     * @param  FilterActions $filterActions
     * @return FilterActions|self
     */
    public function filterActions(FilterActions $filterActions = null)
    {
        if(null === $filterActions)
        {
            return $this->child('filterActions');
        }
        return $this->child('filterActions', $filterActions);
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
