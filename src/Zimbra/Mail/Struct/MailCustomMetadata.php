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
 * MailCustomMetadata class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class MailCustomMetadata extends MailKeyValuePairs
{
    /**
     * Constructor method for MailKeyValuePairs
     * @param string $section Section. Normally present. If absent this indicates that CustomMetadata info is present but there are no sections to report on.
     * @param array $a
     * @return self
     */
    public function __construct($section = null, array $a = array())
    {
        parent::__construct($a);
        if(null !== $section)
        {
            $this->property('section', trim($section));
        }
    }

    /**
     * Gets or sets section
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
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'meta')
    {
        return parent::toXml($name);
    }
}
