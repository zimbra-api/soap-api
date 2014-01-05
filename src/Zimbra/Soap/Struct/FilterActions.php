<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Utils\SimpleXML;

/**
 * FilterActions struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class FilterActions
{
    /**
     * The actionKeep
     * @var KeepAction
     */
    private $_actionKeep;
    /**
     * The actionDiscard
     * @var DiscardAction
     */
    private $_actionDiscard;
    /**
     * The actionFileInto
     * @var FileIntoAction
     */
    private $_actionFileInto;
    /**
     * The actionFlag
     * @var FlagAction
     */
    private $_actionFlag;
    /**
     * The actionTag
     * @var TagAction
     */
    private $_actionTag;
    /**
     * The actionRedirect
     * @var RedirectAction
     */
    private $_actionRedirect;
    /**
     * The actionReply
     * @var ReplyAction
     */
    private $_actionReply;
    /**
     * The actionNotify
     * @var NotifyAction
     */
    private $_actionNotify;
    /**
     * The actionStop
     * @var StopAction
     */
    private $_actionStop;

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
        if($actionKeep instanceof KeepAction)
        {
            $this->_actionKeep = $actionKeep;
        }
        if($actionDiscard instanceof DiscardAction)
        {
            $this->_actionDiscard = $actionDiscard;
        }
        if($actionFileInto instanceof FileIntoAction)
        {
            $this->_actionFileInto = $actionFileInto;
        }
        if($actionFlag instanceof FlagAction)
        {
            $this->_actionFlag = $actionFlag;
        }
        if($actionTag instanceof TagAction)
        {
            $this->_actionTag = $actionTag;
        }
        if($actionRedirect instanceof RedirectAction)
        {
            $this->_actionRedirect = $actionRedirect;
        }
        if($actionReply instanceof ReplyAction)
        {
            $this->_actionReply = $actionReply;
        }
        if($actionNotify instanceof NotifyAction)
        {
            $this->_actionNotify = $actionNotify;
        }
        if($actionStop instanceof StopAction)
        {
            $this->_actionStop = $actionStop;
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
            return $this->_actionKeep;
        }
        $this->_actionKeep = $actionKeep;
        return $this;
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
            return $this->_actionDiscard;
        }
        $this->_actionDiscard = $actionDiscard;
        return $this;
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
            return $this->_actionFileInto;
        }
        $this->_actionFileInto = $actionFileInto;
        return $this;
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
            return $this->_actionFlag;
        }
        $this->_actionFlag = $actionFlag;
        return $this;
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
            return $this->_actionTag;
        }
        $this->_actionTag = $actionTag;
        return $this;
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
            return $this->_actionRedirect;
        }
        $this->_actionRedirect = $actionRedirect;
        return $this;
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
            return $this->_actionReply;
        }
        $this->_actionReply = $actionReply;
        return $this;
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
            return $this->_actionNotify;
        }
        $this->_actionNotify = $actionNotify;
        return $this;
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
            return $this->_actionStop;
        }
        $this->_actionStop = $actionStop;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'filterActions')
    {
        $name = !empty($name) ? $name : 'filterActions';
        $arr = array();
        if($this->_actionKeep instanceof KeepAction)
        {
            $arr += $this->_actionKeep->toArray('actionKeep');
        }
        if($this->_actionDiscard instanceof DiscardAction)
        {
            $arr += $this->_actionDiscard->toArray('actionDiscard');
        }
        if($this->_actionFileInto instanceof FileIntoAction)
        {
            $arr += $this->_actionFileInto->toArray('actionFileInto');
        }
        if($this->_actionFlag instanceof FlagAction)
        {
            $arr += $this->_actionFlag->toArray('actionFlag');
        }
        if($this->_actionTag instanceof TagAction)
        {
            $arr += $this->_actionTag->toArray('actionTag');
        }
        if($this->_actionRedirect instanceof RedirectAction)
        {
            $arr += $this->_actionRedirect->toArray('actionRedirect');
        }
        if($this->_actionReply instanceof ReplyAction)
        {
            $arr += $this->_actionReply->toArray('actionReply');
        }
        if($this->_actionNotify instanceof NotifyAction)
        {
            $arr += $this->_actionNotify->toArray('actionNotify');
        }
        if($this->_actionStop instanceof StopAction)
        {
            $arr += $this->_actionStop->toArray('actionStop');
        }
        return array($name => $arr);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'filterActions')
    {
        $name = !empty($name) ? $name : 'filterActions';
        $xml = new SimpleXML('<'.$name.' />');
        if($this->_actionKeep instanceof KeepAction)
        {
            $xml->append($this->_actionKeep->toXml('actionKeep'));
        }
        if($this->_actionDiscard instanceof DiscardAction)
        {
            $xml->append($this->_actionDiscard->toXml('actionDiscard'));
        }
        if($this->_actionFileInto instanceof FileIntoAction)
        {
            $xml->append($this->_actionFileInto->toXml('actionFileInto'));
        }
        if($this->_actionFlag instanceof FlagAction)
        {
            $xml->append($this->_actionFlag->toXml('actionFlag'));
        }
        if($this->_actionTag instanceof TagAction)
        {
            $xml->append($this->_actionTag->toXml('actionTag'));
        }
        if($this->_actionRedirect instanceof RedirectAction)
        {
            $xml->append($this->_actionRedirect->toXml('actionRedirect'));
        }
        if($this->_actionReply instanceof ReplyAction)
        {
            $xml->append($this->_actionReply->toXml('actionReply'));
        }
        if($this->_actionNotify instanceof NotifyAction)
        {
            $xml->append($this->_actionNotify->toXml('actionNotify'));
        }
        if($this->_actionStop instanceof StopAction)
        {
            $xml->append($this->_actionStop->toXml('actionStop'));
        }
        return $xml;
    }

    /**
     * Method returning the xml string representation of this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
