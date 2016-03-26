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
    private $_headers;

    /**
     * Constructor method for ConversationSpec
     * @param string $id Conversation ID
     * @param string $fetch If value is "1" or "all" the full expanded message structure is inlined for the first (or for all) messages in the conversation.
     * @param bool   $html Set to return defanged HTML content by default. (default is unset)
     * @param int    $max Maximum inlined length
     * @param int    $needExp Set to return group info (isGroup and exp flags) on <e> elements in the response (default is unset.)
     * @param array  $headers Requested headers.
     * @return self
     */
    public function __construct(
        $id,
        $fetch = null,
        $html = null,
        $max = null,
        $needExp = null,
        array $headers = []
    )
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        if(null !== $fetch)
        {
            $this->setProperty('fetch', trim($fetch));
        }
        if(null !== $html)
        {
            $this->setProperty('html', (bool) $html);
        }
        if(null !== $max)
        {
            $this->setProperty('max', (int) $max);
        }
        if(null !== $needExp)
        {
            $this->setProperty('needExp', (bool) $needExp);
        }

        $this->setHeaders($headers);
        $this->on('before', function(Base $sender)
        {
            if($sender->getHeaders()->count())
            {
                $sender->setChild('header', $sender->getHeaders()->all());
            }
        });
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets fetch
     *
     * @return string
     */
    public function getInlineRule()
    {
        return $this->getProperty('fetch');
    }

    /**
     * Sets fetch
     *
     * @param  string $inlineRule
     * @return self
     */
    public function setInlineRule($inlineRule)
    {
        return $this->setProperty('fetch', trim($inlineRule));
    }

    /**
     * Gets want html
     *
     * @return bool
     */
    public function getWantHtml()
    {
        return $this->getProperty('html');
    }

    /**
     * Sets want html
     *
     * @param  bool $wantHtml
     * @return self
     */
    public function setWantHtml($wantHtml)
    {
        return $this->setProperty('html', (bool) $wantHtml);
    }

    /**
     * Gets max
     *
     * @return bool
     */
    public function getMaxInlinedLength()
    {
        return $this->getProperty('max');
    }

    /**
     * Sets max
     *
     * @param  bool $maxInlinedLength
     * @return self
     */
    public function setMaxInlinedLength($maxInlinedLength)
    {
        return $this->setProperty('max', (int) $maxInlinedLength);
    }

    /**
     * Gets need can expand
     *
     * @return bool
     */
    public function getNeedCanExpand()
    {
        return $this->getProperty('needExp');
    }

    /**
     * Sets need can expand
     *
     * @param  bool $wantHtml
     * @return self
     */
    public function setNeedCanExpand($wantHtml)
    {
        return $this->setProperty('needExp', (bool) $wantHtml);
    }

    /**
     * Add header
     *
     * @param  AttributeName $header
     * @return self
     */
    public function addHeader(AttributeName $header)
    {
        $this->_headers->add($header);
        return $this;
    }

    /**
     * Sets header sequence
     *
     * @param  array $headers
     * @return self
     */
    function setHeaders(array $headers)
    {
        $this->_headers = new TypedSequence('Zimbra\Struct\AttributeName', $headers);
        return $this;
    }

    /**
     * Gets header sequence
     *
     * @return Sequence
     */
    public function getHeaders()
    {
        return $this->_headers;
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
