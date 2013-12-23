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
     * @var TypedSequence
     */
    private $_zimlet;

    /**
     * Constructor method for ModifyZimletPrefs
     * @param array $zimlet
     * @return self
     */
    public function __construct(array $zimlet = array())
    {
        parent::__construct();
        $this->_zimlet = new TypedSequence('Zimbra\Soap\Struct\ZimletPrefsSpec', $zimlet);
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

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(count($this->_zimlet))
        {
            $this->array['zimlet'] = array();
            foreach ($this->_zimlet as $zimlet)
            {
                $zimletArr = $zimlet->toArray('zimlet');
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
        foreach ($this->_zimlet as $zimlet)
        {
            $this->xml->append($zimlet->toXml('zimlet'));
        }
        return parent::toXml();
    }
}
