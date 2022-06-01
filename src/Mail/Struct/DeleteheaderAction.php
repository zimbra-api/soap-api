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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DeleteheaderAction extends FilterAction
{
    /**
     * if true start from last
     * @Accessor(getter="getLast", setter="setLast")
     * @SerializedName("last")
     * @Type("bool")
     * @XmlAttribute
     */
    private $last;

    /**
     * offset
     * @Accessor(getter="getOffset", setter="setOffset")
     * @SerializedName("offset")
     * @Type("integer")
     * @XmlAttribute
     */
    private $offset;

    /**
     * tests
     * @Accessor(getter="getTest", setter="setTest")
     * @SerializedName("test")
     * @Type("Zimbra\Mail\Struct\EditheaderTest")
     * @XmlElement
     */
    private ?EditheaderTest $test = NULL;

    /**
     * Constructor method for DeleteheaderAction
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
     * Gets last
     *
     * @return bool
     */
    public function getLast(): ?bool
    {
        return $this->last;
    }

    /**
     * Sets last
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
     * Gets offset
     *
     * @return int
     */
    public function getOffset(): ?int
    {
        return $this->offset;
    }

    /**
     * Sets offset
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
     * Gets test
     *
     * @return EditheaderTest
     */
    public function getTest(): ?EditheaderTest
    {
        return $this->test;
    }

    /**
     * Sets test
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
