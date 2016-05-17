<?php


class CMovie {

    //Properties
    public $db;

    public function __construct($connectInfo)
    {

        $this->db = new CDatabase($connectInfo);

    }

    public function initMovieTable()
        {
        $sql = " CREATE TABLE IF NOT EXISTS `movie` (
            `id` int(11) NOT NULL,
            `title` varchar(100) NOT NULL,
            `director` varchar(100) DEFAULT NULL,
            `LENGTH` int(11) DEFAULT NULL,
            `YEAR` int(11) NOT NULL DEFAULT '1900',
            `plot` text,
            `genre` char(100) DEFAULT NULL,
            `image` varchar(100) DEFAULT NULL,
            `price` int(11) DEFAULT NULL,
            `imdb` varchar(50) DEFAULT NULL,
            `trailer` varchar(50) DEFAULT NULL,
            `subtext` char(3) DEFAULT NULL,
            `speech` char(3) DEFAULT NULL,
            `quality` char(3) DEFAULT NULL,
            `format` char(3) DEFAULT NULL,
            `created` datetime DEFAULT NULL
            ) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;
        ";

        $this->db->ExecuteQuery($sql);

    }

    public function resetMovieTable()
    {
        $this->initContentTable();

        $sql = "INSERT INTO `movie` (`id`, `title`, `director`, `LENGTH`, `YEAR`, `plot`, `genre`, `image`, `price`, `imdb`, `trailer`, `subtext`, `speech`, `quality`, `format`, `created`) VALUES
        (1, 'Pulp fiction', NULL, NULL, 1994, 'Filmen är uppbyggd av fyra scenarion, som spelas upp bitvis tvärs och härs utan den ringaste inbördes ordning. Ett förälskat par beslutar sej för att göra ett spontant rån mot den restaurang som dom sitter och dricker kaffe i. Två samvetslösa torpeder får i uppdrag av gangsterkungen Marsellus, att hämta upp en väska med okänt innehåll.\n\nPrisboxaren, Butch, trotsar en påbjudning att lägga sig i en titelmatch och tvingas fly landet. Gangstern Vincent Vega beordras att gå ut med Marsellus vackra fru, Mia. Hela filmen är fylld av rappa dialoger (om både banala och allvarsamma ting), överjordiska mirakel, brutalt våld, droger, och vass humor. ', 'action comedy drama', 'movie/pulp-fiction.jpg', 99, 'http://www.imdb.com/title/tt0110912/', 'https://www.youtube.com/watch?v=s7EdQ4FqbhY', NULL, NULL, NULL, NULL, '2015-12-17 13:15:25'),
        (2, 'American Pie', NULL, NULL, 1999, 'Fyra grabbar beslutar sig för att bli av med oskulden innan High School är slut men press, nervositet och missriktad välvilja från föräldrar gör inte saken lättare.', 'comedy college', 'movie/american-pie.jpg', 89, 'http://www.imdb.com/title/tt0163651/', 'https://www.youtube.com/watch?v=iUZ3Yxok6N8', NULL, NULL, NULL, NULL, '2015-12-17 02:21:24'),
        (3, 'Pokémon The Movie 2000', NULL, NULL, 1999, 'Pokémontränaren Ash Ketchum och hans vänner Misty (Vatten-Pokémontränare) och Tracy (Pokémon-skådare) är ute på en båttur, men råkar ut för en storm som för dem till De Orangea Öarna (The Orange Islands). Där får de veta att en profetia har slagit in, och att världen hotas att bli översvämmad av en jättevåg. Bara \"Den Utvalde\" kan stoppa profetian från att slå in, och det visar sig vara Ash som är den utvalde.\n\nFör att rädda världen från undergång måste Ash samla på sig tre klot från tre olika öar (Eldön, Blixtön och Isön), för att sedan förena dessa i ett tempel på den stora ön som ligger i samband med de tre övriga.', 'adventure animation', 'movie/pokemon.jpg', 29, 'http://www.imdb.com/title/tt0210234/', 'https://www.youtube.com/watch?v=Aedr0EuDYW4', NULL, NULL, NULL, NULL, '2015-12-07 04:10:08'),
        (4, 'Kopps', NULL, NULL, 2003, 'Komedi som utspelar sig i en liten svensk småstad. I berättelsen möter vi ett gäng arbetskamrater vid den lokala polisstationen. Här har inte skett ett allvarligt brott de senaste tio åren. Så plötsligt en dag hotas stationen av nedläggning. Nu måste de komma på ett sätt att rädda situationen. ', 'comedy svenskt', 'movie/kopps.jpg', 39, 'http://www.imdb.com/title/tt0339230/', 'https://www.youtube.com/watch?v=aJFdePDqKrY', NULL, NULL, NULL, NULL, '2015-12-21 00:00:00'),
            (5, 'From Dusk Till Dawn', NULL, NULL, 1996, 'Att döda två polismän vid ett bankrån är inte smart men allt gick på tok då listan över de dödade också innehöll fyra Texas Rangers. Nu är bröderna Gecko på sitt livs flykt mot den mexikanska gränsen och mötet med sina bulvaner. Som säkerhet mot lagens långa arm har de kidnappat en far och hans två barn... ', 'crime horror action', 'movie/from-dusk-till-dawn.jpg', 39, 'http://www.imdb.com/title/tt0116367/', 'https://www.youtube.com/watch?v=-bBay_1dKK8', NULL, NULL, NULL, NULL, '2015-12-21 00:00:00'),
            (6, 'En Underbar Jävla Jul', NULL, NULL, 2015, '\"En underbar jävla jul\" är en varm komedi om den moderna familjen och dess ständiga kamp att alltid göra det rätta. 27-åriga Simon och Oscar har varit ett par i fem år. Nu ska de bli föräldrar. Detta är dock en hemlighet som de skjutit på att berätta för sina egna familjer i snart ett år. Nu finns det ingen återvändo, det kan inte vänta längre. Hemligheten måste fram! Och vilken tidpunkt vore mer perfekt än julafton – toleransens högtid.  ', 'comedy svenskt', 'movie/en-underbar-javla-jul.jpg', 129, 'www.imdb.com/title/tt4728582/', 'https://www.youtube.com/watch?v=ZmF6YLZZC1E', NULL, NULL, NULL, NULL, '2015-12-09 00:00:00'),
            (39, 'Huvudjägarna', NULL, NULL, 2011, 'I Jo Nesbøs \"Huvudjägarna\" möter vi den charmiga skurken Roger, en man som till synes har allt. Han är den bästa headhuntern i branschen. Han är gift med den alltför vackra galleristen Diana, har en alldeles för tjusig villa och för att hålla näsan över vattenytan ekonomiskt, måste han stjäla lite för mycket konst. ', 'thriller action', 'movie/huvudjagarna.jpg', 119, 'www.imdb.com/title/tt1614989/', 'https://www.youtube.com/watch?v=jpOrx5az7Fg', NULL, NULL, NULL, NULL, '2015-12-06 00:00:00'),
                (40, 'Blood Diamond', NULL, NULL, 2006, 'I inbördeskrigets kaotiska Sierra Leone under 90-talet får vi möta Danny Archer (DiCaprio), en sydafrikansk legosoldat och fiskaren Solomon Vandy (Hounsou). Båda är afrikaner men deras bakgrund är så olika de kan vara, tills ödet för dem samman i en gemensam jakt på en sällsynt rosa diamant som kan förändra deras liv. Under en fängelsevistelse får Archer reda på att Solomon - som har tagits från sin familj och tvingats jobba på diamantfältet - har hittat och gömt den ovanliga råstenen. Till sin hjälp har han Maddy Bowen (Connelly), en amerikansk journalist vars idealism fått sig en törn av bekantskapen med Archer. De två männen beger sig ut på en jakt genom ogästvänliga territorier, en resa som kan rädda Solomons familj och ge Archer den andra chans han trodde han aldrig skulle få. ', 'adventure action', 'movie/blooddiamond.jpg', 89, 'http://www.imdb.com/title/tt0450259/', 'https://www.youtube.com/watch?v=yknIZsvQjG4', NULL, NULL, NULL, NULL, '2015-12-02 00:00:00'),
                    (41, '2012', NULL, NULL, 2009, 'Mayaindianerna har förutspått världens undergång i flera hundra år och enligt deras sägnen kommer världen att drabbas av upprepade naturkatastrofer år 2012 för att efter det helt elimineras… Vi får uppleva specialeffekter som vi aldrig sett förut, vulkanutbrott, orkaner, smältande isar och raserande hus från alla världens hörn. Roland Emmerich regisserar denna nagelbitare som är fullspäckad med action men som även berör och får en att fundera över människans existens.\r\n\r\nVi följer flera människors livsöden och deras kamp mot klockan och i huvudrollen ser vi John Cusack som kämpar för att rädda inte bara sin familj utan hela mänskligheten. ', 'adventure sci-fi', 'movie/2012.jpg', 99, 'www.imdb.com/title/tt1190080/', 'https://www.youtube.com/watch?v=rvI66Xaj9-o', NULL, NULL, NULL, NULL, '2015-12-28 00:00:00'),
                    (42, 'Amy', NULL, NULL, 2015, 'Trots att hon bara givit ut två album, så är Amy Winehouse en av de största musikikonerna i brittisk historia. Men en röst som ofta beskrivs som en blandning av Billie Holiday, Dinah Washington och Sarah Vaughan, var Amy Winehouse en popstjärna med soul, med en gränsöverskridande musikalisk talang. Filmen visar livet bakom sensationsrubrikerna, historien om en otroligt talangfull artist som dog alldeles för ung. ', 'documentary drama', 'movie/amy.jpg', 139, 'www.imdb.com/title/tt2870648/', 'https://www.youtube.com/watch?v=_2yCIwmNuLE', NULL, NULL, NULL, NULL, '2015-12-27 00:00:00'),
                    (43, 'The Hunger Games: Mockingjay - Part 2', NULL, NULL, 2015, 'Medan nationen Panem är i fullskaligt krig, konfronterar Katniss President Snow i en slutgiltig uppgörelse. Tillsammans med hennes närmaste vänner – Gale, Finnick och Peeta ger de sig ut på ett uppdrag där de måste riskera allt för att rädda Panems invånare samt arrangera ett lönnmordsförsök på President Snow som har blivit mer och mer besatt av att förgöra henne. De dödliga fällorna, fienderna samt moraliska valen som väntar kommer utmana Katniss mer än vad någon arena i Hungerspelen någonsin gjort.', 'adventure action', 'movie/hungergamesmockingjay.jpg', 159, 'www.imdb.com/title/tt1951266/', 'https://www.youtube.com/watch?v=n-7K_OjsDCQ', NULL, NULL, NULL, NULL, '2015-12-16 00:00:00');
      ";

      $this->db->ExecuteQuery($sql);
    }

    public function getAllMovies()
    {
        $sql = "SELECT *, (created <= NOW()) AS available
        FROM science;";
        $res = $this->db->ExecuteSelectQueryAndFetchAll($sql);

        $items = null;
        foreach ($res AS $key => $val) {
            $items .= "<li>" . htmlentities($val->title, null, 'UTF-8') . " (" . (!$val->available ? 'inte ' : null) . "publicerad): <a href='updatemovie.php?id={$val->id}'>editera</a> <a href='deletemovie.php?id={$val->id}'>ta bort</a> <a href='movies.php?id={$val->id}'>visa</a>)</li>\n";
        }
        return $items;
    }

    public function getMovieById($id)
    {
        $sql = "SELECT * FROM science WHERE id = ?";
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


    public function createMovie()
    {

        $title = isset($_POST['title']) ? strip_tags($_POST['title']) : null;

        $slug = $this->slugify($title);

        $sql = "INSERT INTO science
            (title, created)
            VALUES (?, NOW())
        ";

        $params = array($title);

        $res = $this->db->ExecuteQuery($sql, $params);

        if ($res) {
            $output = "Artikeln skapades";
        }
        else {
            $output = "Något gick fel";
        }
        return $output;
    }

    public function updateMovieTable()
    {

        $id        = strip_tags($_POST['id']);
        $title     = strip_tags($_POST['title']);
        $text      = strip_tags($_POST['text']);
        $category     = strip_tags($_POST['category']);
        $image      = $this->fileUpload();
        $created = strip_tags($_POST['created']);

        $sql = "UPDATE science SET
        title = ?,
        text = ?,
        category = ?,
        image = ?,
        created = ?
        WHERE
        id = ?
        ";

        $url = empty($url) ? null : $url;
        $filter = empty($filter) ? 'link' : $filter;
        $params = array($title, $text, $category, $image, $created, $id);
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
    public function deleteMovie($id)
    {
        $sql = "DELETE FROM science
        WHERE id = ?";

        $params = array($id);
        $res = $this->db->ExecuteQuery($sql, $params);

        $output = null;

        if ($res) {
            $output = "Artikeln har raderats";
        }
        else {
            $output = "Något gick fel.";
        }

        return $output;
    }

    public function getDistinctGenre(){
        $sql = "SELECT DISTINCT genre FROM movie";

        $res = $this->db->ExecuteSelectQueryAndFetchAll($sql);

        $genre = "T.ex. ";
        foreach($res as $row) {
            $genre .= "{$row->genre} ";
        }

        return $genre;
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
