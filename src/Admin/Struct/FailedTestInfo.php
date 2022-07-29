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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlValue};

/**
 * FailedTestInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class FailedTestInfo
{
    /**
     * Failed test name
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Failed test execution time
     * @Accessor(getter="getExecSeconds", setter="setExecSeconds")
     * @SerializedName("execSeconds")
     * @Type("integer")
     * @XmlAttribute
     */
    private $execSeconds;

    /**
     * Failed test class name
     * @Accessor(getter="getClassName", setter="setClassName")
     * @SerializedName("class")
     * @Type("string")
     * @XmlAttribute
     */
    private $className;

    /**
     * Text of any exception thrown during the test
     * @Accessor(getter="getThrowable", setter="setThrowable")
     * @SerializedName("_content")
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $throwable;

    /**
     * Constructor method for FailedTestInfo
     *
     * @param string $name
     * @param int    $execSeconds
     * @param string $className
     * @param string $throwable
     * @return self
     */
    public function __construct(
        string $name = '', int $execSeconds = 0, string $className = '', string $throwable = ''
    )
    {
        $this->setName($name)
             ->setExecSeconds($execSeconds)
             ->setClassName($className)
             ->setThrowable($throwable);
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

    /**
     * Get throwable
     *
     * @return string
     */
    public function getThrowable(): string
    {
        return $this->throwable;
    }

    /**
     * Set throwable
     *
     * @param  string $throwable
     * @return self
     */
    public function setThrowable(string $throwable): self
    {
        $this->throwable = $throwable;
        return $this;
    }
}
