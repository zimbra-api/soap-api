<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};

/**
 * AddressBookTest struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="addressBookTest")
 */
class AddressBookTest extends FilterTest
{
    /**
     * Header name
     * @Accessor(getter="getHeader", setter="setHeader")
     * @SerializedName("header")
     * @Type("string")
     * @XmlAttribute
     */
    private $header;

    /**
     * Constructor method for AddressBookTest
     * 
     * @param int $index
     * @param bool $negative
     * @param string $header
     * @return self
     */
    public function __construct(?int $index = NULL, ?bool $negative = NULL, ?string $header = NULL)
    {
    	parent::__construct($index, $negative);
        if (NULL !== $header) {
            $this->setHeader($header);
        }
    }

    /**
     * Gets header
     *
     * @return string
     */
    public function getHeader(): ?string
    {
        return $this->header;
    }

    /**
     * Sets header
     *
     * @param  string $header
     * @return self
     */
    public function setHeader(string $header)
    {
        $this->header = $header;
        return $this;
    }
}
