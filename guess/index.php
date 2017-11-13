<?php
require_once('config.php');

$doc = new HTDoc('en-US', 'UTF-8');
$doc->doctype();
   
$GUESS = array("d" => "", "c" => "");

if(isset($_GET['guess_d']))
    $GUESS['d'] = intval($_GET['guess_d']);
if(isset($_GET['guess_c']))
    $GUESS['c'] = str_pad(substr($_GET['guess_c'], 0, 2), 2, "0", STR_PAD_RIGHT);
$score = score($DEBT['d'], $GUESS['d']) + score($DEBT['c'], $GUESS['c']);
$_SESSION['scores'][] = $score;
$percent = (100 * ($score / (strlen($DEBT['d']) + strlen($DEBT['c'])))) . "%";
?>
<head profile="http://www.w3.org/2003/g/data-view http://microformats.org/wiki/hcard-profile http://microformats.org/wiki/rel-license#XMDP_profile http://microformats.org/wiki/rel-tag">
    <title>Guess Our Debt!</title>
    <style type="text/css">
        html { background-color:#00ADCE; color:#FFFFFF; font-size:80%; 
        line-height:1.75; 
        letter-spacing:.05em;
            font-family:BienvenueBeta, Arial, Helvetica, sans-serif; }
        div { width:80%; background-color:#148CA5; color:#FFFFFF;
            margin:2em auto; padding:.5em 1em; 
            -moz-border-radius: 2em; -webkit-border-radius: 2em;}
        #guess { background-color:#7ACDDF; color:#FFFFFF; }
        a { font-weight:bold; text-decoration:none; }
        abbr, acronym { border:0; }
        a:link { color:#6AB753; }
        a:visited, a:active { color:#6AB753; }
        a:focus, a:hover { color:#FFFFFF; }
        fieldset { border:0; }
        label {font-size:2.5em; }
        input { background-color:#148CA5; color:#FFFFFF;
            -moz-border-radius: .5em; -webkit-border-radius: .5em;
            border:1px solid #148CA5;
            padding:.25em .5em; font-size:2em; }
        #guess_d { width:5em; text-align:right; letter-spacing:.2em; }
        #guess_c { width:1.5em; text-align:left; letter-spacing:.2em; }
        #submit { margin-left:3em; }
        
        
        #score {}
        #score span {position:relative; background-color:red; display:block; width:10em; padding:.25em 1em .25em .25em;
            -moz-border-radius: .5em; -webkit-border-radius: .5em;}
        #score em {background-color:green; display:block; width:<?= $percent ?>; height:100%; padding-left:1em; font-weight:bold; margin:0;
            -moz-border-radius: .5em; -webkit-border-radius: .5em;}
        
    </style>
</head>
<body>
    <div id="guess">
        <h1>Can you guess our debt?</h1>
        <form action="index.php" method="get">
            <fieldset>
                <label for="guess_d"> $ </label>
                <input type="text" id="guess_d" name="guess_d" value="<?= $GUESS['d'] ?>" maxlength="6"/>
                <label for="guess_c"> . </label>
                <input type="text" id="guess_c" name="guess_c" value="<?= $GUESS['c'] ?>" maxlength="2"/>
                <input type="submit" id="submit" value="Guess!"/>
            </fieldset>
        </form><h2><?= message($_SESSION['scores']) ?></h2>
        <p>
            <span id="score"><span><em title="<?= $percent ?>"><?= $percent ?></em></span></span>
        </p>
    </div>
    <div id="about">
        <h2>What's this all about?</h2>
        <p>
            <a href="http://mint.com">Mint.com</a>
            is having a <a href="http://contest.mint.com">contest</a>
            to help pay down holiday expenses. As part of my entry, I've created this website as a game to see who can guess our debt! After you've guessed our debt (or given up because you can't count that high!), head over to <a href="http://mint.com">Mint.com</a>
            and vote for our video! If we win, we'll have less debt! (and we can all agree, that's a good thing!)
        </p>
    </div>
    <div id="hints">
        <h2>Hints</h2>
        <ol>
            <li>
                <p>
                    <span class="vevent">I was <abbr class="summary" title="wedding">married</abbr> to Amy, my beautiful wife of <?= married() ?>, on <abbr id="wedding" class="dtstart" title="2007-10-06T16:30:00-0500">October 6, 2007</abbr>.</span>
                    <br/><span class="vevent">We took a <span class="duration">week</span>-long <span class="summary">honeymoon</span> at <span class="adr location"><abbr class="geo" title="32.194377;-80.745232"><span class="locality">Hilton Head Island</span>, <span class="region">South Carolina</span></abbr></span>.<a class="include" href="#wedding" title="Wedding: 10/06/07"></a></span>
                    <br/>She has an engagement ring, diamond wedding band, diamond/pearl earring and necklace (bride's gift) all financed.
                </p>
            </li>
            <li>
                <p>
                    She drives a 2007 Pontiac G5. I drive a 2002 Acura TL.
                </p>
            </li>
            <li>
                <p>
                    She went to <span class="vcard"><a class="url" href="http://onu.edu"><abbr class="fn org" title="Ohio Northern University">Ohio Northern</abbr></a></span> for two years, and then <span class="vcard"><a class="url" href="http://wright.edu"><abbr class="fn org" title="Wright State University">Wright State</abbr></a></span> for two years. I went to <span class="vcard"><a class="fn org url" href="http://osu.edu">The Ohio State University</a></span> for five years. We both graduated in 2007; student loans baby!
                </p>
            </li>
            <li>
                <p>
                    And of course, credit cards.
                </p>
            </li>
        </ol>
    </div>
    <div id="mint">
        <h2>What is Mint?</h2>
        <p>
            <a href="http://mint.com">Mint.com</a>
            is the easy and intelligent way to manage your money online … and it’s free! Sign up today and in minutes you’ll see where your money really goes, get savings ideas and set up email or SMS text alerts about upcoming bills, bank fees, and more.
        </p>
    </div>
</body>
</html>
