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
use Zimbra\Account\Struct\Identity;

/**
 * CreateIdentity request class
 * Create an Identity
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateIdentity extends Request
{
    /**
     * Constructor method for CreateIdentity
     * @param Identity $identity Details of the new identity to create
     * @return self
     */
    public function __construct(Identity $identity)
    {
        parent::__construct();
        $this->child('identity', $identity);
    }

    /**
     * Gets or sets identity
     *
     * @param  Identity $identity
     * @return Identity|self
     */
    public function identity(Identity $identity = null)
    {
        if(null === $identity)
        {
            return $this->child('identity');
        }
        return $this->child('identity', $identity);
    }
}
