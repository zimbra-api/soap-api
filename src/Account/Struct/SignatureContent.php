<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Enum\ContentType;

/**
 * SignatureContent struct class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SignatureContent
{
    /**
     * @var ContentType
     */
    #[Accessor(getter: 'getContentType', setter: 'setContentType')]
    #[SerializedName(name: 'type')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\ContentType>')]
    #[XmlAttribute]
    private $type;

    /**
     * @var string
     */
    #[Accessor(getter: 'getValue', setter: 'setValue')]
    #[Type(name: 'string')]
    #[XmlValue(cdata: false)]
    private $value;

    /**
     * Constructor
     * 
     * @param string $value
     * @param ContentType $type
     * @return self
     */
    public function __construct(?string $value = NULL, ?ContentType $type = NULL)
    {
        if (NULL !== $value) {
            $this->setValue($value);
        }
        if ($type instanceof ContentType) {
            $this->setContentType($type);
        }
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param  string $value
     * @return self
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get content type
     *
     * @return ContentType
     */
    public function getContentType(): ?ContentType
    {
        return $this->type;
    }

    /**
     * Set content type
     *
     * @param  ContentType $type
     * @return self
     */
    public function setContentType(ContentType $type): self
    {
        $this->type = $type;
        return $this;
    }
}
