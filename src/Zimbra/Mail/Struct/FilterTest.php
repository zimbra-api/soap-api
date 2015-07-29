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

use Zimbra\Struct\Base;

/**
 * FilterTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class FilterTest extends Base
{
    /**
     * Constructor method for FilterTest
     * @param int $index Index - specifies a guaranteed order for the test elements
     * @param bool $negative Specifies a "not" condition for the test
     * @return self
     */
    public function __construct($index, $negative = null)
    {
        parent::__construct();
        $this->setProperty('index', (int) $index);
        if(null !== $negative)
        {
            $this->setProperty('negative', (bool) $negative);
        }
    }

    /**
     * Gets index
     *
     * @return int
     */
    public function getIndex()
    {
        return $this->getProperty('index');
    }

    /**
     * Sets index
     *
     * @param  int $index
     * @return self
     */
    public function setIndex($index)
    {
        return $this->setProperty('index', (int) $index);
    }

    /**
     * Gets negative
     *
     * @return bool
     */
    public function getNegative()
    {
        return $this->getProperty('negative');
    }

    /**
     * Sets negative
     *
     * @param  bool $negative
     * @return self
     */
    public function setNegative($negative)
    {
        return $this->setProperty('negative', (bool) $negative);
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'filterTest')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'filterTest')
    {
        return parent::toXml($name);
    }
}
