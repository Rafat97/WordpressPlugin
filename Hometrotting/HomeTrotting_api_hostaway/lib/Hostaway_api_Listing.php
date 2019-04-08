<?php 


/**
 * 
 */
class API_Listing 
{

	 public static $HOSTAWAY_API_SECRETKEY;
	 public static $HOSTAWAY_API_ID;
	 private $HOSTAWAY_API_LISTING_URL;
	
	function __construct($API_SECRETKEY , $API_ID)
	{
		$this->HOSTAWAY_API_SECRETKEY = $API_SECRETKEY;
		$this->HOSTAWAY_API_ID = $API_ID;
		$this->HOSTAWAY_API_LISTING_URL = "https://api.hostaway.com/v1/listings?limit=&offset=&sortOrder=&city=&keyword=&country=&isSyncing=true&contactName=&propertyTypeId=&includeResources=1&availabilityDateStart=&availabilityDateEnd=&availabilityGuestNumber=";


		//echo "<h1>Listing object</h1>".$this->HOSTAWAY_API_SECRETKEY."<br>";
	}

	public function getApi_SECRET()
	{
		return $this->HOSTAWAY_API_SECRETKEY;
	}

	public function getApi_ID()
	{
		return $this->HOSTAWAY_API_ID;
	}

	public function get_All_Listing_json()
	{
		
        $curl = curl_init();

		
		$url_main = "https://api.hostaway.com/v1/listings?limit=&offset=&sortOrder=&city=&keyword=&country=&isSyncing=&contactName=&propertyTypeId=&includeResources=";

		$url_limit= "https://api.hostaway.com/v1/listings?limit=2";
		$url_limit_sort= "https://api.hostaway.com/v1/listings?limit=1&sortOrder=starRatingReversed";
		

		$url_function = $this->HOSTAWAY_API_LISTING_URL;

		curl_setopt_array($curl, array(
		  
		  //48419
		  CURLOPT_URL => $url_function,
		  

		  
		  //CURLOPT_URL => "https://api.hostaway.com/v1/listings/48420",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "grant_type=client_credentials&client_id=".$this->getApi_ID()."&client_secret=".$this->getApi_SECRET()."&scope=general",
		  CURLOPT_HTTPHEADER => array(
		    "authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0In0.eyJhdWQiOiIxMjM2MyIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0IiwiaWF0IjoxNTQwNDg3MTM1LCJuYmYiOjE1NDA0ODcxMzUsImV4cCI6MTU1NjAzOTEzNSwic3ViIjoiIiwic2NvcGVzIjpbImdlbmVyYWwiXX0.e5-nyxIsddg-nKVYLHUrlYcvxmUc-gCAWNhOyFVtNsPSY1i0mA0t0NrxoLzygKLW6av75grDYsI8c3QZrxN2_FZ583O--vg4StynaaOmSeckrPAilF6ubhwSp8qkPTpAsWm7IxFchQ57JkLiyMZLLwX-gFKK8dsNH86LzYB89GE",
		    "cache-control: no-cache"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  //echo "cURL Error #:" . $err;
		  return $err;
		} else {
			//echo $response;

			 return $response;
		    //$val = json_decode($response,true);
		  //$var = json_encode($var);
		  //print_r($val);
		}


	}
	public function get_All_Listing_array()
	{
		$val = $this->get_All_Listing_json();
		$val = json_decode($val,true);
		return $val;

	}
	
	
	
	
	
	public function get_All_Listing_Is_Availability_json($startDate , $EndDate ,$guest)
	{
		
        $curl = curl_init();

		
		$url_function = "https://api.hostaway.com/v1/listings?includeResources=1&availabilityDateStart=".$startDate."&availabilityDateEnd=".$EndDate."&availabilityGuestNumber=".$guest."&city=Montréal";

		curl_setopt_array($curl, array(
		  
		  //48419
		  CURLOPT_URL => $url_function,
		  

		  
		  //CURLOPT_URL => "https://api.hostaway.com/v1/listings/48420",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "grant_type=client_credentials&client_id=".$this->getApi_ID()."&client_secret=".$this->getApi_SECRET()."&scope=general",
		  CURLOPT_HTTPHEADER => array(
		    "authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0In0.eyJhdWQiOiIxMjM2MyIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0IiwiaWF0IjoxNTQwNDg3MTM1LCJuYmYiOjE1NDA0ODcxMzUsImV4cCI6MTU1NjAzOTEzNSwic3ViIjoiIiwic2NvcGVzIjpbImdlbmVyYWwiXX0.e5-nyxIsddg-nKVYLHUrlYcvxmUc-gCAWNhOyFVtNsPSY1i0mA0t0NrxoLzygKLW6av75grDYsI8c3QZrxN2_FZ583O--vg4StynaaOmSeckrPAilF6ubhwSp8qkPTpAsWm7IxFchQ57JkLiyMZLLwX-gFKK8dsNH86LzYB89GE",
		    "cache-control: no-cache"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  //echo "cURL Error #:" . $err;
		  return $err;
		} else {
			//echo $response;

			 return $response;
		    //$val = json_decode($response,true);
		  //$var = json_encode($var);
		  //print_r($val);
		}


	}
	public function get_All_Listing_Is_Availability_Array($startDate , $EndDate ,$guest)
	{
		$val = $this->get_All_Listing_Is_Availability_json($startDate , $EndDate ,$guest);
		$val = json_decode($val,true);
		return $val;

	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function get_Individual_Listing_json($roomId)
    {
		$roomIdfind = $roomId;
		
        $curl = curl_init();

		
		//$url_main = "https://api.hostaway.com/v1/listings?limit=&offset=&sortOrder=&city=&keyword=&country=&isSyncing=&contactName=&propertyTypeId=&includeResources=";

		//$url_limit= "https://api.hostaway.com/v1/listings?limit=2";
		//$url_limit_sort= "https://api.hostaway.com/v1/listings?limit=1&sortOrder=starRatingReversed";
		

		$url_function = "https://api.hostaway.com/v1/listings"."/".$roomIdfind."?includeResources=1";

		curl_setopt_array($curl, array(
		  
		  //48419
		  CURLOPT_URL => $url_function,
		  

		  
		  //CURLOPT_URL => "https://api.hostaway.com/v1/listings/48420",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "grant_type=client_credentials&client_id=".$this->getApi_ID()."&client_secret=".$this->getApi_SECRET()."&scope=general",
		  CURLOPT_HTTPHEADER => array(
		    "authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0In0.eyJhdWQiOiIxMjM2MyIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0IiwiaWF0IjoxNTQwNDg3MTM1LCJuYmYiOjE1NDA0ODcxMzUsImV4cCI6MTU1NjAzOTEzNSwic3ViIjoiIiwic2NvcGVzIjpbImdlbmVyYWwiXX0.e5-nyxIsddg-nKVYLHUrlYcvxmUc-gCAWNhOyFVtNsPSY1i0mA0t0NrxoLzygKLW6av75grDYsI8c3QZrxN2_FZ583O--vg4StynaaOmSeckrPAilF6ubhwSp8qkPTpAsWm7IxFchQ57JkLiyMZLLwX-gFKK8dsNH86LzYB89GE",
		    "cache-control: no-cache"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  //echo "cURL Error #:" . $err;
		  return $err;
		} else {
			

			 return $response;
		  
		}


	}
	public function get_Individual_Listing_array($roomId)
	{
		$val = $this->get_Individual_Listing_json($roomId);
		$val = json_decode($val,true);
		return $val;

	}
	
	
	public function get_Calendar_json($room , $start_date , $end_date)
    {
        
        
        
		$curl = curl_init($room);

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.hostaway.com/v1/listings/".$room."/calendar?startDate=".$start_date."&endDate=".$end_date."&includeResources=1",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_POSTFIELDS => "grant_type=client_credentials&client_id=10450&client_secret=14add8b71a3494a946823c7729741c8b&scope=general",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0In0.eyJhdWQiOiIxMjM2MyIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0IiwiaWF0IjoxNTQwNDg3MTM1LCJuYmYiOjE1NDA0ODcxMzUsImV4cCI6MTU1NjAzOTEzNSwic3ViIjoiIiwic2NvcGVzIjpbImdlbmVyYWwiXX0.e5-nyxIsddg-nKVYLHUrlYcvxmUc-gCAWNhOyFVtNsPSY1i0mA0t0NrxoLzygKLW6av75grDYsI8c3QZrxN2_FZ583O--vg4StynaaOmSeckrPAilF6ubhwSp8qkPTpAsWm7IxFchQ57JkLiyMZLLwX-gFKK8dsNH86LzYB89GE",
		    "cache-control: no-cache"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          return $err;
        } else {
          return $response;
        }


	}
	public function get_Calendar_array($room , $start_date , $end_date)
	{
		$val = $this->get_Calendar_json($room ,$start_date , $end_date);
		$val = json_decode($val,true);
		return $val;

	}
	
	
	public function get_amenity_json()
    {
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.hostaway.com/v1/amenities",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0In0.eyJhdWQiOiIxMjM2MyIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0IiwiaWF0IjoxNTQwNDg3MTM1LCJuYmYiOjE1NDA0ODcxMzUsImV4cCI6MTU1NjAzOTEzNSwic3ViIjoiIiwic2NvcGVzIjpbImdlbmVyYWwiXX0.e5-nyxIsddg-nKVYLHUrlYcvxmUc-gCAWNhOyFVtNsPSY1i0mA0t0NrxoLzygKLW6av75grDYsI8c3QZrxN2_FZ583O--vg4StynaaOmSeckrPAilF6ubhwSp8qkPTpAsWm7IxFchQ57JkLiyMZLLwX-gFKK8dsNH86LzYB89GE",
		    "cache-control: no-cache",
            "content-type: application/json"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          return $err;
        } else {
          return $response;
        }
        
	}
	public function get_amenity_array()
	{
		$val = $this->get_amenity_json();
		$val = json_decode($val,true);
		return $val;

	}
	
	
	
	public function get_All_reservation_json()
    {
       $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.hostaway.com/v1/reservations?limit=500&offset=&order=&channelId=2000&listingId=&arrivalStartDate=&arrivalEndDate=&departureStartDate=&departureEndDate=&hasUnreadConversationMessages=",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_POSTFIELDS => "grant_type=client_credentials&client_id=10450&client_secret=14add8b71a3494a946823c7729741c8b&scope=general",
          CURLOPT_HTTPHEADER => array(
                "authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0In0.eyJhdWQiOiIxMjM2MyIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0IiwiaWF0IjoxNTQwNDg3MTM1LCJuYmYiOjE1NDA0ODcxMzUsImV4cCI6MTU1NjAzOTEzNSwic3ViIjoiIiwic2NvcGVzIjpbImdlbmVyYWwiXX0.e5-nyxIsddg-nKVYLHUrlYcvxmUc-gCAWNhOyFVtNsPSY1i0mA0t0NrxoLzygKLW6av75grDYsI8c3QZrxN2_FZ583O--vg4StynaaOmSeckrPAilF6ubhwSp8qkPTpAsWm7IxFchQ57JkLiyMZLLwX-gFKK8dsNH86LzYB89GE",
        	    "cache-control: no-cache"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          return $err;
        } else {
          return $response;
        }

               
        
	}
	public function get_All_reservation_array()
	{
		$val = $this->get_All_reservation_json();
		$val = json_decode($val,true);
		return $val;

	}
	
	
	
	
	public function get_Cancel_reservation_json($reservationId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.hostaway.com/v1/reservations/".$reservationId."/statuses/cancelled",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "PUT",
          CURLOPT_POSTFIELDS => "{\n\t\"cancelledBy\": \"host\"\n}",
          CURLOPT_HTTPHEADER => array(
           "authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0In0.eyJhdWQiOiIxMjM2MyIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0IiwiaWF0IjoxNTQwNDg3MTM1LCJuYmYiOjE1NDA0ODcxMzUsImV4cCI6MTU1NjAzOTEzNSwic3ViIjoiIiwic2NvcGVzIjpbImdlbmVyYWwiXX0.e5-nyxIsddg-nKVYLHUrlYcvxmUc-gCAWNhOyFVtNsPSY1i0mA0t0NrxoLzygKLW6av75grDYsI8c3QZrxN2_FZ583O--vg4StynaaOmSeckrPAilF6ubhwSp8qkPTpAsWm7IxFchQ57JkLiyMZLLwX-gFKK8dsNH86LzYB89GE",
		    "cache-control: no-cache",
            "content-type: application/json"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          return $err;
        } else {
          return $response;
        }
               
        
	}
	public function get_Cancel_reservation_array($reservationId)
	{
		$val = $this->get_Cancel_reservation_json($reservationId);
		$val = json_decode($val,true);
		return $val;

	}
	
	
	public function get_Delete_reservation_json($reservationId){
            $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.hostaway.com/v1/reservations/".$reservationId,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "DELETE",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0In0.eyJhdWQiOiIxMjM2MyIsImp0aSI6IjQxOWFiN2IwZjg1MTBhMjYxYzc3NmRhMTgzNzVjMjg3MTFkNGZjMjYxMDIwY2Y2MjgwMTUzYzljZDZhNjEwYTAwM2YxN2UzMDBjYjQ4MGY0IiwiaWF0IjoxNTQwNDg3MTM1LCJuYmYiOjE1NDA0ODcxMzUsImV4cCI6MTU1NjAzOTEzNSwic3ViIjoiIiwic2NvcGVzIjpbImdlbmVyYWwiXX0.e5-nyxIsddg-nKVYLHUrlYcvxmUc-gCAWNhOyFVtNsPSY1i0mA0t0NrxoLzygKLW6av75grDYsI8c3QZrxN2_FZ583O--vg4StynaaOmSeckrPAilF6ubhwSp8qkPTpAsWm7IxFchQ57JkLiyMZLLwX-gFKK8dsNH86LzYB89GE",
		    "cache-control: no-cache",
            "content-type: application/json"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            return $err;
        } else {
          return $response;
        }
                   
        
	}
    public function get_Delete_reservation_array($reservationId){
    		$val = $this->get_Delete_reservation_json($reservationId);
    		$val = json_decode($val,true);
    		return $val;
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}












 ?>