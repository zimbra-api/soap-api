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
use Zimbra\Soap\Request;

/**
 * CheckDomainMXRecord request class
 * Check Domain MX record.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckDomainMXRecord extends Request
{
    /**
     * The domain
     * @var DomainSelector
     */
    private $_domain;

    /**
     * Constructor method for CheckDomainMXRecord
     * @param Domain $domain
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
