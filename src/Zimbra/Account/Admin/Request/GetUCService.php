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

use Zimbra\Admin\Struct\UcServiceSelector as UcService;
use Zimbra\Soap\Request;

/**
 * GetUCService request class
 * Get UC Service.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetUCService extends Request
{
    /**
     * UC Service
     * @var UcService
     */
    private $_ucservice;

    /**
     * Comma separated list of attributes
     * @var string
     */
    private $_attrs;

    /**
     * Constructor method for GetUCService
     * @param  UcService $ucservice
     * @param  string $attrs
     * @return self
     */
    public function __construct(UcService $ucservice = null, $attrs = null)
    {
        parent::__construct();
        if($ucservice instanceof UCService)
        {
            $this->child('ucservice', $ucservice);
        }
        if(null !== $attrs)
        {
            $this->property('attrs', trim($attrs));
        }
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
            return $this->property('attrs');
        }
        return $this->property('attrs', trim($attrs));
    }
}
