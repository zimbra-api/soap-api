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
 * ModifyVoiceFeaturesSpec struct class
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyVoiceFeaturesSpec extends Base
{
    /**
     * Constructor method for ModifyVoiceFeaturesSpec
     * @param string $name
     * @param VoiceMailPrefsFeature $voicemailprefs
     * @param AnonCallRejectionFeature $anoncallrejection
     * @param CallerIdBlockingFeature $calleridblocking
     * @param CallForwardFeature $callforward
     * @param CallForwardBusyLineFeature $callforwardbusyline
     * @param CallForwardNoAnswerFeature $callforwardnoanswer
     * @param CallWaitingFeature $callwaiting
     * @param SelectiveCallForwardFeature $selectivecallforward
     * @param SelectiveCallAcceptanceFeature $selectivecallacceptance
     * @param SelectiveCallRejectionFeature $selectivecallrejection
     * @return self
     */
    public function __construct(
        $name,
        VoiceMailPrefsFeature $voicemailprefs = null,
        AnonCallRejectionFeature $anoncallrejection = null,
        CallerIdBlockingFeature $calleridblocking = null,
        CallForwardFeature $callforward = null,
        CallForwardBusyLineFeature $callforwardbusyline = null,
        CallForwardNoAnswerFeature $callforwardnoanswer = null,
        CallWaitingFeature $callwaiting = null,
        SelectiveCallForwardFeature $selectivecallforward = null,
        SelectiveCallAcceptanceFeature $selectivecallacceptance = null,
        SelectiveCallRejectionFeature $selectivecallrejection = null
    )
    {
        parent::__construct();
        $this->property('name', trim($name));
        if($voicemailprefs instanceof VoiceMailPrefsFeature)
        {
            $this->child('voicemailprefs', $voicemailprefs);
        }
        if($anoncallrejection instanceof AnonCallRejectionFeature)
        {
            $this->child('anoncallrejection', $anoncallrejection);
        }
        if($calleridblocking instanceof CallerIdBlockingFeature)
        {
            $this->child('calleridblocking', $calleridblocking);
        }
        if($callforward instanceof CallForwardFeature)
        {
            $this->child('callforward', $callforward);
        }
        if($callforwardbusyline instanceof CallForwardBusyLineFeature)
        {
            $this->child('callforwardbusyline', $callforwardbusyline);
        }
        if($callforwardnoanswer instanceof CallForwardNoAnswerFeature)
        {
            $this->child('callforwardnoanswer', $callforwardnoanswer);
        }
        if($callwaiting instanceof CallWaitingFeature)
        {
            $this->child('callwaiting', $callwaiting);
        }
        if($selectivecallforward instanceof SelectiveCallForwardFeature)
        {
            $this->child('selectivecallforward', $selectivecallforward);
        }
        if($selectivecallacceptance instanceof SelectiveCallAcceptanceFeature)
        {
            $this->child('selectivecallacceptance', $selectivecallacceptance);
        }
        if($selectivecallrejection instanceof SelectiveCallRejectionFeature)
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
     * @param  VoiceMailPrefsFeature $voicemailprefs
     * @return VoiceMailPrefsFeature|self
     */
    public function voicemailprefs(VoiceMailPrefsFeature $voicemailprefs = null)
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
     * @param  AnonCallRejectionFeature $anoncallrejection
     * @return AnonCallRejectionFeature|self
     */
    public function anoncallrejection(AnonCallRejectionFeature $anoncallrejection = null)
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
     * @param  CallerIdBlockingFeature $calleridblocking
     * @return CallerIdBlockingFeature|self
     */
    public function calleridblocking(CallerIdBlockingFeature $calleridblocking = null)
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
     * @param  CallForwardFeature $callforward
     * @return CallForwardFeature|self
     */
    public function callforward(CallForwardFeature $callforward = null)
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
     * @param  CallForwardBusyLineFeature $callforwardbusyline
     * @return CallForwardBusyLineFeature|self
     */
    public function callforwardbusyline(CallForwardBusyLineFeature $callforwardbusyline = null)
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
     * @param  CallForwardNoAnswerFeature $callforwardnoanswer
     * @return CallForwardNoAnswerFeature|self
     */
    public function callforwardnoanswer(CallForwardNoAnswerFeature $callforwardnoanswer = null)
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
     * @param  CallWaitingFeature $callwaiting
     * @return CallWaitingFeature|self
     */
    public function callwaiting(CallWaitingFeature $callwaiting = null)
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
     * @param  SelectiveCallForwardFeature $selectivecallforward
     * @return SelectiveCallForwardFeature|self
     */
    public function selectivecallforward(SelectiveCallForwardFeature $selectivecallforward = null)
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
     * @param  SelectiveCallAcceptanceFeature $selectivecallacceptance
     * @return SelectiveCallAcceptanceFeature|self
     */
    public function selectivecallacceptance(SelectiveCallAcceptanceFeature $selectivecallacceptance = null)
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
     * @param  SelectiveCallRejectionFeature $selectivecallrejection
     * @return SelectiveCallRejectionFeature|self
     */
    public function selectivecallrejection(SelectiveCallRejectionFeature $selectivecallrejection = null)
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
