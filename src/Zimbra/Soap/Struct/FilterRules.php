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
use Zimbra\Utils\TypedSequence;

/**
 * FilterRules struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class FilterRules
{
    /**
     * Filter rule
     * @var TypedSequence<FilterRule>
     */
    private $_filterRule;

    /**
     * Constructor method for FilterRules
     * @param  array $FilterRule
     * @return self
     */
    public function __construct(array $FilterRule = array())
    {
        $this->_filterRule = new TypedSequence('Zimbra\Soap\Struct\FilterRule', $FilterRule);
    }

    /**
     * Add a filter rule
     *
     * @param  FilterRule $filterRule
     * @return self
     */
    public function addFilterRule(FilterRule $filterRule)
    {
        $this->_filterRule->add($filterRule);
        return $this;
    }

    /**
     * Gets filter rule sequence
     *
     * @return Sequence
     */
    public function filterRule()
    {
        return $this->_filterRule;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'filterRules')
    {
        $name = !empty($name) ? $name : 'filterRules';
        $arr = array();
        if(count($this->_filterRule))
        {
            $arr['filterRule'] = array();
            foreach ($this->_filterRule as $filterRule)
            {
                $filterRuleArr = $filterRule->toArray('filterRule');
                $arr['filterRule'][] = $filterRuleArr['filterRule'];
            }
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'filterRules')
    {
        $name = !empty($name) ? $name : 'filterRules';
        $xml = new SimpleXML('<'.$name.' />');
        foreach ($this->_filterRule as $filterRule)
        {
            $xml->append($filterRule->toXml('filterRule'));
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
