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
 * VoiceMailPrefsReq struct class
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class VoiceMailPrefsReq extends Base
{
    /**
     * Preferences
     * @var TypedSequence<VoiceMailPrefName>
     */
    private $_pref;

    /**
     * Constructor method for VoiceMailPrefsReq
     * @param array $prefs
     * @return self
     */
    public function __construct(array $prefs = array())
    {
        parent::__construct();
        $this->_pref = new TypedSequence('Zimbra\Voice\Struct\VoiceMailPrefName', $prefs);

        $this->addHook(function($sender)
        {
            if(count($sender->pref()))
            {
                $sender->child('pref', $sender->pref()->all());
            }
        });
    }

    /**
     * Add a pref
     *
     * @param  VoiceMailPrefName $pref
     * @return self
     */
    public function addPref(VoiceMailPrefName $pref)
    {
        $this->_pref->add($pref);
        return $this;
    }

    /**
     * Gets pref sequence
     *
     * @return Sequence
     */
    public function pref()
    {
        return $this->_pref;
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
