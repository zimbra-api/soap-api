<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Account\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\Signature;

/**
 * CreateSignature class
 * Create a signature.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class CreateSignature extends Request
{
    /**
     * The signature
     * @var Signature
     */
    private $_signature;

    /**
     * Constructor method for CreateSignature
     * @param Signature $_signature
     * @return self
     */
    public function __construct(Signature $signature)
    {
        parent::__construct();
        $this->_signature = $signature;
    }

    /**
     * Gets or sets signature
     *
     * @param  Signature $signature
     * @return Signature|self
     */
    public function signature(Signature $signature = null)
    {
        if(null === $signature)
        {
            return $this->_signature;
        }
        $this->_signature = $signature;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = $this->_signature->toArray();
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_signature->toXml());
        return parent::toXml();
    }
}
