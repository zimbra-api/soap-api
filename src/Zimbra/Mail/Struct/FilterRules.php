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

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;

/**
 * FilterRules struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class FilterRules extends Base
{
    /**
     * Filter rules
     * @var TypedSequence<FilterRule>
     */
    private $_rules;

    /**
     * Constructor method for FilterRules
     * @param  array $rules Filter rules
     * @return self
     */
    public function __construct(array $rules = [])
    {
        parent::__construct();
        $this->setRules($rules);
        $this->on('before', function(Base $sender)
        {
            if($sender->getRules()->count())
            {
                $sender->setChild('filterRule', $sender->getRules()->all());
            }
        });
    }

    /**
     * Add a filter rule
     *
     * @param  FilterRule $filterRule
     * @return self
     */
    public function addRule(FilterRule $filterRule)
    {
        $this->_rules->add($filterRule);
        return $this;
    }

    /**
     * Sets filter rule sequence
     *
     * @param  array $rules
     * @return self
     */
    public function setRules(array $rules)
    {
        $this->_rules = new TypedSequence('Zimbra\Mail\Struct\FilterRule', $rules);
        return $this;
    }

    /**
     * Gets filter rule sequence
     *
     * @return Sequence
     */
    public function getRules()
    {
        return $this->_rules;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'filterRules')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'filterRules')
    {
        return parent::toXml($name);
    }
}
