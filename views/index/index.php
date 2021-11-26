    <div id="title" class="col-12 d-flex justify-content-center">
        <h2>Üdvözöljük a BáZol Kft. weboldalán!</h2>
    </div>

<?php
    $counter = 0;
    $content = ["Vállaltunk magas szintű tevékenységet folytat sok, szerteágazó területen, 
                melynek eredményei jelen vannak az iparban, a tudományban, de még a hétköznapokban is. 
                Kutatóink és fejlesztőink elismertek a nagyvilágban, 
                számos nagy sikeres eredményt vélhetnek magukénak.",
                'Tevékenységi köreinek megértéséhez magas szintű mérnöki tudás szükségeltetik, 
                de említés szintén párat megemlítenénk: <br><ul>
                <li>Izotópos bogárlábnyom-kereső szoftver és hardver fejlesztése.</li>
                <li>Diétás laktóz.- és gluténmentes dihidrogén-monoxid képzéséhez szükséges paraméterek meghatározása.</li>
                <li>Sakkminta hatása a hétköznapok terén.</li></ul>
                Ez csak pár projekt, a sok közül, melyeket most is kutatnak dolgozóink.',
                'Fontos küldetés tudatunk még, hogy segítsünk Frodónak, hogy sikerrel járjon, 
                ne engedve Sauron térhódításának az informatika területén.'
            ];

    foreach($content as $c) { ?>
        <div id="content" class="col-12">
            <h6><?= $content[$counter] ?></h6>
        </div>
        <?php if(file_exists(SERVER_ROOT.'images/'.$filename.'/'.$counter.'.jpg')) { ?>
            <div id="img" class="col-12 d-flex justify-content-center">
                    <img class="img-fluid" alt="Responsive image" 
                        src="<?='images/'.$filename.'/'.$counter.'.jpg'?>">
            </div>
        <?php } 
        if(file_exists(SERVER_ROOT.'images/'.$filename.'/'.$counter.'.gif')) { 
            ?>
            <div id="img" class="col-12 d-flex justify-content-center">
                <img class="img-fluid" alt="Responsive image" 
                    src="<?='images/'.$filename.'/'.$counter.'.gif'?>">
            </div>
<?php } $counter++;
    }?>
