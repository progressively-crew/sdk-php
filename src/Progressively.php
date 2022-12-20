<?php

namespace Progressively;

class Progressively
{
    private array $flags = [];

    private function __construct(array $flags)
    {
        $this->flags = $flags;
    }

    public static function create($clientKey, $options = array(), Http $httpService = new Http()): Progressively
    {
        $apiUrl = Progressively::safeGet($options, "apiUrl", "http://localhost:4000") . '/sdk/';
        $actualOptions = array();
        $actualOptions["fields"] = Progressively::safeGet($options, "fields ", array());
        $actualOptions["fields"]["clientKey"] = $clientKey;

        $endPoint = $httpService->generateUrl($apiUrl, $actualOptions["fields"]);
        $flags = $httpService->execute($endPoint);

        return new Progressively($flags);
    }

    private static function safeGet($array, $indexName, $defaultValue)
    {
        return (isset($array[$indexName]) && !empty($array[$indexName])) ? $array[$indexName] : $defaultValue;
    }

    public function isActivated(string $flagName)
    {
        if (isset($this->flags[$flagName])) {
            return $this->flags[$flagName];
        }

        return false;
    }
}