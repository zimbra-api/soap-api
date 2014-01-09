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

use Zimbra\Soap\Enum\Action;
use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\Id;
use Zimbra\Soap\Struct\EmailAddrInfo;
use Zimbra\Utils\TypedSequence;

/**
 * SendVerificationCode request class
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SendVerificationCode extends Request
{
    /**
     * Device email address
     * @var string
     */
    private $_a;

    /**
     * Constructor method for SendVerificationCode
     * @param  string $a
     * @return self
     */
    public function __construct($a = null)
    {
        parent::__construct();
        $this->_a = trim($a);
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
            $this->xml->addAttribute('a', $this->_a);
        }
        return parent::toXml();
    }
}