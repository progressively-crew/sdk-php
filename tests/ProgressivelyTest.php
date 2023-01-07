<?php

namespace Progressively;

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

final class ProgressivelyTest extends TestCase
{
    public function testRetrievingAnExistingAndActivatedFlag()
    {
        // Arrange
        $httpStub = $this->createMock(Http::class);
        $httpStub->method('execute')
            ->willReturn(array("newHomepage" => true));

        // Act
        $sdk = Progressively::create("my-api-key", array(), $httpStub);

        // Assert
        assertEquals($sdk->isActivated(('newHomepage')), true);
    }

    public function testRetrievingAnExistingAndNotActivatedFlag()
    {
        // Arrange
        $httpStub = $this->createMock(Http::class);
        $httpStub->method('execute')
            ->willReturn(array("newHomepage" => false));

        // Act
        $sdk = Progressively::create("my-api-key", array(), $httpStub);

        // Assert
        assertEquals($sdk->isActivated(('newHomepage')), false);
    }

    public function testRetrievingANotExistingFlag()
    {
        // Arrange
        $httpStub = $this->createMock(Http::class);
        $httpStub->method('execute')
            ->willReturn(array("newHomepage" => true));

        // Act
        $sdk = Progressively::create("my-api-key", array(), $httpStub);

        // Assert
        assertEquals($sdk->isActivated(('notExistingFlag')), false);
    }
}
