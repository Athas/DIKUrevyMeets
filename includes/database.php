<?php

class Database {

	private $users = null;
	private $meetings = null;
	
	public function __construct ( ) {
		$this->users = json_decode ( file_get_contents( 'data/users.json' ) );
		$this->meetings = json_decode ( file_get_contents( 'data/meetings.json' ) );
	}
	
	private function writeData ( $file ) {
		switch ( $file ) {
			case 'meetings':
				$hl = fopen ( "data/$file.json", 'w' );
				fwrite ( $hl, json_encode ( $this->meetings ) );
				fclose ( $hl );
				break;
			case 'users':
				$hl = fopen ( "data/$file.json", 'w' );
				fwrite ( $hl, json_encode ( $this->users ) );
				fclose ( $hl );
				break;
			default: break;
		}
	}
	
	function getUsers ( ) {
		return $this->users;
	}
	
	function getMeetings ( ) {
		return $this->meetings;
	}
	
	function insertMeeting ( $date, $title, $eating=true, 
			$comment='', $meettime='19:00', $eattime='18:00' ) {
		if ( !preg_match ( '@[0-9]{4}-[0-9]{2}-[0-9]{2}@', $date )
			|| !preg_match ( '@[0-9]{2}:[0-9]{2}@', $meettime )
			|| !preg_match ( '@[0-9]{2}:[0-9]{2}@', $eattime ) )
				return $this->meetings;
		if ( !empty( $this->meetings->{$date} ) )
			return $this->meetings;
		$this->meetings->{$date} = array (
			'title'		=> $title,
			'haseating'	=> $eating,
			'meettime'	=> $meettime,
			'eattime'	=> $eattime,
			'comment'	=> $comment
		);
		$this->writeData ( 'meetings' );
		return $this->meetings;
	}
	
	function insertUser ( $user ) {
		;
	}
}

$database = new Database();