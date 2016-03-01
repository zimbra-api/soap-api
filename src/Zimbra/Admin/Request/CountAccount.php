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

use Zimbra\Admin\Struct\DomainSelector as Domain;

/**
 * CountAccount request class
 * Count number of accounts by cos in a domain.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CountAccount extends Base
{
    /**
     * Constructor method for CountAccount
     * @param Domain $domain Domain
     * @return self
     */
    public function __construct(Domain $domain)
    {
        parent::__construct();
        $this->setChild('domain', $domain);
    }

    /**
     * Gets the domain.
     *
     * @return Domain
     */
    public function getDomain()
    {
        return $this->getChild('domain');
    }

    /**
     * Sets the domain.
     *
     * @param  Domain $domain
     * @return self
     */
    public function setDomain(Domain $domain)
    {
        return $this->setChild('domain', $domain);
    }
}
