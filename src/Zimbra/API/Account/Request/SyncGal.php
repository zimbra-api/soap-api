<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Account\Request;

use Zimbra\Soap\Request;

/**
 * SyncGal class
 * Synchronize with the Global Address List
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SyncGal extends Request
{
    /**
     * The previous synchronization token if applicable
     * @var string
     */
    private $_token;

    /**
     * GAL sync account ID
     * @var string
     */
    private $_galAcctId;

    /**
     * Flag whether only the ID attributes for matching contacts should be returned. 
     * @var boolean
     */
    private $_idOnly;

    /**
     * Constructor method for SyncGal
     * @param string $token
     * @param string $galAcctId
     * @param bool   $idOnly
     * @return self
     */
    public function __construct($token = null, $galAcctId = null, $idOnly = null)
    {
        parent::__construct();
        $this->_token = trim($token);
        $this->_galAcctId = trim($galAcctId);
        if(null !== $idOnly)
        {
            $this->_idOnly = (bool) $idOnly;
        }
    }

    /**
     * Gets or sets token
     *
     * @param  string $token
     * @return string|self
     */
    public function token($token = null)
    {
        if(null === $token)
        {
            return $this->_token;
        }
        $this->_token = trim($token);
        return $this;
    }

    /**
     * Gets or sets galAcctId
     *
     * @param  string $galAcctId
     * @return string|self
     */
    public function galAcctId($galAcctId = null)
    {
        if(null === $galAcctId)
        {
            return $this->_galAcctId;
        }
        $this->_galAcctId = trim($galAcctId);
        return $this;
    }

    /**
     * Gets or sets idOnly
     *
     * @param  bool $idOnly
     * @return bool|self
     */
    public function idOnly($idOnly = null)
    {
        if(null === $idOnly)
        {
            return $this->_idOnly;
        }
        $this->_idOnly = (bool) $idOnly;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(!empty($this->_token))
        {
            $this->array['token'] = $this->_token;
        }
        if(!empty($this->_galAcctId))
        {
            $this->array['galAcctId'] = $this->_galAcctId;
        }
        if(is_bool($this->_idOnly))
        {
            $this->array['idOnly'] = $this->_idOnly ? 1 : 0;
        }

        return parent::toArray();
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if(!empty($this->_token))
        {
            $this->xml->addAttribute('token', $this->_token);
        }
        if(!empty($this->_galAcctId))
        {
            $this->xml->addAttribute('galAcctId', $this->_galAcctId);
        }
        if(is_bool($this->_idOnly))
        {
            $this->xml->addAttribute('idOnly', $this->_idOnly ? 1 : 0);
        }

        return parent::toXml();
    }
}
