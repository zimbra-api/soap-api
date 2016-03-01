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

use Zimbra\Enum\Importance;

/**
 * ImportanceTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ImportanceTest extends FilterTest
{
    /**
     * Constructor method for ImportanceTest
     * @param int $index Index - specifies a guaranteed order for the test elements
     * @param string $imp Importance
     * @param bool $negative Specifies a "not" condition for the test
     * @return self
     */
    public function __construct(
        $index, Importance $imp, $negative = null
    )
    {
        parent::__construct($index, $negative);
        $this->setProperty('imp', $imp);
    }

    /**
     * Gets importance
     *
     * @return Importance
     */
    public function getImportance()
    {
        return $this->getProperty('imp');
    }

    /**
     * Sets importance
     *
     * @param  Importance $imp
     * @return self
     */
    public function setImportance(Importance $imp)
    {
        return $this->setProperty('imp', $imp);
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'importanceTest')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'importanceTest')
    {
        return parent::toXml($name);
    }
}
