<?php

class CBlog {

    // Properties
    private $sqlOne;


    public function __construct($connectInfo)
    {
        $this->content = new CContent($connectInfo);
        $this->filter = new CTextFilter();
        $this->alter = new CAlterNews($connectInfo);

    }

    public function showBlogContent($hits, $page, $slug, $category)
    {

        $slugSQL = $slug ? 'slug = ?' : '1';
        $catSQL = $category ? "category LIKE '%" . $category . "%'" : '1';

        $sql = "
        SELECT *
        FROM content
        WHERE TYPE = 'post' AND
        $slugSQL AND
        $catSQL AND
        published <= NOW()
        ORDER BY published DESC
        ";

        $this->sqlOne = $sql;

        // Numbers of rows viewed
        if(!$slug) {
        $max = ceil($this->getMaxRows() / $hits);

        $page = $page > 0 ? $page : 1;
        $page = $page > $max ? $max : $page;

        $sql .= " LIMIT $hits OFFSET " . (($page - 1) * $hits);
        }
        else {
            $sql .= ";";
        }


        $res = $this->content->db->ExecuteSelectQueryAndFetchAll($sql, array($slug));

        if (isset($res[0])) {
            $html = "<div class='blog-wrapper'>";
            foreach ($res as $row) {
                $title = htmlentities($row->title, null, 'UTF-8');
                $data = $this->filter->doFilter(htmlentities($row->DATA, null, 'UTF-8'), $row->FILTER);
                $published = htmlentities($row->published, null, 'UTF-8');
                $updated = htmlentities($row->updated, null, 'UTF-8');

                $updated = $updated != null ? ", uppdaterad " . $updated : null;

                $data = !$slug ? substr($data, 0, 100) . "... <p><a href='" . $this->content->getUrlToContent($row) . "'>Läs mer »</a></p>" : $data;

                $categories = explode(" ", $row->category);
                $catView = null;

                foreach($categories as $category) {
                    $catView .= "<a href='?category={$category}'>{$category}</a>&nbsp";
                }

                $catDiv = $this->alter->getCatDiv($row->category);

                $html .= <<<EOD
                <div class='one-blog'>
                <div class='{$catDiv}'>{$catView}</div>
                <div class='blog-title'><a href='{$this->content->getUrlToContent($row)}'>{$title}</a></div>
                <div class='blog-data'>{$data}</div>
                <div class='blog-pub'>Publicerad: {$published}{$updated}</div>
                </div>
EOD;
            }
        }
        else if($slug) {
            $html = "Inlägget finns ej.";
        }
        else {
            $html = "Det finns inga inlägg.";
        }
        $html .= "</div>";
        return $html;
    }

    public function getPageNavigation ($hits, $page, $min=1) {

        $rows = $this->getMaxRows();
        $max = ceil($rows / $hits);

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

    public function getHitsPerPage($hits) {
        $nav = "Antal per sida: ";
        foreach ($hits as $val) {
            $nav .= "<a href='" . $this->getQueryString(array('hits'=>$val)) . "'>$val</a> ";
        }
        return $nav;
    }

    public function getMaxRows()
    {
        return count($this->content->db->ExecuteSelectQueryAndFetchAll($this->sqlOne));
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
