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
 * CreateAppSpecificPassword request class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateAppSpecificPassword extends Base
{
    /**
     * Constructor method for CreateAppSpecificPassword
     * @param string $appName
     * @return self
     */
    public function __construct($appName = null)
    {
        parent::__construct();
        if(null !== $appName)
        {
            $this->setProperty('appName', trim($appName));
        }
    }

    /**
     * Gets the appName
     *
     * @return string
     */
    public function getAppName()
    {
        return $this->getProperty('appName');
    }

    /**
     * Sets the appName
     *
     * @param  string $appName
     * @return self
     */
    public function setAppName($appName)
    {
        return $this->setProperty('appName', trim($appName));
    }
}
