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
use Zimbra\Struct\NamedElement;

/**
 * NamedFilterRules struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class NamedFilterRules extends Base
{
    /**
     * Filter rule
     * @var TypedSequence<NamedElement>
     */
    private $_filterRule;

    /**
     * Constructor method for NamedFilterRules
     * @param  array $filterRule
     * @return self
     */
    public function __construct(array $filterRule = array())
    {
        parent::__construct();
        $this->_filterRule = new TypedSequence('Zimbra\Struct\NamedElement', $filterRule);

        $this->addHook(function($sender)
        {
            if(count($sender->filterRule()))
            {
                $sender->child('filterRule', $sender->filterRule()->all());
            }
        });
    }

    /**
     * Add a filter rule
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
