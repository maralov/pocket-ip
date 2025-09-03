<?php

    function the_excerpt_max_charlength( $charlength ){
		$excerpt = get_the_excerpt();
        $content = get_the_content();
		$charlength++;

        if(!empty($excerpt)) {
            if (mb_strlen($excerpt) > $charlength) {
                $subex = mb_substr($excerpt, 0, $charlength - 5);
                $exwords = explode(' ', $subex);
                $excut = -(mb_strlen($exwords[count($exwords) - 1]));
                if ($excut < 0) {
                    echo mb_substr($subex, 0, $excut);
                } else {
                    echo $subex;
                }
                echo '...';
            } else {
                echo $excerpt;
            }
        } else {
            if (mb_strlen($content) > $charlength) {
                $subco = mb_substr($content, 0, $charlength - 5);
                $cowords = explode(' ', $subco);
                $cocut = -(mb_strlen($cowords[count($cowords) - 1]));
                if (cocut < 0) {
                    echo mb_substr($subco, 0, $cocut);
                } else {
                    echo $subco;
                }
                echo '...';
            } else {
                echo $excerpt;
            }
        }
	}