<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Admin\Struct\DomainSelector as Domain;

/**
 * GetAllDistributionLists request class
 * Get all distribution lists that match the selection criteria.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetAllDistributionLists extends Request
{
    /**
     * Constructor method for GetAllDistributionLists
     * @param  Domain $domain
     * @return self
     */
    public function __construct(Domain $domain = null)
    {
        parent::__construct();
        if($domain instanceof Domain)
        {
            $this->child('domain', $domain);
        }
    }

    /**
     * Gets or sets domain
     *
     * @param  Domain $domain
     * @return Domain|self
     */
    public function domain(Domain $domain = null)
    {
        if(null === $domain)
        {
            return $this->child('domain');
        }
        return $this->child('domain', $domain);
    }
}
