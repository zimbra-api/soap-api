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

use Zimbra\Account\Struct\DistributionListSelector as DistList;
use Zimbra\Account\Struct\DistributionListAction as Action;
use Zimbra\Account\Struct\Attr;
use Zimbra\Common\TypedSequence;

/**
 * DistributionListAction request class
 * Perform an action on a Distribution List 
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DistributionListAction extends Base
{
    /**
     * Attributes
     * @var TypedSequence<Attr>
     */
    private $_attrs;

    /**
     * Constructor method for DistributionListAction
     * @param  DistList $dl Identifies the distribution list to act upon
     * @param  Action $action Specifies the action to perform
     * @param  array $attrs Attributes
     * @return self
     */
    public function __construct(DistList $dl, Action $action, array $attrs = [])
    {
        parent::__construct();
        $this->setChild('dl', $dl);
        $this->setChild('action', $action);
        $this->setAttrs($attrs);

        $this->on('before', function(Base $sender)
        {
            if($sender->getAttrs()->count())
            {
                $sender->setChild('a', $sender->getAttrs()->all());
            }
        });
    }

    /**
     * Gets the dl
     *
     * @return Zimbra\Action\Struct\DistributionListSelector
     */
    public function getDl()
    {
        return $this->getChild('dl');
    }

    /**
     * Sets the dl
     *
     * @param  Zimbra\Action\Struct\DistributionListSelector $dl
     * @return self
     */
    public function setDl(DistList $dl)
    {
        return $this->setChild('dl', $dl);
    }

    /**
     * Gets the action
     *
     * @return Zimbra\Action\Struct\DistributionListAction
     */
    public function getAction()
    {
        return $this->getChild('action');
    }

    /**
     * Sets the action
     *
     * @param  Zimbra\Action\Struct\DistributionListAction $action
     * @return self
     */
    public function setAction(Action $action)
    {
        return $this->setChild('action', $action);
    }

    /**
     * Add an attribute
     *
     * @param  Attr $attr
     * @return self
     */
    public function addAttr(Attr $attr)
    {
        $this->_attrs->add($attr);
        return $this;
    }

    /**
     * Sets attribute sequence
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttrs(array $attrs)
    {
        $this->_attrs = new TypedSequence('Zimbra\Account\Struct\Attr', $attrs);
        return $this;
    }

    /**
     * Gets attribute sequence
     *
     * @return Sequence
     */
    public function getAttrs()
    {
        return $this->_attrs;
    }
}
