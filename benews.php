<?php
print '<?xml version="1.0"?>'
?>

<vxml version="1.0">
<meta name="maintainer" content="sean@benews.com"/>
<meta name="application" content="BeNews Voice Headlines"/>
<property name="bargein" value="false"/>
<property name="confidencelevel" value="70"/>
    <form>
        <block>
            <audio>Welcome to the Be News Super Duper Voice Headlines</audio>
            <pause>500</pause>
        </block>
    </form>

    <form>
        <block>
            <?php
                $filename = "http://www.benews.com/story/headlines/5/";

                $file = fopen($filename, "r");

                while (!feof($file)) {
                    $headlines .= fgets($file, 1024);
                }

                fclose($file);

                $stories = explode("\n", $headlines);
                $num_stories = 5*3;
            
                for( $i = 1; $i <= $num_stories; $i++ ) {
                    print "<audio>";
                    print htmlentities(trim( $stories[$i] ));
                    print "</audio>\n";
                    $i += 2;
                }
            ?>
        </block>
    </form>

    <form id="story_selection">
        <field name="what_story">
            <grammar>
                <![CDATA[
                    [
                        [dtmf-1 1 one ] {<option "one">}
                        [dtmf-2 2 two ] {<option "two">}
                        [dtmf-3 3 three ] {<option "three">}
                        [dtmf-4 4 four ] {<option "four">}
                        [dtmf-5 5 five ] {<option "five">}
                        [dtmf-0 0 exit done] {<option "exit">}
                    ]
                ]]>
            </grammar>    

            <prompt>
                <audio>
                    If you would like me to read you one of these
                    stories, say or dial a number between 1 and 5.  
                    Say or dial 0 to exit the system.
                </audio>
            </prompt>

            <nomatch>
                <audio>I'm sorry, I didn't understand you.</audio>
                <reprompt/>
            </nomatch>
                
            <noinput>
                <audio>I'm sorry, I didn't hear you.</audio>
                <reprompt/>
            </noinput>
        </field>

        <filled>
            <result name="one">
                <audio>you said one</audio>
                <reprompt/>
            </result>
            <result name="two">
                <audio>you said two</audio>
                <reprompt/>
            </result>
            <result name="three">
                <goto next="http://www.benews.com/~grahams/voice/story.php/3869.html"/>
                <reprompt/>
            </result>
            <result name="four">
                <audio>you said four</audio>
                <reprompt/>
            </result>
            <result name="five">
                <audio>you said five</audio>
                <reprompt/>
            </result>
            <result name="exit">
                <pause>500</pause>
                <audio>Thank you for Visiting Voice Bee News</audio>
                <pause>100</pause>
                <audio>Visit bee news dot com for more information.</audio>
                <audio>Goodbye.</audio>
                <disconnect/>
            </result>
        </filled>
    </form>

    <form>
        <block>
            <pause>500</pause>
            <audio>These Headlines are brought to you by Bee News</audio>
            <pause>100</pause>
            <audio>Visit bee news dot com for more information</audio>
        </block>
    </form>
</vxml>
