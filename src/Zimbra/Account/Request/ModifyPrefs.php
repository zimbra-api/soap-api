<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Request;

use Zimbra\Account\Struct\Pref;
use Zimbra\Common\TypedSequence;

/**
 * ModifyPrefs request class
 * Modify Preferences
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyPrefs extends Base
{
    /**
     * Specify the preferences to be modified
     * @var TypedSequence<Pref>
     */
    private $_prefs;

    /**
     * Constructor method for ModifyPrefs
     * @param array $prefs Specify the preferences to be modified
     * @return self
     */
    public function __construct(array $prefs = array())
    {
        parent::__construct();
        $this->setPrefs($prefs);

        $this->on('before', function(Base $sender)
        {
            if($sender->getPrefs()->count())
            {
                $sender->child('pref', $sender->getPrefs()->all());
            }
        });
    }

    /**
     * Add a pref
     *
     * @param  Pref $pref
     * @return self
     */
    public function addPref(Pref $pref)
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
        $this->_prefs = new TypedSequence('Zimbra\Account\Struct\Pref', $prefs);
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
