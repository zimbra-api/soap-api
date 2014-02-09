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
 * ApplyOutgoingFilterRules request class
 * Applies one or more filter rules to messages specified by a comma-separated ID list, or returned by a search query.
 * One or the other can be specified, but not both.
 * Returns the list of ids of existing messages that were affected.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ApplyOutgoingFilterRules extends Base
{
    /**
     * Constructor method for ApplyOutgoingFilterRules
     * @param  NamedFilterRules $filterRules
     * @param  IdsAttr $m
     * @param  string $query
     * @return self
     */
    public function __construct(NamedFilterRules $filterRules, IdsAttr $m = null, $query = null)
    {
        parent::__construct();
        $this->child('filterRules', $filterRules);
        if($m instanceof IdsAttr)
        {
            $this->child('m', $m);
        }
        if(null !== $query)
        {
            $this->child('query', trim($query));
        }
    }

    /**
     * Gets or sets filterRules
     *
     * @param  NamedFilterRules $filterRules
     * @return NamedFilterRules|self
     */
    public function filterRules(NamedFilterRules $filterRules = null)
    {
        if(null === $filterRules)
        {
            return $this->child('filterRules');
        }
        return $this->child('filterRules', $filterRules);
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
            return $this->child('m');
        }
        return $this->child('m', $m);
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
            return $this->child('query');
        }
        return $this->child('query', trim($query));
    }
}
