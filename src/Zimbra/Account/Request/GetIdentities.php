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
use Zimbra\Common\TypedSequence;
use Zimbra\Soap\Request;

/**
 * GetIdentities request class
 * Get the identities for the authed account.
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetIdentities extends Request
{
    /**
     * Identities
     * @var Sequence
     */
    private $_identity;

    /**
     * Constructor method for GetIdentities
     * @param array $identities Identities
     * @return self
     */
    public function __construct(array $identities = array())
    {
        parent::__construct();
        $this->_identity = new TypedSequence('Zimbra\Account\Struct\Identity', $identities);

        $this->addHook(function($sender)
        {
            $sender->child('identity', $sender->identity()->all());
        });
    }

    /**
     * Gets or sets identity
     *
     * @param  Identity $identity
     * @return self
     */
    public function addIdentity(Identity $identity)
    {
        $this->_identity->add($identity);
        return $this;
    }

    /**
     * Gets identity sequence
     *
     * @return Sequence
     */
    public function identity()
    {
        return $this->_identity;
    }
}
