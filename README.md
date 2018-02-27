# Code Inc.'s datetime library
 
### Usage
```php
<?php
use CodeInc\DateTime\DateTime;

/*
 * Can be instantiated with a timestamp (checked with is_numeric())
 */
$dateTime = new DateTime(time());

/*
 * Provides methods to tests the current time
 */ 
$dateTime->isUndefined();
$dateTime->isPast();
$dateTime->isNow();
$dateTime->isFutur();

/*
 * Provides methods to get SQL dates
 */
$dateTime->getSqlDate(); // YYYY-MM-DD
$dateTime->getSqlDateTime(); // AAAA-MM-JJ HH:MM:SS

/*
 * Provides a method to get a RFC 1123 date 
 */
$dateTime->getRfc1123();

/*
 * The formats are available in class constants 
 */
$dateTime::FORMAT_SQL_DATE;
$dateTime::FORMAT_SQL_DATETIME;
$dateTime::FORMAT_RFC_1123;
```