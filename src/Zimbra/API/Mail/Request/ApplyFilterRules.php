<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\IdsAttr;
use Zimbra\Soap\Struct\NamedElement;
use Zimbra\Utils\TypedSequence;

/**
 * ApplyFilterRules request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ApplyFilterRules extends Request
{
    /**
     * filter rules
     * @var TypedSequence
     */
    private $_filterRule;

    /**
     * Comma-separated list of message IDs
     * @var IdsAttr
     */
    private $_m;

    /**
     * Query string
     * @var string
     */
    private $_query;

    /**
     * Constructor method for ApplyFilterRules
     * @param  array $filterRule
     * @param  IdsAttr $m
     * @param  string $query
     * @return self
     */
    public function __construct(array $filterRule = array(), IdsAttr $m = null, $query = null)
    {
        parent::__construct();
        $this->_filterRule = new TypedSequence('Zimbra\Soap\Struct\NamedElement', $filterRule);
        if($m instanceof IdsAttr)
        {
            $this->_m = $m;
        }
        $this->_query = trim($query);
    }

    /**
     * Add filterRule
     *
     * @param  NamedElement $filterRule
     * @return self
     */
    public function addFilterRule(NamedElement $filterRule)
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
     * Gets or sets m
     *
     * @param  IdsAttr $m
     * @return IdsAttr|self
     */
    public function m(IdsAttr $m = null)
    {
        if(null === $m)
        {
            return $this->_m;
        }
        $this->_m = $m;
        return $this;
    }

    /**
     * Gets or sets query
     *
     * @param  string $query
     * @return string|self
     */
    public function query($query = null)
    {
        if(null === $query)
        {
            return $this->_query;
        }
        $this->_query = trim($query);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array['filterRules'] = array();
        if(count($this->_filterRule))
        {
            $arr['filterRule'] = array();
            foreach ($this->_filterRule as $filterRule)
            {
                $ruleArr = $filterRule->toArray('filterRule');
                $arr['filterRule'][] = $ruleArr['filterRule'];
            }
            $this->array['filterRules'] = $arr;
        }
        if($this->_m instanceof IdsAttr)
        {
            $this->array += $this->_m->toArray('m');
        }
        if(!empty($this->_query))
        {
            $this->array['query'] = $this->_query;
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $filterRules = $this->xml->addChild('filterRules', null);
        foreach ($this->_filterRule as $filterRule)
        {
            $filterRules->append($filterRule->toXml('filterRule'));
        }
        if($this->_m instanceof IdsAttr)
        {
            $this->xml->append($this->_m->toXml('m'));
        }
        if(!empty($this->_query))
        {
            $this->xml->addChild('query', $this->_query);
        }
        return parent::toXml();
    }
}
