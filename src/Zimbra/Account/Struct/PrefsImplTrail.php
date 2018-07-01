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

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlList;

/**
 * AuthPrefs struct class
 * 
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
trait PrefsImplTrail
{
    /**
     * Prefibutes
     * @Accessor(getter="getPrefs", setter="setPrefs")
     * @Type("array<Zimbra\Account\Struct\Pref>")
     * @XmlList(inline = true, entry = "pref")
     */
    private $_prefs;

    /**
     * Constructor method for AuthPrefs
     * @param array $prefs
     * @return self
     */
    public function __construct(array $prefs = [])
    {
        $this->setPrefs($prefs);
    }

    /**
     * Add a pref
     *
     * @param  Pref $pref
     * @return self
     */
    public function addPref(Pref $pref)
    {
        $this->_prefs[] = $pref;
        return $this;
    }

    /**
     * Sets pref sequence
     *
     * @param  array $prefs
     * @return self
     */
    public function setPrefs(array $prefs)
    {
        $this->_prefs = [];
        foreach ($prefs as $pref) {
            if ($pref instanceof Pref) {
                $this->_prefs[] = $pref;
            }
        }
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
}
