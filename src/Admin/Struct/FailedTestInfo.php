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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlValue
};

/**
 * FailedTestInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class FailedTestInfo
{
    /**
     * Failed test name
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private string $name;

    /**
     * Failed test execution time
     *
     * @var int
     */
    #[Accessor(getter: "getExecSeconds", setter: "setExecSeconds")]
    #[SerializedName("execSeconds")]
    #[Type("int")]
    #[XmlAttribute]
    private int $execSeconds;

    /**
     * Failed test class name
     *
     * @var string
     */
    #[Accessor(getter: "getClassName", setter: "setClassName")]
    #[SerializedName("class")]
    #[Type("string")]
    #[XmlAttribute]
    private string $className;

    /**
     * Text of any exception thrown during the test
     *
     * @var string
     */
    #[Accessor(getter: "getThrowable", setter: "setThrowable")]
    #[Type("string")]
    #[XmlValue(cdata: false)]
    private string $throwable;

    /**
     * Constructor
     *
     * @param string $name
     * @param int    $execSeconds
     * @param string $className
     * @param string $throwable
     * @return self
     */
    public function __construct(
        string $name = "",
        int $execSeconds = 0,
        string $className = "",
        string $throwable = ""
    ) {
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
