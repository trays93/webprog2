<div class="jumbotron text-center">
  <h1>Fórum</h1>
  <h4>Bejelentkezett felhasználóinknak véleményezési lehetőség.<br>Ha van bármi nemű új híre, csak küldje el nekünk.</h4> 
</div>
  
<div class="container">
  <div class="row" style="margin: 20px 0px;">
    <div class="col-sm-10">
      <form action="/beadando/news" method="post">
        <label for="comment" class="form-label"><h5>Írja be véleményét:</h5></label><br>
        <textarea class="form-control" type="text" id="comment" name="comment" maxlength="255" minlength="2" required rows="10" cols="30" style="height: 200px; resize: none;"></textarea>
    </div>
    <div class="col-sm-2">
        <br>
        <input class="button button-more" type="submit" name="news" value="Küldés">
    </div>
    <?php
        if(isset($data)) { 
            if(array_key_exists('data',$data))
            {
                $message = $data['data'];
                unset($data['data']);
                ?><div class="row" style="margin: 20px 0px; border: solid 1px; border-radius: 5px; background-color: #e9ecef; border-color: rgb(100, 100, 100);">
                    <div class="col-sm-12"><?php foreach($message as $m) { ?><h5 style="text-align:left; padding: 20px 0px;"><?= $m ?></h5><?php } ?></div>
                </div> <?php
            }
            foreach ($data as $d) {
                if($d != null) {?>
                        <div class="row" style="margin: 20px 0px; border: solid 1px; border-radius: 5px; background-color: #e9ecef; border-color: rgb(100, 100, 100);">
                            <div class="col-sm-12"><h5 style="text-align:left; padding: 20px 0px;"><?= $d->getComment() ?></h5></div>
                            <div class="row">
                                <div class="col-sm-6"><h6 style="text-align:left;"><?= $d->getUserName() ?></h6></div>
                                <div class="col-sm-6"><h6 style="text-align:right;"><?= $d->getDate()->format('Y.m.d H:i') ?></h6></div>
                            </div>
                        </div>
                    <?php
                    }
                } 
                
        } ?>
  </div>
</div>

