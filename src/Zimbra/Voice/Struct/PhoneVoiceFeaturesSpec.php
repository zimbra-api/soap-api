<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Voice\Struct;

use Zimbra\Struct\Base;

/**
 * PhoneVoiceFeaturesSpec struct class
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class PhoneVoiceFeaturesSpec extends Base
{
    /**
     * Constructor method for PhoneVoiceFeaturesSpec
     * @param string $name
     * @param VoiceMailPrefsReq $voicemailprefs
     * @param AnonCallRejectionReq $anoncallrejection
     * @param CallerIdBlockingReq $calleridblocking
     * @param CallForwardReq $callforward
     * @param CallForwardBusyLineReq $callforwardbusyline
     * @param CallForwardNoAnswerReq $callforwardnoanswer
     * @param CallWaitingReq $callwaiting
     * @param SelectiveCallForwardReq $selectivecallforward
     * @param SelectiveCallAcceptanceReq $selectivecallacceptance
     * @param SelectiveCallRejectionReq $selectivecallrejection
     * @return self
     */
    public function __construct(
        $name,
        VoiceMailPrefsReq $voicemailprefs = null,
        AnonCallRejectionReq $anoncallrejection = null,
        CallerIdBlockingReq $calleridblocking = null,
        CallForwardReq $callforward = null,
        CallForwardBusyLineReq $callforwardbusyline = null,
        CallForwardNoAnswerReq $callforwardnoanswer = null,
        CallWaitingReq $callwaiting = null,
        SelectiveCallForwardReq $selectivecallforward = null,
        SelectiveCallAcceptanceReq $selectivecallacceptance = null,
        SelectiveCallRejectionReq $selectivecallrejection = null
    )
    {
        parent::__construct();
        $this->property('name', trim($name));
        if($voicemailprefs instanceof VoiceMailPrefsReq)
        {
            $this->child('voicemailprefs', $voicemailprefs);
        }
        if($anoncallrejection instanceof AnonCallRejectionReq)
        {
            $this->child('anoncallrejection', $anoncallrejection);
        }
        if($calleridblocking instanceof CallerIdBlockingReq)
        {
            $this->child('calleridblocking', $calleridblocking);
        }
        if($callforward instanceof CallForwardReq)
        {
            $this->child('callforward', $callforward);
        }
        if($callforwardbusyline instanceof CallForwardBusyLineReq)
        {
            $this->child('callforwardbusyline', $callforwardbusyline);
        }
        if($callforwardnoanswer instanceof CallForwardNoAnswerReq)
        {
            $this->child('callforwardnoanswer', $callforwardnoanswer);
        }
        if($callwaiting instanceof CallWaitingReq)
        {
            $this->child('callwaiting', $callwaiting);
        }
        if($selectivecallforward instanceof SelectiveCallForwardReq)
        {
            $this->child('selectivecallforward', $selectivecallforward);
        }
        if($selectivecallacceptance instanceof SelectiveCallAcceptanceReq)
        {
            $this->child('selectivecallacceptance', $selectivecallacceptance);
        }
        if($selectivecallrejection instanceof SelectiveCallRejectionReq)
        {
            $this->child('selectivecallrejection', $selectivecallrejection);
        }
    }

    /**
     * Get or set name
     *
     * @param  string $name
     * @return string|self
     */
    public function name($name = null)
    {
        if(null === $name)
        {
            return $this->property('name');
        }
        return $this->property('name', trim($name));
    }

    /**
     * Get or set voicemailprefs
     *
     * @param  VoiceMailPrefsReq $voicemailprefs
     * @return VoiceMailPrefsReq|self
     */
    public function voicemailprefs(VoiceMailPrefsReq $voicemailprefs = null)
    {
        if(null === $voicemailprefs)
        {
            return $this->child('voicemailprefs');
        }
        return $this->child('voicemailprefs', $voicemailprefs);
    }

    /**
     * Get or set anoncallrejection
     *
     * @param  AnonCallRejectionReq $anoncallrejection
     * @return AnonCallRejectionReq|self
     */
    public function anoncallrejection(AnonCallRejectionReq $anoncallrejection = null)
    {
        if(null === $anoncallrejection)
        {
            return $this->child('anoncallrejection');
        }
        return $this->child('anoncallrejection', $anoncallrejection);
    }

    /**
     * Get or set calleridblocking
     *
     * @param  CallerIdBlockingReq $calleridblocking
     * @return CallerIdBlockingReq|self
     */
    public function calleridblocking(CallerIdBlockingReq $calleridblocking = null)
    {
        if(null === $calleridblocking)
        {
            return $this->child('calleridblocking');
        }
        return $this->child('calleridblocking', $calleridblocking);
    }

    /**
     * Get or set callforward
     *
     * @param  CallForwardReq $callforward
     * @return CallForwardReq|self
     */
    public function callforward(CallForwardReq $callforward = null)
    {
        if(null === $callforward)
        {
            return $this->child('callforward');
        }
        return $this->child('callforward', $callforward);
    }

    /**
     * Get or set callforwardbusyline
     *
     * @param  CallForwardBusyLineReq $callforwardbusyline
     * @return CallForwardBusyLineReq|self
     */
    public function callforwardbusyline(CallForwardBusyLineReq $callforwardbusyline = null)
    {
        if(null === $callforwardbusyline)
        {
            return $this->child('callforwardbusyline');
        }
        return $this->child('callforwardbusyline', $callforwardbusyline);
    }

    /**
     * Get or set callforwardnoanswer
     *
     * @param  CallForwardNoAnswerReq $callforwardnoanswer
     * @return CallForwardNoAnswerReq|self
     */
    public function callforwardnoanswer(CallForwardNoAnswerReq $callforwardnoanswer = null)
    {
        if(null === $callforwardnoanswer)
        {
            return $this->child('callforwardnoanswer');
        }
        return $this->child('callforwardnoanswer', $callforwardnoanswer);
    }

    /**
     * Get or set callwaiting
     *
     * @param  CallWaitingReq $callwaiting
     * @return CallWaitingReq|self
     */
    public function callwaiting(CallWaitingReq $callwaiting = null)
    {
        if(null === $callwaiting)
        {
            return $this->child('callwaiting');
        }
        return $this->child('callwaiting', $callwaiting);
    }

    /**
     * Get or set selectivecallforward
     *
     * @param  SelectiveCallForwardReq $selectivecallforward
     * @return SelectiveCallForwardReq|self
     */
    public function selectivecallforward(SelectiveCallForwardReq $selectivecallforward = null)
    {
        if(null === $selectivecallforward)
        {
            return $this->child('selectivecallforward');
        }
        return $this->child('selectivecallforward', $selectivecallforward);
    }

    /**
     * Get or set selectivecallacceptance
     *
     * @param  SelectiveCallAcceptanceReq $selectivecallacceptance
     * @return SelectiveCallAcceptanceReq|self
     */
    public function selectivecallacceptance(SelectiveCallAcceptanceReq $selectivecallacceptance = null)
    {
        if(null === $selectivecallacceptance)
        {
            return $this->child('selectivecallacceptance');
        }
        return $this->child('selectivecallacceptance', $selectivecallacceptance);
    }

    /**
     * Get or set selectivecallrejection
     *
     * @param  SelectiveCallRejectionReq $selectivecallrejection
     * @return SelectiveCallRejectionReq|self
     */
    public function selectivecallrejection(SelectiveCallRejectionReq $selectivecallrejection = null)
    {
        if(null === $selectivecallrejection)
        {
            return $this->child('selectivecallrejection');
        }
        return $this->child('selectivecallrejection', $selectivecallrejection);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'phone')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'phone')
    {
        return parent::toXml($name);
    }
}
