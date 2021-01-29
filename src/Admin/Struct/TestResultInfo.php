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

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Admin\Struct\CompletedTestInfo;
use Zimbra\Admin\Struct\FailedTestInfo;

/**
 * TestResultInfo struct class
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="results")
 */
class TestResultInfo
{
    /**
     * Information for completed tests
     * 
     * @Accessor(getter="getCompletedTests", setter="setCompletedTests")
     * @SerializedName("completed")
     * @Type("array<Zimbra\Admin\Struct\CompletedTestInfo>")
     * @XmlList(inline = true, entry = "completed")
     */
    private $completedTests = [];

    /**
     * Information for failed tests
     * 
     * @Accessor(getter="getFailedTests", setter="setFailedTests")
     * @SerializedName("failure")
     * @Type("array<Zimbra\Admin\Struct\FailedTestInfo>")
     * @XmlList(inline = true, entry = "failure")
     */
    private $failedTests = [];

    /**
     * Constructor method for TestResultInfo
     *
     * @param  array $completedTests
     * @param  array $failedTests
     * @return self
     */
    public function __construct(array $completedTests = [], array $failedTests = [])
    {
        $this->setCompletedTests($completedTests)
             ->setFailedTests($failedTests);
    }

    /**
     * Add a completed test
     *
     * @param  CompletedTestInfo $completed
     * @return self
     */
    public function addCompletedTest(CompletedTestInfo $completed): self
    {
        $this->completedTests[] = $completed;
        return $this;
    }

    /**
     * Sets completedTests
     *
     * @param  array $completedTests
     * @return self
     */
    public function setCompletedTests(array $completedTests): self
    {
        $this->completedTests = [];
        foreach ($completedTests as $completed) {
            if ($completed instanceof CompletedTestInfo) {
                $this->completedTests[] = $completed;
            }
        }
        return $this;
    }

    /**
     * Gets completedTests
     *
     * @return array
     */
    public function getCompletedTests(): array
    {
        return $this->completedTests;
    }

    /**
     * Add a failure test
     *
     * @param  FailedTestInfo $failure
     * @return self
     */
    public function addFailedTest(FailedTestInfo $failure): self
    {
        $this->failedTests[] = $failure;
        return $this;
    }

    /**
     * Sets failedTests
     *
     * @param  array $failedTests
     * @return self
     */
    public function setFailedTests(array $failedTests): self
    {
        $this->failedTests = [];
        foreach ($failedTests as $failure) {
            if ($failure instanceof FailedTestInfo) {
                $this->failedTests[] = $failure;
            }
        }
        return $this;
    }

    /**
     * Gets failedTests
     *
     * @return array
     */
    public function getFailedTests(): array
    {
        return $this->failedTests;
    }
}
