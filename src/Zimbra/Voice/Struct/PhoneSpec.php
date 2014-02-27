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
 * PhoneSpec struct class
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class PhoneSpec extends Base
{
    /**
     * Preferences
     * @var TypedSequence<PrefSpec>
     */
    private $_pref;

    /**
     * Constructor method for PhoneSpec
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
        $this->_pref = new TypedSequence('Zimbra\Voice\Struct\PrefSpec', $prefs);

        $this->on('before', function(Base $sender)
        {
            if($sender->pref()->count())
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
     * @param  PrefSpec $pref
     * @return self
     */
    public function addPref(PrefSpec $pref)
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
