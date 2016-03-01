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
use Zimbra\Admin\Struct\UcServiceSelector as UcService;
use Zimbra\Enum\CountObjectsType as ObjType;

/**
 * CountObjects request class
 * Count number of objects.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CountObjects extends Base
{
    /**
     * Constructor method for CountObjects
     * @param ObjType $type Object type
     * @param Domain $domain The domain
     * @param UcService $ucservice The ucservice
     * @return self
     */
    public function __construct(ObjType $type, Domain $domain = null, UcService $ucservice = null)
    {
        parent::__construct();
        $this->setProperty('type', $type);
        if($domain instanceof Domain)
        {
            $this->setChild('domain', $domain);
        }
        if($ucservice instanceof UcService)
        {
            $this->setChild('ucservice', $ucservice);
        }
    }

    /**
     * Gets object type
     *
     * @return ObjType
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets object type
     *
     * @param  ObjType $type
     * @return self
     */
    public function setType(ObjType $type)
    {
        return $this->setProperty('type', $type);
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
     * Gets the ucservice.
     *
     * @return UcService
     */
    public function getUcService()
    {
        return $this->getChild('ucservice');
    }

    /**
     * Sets the ucservice.
     *
     * @param  UcService $ucservice
     * @return self
     */
    public function setUcService(UcService $ucservice)
    {
        return $this->setChild('ucservice', $ucservice);
    }
}
