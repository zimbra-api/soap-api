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
 * EndSession request class
 * End the current session, removing it from all caches.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class EndSession extends Base
{
    /**
     * Constructor method for EndSession
     * @param  bool $logoff Flag whether the exp flag is needed in the response for group entries.
     * @return self
     */
    public function __construct($logoff = null)
    {
        parent::__construct();
        if(null !== $logoff)
        {
            $this->setProperty('logoff', (bool) $logoff);
        }
    }

    /**
     * Gets logoff
     *
     * @return bool
     */
    public function getLogoff()
    {
        return $this->getProperty('logoff');
    }

    /**
     * Sets logoff
     *
     * @param  bool $logoff
     * @return self
     */
    public function setLogoff($logoff)
    {
        return $this->setProperty('logoff', (bool) $logoff);
    }
}
