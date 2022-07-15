<?php
namespace App\Http\Controllers\Classes;
class Firebase
{

public static function send(array $registrationIds, array $msg, $type = 0)	{

#API access key from Google API's Console

    define( 'API_ACCESS_KEY', 'AAAA9RvMMSY:APA91bHChFgjJgrPVPLyszmw1kUiXNJEzFnY_gX_OP3_ltszfuv8UMFZHSwUJOCSylxFsKlvtaG0XPfsK0ko5jxftK0dv2_eS6U9eEMGE67048dLgJstDz02HfIbtEWVNY-ojFdNVZYh' );
#prep the bundle
    //  $msg = array
    //       (
	// 	'body' 	=> 'Hello',
	// 	'title'	=> 'Notification Test savendra',
    //          	'icon'	=> 'myicon',/*Default Icon*/
    //           	'sound' => 'mySound'/*Default sound*/
    //       );

	$fields = array
			(
				'registration_ids'		=> $registrationIds,
				'notification'	=> $msg
			);
	
	
	$headers = array
			(
				'Authorization: key=' . API_ACCESS_KEY,
				'Content-Type: application/json'
			);

#Send Reponse To FireBase Server	
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );

#Echo Result Of FireBase Server
if($type === 1)
echo $result;

}

}

?>