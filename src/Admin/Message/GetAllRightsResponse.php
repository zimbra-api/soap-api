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
use Zimbra\Admin\Struct\RightInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAllRightsResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllRightsResponse extends SoapResponse
{
    /**
     * Information for rights
     *
     * @var array
     */
    #[Accessor(getter: "getRights", setter: "setRights")]
    #[Type("array<Zimbra\Admin\Struct\RightInfo>")]
    #[XmlList(inline: true, entry: "right", namespace: "urn:zimbraAdmin")]
    private array $rights = [];

    /**
     * Constructor
     *
     * @param array $rights
     * @return self
     */
    public function __construct(array $rights = [])
    {
        $this->setRights($rights);
    }

    /**
     * Set right informations
     *
     * @param  array $rights
     * @return self
     */
    public function setRights(array $rights): self
    {
        $this->rights = array_filter(
            $rights,
            static fn($right) => $right instanceof RightInfo
        );
        return $this;
    }

    /**
     * Get right informations
     *
     * @return array
     */
    public function getRights(): array
    {
        return $this->rights;
    }
}
