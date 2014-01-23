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

use Zimbra\Soap\Request;

/**
 * UploadProxyCA request class
 * Upload proxy CA.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class UploadProxyCA extends Request
{
    /**
     * Constructor method for UploadProxyCA
     * @param string $certAid Certificate attach ID
     * @param string $certFilename Certificate name
     * @return self
     */
    public function __construct($certAid, $certFilename)
    {
        parent::__construct();
        $this->property('cert.aid', trim($certAid));
        $this->property('cert.filename', trim($certFilename));
    }

    /**
     * Gets or sets certAid
     *
     * @param  string $certAid
     * @return string|self
     */
    public function certAid($certAid = null)
    {
        if(null === $certAid)
        {
            return $this->property('cert.aid');
        }
        return $this->property('cert.aid', trim($certAid));
    }

    /**
     * Gets or sets certFilename
     *
     * @param  string $certFilename
     * @return string|self
     */
    public function certFilename($certFilename = null)
    {
        if(null === $certFilename)
        {
            return $this->property('cert.filename');
        }
        return $this->property('cert.filename', trim($certFilename));
    }
}
