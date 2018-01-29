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
	const DEFAULT_TIME = 'now';
	const SQL_DATE = 'Y-m-d';
	const SQL_DATETIME = self::SQL_DATE.' H:i:s';
	const SQL_EMPTY_DATE = '0000-00-00';
	const SQL_EMPTY_DATETIME = self::SQL_EMPTY_DATE.' 00:00:00';
	const RFC_1123 = 'D, d M Y H:i:s \\G\\M\\T';

	/**
	 * Constructor. Unlike the native DateTime constructor, it is possile to pass a timestamp as the $time parameter.
	 *
	 * @param string|int $time
	 * @param \DateTimeZone $dateTimeZone
	 */
	public function __construct($time = null, \DateTimeZone $dateTimeZone = null) {
		parent::__construct(empty($time) || is_numeric($time) ? 'now' : $time, $dateTimeZone);
		if (is_numeric($time)) {
			$this->setTimestamp($time);
		}
	}

	/**
	 * Vérifie si la date est indéfinie
	 *
	 * @return bool
	 */
	public function isUndefined() {
		return in_array($this->getTimestamp(), [-62169984561, 0]);
	}

	/**
	 * Vérifie si le temps courant est dans le passé
	 *
	 * @return bool
	 */
	public function isPast() {
		return $this->getTimestamp() < time();
	}

	/**
	 * Vérifie si le temps courant est maintenant
	 *
	 * @return bool
	 */
	public function isNow() {
		return $this->getTimestamp() == time();
	}

	/**
	 * Vérifie si le temps courant est dans le futur
	 *
	 * @return bool
	 */
	public function isFutur() {
		return $this->getTimestamp() > time();
	}

	/**
	 * Retourne la date formatée au foramt SQL date (AAAA-MM-JJ)
	 *
	 * @return string
	 */
	public function getSQLDate() {
		return $this->format($this::SQL_DATE);
	}

	/**
	 * Retourne la date formatée au foramt SQL datetime (AAAA-MM-JJ HH:MM:SS)
	 *
	 * @return string
	 */
	public function getSQLDateTime() {
		return $this->format($this::SQL_DATETIME);
	}

	/**
	 * Retourne la date formatée au format RFC 1123
	 *
	 * @see https://tools.ietf.org/html/rfc1123
	 * @return string
	 */
	public function getRfc1123() {
		return $this->format($this::RFC_1123);
	}
}