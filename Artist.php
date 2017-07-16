<?php
/**
* This object contains the details about the artist
*/
class Artist
{
	public $_id;
	public $_name;
	public $_url;
	public $_image_url;
	public $_header_image;

	function __construct($id, $name, $url, $image_url, $header_image)
	{
		$this->_id = $id;
		$this->_name = $name;
		$this->_url = $url;	
		$this->_image_url = $image_url;
		$this->_header_image = $header_image;
	}

	function __destruct() {}

	function __toString() {
		echo implode(",", $this->toArray());
	}

    /**
     * Gets the value of _id.
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Sets the value of _id.
     * @param mixed $_id the id
     * @return self
     */
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    /**
     * Gets the value of _name.
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Sets the value of _name.
     * @param mixed $_name the name
     * @return self
     */
    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }

    /**
     * Gets the value of _url.
     * @return mixed
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * Sets the value of _url.
     * @param mixed $_url the url
     * @return self
     */
    public function setUrl($url)
    {
        $this->_url = $url;
        return $this;
    }

    /**
     * Gets the value of _image.
     * @return mixed
     */
    public function getImageUrl()
    {
        return $this->_image_url;
    }

    /**
     * Sets the value of _image.
     * @param mixed $_image the image
     * @return self
     */
    public function setImageUrl($image_url)
    {
        $this->_image_url = $image_url;
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

    public function toArray() {
  		return array("id" => $this->_id,
  					 "name" => $this->_name,
  					 "url" => $this->_url,
  					 "image_url" => $this->_image_url,
  					 "header_image" => $this->_header_image);
    }
}
?>