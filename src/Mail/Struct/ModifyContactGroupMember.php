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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\{MemberType, ModifyGroupMemberOperation};

/**
 * ModifyContactGroupMember struct class
 * Contact group members to modify
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ModifyContactGroupMember extends NewContactGroupMember
{
    /**
     * Operation - +|-|reset
     * 
     * @var ModifyGroupMemberOperation
     */
    #[Accessor(getter: 'getOperation', setter: 'setOperation')]
    #[SerializedName('op')]
    #[Type('Enum<Zimbra\Common\Enum\ModifyGroupMemberOperation>')]
    #[XmlAttribute]
    private $operation;

    /**
     * Constructor
     * 
     * @param ModifyGroupMemberOperation $operation
     * @param MemberType $type
     * @param MemberType $type
     * @return self
     */
    public function __construct(
        ?ModifyGroupMemberOperation $operation = NULL,
        ?MemberType $type = NULL,
        string $value = ''
    )
    {
        parent::__construct($type, $value);
        if ($operation instanceof ModifyGroupMemberOperation) {
            $this->setOperation($operation);
        }
    }

    /**
     * Get operation
     *
     * @return ModifyGroupMemberOperation
     */
    public function getOperation(): ?ModifyGroupMemberOperation
    {
        return $this->operation;
    }

    /**
     * Set operation
     *
     * @param  ModifyGroupMemberOperation $operation
     * @return self
     */
    public function setOperation(ModifyGroupMemberOperation $operation): self
    {
        $this->operation = $operation;
        return $this;
    }
}
