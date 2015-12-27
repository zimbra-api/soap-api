<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Mail\Struct\FilterRules;

/**
 * ModifyOutgoingFilterRules request class
 * Modify Outgoing Filter rules
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyOutgoingFilterRules extends Base
{
    /**
     * Constructor method for ModifyOutgoingFilterRules
     * @param  FilterRules $filterRules
     * @return self
     */
    public function __construct(FilterRules $filterRules)
    {
        parent::__construct();
        $this->setChild('filterRules', $filterRules);
    }

    /**
     * Gets filter rules
     *
     * @return FilterRules
     */
    public function getFilterRules()
    {
        return $this->getChild('filterRules');
    }

    /**
     * Sets filter rules
     *
     * @param  FilterRules $filterRules
     * @return self
     */
    public function setFilterRules(FilterRules $filterRules)
    {
        return $this->setChild('filterRules', $filterRules);
    }
}
