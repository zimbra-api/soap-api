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
use Zimbra\Soap\Struct\ConversationSpec;

/**
 * GetConv request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetConv extends Request
{
    /**
     * Conversation specification
     * @var ConversationSpec
     */
    private $_c;

    /**
     * Constructor method for GetConv
     * @param  ConversationSpec $c
     * @return self
     */
    public function __construct(ConversationSpec $c)
    {
        parent::__construct();
        $this->_c = $c;
    }

    /**
     * Get or set c
     *
     * @param  ConversationSpec $c
     * @return ConversationSpec|self
     */
    public function c(ConversationSpec $c = null)
    {
        if(null === $c)
        {
            return $this->_c;
        }
        $this->_c = $c;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array += $this->_c->toArray('c');
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_c->toXml('c'));
        return parent::toXml();
    }
}
