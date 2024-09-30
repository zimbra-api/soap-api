<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Admin\Struct\InheritedFlaggedValue;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAdminConsoleUICompResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAdminConsoleUICompResponse extends SoapResponse
{
    /**
     * zimbraAdminConsoleUIComponents values
     *
     * @Accessor(getter="getValues", setter="setValues")
     * @Type("array<Zimbra\Admin\Struct\InheritedFlaggedValue>")
     * @XmlList(inline=true, entry="a", namespace="urn:zimbraAdmin")
     *
     * @var array
     */
    #[Accessor(getter: "getValues", setter: "setValues")]
    #[Type("array<Zimbra\Admin\Struct\InheritedFlaggedValue>")]
    #[XmlList(inline: true, entry: "a", namespace: "urn:zimbraAdmin")]
    private $values = [];

    /**
     * Constructor
     *
     * @param array $values
     * @return self
     */
    public function __construct(array $values = [])
    {
        $this->setValues($values);
    }

    /**
     * Set values
     *
     * @param array $values
     * @return self
     */
    public function setValues(array $values): self
    {
        $this->values = array_filter(
            $values,
            static fn($value) => $value instanceof InheritedFlaggedValue
        );
        return $this;
    }

    /**
     * Get values
     *
     * @return array
     */
    public function getValues(): ?array
    {
        return $this->values;
    }
}
