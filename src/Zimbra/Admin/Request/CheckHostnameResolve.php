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
 * CheckHostnameResolve request class
 * Check whether a hostname can be resolved.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckHostnameResolve extends Base
{
    /**
     * Constructor method for CheckHostnameResolve
     *
     * @param string $action The hostname
     * @return self
     */
    public function __construct($hostname = null)
    {
        parent::__construct();
        if(null !== $hostname)
        {
            $this->setProperty('hostname', trim($hostname));
        }
    }

    /**
     * Gets hostname
     *
     * @return string
     */
    public function getHostname()
    {
        return $this->getProperty('hostname');
    }

    /**
     * Sets hostname
     *
     * @param  string $hostname
     * @return self
     */
    public function setHostname($hostname)
    {
        return $this->setProperty('hostname', trim($hostname));
    }
}
