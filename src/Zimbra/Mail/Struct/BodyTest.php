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
 * BodyTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class BodyTest extends FilterTest
{
    /**
     * Constructor method for BodyTest
     * @param int $index Index - specifies a guaranteed order for the test elements
     * @param string $value Value
     * @param bool $caseSensitive Case sensitive
     * @param bool $negative Specifies a "not" condition for the test
     * @return self
     */
    public function __construct(
        $index,
        $value = null,
        $caseSensitive = null,
        $negative = null
    )
    {
        parent::__construct($index, $negative);
        if(null !== $value)
        {
            $this->property('value', trim($value));
        }
        if(null !== $caseSensitive)
        {
            $this->property('caseSensitive', (bool) $caseSensitive);
        }
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
     * Gets or sets caseSensitive
     *
     * @param  bool $caseSensitive
     * @return bool|self
     */
    public function caseSensitive($caseSensitive = null)
    {
        if(null === $caseSensitive)
        {
            return $this->property('caseSensitive');
        }
        return $this->property('caseSensitive', (bool) $caseSensitive);
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'bodyTest')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'bodyTest')
    {
        return parent::toXml($name);
    }
}
