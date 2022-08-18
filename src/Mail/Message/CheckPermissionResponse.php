<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlList};
use Zimbra\Mail\Struct\RightPermission;
use Zimbra\Common\Struct\SoapResponse;

/**
 * CheckPermissionResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CheckPermissionResponse extends SoapResponse
{
    /**
     * Set if the authed user has ALL the rights for each <right> element.
     * 
     * @var bool
     */
    #[Accessor(getter: 'getAllow', setter: 'setAllow')]
    #[SerializedName('allow')]
    #[Type('bool')]
    #[XmlAttribute]
    private $allow;

    /**
     * Individual right information
     * 
     * @var array
     */
    #[Accessor(getter: 'getRights', setter: 'setRights')]
    #[Type('array<Zimbra\Mail\Struct\RightPermission>')]
    #[XmlList(inline: true, entry: 'right', namespace: 'urn:zimbraMail')]
    private $rights = [];

    /**
     * Constructor
     *
     * @param  bool $allow
     * @param  array $rights
     * @return self
     */
    public function __construct(
        bool $allow = FALSE,
        array $rights = []
    )
    {
        $this->setAllow($allow)
             ->setRights($rights);
    }

    /**
     * Get allow
     *
     * @return bool
     */
    public function getAllow(): bool
    {
        return $this->allow;
    }

    /**
     * Set allow
     *
     * @param  bool $allow
     * @return self
     */
    public function setAllow(bool $allow): self
    {
        $this->allow = $allow;
        return $this;
    }

    /**
     * Set rights
     *
     * @param  array $rights
     * @return self
     */
    public function setRights(array $rights): self
    {
        $this->rights = array_filter($rights, static fn ($right) => $right instanceof RightPermission);
        return $this;
    }

    /**
     * Get rights
     *
     * @return array
     */
    public function getRights(): array
    {
        return $this->rights;
    }
}
