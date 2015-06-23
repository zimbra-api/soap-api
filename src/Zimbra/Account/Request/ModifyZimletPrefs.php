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
    private $_zimlets;

    /**
     * Constructor method for ModifyZimletPrefs
     * @param array $zimlets Zimlet Preference Specifications
     * @return self
     */
    public function __construct(array $zimlets = [])
    {
        parent::__construct();
        $this->setZimlets($zimlets);

        $this->on('before', function(Base $sender)
        {
            if($sender->getZimlets()->count())
            {
                $sender->setChild('zimlet', $sender->getZimlets()->all());
            }
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
        $this->_zimlets->add($zimlet);
        return $this;
    }

    /**
     * Sets zimlet sequence
     *
     * @param array $zimlets
     * @return Sequence
     */
    function setZimlets(array $zimlets)
    {
        $this->_zimlets = new TypedSequence('Zimbra\Account\Struct\ZimletPrefsSpec', $zimlets);
        return $this;
    }

    /**
     * Gets zimlet sequence
     *
     * @return Sequence
     */
    public function getZimlets()
    {
        return $this->_zimlets;
    }
}
