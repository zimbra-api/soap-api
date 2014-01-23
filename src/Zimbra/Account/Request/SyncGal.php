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

use Zimbra\Soap\Request;

/**
 * SyncGal request class
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
            $this->property('token', trim($token));
        }
        if(null !== $galAcctId)
        {
            $this->property('galAcctId', trim($galAcctId));
        }
        if(null !== $idOnly)
        {
            $this->property('idOnly', (bool) $idOnly);
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
            return $this->property('token');
        }
        return $this->property('token', trim($token));
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
            return $this->property('galAcctId');
        }
        return $this->property('galAcctId', trim($galAcctId));
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
            return $this->property('idOnly');
        }
        return $this->property('idOnly', (bool) $idOnly);
    }
}
