<style>
    /*-=-=-=-=-=-=-=-=-=-=-=- */
    /* Column Grids */
    /*-=-=-=-=-=-=-=-=-=-=-=- */
    .over {
        margin-left: auto;
        margin-right: auto;
        vertical-align:middle;
        transition: transform .3s;
        display: block;
    }
  

    .over:hover {
        -webkit-transform: scale(1.3, 1.3);
        -moz-transform: scale(1.3, 1.3);
        -ms-transform: scale(1.3, 1.3);
        -o-transform: scale(1.3, 1.3);
        
    }


    /*top tooltip*/
    .tooltip.top>.tooltip-arrow {
        visibility: hidden;
    }

        {}

    /*tooltip inner*/
    .tooltip>.tooltip-inner {
        background-color: #2d343f;
        text-shadow: 0 1px 1px #000;
        font-weight: normal;
        margin-bottom: -15px;
        border-radius: 23px;
        padding: 5px 17px 5px 17px;
        font-size: 1.5em;
        font-weight: bold;
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
        margin: 10px auto;
        position: relative;
    }

    .counter {
        border-right: 1px solid hsl(200, 98%, 93%);
    
    }

    .count-title {
        font-size: 17px;
        font-weight: normal;
        margin-top: -10px;
        text-align: center;
        font-family: 'Raleway', sans-serif;
        color: #2057AA;
        font-weight: bold;
    
    }

    .count-text {
        font-size: 13px;
        font-weight: normal;
        margin-top: 10px;
        margin-bottom: 40px;
        text-align: center;
    }

    .fa-2x {
        margin: 0 auto;
        float: none;
        display: table;
        color: #4ad1e5;
    }

    }
</style>
<div class="panel_s">
    <div class="panel-body" style="background-color:#F5F7FA;">
        <div class="row">
            <div class="col-md-12" style="height:130px;">
            <h4 class="bold no-margin"><?php echo _l('content_interaction') ?></h4>
                <div class="wrapper border-right">
                    <div class="counter col_fourth">
                        <img data-toggle="tooltip" data-placement="top" data-original-title="Like" class="over" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/like.gif' ?>" style="height:90px;width:90px;" />
                        <h5 class="timer count-title count-number" data-to="300" data-speed="1500">300</h5>
                        
                    </div>
                    <div class="counter col_fourth">
                        <img data-toggle="tooltip" data-placement="top" data-original-title="Love" class="over" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/love.gif' ?>" style="height:90px;width:90px;" />
                        <h5 class="timer count-title count-number" data-to="300" data-speed="1500">300</h5>

                    </div>
                    <div class="counter col_fourth">
                        <img data-toggle="tooltip" data-placement="top" data-original-title="Haha" class="over" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/haha.gif' ?>" style="height:90px;width:90px;" />
                        <h5 class="timer count-title count-number" data-to="300" data-speed="1500">300</h5>

                    </div>
                    <div class="counter col_fourth">
                        <img data-toggle="tooltip" data-placement="top" data-original-title="Wow" class="over" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/wow.gif' ?>" style="height:90px;width:90px;" />
                        <h5 class="timer count-title count-number" data-to="300" data-speed="1500">300</h5>

                    </div>
                    <div class="counter col_fourth">
                        <img data-toggle="tooltip" data-placement="top" data-original-title="Sad" class="over" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/cry.gif' ?>" style="height:90px;width:90px;" />
                        <h5 class="timer count-title count-number" data-to="300" data-speed="1500">300</h5>

                    </div>
                    <div class="counter col_fourth">
                        <img data-toggle="tooltip" data-placement="top" data-original-title="Angry" class="over" src="<?php echo APP_BASE_URL . '/uploads/icon_facebook/angry.gif' ?>" style="height:90px;width:90px;" />
                        <h5 class="timer count-title count-number" data-to="300" data-speed="1500">300</h5>

                    </div>
                </div>
            </div>
            <br />
            <br />
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        //Tooltip, activated by hover event
        $("body").tooltip({
                selector: "[data-toggle='tooltip']",
                container: "body"
            })
            //Popover, activated by clicking
            
       

    });
</script>