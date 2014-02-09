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
     * Server ID. Can be "--- All Servers ---" or the ID of a server
     * @var string
     */
    private $_server;

    /**
     * Type of CSR (required)
     * self: self-signed certificate
     * comm: commercial certificate
     * @var CSRType
     */
    private $_type;

    /**
     * Constructor method for GetCSR
     * @param  string $server Server ID. Can be "--- All Servers ---" or the ID of a server
     * @param  CSRType $type Type of CSR. self: self-signed certificate. comm: commercial certificate
     * @return self
     */
    public function __construct($server = null, CSRType $type = null)
    {
        parent::__construct();
        $this->property('server', trim($server));
        if($type instanceof CSRType)
        {
            $this->property('type', $type);
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
     * @param  CSRType $type
     * @return CSRType|self
     */
    public function type(CSRType $type = null)
    {
        if(null === $type)
        {
            return $this->property('type');
        }
        return $this->property('type', $type);
    }
}
