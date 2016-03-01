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
        $this->setProperty('cert.aid', trim($certAid));
        $this->setProperty('cert.filename', trim($certFilename));
        $this->setProperty('key.aid', trim($keyAid));
        $this->setProperty('key.filename', trim($keyFilename));
    }

    /**
     * Gets cert aid
     *
     * @return string
     */
    public function getCertAid()
    {
        return $this->getProperty('cert.aid');
    }

    /**
     * Sets cert aid
     *
     * @param  string $certAid
     * @return self
     */
    public function setCertAid($certAid)
    {
        return $this->setProperty('cert.aid', trim($certAid));
    }

    /**
     * Gets cert filename
     *
     * @return string
     */
    public function getCertFilename()
    {
        return $this->getProperty('cert.filename');
    }

    /**
     * Sets cert filename
     *
     * @param  string $certFilename
     * @return self
     */
    public function setCertFilename($certFilename)
    {
        return $this->setProperty('cert.filename', trim($certFilename));
    }

    /**
     * Gets keyAid
     *
     * @return string
     */
    public function getKeyAid()
    {
        return $this->getProperty('key.aid');
    }

    /**
     * Sets keyAid
     *
     * @param  string $keyAid
     * @return self
     */
    public function setKeyAid($keyAid)
    {
        return $this->setProperty('key.aid', trim($keyAid));
    }

    /**
     * Gets keyFilename
     *
     * @return string
     */
    public function getKeyFilename()
    {
        return $this->getProperty('key.filename');
    }

    /**
     * Sets keyFilename
     *
     * @param  string $keyFilename
     * @return self
     */
    public function setKeyFilename($keyFilename)
    {
        return $this->setProperty('key.filename', trim($keyFilename));
    }
}
