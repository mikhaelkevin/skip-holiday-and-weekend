<?php
class WeekDays{

    /**
     * Use $inputDate for the input of class
     * Getter-setter is useful to set class variable
     * 
     * example: 
     * $x->set_name(date('Y-m-d')); | $x->variable = your input; | SET A VARIABLE
     * $x->get_name(); | $x->variable | GET A VARIABLE
     */
    public $inputDate;

    private function skipWeekend($dateToCheck){
        /**SKIP WEEKEND FUNCTION
		 * THIS FUNCTION ONLY ACCEPT DATE WITH Y-m-d FORMAT
		 * @return boolean
		*/

		$tempDay = Date("w", strtotime($dateToCheck));
		$dateIsWeekend = strtolower($tempDay) == 0 && strtolower($tempDay) == 6;

		if($dateIsWeekend){
			return TRUE;
		}

		return FALSE;
    }

    private function isHoliday($dateToCheck){
		/**SKIP HOLIDAY DATE FUNCTION
		 * THIS FUNCTION ONLY ACCEPT DATE WITH Y-m-d FORMAT
		 * @return boolean
		 * 
		 * Below $holiday is Indonesian national holiday.
		*/
		
		$holiday = [
			"2023-01-01",
			"2023-01-22",
			"2023-01-23",
			"2023-02-18",
			"2023-03-22",
			"2023-03-23",
			"2023-04-07",
			"2023-04-21",
			"2023-04-22",
			"2023-04-23",
			"2023-04-24",
			"2023-04-25",
			"2023-04-26",
			"2023-05-01",
			"2023-05-18",
			"2023-06-01",
			"2023-06-02",
			"2023-06-04",
			"2023-06-29",
			"2023-07-19",
			"2023-08-17",
			"2023-09-28",
			"2023-12-25",
			"2023-12-26"
		];

		$dateIsWeekend = $this->skipWeekend($dateToCheck);
		$dateIsHoliday = in_array($dateToCheck, $holiday);

		// Check if the date is holiday and not a weekend
		if($dateIsHoliday && !$dateIsWeekend){
			return TRUE;
		}

		return FALSE;
	}

    public function expiredDateChecker(){
		while($this->skipWeekend($this->inputDate) || $this->isHoliday(Date('Y-m-d', strtotime($this->inputDate . '+1 weekdays')))){
			$this->inputDate = Date('Y-m-d', strtotime($this->inputDate . '+1 weekdays'));
		}

		$endDate = Date('Y-m-d', strtotime($this->inputDate . '+3 weekdays'));
		while($this->skipWeekend($endDate) || $this->isHoliday($endDate)){
			$endDate = Date('Y-m-d', strtotime($endDate . '+1 weekdays'));
		}

		return $endDate;
		
	}
}

$newDate = new WeekDays;
$newDate->inputDate = date('2023-04-20');
echo $newDate->expiredDateChecker();

?>