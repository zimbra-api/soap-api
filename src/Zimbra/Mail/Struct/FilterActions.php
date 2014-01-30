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
     * Constructor method for FilterActions
     * @param KeepAction $actionKeep
     * @param DiscardAction $actionDiscard
     * @param FileIntoAction $actionFileInto
     * @param FlagAction $actionFlag
     * @param TagAction $actionTag
     * @param RedirectAction $actionRedirect
     * @param ReplyAction $actionReply
     * @param NotifyAction $actionNotify
     * @param StopAction $actionStop
     * @return self
     */
    public function __construct(
        KeepAction $actionKeep = NULL,
        DiscardAction $actionDiscard = NULL,
        FileIntoAction $actionFileInto = NULL,
        FlagAction $actionFlag = NULL,
        TagAction $actionTag = NULL,
        RedirectAction $actionRedirect = NULL,
        ReplyAction $actionReply = NULL,
        NotifyAction $actionNotify = NULL,
        StopAction $actionStop = NULL
    )
    {
        parent::__construct();
        if($actionKeep instanceof KeepAction)
        {
            $this->child('actionKeep', $actionKeep);
        }
        if($actionDiscard instanceof DiscardAction)
        {
            $this->child('actionDiscard', $actionDiscard);
        }
        if($actionFileInto instanceof FileIntoAction)
        {
            $this->child('actionFileInto', $actionFileInto);
        }
        if($actionFlag instanceof FlagAction)
        {
            $this->child('actionFlag', $actionFlag);
        }
        if($actionTag instanceof TagAction)
        {
            $this->child('actionTag', $actionTag);
        }
        if($actionRedirect instanceof RedirectAction)
        {
            $this->child('actionRedirect', $actionRedirect);
        }
        if($actionReply instanceof ReplyAction)
        {
            $this->child('actionReply', $actionReply);
        }
        if($actionNotify instanceof NotifyAction)
        {
            $this->child('actionNotify', $actionNotify);
        }
        if($actionStop instanceof StopAction)
        {
            $this->child('actionStop', $actionStop);
        }
    }

    /**
     * Gets or sets actionKeep
     *
     * @param  KeepAction $actionKeep
     * @return KeepAction|self
     */
    public function actionKeep(KeepAction $actionKeep = null)
    {
        if(null === $actionKeep)
        {
            return $this->child('actionKeep');
        }
        return $this->child('actionKeep', $actionKeep);
    }

    /**
     * Gets or sets actionDiscard
     *
     * @param  DiscardAction $actionDiscard
     * @return DiscardAction|self
     */
    public function actionDiscard(DiscardAction $actionDiscard = null)
    {
        if(null === $actionDiscard)
        {
            return $this->child('actionDiscard');
        }
        return $this->child('actionDiscard', $actionDiscard);
    }

    /**
     * Gets or sets actionFileInto
     *
     * @param  FileIntoAction $actionFileInto
     * @return FileIntoAction|self
     */
    public function actionFileInto(FileIntoAction $actionFileInto = null)
    {
        if(null === $actionFileInto)
        {
            return $this->child('actionFileInto');
        }
        return $this->child('actionFileInto', $actionFileInto);
    }

    /**
     * Gets or sets actionFlag
     *
     * @param  FlagAction $actionFlag
     * @return FlagAction|self
     */
    public function actionFlag(FlagAction $actionFlag = null)
    {
        if(null === $actionFlag)
        {
            return $this->child('actionFlag');
        }
        return $this->child('actionFlag', $actionFlag);
    }

    /**
     * Gets or sets actionTag
     *
     * @param  TagAction $actionTag
     * @return TagAction|self
     */
    public function actionTag(TagAction $actionTag = null)
    {
        if(null === $actionTag)
        {
            return $this->child('actionTag');
        }
        return $this->child('actionTag', $actionTag);
    }

    /**
     * Gets or sets actionRedirect
     *
     * @param  RedirectAction $actionRedirect
     * @return RedirectAction|self
     */
    public function actionRedirect(RedirectAction $actionRedirect = null)
    {
        if(null === $actionRedirect)
        {
            return $this->child('actionRedirect');
        }
        return $this->child('actionRedirect', $actionRedirect);
    }

    /**
     * Gets or sets actionReply
     *
     * @param  ReplyAction $actionReply
     * @return ReplyAction|self
     */
    public function actionReply(ReplyAction $actionReply = null)
    {
        if(null === $actionReply)
        {
            return $this->child('actionReply');
        }
        return $this->child('actionReply', $actionReply);
    }

    /**
     * Gets or sets actionNotify
     *
     * @param  NotifyAction $actionNotify
     * @return NotifyAction|self
     */
    public function actionNotify(NotifyAction $actionNotify = null)
    {
        if(null === $actionNotify)
        {
            return $this->child('actionNotify');
        }
        return $this->child('actionNotify', $actionNotify);
    }

    /**
     * Gets or sets actionStop
     *
     * @param  StopAction $actionStop
     * @return StopAction|self
     */
    public function actionStop(StopAction $actionStop = null)
    {
        if(null === $actionStop)
        {
            return $this->child('actionStop');
        }
        return $this->child('actionStop', $actionStop);
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
