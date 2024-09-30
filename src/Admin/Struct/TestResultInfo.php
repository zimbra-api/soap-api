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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};

/**
 * TestResultInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class TestResultInfo
{
    /**
     * Information for completed tests
     *
     * @Accessor(getter="getCompletedTests", setter="setCompletedTests")
     * @Type("array<Zimbra\Admin\Struct\CompletedTestInfo>")
     * @XmlList(inline=true, entry="completed", namespace="urn:zimbraAdmin")
     *
     * @var array
     */
    #[Accessor(getter: "getCompletedTests", setter: "setCompletedTests")]
    #[Type("array<Zimbra\Admin\Struct\CompletedTestInfo>")]
    #[XmlList(inline: true, entry: "completed", namespace: "urn:zimbraAdmin")]
    private $completedTests = [];

    /**
     * Information for failed tests
     *
     * @Accessor(getter="getFailedTests", setter="setFailedTests")
     * @Type("array<Zimbra\Admin\Struct\FailedTestInfo>")
     * @XmlList(inline=true, entry="failure", namespace="urn:zimbraAdmin")
     *
     * @var array
     */
    #[Accessor(getter: "getFailedTests", setter: "setFailedTests")]
    #[Type("array<Zimbra\Admin\Struct\FailedTestInfo>")]
    #[XmlList(inline: true, entry: "failure", namespace: "urn:zimbraAdmin")]
    private $failedTests = [];

    /**
     * Constructor
     *
     * @param  array $completedTests
     * @param  array $failedTests
     * @return self
     */
    public function __construct(
        array $completedTests = [],
        array $failedTests = []
    ) {
        $this->setCompletedTests($completedTests)->setFailedTests($failedTests);
    }

    /**
     * Set completedTests
     *
     * @param  array $tests
     * @return self
     */
    public function setCompletedTests(array $tests): self
    {
        $this->completedTests = array_filter(
            $tests,
            static fn($test) => $test instanceof CompletedTestInfo
        );
        return $this;
    }

    /**
     * Get completedTests
     *
     * @return array
     */
    public function getCompletedTests(): array
    {
        return $this->completedTests;
    }

    /**
     * Set failedTests
     *
     * @param  array $tests
     * @return self
     */
    public function setFailedTests(array $tests): self
    {
        $this->failedTests = array_filter(
            $tests,
            static fn($test) => $test instanceof FailedTestInfo
        );
        return $this;
    }

    /**
     * Get failedTests
     *
     * @return array
     */
    public function getFailedTests(): array
    {
        return $this->failedTests;
    }
}
