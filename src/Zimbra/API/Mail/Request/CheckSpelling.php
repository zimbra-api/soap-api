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
use Zimbra\Utils\SimpleXML;

/**
 * CheckSpelling request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CheckSpelling extends Request
{
    /**
     * Text to spell check
     * @var string
     */
    protected $_value;

    /**
     * The optional name of the aspell dictionary that will be used to check spelling.
     * If not specified, the the dictionary will be either zimbraPrefSpellDictionary or the one for the account's locale, in that order.
     * @var string
     */
    private $_dictionary;

    /**
     * Comma-separated list of words to ignore just for this request.
     * These words are added to the user's personal dictionary of ignore words stored as zimbraPrefSpellIgnoreWord.
     * @var string
     */
    private $_ignore;

    /**
     * Constructor method for CheckSpelling
     * @param  string $value
     * @param  string $dictionary
     * @param  string $ignore
     * @return self
     */
    public function __construct($value = null, $dictionary = null, $ignore = null)
    {
        parent::__construct();
        $this->_value = trim($value);
        $this->_dictionary = trim($dictionary);
        $this->_ignore = trim($ignore);
    }

    /**
     * Get or set value
     *
     * @param  string $value
     * @return string|self
     */
    public function value($value = null)
    {
        if(null === $value)
        {
            return $this->_value;
        }
        $this->_value = trim($value);
        return $this;
    }

    /**
     * Get or set dictionary
     *
     * @param  string $dictionary
     * @return string|self
     */
    public function dictionary($dictionary = null)
    {
        if(null === $dictionary)
        {
            return $this->_dictionary;
        }
        $this->_dictionary = trim($dictionary);
        return $this;
    }

    /**
     * Get or set ignore
     *
     * @param  bool $ignore
     * @return bool|self
     */
    public function ignore($ignore = null)
    {
        if(null === $ignore)
        {
            return $this->_ignore;
        }
        $this->_ignore = trim($ignore);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = array(
            '_' => $this->_value,
        );
        if(!empty($this->_dictionary))
        {
            $this->array['dictionary'] = $this->_dictionary;
        }
        if(!empty($this->_ignore))
        {
            $this->array['ignore'] = $this->_ignore;
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
        $this->xml = new SimpleXML('<'.$this->requestName().'>'.$this->_value.'</'.$this->requestName().'>');
        if(!empty($this->_dictionary))
        {
            $this->xml->addAttribute('dictionary', $this->_dictionary);
        }
        if(!empty($this->_ignore))
        {
            $this->xml->addAttribute('ignore', $this->_ignore);
        }
        return parent::toXml();
    }
}
