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
 * GetDomainInfo request class
 * Get Domain information.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetDomainInfo extends Request
{
    /**
     * Constructor method for GetDomainInfo
     * @param  Domain $account Domain
     * @param  bool $applyConfig Apply config flag
     * @return self
     */
    public function __construct(Domain $domain = null, $applyConfig = null)
    {
        parent::__construct();
        if($domain instanceof Domain)
        {
            $this->child('domain', $domain);
        }
        if(null !== $applyConfig)
        {
            $this->property('applyConfig', (bool) $applyConfig);
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

    /**
     * Gets or sets applyConfig
     *
     * @param  bool $applyConfig
     * @return bool|self
     */
    public function applyConfig($applyConfig = null)
    {
        if(null === $applyConfig)
        {
            return $this->property('applyConfig');
        }
        return $this->property('applyConfig', (bool) $applyConfig);
    }
}
