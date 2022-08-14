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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};

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
     * @Accessor(getter="getLast", setter="setLast")
     * @SerializedName("last")
     * @Type("bool")
     * @XmlAttribute
     * 
     * @var bool
     */
    #[Accessor(getter: 'getLast', setter: 'setLast')]
    #[SerializedName(name: 'last')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $last;

    /**
     * offset
     * 
     * @Accessor(getter="getOffset", setter="setOffset")
     * @SerializedName("offset")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getOffset', setter: 'setOffset')]
    #[SerializedName(name: 'offset')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $offset;

    /**
     * tests
     * 
     * @Accessor(getter="getTest", setter="setTest")
     * @SerializedName("test")
     * @Type("Zimbra\Mail\Struct\EditheaderTest")
     * @XmlElement(namespace="urn:zimbraMail")
     * 
     * @var EditheaderTest
     */
    #[Accessor(getter: "getTest", setter: "setTest")]
    #[SerializedName(name: 'test')]
    #[Type(name: EditheaderTest::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $test;

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
        ?int $index = NULL, ?bool $last = NULL, ?int $offset = NULL, ?EditheaderTest $test = NULL
    )
    {
    	parent::__construct($index);
        if (NULL !== $last) {
            $this->setLast($last);
        }
        if (NULL !== $offset) {
            $this->setOffset($offset);
        }
        if ($test instanceof EditheaderTest) {
            $this->setTest($test);
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
