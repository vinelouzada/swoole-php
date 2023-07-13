<?php

\Co\run(function (){
    go(function (){
        Co::sleep(2);
        echo 'Vinicius' . PHP_EOL;
    });

    go(function (){
       Co::sleep(1);
       echo 'Louzada' . PHP_EOL;
    });
});