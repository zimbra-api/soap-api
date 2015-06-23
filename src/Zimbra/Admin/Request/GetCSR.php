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

use Zimbra\Enum\CSRType;

/**
 * GetCSR request class
 * Get a certificate signing request (CSR).
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetCSR extends Base
{
    /**
     * Constructor method for GetCSR
     * @param  string $server Server ID. Can be "--- All Servers ---" or the ID of a server
     * @param  CSRType $type Type of CSR. self: self-signed certificate. comm: commercial certificate
     * @return self
     */
    public function __construct($server = null, CSRType $type = null)
    {
        parent::__construct();
        $this->setProperty('server', trim($server));
        if($type instanceof CSRType)
        {
            $this->setProperty('type', $type);
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
     * @return CSRType
     */
    public function getType()
    {
        return $this->getProperty('type');
    }

    /**
     * Sets type
     *
     * @param  CSRType $type
     * @return self
     */
    public function setType(CSRType $type)
    {
        return $this->setProperty('type', $type);
    }
}
