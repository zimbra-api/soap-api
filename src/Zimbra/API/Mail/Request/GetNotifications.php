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

/**
 * GetNotifications request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetNotifications extends Request
{
    /**
     * If set then all the notifications will be marked as seen.
     * Default: unset
     * @var bool
     */
    private $_markSeen;

    /**
     * Constructor method for GetNotifications
     * @param  bool $markSeen
     * @return self
     */
    public function __construct($markSeen = null)
    {
        parent::__construct();
        if(null !== $markSeen)
        {
            $this->_markSeen = (bool) $markSeen;
        }
    }

    /**
     * Get or set markSeen
     *
     * @param  bool $markSeen
     * @return bool|self
     */
    public function markSeen($markSeen = null)
    {
        if(null === $markSeen)
        {
            return $this->_markSeen;
        }
        $this->_markSeen = (bool) $markSeen;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(is_bool($this->_markSeen))
        {
            $this->array['markSeen'] = $this->_markSeen ? 1 : 0;
        }
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        if(is_bool($this->_markSeen))
        {
            $this->xml->addAttribute('markSeen', $this->_markSeen ? 1 : 0);
        }
        return parent::toXml();
    }
}
