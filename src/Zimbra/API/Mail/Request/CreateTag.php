<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Mail\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\TagSpec;

/**
 * CreateTag request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateTag extends Request
{
    /**
     * Tag specification
     * @var TagSpec
     */
    private $_tag;

    /**
     * Constructor method for CreateTag
     * @param  TagSpec $tag
     * @return self
     */
    public function __construct(TagSpec $tag)
    {
        parent::__construct();
        $this->_tag = $tag;
    }

    /**
     * Get or set tag
     *
     * @param  TagSpec $tag
     * @return TagSpec|self
     */
    public function tag(TagSpec $tag = null)
    {
        if(null === $tag)
        {
            return $this->_tag;
        }
        $this->_tag = $tag;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array += $this->_tag->toArray('tag');
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_tag->toXml('tag'));
        return parent::toXml();
    }
}
