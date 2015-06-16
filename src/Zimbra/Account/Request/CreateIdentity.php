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
class CreateIdentity extends Base
{
    /**
     * Constructor method for CreateIdentity
     * @param Identity $identity Details of the new identity to create
     * @return self
     */
    public function __construct(Identity $identity)
    {
        parent::__construct();
        $this->setChild('identity', $identity);
    }

    /**
     * Gets the identity
     *
     * @return Identity
     */
    public function getIdentity()
    {
        return $this->getChild('identity');
    }

    /**
     * Sets the identity
     *
     * @param  Identity $identity
     * @return self
     */
    public function setIdentity(Identity $identity)
    {
        return $this->setChild('identity', $identity);
    }
}
