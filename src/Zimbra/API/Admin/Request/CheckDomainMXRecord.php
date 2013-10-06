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
 * CheckDomainMXRecord class
 * Check Domain MX record.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
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
        if(null !== $domain)
        {
            $this->_domain = $domain;
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
            return $this->_domain;
        }
        $this->_domain = $domain;
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
        return parent::toXml();
    }
}
