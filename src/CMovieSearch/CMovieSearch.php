<?php


class CMovieSearch
{

// Properties

private $title = "";
private $genre = "";
private $sql = "";
private $sqlOne = "";
private $params = array();
private $where = "";
private $orderby;
private $order;
private $page;
private $hits;
private $year1;
private $year2;

public function __construct($connectInfo, $title, $genre, $orderby, $order, $hits, $page, $year1, $year2) {
    $this->db = new CDatabase($connectInfo);

    $this->title = $title;
    $this->genre = $genre;
    $this->orderby = $orderby;
    $this->order = $order;
    $this->page = $page;
    $this->hits = $hits;
    $this->year1 = $year1;
    $this->year2= $year2;

    $this->prepareSQL();
    $this->res = $this->db->ExecuteSelectQueryAndFetchAll($this->sql, $this->params);
}

public function viewSearchField()
{
    $string = <<<EOD
    <form class='searchField'>
    <p><input class='search-box' type='search' name='title' value='{$this->title}' placeholder='Titel (delsträng, använd % som *) '/></p>
    <p><input class='year-box' type='number' name='year1' value='{$this->year1}' placeholder='Från år'/> - <input class='year-box' type='number' name='year2' value='{$this->year2}' placeholder='Till år'/>
    <p><input class='search-button' type='submit' name='submit' value='Sök'/></p>
    <p><a href='?'>Visa alla filmer</a></p>
    </form>
EOD;

    return $string;
}

public function viewGenres()
{
    $sql = "SELECT name FROM genre";

    $res = $this->db->ExecuteSelectQueryAndFetchAll($sql);

    $html = "<div class='searchGenre'>";
    foreach($res as $row) {
        $html .= "<a href=?genre={$row->name}>$row->name</a> | ";
    }
    $html .= "</div>";
    return $html;
}

public function prepareSQL()
{
    $this->sql = "SELECT * FROM movie";
    $this->params = null;

    if($this->title) {
        $this->where .= "AND title LIKE ? ";
        $this->params[] = $this->title;
    }

    if($this->genre) {
        $this->where .= "AND genre LIKE '%" . $this->genre . "%' ";
        //$this->params[] = $this->genre;
    }

    if($this->year1 && $this->year2) {
        $this->where .= "AND YEAR >= ? AND YEAR <= ? ";
        $this->params[] = $this->year1;
        $this->params[] = $this->year2;
    }
    elseif($this->year1) {
        $this->where .= "AND YEAR >= ? ";
        $this->params[] = $this->year1;
    }
    elseif($this->year2) {
        $this->where .= "AND YEAR <= ? ";
        $this->params[] = $this->year2;
    }

    if($this->where != "") {
        $this->sql .= " WHERE 1 " . $this->where;
    }

    $this->sqlOne = $this->sql;

    $this->sql .= " ORDER BY movie." . $this->orderby . " " . $this->order;

    // Numbers of rows viewed
    $this->sql .= " LIMIT $this->hits OFFSET " . (($this->page - 1) * $this->hits);
}

public function getRes()
{
    return $this->res;
}

public function getMaxRows()
{
    return count($this->db->ExecuteSelectQueryAndFetchAll($this->sqlOne, $this->params));
}
}
