<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler;

class Greeter {
    public function greet(string $name): string {
        return 'Hello, ' . $name . '!';
    }
}

final class GreeterTest extends TestCase {
    public function testGreetWithName(): void {
        $greeter = new Greeter;
        $greeting = $greeter->greet('Alice');
        $this->assertSame('Hello, Alice!', $greeting);
    }
}
