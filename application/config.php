<?php

/**
 * Dicfro
 *
 * PHP 5
 *
 * @category  DicFro
 * @package   Config
 * @author    Michel Corne <mcorne@yahoo.com>
 * @copyright 2008-2013 Michel Corne
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

/**
 * Application configuration file
 */

// sets domain subpath
// dicfro domain subpath autodetection, default is none
$domainSubpath = (isset($_SERVER['REQUEST_URI']) and strpos($_SERVER['REQUEST_URI'], '/dicfro') === 0)? 'dicfro' : '';
// $domainSubpath = '';    // installation with no domain subpath, eg local installation
// $domainSubpath = 'xyz'; // installation with "xyz" domain subpath

$applicationDir = dirname(__FILE__); // global variable used by scripts

return array(
    // data directory containing indexes and databases
    'data-dir' => realpath("$applicationDir/data"),

    // dictionaries details
    'dictionaries' => array(
        'anglo-norman' => array(
            'description'  => 'The Anglo-Norman Dictionary',
            'introduction' => 'http://www.anglo-norman.net',
            'language'     => 'fr',
            'name'         => 'Anglo-Norman',
            'search'       => 'http://www.anglo-norman.net/cgi-bin/form-s1?term1=',
            'title'        => 'AND',
            'type'         => 'external',
        ),

        'chretien' => array(
            'description' => "Dictionnaire de l'oeuvre de Chrétien de Troyes, Wörterbuch zu Kristian von Troyes' sämtlichen Werken, Wendelin Foerster, 1914",
            'file'        => 'dictionnaire-chretien-de-troyes.jpg',
            'language'    => 'fr',
            'name'        => 'Chrétien de Troyes',
            'parser'      => array(
                'class'      => 'Model_Parser_GaffiotLike',
                'properties' => array(
                    'lineTpl'    => '~^(.+?)__BR____BR__<@_(\d+).tif_>FoersterEdic__BR____BR__~',
                )
            ),
            'search'      => array(
                'properties' => array(
                    'needTcaf'   => true,
                    'needTobler' => true,
                )
            ),
            'title'       => 'Chrétien',
            'type'        => 'internal',
            'url'         => 'glossaire-chretien-de-troyes',
        ),

        'cnrtl' => array(
            'description'  => 'Dictionnaire du Centre National de Ressources Textuelles et Lexicales',
            'introduction' => 'http://www.cnrtl.fr/definition/',
            'language'     => 'fr',
            'name'         => 'CNRTL',
            'search'       => 'http://www.cnrtl.fr/definition/',
            'type'         => 'external',
        ),

        'cotgrave' => array(
            'description'  => 'A Dictionarie of the French and English Tongues, Randle Cotgrave, 1611',
            'introduction' => 'http://www.pbm.com/~lindahl/cotgrave/',
            'language'     => 'fr',
            'name'         => 'Cotgrave',
            'search'       => array(
                'class' => 'Model_Search_Cotgrave',
                'properties' => array(
                    'url' => 'http://www.pbm.com/~lindahl/cotgrave/search/search_backend.cgi?query=',
                ),
            ),
            'type'         => 'external',
        ),

        'couronnement' => array(
            'description' => 'Glossaire du Couronnement de Louis, Ernest Langlois, 1888',
            'file'        => 'glossaire-couronnement-de-louis.jpg',
            'language'    => 'fr',
            'name'        => 'Couronnement de Louis',
            'parser'      => array(
                'class'      => 'Model_Parser_GaffiotLike',
                'properties' => array(
                    'imageNumberTpl' => '0000%s',
                    'lineTpl'        => '~^(.+?)__BR____BR__<@_tx(\d+).tif_>EGlos_CourLouisL1__BR____BR__~',
                )
            ),
            'search'      => array(
                'properties' => array(
                    'needTcaf'   => true,
                    'needTobler' => true,
                )
            ),
            'title'       => 'Couronnement',
            'type'        => 'internal',
            'url'         => 'glossaire-couronnement-de-louis',
        ),

        'dmf' => array(
            'description'  => "Dictionnaire du Moyen Français par l'Atilf",
            'introduction' => 'http://www.atilf.fr/dmf/',
            'language'     => 'fr',
            'name'         => 'Moyen français',
            'search'       => 'http://www.atilf.fr/dmf/definition/',
            'title'        => 'DMF',
            'type'         => 'external',
        ),

        'encyclopedie-larousse' => array(
            'description'  => "La Grande encyclopédie Larousse, 1971-1976",
            'introduction' => 'http://gallica.bnf.fr/ark:/12148/bpt6k1200512k/f1.image',
            'language'     => 'fr',
            'name'         => 'Encyclopédie Larousse (Aa-Am)',
            'search'      => array(
                'properties' => array(
                    'entries' => true,
                    'url'     => array(
                        1 => 'http://gallica.bnf.fr/ark:/12148/bpt6k1200512k/f%u.highres',
                    ),
                )
            ),
            'title'        => 'E. Larousse',
            'type'         => 'index',
            'volume'       => 'readonly',
        ),

        'ducange' => array(
            'description'  => 'Du Cange, et al., Glossarium mediæ et infimæ latinitatis. Niort : L. Favre, 1883-1887',
            'introduction' => 'http://ducange.enc.sorbonne.fr/',
            'language'     => 'la',
            'name'         => 'Du Cange',
            'search'       => 'http://ducange.enc.sorbonne.fr/',
            'title'         => 'Du Cange',
            'type'         => 'external',
        ),

        'dvlf' => array(
            'description'  => "Dictionnaire vivant de la langue française du projet ARTFL",
            'introduction' => 'http://dvlf.uchicago.edu/',
            'language'     => 'fr',
            'name'         => 'DVLF',
            'search'       => 'http://dvlf.uchicago.edu/mot/',
            'type'         => 'external',
        ),

        'gaffiot' => array(
            'description' => 'Dictionnaire Latin-Français, Félix Gaffiot, 1934',
            'file'        => 'gaffiot.jpg',
            'language'    => 'la',
            'name'        => 'Gaffiot',
            'parser'      => array(
                'class'      => 'Model_Parser_GaffiotLike',
                'properties' => array(
                    'endWord' => '_abréviations',
                    'lineTpl' => '~^(.+?)__BR____BR__<@_tx(\d+).tif_>GaffiotEdic__BR____BR__~',
                )
            ),
            'search'      => array(
                'properties' => array(
                    'needWhitaker' => true,
                ),
            ),
            'type'        => 'internal',
        ),

        'gdf' => array(
            'description' => "Dictionnaire de l'ancienne langue française et de tous ses dialectes du IXème au XVème siècle, Frédéric Godefroy, 1880-1895",
            'file'        => 'dictionnaire-godefroy.jpg',
            'language'    => 'fr',
            'name'        => 'Godefroy - Dictionnaire',
            'parser'      => 'Model_Parser_GdfLike',
            'search'      => array(
                'properties' => array(
                    'errataFiles'      => 'dictionary/gdf/mPimg-3/%s-%s[a-z]*/*.gif',
                    'imagePath'        => 'dictionary/gdf/mImg/%s.gif',
                    'needErrataImages' => true,
                    'needGhostwords'   => true,
                    'needTcaf'         => true,
                    'needTobler'       => true,
                )
            ),
            'title'       => 'D. Godefroy',
            'type'        => 'internal',
            'url'         => 'dictionnaire-godefroy',
            'volume'      => 'input',
        ),

        'gdfc' => array(
            'description' => "Complément du dictionnaire de l'ancienne langue française et de tous ses dialectes du IXème au XVème siècle, Frédéric Godefroy, 1895-1902",
            'file'        => 'complement-godefroy.jpg',
            'language'    => 'fr',
            'name'        => 'Godefroy - Complément',
            'parser'      => 'Model_Parser_GdfLike',
            'search'      => array(
                'properties' => array(
                    'digit'            => 1,
                    'errataFiles'      => 'dictionary/gdfc/mPimg-3/%s-%s[a-z]*/*.gif',
                    'imagePath'        => 'dictionary/gdfc/mImg/%s.gif',
                    'needErrataImages' => true,
                    'needGhostwords'   => true,
                    'needTcaf'         => true,
                    'needTobler'       => true,
                )
            ),
            'title'       => 'C. Godefroy',
            'type'        => 'internal',
            'url'         => 'complement-godefroy',
            'volume'      => 'input',
        ),

        'gdflex' => array(
            'description' => "Lexique de l'ancien français, Frédéric Godefroy, 1901",
            'file'        => 'lexique-godefroy.jpg',
            'language'    => 'fr',
            'name'        => 'Godefroy - Lexique',
            'search'      => array(
                'properties' => array(
                    'needErrataText' => true,
                    'needGhostwords' => true,
                    'needTcaf'       => true,
                    'needTobler'     => true,
                )
            ),
            'title'       => 'L. Godefroy',
            'type'        => 'internal',
            'url'         => 'lexique-godefroy',
        ),

        'jeanneau' => array(
            'description'  => 'Dictionnaire français-latin de Gérard Jeanneau',
            'introduction' => 'http://www.prima-elementa.fr/Dico.htm',
            'language'     => 'la',
            'name'         => 'Jeanneau',
            'search'       => array(
                'class' => 'Model_Search_Jeanneau',
                'properties' => array(
                    'url' => 'http://www.prima-elementa.fr/',
                ),
            ),
            'type'         => 'external',
        ),

        'lacurne' => array(
            'description' => "Dictionnaire historique de l'ancien langage françois ou Glossaire de la langue françoise, J.B. de la Curne de Sainte-Palaye, 1875-1882",
            'file'        => 'dictionnaire-lacurne.jpg',
            'language'    => 'fr',
            'name'        => 'Lacurne - Dictionnaire',
            'search'      => array(
                'properties' => array(
                    'needTcaf'   => true,
                    'needTobler' => true,
                )
            ),
            'title'       => 'D. Lacurne',
            'type'        => 'internal',
            'url'         => 'dictionnaire-lacurne',
            'volume'      => 'input',
        ),

        'leconjugueur' => array(
            'description'  => 'La conjugaison française par le Conjugueur',
            'introduction' => 'http://www.leconjugueur.com/',
            'language'     => 'fr',
            'name'         => 'Le conjugueur',
            'search'       => array(
                'properties' => array(
                    'convert' => 'utf8toASCII',
                    'url'     => 'http://www.leconjugueur.com/php5/index.php?v=',
                ),
            ),
            'type'         => 'external',
        ),

        'lexromv' => array(
            'description'  => "Lexique Roman ou dictionnaire de la langue des troubadours comparée avec les autres langues de l'Europe latine, François J. M. Raynouard, 1844",
            'file'         => 'lexique-roman.jpg',
            'introduction' => 'roman.phtml',
            'language'     => 'fr',
            'name'         => 'Lexique Roman',
            'search'      => array(
                'class' => 'Model_Search_Lexromv',
            ),
            'title'        => 'L. Roman',
            'type'         => 'internal',
            'url'          => 'lexique-roman',
        ),

        'littre' => array(
            'description'  => "Dictionnaire de la langue française d'Émile Littré, 1872-1877",
            'introduction' => 'http://francois.gannaz.free.fr/Littre/',
            'language'     => 'fr',
            'name'         => 'Littré',
            'search'       => 'http://littre.reverso.net/dictionnaire-francais/definition/',
            'type'         => 'external',
        ),

        'petit-larousse' => array(
            'description'  => "Petit Larousse illustré, nouveau dictionnaire encyclopédique (5e édition), publié sous la direction de Claude Augé, 1906",
            'introduction' => 'http://archive.org/stream/PetitLarousse19061/larousse_petit_1906_a#page/n7/mode/2up',
            'language'     => 'fr',
            'name'         => 'Petit Larousse',
            'search'       => array(
                'properties' => array(
                    'url'     => array(
                        1 => 'http://ia700503.us.archive.org/BookReader/BookReaderImages.php?zip=/8/items/PetitLarousse19061/larousse_petit_1906_a_jp2.zip&file=larousse_petit_1906_a_jp2/larousse_petit_1906_a_0%03u.jp2&scale=3&rotate=0',
                        2 => 'http://ia700507.us.archive.org/BookReader/BookReaderImages.php?zip=/6/items/PetitLarousse19062/larousse_petit_1906_b_jp2.zip&file=larousse_petit_1906_b_jp2/larousse_petit_1906_b_0%03u.jp2&scale=3&rotate=0',
                        3 => 'http://ia600503.us.archive.org/BookReader/BookReaderImages.php?zip=/22/items/PetitLarousse19063/larousse_petit_1906_c_jp2.zip&file=larousse_petit_1906_c_jp2/larousse_petit_1906_c_0%03u.jp2&scale=3&rotate=0',
                        4 => 'http://ia700507.us.archive.org/BookReader/BookReaderImages.php?zip=/5/items/PetitLarousse19064/larousse_petit_1906_d_jp2.zip&file=larousse_petit_1906_d_jp2/larousse_petit_1906_d_0%03u.jp2&scale=3&rotate=0',
                    ),
                )
            ),
            'title'        => 'P. Larousse',
            'type'         => 'index',
            'volume'       => 'readonly',
        ),

        'renart-fhs' => array(
            'description' => 'Glossaire du Roman de Renart, N. Fukumoto, N. Harano et S. Suzuki, 1985',
            'file'        => 'glossaire-roman-de-renart-fhs.jpg',
            'language'    => 'fr',
            'name'        => 'Roman de Renart / FHS',
            'parser'      => array(
                'class'      => 'Model_Parser_GaffiotLike',
                'properties' => array(
                    'imageNumberTpl' => '0000%s',
                    'lineTpl'        => '~^(.+?);(\d+)~',
                )
            ),
            'search'      => array(
                'properties' => array(
                    'needTcaf'   => true,
                    'needTobler' => true,
                )
            ),
            'title'       => 'Renart',
            'type'        => 'internal',
            'url'         => 'glossaire-roman-de-renart-fhs',
        ),

        'renart-meon-1' => array(
            'description' => 'Glossaire du Roman de Renart, volume 1, M. D. M. Méon, 1826',
            'file'        => 'glossaire-roman-de-renart-meon-vol1.jpg',
            'language'    => 'fr',
            'name'        => 'Roman de Renart / Méon v.1',
            'parser'      => array(
                'class'      => 'Model_Parser_GaffiotLike',
                'properties' => array(
                    'imageNumberTpl' => '0000%s',
                    'lineTpl'        => '~^(.+?);(\d+)~',
                )
            ),
            'search'      => array(
                'properties' => array(
                    'needTcaf'   => true,
                    'needTobler' => true,
                )
            ),
            'title'       => 'Méon 1',
            'type'        => 'internal',
            'url'         => 'glossaire-roman-de-renart-meon-vol1',
        ),

        'renart-meon-2' => array(
            'description' => 'Glossaire du Roman de Renart, volume 2, M. D. M. Méon, 1826',
            'file'        => 'glossaire-roman-de-renart-meon-vol2.jpg',
            'language'    => 'fr',
            'name'        => 'Roman de Renart / Méon v.2',
            'parser'      => array(
                'class'      => 'Model_Parser_GaffiotLike',
                'properties' => array(
                    'imageNumberTpl' => '0000%s',
                    'lineTpl'        => '~^(.+?);(\d+)~',
                )
            ),
            'search'      => array(
                'properties' => array(
                    'needTcaf'   => true,
                    'needTobler' => true,
                )
            ),
            'title'       => 'Méon 2',
            'type'        => 'internal',
            'url'         => 'glossaire-roman-de-renart-meon-vol2',
        ),

        'renart-meon-3' => array(
            'description' => 'Glossaire du Roman de Renart, volume 3, M. D. M. Méon, 1826',
            'file'        => 'glossaire-roman-de-renart-meon-vol3.jpg',
            'language'    => 'fr',
            'name'        => 'Roman de Renart / Méon v.3',
            'parser'      => array(
                'class'      => 'Model_Parser_GaffiotLike',
                'properties' => array(
                    'imageNumberTpl' => '0000%s',
                    'lineTpl'        => '~^(.+?);(\d+)~',
                )
            ),
            'search'      => array(
                'properties' => array(
                    'needTcaf'   => true,
                    'needTobler' => true,
                )
            ),
            'title'       => 'Méon 3',
            'type'        => 'internal',
            'url'         => 'glossaire-roman-de-renart-meon-vol3',
        ),

        'renart-meon-4' => array(
            'description' => 'Glossaire du Roman de Renart, volume 4, M. D. M. Méon, 1826',
            'file'        => 'glossaire-roman-de-renart-meon-vol4.jpg',
            'language'    => 'fr',
            'name'        => 'Roman de Renart / Méon v.4',
            'parser'      => array(
                'class'      => 'Model_Parser_GaffiotLike',
                'properties' => array(
                    'imageNumberTpl' => '0000%s',
                    'lineTpl'        => '~^(.+?);(\d+)~',
                )
            ),
            'search'      => array(
                'properties' => array(
                    'needTcaf'   => true,
                    'needTobler' => true,
                )
            ),
            'title'       => 'Méon 4',
            'type'        => 'internal',
            'url'         => 'glossaire-roman-de-renart-meon-vol4',
        ),

        'roland' => array(
            'description' => 'Glossaire de la Chanson de Roland, Joseph Bédier, 1927',
            'file'        => 'glossaire-chanson-de-roland.jpg',
            'language'    => 'fr',
            'name'        => 'Chanson de Roland',
            'parser'      => array(
                'class'      => 'Model_Parser_GaffiotLike',
                'properties' => array(
                    'imageNumberTpl' => '0000%s',
                    'lineTpl'        => '~^(.+?)__BR____BR__<@_tx(\d+).tif_>EGlos_RolB__BR____BR__~',
                )
            ),
            'search'      => array(
                'properties' => array(
                    'needTcaf'   => true,
                    'needTobler' => true,
                )
            ),
            'title'       => 'Roland',
            'type'        => 'internal',
            'url'         => 'glossaire-chanson-de-roland',
        ),

        'rose' => array(
            'description' => 'Glossaire du Roman de la Rose, Ernest Langlois, 1914-1924',
            'file'        => 'glossaire-roman-de-la-rose.jpg',
            'language'    => 'fr',
            'name'        => 'Roman de la Rose',
            'parser'      => array(
                'class'      => 'Model_Parser_GaffiotLike',
                'properties' => array(
                    'imageNumberTpl' => '0000%s',
                    'lineTpl'        => '~^(.+?)__BR____BR__<@_hm(\d+).tif_>EGlos_RoseLLangl__BR____BR__~',
                )
            ),
            'search'      => array(
                'properties' => array(
                    'needTcaf'   => true,
                    'needTobler' => true,
                )
            ),
            'title'       => 'Rose',
            'type'        => 'internal',
            'url'         => 'glossaire-roman-de-la-rose',
        ),

        'tcaf' => array(
            'description' => "Tableaux de conjugaison de l'ancien français, Machio Okada et Hitoshi Ogurisu, 2007-2011",
            'file'        => 'tableaux-de-conjugaison.jpg',
            'language'    => 'fr',
            'name'        => 'TCAF',
            'search'      => array(
                'class' => 'Model_Search_Tcaf',
            ),
            'title'       => 'Conjugaisons',
            'type'        => 'internal',
            'url'         => 'tableaux-de-conjugaison',
        ),

        'tristan' => array(
            'description' => 'Glossaire du Roman de Tristan par Béroul, Ernest Muret, 1903',
            'file'        => 'glossaire-roman-de-tristan.jpg',
            'language'    => 'fr',
            'name'        => 'Roman de Tristan',
            'parser'      => array(
                'class'      => 'Model_Parser_GaffiotLike',
                'properties' => array(
                    'endWord' => '_Glossaire',
                    'lineTpl' => '~^(.+?)__BR____BR__<@_tx(\d+).tif_>EGlos_TristBerM1__BR____BR__~',
                )
            ),
            'search'      => array(
                'properties' => array(
                    'needTcaf'   => true,
                    'needTobler' => true,
                )
            ),
            'title'       => 'Tristan',
            'type'        => 'internal',
            'url'         => 'glossaire-roman-de-tristan',
        ),

        'vandaele' => array(
            'description' => "Petit dictionnaire de l'ancien français, Hilaire Van Daele, 1901",
            'file'        => 'vandaele.jpg',
            'language'    => 'fr',
            'name'        => 'Van Daele',
            'search'      => array(
                'properties' => array(
                    'needGhostwords' => true,
                    'needTcaf'       => true,
                    'needTobler'     => true,
                )
            ),
            'type'        => 'internal',
        ),

        'whitaker' => array(
            'description'  => 'Dictionnaire latin-anglais de William Whitaker',
            'introduction' => 'http://lysy2.archives.nd.edu/cgi-bin/words.exe',
            'language'     => 'la',
            'name'         => 'Whitaker',
            'search'       => array(
                'properties' => array(
                    'convert' => 'utf8toASCII',
                    'url'     => 'http://lysy2.archives.nd.edu/cgi-bin/words.exe?',
                ),
            ),
            'type'         => 'external',
        ),

        'webster' => array(
            'description'  => "Webster's Revised Unabridged Dictionary (1913, 1828) of the ARTFL project",
            'introduction' => 'http://machaut.uchicago.edu/websters',
            'language'     => 'en',
            'name'         => 'Webster',
            'search'       => 'http://machaut.uchicago.edu/?action=search&resource=Webster%27s&quicksearch=on&word=',
            'type'         => 'external',
        ),

        'wiktionary' => array(
            'description'  => 'Wiktionnaire, le dictionnaire libre by wiktionary.org',
            'introduction' => 'http://en.wiktionary.org',
            'language'     => 'en',
            'name'         => 'Wiktionary',
            'search'       => 'http://en.wiktionary.org/wiki/',
            'type'         => 'external',
        ),

        'wiktionnaire' => array(
            'description'  => 'Wiktionary, the free dictionary de wiktionary.org',
            'introduction' => 'http://fr.wiktionary.org',
            'language'     => 'fr',
            'name'         => 'Wiktionnaire',
            'search'       => 'http://fr.wiktionary.org/wiki/',
            'type'         => 'external',
        ),
    ),

    // domain subpath set in .htaccess, ex. "dicfro" from "www.micmap.org/dicfro"
    'domain-subpath' => $domainSubpath,

    // dictionary groups, displayed as they are ordered below in the home page and select box
    'groups' => array(
        array(
            'name' => 'English',
            'dictionaries' => array(
                'webster',
                'wiktionary',
            ),
        ),
        array(
            'name' => 'Français',
            'dictionaries' => array(
                'cnrtl',
                'encyclopedie-larousse',
                'leconjugueur',
                'littre',
                'dmf',
                'dvlf',
                'petit-larousse',
                'wiktionnaire',
            ),
        ),
        array(
            'name' => 'Français (ancien)',
            'dictionaries' => array(
                'anglo-norman',
                'roland',
                'chretien',
                'cotgrave',
                'couronnement',
                'gdf',
                'gdfc',
                'gdflex',
                'lacurne',
                'lexromv',
                'rose',
                'renart-fhs',
                'renart-meon-1',
                'renart-meon-2',
                'renart-meon-3',
                'renart-meon-4',
                'tristan',
                'tcaf',
                'vandaele',
            ),
        ),
        array(
            'name' => 'Latin',
            'dictionaries' => array(
                'ducange',
                'gaffiot',
                'jeanneau',
                'whitaker',
            ),
        ),
    ),

    // HTML content directory
    'views-dir' => realpath("$applicationDir/View/scripts"),
);