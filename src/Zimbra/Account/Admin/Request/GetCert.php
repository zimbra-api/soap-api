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

use Zimbra\Enum\CertType;
use Zimbra\Enum\CSRType;
use Zimbra\Soap\Request;

/**
 * GetCert request class
 * Get Certificate.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetCert extends Request
{
    /**
     * Constructor method for GetCert
     * @param  string $server The server's ID whose cert is to be got
     * @param  CertType $type Certificate type 
     * @param  CSRType $option Required only when type is "staged". Could be "self" (self-signed cert) or "comm" (commerical cert).
     * @return self
     */
    public function __construct($server, CertType $type, CSRType $option = null)
    {
        parent::__construct();
        $this->property('server', trim($server));
        $this->property('type', $type);
        if($option instanceof CSRType)
        {
            $this->property('option', $option);
        }
    }

    /**
     * Gets or sets server
     *
     * @param  string $server
     * @return string|self
     */
    public function server($server = null)
    {
        if(null === $server)
        {
            return $this->property('server');
        }
        return $this->property('server', trim($server));
    }

    /**
     * Gets or sets type
     *
     * @param  CertType $type
     * @return CertType|self
     */
    public function type(CertType $type = null)
    {
        if(null === $type)
        {
            return $this->property('type');
        }
        return $this->property('type', $type);
    }

    /**
     * Gets or sets option
     *
     * @param  CSRType $option
     * @return CSRType|self
     */
    public function option(CSRType $option = null)
    {
        if(null === $option)
        {
            return $this->property('option');
        }
        return $this->property('option', $option);
    }
}
