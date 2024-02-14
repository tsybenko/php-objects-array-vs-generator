# PHP objects array VS objects Generator benchmark

This project introduces a benchmark that compares the performance of PHP object arrays and object generators. It establishes an environment with various plugins to test and measure runtime memory usage. The package also includes a script to generate test functions based on the desired number of plugins**.

** - Plugins are simple objects to be tested by this benchmark

To run the benchmark, run this command

```shell
php bench.php
```

To change a count of plugins for the test, set an environment variable `PLUGINS_COUNT` 

##### Example
```shell
PLUGINS_COUNT=50 php scripts/generate-functions.php
```