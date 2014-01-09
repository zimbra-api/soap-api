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
 * VerifyCode request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class VerifyCode extends Request
{
    /**
     * Device email address
     * @var string
     */
    private $_a;

    /**
     * Verification code
     * @var string
     */
    private $_code;

    /**
     * Constructor method for VerifyCode
     * @param  string $a
     * @param  string $code
     * @return self
     */
    public function __construct(
        $a = null,
        $code = null
    )
    {
        parent::__construct();
        $this->_a = trim($a);
        $this->_code = trim($code);
    }

    /**
     * Get or set a
     *
     * @param  string $a
     * @return string|self
     */
    public function a($a = null)
    {
        if(null === $a)
        {
            return $this->_a;
        }
        $this->_a = trim($a);
        return $this;
    }

    /**
     * Get or set code
     *
     * @param  string $code
     * @return string|self
     */
    public function code($code = null)
    {
        if(null === $code)
        {
            return $this->_code;
        }
        $this->_code = trim($code);
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        if(!empty($this->_a))
        {
            $this->array['a'] = $this->_a;
        }
        if(!empty($this->_code))
        {
            $this->array['code'] = $this->_code;
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
        if(!empty($this->_a))
        {
            $this->xml->addAttribute('a', (string) $this->_a);
        }
        if(!empty($this->_code))
        {
            $this->xml->addAttribute('code', $this->_code);
        }
        return parent::toXml();
    }
}
