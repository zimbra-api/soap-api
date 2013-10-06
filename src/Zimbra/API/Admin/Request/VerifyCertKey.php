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
 * VerifyCertKey class
 * Verify Certificate Key.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class VerifyCertKey extends Request
{
    /**
     * Certificate
     * @var string
     */
    private $_cert;

    /**
     * Private key
     * @var string
     */
    private $_privkey;

    /**
     * Constructor method for VerifyCertKey
     * @param string $cert
     * @param string $privkey
     * @return self
     */
    public function __construct($cert = null, $privkey = null)
    {
        parent::__construct();
        $this->_cert = trim($cert);
        $this->_privkey = trim($privkey);
    }

    /**
     * Gets or sets cert
     *
     * @param  string $cert
     * @return string|self
     */
    public function cert($cert = null)
    {
        if(null === $cert)
        {
            return $this->_cert;
        }
        $this->_cert = trim($cert);
        return $this;
    }

    /**
     * Gets or sets privkey
     *
     * @param  string $privkey
     * @return string|self
     */
    public function privkey($privkey = null)
    {
        if(null === $privkey)
        {
            return $this->_privkey;
        }
        $this->_privkey = trim($privkey);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(!empty($this->_cert))
        {
            $this->array['cert'] = $this->_cert;
        }
        if(!empty($this->_privkey))
        {
            $this->array['privkey'] = $this->_privkey;
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if(!empty($this->_cert))
        {
            $this->xml->addAttribute('cert', $this->_cert);
        }
        if(!empty($this->_privkey))
        {
            $this->xml->addAttribute('privkey', $this->_privkey);
        }
        return parent::toXml();
    }
}
