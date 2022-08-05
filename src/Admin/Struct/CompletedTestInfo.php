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
 * CompletedTestInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CompletedTestInfo
{
    /**
     * Test name
     * 
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Number of seconds to execute the test
     * 
     * @Accessor(getter="getExecSeconds", setter="setExecSeconds")
     * @SerializedName("execSeconds")
     * @Type("integer")
     * @XmlAttribute
     */
    private $execSeconds;

    /**
     * Test class
     * 
     * @Accessor(getter="getClassName", setter="setClassName")
     * @SerializedName("class")
     * @Type("string")
     * @XmlAttribute
     */
    private $className;

    /**
     * Constructor
     *
     * @param string $name
     * @param int    $execSeconds
     * @param string $className
     * @return self
     */
    public function __construct(
        string $name = '', int $execSeconds = 0, string $className = ''
    )
    {
        $this->setName($name)
             ->setExecSeconds($execSeconds)
             ->setClassName($className);
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get execSeconds
     *
     * @return int
     */
    public function getExecSeconds(): int
    {
        return $this->execSeconds;
    }

    /**
     * Set execSeconds
     *
     * @param  int $execSeconds
     * @return self
     */
    public function setExecSeconds(int $execSeconds): self
    {
        $this->execSeconds = $execSeconds;
        return $this;
    }

    /**
     * Get className
     *
     * @return string
     */
    public function getClassName(): string
    {
        return $this->className;
    }

    /**
     * Set className
     *
     * @param  string $className
     * @return self
     */
    public function setClassName(string $className): self
    {
        $this->className = $className;
        return $this;
    }
}
