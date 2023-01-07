<?php

namespace Progressively;

use PHPUnit\Framework\TestCase;
use Progressively\Progressively;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

require __DIR__ . "/../src/Progressively.php";
require __DIR__ . "/../src/Http.php";

class ProgressivelyTest extends TestCase
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
        assertTrue($sdk->isActivated(('newHomepage')));
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
        assertFalse($sdk->isActivated(('newHomepage')));
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
        assertFalse($sdk->isActivated(('notExistingFlag')));
    }
}
