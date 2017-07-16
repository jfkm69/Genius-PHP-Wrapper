<?php
/**
* This is an unofficial wrapper for the GENIUS API
* This class gets the lyrics from the lyrics page
*/
class Lyrics
{
	//The URL to the page with the lyrics
	public $_lyrics_url;
    //The id of the writer of the lyrics
    public $_lyrics_owner_id;
	//The lyrics obtained from the page
	public $_lyrics;

	function __construct($lyrics_url = null, $lyrics_owner_id = null)
	{
		$this->_lyrics_url = $lyrics_url;
        $this->_lyrics_owner_id = $lyrics_owner_id;
		$this->_lyrics = $this->setLyrics();
	}

	function __destruct () {}

	function __toString() {
		return $this->_lyrics;
	}

	/**
     * Gets the value of _lyrics_url.
     * @return mixed
     */
    public function getLyricsUrl()
    {
        return $this->_lyrics_url;
    }

    /**
     * Sets the value of _lyrics_url.
     * @param mixed $_lyrics_url the lyrics url
     * @return self
     */
    public function setLyricsUrl($lyrics_url)
    {
        $this->_lyrics_url = $lyrics_url;
        return $this;
    }

    /**
     * Gets the value of _lyrics.
     * @return mixed
     */
    public function getLyrics()
    {
        return $this->_lyrics;
    }

    /**
     * Sets the value of _lyrics.
     * @param mixed $_lyrics the lyrics
     * @return self
     */
    public function setLyrics()
    {
        echo $this->_lyrics_url;
		$lyrics = $this->sendRequest($this->_lyrics_url);
		$dom = new DOMDocument;
		libxml_use_internal_errors(true);
		$dom->loadHTML($lyrics);
        var_dump ($dom->firstChild->entities);
        $dom->preserveWhiteSpace = false; 
        $xpath = new \DOMXPath($dom);
        // var_dump($xpath);
		$data = $xpath->query('*/div[(@class="lyrics")]');
        var_dump($data);
		$lyricData =  stripcslashes($data->item(0)->nodeValue);
        return $lyricData;
    }

    /**
     * Gets the value of _lyrics_owner_id.
     * @return mixed
     */
    public function getLyricsOwnerId()
    {
        return $this->_lyrics_owner_id;
    }

    /**
     * Sets the value of _lyrics_owner_id.
     * @param mixed $_lyrics_owner_id the lyrics owner id
     * @return self
     */
    public function setLyricsOwnerId($lyrics_owner_id)
    {
        $this->_lyrics_owner_id = $lyrics_owner_id;
        return $this;
    }

    public function sendRequest ($url) {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => $_SERVER['HTTP_USER_AGENT'],
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_COOKIESESSION => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_REFERER => $url,
            CURLOPT_VERBOSE => true
            ));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
?>