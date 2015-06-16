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

use Zimbra\Account\Struct\NameId;

/**
 * DeleteIdentity request class
 * Delete an identity
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DeleteIdentity extends Base
{
    /**
     * Constructor method for DeleteIdentity
     * @param NameId $identity Details of the identity to delete.
     * @return self
     */
    public function __construct(NameId $identity)
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
     * @param  NameId $identity
     * @return self
     */
    public function setIdentity(NameId $identity)
    {
        return $this->setChild('identity', $identity);
    }
}
