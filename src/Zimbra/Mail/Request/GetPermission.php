<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Common\TypedSequence;
use Zimbra\Mail\Struct\Right;

/**
 * GetPermission request class
 * Get account level permissions 
 * If no <ace> elements are provided, all ACEs are returned in the response. 
 * If <ace> elements are provided, only those ACEs with specified rights are returned in the response.
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetPermission extends Base
{
    /**
     * Specification of rights.
     * @var TypedSequence<Right>
     */
    private $_ace;

    /**
     * Constructor method for GetPermission
     * @param  Right $ace
     * @return self
     */
    public function __construct(array $ace = array())
    {
        parent::__construct();
        $this->_ace = new TypedSequence('Zimbra\Mail\Struct\Right', $ace);

        $this->addHook(function($sender)
        {
            if(count($sender->ace()))
            {
                $sender->child('ace', $sender->ace()->all());
            }
        });
    }

    /**
     * Add an ace
     *
     * @param  Right $ace
     * @return self
     */
    public function addAce(Right $ace)
    {
        $this->_ace->add($ace);
        return $this;
    }

    /**
     * Gets ace sequence
     * Specification of rights.
     *
     * @return Sequence
     */
    public function ace()
    {
        return $this->_ace;
    }
}
