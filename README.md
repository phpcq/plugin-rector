# Rector plugin for phpcq

This plugin provides [rector](https://github.com/rectorphp/rector) integration for phpcq.

## Configuration

Extend your `.phpcq.yaml.dist` configuration by adding the plugin and configuring the task:

```yaml
phpcq:
  plugins:
    version: ^1.0
    signed: false

tasks:
  rector:
    config:
      # Set to 
      dry-run: false 
      # Custom config file, defaults to rector.php
      config: custom-rector.php
```
