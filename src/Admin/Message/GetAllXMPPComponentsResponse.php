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
use Zimbra\Admin\Struct\XMPPComponentInfo;
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetAllXMPPComponentsResponse class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetAllXMPPComponentsResponse extends SoapResponse
{
    /**
     * Information on XMPP components
     *
     * @var array
     */
    #[Accessor(getter: "getComponents", setter: "setComponents")]
    #[Type("array<Zimbra\Admin\Struct\XMPPComponentInfo>")]
    #[
        XmlList(
            inline: true,
            entry: "xmppcomponent",
            namespace: "urn:zimbraAdmin"
        )
    ]
    private array $components = [];

    /**
     * Constructor
     *
     * @param array $components
     * @return self
     */
    public function __construct(array $components = [])
    {
        $this->setComponents($components);
    }

    /**
     * Set components
     *
     * @param  array $components
     * @return self
     */
    public function setComponents(array $components): self
    {
        $this->components = array_filter(
            $components,
            static fn($component) => $component instanceof XMPPComponentInfo
        );
        return $this;
    }

    /**
     * Get components
     *
     * @return array
     */
    public function getComponents(): array
    {
        return $this->components;
    }
}
