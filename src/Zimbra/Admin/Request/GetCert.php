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
class GetCert extends Base
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
        $this->setProperty('server', trim($server));
        $this->setProperty('type', $type);
        if($option instanceof CSRType)
        {
            $this->setProperty('option', $option);
        }
    }

    /**
     * Gets server
     *
     * @return string
     */
    public function getServer()
    {
        return $this->getProperty('server');
    }

    /**
     * Sets server
     *
     * @param  string $server
     * @return self
     */
    public function setServer($server)
    {
        return $this->setProperty('server', trim($server));
    }

    /**
     * Gets type
     *
     * @return CertType
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets type
     *
     * @param  CertType $type
     * @return self
     */
    public function setType(CertType $type)
    {
        return $this->setProperty('type', $type);
    }

    /**
     * Gets option
     *
     * @return CSRType
     */
    public function getOption()
    {
        return $this->getProperty('option');
    }

    /**
     * Sets option
     *
     * @param  CSRType $option
     * @return self
     */
    public function setOption(CSRType $option)
    {
        return $this->setProperty('option', $option);
    }
}
