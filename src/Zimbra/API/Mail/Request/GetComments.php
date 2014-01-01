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
use Zimbra\Soap\Struct\ParentId;

/**
 * GetComments request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetComments extends Request
{
    /**
     * Added comment
     * @var ParentId
     */
    private $_comment;

    /**
     * Constructor method for GetComments
     * @param  ParentId $comment
     * @return self
     */
    public function __construct(ParentId $comment)
    {
        parent::__construct();
        $this->_comment = $comment;
    }

    /**
     * Get or set comment
     *
     * @param  ParentId $comment
     * @return ParentId|self
     */
    public function comment(ParentId $comment = null)
    {
        if(null === $comment)
        {
            return $this->_comment;
        }
        $this->_comment = $comment;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array += $this->_comment->toArray('comment');
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_comment->toXml('comment'));
        return parent::toXml();
    }
}
