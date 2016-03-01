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

use Zimbra\Mail\Struct\IdsAttr;
use Zimbra\Mail\Struct\NamedFilterRules;

/**
 * ApplyFilterRules request class
 * Applies one or more filter rules to messages specified by a comma-separated ID list, or returned by a search query.
 * One or the other can be specified, but not both.
 * Returns the list of ids of existing messages that were affected. 
 * Note that redirect actions are ignored when applying filter rules to existing messages.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ApplyFilterRules extends Base
{
    /**
     * Constructor method for ApplyFilterRules
     * @param  NamedFilterRules $filterRules
     * @param  IdsAttr $m
     * @param  string $query
     * @return self
     */
    public function __construct(NamedFilterRules $filterRules, IdsAttr $m = null, $query = null)
    {
        parent::__construct();
        $this->setChild('filterRules', $filterRules);
        if($m instanceof IdsAttr)
        {
            $this->setChild('m', $m);
        }
        if(null !== $query)
        {
            $this->setChild('query', trim($query));
        }
    }

    /**
     * Gets filter rules
     *
     * @return NamedFilterRules
     */
    public function getFilterRules()
    {
        return $this->getChild('filterRules');
    }

    /**
     * Sets filter rules
     *
     * @param  NamedFilterRules $filterRules
     * @return self
     */
    public function setFilterRules(NamedFilterRules $filterRules)
    {
        return $this->setChild('filterRules', $filterRules);
    }

    /**
     * Gets comma-separated list of message IDs
     *
     * @return IdsAttr
     */
    public function getMsgIds()
    {
        return $this->getChild('m');
    }

    /**
     * Sets comma-separated list of message IDs
     *
     * @param  IdsAttr $m
     * @return self
     */
    public function setMsgIds(IdsAttr $m)
    {
        return $this->setChild('m', $m);
    }

    /**
     * Gets query
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->getChild('query');
    }

    /**
     * Sets query
     *
     * @param  string $query
     * @return self
     */
    public function setQuery($query)
    {
        return $this->setChild('query', trim($query));
    }
}
