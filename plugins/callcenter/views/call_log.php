<?php init_head(); ?>
<div id="wrapper">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
       <div class="panel_s">
          <div class="panel-body">
       <div class="col-lg-12">
                <!-- Example Panel With Heading -->
                <div class="panel panel-bordered overlayAjax">
                    <div class="panel-heading">
                        <h3 class="panel-title">Call Reports</h3>
                        
                    </div>
                    <div class="panel-body">
                        <!-- <?php //echo form_open("admin/callcenter/searchCall");?> -->
                        <form class="form-inline" id="formSearchCallReport">
                                      
                           <!--  <div class="form-group">
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
                            </div> -->
                                <div class="form-group">
                               
                                    <!--<label class="form-control-label" for="inputFromNumber">From</label>-->
                                    <input type="text" class="form-control" id="inputFromNumber" name="inputFromNumber" placeholder="From: ex 84988889998" autocomplete="off">
                               
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
                        </form>



                       <!--  <?php //echo form_close();?> -->
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

                   
                      <!--   <div class="row">
                            <div class="col-lg-12 text-right wrapPagination">
                                <ul id='paginationCall'></ul>
                            </div>
                        </div> -->
                    </div>
                </div>
                <!-- End Example Panel With Heading -->
            </div>
    </div>
    </div>
        <div class="panel_s">
          <div class="panel-body">
            <?php if(isset($consent_purposes)) { ?>
            <div class="row mbot15">
              <div class="col-md-3 contacts-filter-column">
               <div class="select-placeholder">
                <select name="custom_view" title="<?php echo _l('gdpr_consent'); ?>" id="custom_view" class="selectpicker" data-width="100%">
                 <option value=""></option>
                 <?php foreach($consent_purposes as $purpose) { ?>
                <option value="consent_<?php echo $purpose['id']; ?>">
                  <?php echo $purpose['name']; ?>
                </option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <?php } ?>
        <div class="clearfix"></div>
        <?php
       $table_data = array();

       
       $table_data =  array(
       //   <td>ID</td>
       //  <td><?php echo _l('direction');
       //  <td><?php echo _l('from_number');
       //  <td><?php echo _l('to_number');
       //  <td><?php echo _l('time_duration');
       //  <td><?php echo _l('recording');
          'ID',
        _l('direction'),
       _l('from_number'),
        _l('to_number'),
        _l('time_duration'),
       _l('recording'),
        _l('time_connected'),
        _l('time_ended'),

      );

      //  $custom_fields = get_custom_fields('contacts',array('show_on_table'=>1));

      //  foreach($custom_fields as $field){
  
      //         array_push($table_data,$field['name']);
      // }
      render_datatable($table_data,'call_logs');
      ?>
    </div>
   
  </div>
</div>
</div>
</div>
</div>
<?php init_tail(); ?>
 
      <!-- Core -->
        <link rel="stylesheet" href="https://developer.stringee.com/static/assets/css/site-custom.css">
  
        <script src="https://developer.stringee.com/static/assets/js/jquery.twbsPagination.min.js"></script>
      
        <script src="https://developer.stringee.com/static/global/vendor/bootstrap/bootstrap.js"></script>
        <script src="https://developer.stringee.com/static/global/vendor/animsition/animsition.js"></script>

        <script src="https://developer.stringee.com/static/assets/js/Site.js"></script>
        <!-- Page -->
    
        <script src="https://developer.stringee.com/static/assets/js/site-custom.js"></script>
   
<!-- Include Required Prerequisites -->
<!-- <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> -->
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<link rel="stylesheet" href="https://developer.stringee.com/static/global/vendor/c3/c3.css">
<link rel="stylesheet" href="https://developer.stringee.com/static/global/vendor/select2/select2.css">
<script src="https://developer.stringee.com/static/global/vendor/select2/select2.full.min.js"></script>
<script src="https://developer.stringee.com/static/global/vendor/d3/d3.min.js"></script>
<script src="https://developer.stringee.com/static/global/vendor/c3/c3.min.js"></script>
<?php $this->load->view('admin/clients/client_js'); ?>
<script>
 $(function(){
  var optionsHeading = [];
  var allContactsServerParams = {
   "custom_view": "[name='custom_view']",
 }
 <?php if(is_gdpr() && get_option('gdpr_enable_consent_for_contacts') == '1'){ ?>
  optionsHeading.push($('#th-consent').index());
  <?php } ?>
  _table_api = initDataTable('.table-call_logs', window.location.href, optionsHeading, optionsHeading, allContactsServerParams, [0,'asc']);
  if(_table_api) {
   <?php if(is_gdpr() && get_option('gdpr_enable_consent_for_contacts') == '1'){ ?>
    _table_api.on('draw', function () {
      var tableData = $('.table-call_logs').find('tbody tr');
      $.each(tableData, function() {
        $(this).find('td:eq(2)').addClass('bg-light-gray');
      });
    });
    $('select[name="custom_view"]').on('change', function(){
      _table_api.ajax.reload()
      .columns.adjust()
      .responsive.recalc();
    });
    <?php } ?>
  }
});
</script>
<script>


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
                                                        var phoneCalls = response.data.total;
                                                        var page = 1;
                                                        var totalPage = 3;
                                                        var totalCount = response.data.totalCount;
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

                                                // var data = '';
                                                // var type = '';
                                                // var answer_time;

                                                // $.each(dataResponse, function (key, value) {
                                                   
                                                //      if (dataResponse[key].direction == 3 ) {
                                                //         type = "<img src='https://developer.stringee.com/static/assets/images/icon-in2ex.png' class='icon-call' />";
                                                //     } else {
                                                //          type = "<img src='https://developer.stringee.com/static/assets/images/icon-ex2in.png' class='icon-call' />";
                                                //     }

                                                //     // if (dataResponse[key].answer_time === 0) {
                                                //     //     answer_time = '';
                                                //     // } else {
                                                //     //     answer_time = dataResponse[key].answer_time_datetime;
                                                //     // }
                                                //     // var btn_download = "<span style='color:#adadad'>No</span>";
                                                //     // if (Boolean(dataResponse[key].recorded)) {
                                                //     //     btn_download = "<td> <a href='"+dataResponse[key].recording_url+"' target='_blank' >Mở file</a></td>";
                                                //     // }
                                                //    // var timestamp = new Date(dataResponse[key].time_started*1000);
                                                //    //  timestamp = moment(timestamp).format("dddd MMMM-DD-YYYY HH:mm:ss");

                                                //    //   var timestamp1 = new Date(dataResponse[key].time_connected*1000);
                                                //    //  timestamp1 = moment(timestamp1).format("dddd MMMM-DD-YYYY HH:mm:ss");

                                                //    //   var timestamp2 = new Date(dataResponse[key].time_ended*1000);
                                                //    //  timestamp2 = moment(timestamp2).format("dddd MMMM-DD-YYYY HH:mm:ss");
                                                //     data += "<tr>" +
                                                //             "<td>" + dataResponse[key].cdr_id + "</td>" +
                                                //            "<td>" + type + "</td>" +
                                                            
                                                //             "<td class='fromNumber'>" + dataResponse[key].from_number + "</td>" +
                                                //             "<td class='toNumber'>" + dataResponse[key].to_number + "</td>" +
                                                //             "<td>" + dataResponse[key].duration + "</td>" +
                                                //             "<td><a href='"+dataResponse[key].recording_url+"' target='_blank' >Mở file</a></td>" +
                                                //             // "<td>"+timestamp+"</td>" +
                                                //             "<td>"+dataResponse[key].time_connected+"</td>" +
                                                //             "<td>"+dataResponse[key].time_ended+"</td>" 

                                                          
                                                // });
                                                // return data;
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
</body>
</html>
