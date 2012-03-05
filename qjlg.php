<?php
print '<?xml version="1.0"?>'
?>

<vxml version="1.0">
<meta name="maintainer" content="grahams+vxml@csh.rit.edu"/>
<meta name="application" content="The Quotable JLG"/>
<property name="bargein" value="false"/>
<property name="confidencelevel" value="0.45"/>
    <form>
        <block>
            <audio>Welcome to the Quotable J L G</audio>
            <pause>500</pause>
        </block>
    </form>

    <form>
        <block>
            <audio><?php
                $filename = "qjlg.txt";

                if (is_readable($filename)) {
                    $file = fopen($filename, "r");

                    while (!feof($file)) {
                        $sig .= fgets($file, 1024);
                    }

                    fclose($file);
                } 
                else {
                    echo ("Signature file not found.");
                    exit;
                }

                $quotes = explode("%%", $sig);
                $num_quotes = count( $quotes );

                mt_srand ((double) microtime() * 1000000);
                $index = mt_rand(0,$num_quotes-1);

                print trim($quotes[$index]);
            ?></audio>
        </block>
    </form>

    <form>
        <block>
            <pause>500</pause>
            <audio>The Quotable J L G is brought to you by Bee Groovy</audio>
            <pause>100</pause>
            <audio>Visit q j l g dot bee groovy dot com for more 
                   information</audio>
        </block>
    </form>
</vxml>
