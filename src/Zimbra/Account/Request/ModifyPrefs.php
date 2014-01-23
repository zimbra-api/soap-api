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
use Zimbra\Soap\Request;

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
class ModifyPrefs extends Request
{
    /**
     * Specify the preferences to be modified
     * @var TypedSequence<Pref>
     */
    private $_pref;

    /**
     * Constructor method for ModifyPrefs
     * @param array $prefs Specify the preferences to be modified
     * @return self
     */
    public function __construct(array $prefs = array())
    {
        parent::__construct();
        $this->_pref = new TypedSequence('Zimbra\Account\Struct\Pref', $prefs);

        $this->addHook(function($sender)
        {
            $sender->child('pref', $sender->pref()->all());
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
        $this->_pref->add($pref);
        return $this;
    }

    /**
     * Gets pref Sequence
     *
     * @return Sequence
     */
    public function pref()
    {
        return $this->_pref;
    }
}
