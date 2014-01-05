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

use Zimbra\Utils\SimpleXML;
use Zimbra\Utils\TypedSequence;

/**
 * ConversationSpec struct class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ConversationSpec
{
    /**
     * Conversation ID
     * @var string
     */
    private $_id;

    /**
     * If value is "1" or "all" the full expanded message structure is inlined for the first (or for all) messages in the conversation.
     * If fetch="{item-id}", only the message with the given {item-id} is expanded inline
     * @var string
     */
    private $_fetch;

    /**
     * Set to return defanged HTML content by default. (default is unset)
     * @var bool
     */
    private $_html;

    /**
     * Maximum inlined length
     * @var int
     */
    private $_max;

    /**
     * Requested headers.
     * If <header>s are requested, any matching headers are inlined into the response (not available when raw is set)
     * @var TypedSequence<AttributeName>
     */
    private $_header;

    /**
     * Constructor method for ConversationSpec
     * @param string $id
     * @param array  $header
     * @param string $fetch
     * @param bool   $html
     * @param int    $max
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
        $this->_id = trim($id);
        $this->_header = new TypedSequence('Zimbra\Soap\Struct\AttributeName', $header);
        $this->_fetch = trim($fetch);
        if(null !== $html)
        {
            $this->_html = (bool) $html;
        }
        if(null !== $max)
        {
            $this->_max = (int) $max;
        }
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
            return $this->_id;
        }
        $this->_id = trim($id);
        return $this;
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
            return $this->_fetch;
        }
        $this->_fetch = trim($fetch);
        return $this;
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
            return $this->_html;
        }
        $this->_html = (bool) $html;
        return $this;
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
            return $this->_max;
        }
        $this->_max = (int) $max;
        return $this;
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
        $name = !empty($name) ? $name : 'c';
        $arr = array(
            'id' => $this->_id,
        );
        if(!empty($this->_fetch))
        {
            $arr['fetch'] = $this->_fetch;
        }
        if(is_bool($this->_html))
        {
            $arr['html'] = $this->_html ? 1 : 0;
        }
        if(is_int($this->_max))
        {
            $arr['max'] = $this->_max;
        }
        if(count($this->_header))
        {
            $arr['header'] = array();
            foreach ($this->_header as $header)
            {
                $headerArr = $header->toArray('header');
                $arr['header'][] = $headerArr['header'];
            }
        }

        return array($name => $arr);
    }

    /**
     * Method returning the xml representative this class
     *
     * @param  string $name
     * @return SimpleXML
     */
    public function toXml($name = 'c')
    {
        $name = !empty($name) ? $name : 'c';
        $xml = new SimpleXML('<'.$name.' />');
        $xml->addAttribute('id', $this->_id);
        if(!empty($this->_fetch))
        {
            $xml->addAttribute('fetch', $this->_fetch);
        }
        if(is_bool($this->_html))
        {
            $xml->addAttribute('html', $this->_html ? 1 : 0);
        }
        if(is_int($this->_max))
        {
            $xml->addAttribute('max', $this->_max);
        }
        foreach ($this->_header as $header)
        {
            $xml->append($header->toXml('header'));
        }
        return $xml;
    }

    /**
     * Method returning the xml string representative this class
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toXml()->asXml();
    }
}
