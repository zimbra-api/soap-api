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
 * VoiceMailPrefsFeature struct class
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class VoiceMailPrefsFeature extends CallFeatureInfo
{
    /**
     * Preferences
     * @var TypedSequence<PrefInfo>
     */
    private $_prefs;

    /**
     * Constructor method for VoiceMailPrefsFeature
     * @param bool $subscribed Flag whether subscribed or not
     * @param bool $active Flag whether active or not
     * @param array $prefs
     * @return self
     */
    public function __construct($subscribed, $active, array $prefs = [])
    {
    	parent::__construct($subscribed, $active);
        $this->setPrefs($prefs);

        $this->on('before', function(Base $sender)
        {
            if($sender->getPrefs()->count())
            {
                $sender->setChild('pref', $sender->getPrefs()->all());
            }
        });
    }

    /**
     * Add a pref
     *
     * @param  PrefInfo $pref
     * @return self
     */
    public function addPref(PrefInfo $pref)
    {
        $this->_prefs->add($pref);
        return $this;
    }

    /**
     * Sets pref sequence
     *
     * @param array $prefs
     * @return self
     */
    public function setPrefs(array $prefs)
    {
        $this->_prefs = new TypedSequence('Zimbra\Voice\Struct\PrefInfo', $prefs);
        return $this;
    }

    /**
     * Gets pref sequence
     *
     * @return Sequence
     */
    public function getPrefs()
    {
        return $this->_prefs;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'voicemailprefs')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'voicemailprefs')
    {
        return parent::toXml($name);
    }
}
