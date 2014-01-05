<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * FilterRule struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class FilterRule
{
	/**
	 * Rule name
	 * @var string
	 */
    private $_name;

	/**
	 * Active flag. Set by default.
	 * @var bool
	 */
    private $_active;

	/**
	 * Filter tests
	 * @var KeepAction
	 */
    private $_filterTests;

	/**
	 * Filter actions
	 * @var FilterActions
	 */
    private $_filterActions;

    /**
     * Constructor method for FilterActions
     * @param string $name
     * @param bool $active
     * @param FilterTests $filterTests
     * @param FilterActions $filterActions
     * @return self
     */
    public function __construct(
        $name,
        $active,
        FilterTests $filterTests,
        FilterActions $filterActions = NULL
    )
    {
    	$this->_name = trim($name);
    	$this->_active = (bool) $active;
        $this->_filterTests = $filterTests;
        if($filterActions instanceof FilterActions)
        {
            $this->_filterActions = $filterActions;
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
            return $this->_name;
        }
        $this->_name = trim($name);
        return $this;
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
            return $this->_active;
        }
        $this->_active = (bool) $active;
        return $this;
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
            return $this->_filterTests;
        }
        $this->_filterTests = $filterTests;
        return $this;
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
            return $this->_filterActions;
        }
        $this->_filterActions = $filterActions;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'filterRule')
    {
        $name = !empty($name) ? $name : 'filterRule';
        $arr = array(
        	'name' => $this->_name,
        	'active' => $this->_active ? 1 : 0,
    	);
        $arr += $this->_filterTests->toArray('filterTests');
        if($this->_filterActions instanceof FilterActions)
        {
            $arr += $this->_filterActions->toArray('filterActions');
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'filterRule')
    {
        $name = !empty($name) ? $name : 'filterRule';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('name', $this->_name)
            ->addAttribute('active', $this->_active ? 1 : 0)
            ->append($this->_filterTests->toXml('filterTests'));
        if($this->_filterActions instanceof FilterActions)
        {
            $xml->append($this->_filterActions->toXml('filterActions'));
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
