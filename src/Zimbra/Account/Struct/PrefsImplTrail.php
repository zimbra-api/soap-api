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
trait PrefsImplTrail
{
    /**
     * Prefibutes
     * @var TypedSequence<Pref>
     */
    private $_prefs;

    /**
     * Constructor method for AuthPrefs
     * @param array $prefs
     * @return self
     */
    public function __construct(array $prefs = [])
    {
		parent::__construct();
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
     * Add an pref
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
     * @param  array $prefs
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
