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
 * VerifyCertKey request class
 * Verify Certificate Key.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class VerifyCertKey extends Base
{
    /**
     * Constructor method for VerifyCertKey
     * @param string $cert Certificate
     * @param string $privkey Private key
     * @return self
     */
    public function __construct($cert = null, $privkey = null)
    {
        parent::__construct();
        if(null !== $cert)
        {
            $this->setProperty('cert', trim($cert));
        }
        if(null !== $privkey)
        {
            $this->setProperty('privkey', trim($privkey));
        }
    }

    /**
     * Gets cert
     *
     * @return string
     */
    public function getCert()
    {
        return $this->getProperty('cert');
    }

    /**
     * Sets cert
     *
     * @param  string $cert
     * @return self
     */
    public function setCert($cert)
    {
        return $this->setProperty('cert', trim($cert));
    }

    /**
     * Gets privkey
     *
     * @return string
     */
    public function getPrivateKey()
    {
        return $this->getProperty('privkey');
    }

    /**
     * Sets privkey
     *
     * @param  string $privkey
     * @return self
     */
    public function setPrivateKey($privkey)
    {
        return $this->setProperty('privkey', trim($privkey));
    }
}
