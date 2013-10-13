<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Account\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\ZimletPrefsSpec as Zimlet;
use Zimbra\Utils\TypedSequence;

/**
 * ModifyZimletPrefs class
 * Modify Zimlet Preferences
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ModifyZimletPrefs extends Request
{
    /**
     * Zimlet Preference Specifications
     * @var array
     */
    private $_zimlets = array();

    /**
     * Constructor method for ModifyZimletPrefs
     * @param array $zimlets
     * @return self
     */
    public function __construct(array $zimlets = array())
    {
        parent::__construct();
        $this->_zimlets = new TypedSequence('Zimbra\Soap\Struct\ZimletPrefsSpec', $zimlets);
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
     * Gets zimlet sequence
     *
     * @param  array $zimlets
     * @return Sequence
     */
    public function zimlets()
    {
        return $this->_zimlets;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(count($this->_zimlets))
        {
            $this->array['zimlet'] = array();
            foreach ($this->_zimlets as $zimlet)
            {
                $zimletArr = $zimlet->toArray();
                $this->array['zimlet'][] = $zimletArr['zimlet'];
            }
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        foreach ($this->_zimlets as $zimlet)
        {
            $this->xml->append($zimlet->toXml());
        }
        return parent::toXml();
    }
}
