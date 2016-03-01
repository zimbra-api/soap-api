<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Request;

/**
 * SyncGal request class
 * Synchronize with the Global Address List
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SyncGal extends Base
{
    /**
     * Constructor method for SyncGal
     * @param string $token The previous synchronization token if applicable
     * @param string $galAcctId GAL sync account ID
     * @param bool   $idOnly Flag whether only the ID attributes for matching contacts should be returned.
     * @return self
     */
    public function __construct($token = null, $galAcctId = null, $idOnly = null)
    {
        parent::__construct();
        if(null !== $token)
        {
            $this->setProperty('token', trim($token));
        }
        if(null !== $galAcctId)
        {
            $this->setProperty('galAcctId', trim($galAcctId));
        }
        if(null !== $idOnly)
        {
            $this->setProperty('idOnly', (bool) $idOnly);
        }
    }

    /**
     * Gets token
     *
     * @return bool
     */
    public function getToken()
    {
        return $this->getProperty('token');
    }

    /**
     * Sets token
     *
     * @param  bool $token
     * @return self
     */
    public function setToken($token)
    {
        return $this->setProperty('token', trim($token));
    }

    /**
     * Gets GAL sync account ID
     *
     * @return bool
     */
    public function getGalAccountId()
    {
        return $this->getProperty('galAcctId');
    }

    /**
     * Sets GAL sync account ID
     *
     * @param  bool $galAcctId
     * @return self
     */
    public function setGalAccountId($galAcctId)
    {
        return $this->setProperty('galAcctId', trim($galAcctId));
    }

    /**
     * Gets ID only flag
     *
     * @return bool
     */
    public function getIdOnly()
    {
        return $this->getProperty('idOnly');
    }

    /**
     * Sets ID only flag
     *
     * @param  bool $idOnly
     * @return self
     */
    public function setIdOnly($idOnly)
    {
        return $this->setProperty('idOnly', (bool) $idOnly);
    }
}
