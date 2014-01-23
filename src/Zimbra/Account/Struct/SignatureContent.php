<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use Zimbra\Enum\ContentType;
use Zimbra\Struct\Base;

/**
 * SignatureContent struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class SignatureContent extends Base
{
    /**
     * Constructor method for signatureContent
     * @param string $value
     * @param ContentType $type
     * @return self
     */
    public function __construct($value = null, ContentType $type = null)
    {
		parent::__construct(trim($value));
        if($type instanceof ContentType)
        {
			$this->property('type', $type);
        }
    }

    /**
     * Gets or sets type
     *
     * @param  ContentType $type
     * @return ContentType|self
     */
    public function type(ContentType $type = null)
    {
        if(null === $type)
        {
            return $this->property('type');
        }
        return $this->property('type', $type);
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray($name = 'content')
    {
        return parent::toArray($name);
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml($name = 'content')
    {
        return parent::toXml($name);
    }
}
