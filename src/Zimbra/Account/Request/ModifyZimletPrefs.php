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

use Zimbra\Account\Struct\ZimletPrefsSpec as Zimlet;
use Zimbra\Common\TypedSequence;

/**
 * ModifyZimletPrefs request class
 * Modify Zimlet Preferences
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyZimletPrefs extends Base
{
    /**
     * Zimlet Preference Specifications
     * @var TypedSequence<ZimletPrefsSpec>
     */
    private $_zimlet;

    /**
     * Constructor method for ModifyZimletPrefs
     * @param array $zimlet Zimlet Preference Specifications
     * @return self
     */
    public function __construct(array $zimlet = array())
    {
        parent::__construct();
        $this->_zimlet = new TypedSequence('Zimbra\Account\Struct\ZimletPrefsSpec', $zimlet);

        $this->addHook(function($sender)
        {
            $sender->child('zimlet', $sender->zimlet()->all());
        });
    }

    /**
     * Add a zimlet
     *
     * @param  ZimletPrefsSpec $zimlet
     * @return self
     */
    public function addZimlet(Zimlet $zimlet)
    {
        $this->_zimlet->add($zimlet);
        return $this;
    }

    /**
     * Gets zimlet sequence
     *
     * @return Sequence
     */
    public function zimlet()
    {
        return $this->_zimlet;
    }
}
