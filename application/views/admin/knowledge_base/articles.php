<?php init_head(); ?>
<link rel="stylesheet" type="text/css" href="../assets/css/video-list.css">
<div id="wrapper">
   <div class="content">
      <div class="row">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">

               <h4 class="customer-profile-group-heading"><?php echo _l('kb_trend'); ?></h4>
   
               <div class="additional"></div>

                <div class="col-md-12">

                  <div class="horizontal-scrollable-tabs">

                    <div class="scroller arrow-left"><i class="fa fa-angle-left"></i></div>

                      <div class="scroller arrow-right"><i class="fa fa-angle-right"></i></div>

                        <div class="horizontal-tabs">

                          <ul class="nav nav-tabs profile-tabs row customer-profile-tabs nav-tabs-horizontal" role="tablist">
                            <li role="presentation" class="<?php if(!$this->input->get('tab')){echo 'active';}; ?>">
                              <a href="#google_trend_contents" role="tab" data-toggle="tab">
                              <?php echo _l('kb_google_trend'); ?>
                              </a>
                            </li>
        
                            <li role="presentation" class="<?php if($this->input->get('tab') == 'custom_fields'){echo 'active';}; ?>">
                              <a href="#youtube_trend_contents" aria-controls="custom_fields" role="tab" data-toggle="tab">
                              <?php echo do_action('customer_profile_tab_custom_fields_text',_l( 'kb_you_trend')); ?>
                              </a>
                            </li>
                          </ul>

                        </div>
                  </div>

      <!----------------------------------------Content Tab---------------------------------------->
      <div class="tab-content">
          <!--Google Trend Content-->
          <div role="tabpanel" class="tab-pane<?php if(!$this->input->get('tab')){echo ' active';}; ?>" id="google_trend_contents">
                   <div id="google_trend_contents">

                      <iframe src="//hawttrends.appspot.com/?delay=9000&amp;neat=1&amp;p=28"></iframe>
                      <hr class="hr-panel-heading" />

                      <div id = "google_trend_content">
                      <script type="text/javascript" src="https://ssl.gstatic.com/trends_nrtr/1544_RC05/embed_loader.js"></script> <script type="text/javascript"> trends.embed.renderWidget("dailytrends", "", {"geo":"VN","guestPath":"https://trends.google.com.vn:443/trends/embed/"}); </script> 
                      </div>

                   </div>
          </div>
          <!--Youtube Trend Content-->
         <div role="tabpanel" class="tab-pane" id="youtube_trend_contents">
            
                   <div id="youtube_trend_contents">
                        
                        <ul class="list-unstyled video-list-thumbs row">
                        <?php
                          $Id = 'UCy3AjyBptEC4ODn-JeOp4JQ';
                          $maxResults = 20;
                          $API_key = 'AIzaSyCWYkTTeP6UJfbY9DJbrJHfwAoCPybt-yg';

                          set_error_handler('videoListDisplayError');

                         
                          $video_list = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/playlistItems?part=snippet,contentDetails&maxResults=20&playlistId=PLUadgMpPaifVmhXn4xz-jRO934EAORUnX&key=AIzaSyCWYkTTeP6UJfbY9DJbrJHfwAoCPybt-yg'));

                          foreach($video_list->items as $item)
                          {
                        
                          echo '<li id="'. $item->contentDetails->videoId .'" class="col-lg-3 col-sm-6 col-xs-6 youtube-video">
                          <a href="https://www.youtube.com/watch?v='. $item->contentDetails->videoId .'">
                          <img src="'. $item->snippet->thumbnails->medium->url .'" alt="'. $item->snippet->title .'" class="img-responsive" height="130px" />
                          <h2>'. $item->snippet->title .'</h2>
                          <span class="glyphicon glyphicon-play-circle"></span>
                          </a>
                          </li>
                          '
                          ;
                           }
                      ?>
                    </ul>

                    <a href="https://www.youtube.com/channel/<?php echo $Id; ?>" target="_blank" class="btn btn-danger btn-lg"><i class="fa fa-youtube"></i> More videos...</a>

                    </div>
          </div>
      </div>
    </div>
   </div>
</div>
</div>
</div>
</div>
</div>
<?php init_tail(); ?>

