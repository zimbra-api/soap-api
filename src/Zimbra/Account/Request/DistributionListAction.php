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
use Zimbra\Soap\Request;

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
class DistributionListAction extends Request
{
    /**
     * Attributes
     * @var TypedSequence<Attr>
     */
    private $_attr;

    /**
     * Constructor method for DistributionListAction
     * @param  DistList $dl Identifies the distribution list to act upon
     * @param  Action $action Specifies the action to perform
     * @param  array $attrs Attributes
     * @return self
     */
    public function __construct(DistList $dl, Action $action, array $attrs = array())
    {
        parent::__construct();
        $this->child('dl', $dl);
        $this->child('action', $action);
        $this->_attr = new TypedSequence('Zimbra\Account\Struct\Attr', $attrs);

        $this->addHook(function($sender)
        {
            $sender->child('a', $sender->attr()->all());
        });
    }

    /**
     * Gets or sets dl
     *
     * @param  DistList $dl
     * @return DistList|self
     */
    public function dl(DistList $dl = null)
    {
        if(null === $dl)
        {
            return $this->child('dl');
        }
        return $this->child('dl', $dl);
    }

    /**
     * Gets or sets action
     *
     * @param  Action $action
     * @return Action|self
     */
    public function action(Action $action = null)
    {
        if(null === $action)
        {
            return $this->child('action');
        }
        return $this->child('action', $action);
    }

    /**
     * Add an attribute
     *
     * @param  Attr $attr
     * @return self
     */
    public function addAttr(Attr $attr)
    {
        $this->_attr->add($attr);
        return $this;
    }

    /**
     * Gets attr sequence
     *
     * @return Sequence
     */
    public function attr()
    {
        return $this->_attr;
    }
}
