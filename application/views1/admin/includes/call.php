

        <script>
    // var access_token ='<?php //echo $GLOBALS['token']; ?>';
            var config = {
                showMode: 'none', //full | min | none
                top: 65,
                right: 0,
                //right: undefined,
                //bottom: undefined,
              arrowLeft: 155,
                arrowDisplay: 'none', //top | bottom | none
                //list your Stringee Number
                fromNumbers: [{alias: fromNumber, number: fromNumber}],
                askCallTypeWhenMakeCall: false,
                appendToElement: null,
                makeAndReceiveCallInNewPopupWindow: false
            };
            StringeeSoftPhone.init(config);
            StringeeSoftPhone.on('displayModeChange', function (event) {
                console.log('displayModeChange', event);
                if (event === 'min') {
                    StringeeSoftPhone.config({arrowLeft: 75});
                } else if (event === 'full') {
                    StringeeSoftPhone.config({arrowLeft: 155});
                }
            });
            StringeeSoftPhone.on('requestNewToken', function () {
                console.log('requestNewToken+++++++');
                StringeeSoftPhone.connect(access_token);
            });
            StringeeSoftPhone.on('authen', function (res) {
                console.log('authen: ', res);
            });
            StringeeSoftPhone.on('disconnect', function () {
                console.log('disconnected');
            });
            StringeeSoftPhone.on('signalingstate', function (state) {
                console.log('signalingstate', state);
            });
            StringeeSoftPhone.on('beforeMakeCall', function (call, callType) {
                console.log('beforeMakeCall: ' + callType);
                return true;
            });
            StringeeSoftPhone.on('answerIncomingCallBtnClick', function () {
                    <?php 
                $currentPopup = isset($_GET['currentPopup']) ? $_GET['currentPopup'] : 0;
                echo "var currentPopup = ".$currentPopup.";";
            ?>

                 if (currentPopup == 0) {
                    
           
                         var newwindow = window.open( phoneRedirectURL+ number +'?currentPopup=1' , 'Incoming Call', 'height=500,width=500'); 
 
                           if (window.focus) {newwindow.focus()} 
                            
            }
               
                console.log('answerIncomingCallBtnClick');
            });
            StringeeSoftPhone.on('makeOutgoingCallBtnClick', function (fromNumber, toNumber, callType) {
              var iFrameDOM = $(".iframe").contents();
              iFrameDOM.find(".wrap-avatar-round").find('p').remove();
nameContact ='';
        $.ajax({
                method:"POST",
                url:'<?php echo base_url().'admin/callcenter/imageContact/';?>' + toNumber,
                data:{phone:toNumber},
                success: function(data){
imageContact = data;

$.ajax({
                method:"POST",
                url:'<?php echo base_url().'admin/callcenter/getNameContact/';?>' + toNumber,
                data:{phone:toNumber},
                success: function(data){
            
nameContact = data;
iFrameDOM.find(".wrap-avatar-round").append( "<p class='abcd'>"+nameContact+"</p>" );
                }
                
            });

iFrameDOM.find(".mt-80").attr('src',imageContact);
                console.log(imageContact);
                }
                
            });  


console.log(iFrameDOM.find(".mt-80"));

                console.log('makeOutgoingCallBtnClick: fromNumber=' + fromNumber + ', toNumber=' + toNumber + ',callType=' + callType);
            });
            StringeeSoftPhone.on('incomingCall', function (incomingcall) {
                 var iFrameDOM1 = $(".iframe").contents();
               
                     iFrameDOM1.find('#contact-list-wrapper').removeClass('show');
                      iFrameDOM1.find('#call-history-wrapper').removeClass('show');

                console.log('incomingCall: ', incomingcall);
            });
            
            StringeeSoftPhone.on('endCallBtnClick', function () {
                console.log('endCallBtnClick');
            });
            StringeeSoftPhone.on('callingScreenHide', function () {
                console.log('callingScreenHide');
            });
            
            StringeeSoftPhone.on('declineIncomingCallBtnClick', function () {
                console.log('declineIncomingCallBtnClick');
            });
            
            StringeeSoftPhone.on('incomingScreenHide', function () {
                console.log('incomingScreenHide');
            });
        </script>