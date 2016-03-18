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
use Zimbra\Struct\AttributeSelectorTrait;
use Zimbra\Struct\AttributeSelector;

/**
 * GetDomain request class
 * Get information about a domain.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetDomain extends Base implements AttributeSelector
{
    use AttributeSelectorTrait;

    /**
     * Constructor method for GetDomain
     * @param  Domain $domain Domain
     * @param  bool $applyConfig Apply config flag
     * @param  array $attrs  A list of attributes
     * @return self
     */
    public function __construct(Domain $domain = null, $applyConfig = null, array $attrs = [])
    {
        parent::__construct();
        if($domain instanceof Domain)
        {
            $this->setChild('domain', $domain);
        }
        if(null !== $applyConfig)
        {
            $this->setProperty('applyConfig', (bool) $applyConfig);
        }

        $this->setAttrs($attrs);
        $this->on('before', function(Base $sender)
        {
            $attrs = $sender->getAttrs();
            if(!empty($attrs))
            {
                $sender->setProperty('attrs', $attrs);
            }
        });
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

    /**
     * Gets applyConfig
     *
     * @return bool
     */
    public function getApplyConfig()
    {
        return $this->getProperty('applyConfig');
    }

    /**
     * Sets applyConfig
     *
     * @param  bool $applyConfig
     * @return self
     */
    public function setApplyConfig($applyConfig)
    {
        return $this->setProperty('applyConfig', (bool) $applyConfig);
    }
}
