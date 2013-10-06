<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;

/**
 * UploadDomCert class
 * Upload domain certificate.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class UploadDomCert extends Request
{
    /**
     * Certificate attach ID
     * @var string
     */
    private $_certAid;

    /**
     * Certificate name
     * @var string
     */
    private $_certFilename;

    /**
     * Key attach ID
     * @var string
     */
    private $_keyAid;

    /**
     * Key Name
     * @var string
     */
    private $_keyFilename;

    /**
     * Constructor method for UploadDomCert
     * @param string $certAid
     * @param string $certFilename
     * @param string $keyAid
     * @param string $keyFilename
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
        $this->_certAid = trim($certAid);
        $this->_certFilename = trim($certFilename);
        $this->_keyAid = trim($keyAid);
        $this->_keyFilename = trim($keyFilename);
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
            return $this->_certAid;
        }
        $this->_certAid = trim($certAid);
        return $this;
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
            return $this->_certFilename;
        }
        $this->_certFilename = trim($certFilename);
        return $this;
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
            return $this->_keyAid;
        }
        $this->_keyAid = trim($keyAid);
        return $this;
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
            return $this->_keyFilename;
        }
        $this->_keyFilename = trim($keyFilename);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'cert.aid' => $this->_certAid,
            'cert.filename' => $this->_certFilename,
            'key.aid' => $this->_keyAid,
            'key.filename' => $this->_keyFilename,
        );
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->addAttribute('cert.aid', $this->_certAid)
                  ->addAttribute('cert.filename', $this->_certFilename)
                  ->addAttribute('key.aid', $this->_keyAid)
                  ->addAttribute('key.filename', $this->_keyFilename);
        return parent::toXml();
    }
}
