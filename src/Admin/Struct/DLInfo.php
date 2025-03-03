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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};

/**
 * DLInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present name Nguyen Van Nguyen.
 */
class DLInfo extends AdminObjectInfo
{
    /**
     * Is dynamic
     *
     * @var bool
     */
    #[Accessor(getter: "isDynamic", setter: "setDynamic")]
    #[SerializedName("dynamic")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $dynamic = null;

    /**
     * Via
     * Present if the account is a member of the returned list because they are either a
     * direct or indirect member of another list that is a member of the returned list.
     *
     * @var string
     */
    #[Accessor(getter: "getVia", setter: "setVia")]
    #[SerializedName("via")]
    #[Type("string")]
    #[XmlAttribute]
    private string $via;

    /**
     * Constructor
     *
     * @param  string $via
     * @param  string $name
     * @param  string $id
     * @param  bool   $dynamic
     * @param  array  $attrs
     * @return self
     */
    public function __construct(
        string $via = "",
        string $name = "",
        string $id = "",
        ?bool $dynamic = null,
        array $attrs = []
    ) {
        parent::__construct($name, $id, $attrs);
        $this->setVia($via);
        if (null !== $dynamic) {
            $this->setDynamic($dynamic);
        }
    }

    /**
     * Get is dynamic
     *
     * @return bool
     */
    public function isDynamic(): ?bool
    {
        return $this->dynamic;
    }

    /**
     * Set is dynamic
     *
     * @param  bool $dynamic
     * @return self
     */
    public function setDynamic(bool $dynamic): self
    {
        $this->dynamic = $dynamic;
        return $this;
    }

    /**
     * Get the via
     *
     * @return string
     */
    public function getVia(): string
    {
        return $this->via;
    }

    /**
     * Set the via
     *
     * @param  string $via
     * @return self
     */
    public function setVia(string $via): self
    {
        $this->via = $via;
        return $this;
    }
}
