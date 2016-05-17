<?php


class CContent {

    //Properties
    public $db;

    public function __construct($connectInfo)
    {

        $this->db = new CDatabase($connectInfo);

    }

    public function initContentTable()
        {

        $sql = "DROP TABLE IF EXISTS Content;
        CREATE TABLE content
        (
        id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        slug CHAR(80) UNIQUE,
        url CHAR(80) UNIQUE,

        TYPE CHAR(80),
        title VARCHAR(80),
        DATA TEXT,
        FILTER CHAR(80),

        published DATETIME,
        created DATETIME,
        updated DATETIME,
        deleted DATETIME

        ) ENGINE INNODB CHARACTER SET utf8;
        ";

        $this->db->ExecuteQuery($sql);

    }

    public function resetContentTable()
    {
        $this->initContentTable();

        $sql = "
      INSERT INTO content (slug, url, TYPE, title, DATA, FILTER, published, created) VALUES
      ('hem', 'hem', 'page', 'Hem', 'Detta är min hemsida. Den är skriven i [url=http://en.wikipedia.org/wiki/BBCode]bbcode[/url] vilket innebär att man kan formattera texten till [b]bold[/b] och [i]kursiv stil[/i] samt hantera länkar.\n\nDessutom finns ett filter \"nl2br\" som lägger in <br>-element istället för \\\ n, det är smidigt, man kan skriva texten precis som man tänker sig att den skall visas, med radbrytningar.', 'bbcode,nl2br', NOW(), NOW()),
      ('om', 'om', 'page', 'Om', 'Detta är en sida om mig och min webbplats. Den är skriven i [Markdown](http://en.wikipedia.org/wiki/Markdown). Markdown innebär att du får bra kontroll över innehållet i din sida, du kan formattera och sätta rubriker, men du behöver inte bry dig om HTML.\n\nRubrik nivå 2\n-------------\n\nDu skriver enkla styrtecken för att formattera texten som **fetstil** och *kursiv*. Det finns ett speciellt sätt att länka, skapa tabeller och så vidare.\n\n###Rubrik nivå 3\n\nNär man skriver i markdown så blir det läsbart även som textfil och det är lite av tanken med markdown.', 'markdown', NOW(), NOW()),
      ('blogpost-1', NULL, 'post', 'Välkommen till min blogg!', 'Detta är en bloggpost.\n\nNär det finns länkar till andra webbplatser så kommer de länkarna att bli klickbara.\n\nhttp://dbwebb.se är ett exempel på en länk som blir klickbar.', 'link,nl2br', NOW(), NOW()),
      ('blogpost-2', NULL, 'post', 'Nu har sommaren kommit', 'Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost.', 'nl2br', NOW(), NOW()),
      ('blogpost-3', NULL, 'post', 'Nu har hösten kommit', 'Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost', 'nl2br', NOW(), NOW());
      ";

      $this->db->ExecuteQuery($sql);
    }

    public function getAllContent()
    {
        $sql = "SELECT *, (created <= NOW()) AS available
        FROM content;";
        $res = $this->db->ExecuteSelectQueryAndFetchAll($sql);

        $items = null;
        foreach ($res AS $key => $val) {
            $items .= "<li>{$val->TYPE} (" . (!$val->available ? 'inte ' : null) . "publicerad): " . htmlentities($val->title, null, 'UTF-8') . " (<a href='updatecontent.php?id={$val->id}'>editera</a> <a href='deletecontent.php?id={$val->id}'>ta bort</a> <a href='" . $this->getUrlToContent($val) . "'>visa</a>)</li>\n";
        }
        return $items;
    }

    public function getContentById($id)
    {
        $sql = "SELECT * FROM content WHERE id = ?";
        $params = array($id);

        $res = $this->db->ExecuteSelectQueryAndFetchAll($sql, $params);

        if (isset($res[0])) {
            $row = $res[0];
        }
        else {
            die('Given ID does not exist.');
        }
        return $row;
    }


    public function createContent()
    {

        $title = isset($_POST['title']) ? strip_tags($_POST['title']) : null;
        $type = isset($_POST['TYPE'])  ? strip_tags($_POST['TYPE']) : null;

        $slug = $this->slugify($title);

        $filter = empty($filter) ? 'link' : $filter;

        $sql = "INSERT INTO content
            (title, slug, TYPE, created)
            VALUES (?, ?, ?, NOW())
        ";

        $params = array($title, $slug, $type);

        $res = $this->db->ExecuteQuery($sql, $params);

        if ($res) {
            $output = "Sidan skapades";
        }
        else {
            $output = "Något gick fel";
        }
        return $output;
    }

    public function updateContentTable()
    {

        $id        = strip_tags($_POST['id']);
        $title     = strip_tags($_POST['title']);
        $slug      = strip_tags($_POST['slug']);
        $url       = strip_tags($_POST['url']);
        $data      = strip_tags($_POST['DATA']);
        $type      = strip_tags($_POST['TYPE']);
        $image      = $this->fileUpload();
        $youtube = strip_tags($_POST['youtube']);

        $sql = "UPDATE content SET
        title = ?,
        slug = ?,
        url = ?,
        data = ?,
        type = ?,
        image = ?,
        youtube = ?
        WHERE
        id = ?
        ";

        $url = empty($url) ? null : $url;
        $params = array($title, $slug, $url, $data, $type, $image, $youtube, $id);
        $res = $this->db->ExecuteQuery($sql, $params);

        if ($res) {
            $output = "Innehållet är ändrat.";
        }
        else {
            $output = "Något gick fel";
        }
        return $output;
    }

    // Delete by asigning delete = NOW()
    public function deleteContent($id)
    {
        $sql = "UPDATE content SET
        published = null,
        deleted = NOW()
        WHERE id = ?";

        $params = array($id);
        $res = $this->db->ExecuteQuery($sql, $params);

        $output = null;

        if ($res) {
            $output = "Innehållet har raderats";
        }
        else {
            $output = "Något gick fel.";
        }

        return $output;
    }

    public function getType($id, $youtube, $image){

        $sql = "SELECT *
        FROM content
        WHERE id = ?";

        $params = array($id);
        $res = $this->db->ExecuteSelectQueryAndFetchAll($sql, $params);

        foreach($res AS $key => $val) {
        switch($val->TYPE) {
            case 'movie': return "<input type='hidden' name='image' value='{$image}'/><label>Youtube-länk:<br/><input type='text' name='youtube' value='{$youtube}'/></label>"; break;
            case 'picture': return "<label>Bild:<br/><img src='img/{$image}' alt='Current img' style='max-width:200px;'><br/><input type='file' name='image' id='image'/></label><input type='hidden' name='youtube' value='{$youtube}'/>"; break;
            default: return null; break;
        }
    }
    }

    /**
    * Create a link to the content, based on its type.
    *
    * @param object $content to link to.
    * @return string with url to display content.
    */
    public function getUrlToContent($content)
    {
        switch($content->TYPE) {
            case 'page': return "page.php?url={$content->url}"; break;
            case 'post': return "blog.php?slug={$content->slug}"; break;
            default: return null; break;
        }
    }

    private function fileUpload()
    {
            $target_dir = dirname(dirname(dirname(__FILE__))) . '/webroot/img/movie/';
            $target_file = $target_dir . basename($_FILES['image']['name']);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if(isset($_POST['submit'])) {
                $check = getimagesize($_FILES['image']['tmp_name']);
                if($check !== false) {
                    echo "File is an image - " . $check['mime'] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES['image']['size'] > 50000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    echo "The file ". basename( $_FILES['image']['name']). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    print_r($_FILES);
                }
            }
            return basename(dirname($target_file)) . "/" . basename($target_file);
    }

    /**
    * Create a slug of a string, to be used as url.
    *
    * @param string $str the string to format as slug.
    * @returns str the formatted slug.
    */
    public function slugify($str) {
        $str = mb_strtolower(trim($str));
        $str = str_replace(array('å','ä','ö'), array('a','a','o'), $str);
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = trim(preg_replace('/-+/', '-', $str), '-');
        return $str;
    }

}
