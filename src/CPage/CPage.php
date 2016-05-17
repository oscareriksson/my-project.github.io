<?php


class CPage {

    // Properties
    private $title;


    public function __construct($connectInfo)
    {
        $this->content = new CContent($connectInfo);
        $this->filter = new CTextFilter();
    }

    public function showPageContent()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;

        $sql = "
        SELECT * FROM content
        WHERE
            type = 'page' AND
            url = ? AND
            published <= NOW();
        ";

        $res = $this->content->db->ExecuteSelectQueryAndFetchAll($sql, array($url));

        if(isset($res[0])) {
            $row = $res[0];
        }
        else {
            die('Fel: det finns inget innehåll.');
        }

        $title  = htmlentities($row->title, null, 'UTF-8');
        $this->title = $title;
        $data = $this->filter->doFilter(htmlentities($row->DATA, null, 'UTF-8'), $row->FILTER);

        $html = <<<EOD
        <h1>{$row->title}</h1>
        <p>{$data}</p>
EOD;

        return $html;
    }

    public function getTitle()
    {
        return $this->title;
    }

}
