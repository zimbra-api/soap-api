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

use Zimbra\Account\Struct\AccountACEInfo as ACE;
use Zimbra\Common\TypedSequence;

/**
 * RevokeRights request class
 * Revoke account level rights
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RevokeRights extends Base
{
    /**
     * Specify Access Control Entries
     * @var TypedSequence
     */
    private  $_ace;

    /**
     * Constructor method for RevokeRights
     * @param array $ace Specify Access Control Entries
     * @return self
     */
    public function __construct(array $ace = array())
    {
        parent::__construct();
        $this->_ace = new TypedSequence('Zimbra\Account\Struct\AccountACEInfo', $ace);

        $this->on('before', function(Base $sender)
        {
            if($sender->ace()->count())
            {
                $sender->child('ace', $sender->ace()->all());
            }
        });
    }

    /**
     * Add an ace
     *
     * @param  ACE $ace
     * @return self
     */
    public function addAce(ACE $ace)
    {
        $this->_ace->add($ace);
        return $this;
    }

    /**
     * Gets ace sequence
     *
     * @return Sequence
     */
    public function ace()
    {
        return $this->_ace;
    }
}
