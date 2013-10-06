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
 * CountAccount class
 * Count number of accounts by cos in a domain.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CountAccount extends Request
{
    /**
     * Domain
     * @var Domain
     */
    private $_domain;

    /**
     * Constructor method for CountAccount
     * @param Domain $domain
     * @return self
     */
    public function __construct(Domain $domain)
    {
        parent::__construct();
        $this->_domain = $domain;
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
        $this->array = $this->_domain->toArray();
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_domain->toXml());
        return parent::toXml();
    }
}
