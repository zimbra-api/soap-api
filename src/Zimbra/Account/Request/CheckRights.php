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

use Zimbra\Account\Struct\CheckRightsTargetSpec as Target;
use Zimbra\Common\TypedSequence;

/**
 * CheckRights request class
 * Check if the authed user has the specified right(s) on a target.
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckRights extends Base
{
    /**
     * The targets
     * @var TypedSequence<Target>
     */
    private $_targets;

    /**
     * Constructor method for CheckRights
     * @param array $targets
     * @return self
     */
    public function __construct(array $targets)
    {
        parent::__construct();
        $this->setTargets($targets);

        $this->on('before', function(Base $sender)
        {
            if($sender->getTargets()->count())
            {
                $sender->setChild('target', $sender->getTargets()->all());
            }
        });
    }

    /**
     * Add a target
     *
     * @param  CheckRightsTargetSpec $target
     * @return self
     */
    public function addTarget(Target $target)
    {
        $this->_targets->add($target);
        return $this;
    }

    /**
     * Set target sequence
     *
     * @param array $targets
     * @return self
     */
    public function setTargets(array $targets)
    {
        $this->_targets = new TypedSequence('Zimbra\Account\Struct\CheckRightsTargetSpec', $targets);
        if(count($this->_targets) === 0)
        {
            throw new \InvalidArgumentException('CheckRights must have at least one target');
        }
        return $this;
    }

    /**
     * Gets target sequence
     *
     * @return Sequence
     */
    public function getTargets()
    {
        return $this->_targets;
    }
}
