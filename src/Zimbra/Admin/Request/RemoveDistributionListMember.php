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
 * RemoveDistributionListMember request class
 * Remove Distribution List Member
 * Unlike add, remove of a non-existent member causes an exception and no modification to the list.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class RemoveDistributionListMember extends Base
{
    /**
     * Members
     * @var Sequence
     */
    private $_dlm;

    /**
     * Constructor method for RemoveDistributionListMember
     * @param  string $id Zimbra ID
     * @param  array  $dlms Members
     * @return self
     */
    public function __construct($id, array $dlms)
    {
        parent::__construct();
        $this->property('id', trim($id));
        $this->_dlm = new Sequence($dlms);
        foreach ($dlms as $dlm)
        {
            $dlm = trim($dlm);
            if(!empty($dlm) && !$this->_dlm->contains($dlm))
            {
                $this->_dlm->add($dlm);
            }
        }
        if(!count($this->_dlm))
        {
            throw new \InvalidArgumentException('RemoveDistributionListMember must have at least a member');
        }

        $this->addHook(function($sender)
        {
            $sender->child('dlm', $sender->dlm()->all());
        });
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Add a member
     *
     * @param  string $dlm
     * @return self
     */
    public function addDlm($dlm)
    {
        $dlm = trim($dlm);
        if(!empty($dlm) && !$this->_dlm->contains($dlm))
        {
            $this->_dlm->add($dlm);
        }
        return $this;
    }

    /**
     * Gets dlm sequence
     *
     * @return Sequence
     */
    public function dlm()
    {
        return $this->_dlm;
    }
}
