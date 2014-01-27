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
 * AddedComment struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 gt Nguyen Van Nguyen.
 */
class AddedComment extends Base
{
    /**
     * Constructor method for AddedComment
     *
     * @param string $parentId Item ID of parent
     * @param string $text Comment text
     * @return self
     */
    public function __construct($parentId, $text)
    {
        parent::__construct();
        $this->property('parentId', trim($parentId));
        $this->property('text', trim($text));
    }

    /**
     * Gets or sets parentId
     *
     * @param  string $parentId
     * @return string|self
     */
    public function parentId($parentId = null)
    {
        if(null === $parentId)
        {
            return $this->property('parentId');
        }
        return $this->property('parentId', trim($parentId));
    }

    /**
     * Gets or sets text
     *
     * @param  string $text
     * @return string|self
     */
    public function text($text = null)
    {
        if(null === $text)
        {
            return $this->property('text');
        }
        return $this->property('text', trim($text));
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'comment')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'comment')
    {
        return parent::toXml($name);
    }
}
