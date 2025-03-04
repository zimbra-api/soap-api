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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement
};

/**
 * DeleteheaderAction struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DeleteheaderAction extends FilterAction
{
    /**
     * if true start from last
     *
     * @var bool
     */
    #[Accessor(getter: "getLast", setter: "setLast")]
    #[SerializedName("last")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $last = null;

    /**
     * offset
     *
     * @var int
     */
    #[Accessor(getter: "getOffset", setter: "setOffset")]
    #[SerializedName("offset")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $offset = null;

    /**
     * tests
     *
     * @var EditheaderTest
     */
    #[Accessor(getter: "getTest", setter: "setTest")]
    #[SerializedName("test")]
    #[Type(EditheaderTest::class)]
    #[XmlElement(namespace: "urn:zimbraMail")]
    private ?EditheaderTest $test;

    /**
     * Constructor
     *
     * @param int $index
     * @param bool $last
     * @param int $offset
     * @param EditheaderTest $test
     * @return self
     */
    public function __construct(
        ?int $index = null,
        ?bool $last = null,
        ?int $offset = null,
        ?EditheaderTest $test = null
    ) {
        parent::__construct($index);
        $this->test = $test;
        if (null !== $last) {
            $this->setLast($last);
        }
        if (null !== $offset) {
            $this->setOffset($offset);
        }
    }

    /**
     * Get last
     *
     * @return bool
     */
    public function getLast(): ?bool
    {
        return $this->last;
    }

    /**
     * Set last
     *
     * @param  bool $last
     * @return self
     */
    public function setLast(bool $last)
    {
        $this->last = $last;
        return $this;
    }

    /**
     * Get offset
     *
     * @return int
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * Set offset
     *
     * @param  int $offset
     * @return self
     */
    public function setOffset(int $offset)
    {
        $this->offset = $offset;
        return $this;
    }

    /**
     * Get test
     *
     * @return EditheaderTest
     */
    public function getTest(): ?EditheaderTest
    {
        return $this->test;
    }

    /**
     * Set test
     *
     * @param  EditheaderTest $test
     * @return self
     */
    public function setTest(EditheaderTest $test)
    {
        $this->test = $test;
        return $this;
    }
}
