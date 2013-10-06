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
 * UploadProxyCA class
 * Upload proxy CA.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class UploadProxyCA extends Request
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
     * Constructor method for UploadProxyCA
     * @param string $certAid
     * @param string $certFilename
     * @return self
     */
    public function __construct($certAid, $certFilename)
    {
        parent::__construct();
        $this->_certAid = trim($certAid);
        $this->_certFilename = trim($certFilename);
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
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            'cert.aid' => $this->_certAid,
            'cert.filename' => $this->_certFilename,
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
                  ->addAttribute('cert.filename', $this->_certFilename);
        return parent::toXml();
    }
}
