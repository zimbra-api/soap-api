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

use Zimbra\Common\TypedSequence;
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
     * Call features
     * @var TypedSequence<CallFeatureInfo>
     */
    private $_callFeatures;

    /**
     * Constructor method for ModifyVoiceFeaturesSpec
     * @param string $name Phone name
     * @param array $callFeatures Call features
     * @return self
     */
    public function __construct(
        $name,
        array $callFeatures = []
    )
    {
        parent::__construct();
        $this->setProperty('name', trim($name));
        $this->setCallFeatures($callFeatures);

        $this->on('before', function(Base $sender)
        {
            if($sender->getCallFeatures()->count())
            {
                foreach ($sender->getCallFeatures()->all() as $callFeature)
                {
                    if($callFeature instanceof VoiceMailPrefsFeature)
                    {
                        $this->setChild('voicemailprefs', $callFeature);
                    }
                    if($callFeature instanceof AnonCallRejectionFeature)
                    {
                        $this->setChild('anoncallrejection', $callFeature);
                    }
                    if($callFeature instanceof CallerIdBlockingFeature)
                    {
                        $this->setChild('calleridblocking', $callFeature);
                    }
                    if($callFeature instanceof CallForwardFeature)
                    {
                        $this->setChild('callforward', $callFeature);
                    }
                    if($callFeature instanceof CallForwardBusyLineFeature)
                    {
                        $this->setChild('callforwardbusyline', $callFeature);
                    }
                    if($callFeature instanceof CallForwardNoAnswerFeature)
                    {
                        $this->setChild('callforwardnoanswer', $callFeature);
                    }
                    if($callFeature instanceof CallWaitingFeature)
                    {
                        $this->setChild('callwaiting', $callFeature);
                    }
                    if($callFeature instanceof SelectiveCallForwardFeature)
                    {
                        $this->setChild('selectivecallforward', $callFeature);
                    }
                    if($callFeature instanceof SelectiveCallAcceptanceFeature)
                    {
                        $this->setChild('selectivecallacceptance', $callFeature);
                    }
                    if($callFeature instanceof SelectiveCallRejectionFeature)
                    {
                        $this->setChild('selectivecallrejection', $callFeature);
                    }
                }
            }
        });
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Add a call feature
     *
     * @param  CallFeatureInfo $callFeature
     * @return self
     */
    public function addCallFeature(CallFeatureInfo $callFeature)
    {
        $this->_callFeatures->add($callFeature);
        return $this;
    }

    /**
     * Sets call feature sequence
     *
     * @param  array $callFeatures
     * @return self
     */
    public function setCallFeatures(array $callFeatures)
    {
        $this->_callFeatures = new TypedSequence('Zimbra\Voice\Struct\CallFeatureInfo', $callFeatures);
        return $this;
    }

    /**
     * Gets call feature sequence
     *
     * @return Sequence
     */
    public function getCallFeatures()
    {
        return $this->_callFeatures;
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
