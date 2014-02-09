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
        $this->property('type', $type);
        if($domain instanceof Domain)
        {
            $this->child('domain', $domain);
        }
        if($ucservice instanceof UcService)
        {
            $this->child('ucservice', $ucservice);
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
            return $this->property('type');
        }
        return $this->property('type', $type);
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
     * Gets or sets ucservice
     *
     * @param  UcService $ucservice
     * @return UcService|self
     */
    public function ucservice(UcService $ucservice = null)
    {
        if(null === $ucservice)
        {
            return $this->child('ucservice');
        }
        return $this->child('ucservice', $ucservice);
    }
}
