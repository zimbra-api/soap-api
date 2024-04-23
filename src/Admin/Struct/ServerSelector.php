<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};
use Zimbra\Common\Enum\ServerBy;

/**
 * ServerSelector struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ServerSelector
{
    /**
     * Selects the meaning of {server-key}
     * 
     * @var ServerBy
     */
    #[Accessor(getter: 'getBy', setter: 'setBy')]
    #[SerializedName('by')]
    #[XmlAttribute]
    private ServerBy $by;

    /**
     * Key for choosing server
     * 
     * @var string
     */
    #[Accessor(getter: 'getValue', setter: 'setValue')]
    #[Type('string')]
    #[XmlValue(cdata: false)]
    private $value;

    /**
     * Constructor
     * 
     * @param  ServerBy $by
     * @param  string $value
     * @return self
     */
    public function __construct(?ServerBy $by = null, ?string $value = null)
    {
        $this->setBy($by ?? ServerBy::NAME);
        if (null !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Get by enum
     *
     * @return ServerBy
     */
    public function getBy(): ServerBy
    {
        return $this->by;
    }

    /**
     * Set by enum
     *
     * @param  ServerBy $by
     * @return self
     */
    public function setBy(ServerBy $by): self
    {
        $this->by = $by;
        return $this;
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
}
