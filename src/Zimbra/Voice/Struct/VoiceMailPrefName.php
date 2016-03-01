<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Voice\Struct;

use Zimbra\Struct\Base;

/**
 * VoiceMailPrefName struct class
 *
 * @package    Zimbra
 * @subpackage Voice
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class VoiceMailPrefName extends Base
{
    /**
     * Constructor method for VoiceMailPrefName
     * @param string $name
     * @return self
     */
    public function __construct($name)
    {
        parent::__construct();
        $this->setProperty('name', trim($name));
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getProperty('name');
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        return $this->setProperty('name', trim($name));
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
