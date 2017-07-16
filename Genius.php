<?php
/**
* This is the base class for requests to the GENIUS API
*/
include 'Hits.php';
include 'Song.php';
include 'Artist.php';
include 'Lyrics.php';

class Genius
{
	//The auth_token provided by GENIUS
	public $_auth_token;
	//The search parameters provided by the user -- This should include the artist name and title
	public $_searchParam;
	//The results that match the given the criteria that are to be returned to the user
	public $_results;

	/*This is the constructor for a simple request to the GENIUS API using the authentication key and a given search parameter
	*The parameters are:
	*@auth_token - This is the authentication key provided by GENIUS
	*@searchParam - This is the song you wish to search - This has been set as *null in a attempt to overload the __construct function
	*__construct function
	*/
	function __construct($auth_token, $searchParam = null){
		$this->_auth_token = $auth_token;
		$this->_searchParam = $searchParam;
	}
	/*Destructor for garbage collection when the object is no longer in use*/
	function __destruct () {}
	/*Magic function to return a value when echo or print is called on the object*/
	function __toString () {
    	echo implode("", $this->_results);
	}

    /**
     * Gets the value of _auth_token.
     * @return mixed
     */
    public  function getAuthToken(){
        return $this->_auth_token;
    }

    /**
     * Sets the value of _auth_token.
     * @param mixed $_auth_token the auth token
     * @return self
     */
    public function setAuthToken($auth_token){
        $this->_auth_token = $auth_token;
        return $this;
    }

    /**
     * Gets the value of _searchParam.
     * @return mixed
     */
    public function getSearchParam(){
        return $this->_searchParam;
    }

    /**
     * Sets the value of _searchParam.
     * @param mixed $_searchParam the search param
     * @return self
     */
    public function setSearchParam($searchParam){
        $this->_searchParam = $searchParam;
        return $this;
    }

    /*This function makes the requeset to the GENIUS API.
    * It recieves the response from the GENIUS API and processes the information
    * @return it returns an array with all the hits that match the given criteria or an *error if the request was unsuccesful
    */
    public function makeRequest() {
    	$base_url = "https://api.genius.com/search?";
    	$url = $base_url."q=".str_replace("+", "%20", urlencode($this->getSearchParam()));
    	//The response from the GENIUS API is a JSON file that must first be decoded
    	$request = json_decode($this->sendRequest($url), false);
    	// echo $request;
    	//Get the status of the result
    	switch ($request->meta->status) {
    		case 200:
    			// The request was successful...let's mine through the results and see what we find
    			//The results array created above will store the results that match our criteria
    			$this->_results = array();
    			//The results will display as regular text so in order to match the search parameter that must be urlencoded before sending we must urldecode it
				$matchParam = urldecode($this->getSearchParam());
    			//Let's loop through all the results and look for a match to the song we want
    			$i = 0;
    			foreach ($request->response->hits as $hits) {
    				//Let's run the code only when the hit matches the exact song we want
    				if (preg_match("/{$matchParam}/",  $hits->result->primary_artist->name."-".$hits->result->title)){
    					$hit[$i] = new Hits($hits->result->id, new Artist($hits->result->primary_artist->id, $hits->result->primary_artist->name, $hits->result->primary_artist->url, $hits->result->primary_artist->image_url, $hits->result->primary_artist->header_image_url), new Song($hits->result->title, $hits->result->song_art_image_thumbnail_url), $hits->result->annotation_count, $hits->result->api_path, $hits->result->full_title, $hits->result->header_image_url, new Lyrics($hits->result->url, $hits->result->lyrics_owner_id));
    					array_push($this->_results, $hit[$i]);
    					$i++;
    				}
    			}

    			break;
    		
    		default:
    			//Ooops :/
    			echo "The request failed because....".$request->meta->message;
    			break;
    	}
    }

    //Return the object as an Array
    public final function toArray() {
    	$this->__toString();
    	return $this->_results;
    }
	//Return the object as a JSON object
    public final function toJSON() {
    	echo json_encode($this->_results);
    }
    //Returns the result a pretty print version of json for display on a browser
    public final function toPrettyJSON() {
    	echo "<pre>";
    	echo json_encode($this->_results, JSON_PRETTY_PRINT);
    	echo "</pre>";
    }

    //Make a CURL request
    public function sendRequest ($url) {
    	$ch = curl_init();
    	curl_setopt_array($ch, array(
    		CURLOPT_URL => $url,
    		CURLOPT_RETURNTRANSFER => true,
    		CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
    		CURLOPT_HTTPHEADER => array("Authorization: Bearer {$this->getAuthToken()}","Host: api.genius.com", "Content-Type: application/json"),
			CURLOPT_SSL_VERIFYPEER => false,
    		));
    	return curl_exec($ch);
    	curl_close($ch);
    }
}
?>