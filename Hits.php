<?php
/**
* This class will create objects to hold results from the results of a GENIUS request
*/
class Hits
{
	public $_id;
	public $_artist;
	public $_song;
	public $_annotation_count;
	public $_api_path;
	public $_full_title;
	public $_header_image;
	public $_lyrics;

	function __construct($id = null, $artist = null, $song = null, $annotation_count = null, $api_path = null, $full_title = null, $header_image = null, $lyrics = null)
	{
		$this->_id = $id;
		$this->_artist = $artist;
		$this->_song = $song;
		$this->_annotation_count = $annotation_count;
		$this->_api_path = $api_path;
		$this->_full_title = $full_title;
		$this->_header_image = $header_image;
		$this->_lyrics = $lyrics;
	}

	function __destruct () {}

	function __toString () {
		echo implode(",", $this->toArray());
	}

	/* Getters and Setters */
	/**
     * Gets the value of _artist.
     * @return mixed
     */
    public function getArtist()
    {
        return $this->_artist;
    }

    /**
     * Sets the value of _artist.
     * @param mixed $_artist the artist
     * @return self
     */
    public function setArtist($artist)
    {
        $this->_artist = $artist;
        return $this;
    }

    /**
     * Gets the value of _song.
     * @return mixed
     */
    public function getSong()
    {
        return $this->_song;
    }

    /**
     * Sets the value of _song.
     * @param mixed $_song the song
     * @return self
     */
    public function setSong($song)
    {
        $this->_song = $song;
        return $this;
    }

    /**
     * Gets the value of _annotation_count.
     * @return mixed
     */
    public function getAnnotationCount()
    {
        return $this->_annotation_count;
    }

    /**
     * Sets the value of _annotation_count.
     * @param mixed $_annotation_count the annotation count
     * @return self
     */
    public function setAnnotationCount($annotation_count)
    {
        $this->_annotation_count = $annotation_count;
        return $this;
    }

    /**
     * Gets the value of _api_path.
     * @return mixed
     */
    public function getApiPath()
    {
        return $this->_api_path;
    }

    /**
     * Sets the value of _api_path.
     * @param mixed $_api_path the api path
     * @return self
     */
    public function setApiPath($api_path)
    {
        $this->_api_path = $api_path;
        return $this;
    }

    /**
     * Gets the value of _full_title.
     * @return mixed
     */
    public function getFullTitle()
    {
        return $this->_full_title;
    }

    /**
     * Sets the value of _full_title.
     * @param mixed $_full_title the full title
     * @return self
     */
    public function setFullTitle($full_title)
    {
        $this->_full_title = $full_title;
        return $this;
    }

    /**
     * Gets the value of _header_image.
     * @return mixed
     */
    public function getHeaderImage()
    {
        return $this->_header_image;
    }

    /**
     * Sets the value of _header_image.
     * @param mixed $_header_image the header image
     * @return self
     */
    public function setHeaderImage($header_image)
    {
        $this->_header_image = $header_image;
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
    public function setLyrics($lyrics)
    {
        $this->_lyrics = $lyrics;
        return $this;
    }

    public function toArray() {
    	return array("id" => $this->_id,
    				 "artist" => $this->_artist,
    				 "song" => $this->_song,
    				 "annotation_count" => $this->_annotation_count,
    				 "api_path" => $this->_api_path,
    				 "full_title" => $this->_full_title,
    				 "header_image" => $this->_header_image,
    				 "lyrics" => $this->_lyrics);
    }

    public function toJSON () {
    	echo json_encode($this->toArray);
    }
}
?>