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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlElement};

/**
 * ReplaceheaderAction struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ReplaceheaderAction extends DeleteheaderAction
{
    /**
     * New name
     * 
     * @var string
     */
    #[Accessor(getter: "getNewName", setter: "setNewName")]
    #[SerializedName(name: 'newName')]
    #[Type(name: 'string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraMail')]
    private $newName;

    /**
     * New value
     * 
     * @var string
     */
    #[Accessor(getter: "getNewValue", setter: "setNewValue")]
    #[SerializedName(name: 'newValue')]
    #[Type(name: 'string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraMail')]
    private $newValue;

    /**
     * Constructor
     * 
     * @param int $index
     * @param bool $last
     * @param int $offset
     * @param EditheaderTest $test
     * @param string $newName
     * @param string $newValue
     * @return self
     */
    public function __construct(
        ?int $index = NULL,
        ?bool $last = NULL,
        ?int $offset = NULL,
        ?EditheaderTest $test = NULL,
        ?string $newName = NULL,
        ?string $newValue = NULL
    )
    {
    	parent::__construct($index, $last, $offset, $test);
        if (NULL !== $newName) {
            $this->setNewName($newName);
        }
        if (NULL !== $newValue) {
            $this->setNewValue($newValue);
        }
    }

    /**
     * Get newName
     *
     * @return string
     */
    public function getNewName(): ?string
    {
        return $this->newName;
    }

    /**
     * Set newName
     *
     * @param  string $newName
     * @return self
     */
    public function setNewName(string $newName)
    {
        $this->newName = $newName;
        return $this;
    }

    /**
     * Get newValue
     *
     * @return string
     */
    public function getNewValue(): ?string
    {
        return $this->newValue;
    }

    /**
     * Set newValue
     *
     * @param  string $newValue
     * @return self
     */
    public function setNewValue(string $newValue)
    {
        $this->newValue = $newValue;
        return $this;
    }
}
