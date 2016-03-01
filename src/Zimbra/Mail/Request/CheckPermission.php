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

use PhpCollection\Sequence;
use Zimbra\Mail\Struct\TargetSpec;

/**
 * CheckPermission request class
 * Check if the authed user has the specified right(s) on a target. 
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckPermission extends Base
{
    /**
     * Rights to check
     * @var Sequence
     */
    private $_rights;

    /**
     * Constructor method for CheckPermission
     * @param  TargetSpec $target
     * @param  array $rights rights to check
     * @return self
     */
    public function __construct(TargetSpec $target = null, array $rights = array())
    {
        parent::__construct();
        if($target instanceof TargetSpec)
        {
            $this->setChild('target', $target);
        }
        $this->setRights($rights);
        $this->on('before', function(Base $sender)
        {
            if($sender->getRights()->count())
            {
                $sender->setChild('right', $sender->getRights()->all());
            }
        });
    }

    /**
     * Gets target specification
     *
     * @return TargetSpec
     */
    public function getTarget()
    {
        return $this->getChild('target');
    }

    /**
     * Sets target specification
     *
     * @param  TargetSpec $target
     * @return self
     */
    public function setTarget(TargetSpec $target)
    {
        return $this->setChild('target', $target);
    }

    /**
     * Add a right
     *
     * @param  string $right
     * @return self
     */
    public function addRight($right)
    {
        $this->_rights->add(trim($right));
        return $this;
    }

    /**
     * Set right sequence
     *
     * @param  array $rights
     * @return self
     */
    public function setRights(array $rights)
    {
        $this->_rights = new Sequence();
        foreach ($rights as $value)
        {
            $value = trim($value);
            if(!$this->_rights->contains($value))
            {
                $this->_rights->add($value);
            }
        }
        return $this;
    }

    /**
     * Get right sequence
     *
     * @return Sequence
     */
    public function getRights()
    {
        return $this->_rights;
    }
}
