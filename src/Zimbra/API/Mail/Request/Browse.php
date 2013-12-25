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
use Zimbra\Soap\Enum\BrowseBy;

/**
 * Browse request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Browse extends Request
{
    /**
     * Browse by setting - domains|attachments|objects
     * @var BrowseBy
     */
    private $_browseBy;

    /**
     * Regex string. Return only those results which match the specified regular expression
     * @var string
     */
    private $_regex;

    /**
     * Return only a maximum number of entries as requested.
     * If more than {max-entries} results exist, the server will return the first {max-entries}, sorted by frequency
     * @var int
     */
    private $_maxToReturn;

    /**
     * Constructor method for BounceMsg
     * @param  BrowseBy $browseBy
     * @return self
     */
    public function __construct(BrowseBy $browseBy, $regex = null, $maxToReturn = null)
    {
        parent::__construct();
        $this->_browseBy = $browseBy;
        $this->_regex = trim($regex);
        if(null !== $maxToReturn)
        {
            $this->_maxToReturn = (int) $maxToReturn;
        }
    }

    /**
     * Get or set browseBy
     *
     * @param  BrowseBy $browseBy
     * @return BrowseBy|self
     */
    public function browseBy(BrowseBy $browseBy = null)
    {
        if(null === $browseBy)
        {
            return $this->_browseBy;
        }
        $this->_browseBy = $browseBy;
        return $this;
    }

    /**
     * Get or set regex
     *
     * @param  string $regex
     * @return string|self
     */
    public function regex($regex = null)
    {
        if(null === $regex)
        {
            return $this->_regex;
        }
        $this->_regex = trim($regex);
        return $this;
    }

    /**
     * Get or set maxToReturn
     *
     * @param  int $maxToReturn
     * @return int|self
     */
    public function maxToReturn($maxToReturn = null)
    {
        if(null === $maxToReturn)
        {
            return $this->_maxToReturn;
        }
        $this->_maxToReturn = (int) $maxToReturn;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array['browseBy'] = (string) $this->_browseBy;
        if(!empty($this->_regex))
        {
            $this->array['regex'] = $this->_regex;
        }
        if(is_int($this->_maxToReturn))
        {
            $this->array['maxToReturn'] = $this->_maxToReturn;
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
        $this->xml->addAttribute('browseBy', (string) $this->_browseBy);
        if(!empty($this->_regex))
        {
            $this->xml->addAttribute('regex', $this->_regex);
        }
        if(is_int($this->_maxToReturn))
        {
            $this->xml->addAttribute('maxToReturn', $this->_maxToReturn);
        }
        return parent::toXml();
    }
}
