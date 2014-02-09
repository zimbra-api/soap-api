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

/**
 * UploadDomCert request class
 * Upload domain certificate.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class UploadDomCert extends Base
{
    /**
     * Constructor method for UploadDomCert
     * @param string $certAid Certificate attach ID
     * @param string $certFilename Certificate name
     * @param string $keyAid Key attach ID
     * @param string $keyFilename Key Name
     * @return self
     */
    public function __construct(
        $certAid,
        $certFilename,
        $keyAid,
        $keyFilename
    )
    {
        parent::__construct();
        $this->property('cert.aid', trim($certAid));
        $this->property('cert.filename', trim($certFilename));
        $this->property('key.aid', trim($keyAid));
        $this->property('key.filename', trim($keyFilename));
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

    /**
     * Gets or sets keyAid
     *
     * @param  string $keyAid
     * @return string|self
     */
    public function keyAid($keyAid = null)
    {
        if(null === $keyAid)
        {
            return $this->property('key.aid');
        }
        return $this->property('key.aid', trim($keyAid));
    }

    /**
     * Gets or sets keyFilename
     *
     * @param  string $keyFilename
     * @return string|self
     */
    public function keyFilename($keyFilename = null)
    {
        if(null === $keyFilename)
        {
            return $this->property('key.filename');
        }
        return $this->property('key.filename', trim($keyFilename));
    }
}
