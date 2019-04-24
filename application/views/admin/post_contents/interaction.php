<style>
    /*-=-=-=-=-=-=-=-=-=-=-=- */
    /* Column Grids */
    /*-=-=-=-=-=-=-=-=-=-=-=- */
    .over{
  margin-left: auto;
  margin-right: auto;
  display: block;
    }
    
    .col_half {
        width: 49%;
    }

    .col_third {
        width: 32%;
        
    }

    .col_fourth {
        width: 14%;
        
    }

    .col_fifth {
        width: 15.4%;
    }

    .col_sixth {
        width: 15%;
    }

    .col_three_fourth {
        width: 74.5%;
    }

    .col_twothird {
        width: 66%;
    }

    .col_half,
    .col_third,
    .col_twothird,
    .col_fourth,
    .col_three_fourth,
    .col_fifth {
        position: relative;
        display: inline;
        display: inline-block;
        float: left;
        margin-right: 2%;
        margin-bottom: 20px;
    }

    .end {
        margin-right: 0 !important;
    }

    /* Column Grids End */

    .wrapper {
        width: 980px;
        margin: 30px auto;
        position: relative;
    }

    .counter {
        background-color: #DEEEF3;
        padding-bottom: 10px;
        border-radius: 5px;
    }

    .count-title {
        font-size: 20px;
        font-weight: normal;
        margin-bottom: 0;
        text-align: center;
    }

    .count-text {
        font-size: 13px;
        font-weight: normal;
        margin-top: 10px;
        margin-bottom: 0;
        text-align: center;
    }

    .fa-2x {
        margin: 0 auto;
        float: none;
        display: table;
        color: #4ad1e5;
    }
</style>
<div class="panel_s">
    <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="bold no-margin"><?php echo _l('contentoverview') ?></h4>
                    </div>
                    <div class="col-md-7">
                        <div class="wrapper">
                            <div class="counter col_fourth">
                                <img class="over" src="<?php echo APP_BASE_URL.'/uploads/icon_facebook/like.gif'?>" style="height:90px;width:90px;"/>
                                <h5 class="timer count-title count-number" data-to="300" data-speed="1500">300</h5>
                                
                            </div>
                            <div class="counter col_fourth">
                                <img class="over" src="<?php echo APP_BASE_URL.'/uploads/icon_facebook/love.gif'?>" style="height:90px;width:90px;"/>
                                <h5 class="timer count-title count-number" data-to="300" data-speed="1500">300</h5>
                               
                            </div>
                            <div class="counter col_fourth">
                                <img class="over" src="<?php echo APP_BASE_URL.'/uploads/icon_facebook/haha.gif'?>" style="height:90px;width:90px;"/>
                                <h5 class="timer count-title count-number" data-to="300" data-speed="1500">300</h5>
                                
                            </div>
                            <div class="counter col_fourth">
                                <img class="over" src="<?php echo APP_BASE_URL.'/uploads/icon_facebook/wow.gif'?>" style="height:90px;width:90px;"/>
                                <h5 class="timer count-title count-number" data-to="300" data-speed="1500">300</h5>
                                
                            </div>
                            <div class="counter col_fourth">
                                <img class="over" src="<?php echo APP_BASE_URL.'/uploads/icon_facebook/cry.gif'?>" style="height:90px;width:90px;"/>
                                <h5 class="timer count-title count-number" data-to="300" data-speed="1500">300</h5>
                                
                            </div>
                            <div class="counter col_fourth">
                                <img class="over" src="<?php echo APP_BASE_URL.'/uploads/icon_facebook/angry.gif'?>" style="height:90px;width:90px;"/>
                                <h5 class="timer count-title count-number" data-to="300" data-speed="1500">300</h5>
                                
                            </div>
                        </div>
                    </div>
                    <br />
                    <br />
        </div>
    </div>
</div>