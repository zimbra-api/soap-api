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

use Zimbra\Struct\Base;

/**
 * Preference struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class Pref extends Base
{
    /**
     * Constructor method for preference
     * @param  string $name
     * @param  string $value
     * @param  int   $modified
     * @return self
     */
    public function __construct($name, $value = null, $modified = null)
    {
		parent::__construct(trim($value));
        $this->setProperty('name', trim($name));
        if(null !== $modified)
        {
            $this->setProperty('modified', (int) $modified);
        }
    }

    /**
     * Gets preference name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets preference name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
    }

    /**
     * Get preference modified time
     *
     * @return int
     */
    public function getModified()
    {
        return $this->getProperty('modified');
    }

    /**
     * Sets preference modified time
     *
     * @param  int $modified
     * @return self
     */
    public function setModified($modified)
    {
        return $this->setProperty('modified', (int) $modified);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'pref')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'pref')
    {
        return parent::toXml($name);
    }
}
