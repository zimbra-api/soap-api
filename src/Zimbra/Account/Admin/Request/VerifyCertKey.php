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

use Zimbra\Soap\Request;

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
class VerifyCertKey extends Request
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
            $this->property('cert', trim($cert));
        }
        if(null !== $privkey)
        {
            $this->property('privkey', trim($privkey));
        }
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
            return $this->property('cert');
        }
        return $this->property('cert', trim($cert));
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
            return $this->property('privkey');
        }
        return $this->property('privkey', trim($privkey));
    }
}
