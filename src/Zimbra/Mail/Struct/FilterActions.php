<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;

/**
 * FilterActions struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class FilterActions extends Base
{
    /**
     * Filter actions
     * @var TypedSequence<FilterAction>
     */
    private $_actions;

    /**
     * Constructor method for FilterActions
     * @param array $actions
     * @return self
     */
    public function __construct(array $actions = [])
    {
        parent::__construct();
        $this->setActions($actions);
        $this->on('before', function(Base $sender)
        {
            if($sender->getActions()->count())
            {
                foreach ($sender->getActions()->all() as $action)
                {
                    if($action instanceof KeepAction)
                    {
                        $this->setChild('actionKeep', $action);
                    }
                    if($action instanceof DiscardAction)
                    {
                        $this->setChild('actionDiscard', $action);
                    }
                    if($action instanceof FileIntoAction)
                    {
                        $this->setChild('actionFileInto', $action);
                    }
                    if($action instanceof FlagAction)
                    {
                        $this->setChild('actionFlag', $action);
                    }
                    if($action instanceof TagAction)
                    {
                        $this->setChild('actionTag', $action);
                    }
                    if($action instanceof RedirectAction)
                    {
                        $this->setChild('actionRedirect', $action);
                    }
                    if($action instanceof ReplyAction)
                    {
                        $this->setChild('actionReply', $action);
                    }
                    if($action instanceof NotifyAction)
                    {
                        $this->setChild('actionNotify', $action);
                    }
                    if($action instanceof StopAction)
                    {
                        $this->setChild('actionStop', $action);
                    }
                }
            }
        });
    }

    /**
     * Add a call action
     *
     * @param  FilterAction $action
     * @return self
     */
    public function addAction(FilterAction $action)
    {
        $this->_actions->add($action);
        return $this;
    }

    /**
     * Sets call action sequence
     *
     * @param  array $actions
     * @return self
     */
    public function setActions(array $actions)
    {
        $this->_actions = new TypedSequence('Zimbra\Mail\Struct\FilterAction', $actions);
        return $this;
    }

    /**
     * Gets call action sequence
     *
     * @return Sequence
     */
    public function getActions()
    {
        return $this->_actions;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'filterActions')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'filterActions')
    {
        return parent::toXml($name);
    }
}
