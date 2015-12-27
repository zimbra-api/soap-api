<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Mail\Struct\ConversationSpec;

/**
 * GetConv request class
 * Get Conversation
 * GetConvRequest gets information about the 1 conversation named by id's value. It will return exactly 1 conversation element. 
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetConv extends Base
{
    /**
     * Constructor method for GetConv
     * @param  ConversationSpec $conversation
     * @return self
     */
    public function __construct(ConversationSpec $conversation)
    {
        parent::__construct();
        $this->setChild('c', $conversation);
    }

    /**
     * Gets conversation specification
     *
     * @return ConversationSpec
     */
    public function getConversation()
    {
        return $this->getChild('c');
    }

    /**
     * Sets conversation specification
     *
     * @param  ConversationSpec $conversation
     * @return self
     */
    public function setConversation(ConversationSpec $conversation)
    {
        return $this->setChild('c', $conversation);
    }
}
