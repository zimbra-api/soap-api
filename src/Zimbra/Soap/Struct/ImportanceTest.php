<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Struct;

use Zimbra\Soap\Enum\Importance;
use Zimbra\Utils\SimpleXML;

/**
 * ImportanceTest class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ImportanceTest extends FilterTest
{
    /**
     * Importance
     * @var Importance
     */
    private $_imp;

    /**
     * Constructor method for ImportanceTest
     * @param int $index
     * @param string $imp
     * @param bool $negative
     * @return self
     */
    public function __construct(
    	$index, Importance $imp, $negative = null
	)
    {
    	parent::__construct($index, $negative);
        $this->_imp = $imp;
    }

    /**
     * Gets or sets imp
     *
     * @param  Importance $imp
     * @return Importance|self
     */
    public function imp(Importance $imp = null)
    {
        if(null === $imp)
        {
            return $this->_imp;
        }
        $this->_imp = $imp;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'importanceTest')
    {
        $name = !empty($name) ? $name : 'importanceTest';
        $arr = parent::toArray($name);
        $arr[$name]['imp'] = (string) $this->_imp;
        return $arr;
    }

    /**
     * Method returning the xml representative this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'importanceTest')
    {
        $name = !empty($name) ? $name : 'importanceTest';
        $xml = parent::toXml($name);
        $xml->addAttribute('imp', (string) $this->_imp);
        return $xml;
    }
}
