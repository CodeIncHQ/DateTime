<?php
//
// +---------------------------------------------------------------------+
// | CODE INC. SOURCE CODE                                               |
// +---------------------------------------------------------------------+
// | Copyright (c) 2017 - Code Inc. SAS - All Rights Reserved.           |
// | Visit https://www.codeinc.fr for more information about licensing.  |
// +---------------------------------------------------------------------+
// | NOTICE:  All information contained herein is, and remains the       |
// | property of Code Inc. SAS. The intellectual and technical concepts  |
// | contained herein are proprietary to Code Inc. SAS are protected by  |
// | trade secret or copyright law. Dissemination of this information or |
// | reproduction of this material  is strictly forbidden unless prior   |
// | written permission is obtained from Code Inc. SAS.                  |
// +---------------------------------------------------------------------+
//
// Author:   Joan Fabrégat <joan@codeinc.fr>
// Date:     29/01/2018
// Time:     18:25
// Project:  lib-datetime
//
namespace CodeInc\DateTime;


/**
 * Class DateTime
 *
 * @package CodeInc\DateTime
 * @author Joan Fabrégat <joan@codeinc.fr>
 */
class DateTime extends \DateTime {
	// default time
	public const DEFAULT_TIME = 'now';

	// date formats
	public const FORMAT_SQL_DATE = 'Y-m-d';
	public const FORMAT_SQL_DATETIME = self::FORMAT_SQL_DATE.' H:i:s';
	public const FORMAT_RFC_1123 = 'D, d M Y H:i:s \\G\\M\\T';

	/**
	 * Constructor. Unlike the native DateTime constructor, it is possible to pass a timestamp to the constructor.
	 *
	 * @param string|int $time
	 * @param \DateTimeZone $dateTimeZone
	 */
	public function __construct($time = null, \DateTimeZone $dateTimeZone = null)
	{
		parent::__construct(
			($time === null || is_numeric($time)) ? self::DEFAULT_TIME : $time,
			$dateTimeZone
		);
		if (is_numeric($time)) {
			$this->setTimestamp($time);
		}
	}

	/**
	 * @return bool
	 */
	public function isUndefined():bool
	{
		return in_array($this->getTimestamp(), [-62169984561, 0]);
	}

	/**
	 * @return bool
	 */
	public function isPast():bool
	{
		return $this->getTimestamp() < time();
	}

	/**
	 * @return bool
	 */
	public function isNow():bool
	{
		return $this->getTimestamp() == time();
	}

	/**
	 * @return bool
	 */
	public function isFutur():bool
	{
		return $this->getTimestamp() > time();
	}

	/**
	 * Retourne la date formatée au foramt SQL date (AAAA-MM-JJ)
	 */
	public function getSqlDate():string
	{
		return $this->format($this::FORMAT_SQL_DATE);
	}

	/**
	 * Returns AAAA-MM-JJ HH:MM:SS
	 *
	 * @return string
	 */
	public function getSqlDateTime():string
	{
		return $this->format($this::FORMAT_SQL_DATETIME);
	}

	/**
	 * Returns a RFC 1123 date
	 *
	 * @link https://tools.ietf.org/html/rfc1123
	 * @return string
	 */
	public function getRfc1123():string
	{
		return $this->format($this::FORMAT_RFC_1123);
	}
}