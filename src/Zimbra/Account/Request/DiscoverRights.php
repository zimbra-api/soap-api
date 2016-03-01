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

use PhpCollection\Sequence;

/**
 * DiscoverRights request class
 * Return all targets of the specified rights applicable to the requested account.
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DiscoverRights extends Base
{
    /**
     * The signature
     * @var Sequence
     */
    private $_rights;

    /**
     * Constructor method for DiscoverRights
     * @param  array $rights
     * @return self
     */
    public function __construct(array $rights)
    {
        parent::__construct();
        $this->setRights($rights);

        $this->on('before', function(Base $sender)
        {
            $sender->setChild('right', $sender->getRights()->all());
        });
    }

    /**
     * Add a right
     *
     * @param  string $right
     * @return self
     */
    public function addRight($right)
    {
        $right = trim($right);
        if(!empty($right))
        {
            $this->_rights->add($right);
        }
        return $this;
    }

    /**
     * Sets right sequence
     *
     * @param  array $rights
     * @return self
     */
    public function setRights(array $rights)
    {
        $this->_rights = new Sequence;
        foreach ($rights as $right)
        {
            $right = trim($right);
            if(!empty($right))
            {
                $this->_rights->add($right);
            }
        }
        if(count($this->_rights) === 0)
        {
            throw new \InvalidArgumentException('DiscoverRights must have at least one right');
        }
        return $this;
    }

    /**
     * Gets right sequence
     *
     * @return Sequence
     */
    public function getRights()
    {
        return $this->_rights;
    }
}
