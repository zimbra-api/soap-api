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

use PhpCollection\Sequence;

/**
 * AddDistributionListAlias request class
 * Adding members to a distribution list
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AddDistributionListMember extends Base
{
    /**
     * Members
     * @var Sequence
     */
    private $_members;

    /**
     * Constructor method for AddDistributionListMember
     * @param  string $id Zimbra ID
     * @param  array  $members Members
     * @return self
     */
    public function __construct($id, array $members)
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        $this->setMembers($members);

        $this->on('before', function(Base $sender)
        {
            if($sender->getMembers()->count())
            {
                $sender->setChild('dlm', $sender->getMembers()->all());
            }
        });
    }

    /**
     * Gets Zimbra ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets Zimbra ID
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Add a dl member
     *
     * @param  string $dlm
     * @return self
     */
    public function addMember($member)
    {
        $member = trim($member);
        if(!empty($member) && !$this->_members->contains($member))
        {
            $this->_members->add($member);
        }
        return $this;
    }

    /**
     * Sets member sequence
     *
     * @param  array  $members Members
     * @return self
     */
    public function setMembers(array $members)
    {
        $this->_members = new Sequence;
        foreach ($members as $member)
        {
            $member = trim($member);
            if(!empty($member) && !$this->_members->contains($member))
            {
                $this->_members->add($member);
            }
        }
        if(count($this->_members) === 0)
        {
            throw new \InvalidArgumentException('AddDistributionListMember must have at least one member');
        }
        return $this;
    }

    /**
     * Gets member sequence
     *
     * @return Sequence
     */
    public function getMembers()
    {
        return $this->_members;
    }
}
