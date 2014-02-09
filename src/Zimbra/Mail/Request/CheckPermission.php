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
    private $_right;

    /**
     * Constructor method for CheckPermission
     * @param  TargetSpec $target
     * @param  array $right
     * @return self
     */
    public function __construct(TargetSpec $target = null, array $right = array())
    {
        parent::__construct();
        if($target instanceof TargetSpec)
        {
            $this->child('target', $target);
        }
        $this->_right = new Sequence();
        foreach ($right as $value)
        {
            $value = trim($value);
            if(!$this->_right->contains($value))
            {
                $this->_right->add($value);
            }
        }

        $this->addHook(function($sender)
        {
            if(count($sender->right()))
            {
                $sender->child('right', $sender->right()->all());
            }
        });
    }

    /**
     * Get or set target
     *
     * @param  TargetSpec $target
     * @return TargetSpec|self
     */
    public function target(TargetSpec $target = null)
    {
        if(null === $target)
        {
            return $this->child('target');
        }
        return $this->child('target', $target);
    }

    /**
     * Add a right
     *
     * @param  string $right
     * @return self
     */
    public function addRight($right)
    {
        $this->_right->add(trim($right));
        return $this;
    }

    /**
     * Get right Sequence
     *
     * @return Sequence
     */
    public function right()
    {
        return $this->_right;
    }
}
