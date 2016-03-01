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
 * ModifyIdentity request class
 * Modify an Identity
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyIdentity extends Base
{
    /**
     * Constructor method for ModifyIdentity
     * @param Identity $identity Specify identity to be modified Must specify either "name" or "id" attribute
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
