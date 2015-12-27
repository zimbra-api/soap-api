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
    private $_aces;

    /**
     * Constructor method for GetPermission
     * @param  Right $ace
     * @return self
     */
    public function __construct(array $aces = [])
    {
        parent::__construct();
        $this->setAces($aces);
        $this->on('before', function(Base $sender)
        {
            if($sender->getAces()->count())
            {
                $sender->setChild('ace', $sender->getAces()->all());
            }
        });
    }

    /**
     * Add a specification of right
     *
     * @param  Right $ace
     * @return self
     */
    public function addAce(Right $ace)
    {
        $this->_aces->add($ace);
        return $this;
    }

    /**
     * Sets specification of right sequence
     *
     * @param  array $aces
     * @return self
     */
    public function setAces(array $aces)
    {
        $this->_aces = new TypedSequence('Zimbra\Mail\Struct\Right', $aces);
        return $this;
    }

    /**
     * Gets specification of right sequence
     * Specification of rights.
     *
     * @return Sequence
     */
    public function getAces()
    {
        return $this->_aces;
    }
}
