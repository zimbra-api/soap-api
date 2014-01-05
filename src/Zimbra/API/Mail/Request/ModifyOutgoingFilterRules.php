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
use Zimbra\Soap\Struct\FilterRules;

/**
 * ModifyOutgoingFilterRules request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyOutgoingFilterRules extends Request
{
    /**
     * Filter rules
     * @var FilterRules
     */
    private $_filterRules;

    /**
     * Constructor method for ModifyOutgoingFilterRules
     * @param  FilterRules $filterRules
     * @return self
     */
    public function __construct(FilterRules $filterRules)
    {
        parent::__construct();
        $this->_filterRules = $filterRules;
    }

    /**
     * Get or set filterRules
     *
     * @param  FilterRules $filterRules
     * @return FilterRules|self
     */
    public function filterRules(FilterRules $filterRules = null)
    {
        if(null === $filterRules)
        {
            return $this->_filterRules;
        }
        $this->_filterRules = $filterRules;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array += $this->_filterRules->toArray('filterRules');
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_filterRules->toXml('filterRules'));
        return parent::toXml();
    }
}
