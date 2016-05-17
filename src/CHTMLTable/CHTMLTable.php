<?php

class CHTMLTable
{

    private $rows;
    private $max;
    private $hits;
    private $page;

    public function __construct($hits, $page, $connectInfo)
    {
        $this->db = new CDatabase($connectInfo);

        $this->hits = $hits;
        $this->page = $page;
    }

    public function viewHTMLTable ($res, $rows)
    {
        $this->rows = $rows;

        $this->max = ceil($this->rows / $this->hits);

        $html = "<div class='hitsPerPage'>" . $this->getHitsPerPage(array(2, 4, 8)) . "</div>";
        $html .= "
        <div class='movielistWrapper'>
            <div class='sort-by'>
            <span>Sortera efter:</span>
            <span class='sort-head'>Titel " . $this->orderby('title') . "</span>
            <span class='sort-head'>År " . $this->orderby('YEAR') . "</span>
            <span class='sort-head'>Pris " . $this->orderby('price') . "</span>
        </div>";

        foreach ($res as $row) {
            $genres = explode(" ", $row->genre);
            $html .= "<div class='movieRow'>";
            $html .= "<div class='movieImg'><img src='img.php?src={$row->image}&amp;width=76&amp;height=126&amp;crop-to-fit' alt='{$row->title}'/></div>";
            $html .= "<div class='movie-content'>";
            $html .= "<div class='left-mov'>";
            $html .= "<div class='movieTitle'><a href='?id={$row->id}'>{$row->title}</a></div>";
            $html .= "<div class='moviePlot'>" . substr($row->plot, 0, 99) . " ... <br><a href='?id={$row->id}'>Läs mer »</a></div>";
            $html .= "</div>";
            $html .= "<div class='right-mov'>";
            $html .= "<div class='movieGenre'><span class='opt-head'>Genre:</span>";
            foreach($genres as $genre) {
                $html .= "<span class='opt-desc'><a href='?genre={$genre}'>{$genre}</a></span>";
            }
            $html .= "</div>";
            $html .= "<div class='movieYear'><span class='opt-head'>År:</span><span class='opt-desc'>{$row->YEAR}</span></div>";
            $html .= "<div class='moviePrice'><span class='opt-head'>Pris:</span><span class='opt-desc'>{$row->price}kr</span></div>";
            $html .= "</div>";
            $html .= "</div>";
            $html .= "</div>\n";
        }
        $html .= "</div>";
        $html .= "<div class='pageNav'>" . $this->getPageNavigation($this->hits, $this->page, $this->max) . "</div>";
        return $html;
    }


    public function viewMovie($id)
    {
        $sql = "SELECT * FROM content
        WHERE id=?";
        $params = array($id);

        $res = $this->db->ExecuteSelectQueryAndFetchAll($sql, $params);

        $html = null;

        foreach($res as $row) {
            if ($row->TYPE == 'movie') {
                $contentType = "<iframe width='800' height='400' src='{$row->youtube}'></iframe>";
            }
            else {
                $contentType = "<img src='img.php?src={$row->image}&amp;width=800&amp;height=400' alt='{$row->title}'/>";
            }
            $html .= "<div class='oneWrap'>";
            $html .= "<div class='oneImg'>{$contentType}</div>";
            $html .= "<div class='oneTitle'><h1>{$row->title}</h1></div>";
            $html .= "<div class='one-left'>";
            $html .= "<div class='onePlot'>{$row->DATA}</div>";
            $html .= "</div>";
            $html .= "</div>";
        }
        if(!$res[0]) {$html = "Filmen finns ej.";}
        return $html;
    }

    private function orderby($column) {
        $nav = "<a href='". $this->getQueryString(array('orderby'=>$column, 'order'=>'ASC')) . "'>&darr;</a>";
        $nav .= "<a href='". $this->getQueryString(array('orderby'=>$column, 'order'=>'DESC')) . "'>&uarr;</a>";
        return $nav;
    }

    private function getHitsPerPage($hits) {
        $nav = "Antal per sida: ";
        foreach ($hits as $val) {
            $nav .= "<a href='" . $this->getQueryString(array('hits'=>$val)) . "'>$val</a> ";
        }
        return $nav;
    }

    private function getPageNavigation ($hits, $page, $max, $min=1) {
        $nav  = "<a href='" . $this->getQueryString(array('page' => $min)) . "'>&lt;&lt;</a> ";
        $nav .= "<a href='" . $this->getQueryString(array('page' => ($page > $min ? $page - 1 : $min) )) . "'>&lt;</a> ";

        for($i=$min; $i<=$max; $i++)
        {
            $nav .= "<a href='" . $this->getQueryString(array('page' => $i)) . "'>$i</a> ";
        }

        $nav .= "<a href='" . $this->getQueryString(array('page' => ($page < $max ? $page + 1 : $max) )) . "'>&gt;</a> ";
        $nav .= "<a href='" . $this->getQueryString(array('page' => $max)) . "'>&gt;&gt;</a> ";
        return $nav;
    }
    /**
    * Use the current querystring as base, modify it according to $options and return the modified query string.
    *
    * @param array $options to set/change.
    * @param string $prepend this to the resulting query string
    * @return string with an updated query string.
    */
    private function getQueryString($options, $prepend='?') {
        // parse query string into array
        $query = array();
        parse_str($_SERVER['QUERY_STRING'], $query);

        // Modify the existing query string with new options
        $query = array_merge($query, $options);

        // Return the modified querystring
        return $prepend . http_build_query($query);
    }
    }
