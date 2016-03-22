<?php

/**
 * Run skeleton lint
 */
final class SkeletonLint extends ArcanistLinter
{

    const LINT_NAME = 'skeleton';
    private $options = [];


    /**
     * Linter info name
     *
     * @return string
     */
    public function getInfoName()
    {

        return self::LINT_NAME;
    }

    /**
     * Linter name
     *
     * @return string
     */
    public function getLinterName()
    {

        return self::LINT_NAME;
    }

    /**
     * Linter configuration name
     *
     * @return string
     */
    public function getLinterConfigurationName()
    {

        return self::LINT_NAME;
    }


    /**
     * Hook then file is changed
     *
     * @param string $path file path
     *
     * @return path;
     */
    public function lintPath($path)
    {
        return ;
    }


    /**
     * Show message
     *
     * @param array $data message data
     *   - string path            file path
     *   - float  line            error line number
     *   - float  char            column number
     *   - string code            linter name
     *   - string severity        error severity
     *   - string name            error name
     *   - string description     error description
     *   - string originalText    error originalText
     *   - string replacementText error replacementText
     *
     * return null
     *
     * @throws Exception
     */
    private function addMessage(array $data)
    {

        $default = [
            'path'            => null,
            'line'            => null,
            'char'            => null,
            'code'            => null,
            'severity'        => null,
            'name'            => null,
            'description'     => null,
            'originalText'    => null,
            'replacementText' => null,
        ];

        $data = $data + $default;
        $data['line'] = intval($data['line']);
        $data['char'] = intval($data['char']);

        $lintMessageObj = new \ArcanistLintMessage();
        $serverityObj   = new \ArcanistLintSeverity();

        if (!isset($serverityObj->getLintSeverities()[$data['severity']])) {
            throw new \Exception('Test serverity doesn\'t exist');
        }

        $message = $lintMessageObj
            ->setPath($data['path'])
            ->setLine($data['line'])
            ->setChar($data['char'])
            ->setCode($this->getLinterName())
            ->setSeverity($data['severity'])
            ->setName($data['name'])
            ->setDescription($data['description'])
            ->setOriginalText($data['originalText'])
            ->setReplacementText($data['replacementText']);

        $this->addLintMessage($message);
    }


    /**
     * Description linter configuration
     *
     * @return array
     */
    public function getLinterConfigurationOptions()
    {
        $options = parent::getLinterConfigurationOptions();

        $options['version'] = array(
            'type' => 'string',
            'help' => pht(self::LINT_NAME . ' version'),
        );

        return $options;
    }


    /**
     * Get value from linter configuration
     *
     * @param string $key   key name
     * @param string $value value
     *
     * @return null
     */
    public function setLinterConfigurationValue($key, $value)
    {
        switch ($key) {
        case 'version':
            $this->options['version'] = $value;

            return;
        }
        parent::setLinterConfigurationValue($key, $value);
    }


}
