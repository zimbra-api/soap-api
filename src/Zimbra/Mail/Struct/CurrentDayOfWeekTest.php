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
 * CurrentDayOfWeekTest class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class CurrentDayOfWeekTest extends FilterTest
{
    /**
     * Constructor method for CurrentDayOfWeekTest
     * @param int $index
     * @param string $value
     * @param bool $negative
     * @return self
     */
    public function __construct(
        $index, $value = null, $negative = null
    )
    {
        parent::__construct($index, $negative);
        $this->property('value', trim($value));
    }

    /**
     * Gets or sets value
     *
     * @param  string $value
     * @return string|self
     */
    public function value($value = null)
    {
        if(null === $value)
        {
            return $this->property('value');
        }
        return $this->property('value', trim($value));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'currentDayOfWeekTest')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'currentDayOfWeekTest')
    {
        return parent::toXml($name);
    }
}
