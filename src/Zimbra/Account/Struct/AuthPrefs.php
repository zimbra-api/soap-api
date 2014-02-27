<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\Base;

/**
 * AuthPrefs struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class AuthPrefs extends Base
{
    /**
     * Prefibutes
     * @var TypedSequence<Pref>
     */
    private $_pref;

    /**
     * Constructor method for AuthPrefs
     * @param array $prefs
     * @return self
     */
    public function __construct(array $prefs = array())
    {
		parent::__construct();
        $this->_pref = new TypedSequence('Zimbra\Account\Struct\Pref', $prefs);

        $this->on('before', function(Base $sender)
        {
            if($sender->pref()->count())
            {
                $sender->child('pref', $sender->pref()->all());
            }
        });
    }

    /**
     * Add an pref
     *
     * @param  Pref $pref
     * @return self
     */
    public function addPref(Pref $pref)
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
    public function toArray($name = 'prefs')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'prefs')
    {
        return parent::toXml($name);
    }
}
