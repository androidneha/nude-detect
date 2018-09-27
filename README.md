## Detect and filter any unwanted content in photos, videos and live streams.

```sh
git clone https://github.com/androidneha/nude-detect.git
```

```sh
composer install
```
Create your own .env by simply using .env.example

For credentials you can visit [Sightengine](https://sightengine.com/)

Finally,

You can test by running this command

```
vendor/bin/phpunit --bootstrap vendor/autoload.php tests/Test.php
```
### Output of test:

```
object(stdClass)#63 (4) {
  ["status"]=>
  string(7) "success"
  ["request"]=>
  object(stdClass)#61 (3) {
    ["id"]=>
    string(25) "req_3PKFvUb1JeqlFA3jnH80S"
    ["timestamp"]=>
    float(1538064103.3163)
    ["operations"]=>
    int(1)
  }
  ["nudity"]=>
  object(stdClass)#18 (4) {
    ["raw"]=>
    float(0.076)
    ["safe"]=>
    float(0.058)
    ["partial"]=>
    float(0.867)
    ["partial_tag"]=>
    string(6) "bikini"
  }
  ["media"]=>
  object(stdClass)#57 (2) {
    ["id"]=>
    string(25) "med_3PKFMgQfPt2MsGzpCwkCV"
    ["uri"]=>
    string(76) "https://i.pinimg.com/originals/a4/eb/d9/a4ebd97b1551183223851bad13fb466b.jpg"
  }
}
```