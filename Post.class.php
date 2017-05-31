<?php
class Post
{
    /* Member data */
    private $id = "";
    private $link = "";
    private $title = "";

    /* Member getters */
    public function getID() {
        return $this->id;
    }

    public function getLink() {
        return $this->link;
    }

    public function getTitle() {
        return $this->title;
    }

    /* Member setters */
    public function setID($new_id) {
        $this->id = $new_id;
    }

    public function setLink($new_link) {
        $this->link = $new_link;
    }

    public function setTitle($new_title) {
         $this->title = $new_title;
    }

}
?>