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
use Zimbra\Soap\Enum\CountObjectsType as ObjType;
use Zimbra\Soap\Struct\DomainSelector as Domain;
use Zimbra\Soap\Struct\UcServiceSelector as UcService;

/**
 * CountObjects class
 * Count number of objects.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CountObjects extends Request
{
    /**
     * Object type
     * @var ObjType
     */
    private $_type;

    /**
     * The domain
     * @var Domain
     */
    private $_domain;

    /**
     * The ucservice
     * @var UcService
     */
    private $_ucservice;

    /**
     * Constructor method for CountObjects
     * @param ObjType $type
     * @param Domain $domain
     * @param UcService $ucservice
     * @return self
     */
    public function __construct(ObjType $type, Domain $domain = null, UcService $ucservice = null)
    {
        parent::__construct();
		$this->_type = $type;
        if($domain instanceof Domain)
        {
            $this->_domain = $domain;
        }
        if($ucservice instanceof UcService)
        {
            $this->_ucservice = $ucservice;
        }
    }

    /**
     * Gets or sets type
     *
     * @param  ObjType $type
     * @return ObjType|self
     */
    public function type(ObjType $type = null)
    {
        if(null === $type)
        {
            return $this->_type;
        }
		$this->_type = $type;
        return $this;
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
     * Gets or sets ucservice
     *
     * @param  UcService $ucservice
     * @return UcService|self
     */
    public function ucservice(UcService $ucservice = null)
    {
        if(null === $ucservice)
        {
            return $this->_ucservice;
        }
        $this->_ucservice = $ucservice;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'type' => (string) $this->_type,
        );
        if($this->_domain instanceof Domain)
        {
            $this->array += $this->_domain->toArray();
        }
        if($this->_ucservice instanceof UcService)
        {
            $this->array += $this->_ucservice->toArray();
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
        $this->xml->addAttribute('type', (string) $this->_type);
        if($this->_domain instanceof Domain)
        {
            $this->xml->append($this->_domain->toXml());
        }
        if($this->_ucservice instanceof UcService)
        {
            $this->xml->append($this->_ucservice->toXml());
        }
        return parent::toXml();
    }
}
