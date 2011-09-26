<?php

class Front extends Page { 
	
	protected function render ( ) {
		$list = '<table>';
		foreach ( $this->database->getSortedMeetings() as $date => $meeting ) {
			$list .= '<tr><td>'.$this->weekDay($date, true).'</td>
				<td>'.$this->readableDate($date).'</td>
				<td><a href="?meeting='.$date.'">'.$meeting->{'title'}."</a></td></tr>\n";
		}
		$list .= '</table>';
		$this->content = '<h1>DIKUrevy-møder</h1>';
		$this->content .= $list;
	}
	
}

$page = new Front($database, $auth);
