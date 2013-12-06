<?php

/*******************************************************************
Copyright Info:

Copyright 2008, Brian Rock, 2010, Steven Adams.

    This php script is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*******************************************************************/

class DateRange implements Iterator
{
	protected $startDate;
	protected $endDate;
	protected $currentDate;

	public function __construct( $startDate, $endDate )
	{
		if ( is_string( $startDate ) )
		{
			$this->startDate = strtotime( $startDate );
		}
		else
		{
			$this->startDate = $startDate;
		}

		if ( is_string( $endDate ) )
		{
			$this->endDate = strtotime( $endDate );
		}
		else
		{
			$this->endDate = $endDate;
		}
		$this->currentDate = $startDate;
	}

	public function inRange($date)
	{
		if ( is_string( $date ) )
		{
			$date = strtotime( $date );
		}
		return ( ( $this->startDate <= $date ) && ( $date <= $this->endDate ) );
	}

	/*
		parseString: returns a DateRange object
		Note: this function is USA-centric in its assumptions regarding the format of the date range string
	*/
	public static function parseString( $rangeString )
	{
		$date_array_raw = preg_split( '/[ -]/', str_replace( ',', '', $rangeString ) ); // split on either space or dash, after removing any commas
		$date_array = array_filter( $date_array_raw, array( 'DateRange', 'notBlank' ) ); // strip any blank data in the array
		switch ( count($date_array) )
		{
			case 3:
				// assumed format mmmm d yyyy, a single day
				$start_date = strtotime( $date_array[0] . ' ' . $date_array[1] . ', ' . $date_array[3] );
				$end_date = $start_date;
				break;
			case 4:
				// assumed format mmmm d1-d2 yyyy
				$start_date = strtotime( $date_array[0] . ' ' . $date_array[1] . ', ' . $date_array[3] );
				$end_date = strtotime( $date_array[0] . ' ' . $date_array[2] . ', ' . $date_array[3] );
				break;
			case 5:
				// assumed format mmmm1 d1-mmmm2 d2 yyyy
				$start_date = strtotime( $date_array[0] . ' ' . $date_array[1] . ', ' . $date_array[4] );
				$end_date = strtotime( $date_array[2] . ' ' . $date_array[3] . ', ' . $date_array[4] );
				break;
			case 6:
				// assumed format mmmm1 d1 yyyy1-mmmm2 d2 yyyy2
				$start_date = strtotime( $date_array[0] . ' ' . $date_array[1] . ', ' . $date_array[2] );
				$end_date = strtotime( $date_array[3] . ' ' . $date_array[4] . ', ' . $date_array[5] );
				break;
			default:
				// unknown format
				$start_date = false; $end_date = false;
				break;
		}
		return ( $start_date !== false && $end_date !== false ) ? new DateRange( $start_date, $end_date ) : null;
	}

	/*
		parseMonthYear: returns a DateRange object
		$month can be either:
			a string (English language, full month name or standard abbreviation)
			or an integer (1-based: 1=January, 2=February, etc)
	*/
	public static function parseMonthYear( $month, $year )
	{
		$cal_info = cal_info( CAL_GREGORIAN );
		if ( is_string( $month ) )
		{
			// first check full month names
			$month_number = DateRange::array_nsearch(  $month, $cal_info['months'] );
			// if that doesn't work, check abbreviations
			if ( $month_number === false )
			{
				$month_number = DateRange::array_nsearch( $month, $cal_info['abbrevmonths'] );
			}
		}
		else
		{
			$month_number = ( is_int( $month ) && $month >= 1 && $month <= 12 ) ? $month : false;
		}
		if ( $month_number !== false )
		{
			$month_days = cal_days_in_month( CAL_GREGORIAN, $month_number, $year );
			$startDate = mktime( 0, 0, 0, $month_number, 1, $year );
			$endDate = mktime( 0, 0, 0, $month_number, $month_days, $year );
			return new DateRange( $startDate, $endDate );
		}
		else
		{
			return null;
		}
	}

	public function getStartDate()
	{
		return $this->startDate;
	}

	public function getEndDate()
	{
		return $this->endDate;
	}

	/* **** Iterator methods **** */
	public function rewind()
	{
		$this->currentDate = $this->startDate;
	}

	public function current()
	{
		return $this->currentDate;
	}

	public function key()
	{
		return $this->currentDate;
	}

	public function next()
	{
		$this->currentDate = strtotime( '+1 day', $this->currentDate );
	}

	public function valid()
	{
		return $this->inRange( $this->currentDate );
	}

	/* **** helper functions **** */

	private static function notBlank($a)
	{
		return ($a != '');
	}

	// case-insensitive search for arrays
	private static function array_nsearch($needle, array $haystack)
	{
		$it = new IteratorIterator( new ArrayIterator( $haystack ) );
		foreach( $it as $key => $val )
		{
			if( strcasecmp( $val, $needle ) === 0 )
			{
				return $key;
			}
		}
		return false;
	}
}

?>
