<?php
/**
* This object will contain information about a given song
*/

class Song
{
	public $_title;
	public $_album_art;

	function __construct($title, $album_art)
	{
		$this->_title = $title;
		$this->_album_art = $album_art;
	}

	function __destruct() {}

	function __toString() {
		echo implode(" ", $this->toArray);
	}

    /**
     * Gets the value of _title.
     * @return mixed
     */
    public function getTitle() {
        return $this->_title;
    }

    /**
     * Sets the value of _title.
     * @param mixed $_title the title
     * @return self
     */
    public function setTitle($title) {
        $this->_title = $title;
        return $this;
    }

    /**
     * Gets the value of _album_art.
     * @return mixed
     */
    public function getAlbumArt() {
        return $this->_album_art;
    }

    /**
     * Sets the value of _album_art.
     * @param mixed $_album_art the album art
     * @return self
     */
    public function setAlbumArt($album_art) {
        $this->_album_art = $album_art;
        return $this;
    }

    public function toArray() {
    	return array($this->_title, $this->_album_art);
    }
}
?>