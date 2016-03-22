<?php

/**
 * Skeleton test engine
 */
final class SkeletonTestEngine extends ArcanistUnitTestEngine
{

    private $projectRoot;
    private $minVersion = '1.0';

    /**
    * Run unit test
    *
    * @return array
    */
    public function run()
    {

        $return = [];
        $this->chechSystem();
        $results = $this->runUnitTest();
        foreach ($results as $testResult) {
            $return[] = $testResult;
        }

        return $return;
    }


    /**
     * Project root path
     *
    * @return string
    */
    private function getRootPath()
    {
        if (!$this->projectRoot) {
            $this->projectRoot = $this->getWorkingCopy()->getProjectRoot();
        }

        return $this->projectRoot;
    }


    /**
     * Format message
     *
     * @param array $data message data
     *   - string namespace
     *   - string file name (could be without extension)
     *   - string testName
     *   - string testResult. Result names are description in ArcanistUnitTestResult class
     *   - float  duration test duration time in seconds
     *   - string failureDescription detail error description
     *   - string link about error
     *   - string extraData ???
     *   - string coverage ???
     *
     * @return \ArcanistUnitTestResult
     *
     * @throws Exception
     */
    private function addMessage(array $data)
    {
        $default = [
            'namespace'          => null,
            'file'               => null,
            'testName'           => null,
            'testResult'         => null,
            'duration'           => null,
            'failureDescription' => null,
            'link'               => null,
            'extraData'          => null,
            'coverage'           => null,
        ];

        $testResultObj = new ArcanistUnitTestResult();

        $data = $data + $default;

        if (!in_array($data['testResult'], $testResultObj->getAllResultCodes())) {
            throw new \Exception('Test result doesn\'t exist');
        }

        $data['duration'] = floatval($data['duration']);

        $message = $testResultObj
            ->setName($data['file']. '::' .$data['testName'])
            ->setResult($data['testResult'])
            ->setDuration($data['duration'])
            ->setUserData($data['failureDescription'])
            ->setNamespace($data['namespace'])
            ->setLink($data['link'])
            ->setExtraData($data['extraData'])
            ->setCoverage($data['coverage']);

        return $message;

    }

    /**
    * Check if unit tester have right version
     *
     * @return null
    */
    private function chechSystem()
    {
        $version = shell_exec('tester --version');
        $compare = version_compare($version, $this->minVersion);
        if ($compare === -1) {
            throw new \RuntimeException('tester is not exists or version is too low');
        }
    }


    /**
     * Run unit test
     *
     * @return array
     */
    private function runUnitTest()
    {


        return [];
    }


}
