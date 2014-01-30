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
 * SectionAttr struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SectionAttr extends Base
{
    /**
     * Constructor method for SectionAttr
     * @param string $section Metadata section key
     * @return self
     */
    public function __construct($section)
    {
        parent::__construct();
        $this->property('section', trim($section));
    }

    /**
     * Get or set section
     *
     * @param  string $section
     * @return string|self
     */
    public function section($section = null)
    {
        if(null === $section)
        {
            return $this->property('section');
        }
        return $this->property('section', trim($section));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'meta')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'meta')
    {
        return parent::toXml($name);
    }
}
