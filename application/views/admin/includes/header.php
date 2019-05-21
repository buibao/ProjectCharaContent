<?php
   ob_start();
   ?>
<style type="text/css">
#header{
    background: #415165;
    background: -webkit-gradient(linear,left top,right top,from(#415165),color-stop(26%,#51647c),color-stop(73%,#51647c),to(#4f5d7a));
    background: linear-gradient(to right,#415165 0,#51647c 26%,#51647c 73%,#4f5d7a 100%);
    display: block;
    height: 63px;
    margin: 0;
    padding: 0;
    position: relative;
    z-index: 99;
    position: fixed;
    top: 0;
    width: 100%;
}
</style>
<li id="top_search" class="dropdown" data-toggle="tooltip" data-placement="bottom" data-title="<?php echo _l('search_by_tags'); ?>">
   <input type="search" id="search_input" class="form-control" placeholder="<?php echo _l('top_search_placeholder'); ?>">
   <div id="search_results">
   </div>
</li>
<li id="top_search_button">
   <button class="btn"><i class="fa fa-search"></i></button>
</li>
<?php
   $top_search_area = ob_get_contents();
   ob_end_clean();
   ?>
<div id="header">
   <div class="hide-menu"><i class="fa fa-bars"></i></div>
   <div id="logo">
      <?php get_company_logo(get_admin_uri().'/') ?>
   </div> 
	<div id="logo">
               <a href="#" class="hvr-icon-spin">
          <i id="son" class="fa fa-mail-reply" data-placement="bottom" aria-hidden="true" data-original-title="<?php echo _l('go_back'); ?>" data-toggle="tooltip" title data-placement="button" style="font-size:20px; margin-left: 50px; margin-top: 15px;" onclick="history.back(-1)"></i>
            </a>
	</div>          
   <nav>
      <div class="small-logo">
         <span class="text-primary">
         <?php get_company_logo(get_admin_uri().'/') ?>
         </span>
      </div>
      <div class="mobile-menu">
         <button type="button" class="navbar-toggle visible-md visible-sm visible-xs mobile-menu-toggle collapsed" data-toggle="collapse" data-target="#mobile-collapse" aria-expanded="false">
         <i class="fa fa-chevron-down"></i>
         </button>
         <ul class="mobile-icon-menu">
            <?php
               // To prevent not loading the timers twice
               if(is_mobile()){ ?>
            <li class="dropdown notifications-wrapper header-notifications">
               <?php $this->load->view('admin/includes/notifications'); ?>
            </li>
            <li class="header-timers">
               <a href="#" id="top-timers" class="dropdown-toggle top-timers" data-toggle="dropdown"><i class="fa fa-clock-o fa-fw fa-lg"></i>
               <span class="label bg-success icon-total-indicator icon-started-timers<?php if ($totalTimers = count($startedTimers) == 0){ echo ' hide'; }?>"><?php echo count($startedTimers); ?></span>
               </a>
               <ul class="dropdown-menu animated fadeIn started-timers-top width300" id="started-timers-top">
                  <?php $this->load->view('admin/tasks/started_timers',array('startedTimers'=>$startedTimers)); ?>
               </ul>
            </li>
            <?php } ?>
         </ul>
         <div class="mobile-navbar collapse" id="mobile-collapse" aria-expanded="false" style="height: 0px;" role="navigation" >
            <ul class="nav navbar-nav">
               <li class="header-my-profile"><a href="<?php echo admin_url('profile'); ?>"><?php echo _l('nav_my_profile'); ?></a></li>
                <li class="header-my-profile"><a href="<?php echo admin_url('profile'); ?>"><?php echo _l('nav_my_profile'); ?></a></li>
               <li class="header-my-timesheets"><a href="<?php echo admin_url('staff/timesheets'); ?>"><?php echo _l('my_timesheets'); ?></a></li>
               <li class="header-edit-profile"><a href="<?php echo admin_url('staff/edit_profile'); ?>"><?php echo _l('nav_edit_profile'); ?></a></li>
              <?php if(is_staff_member()){ ?>
               <li class="header-newsfeed">
                    <a href="#" class="open_newsfeed">
                        <?php echo _l('whats_on_your_mind'); ?>
                    </a>
                 </li>
               <?php } ?>
               <li class="header-logout"><a href="#" onclick="logout(); return false;"><?php echo _l('nav_logout'); ?></a></li>
            </ul>
         </div>
      </div>
      <ul class="nav navbar-nav navbar-right">
         <?php
            if(!is_mobile()){
              echo $top_search_area;
            } ?>
         <?php do_action('after_render_top_search'); ?>
         <li class="icon header-user-profile" data-toggle="tooltip" title="<?php echo get_staff_full_name(); ?>" data-placement="bottom">
            <a href="#" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="false">
            <?php echo staff_profile_image($current_user->staffid,array('img','img-responsive','staff-profile-image-small','pull-left')); ?>
            </a>
            <ul class="dropdown-menu animated fadeIn">
               <li class="header-my-profile"><a href="<?php echo admin_url('profile'); ?>"><?php echo _l('nav_my_profile'); ?></a></li>
               <li class="header-my-timesheets"><a href="<?php echo admin_url('staff/timesheets'); ?>"><?php echo _l('my_timesheets'); ?></a></li>
               <li class="header-edit-profile"><a href="<?php echo admin_url('staff/edit_profile'); ?>"><?php echo _l('nav_edit_profile'); ?></a></li>
               <?php if(get_option('disable_language') == 0){ ?>
               <li class="dropdown-submenu pull-left header-languages">
                  <a href="#" tabindex="-1"><?php echo _l('language'); ?></a>
                  <ul class="dropdown-menu dropdown-menu">
                     <li class="<?php if($current_user->default_language == ""){echo 'active';} ?>"><a href="<?php echo admin_url('staff/change_language'); ?>"><?php echo _l('system_default_string'); ?></a></li>
                     <?php foreach($this->app->get_available_languages() as $user_lang) { ?>
                     <li<?php if($current_user->default_language == $user_lang){echo ' class="active"';} ?>>
                        <a href="<?php echo admin_url('staff/change_language/'.$user_lang); ?>"><?php echo ucfirst($user_lang); ?></a>
                        <?php } ?>
                  </ul>
               </li>
               <?php } ?>
               <li class="header-logout">
                  <a href="#" onclick="logout(); return false;"><?php echo _l('nav_logout'); ?></a>
               </li>
            </ul>
         </li>
         <?php if(is_staff_member()){ ?>
         <li class="icon header-newsfeed">
            <a href="#" class="open_newsfeed" data-toggle="tooltip" title="<?php echo _l('whats_on_your_mind'); ?>" data-placement="bottom"><i class="fa fa-share fa-fw fa-lg" aria-hidden="true"></i></a>
         </li>
         <?php } ?>
         <li class="icon header-todo">
            <a href="<?php echo admin_url('todo'); ?>" data-toggle="tooltip" title="<?php echo _l('nav_todo_items'); ?>" data-placement="bottom"><i class="fa fa-check-square-o fa-fw fa-lg"></i>
            <span class="label bg-warning icon-total-indicator nav-total-todos<?php if($current_user->total_unfinished_todos == 0){echo ' hide';} ?>"><?php echo $current_user->total_unfinished_todos; ?></span>
            </a>
         </li>
         <li class="icon header-timers timer-button" data-placement="bottom" data-toggle="tooltip" data-title="<?php echo _l('my_timesheets'); ?>">
            <a href="#" id="top-timers" class="dropdown-toggle top-timers" data-toggle="dropdown">
            <i class="fa fa-clock-o fa-fw fa-lg" aria-hidden="true"></i>
            <span class="label bg-success icon-total-indicator icon-started-timers<?php if ($totalTimers = count($startedTimers) == 0){ echo ' hide'; }?>">
            <?php echo count($startedTimers); ?>
            </span>
            </a>
            <ul class="dropdown-menu animated fadeIn started-timers-top width350" id="started-timers-top">
               <?php $this->load->view('admin/tasks/started_timers',array('startedTimers'=>$startedTimers)); ?>
            </ul>
         </li>
         <li class="dropdown notifications-wrapper header-notifications" data-toggle="tooltip" title="<?php echo _l('nav_notifications'); ?>" data-placement="bottom">
            <?php $this->load->view('admin/includes/notifications'); ?>
         </li>
             <?php if ((has_permission('callcenter', '', 'view'))) {?>
            <li  id="checkhidden"data-toggle="tooltip" title="<?php echo 'Call Center'; ?>" data-placement="bottom">
               <?php $this->load->view('admin/includes/call'); ?>
            <a class="fa fa-phone menu-icon" style="font-size: 20px;"  onclick="myFunctionss();"></a>
         </li>
            <?php }?>
          
        
      </ul>
   </nav>
</div>
<div id="mobile-search" class="<?php if(!is_mobile()){echo 'hide';} ?>">
   <ul>
      <?php
         if(is_mobile()){
           echo $top_search_area;
         } ?>
   </ul>
</div>
<script src="<?php echo base_url().'plugins/callcenter/assets/jquery.searchable-1.0.0.min.js'?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        <?php 
            $currentPopup = isset($_GET['currentPopup']) ? $_GET['currentPopup'] : 0;
           echo "var currentPopup = ".$currentPopup.";";
         
          ?>
            if(currentPopup == 1){
                $('#checkhidden').hide();
           }
    });
</script>
<script type="text/javascript">
   function myFunctionss() {
 var iframe = document.getElementsByClassName("stringee_iframe_wrapper")[0];
             if(iframe.style.display === 'none'){
                        iframe.style.display = 'block';}
                        else {iframe.style.display = 'none';}

  var iFrameDOMs = $(".iframe").contents();
                  iFrameDOMs.find('.clickdone').on('click', function(){
                       console.log("hello call");
                    iFrameDOMs.find('#contact-list-wrapper').toggleClass('show');
                     iFrameDOMs.find('#call-history-wrapper').removeClass('show');

                     iFrameDOMs.find('#contact-list-search').val("");
                      iFrameDOMs.find('#contact-list-history-search').val("");
           
  
                });
                  iFrameDOMs.find('.clickhis').on('click', function(){
                       console.log("hello his");
                     iFrameDOMs.find('#call-history-wrapper').toggleClass('show');
                    iFrameDOMs.find('#contact-list-wrapper').removeClass('show');

                 
                     iFrameDOMs.find('#contact-list-search').val("");
                      iFrameDOMs.find('#contact-list-history-search').val("");
                     

                });

                  iFrameDOMs.find('.clickCall').on('click', function(){
                     var title = $(this).attr('title');
                     console.log(title);
                iFrameDOMs.find('#contact-list-wrapper').removeClass('show');
                 iFrameDOMs.find('#call-history-wrapper').removeClass('show');
                       var iFrameDOM = $(".iframe").contents();
nameContact ='';
iFrameDOM.find(".wrap-avatar-round").find('p').remove();
        $.ajax({
                method:"POST",
                url:'<?php echo base_url().'admin/callcenter/imageContact/';?>' + title,
                data:{phone:title},
                success: function(data){
imageContact = data;
iFrameDOM.find(".mt-80").attr('src',imageContact);
                }           
            });  
        $.ajax({
                method:"POST",
                url:'<?php echo base_url().'admin/callcenter/getNameContact/';?>' + title,
                data:{phone:title},
                success: function(data){       
nameContact = data;
iFrameDOM.find(".wrap-avatar-round").append( "<p class='abcd'>"+nameContact+"</p>" );
                }
                
            });  
                 StringeeSoftPhone.makeCall(fromNumber, title, function (res) {
                       var iframe = document.getElementsByClassName("stringee_iframe_wrapper")[0];
                        if(iframe.style.display === 'none'){
                        iframe.style.display = 'block';}
                    });
               });

                
        /* BOOTSNIPP FULLSCREEN FIX */
        if (window.location == window.parent.location) {
            iFrameDOMs.find('#back-to-bootsnipp').removeClass('hide');
        }

        iFrameDOMs.find('[data-command="toggle-search"]').on('click', function(event) {
            event.preventDefault();
           iFrameDOMs.find(this).toggleClass('hide-search');

            if ( iFrameDOMs.find(this).hasClass('hide-search')) {
                iFrameDOMs.find('.c-search').closest('.row').slideUp(100);
            }else{
                iFrameDOMs.find('.c-search').closest('.row').slideDown(100);
            }
        })


   iFrameDOMs.find('#contact-list-history').searchable({
            searchField: iFrameDOMs.find('#contact-list-history-search'),
            selector: iFrameDOMs.find('li'),
            childSelector: iFrameDOMs.find('.search-contact'),
            show: function( elem ) {
                elem.slideDown(100);
            },
            hide: function( elem ) {
                elem.slideUp( 100 );
            }
        });


        iFrameDOMs.find('#contact-list').searchable({
            searchField: iFrameDOMs.find('#contact-list-search'),
            selector: iFrameDOMs.find('li'),
            childSelector: iFrameDOMs.find('.search-contact'),
            show: function( elem ) {
                elem.slideDown(100);
            },
            hide: function( elem ) {
                elem.slideUp( 100 );
            }
        });


  console.log( iFrameDOMs.find('#contact-list-history'));
       
}

</script>
