<?php init_head(); ?>
       
<div id="wrapper" >
    <div id="main-newsletter" class="content">
        <div class="row">
            <div class="col-md-12">
<div class="page" id="pageStringeeCall">
    <!-- Page Content -->
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!-- Example Panel With Heading -->
                <div class="panel panel-bordered overlayAjax">
                    <div class="panel-heading">
                        <h3 class="panel-title">Call Reports</h3>
                        <div class="btnRightCorner">
                            <button type="button" class="btn btn-warning btn-sm" id="btnExportExcel" onclick="self.location.href = 'https://developer.stringee.com/report/callexportexcel'">
                                <i class="front-icon animation-scale-up" aria-hidden="true"><img src="https://developer.stringee.com/static/assets/images/icon/excel.svg" width="14"></i>
                                &nbsp;Export Excel
                            </button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form class="form-inline" id="formSearchCallReport">
                                                      <div class="form-group">
                               <!--  <select class="form-control" id="selectProjectId">
                                </select> -->
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="selectFromInternal">
                                    <option value="">FROM TYPE</option>
                                    <option value="on">From internal</option>
                                    <option value="off">From external</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="selectToInternal">
                                    <option value="">TO TYPE</option>
                                    <option value="on">To internal</option>
                                    <option value="off">To external</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="isVideocall">
                                    <option value="">CALL TYPE</option>
                                    <option value="1">Video call</option>
                                    <option value="0">Voice call</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <!--<label class="form-control-label" for="inputUserID">UserID</label>-->
                                <input type="text" class="form-control"  id="inputUserID" name="" placeholder="USER ID" autocomplete="off" style="width: 100px;">
                            </div>


                        </form>



                        <div class="form-inline">
                            <div class="form-group">
                                <div class="input-group">
                                    <!--<label class="form-control-label" for="inputFromNumber">From</label>-->
                                    <input type="text" class="form-control" id="inputFromNumber" name="inputFromNumber" placeholder="From: ex 84988889998" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <!--<label class="form-control-label" for="inputToNumber">To</label>-->
                                <input type="text" class="form-control" id="inputToNumber" name="inputToNumber" placeholder="To: ex 84122339998" autocomplete="off">
                            </div>


                            <div class="form-group">
                                <div id="reportrange" class="pull-right form-control mr-10">
                                    <i class="icon" aria-hidden="true"><img src="https://developer.stringee.com/static/assets/images/icon16/calendar.png" /></i>&nbsp;
                                    <span></span> <b class="caret"></b>
                                </div>
                                <button type="button" class="btn btn-default btm-xs" id="btnResetDateRange">All Days</button>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-success" id="btnSearchCall">Search</button>
                            </div>
                        </div>
                        <div class='form-inline'>   
                            <label class="form-control-label" for="inputInlineUsername">
                                <span class="countSearch">0</span> 
                                <span class="text-danger">CALLS </span> 
                                <span >&nbsp; - &nbsp;</span> 
                                <span class="totalMinutes font-size-40 text-danger mr-10"></span>
                                <span class="text-danger">(Giờ:Phút:Giây)</span>
                            </label>
                        </div>
                        <!-- Example C3 Simple Line -->
                        <div id="exampleC3TimeSeries"></div>
                        <!-- End Example C3 Simple Line -->

                        <div class="table-responsive" style="overflow: auto">
                            <table class="table table-striped table-bordered table-hover" id="tableCalls">
                                <thead class="bg-blue-grey-200">
                                    <tr>
                                       
        <td>ID</td>
        <td><?php echo _l('direction');?></td>
        <td><?php echo _l('from_number');?></td>
        <td><?php echo _l('to_number');?></td>
        <td><?php echo _l('time_duration');?></td>
        <td><?php echo _l('recording');?></td>
       <!--  <td><?php //echo _l('call_status');?></td> -->
       <!--  <td><?php //echo _l('time_started');?></td> -->
         <td><?php echo _l('time_connected');?></td>
         <td><?php echo _l('time_ended');?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-right wrapPagination">
                                <ul id='paginationCall'></ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Example Panel With Heading -->
            </div>

        </div>

    </div>
    <!-- End Page Content -->
</div>
</div>
</div>
</div>
</div>
<?php init_tail(); ?>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://developer.stringee.com/static/global/fonts/font-awesome/font-awesome.css">
        <link rel="stylesheet" href="https://developer.stringee.com/static/global/fonts/web-icons/web-icons.min.css">
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
        <!-- Stylesheets -->
     <!--    <link rel="stylesheet" href="https://developer.stringee.com/static/global/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://developer.stringee.com/static/global/css/bootstrap-extend.min.css">
        <link rel="stylesheet" href="https://developer.stringee.com/static/assets/css/site.min.css"> -->
        <link rel="stylesheet" href="https://developer.stringee.com/static/global/vendor/asscrollable/asScrollable.css">
        <!-- StylesheetsCustom -->
        <link rel="stylesheet" href="https://developer.stringee.com/static/assets/css/site-custom.css">
        <link rel="stylesheet" href="https://developer.stringee.com/static/assets/css/my-library.css">

        <script src="https://developer.stringee.com/static/global/vendor/jquery/jquery.js"></script>
        <script src="https://developer.stringee.com/static/global/vendor/breakpoints/breakpoints.js"></script>
        <script src="https://developer.stringee.com/static/assets/js/jquery.twbsPagination.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.4/dist/loadingoverlay.min.js"></script>
        <script>
            Breakpoints();
        </script>
        <!-- Facebook Pixel Code -->
        <script>
          !function(f,b,e,v,n,t,s)
          {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
          n.callMethod.apply(n,arguments):n.queue.push(arguments)};
          if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
          n.queue=[];t=b.createElement(e);t.async=!0;
          t.src=v;s=b.getElementsByTagName(e)[0];
          s.parentNode.insertBefore(t,s)}(window, document,'script',
          'https://connect.facebook.net/en_US/fbevents.js');
          fbq('init', '218739138681816');
          fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=218739138681816&ev=PageView&noscript=1"
                   /></noscript>
    <!-- End Facebook Pixel Code -->
  
        <!-- Core  -->
        <script src="https://developer.stringee.com/static/global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
        <script src="https://developer.stringee.com/static/global/vendor/tether/tether.js"></script>
        <script src="https://developer.stringee.com/static/global/vendor/bootstrap/bootstrap.js"></script>
        <script src="https://developer.stringee.com/static/global/vendor/animsition/animsition.js"></script>
        <script src="https://developer.stringee.com/static/global/vendor/mousewheel/jquery.mousewheel.js"></script>
        <script src="https://developer.stringee.com/static/global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
        <script src="https://developer.stringee.com/static/global/vendor/asscrollable/jquery-asScrollable.js"></script>
        <script src="https://developer.stringee.com/static/global/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
        
        

    
        
        <script src="https://developer.stringee.com/static/global/js/State.js"></script>
        <script src="https://developer.stringee.com/static/global/js/Component.js"></script>
        <script src="https://developer.stringee.com/static/global/js/Plugin.js"></script>
        <script src="https://developer.stringee.com/static/global/js/Base.js"></script>
        <script src="https://developer.stringee.com/static/global/js/Config.js"></script>
        <script src="https://developer.stringee.com/static/assets/js/Section/Menubar.js"></script>
        <script src="https://developer.stringee.com/static/assets/js/Section/GridMenu.js"></script>
        <script src="https://developer.stringee.com/static/assets/js/Section/Sidebar.js"></script>
        <script src="https://developer.stringee.com/static/assets/js/Section/PageAside.js"></script>
        <!--<script src="https://developer.stringee.com/static/assets/js/Plugin/menu.js"></script>-->
        <script src="https://developer.stringee.com/static/assets/js/Site.js"></script>
        <!-- Page -->
        <script src="https://developer.stringee.com/static/global/js/Plugin/asscrollable.js"></script>
        <script src="https://developer.stringee.com/static/assets/js/site-custom.js"></script>
        <script src="https://developer.stringee.com/static/assets/js/Plugin/menu.js"></script>
        
       
        
  
  
<!-- Include Required Prerequisites -->
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<link rel="stylesheet" href="https://developer.stringee.com/static/global/vendor/c3/c3.css">
<link rel="stylesheet" href="https://developer.stringee.com/static/global/vendor/select2/select2.css">
<script src="https://developer.stringee.com/static/global/vendor/select2/select2.full.min.js"></script>
<script src="https://developer.stringee.com/static/global/vendor/d3/d3.min.js"></script>
<script src="https://developer.stringee.com/static/global/vendor/c3/c3.min.js"></script>
<script>

    
// //                                      var accountSid = 'AC5ee47206d649ad660e8423f8bb07ede5';
//                                         var accountId = '1595';
//                                         if (1 == 3 
//                                                 || 1 == 2) {
// //                                          accountSid = $('#selectAccount option:selected').val();
//                                             accountId = $('#selectAccount option:selected').val();
//                                         }
//                                         changeAccount();
//                                         function changeAccount() {
//                                             console.log('selectProjectId', $('#selectAccount option:selected').val());
//                                             if (1 == 3                                          || 1 == 2) {
// //                                              accountSid = $('#selectAccount option:selected').val();
//                                                 accountId = $('#selectAccount option:selected').val();
//                                             }
//                                             $.ajax({
//                                                 type: 'post',
//                                                 url: '/report/projectbyaccount',
//                                                 data: {
//                                                     no: 'no',
// //                                                  account_sid: accountSid,
//                                                     account_id: accountId
//                                                 },
//                                                 dataType: 'json',
//                                                 success: function (response) {
//                                                     console.log(response);
//                                                     if (response.status == 500) {
//                                                         console.log('Session expired');
//                                                         window.location.href = "/account/logout";
//                                                     }
                                                    
//                                                     var data = '<option value="">SELECT PROJECT</option>';
//                                                     if (response.length > 0) {

//                                                         response.map((p, k) => {
//                                                             return data += '<option value="' + p.id + '">' + p.name + '</option>';
//                                                         });

//                                                     }
//                                                     $('#selectProjectId').html(data);

//                                                 },
//                                                 error: function (xhr, desc, err) {
//                                                     console.log(xhr);
//                                                     console.log("Details: " + desc + "\nError:" + err);
//                                                 }
//                                             })
//                                         }

                                        $(document).ready(function () {


                                            dateTimeSelect();


                                            function loadChart(posXLabel, posX, posY, maxPosY) {
                                                // Example C3 Simple Line
                                                // ----------------------
                                                var time_series_chart = c3.generate({
                                                    bindto: '#exampleC3TimeSeries',
                                                    data: {
                                                        x: 'x',
                                                        columns: [
                                                            posXLabel,
                                                            posX,
                                                        ]
                                                    },
                                                    //      color: {
                                                    //        pattern: ["#62a8ea"]
                                                    //      },
                                                    padding: {
                                                        right: 40
                                                    },
                                                    axis: {
                                                        x: {
                                                            type: 'timeseries',
                                                            tick: {
                                                                outer: false,
                                                                format: '%Y/%m/%d'
                                                            }
                                                        },
                                                        y: {
                                                            max: maxPosY,
                                                            min: 1,
                                                            tick: {
                                                                outer: false,
                                                                count: posY.length,
                                                                values: posY
                                                            }
                                                        }
                                                    },
                                                    grid: {
                                                        x: {
                                                            show: false
                                                        },
                                                        y: {
                                                            show: false
                                                        }
                                                    }
                                                });
                                            }
                                         
                                            function loadTableCallReports(pageNumber) {
                                                var inputFromNumber = $('#inputFromNumber');
                                                var inputToNumber = $('#inputToNumber');
                                                var selectFromInternal = $('#selectFromInternal');
                                                var selectToInternal = $('#selectToInternal');
                                                var selectProjectId = $('#selectProjectId option:selected');
                                                var inputUserID = $('#inputUserID');
                                                var reportrange = $('#reportrange span').html();
                                                var urlAPI = '<?php echo base_url().'API/Contact';?>';
                                                $.ajax({
//                                                     type: 'post',
//                                                     url: 'admin/callcenter/calllog/',
//                                                     data: {
//                                                         'id'
//                                                         // 'inputFromNumber': inputFromNumber.val(),
//                                                         // 'inputToNumber': inputToNumber.val(),
//                                                         // 'inputUserID': inputUserID.val(),
//                                                         // 'selectFromInternal': selectFromInternal.val(),
//                                                         // 'selectToInternal': selectToInternal.val(),
//                                                         // 'selectProjectId': selectProjectId.val(),
//                                                         // 'reportrange': reportrange,
//                                                         // 'pageNumber': pageNumber,
// //                                                      accountSid: accountSid,
//                                                       //  accountId: accountId,
//                                                         //isVideocall: $('#isVideocall option:selected').val()
//                                                     },
//                                                     dataType: 'json',
                                                        type: 'GET',
                                                         url: urlAPI,
                                                           dataType:"json",
                                                     success: function (response) {
                                                        console.log(response);
                                                        // if (response.status == 500) {
                                                        //     console.log('Session expired');
                                                        //     window.location.href = "/account/logout";
                                                        // }
                                                        var phoneCalls = response.items;
                                                        var page = response.currentPage;
                                                        var totalPage = response.totalPages;
                                                        var totalCount = response.data.total;
                                                        $("#tableCalls tbody").empty();
                                                        var dataInsertTable = loopDataCall(phoneCalls);
                                                        $("#tableCalls tbody").append(dataInsertTable);

                                                        console.log('page A: ' + totalPage);


                                                        loopDataPagination(totalPage);

                                                        // ADD DATA TO CHART
                                                        $('.countSearch,.totalCalls').html(totalCount);
                                                        $('.totalMinutes').html(response.data.callSum);

                                                        var callByDay = response.data.callByDay;
                                                        console.log(response);
                                                        var posXLabel = ['x'];
                                                        var posX = ['Number of calls'];
                                                        var maxPosY;

                                                        $.each(callByDay, function (key, value) {
                                                            posXLabel.push(callByDay[key].created_datetime);
                                                            posX.push(callByDay[key].total);
                                                        })
                                                        if (posX.slice(1) == 0) {
                                                            maxPosY = 0;
                                                        } else {
                                                            maxPosY = posX.slice(1).reduce(function (a, b) {
                                                                return Math.max(a, b);
                                                            });
                                                        }

//                  console.log(posXLabel);
//                  console.log(posX);

                                                        loadChart(posXLabel, posX, posX.slice(1), maxPosY);

                                                    },
                                                    beforeSend: function () {
                                                        $(".overlayAjax").LoadingOverlay("show");
                                                    }, // <Show OverLay
                                                    complete: function () {
                                                        $(".overlayAjax").LoadingOverlay("hide");
                                                    }, //<Hide Overlay
                                                    error: function (xhr, desc, err) {
                                                        console.log(xhr);
                                                        console.log("Details: " + desc + "\nError:" + err);
                                                    }
                                                })

                                            }

                                            function loopDataCall(dataResponse) {

                                                var data = '';
                                                var type = '';
                                                var answer_time;

                                                $.each(dataResponse, function (key, value) {
                                                   
                                                     if (dataResponse[key].direction == 3 ) {
                                                        type = "<img src='https://developer.stringee.com/static/assets/images/icon-in2ex.png' class='icon-call' />";
                                                    } else {
                                                         type = "<img src='https://developer.stringee.com/static/assets/images/icon-ex2in.png' class='icon-call' />";
                                                    }

                                                    // if (dataResponse[key].answer_time === 0) {
                                                    //     answer_time = '';
                                                    // } else {
                                                    //     answer_time = dataResponse[key].answer_time_datetime;
                                                    // }
                                                    // var btn_download = "<span style='color:#adadad'>No</span>";
                                                    // if (Boolean(dataResponse[key].recorded)) {
                                                    //     btn_download = "<td> <a href='"+dataResponse[key].recording_url+"' target='_blank' >Mở file</a></td>";
                                                    // }
                                                   var timestamp = new Date(dataResponse[key].time_started*1000);
                                                    timestamp = moment(timestamp).format("dddd MMMM-DD-YYYY HH:mm:ss");

                                                     var timestamp1 = new Date(dataResponse[key].time_connected*1000);
                                                    timestamp1 = moment(timestamp1).format("dddd MMMM-DD-YYYY HH:mm:ss");

                                                     var timestamp2 = new Date(dataResponse[key].time_ended*1000);
                                                    timestamp2 = moment(timestamp2).format("dddd MMMM-DD-YYYY HH:mm:ss");
                                                    data += "<tr>" +
                                                            "<td>" + dataResponse[key].cdr_id + "</td>" +
                                                           "<td>" + type + "</td>" +
                                                            
                                                            "<td class='fromNumber'>" + dataResponse[key].from_number + "</td>" +
                                                            "<td class='toNumber'>" + dataResponse[key].to_number + "</td>" +
                                                            "<td>" + dataResponse[key].duration + "</td>" +
                                                            "<td><a href='"+dataResponse[key].recording_url+"' target='_blank' >Mở file</a></td>" +
                                                            // "<td>"+timestamp+"</td>" +
                                                            "<td>"+timestamp1+"</td>" +
                                                            "<td>"+timestamp2+"</td>" 

                                                          
                                                });
                                                return data;
                                            }

                                            function loopDataPagination(totalPage) {
                                                if (totalPage > 0) {
                                                    //          $('#paginationCall').twbsPagination('destroy');
                                                    $('#paginationCall').twbsPagination({
                                                        totalPages: totalPage,
                                                        visiblePages: 10,
                                                        pageClass: 'page-item btnPagination',
                                                        next: 'Next',
                                                        prev: 'Prev',
                                                        onPageClick: function (event, page) {
                                                            loadTableCallReports(page);
                                                        }
                                                    });
                                                }
                                            }

                                            enterInput($('#inputFromNumber'), $('#btnSearchCall'));
                                            enterInput($('#inputToNumber'), $('#btnSearchCall'));
                                            enterInput($('#inputUserID'), $('#btnSearchCall'));

                                            $('#inputFromNumber, #inputToNumber').keypress(function (e) {
                                                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                                                    return false;
                                                }
                                            })



                                            loadTableCallReports();

                                            // CLICK SEARCH
                                            $('#btnSearchCall').click(function () {
                                                $('#paginationCall').twbsPagination('destroy');
                                                loadTableCallReports();

                                            });

                                            $(document).on('click', '.btnPagination', function () {
                                                var page = $(this).find('.page-link').text();
                                                loadTableCallReports(page);
                                            });

                                            function dateTimeSelect() {
                                                // DATE TIME SELECT
                                                var start = moment().subtract(29, 'days');
                                                var end = moment();
                                                function cb(start, end) {
                                                    $('#reportrange span').html(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
                                                    $('.dateRange').html(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
                                                }
                                                $('#reportrange').daterangepicker({
                                                    autoUpdateInput: '',
                                                    locale: {
                                                        cancelLabel: 'Clear'
                                                    },
                                                    startDate: start,
                                                    endDate: end,
                                                    ranges: {
                                                        'Today': [moment(), moment()],
                                                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                                                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                                                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                                                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],

                                                    }
                                                }, cb);
                                                cb(start, end);

                                                $('#reportrange span').html(moment().startOf('month').format('YYYY/MM/DD') + ' - ' + moment().endOf('month').format('YYYY/MM/DD'));
                                                $('#btnResetDateRange').click(function () {
                                                    $('#reportrange span').html('YYYY/MM/DD - YYYY/MM/DD');
                                                    $('.dateRange').html('All dates');
                                                });
                                            }


                                        })
                                        
    function checkSession(){
        console.log('go hêre');
    }
</script>

  
  <!-- <script>
    function getInfo(){
            $.ajax({
                url: '/account/getinfo',
                type: 'post',
                data: 
                {
                    email : 'buibao947@gmail.com',
                    account_sid : 'AC5ee47206d649ad660e8423f8bb07ede5'
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.status == 200) {
                        var trial_account = response.data.trial_account;
                        var date_left = response.data.date_left;
    
                        if(trial_account == -1){
                            var htmlTrialAccount = "<img class='close_expired' src='https://developer.stringee.com/static/assets/images/icon/error.svg' width='20' />"+
                                                    "Your trial period has expired. You can upgrade or contact&nbsp;<a href='https://stringee.com/contact-sales' target='_blank'>sales@stringee.com</a>&nbsp;for more information.";                    
                            $('.alertTrial').addClass('p_expired');
                            $('.alertTrial').append(htmlTrialAccount);      
                        }
                        
                        if(trial_account == 1 && date_left >0){
                            
                            $('#text_free').html("<div class='info_free'>During your trial you can buy 1 number for free. <a href='javascript:void(0)' id='btnGetFreeNumber' >Get your free number</a></div>")
                            
                            var text_day = 'days';
                            if(date_left == 1){
                                text_day = 'day';
                            }
                            var htmlDayLeft = "<a class='nav-link font-weight-400' target='_blank' href='javascript:void(0)' aria-expanded='false'" +
                                                    "data-animation='scale-up' role='button'>"+
                                                    "<span class='text-danger'>"+date_left+"</span> "+text_day+" left in trial"+
                                                "</a>";
                            $('.item-left-trial').append(htmlDayLeft);
                        }
                        
                        if(trial_account !== 0){
                            var htmlBtnUpgrade = "<li class='nav-item dropdown font-weight-400' id='btnUpgrade'>"+
                                                        "<a class='nav-link text-warning' href='/payment' aria-expanded='false'"+
                                                           "data-animation='scale-up' role='button'>"+
                                                            "<i class='icon mr-5'><img src='https://developer.stringee.com/static/assets/images/icon/diamond.svg' width='20' /></i>"+
                                                            "UPGRADE"+
                                                        "</a>"+
                                                 "</li>";
                            $('.btn-upgrade').append(htmlBtnUpgrade);
                        }
                        
                        
                    }
                },
                error: function (xhr, desc, err) {
                    console.log(xhr);
                    console.log("Details: " + desc + "\nError:" + err);
                }});
        }
        getInfo();
  </script>
  
 -->
  <script>
  (function(document, window, $) {
    'use strict';
    var Site = window.Site;
    $(document).ready(function() {
      Site.run();
    });
  })(document, window, jQuery);
  </script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-111461280-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-111461280-1');
    gtag('config', 'AW-810064151');
  </script>
  
  

