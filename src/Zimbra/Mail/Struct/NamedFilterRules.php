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
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class NamedFilterRules extends Base
{
    /**
     * Filter rule
     * @var TypedSequence<NamedElement>
     */
    private $_filterRules;

    /**
     * Constructor method for NamedFilterRules
     * @param  array $filterRules
     * @return self
     */
    public function __construct(array $filterRules = [])
    {
        parent::__construct();

        $this->setFilterRules($filterRules);
        $this->on('before', function(Base $sender)
        {
            if($sender->getFilterRules()->count())
            {
                $sender->setChild('filterRule', $sender->getFilterRules()->all());
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
        $this->_filterRules->add($filterRule);
        return $this;
    }

    /**
     * Sets filter rule sequence
     *
     * @param  array $filterRules
     * @return self
     */
    public function setFilterRules(array $filterRules)
    {
        $this->_filterRules = new TypedSequence('Zimbra\Struct\NamedElement', $filterRules);
        return $this;
    }

    /**
     * Gets filter rule sequence
     *
     * @return Sequence
     */
    public function getFilterRules()
    {
        return $this->_filterRules;
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
