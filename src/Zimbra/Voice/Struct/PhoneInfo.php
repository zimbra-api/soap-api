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
 * PhoneInfo struct class
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class PhoneInfo extends Base
{
    /**
     * Preferences
     * @var TypedSequence<PrefInfo>
     */
    private $_pref;

    /**
     * Constructor method for PhoneInfo
     * @param array $prefs
     * @return self
     */
    public function __construct($name = null, array $prefs = array())
    {
        parent::__construct();
        if(null !== $name)
        {
            $this->property('name', trim($name));
        }
        $this->_pref = new TypedSequence('Zimbra\Voice\Struct\PrefInfo', $prefs);

        $this->addHook(function($sender)
        {
            if(count($sender->pref()))
            {
                $sender->child('pref', $sender->pref()->all());
            }
        });
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
     * Add an pref
     *
     * @param  PrefInfo $pref
     * @return self
     */
    public function addPref(PrefInfo $pref)
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
