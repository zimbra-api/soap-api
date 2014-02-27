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

use Zimbra\Common\TypedSequence;
use Zimbra\Struct\AttributeName;
use Zimbra\Struct\Base;

/**
 * ConversationSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ConversationSpec extends Base
{
    /**
     * Requested headers.
     * If <header>s are requested, any matching headers are inlined into the response (not available when raw is set)
     * @var TypedSequence<AttributeName>
     */
    private $_header;

    /**
     * Constructor method for ConversationSpec
     * @param string $id Conversation ID
     * @param array  $header Requested headers.
     * @param string $fetch If value is "1" or "all" the full expanded message structure is inlined for the first (or for all) messages in the conversation.
     * @param bool   $html Set to return defanged HTML content by default. (default is unset)
     * @param int    $max Maximum inlined length
     * @return self
     */
    public function __construct(
        $id,
        array $header = array(),
        $fetch = null,
        $html = null,
        $max = null
    )
    {
        parent::__construct();
        $this->property('id', trim($id));
        $this->_header = new TypedSequence('Zimbra\Struct\AttributeName', $header);
        if(null !== $fetch)
        {
            $this->property('fetch', trim($fetch));
        }
        if(null !== $html)
        {
            $this->property('html', (bool) $html);
        }
        if(null !== $max)
        {
            $this->property('max', (int) $max);
        }

        $this->on('before', function(Base $sender)
        {
            if($sender->header()->count())
            {
                $sender->child('header', $sender->header()->all());
            }
        });
    }

    /**
     * Gets or sets id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Gets or sets fetch
     *
     * @param  string $fetch
     * @return string|self
     */
    public function fetch($fetch = null)
    {
        if(null === $fetch)
        {
            return $this->property('fetch');
        }
        return $this->property('fetch', trim($fetch));
    }

    /**
     * Gets or sets html
     *
     * @param  bool $html
     * @return bool|self
     */
    public function html($html = null)
    {
        if(null === $html)
        {
            return $this->property('html');
        }
        return $this->property('html', (bool) $html);
    }

    /**
     * Gets or sets max
     *
     * @param  int $max
     * @return int|self
     */
    public function max($max = null)
    {
        if(null === $max)
        {
            return $this->property('max');
        }
        return $this->property('max', (int) $max);
    }

    /**
     * Add header
     *
     * @param  AttributeName $header
     * @return self
     */
    public function addHeader(AttributeName $header)
    {
        $this->_header->add($header);
        return $this;
    }

    /**
     * Gets header sequence
     *
     * @return Sequence
     */
    public function header()
    {
        return $this->_header;
    }

    /**
     * Returns the array representation of this class 
     *
     * @param  string $name
     * @return array
     */
    public function toArray($name = 'c')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'c')
    {
        return parent::toXml($name);
    }
}
