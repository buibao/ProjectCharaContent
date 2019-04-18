<!DOCTYPE html>
<html lang="en">
<head>
<?php $isRTL = (is_rtl() ? 'true' : 'false'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1" />
<?php if(get_option('favicon') != ''){ ?>
<link href="<?php echo base_url('uploads/company/'.get_option('favicon')); ?>" rel="shortcut icon">
<?php } ?>
<title><?php if (isset($title)){ echo $title; } else { echo get_option('companyname'); } ?></title>
<?php echo app_stylesheet('assets/css','reset.css'); ?>
<link href='<?php echo base_url('assets/plugins/roboto/roboto.css'); ?>' rel='stylesheet'>
<link href="<?php echo base_url('assets/plugins/app-build/vendor.css?v='.get_app_version()); ?>" rel="stylesheet">
<?php if($isRTL === 'true'){ ?>
<link href="<?php echo base_url('assets/plugins/bootstrap-arabic/css/bootstrap-arabic.min.css'); ?>" rel="stylesheet">
<?php } ?>
<?php if(isset($calendar_assets)){ ?>
<link href='<?php echo base_url('assets/plugins/fullcalendar/fullcalendar.min.css?v='.get_app_version()); ?>' rel='stylesheet' />
<?php } ?>
<?php if(isset($projects_assets)){ ?>
<link href='<?php echo base_url('assets/plugins/jquery-comments/css/jquery-comments.css'); ?>' rel='stylesheet' />
<link href='<?php echo base_url('assets/plugins/gantt/css/style.css'); ?>' rel='stylesheet' />
<?php } ?>
<?php echo app_stylesheet('assets/css','style.css'); ?>
<?php if(file_exists(FCPATH.'assets/css/custom.css')){ ?>
<link href="<?php echo base_url('assets/css/custom.css'); ?>" rel="stylesheet">
<?php } ?>
<?php render_custom_styles(array('general','tabs','buttons','admin','modals','tags')); ?>
<?php render_admin_js_variables(); ?>
<script>
    appLang['datatables'] = <?php echo json_encode(get_datatables_language_array()); ?>;
    var totalUnreadNotifications = <?php echo $current_user->total_unread_notifications; ?>,
    proposalsTemplates = <?php echo json_encode(get_proposal_templates()); ?>,
    contractsTemplates = <?php echo json_encode(get_contract_templates()); ?>,
    availableTags = <?php echo json_encode(get_tags_clean()); ?>,
    availableTagsIds = <?php echo json_encode(get_tags_ids()); ?>,
    billingAndShippingFields = ['billing_street','billing_city','billing_state','billing_zip','billing_country','shipping_street','shipping_city','shipping_state','shipping_zip','shipping_country'],
    locale = '<?php echo $locale; ?>',
    isRTL = '<?php echo $isRTL; ?>',
    tinymceLang = '<?php echo get_tinymce_language(get_locale_key($app_language)); ?>',
    monthsJSON = '<?php echo json_encode(array(_l('January'),_l('February'),_l('March'),_l('April'),_l('May'),_l('June'),_l('July'),_l('August'),_l('September'),_l('October'),_l('November'),_l('December'))); ?>',
    taskid,taskTrackingStatsData,taskAttachmentDropzone,taskCommentAttachmentDropzone,leadAttachmentsDropzone,newsFeedDropzone,expensePreviewDropzone,taskTrackingChart,cfh_popover_templates = {},_table_api;
</script>

<script>
      var imageContact='https://static.stringee.com/web_phone/lastest/images/avatar.png';
      var imgContactsForm = '<?php echo base_url() . 'uploads/client_profile_images/'?>';
      var urlAPIContacts = '<?php echo base_url().'API/Contacts';?>';
      var urlAlljs = '<?php echo base_url().'plugins/callcenter/assets/all-js-1.0.0.js'?>';
      var iconCall_out = '<?php echo base_url().'plugins/callcenter/expand.png'?>';
      var iconCall_in = '<?php echo base_url().'plugins/callcenter/narrow.png'?>';
      var urlSearch = '<?php echo base_url().'plugins/callcenter/assets/jquery.searchable-1.0.0.min.js'?>';
      var infoCompany ='<?php echo base_url().'admin/clients/client/'?>';
      var nameContact = '';
      var toNumberHead = 'Hello';
      var fromNumberHead = 'Hello';
      var checkWidgetCall = false;
      var number= '';
  
          <?php 
    $id  = $GLOBALS['current_user']->staffid;
    $GLOBALS['$userVHT'] =  $this->Callcenter_model->getSingleVHT($id); 
    $vht_username = $GLOBALS['$userVHT']->Ext;
    $vht_password = $GLOBALS['$userVHT']->Pass;
    $vht_token = $GLOBALS['$userVHT']->Token;

   $fields = [
  'username' => $vht_username,
  'password' => $vht_password
];
$headers = [
  'AppPlatform: Web',
  'AppName: vcall',
  'AppVersion: 1.0'
];

    
    $url = 'https://acd-api.vht.com.vn/rest/softphones/login';
    
    $data_string = json_encode($credentials);  
                                                                                         
    $ch = curl_init($url);                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");      
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);                                                                                                             
                                                                                                            
    $data = curl_exec($ch);
    $dataBody = json_decode($data);
    $token = $dataBody->token;
    
  if(!$token){
            $token =  $vht_token ;
    }else{
      
   
  
    $datas['Token']= $token ;
  

    $checkUser = $this->Callcenter_model->getSingle($GLOBALS['current_user']->staffid);
    if($checkUser == false){
        $this->Callcenter_model->insertVHT($datas);
       
    }else{
        $this->Callcenter_model->updateVHTModel($datas,$GLOBALS['current_user']->staffid);
       
    }
    }
    $GLOBALS['token'] = $token;
    ?>

    var access_token ='<?php echo $GLOBALS['token']; ?>';
    var fromNumber = <?php echo "'".$GLOBALS['$userVHT']->Ext."'"; ?>;

</script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/callcenter/jquery-3.2.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/app-build/vendor.js?v='.get_app_version()); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/callcenter/StringeeSoftPhone-lastest.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/callcenter/socket.io-2.0.3.js'); ?>"></script>     
<script type="text/javascript"  src="<?php echo base_url('assets/plugins/callcenter/StringeeSDK-1.3.5.js'); ?>"></script>
<script type="text/javascript">
console.log('<?php echo $GLOBALS['token']; ?>' );

   
        // var phoneRedirectURL = "<?php //echo base_url('/admin/callcenter/getClient/'); ?>";
        var phoneRedirectURL = "<?php echo base_url('/admin/callcenter/getClient/'); ?>";
        var stringURL = "<?php echo base_url('assets/plugins/callcenter/socket.io-2.0.3.js'); ?>";
        var client;
      
         var iFrameDOM = $(".iframe").contents();
        var call;
        
        $(document).ready(function () {
            //check isWebRTCSupported
            console.log('StringeeUtil.isWebRTCSupported in HEAD: ' + StringeeUtil.isWebRTCSupported());

            client = new StringeeClient();

            client.connect(access_token);

            client.on('connect', function () {
                console.log('++++++++++++++ connected to StringeeServer HEAD');
            });

            client.on('authen', function (res) {
                console.log('authen', res);
                $('#loggedUserId').html(res.userId);
            });

            client.on('disconnect', function () {
                console.log('++++++++++++++ disconnected');
            });

     <?php 
            $currentPopup = isset($_GET['currentPopup']) ? $_GET['currentPopup'] : 0;
           echo "var currentPopup = ".$currentPopup.";";
            ?>
// Contacts


     
       console.log(iFrameDOM.find(".wrap-avatar-round"));



            client.on('incomingcall', function (incomingcall) {
              console.log("++++++++++++++++++++++++++++++++++++++++ cxscascs");
               // myFunctionss();
               
                call = incomingcall;
                settingCallEventHead(incomingcall);
              
                    iFrameDOM.find('#contact-list-wrapper').removeClass('show');
                    iFrameDOM.find('#call-history-wrapper').removeClass('show');
                  number   = incomingcall.fromNumber;
           if (currentPopup == 0) {
                
       console.log("**************************CALL COMMING*************************");
     

       iFrameDOM.find(".wrap-avatar-round").find('p').remove();
nameContact ='';
    $.ajax({
            method:"POST",
            url:'<?php echo base_url().'admin/callcenter/imageContact/';?>' + incomingcall.fromNumber,
            data:{phone:incomingcall.fromNumber},
            success: function(data){
        
imageContact = data;

iFrameDOM.find(".mt-50").attr('src',imageContact);
            console.log(imageContact);
            }
            
        });  

$.ajax({
            method:"POST",
            url:'<?php echo base_url().'admin/callcenter/getNameContact/';?>' + incomingcall.fromNumber,
            data:{phone:incomingcall.fromNumber},
            success: function(data){
        
nameContact = data;
iFrameDOM.find(".wrap-avatar-round").append( "<p class='abcd'>"+nameContact+"</p>" );
     //       console.log(imageContact);
            }
            
        });  

                      
        }
           else {
               settingCallEventHead(call);
               call.answer(function (res) {
               console.log('answer res', res);
            });
        }

             
            });
       });

        function makeCalls(toNum){

var iFrameDOM = $(".iframe").contents();
nameContact ='';
iFrameDOM.find(".wrap-avatar-round").find('p').remove();
    $.ajax({
            method:"POST",
            url:'<?php echo base_url().'admin/callcenter/imageContact/';?>' + toNum,
            data:{phone:toNum},
            success: function(data){
imageContact = data;
iFrameDOM.find(".mt-80").attr('src',imageContact);
            }           
        });  
    $.ajax({
            method:"POST",
            url:'<?php echo base_url().'admin/callcenter/getNameContact/';?>' + toNum,
            data:{phone:toNum},
            success: function(data){       
nameContact = data;
iFrameDOM.find(".wrap-avatar-round").append( "<p class='abcd'>"+nameContact+"</p>" );
  
            }
            
        });  
             myFunctionss();
                  StringeeSoftPhone.makeCall(fromNumber, toNum, function (res) {
                   var iframe = document.getElementsByClassName("stringee_iframe_wrapper")[0];
                    // if(iframe.style.display === 'none'){
                    // iframe.style.display = 'block';}
                });

            }
          
        function settingCallEventHead(call1) {
            call1.on('addlocalstream', function (stream) {
            });

            call1.on('addremotestream', function (stream) {
              
                remoteVideo.srcObject = null;
                remoteVideo.srcObject = stream;
            });

            call1.on('signalingstate', function (state) {
                console.log('signalingstate ', state);
                var reason = state.reason;
                $('#callStatus').html(reason);
            });

            call1.on('mediastate', function (state) {
                console.log('mediastate ', state);
            });

            call1.on('info', function (info) {
                console.log('on info', info);
            });

            call1.on('otherdevice', function (data) {
                console.log('on otherdevice:' + JSON.stringify(data));
            });
        }

        function testHangupCall() {
            remoteVideo.srcObject = null;

            call.hangup(function (res) {
                console.log('hangup res', res);
            });
        }
    </script>

<?php do_action('app_admin_head'); ?>
</head>  
<body <?php echo admin_body_class(isset($bodyclass) ? $bodyclass : ''); ?><?php if($isRTL === 'true'){ echo 'dir="rtl"';}; ?>>   
<video id="localVideo" playsinline autoplay muted style="display: none;background: #424141;"></video> 
<video id="remoteVideo" playsinline autoplay style="display: none; background: #424141;"></video>  
<?php do_action('after_body_start'); ?>
