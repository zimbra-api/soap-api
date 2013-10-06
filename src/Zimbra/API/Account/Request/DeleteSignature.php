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
use Zimbra\Soap\Struct\NameId;

/**
 * DeleteSignature class
 * Delete a signature
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DeleteSignature extends Request
{
    /**
     * Details of the signature to delete
     * @var NameId
     */
    public $_signature;

    /**
     * Constructor method for DeleteSignature
     * @param NameId $_identity
     * @return self
     */
    public function __construct(NameId $signature)
    {
        parent::__construct();
        $this->_signature = $signature;
    }

    /**
     * Gets or sets signature
     *
     * @param  NameId $signature
     * @return NameId|self
     */
    public function signature(NameId $signature = null)
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
        $this->array = $this->_signature->toArray('signature');
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_signature->toXml('signature'));
        return parent::toXml();
    }
}
