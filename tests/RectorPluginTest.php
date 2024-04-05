<?php

declare(strict_types=1);

namespace Phpcq\PluginRectorTest;

use Phpcq\PluginApi\Version10\Configuration\PluginConfigurationBuilderInterface;
use Phpcq\PluginApi\Version10\Configuration\PluginConfigurationInterface;
use Phpcq\PluginApi\Version10\DiagnosticsPluginInterface;
use Phpcq\PluginApi\Version10\EnvironmentInterface;
use PHPUnit\Framework\TestCase;

/** @covers src/rector.php */
final class RectorPluginTest extends TestCase
{
    private function instantiate(): DiagnosticsPluginInterface
    {
        return include dirname(__DIR__) . '/src/rector.php';
    }

    public function testPluginDescribesConfig(): void
    {
        $configOptionsBuilder = $this->getMockForAbstractClass(
            PluginConfigurationBuilderInterface::class
        );

        $configOptionsBuilder->expects(self::once())
            ->method('describeStringOption')
            ->with('config', 'Path to config file');

        $configOptionsBuilder->expects(self::once())
            ->method('describeBoolOption')
            ->with('dry-run', 'Only see the diff of changes, do not save them to files.');

        $this->instantiate()->describeConfiguration($configOptionsBuilder);

        // We assume it worked out as the plugin did execute correctly.
        $this->addToAssertionCount(1);
    }
    public function testPluginCreatesDiagnosticTasks(): void
    {
        $config = $this->getMockForAbstractClass(PluginConfigurationInterface::class);
        $environment = $this->getMockForAbstractClass(EnvironmentInterface::class);

        $this->instantiate()->createDiagnosticTasks($config, $environment);

        // We assume it worked out as the plugin did execute correctly.
        $this->addToAssertionCount(1);
    }
}
