# blogcrawlertest
Blow crawling test

Installation:
composer update

Usage:
php -f crawl.php BLOG_URL CATEGORY > result.json

Test:
Each class has his test that must be run alone, example:
phpunit --bootstrap src/BlogCrawlerSymfonyAdapter.php tests/BlogCrawlerSymfonyAdapterTest.php
