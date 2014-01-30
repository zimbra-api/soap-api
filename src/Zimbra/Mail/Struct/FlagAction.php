<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

/**
 * FlagAction struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class FlagAction extends FilterAction
{
    /**
     * Constructor method for FlagAction
     * @param int $index Index - specifies a guaranteed order for the action elements
     * @param string $flagName Flag name
     * @return self
     */
    public function __construct($index, $flagName = null)
    {
        parent::__construct($index);
        if(null !== $flagName)
        {
            $this->property('flagName', trim($flagName));
        }
    }

    /**
     * Gets or sets flagName
     *
     * @param  string $flagName
     * @return string|self
     */
    public function flagName($flagName = null)
    {
        if(null === $flagName)
        {
            return $this->property('flagName');
        }
        return $this->property('flagName', trim($flagName));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'actionFlag')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'actionFlag')
    {
        return parent::toXml($name);
    }
}
