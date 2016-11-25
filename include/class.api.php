<?php
////////////////////////////////////////////////////////////
// API Management Class
//
// Exmaple
//
//
//
//
////////////////////////////////////////////////////////////
require_once dirname(__file__)."/class.tvdb.php";
require_once dirname(__FILE__)."/class.fanart.php";

class api
{

    private $imdb;

    private $tvdb;

    private $infohash;

    private $tvdb_api_key;

    private $fanart_api_key;

    private $fanart_imdb_data;

    private $fanart_tvdb_data;

    private $tvdb_data;

    function __construct($tvdb_api, $fanart_api, $imdb = 0, $tvdb = 0, $infohash = "")
    {
        /*
        * This speak to the API identifiers
        */
        $this->imdb = $imdb;
        $this->tvdb = $tvdb;
        $this->infohash = $infohash;

        /*
        * This places the API keys within the class
        */
        $this->tvdb_api_key = $tvdb_api;
        $this->fanart_api_key = $fanart_api;

    }

    function setImageData()
    {
        global $THIS_BASEPATH;

        if($this->imdb > 0)
        {
            $this->fanart_imdb_data = new fanart("tt".$this->imdb , $this->fanart_api_key);

            if(getPosterData() == $GLOBALS["uploaddir"]."nocover.jpg")
            {
                if($this->fanart_imdb_data->fetch())
                {
                    $fposters = $this->fanart_imdb_data->getmovieposter();
                    $pcount = count($fposters);

                    if(!file_exists($THIS_BASEPATH."/images/fanart/imdb"))
                    mkdir($THIS_BASEPATH."/images/fanart/imdb");

                    if(!file_exists($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb))
                    mkdir($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb);

                    if(!file_exists($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/posters"))
                    mkdir($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/posters");

                    if($pcount > 0)
                    {
                        foreach($fposters as $files)
                        {
                            $imagefile = explode("/", $files);
                            $LastImageKey = (count($imagefile) - 1);

                            if(!file_exists($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/posters/".$imagefile[$LastImageKey]))
                            {
                                save_image($files, $THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/posters/".$imagefile[$LastImageKey]);
                            }
                        }
                    }
                }
                else
                {
                    // Error fetching Data from Fanart
                }
            }

            if(getBannerData() == "images/default_fanart.png")
            {
                if($this->fanart_imdb_data->isMoviesEmpty())
                {
                    if($this->fanart_imdb_data->fetch())
                    {
                        $fbanners = $this->fanart_imdb_data->getmoviebanner();
                        $bcount = count($fbanners);

                        if(!file_exists($THIS_BASEPATH."/images/fanart/imdb"))
                        mkdir($THIS_BASEPATH."/images/fanart/imdb");

                        if(!file_exists($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb))
                        mkdir($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb);

                        if(!file_exists($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/banners"))
                        mkdir($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/banners");

                        if($bcount > 0)
                        {
                            foreach($fbanners as $files)
                            {
                                $imagefile = explode("/", $files);
                                $LastImageKey = (count($imagefile) - 1);

                                if(!file_exists($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/banners/".$imagefile[$LastImageKey]))
                                {
                                    save_image($files, $THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/banners/".$imagefile[$LastImageKey]);
                                }
                            }
                        }
                    }
                    else
                    {
                        // Error fetching Data from Fanart
                    }
                }
                else
                {
                    $fbanners = $this->fanart_imdb_data->getmoviebanner();
                    $bcount = count($fbanners);

                    if(!file_exists($THIS_BASEPATH."/images/fanart/imdb"))
                    mkdir($THIS_BASEPATH."/images/fanart/imdb");

                    if(!file_exists($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb))
                    mkdir($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb);

                    if(!file_exists($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/banners"))
                    mkdir($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/banners");

                    if($bcount > 0)
                    {
                        foreach($fbanners as $files)
                        {
                            $imagefile = explode("/", $files);
                            $LastImageKey = (count($imagefile) - 1);

                            if(!file_exists($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/banners/".$imagefile[$LastImageKey]))
                            {
                                save_image($files, $THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/banners/".$imagefile[$LastImageKey]);
                            }
                        }
                    }
                }
            }

            if(count(getDiscArt()) != 0)
            {
                if($this->fanart_imdb_data->isMoviesEmpty())
                {
                    if($this->fanart_imdb_data->fetch())
                    {
                        $fcdart = $this->fanart_imdb_data->getmoviedisc();
                        $fcount = count($fcdart);

                        if(!file_exists($THIS_BASEPATH."/images/fanart/imdb"))
                        mkdir($THIS_BASEPATH."/images/fanart/imdb");

                        if(!file_exists($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb))
                        mkdir($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb);

                        if(!file_exists($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/discart"))
                        mkdir($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/discart");

                        if($fcount > 0)
                        {
                            foreach($fcdart as $files)
                            {
                                $imagefile = explode("/", $files);
                                $LastImageKey = (count($imagefile) - 1);

                                if(!file_exists($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/discart/".$imagefile[$LastImageKey]))
                                {
                                    save_image($files, $THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/discart/".$imagefile[$LastImageKey]);
                                }
                            }
                        }
                    }
                    else
                    {
                        // Error fetching Data from Fanart
                    }
                }
                else
                {
                    $fcdart = $this->fanart_imdb_data->getmoviedisc();
                    $fcount = count($fcdart);

                    if(!file_exists($THIS_BASEPATH."/images/fanart/imdb"))
                    mkdir($THIS_BASEPATH."/images/fanart/imdb");

                    if(!file_exists($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb))
                    mkdir($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb);

                    if(!file_exists($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/discart"))
                    mkdir($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/discart");

                    if($fcount > 0)
                    {
                        foreach($fcdart as $files)
                        {
                            $imagefile = explode("/", $files);
                            $LastImageKey = (count($imagefile) - 1);

                            if(!file_exists($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/discart/".$imagefile[$LastImageKey]))
                            {
                                save_image($files, $THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/discart/".$imagefile[$LastImageKey]);
                            }
                        }
                    }
                }
            }

            if(count(getBackground()) != 0)
            {
                if($this->fanart_imdb_data->isMoviesEmpty())
                {
                    if($this->fanart_imdb_data->fetch())
                    {
                        $fbackground = $this->fanart_imdb_data->getmoviebackground();
                        $bcount = count($fbackground);

                        if(!file_exists($THIS_BASEPATH."/images/fanart/imdb"))
                        mkdir($THIS_BASEPATH."/images/fanart/imdb");

                        if(!file_exists($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb))
                        mkdir($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb);

                        if(!file_exists($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/background"))
                        mkdir($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/background");

                        if($bcount > 0)
                        {
                            foreach($fbanners as $files)
                            {
                                $imagefile = explode("/", $files);
                                $LastImageKey = (count($imagefile) - 1);

                                if(!file_exists($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/background/".$imagefile[$LastImageKey]))
                                {
                                    save_image($files, $THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/background/".$imagefile[$LastImageKey]);
                                }
                            }
                        }
                    }
                    else
                    {
                        // Error fetching Data from Fanart
                    }
                }
                else
                {
                    $fbackground = $this->fanart_imdb_data->getmoviebackground();
                    $bcount = count($fbackground);

                    if(!file_exists($THIS_BASEPATH."/images/fanart/imdb"))
                    mkdir($THIS_BASEPATH."/images/fanart/imdb");

                    if(!file_exists($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb))
                    mkdir($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb);

                    if(!file_exists($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/background"))
                    mkdir($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/background");

                    if($bcount > 0)
                    {
                        foreach($fbanners as $files)
                        {
                            $imagefile = explode("/", $files);
                            $LastImageKey = (count($imagefile) - 1);

                            if(!file_exists($THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/background/".$imagefile[$LastImageKey]))
                            {
                                save_image($files, $THIS_BASEPATH."/images/fanart/imdb/".$this->imdb."/background/".$imagefile[$LastImageKey]);
                            }
                        }
                    }
                }
            }
        }

        if($this->tvdb > 0)
        {
            $this->fanart_tvdb_data = new fanart($this->tvdb , $this->fanart_api_key);
            $this->tvdb_data = new tvdb($this->tvdb , $this->tvdb_api_key);

            if(getBannerData() == "images/default_fanart.png")
            {
                if($this->fanart_tvdb_data->fetch(TRUE))
                {
                    $fbanners = $this->fanart_tvdb_data->gettvbanner();
                    $fcount = count($fbanners);

                    if(!file_exists($THIS_BASEPATH."/images/fanart/thetvdb"))
                        mkdir($THIS_BASEPATH."/images/fanart/thetvdb");

                    if(!file_exists($THIS_BASEPATH."/images/fanart/tvdb/".$this->tvdb))
                        mkdir($THIS_BASEPATH."/images/fanart/tvdb/".$this->tvdb);

                    if(!file_exists($THIS_BASEPATH."/images/fanart/tvdb/".$this->tvdb."/banners"))
                        mkdir($THIS_BASEPATH."/images/fanart/tvdb/".$this->tvdb."/banners");

                    if($fcount > 0)
                    {
                        foreach($fbanners as $files)
                        {
                            $imagefile = explode("/", $files);
                            $FileLastKey = (count($imagefile) - 1);

                            if(!file_exists($THIS_BASEPATH."/images/fanart/tvdb/".$this->tvdb."/banners/".$imagefile[$FileLastKey]))
                            {
                                save_image($files, $THIS_BASEPATH."/images/fanart/tvdb/".$this->tvdb."/banners/".$imagefile[$FileLastKey]);
                            }
                        }
                    }
                }
                else
                {
                    //Error fetch TVDB data from Fanart
                }


                if($this->tvdb_data->fetch(TRUE))
                {
                    $tbanners = $this->tvdb_data->get5banners();
                    $bcount = count($tbanners);

                    if(!file_exists($THIS_BASEPATH."/images/thetvdb"))
                        mkdir($THIS_BASEPATH."/images/thetvdb");

                    if(!file_exists($THIS_BASEPATH."/images/thetvdb/".$this->tvdb))
                        mkdir($THIS_BASEPATH."/images/thetvdb/".$this->tvdb);

                    if(!file_exists($THIS_BASEPATH."/images/thetvdb/".$this->tvdb."/banners"))
                        mkdir($THIS_BASEPATH."/images/thetvdb/".$this->tvdb."/banners");

                    if($bcount > 0)
                    {
                        foreach($tbanners as $files)
                        {
                            $imagefile = explode("/", $files);
                            $FileLastKey = (count($imagefile) - 1);

                            if(!file_exists($THIS_BASEPATH."/images/thetvdb/".$this->tvdb."/banners/".$imagefile[$FileLastKey]))
                            {
                                save_image($files, $THIS_BASEPATH."/images/thetvdb/".$this->tvdb."/banners/".$imagefile[$FileLastKey]);
                            }
                        }
                    }
                }
                else
                {
                    //Error Fetching data from TVDB
                }
            }

            if(getPosterData() == $GLOBALS["uploaddir"]."nocover.jpg")
            {

            }

            if(count(getBackground()) != 0)
            {

            }
        }
    }

    function getIMDB()
    {
        if($this->fanart_tvdb_data->isDataEmpty())
        {
            if($this->fanart_tvdb_data->fetch())
            {
                return (($this->fanart_tvdb_data->getimdb() > 0) ? $this->fanart_tvdb_data->getimdb() : 0);
            }
            else
            {
                //Error fetching data from TVDB
            }
        }
        else
        {
            return (($this->fanart_tvdb_data->getimdb() > 0) ? $this->fanart_tvdb_data->getimdb() : 0);
        }
    }

    function getPosterData()
    {
        global $THIS_BASEPATH;

        $posters = array();
        $poster = $GLOBALS["uploaddir"]."nocover.jpg";

        if($this->imdb > 0)
        {
            if(file_exists($THIS_BASEPATH."/images/fanart/imdb/tt".$this->imdb."/posters"))
            {
                foreach(glob($THIS_BASEPATH."/images/fanart/imdb/tt".$this->imdb."/posters/*.*") as $postersFile)
                {
                    $posters[] = str_replace($THIS_BASEPATH."/", "", $postersFile);
                }
            }
        }

        if($this->tvdb > 0)
        {
            if(file_exists($THIS_BASEPATH."/images/fanart/thetvdb/".$this->tvdb."/posters"))
            {
                foreach(glob($THIS_BASEPATH."/images/fanart/thetvdb/".$this->tvdb."/posters/*.*") as $postersFile)
                {
                    $posters[] = str_replace($THIS_BASEPATH."/", "", $postersFile);
                }
            }

            if()
            {

            }
        }

        if(strlen($this->infohash) >= 40)
        {
            if(file_exists($THIS_BASEPATH."/".$GLOBALS['uploaddir'].$this->infohash))
            {
                $poster = $GLOBALS['uploaddir'].$this->infohash;
            }
        }

        if(count($posters) > 0 && $this->infohash == '')
        {
            $rkey = mt_rand(0, (count($posters) - 1));
            $poster = $posters[$rkey];
        }

        unset($rkey);
        unset($posters);

        return $poster;
    }

    function getBannerData()
    {
        global $THIS_BASEPATH;

        $banners = array();
        $banner = "images/default_fanart.png";

        if($this->imdb > 0)
        {
            if(file_exists($THIS_BASEPATH."/images/fanart/imdb/tt".$this->imdb."/banners"))
            {
                foreach(glob($THIS_BASEPATH."/images/fanart/imdb/tt".$this->imdb."/banners/*.*") as $bannersFile)
                {
                    $banners[] = str_replace($THIS_BASEPATH."/", "", $bannersFile);
                }
            }
        }

        if($this->tvdb > 0)
        {
            if(file_exists($THIS_BASEPATH."/images/fanart/thetvdb/".$this->tvdb."/banners"))
            {
                foreach(glob($THIS_BASEPATH."/images/fanart/thetvdb/".$this->tvdb."/banners/*.*") as $bannersFile)
                {
                    $banners[] = str_replace($THIS_BASEPATH."/", "", $bannersFile);
                }
            }

            if(file_exists($THIS_BASEPATH."/images/thetvdb/".$this->tvdb."/banners"))
            {
                foreach(glob($THIS_BASEPATH."/images/thetvdb/".$this->tvdb."/banners/*.*") as $bannersFile)
                {
                    $banners[] = str_replace($THIS_BASEPATH."/", "", $bannersFile);
                }
            }
        }

        if(count($banners) > 0)
        {
            $rkey = mt_rand(0, (count($banners) - 1));
            $banner = $banners[$rkey];
        }

        unset($rkey);
        unset($banners);

        return $banner;
    }

    function getDiscArt()
    {
        $dArt = array();

        if($this->imdb > 0)
        {
            if(file_exists($THIS_BASEPATH."/images/fanart/imdb/tt".$this->imdb."/discArt"))
            {
                foreach(glob($THIS_BASEPATH."/images/fanart/imdb/tt".$this->imdb."/discArt/*.*") as $cdartfile)
                {
                    $dArt[] = str_replace($THIS_BASEPATH."/", "", $cdartfile);
                }
            }
        }

        return $dArt;
    }

    function getBackground()
    {
        $background = array();

        if($this->imdb > 0)
        {
            if(file_exists($THIS_BASEPATH."/images/fanart/imdb/tt".$this->imdb."/background"))
            {
                foreach(glob($THIS_BASEPATH."/images/fanart/imdb/tt".$this->imdb."/background/*.*") as $backfile)
                {
                    $background[] = str_replace($THIS_BASEPATH."/", "", $backfile);
                }
            }
        }

        return $background;
    }

}

?>
