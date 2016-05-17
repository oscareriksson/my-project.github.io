<?php

class CAlterNews {

    // Properties


    public function __construct($connectInfo)
    {

        $this->db = new CDatabase($connectInfo);
        $this->content = new CContent($connectInfo);
        $this->filter = new CTextFilter();

    }

    public function getNewBlogs($limit)
    {
        $sql = "SELECT * FROM content
        WHERE TYPE = 'post'
        ORDER BY published DESC
        LIMIT $limit
        ";

        $res = $this->db->ExecuteSelectQueryAndFetchAll($sql);

        $html = null;
        foreach($res as $row) {
            $title = htmlentities($row->title, null, 'UTF-8');
            $data = $this->filter->doFilter(htmlentities($row->DATA, null, 'UTF-8'), $row->FILTER);
            $published = htmlentities($row->published, null, 'UTF-8');
            $updated = htmlentities($row->updated, null, 'UTF-8');
            $updated = $updated != null ? ", uppdaterad " . $updated : null;
            // $updated removed after $published in $html.

            $data = substr($data, 0, 70) . "... <a href='" . $this->content->getUrlToContent($row) . "'>Läs mer »</a>";

            $categories = explode(" ", $row->category);
            $catView = null;

            foreach($categories as $category) {
                $catView .= "<a href='blog.php?category={$category}'>{$category}</a>&nbsp";
            }

            $catDiv = $this->getCatDiv($row->category);

            $html .= <<<EOD
            <div class='newBlog'>
            <div class='blogHeader'>
            <div class='{$catDiv}'>{$catView}</div>
            <div class='blogTitle'><a href='{$this->content->getUrlToContent($row)}'>{$title}</a></div>
            </div>
            <div class='blogData'>{$data}</div>
            <div class='blogPub'>Publicerad: {$published}</div>
            </div>
EOD;

        }

        return $html;
    }

    public function getNewMovies($limit)
    {
        $sql = "SELECT * FROM content
        ORDER BY created DESC
        LIMIT $limit
        ";

        $res = $this->db->ExecuteSelectQueryAndFetchAll($sql);

        $img = null;
        foreach($res as $rows) {
            if ($rows->TYPE == 'movie') {
                $playIcon = "<div class='playSlide'><img src='../webroot/img/playIcon.png' alt='playIcon'/></div>";
            }
            else {
                $playIcon = null;
            }

            $img .= "<div class='slideshow'><a href='movies.php?id={$rows->id}'><img src='img.php?src={$rows->image}&amp;width=550&amp;height=250&amp;crop-to-fit' alt='{$rows->title}'/></a><div class='slideTitle'>{$playIcon}<a href='movies.php?id={$rows->id}'>{$rows->title}</a></div></div>";
        }

        return $img;
    }

    public function getPopularMovies($limit)
    {
        $sql = "SELECT * FROM content
        ORDER BY created DESC
        LIMIT $limit
        ";

        $res = $this->db->ExecuteSelectQueryAndFetchAll($sql);

        $img = null;
        foreach($res as $rows) {
            if ($rows->TYPE == 'movie') {
                $playIcon = "<div class='playIcon'><img src='../webroot/img/playIcon.png' alt='playIcon'/></div>";
            }
            else {
                $playIcon = null;
            }
            $rows->DATA = substr($rows->DATA, 0, 100) . "...";
            $img .= "<div class='popMovie'><div class='popLeft'><a href='movies.php?id={$rows->id}'><img src='img.php?src={$rows->image}&amp;width=400&amp;height=200&amp;crop-to-fit' alt='{$rows->title}'/>{$playIcon}</a></div><div class='popRight'><div class='titleYear'><a href='movies.php?id={$rows->id}'>{$rows->title}</a></div><div class='info'><p>{$rows->DATA}</p></div></div></div>";
        }

        return $img;
    }

    public function getGenres($limit)
    {
        $sql = "SELECT name FROM genre
            ORDER BY id DESC
            LIMIT $limit
        ";

        $res = $this->db->ExecuteSelectQueryAndFetchAll($sql);

        $genres = null;
        foreach($res as $rows) {
            $genres .= "<div class='oneGenre'><a href='movies.php?genre={$rows->name}'>{$rows->name}</a></div>";
        }

        return $genres;
    }

    public function getCatDiv($category)
    {
        $catDiv = null;
        switch($category) {
            case 'Nyhet':
                $catDiv = 'blogNews';
                break;
            case 'Serie':
                $catDiv = 'blogSerie';
                break;
            case 'Film':
                $catDiv = 'blogFilm';
                break;
            default:
                $catDiv = 'blogDefault';
        }
        return $catDiv;
    }



}
