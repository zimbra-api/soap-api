<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\DomainSelector as Domain;

/**
 * GetDomain class
 * Get information about a domain.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetDomain extends Request
{
    /**
     * Apply config flag
     * @var bool
     */
    private $_applyConfig;

    /**
     * Comma separated list of attributes
     * @var string
     */
    private $_attrs;

    /**
     * Domain
     * @var Domain
     */
    private $_domain;

    /**
     * Constructor method for GetDomain
     * @param  Domain $domain
     * @param  bool $applyConfig
     * @param  string $attrs
     * @return self
     */
    public function __construct(Domain $domain = null, $applyConfig = null, $attrs = null)
    {
        parent::__construct();
        if($domain instanceof Domain)
        {
            $this->_domain = $domain;
        }
        if(null !== $applyConfig)
        {
            $this->_applyConfig = (bool) $applyConfig;
        }
		$this->_attrs = trim($attrs);
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
            return $this->_domain;
        }
        $this->_domain = $domain;
        return $this;
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
            return $this->_applyConfig;
        }
        $this->_applyConfig = (bool) $applyConfig;
        return $this;
    }

    /**
     * Gets or sets attrs
     *
     * @param  string $attrs
     * @return string|self
     */
    public function attrs($attrs = null)
    {
        if(null === $attrs)
        {
            return $this->_attrs;
        }
        $this->_attrs = trim($attrs);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if($this->_domain instanceof Domain)
        {
            $this->array += $this->_domain->toArray();
        }
        if(is_bool($this->_applyConfig))
        {
            $this->array['applyConfig'] = $this->_applyConfig ? 1 : 0;
        }
        if(!empty($this->_attrs))
        {
            $this->array['attrs'] = $this->_attrs;
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if($this->_domain instanceof Domain)
        {
            $this->xml->append($this->_domain->toXml());
        }
        if(is_bool($this->_applyConfig))
        {
            $this->xml->addAttribute('applyConfig', $this->_applyConfig ? 1 : 0);
        }
        if(!empty($this->_attrs))
        {
            $this->xml->addAttribute('attrs', $this->_attrs);
        }
        return parent::toXml();
    }
}
