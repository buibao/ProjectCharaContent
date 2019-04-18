!function () {
	ready(function () {
		// CHECK BROWSER SUPPORT WEBRT + SOCKET;
		if (!isSupportWebrtc()) {
			return;
		}
		

//		 var h = "http://127.0.0.1/stringee/softphone/softphone-sdk-intergrate/";
//		var h = "https://test3.stringee.com/softphone-sdk-intergrate/"; //test3
		var h = "https://v2.stringee.com/softphone-sdk-intergrate/"; //v2

		console.log(toNumberHead);
        console.log(fromNumberHead);
        // DATA fromNumber
		var fromNumber = fromNumberHead;
		// DUNG APP_ID REQUETS LEN SERVER LAY DU LIEU VE
		 // DATA toNumber
		var toNumber = toNumberHead;
		
		// var testnum = window.stringeeSettings.testnum;
		var app_id = window.stringeeSettings.app_id;
		console.log(toNumber);
		var require_info = window.stringeeSettings.require_info;
		var require_phone_number = window.stringeeSettings.require_phone_number;
		var app_background = window.stringeeSettings.app_background || '';
		var app_style = window.stringeeSettings.app_style || '';
		var button_background = window.stringeeSettings.button_background || "#13c248";
		var language = window.stringeeSettings.language || 'vn';
		var position_left = window.stringeeSettings.position_left;
		var position_right = window.stringeeSettings.position_right;
		var position_top = window.stringeeSettings.position_top;
		var position_bottom = window.stringeeSettings.position_bottom || '30px';
		var info_name = window.stringeeSettings.info_name || '';
		var info_phone_number = window.stringeeSettings.info_phone_number || '';
		var stringee_text_welcome = '';
		var stringee_text_call_free_text_introduce = '';
		var stringee_text_call_free_text_free = '';
		var text_please_connect = '';
		var text_calling = '';
		var text_login = '';
		var text_logout = '';
		var text_your_name = '';
		var text_your_phone = '';
		var text_call_now = '';
		var text_please_full_fill = '';
		var text_phone_number_incorrect = '';
		var text_thankyou = '';
		var text_end_call = '';
		var text_err_notallow = '';
		var text_err_notsupportsocket = '';
		var text_please_allow_mic = '';
		
		// STRINGEE NOT SUPPORT OUT OF 9AM - 18PM
		var d = new Date();
		var hour = d.getHours();
		// if(hour  9 ){
		// 	if(app_id == "stringee_99"){
		// 		console.log('Sorry, We only support call from 9AM - 18PM');
		// 		return;
		// 	}
		// }
		
		
		if (!require_info) {
			setCookie('__stringee_id', '', 0);
			setCookie('__stringee_phone', '', 0);
			setCookie('__stringee_name', '', 0);
		}

		// switch (app_id) {
		// 	case 'adayroi_99':
		// 		toNumber = "842439759568";
		// 		break;
			
		//    default:
		// 		toNumber = "0328947019";
		// }


		switch (language) {
			case 'en':
				stringee_text_welcome = "Sales consultant";
				stringee_text_call_free_text_introduce = "A free calling application";
				stringee_text_call_free_text_free = "100% FREE";
				text_please_connect = "Please connect headset to chat <br> (Or the system will use speakers and microphone on your device).";
				text_calling = "Calling...";
				text_login = 'Login';
				text_logout = 'Logout';
				if(app_id == "stringee_99"){
					text_your_name = 'Your email';
				}else{
					text_your_name = 'Your name';
				}
				text_your_phone = 'Your phone';
				text_call_now = 'Call now';
				text_please_full_fill = 'Please complete all information';
				text_phone_number_incorrect = 'The phone number is incorrect';
				text_thankyou = "Thank you, For assistance, please contact us through this application or call <strong>" + formatPhoneNumberForEndUser(toNumber) + "</strong>";
				text_end_call = 'End call';
				text_err_notallow = 'Please allow the website to access your microphone to use the calling app';
				text_err_notsupportsocket = 'Your browser does not support websocket. Please upgrade your browser or change your browser. Detailed browser support at <a href="https://caniuse.com/#feat=websockets"> here </a>.';
				text_please_allow_mic = 'Please allow the website to access your microphone';
				break;
			default:
				stringee_text_welcome = "Tư vấn bán hàng";
				if(app_id == "abay_99"){
					stringee_text_welcome = "TỔNG ĐÀI HỖ TRỢ 24/7"
				}
				if(app_id == "luxstay_99"){
					stringee_text_welcome = "Chăm sóc khách hàng"
				}
				stringee_text_call_free_text_introduce = "Đây là ứng dụng gọi điện thoại";
				stringee_text_call_free_text_free = "HOÀN TOÀN MIỄN PHÍ";
				text_please_connect = "Vui lòng kết nối tai nghe để trò chuyện <br>(Hoặc hệ thống sẽ sử dụng loa và microphone trên thiết bị của bạn).";
				text_calling = "Đang gọi...";
				text_login = 'Đăng nhập';
				text_logout = 'Đăng xuất';
				if(app_id == "stringee_99"){
					text_your_name = 'Email của bạn';
				}else{
					text_your_name = 'Tên của bạn';
				}
				text_your_phone = 'Số điện thoại';
				text_call_now = 'Gọi ngay';
				text_please_full_fill = 'Vui lòng điền đầy đủ thông tin';
				text_phone_number_incorrect = 'Số điện thoại không đúng';
				text_thankyou = "Cảm ơn quý khách, Để được hỗ trợ,<br>vui lòng liên hệ qua ứng dụng này <br>hoặc gọi <strong>" + formatPhoneNumberForEndUser(toNumber) + "</strong>";
				text_end_call = 'Kết thúc cuộc gọi';
				text_err_notallow = 'Vui lòng cho phép website truy cập microphone của bạn để sử dụng ứng dụng gọi điện';
				text_err_notsupportsocket = "Trình duyệt của bạn không hỗ trợ websocket. Bạn vui lòng nâng cấp trình duyệt hoặc thay đổi trình duyệt khác. Chi tiết trình duyệt hỗ trợ xem tại <a href='https://caniuse.com/#feat=websockets'>đây</a>";
				text_please_allow_mic = 'Vui lòng cho phép website truy cập microphone của bạn';
		}

		var client;

//		if (app_id === 'mediamart_99' && objStringeeAccountCall) {
//			fromNumber = objStringeeAccountCall.phone;
//		}
		var username = app_id + '_' + randomUserId();
		var call;
		 var access_token ='eyJjdHkiOiJzb2Z0cGhvbmU7dj0xIiwidHlwIjoiSldUIiwiYWxnIjoiSFMyNTYifQ.eyJqdGkiOiJTSzdGdTZUQ2tnVWJyOVQyUm5yQU9LaUFZMU9EcFE3UXNKLTE1NDA0NTAwODgiLCJpc3MiOiJTSzdGdTZUQ2tnVWJyOVQyUm5yQU9LaUFZMU9EcFE3UXNKIiwiZXhwIjoxNTQzMDQyMDg4LCJ1c2VySWQiOiJWUEJYX0NUVFRfMTAwIiwidXNlcm5hbWUiOiJWUEJYX0NUVFQiLCJhY2NvdW50SWQiOjIwN30.xGPwVZ_IyiRpdgiYUUyxZautrNOSByIbHog-boILG4w';
		var prefix = window.stringeeSettings.from_number_prefix ? window.stringeeSettings.from_number_prefix : '';
		var btn_size = window.stringeeSettings.btn_size ? window.stringeeSettings.btn_size : '';
		var your_name = '';
		var your_phone = '';
		var width = window.innerWidth
				|| document.documentElement.clientWidth
				|| document.body.clientWidth;

		var checkDevice;
		if (/Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
			checkDevice = "mobile";
			//console.log('mobile');
		} else {
			checkDevice = "pc";
			//console.log('pc');
		}
		var iframe;

		//	 Create <video id="remoteVideo" autoplay playsinline width="350px"  ></video>
		_createVideoTag();

		// Create Iframe Stringee
		_createIframe();

		//Add doctype HTML5
		_addDOCTYPE_HTML5()

		// Load CSS insert vao website

		getCORS(h + 'css/style.css', function (request) {
			var cssLink;
			var response = request.currentTarget.response || request.target.responseText;
			cssLink = document.createElement("style");
			cssLink.innerHTML = response;
			frames['stringee-container-iframe'].document.head.appendChild(cssLink);

			// Get HTML to Insert
			var htmlIframe = document.createElement('div');
			htmlIframe.id = 'wrap-stringee-iframe';
			htmlIframe.innerHTML = htmlButton();
			frames['stringee-container-iframe'].document.body.appendChild(htmlIframe);


			// KIEM TRA SOCKET IO VERSION < 1 => INSERT NEW SOCKET IO
			var scriptSocket = document.createElement("script");
			scriptSocket.type = 'text/javascript';
			scriptSocket.src = h + 'js/lib/socket.io-2.0.3.js';
			scriptSocket.src = stringURL ;
			var checkIO = true;
			if (typeof io == "undefined") {
				//			console.log('Your site not have socket');
				checkIO = false
			} else {
				if (typeof io.version != "undefined") {
					checkIO = false
					//				console.log('Version', io.version);
					//				console.log('Version', io.version.charAt(0));
				} else {
					var checkIO = true;
					//				console.log('io', io);
				}
			}

			if (checkIO == false) {
				document.getElementsByTagName('head')[0].appendChild(scriptSocket);
				scriptSocket.onload = function () {
					loadStringeeSDK();
				}
			} else {
				loadStringeeSDK();
			}
		});

		function loadStringeeSDK() {
			var scriptSDK = document.createElement("script");
			scriptSDK.type = 'text/javascript';
			scriptSDK.src = h + 'js/StringeeSDK-1.3.2.js';
			document.getElementsByTagName('head')[0].appendChild(scriptSDK);
			scriptSDK.onload = function () {

				// HIEN THI BUTTON 
				stateCall('load');


				var id_stringee_button_save_info = window.frames['stringee-container-iframe']
						.document.getElementById('stringee_button_save_info');
				var id_stringee_input_your_name = window.frames['stringee-container-iframe']
						.document.getElementById('stringee_input_your_name');
				var id_stringee_input_your_phone = window.frames['stringee-container-iframe']
						.document.getElementById('stringee_input_your_phone');
				var class_stringee_keypad_start_call = window.frames['stringee-container-iframe']
						.document.querySelector('.stringee-keypad .keypad-key.start-call');
				//LABEL LOGOUT
				var id_stringee_btn_logout_label = window.frames['stringee-container-iframe']
						.document.querySelector('#stringee_wrap_logout_login label.label_logout');
				//LABEL LOGIN
				var id_stringee_btn_login_label = window.frames['stringee-container-iframe']
						.document.querySelector('#stringee_wrap_logout_login label.label_login');
				var class_stringe_intergrate_button_container = window.frames['stringee-container-iframe']
						.document.getElementsByClassName('stringe-intergrate-button-container')[0];
				var class_stringee_intergrate_panel = window.frames['stringee-container-iframe'].document
						.getElementsByClassName('stringee-intergrate-panel')[0];
				var class_stringee_label_powered = document.getElementById('stringee-container-iframe').
						contentWindow.document.getElementsByClassName('stringee-label-powered')[0];
				class_stringee_intergrate_panel.style.background = app_background;
				// VERSION MOBILE
				if (width <= 500 || checkDevice == "mobile") {
					class_stringee_intergrate_panel.style.width = "90%";
					class_stringee_intergrate_panel.style.height = "95%";
					class_stringee_intergrate_panel.style.top = "0";
					class_stringee_intergrate_panel.style.right = "0";
					class_stringee_intergrate_panel.style.padding = "5%";
					class_stringee_intergrate_panel.style.setProperty("border-radius", "0", "important");

					class_stringee_label_powered.style.bottom = "10px";
				}


				class_stringe_intergrate_button_container.addEventListener('click', function () {
					// <meta name="viewport" />
					toNumber = toNumberHead;
					fromNumber = fromNumberHead;
					console.log(toNumber);
					console.log(fromNumber);

					stateCall('welcome');
					
						connectGetToken();
					
				});


				//CLICK DE DANG NHAP
				var class_stringee_keypad_start_call_login = window.frames['stringee-container-iframe']
						.document.querySelector('.stringee-keypad .keypad-key.start-call-login');
				class_stringee_keypad_start_call_login.addEventListener('click', function () {
					stateCall('require_info');
				});
				id_stringee_btn_login_label.addEventListener('click', function () {
					class_stringee_keypad_start_call_login.click();
				})

				//CREATE LABEL ERROR
				var stringee_label = document.createElement('label');
				stringee_label.className = 'stringe_label_error';

				if (id_stringee_button_save_info) {
					id_stringee_button_save_info.addEventListener('click', function () {
						your_name = id_stringee_input_your_name.value;
						your_phone = id_stringee_input_your_phone.value;
						var err = false;
						var err_log = '';
						if (your_name === '') {
							if (require_phone_number) {
								err_log = text_please_full_fill;
								err = true;
								stringee_label.innerHTML = err_log;
								insertBefore(stringee_label, id_stringee_input_your_name);
								return;
							}
						}
						if (your_phone === '' ||
								isNaN(your_phone) ||
								your_phone.length < 10 ||
								your_phone.length > 13
								) {
							if (require_phone_number) {
								err_log = text_phone_number_incorrect;
								err = true;
								stringee_label.innerHTML = err_log;
								insertBefore(stringee_label, id_stringee_input_your_name);
								return;
							}

						}
//						stringee_label.innerHTML = '';
						setCookie('__stringee_id', randomUserId(), 1);
						setCookie('__stringee_name', your_name, 1);
						setCookie('__stringee_phone', your_phone, 1);
						class_stringee_keypad_start_call.click();
					});
				}


				if (id_stringee_btn_logout_label) {
					id_stringee_btn_logout_label.addEventListener('click', function () {
						if (call) {
							hangUpCall();
						}
						stateCall('logout');
					});
				}




				var class_stringee_close = window.frames['stringee-container-iframe']
						.document.getElementsByClassName('stringee-close')[0];
				class_stringee_close.addEventListener('click', function () {
					toNumber='Hello';
					stateCall('close');
				})


				var class_stringee_keypad_keypad_key = window.frames['stringee-container-iframe']
						.document.querySelectorAll('.stringee-keypad .keypad-key');
				for (var i = 0; i < class_stringee_keypad_keypad_key.length; i++) {
					class_stringee_keypad_keypad_key[i].addEventListener('click', function () {
						sound('beep');
					});
				}

				// CLICK NUT CALL
				class_stringee_keypad_start_call.addEventListener('click', function (e) {


					if (navigator && navigator.permissions) {
						navigator.permissions.query({name: 'microphone'}).then(function (permissionStatus) {
							if (permissionStatus.state == "prompt") {
								pageRequestMicPhone();
							}
						})
					}

//					
//					return;
					if (hasClass(class_stringee_keypad_start_call, 'stringee-button-disabled')) {
						e.preventDefault();
						// console.log('Button Call Disabled');
					} else {
						setTimeout(function () {
							addClass(class_stringee_keypad_start_call, 'stringee-button-disabled');
						}, 100)
						if (call) {
							hangUpCall();
						
						}

						var id_stringee_input_your_phone = window.frames['stringee-container-iframe']
								.document.getElementById('stringee_input_your_phone');

						var your_name = id_stringee_input_your_name.value;
						var your_phone = id_stringee_input_your_phone.value;
						if (app_id == "mediamart_99" || app_id == "abay_99" || app_id == "cogo_99" || app_id == "luxstay_99" || app_id == "edoctor_99") {
							fromNumber = checkCookie('__stringee_id') ? 
									prefix + getCookie('__stringee_phone') : 
									prefix + your_phone;
						}

						if(app_id == "luxstay_99" && !require_info && info_name && info_phone_number){
							fromNumber = prefix + info_name + '_' + info_phone_number;
						}
						makeCall();

// if(toNumber==='Hello'){
// console.log('Test MAKE CALL');
// // id wrap-softphone-demo
// }else{
// 		
// }
					
					}


				});



				var class_stringee_keypad_keypad_end_call = window.frames['stringee-container-iframe'].document.
						querySelector('.stringee-keypad .keypad-key.end-call');
				class_stringee_keypad_keypad_end_call.addEventListener('click', function () {
					stateCall('endcall');

					hangUpCall();
					
				})


				var class_stringee_send_dtmf_keypad_key = window.frames['stringee-container-iframe'].document.
						querySelectorAll('.stringee-send-dtmf .keypad-key');
				for (var i = 0; i < class_stringee_send_dtmf_keypad_key.length; i++) {
					class_stringee_send_dtmf_keypad_key[i].addEventListener('click', function (e) {
						var key = e.target.dataset.key;
						call.sendDtmf(key, function (res) {
							// console.log('sendDtmf res', res);
						});
					});
				}

			}
		}


		function _createVideoTag() {
			var video = document.createElement('video');
			video.id = "remoteVideo";
			video.setAttribute("autoplay", "");
			video.setAttribute("playsinline", "");
			video.width = 100;
			video.style.display = "none";
			document.body.appendChild(video);
		}
		function _createIframe() {
			iframe = document.createElement("iframe");
			iframe.id = 'stringee-container-iframe';
			iframe.name = 'stringee-container-iframe';
			iframe.src = 'javascript:void(0)';
			iframe.width = 140;
			iframe.height = 140;
			iframe.style.border = "none";
			iframe.style.position = "fixed";
			iframe.style.setProperty("right","0");
			iframe.style.setProperty("bottom", position_bottom);
			iframe.style.setProperty('z-index', '100000000000'); //subiz 16000001
			if (app_id == 'stringee_99') {
				iframe.style.setProperty("bottom", "80px");
			}

			if (app_id == "abay_99") {
				iframe.style.setProperty("width", "140px");
				iframe.style.setProperty("height", "160px");
			}

			// TRUONG HOP DAC BIET DEVICE MOBILE; FORCE DESKTOP
			if (checkDevice == "mobile" && width > 500) {
				iframe.style.setProperty('z-index', '16000001'); //subiz 16000001
				iframe.style.setProperty("width", "366px");
				iframe.style.setProperty("height", "366px");
				iframe.style.setProperty("bottom", "150px");
			}
			document.body.appendChild(iframe);
		}

		function _addDOCTYPE_HTML5() {
			//Add doctype HTML5
			var idocument = iframe.contentDocument;
			idocument.open();
			idocument.write("<!DOCTYPE html>");
			idocument.close();
		}

		function _createMetaTagViewport() {
			var meta = document.createElement("meta");
			meta.id = "stringee-tag-viewport";
			meta.name = "viewport";
			meta.content = "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1";

			document.getElementsByTagName('head')[0].appendChild(meta);

			setTimeout(function () {
				document.getElementsByTagName('body')[0].style.setProperty('position', 'fixed');
				document.getElementsByTagName('body')[0].style.setProperty('overflow-y', 'hidden');
				document.getElementsByTagName('body')[0].style.setProperty('margin-top', '-0px');
			}, 100)
		}



		function connectGetToken() {
			// var url_token;
			// if (window.stringeeSettings.app_id == 'mediamart_99') {
			// 	url_token = "https://v1.stringee.com/test_mediamart/access_token/gen_access_token.php?userId=";
			// } else if (app_id == "abay_99") {
			// 	url_token = "https://v1.stringee.com/dev_urls/access_token/gen_access_token_abay.php?userId=";
			// } else if(app_id == "cogo_99"){
			// 	url_token = "https://v1.stringee.com/dev_urls/access_token/gen_access_token_cogovip.php?userId=";
			// } else if(app_id == "luxstay_99"){
			// 	url_token = "https://v1.stringee.com/dev_urls/access_token/gen_access_token_luxstay.php?userId=";
			// } else if(app_id == "edoctor_99"){
			// 	url_token = "https://v1.stringee.com/dev_urls/access_token/gen_access_token_edoctor.php?userId=";
			// } else if(app_id == "tatana_99"){
			// 	url_token = "https://v1.stringee.com/dev_urls/access_token/gen_access_token_tatana.php?userId=";
			// }else{
			// 	url_token = "https://v1.stringee.com/samples_and_docs/access_token/gen_access_token.php?userId=";
			// }

		
				
				 console.log(access_token);
				client = new StringeeClient();

				client.connect(access_token);

				client.on('connect', function () {
					 console.log('++++++++++++++ connected to StringeeServer Widget');
				});

				client.on('authen', function (res) {
					 console.log('authen', res);
					stateCall('authen');
				});

				client.on('disconnect', function () {
					 console.log('++++++++++++++ disconnected');
				});

				// client.on('incomingcall', function (incomingcall) {
				// 	call = incomingcall;
				// 	settingCallEvents(incomingcall);

				// 	var answer = confirm('Incoming call from Widget: ' + incomingcall.fromNumber + ', do you want to answer?');

				// 	if (answer) {
				// 		call.answer(function (res) {
				// 			 console.log('answer res', res);
				// 		});
				// 	} else {
				// 		call.reject(function (res) {
				// 			 console.log('reject res', res);
				// 		});
				// 	}
				// 	 console.log('++++++++++++++ incomingcall', incomingcall);
				// });

			console.log('Start Call +++++++++++++++++++++++++++++++');
				// CLICK NUT CALL
			makeCall();

		}



		function makeCall() {

			call = new StringeeCall(client, fromNumber, toNumber);
			
			var customData = {
				userAgent: navigator.userAgent,
				url: window.location.href,
				name: checkCookie('__stringee_id') ? getCookie('__stringee_name') : 'YourName',
				phone: checkCookie('__stringee_id') ? getCookie('__stringee_phone') : 'YourPhone'
			};
//			customData.userAgent = navigator.userAgent;
//			customData.url = window.location.href;
			call.custom = JSON.stringify(customData);

			settingCallEvents(call);

			call.on('error', function (info) {
//				 console.log('error info', info);
			});

			call.makeCall(function (res) {
				
				 console.log('make call callback Widget: ', JSON.stringify(res));
				if (res.r === 1000) {
					stateCall('notallow');
					return;
				}

				if (res.r === 0) {
					stateCall('startcall');
				}
			});

		}

		function settingCallEvents(call1) {
			call1.on('addlocalstream', function (stream) {
//				 console.log('addlocalstream', stream);
			});
			call1.on('addremotestream', function (stream) {
//				console.log('addremotestream', stream);
				// reset srcObject to work around minor bugs in Chrome and Edge.
			var remoteVideo = window.frames['stringee-container-iframe'].document.getElementById('remoteVideo');
				var remoteVideo = window.document.getElementById('remoteVideo');
				remoteVideo.srcObject = null;
				remoteVideo.srcObject = stream;
			});
			call1.on('signalingstate', function (state) {
//				console.log('signalingstate ', state);
				if (state.code === 3) {
					startTime = new Date();
					countTimeCall();
				}
				if (state.code === 6) {
					stateCall('endcall')
				}
				if (state.code === 5) {
					stateCall('endcall')
				}
			});
			call1.on('mediastate', function (state) {
//				console.log('mediastate ', state);
			});
		}

		function hangUpCall() {
		var remoteVideo = window.frames['stringee-container-iframe'].document.getElementById('remoteVideo');
			var remoteVideo = window.document.getElementById('remoteVideo')
			remoteVideo.srcObject = null;
			call.hangup(function (res) {
//				console.log('hangup res', res);
				if (res.r === 0) {
				}
			});
			//Stop count
			countTimeCall(true)
			toNumber='Hello';
		}




//============================================================================//

		function sound(type) {
			if (type == 'beep') {
				var id_stringee_sound_beep = window.frames['stringee-container-iframe']
						.document.getElementById('stringee-sound-beep');
				var clickSound = id_stringee_sound_beep.play();
				if (clickSound !== undefined) {
					clickSound.then(() => {
//					console.log('Play then');
					})
							.catch(error => {
//					console.log('Catch play err');
							});
				}
			}
		}

		function stateCall(state) {
//			console.log('state: ' + state);
			var class_stringee_phone = window.frames['stringee-container-iframe'].document
					.getElementsByClassName('stringee-phone')[0];
			var class_stringee_duration = window.frames['stringee-container-iframe'].document
					.getElementsByClassName('stringee-duration')[0];
			var class_stringee_alert_content = window.frames['stringee-container-iframe'].document
					.querySelector('#stringee-intergrate-container .stringee-alert_content');
			var class_stringee_alert_content_p = window.frames['stringee-container-iframe'].document
					.querySelector('#stringee-intergrate-container .stringee-alert_content p');
			var class_stringee_close = window.frames['stringee-container-iframe'].document
					.getElementsByClassName('stringee-close')[0];

			var class_stringee_intergrate_button_container = window.frames['stringee-container-iframe'].document
					.getElementsByClassName('stringe-intergrate-button-container')[0];

			var page_require_info = window.frames['stringee-container-iframe']
					.document.getElementsByClassName('stringee-page-require-info')[0];
			var page_welcome = window.frames['stringee-container-iframe']
					.document.getElementsByClassName('stringee-page-welcome')[0];
			var page_incall = window.frames['stringee-container-iframe'].document
					.getElementsByClassName('stringee-page-incall')[0];

			var class_stringee_keypad_start_call = window.frames['stringee-container-iframe']
					.document.querySelector('.stringee-keypad .keypad-key.start-call');

			var class_stringee_keypad_start_call_login = window.frames['stringee-container-iframe']
					.document.querySelector('.stringee-keypad .keypad-key.start-call-login');

			var class_stringee_keypad_end_call = window.frames['stringee-container-iframe'].document
					.querySelector('.stringee-keypad .keypad-key.end-call');
			var class_stringee_text_call_free = window.frames['stringee-container-iframe'].document
					.getElementsByClassName('stringee_text_call_free')[0];
			var id_stringee_btn_logout_label = window.frames['stringee-container-iframe']
					.document.querySelector('#stringee_wrap_logout_login label.label_logout');
			var id_stringee_btn_login_label = window.frames['stringee-container-iframe']
					.document.querySelector('#stringee_wrap_logout_login label.label_login');
			var id_stringee_wrap_logout_login = window.frames['stringee-container-iframe']
					.document.querySelector('#stringee_wrap_logout_login')
			var class_stringee_agent = window.frames['stringee-container-iframe'].document
					.getElementsByClassName('stringee_agent')[0];

			if (state == "load") {
				removeClass(class_stringee_intergrate_button_container, 'stringee-display-none');
			}

			if (state == "authen") {
				removeClass(class_stringee_keypad_start_call, 'stringee-button-disabled');
			}


			if (state == "logout") {
				setCookie('__stringee_id', '', 0);
				setCookie('__stringee_phone', '', 0);
				setCookie('__stringee_name', '', 0);
				stateCall('endcall');
			}

			if (state == "welcome") {
				iframe.style.setProperty('z-index', '100000000000');
				if (width <= 500 || checkDevice == "mobile") {
					document.getElementById('stringee-container-iframe').style.setProperty("width", "100%");
					document.getElementById('stringee-container-iframe').style.setProperty("height", "100%");
					document.getElementById('stringee-container-iframe').style.setProperty("bottom", "0px");

				} else {
					document.getElementById('stringee-container-iframe').style.setProperty("width", "350px");
					document.getElementById('stringee-container-iframe').style.setProperty("height", "580px");
					document.getElementById('stringee-container-iframe').style.setProperty("bottom", "0px");
				}


				var class_stringee_intergrate_panel = window.frames['stringee-container-iframe'].document
						.getElementsByClassName('stringee-intergrate-panel')[0];
				var class_stringee_container_iframe = window.frames['stringee-container-iframe'].document
						.getElementsByClassName('stringe-intergrate-button-container')[0];
				addClass(page_incall, 'stringee-display-none');
				addClass(page_require_info, 'stringee-display-none');
				removeClass(page_welcome, 'stringee-display-none');
				addClass(class_stringee_keypad_end_call, 'stringee-display-none');
				if (checkCookie('__stringee_id') || !require_info) {
					// BUTTON CALL OR TO LOGIN
					addClass(class_stringee_keypad_start_call_login, 'stringee-display-none');
					removeClass(class_stringee_keypad_start_call, 'stringee-display-none');
				} else {
					// BUTTON CALL OR TO LOGIN
					removeClass(class_stringee_keypad_start_call_login, 'stringee-display-none');
					addClass(class_stringee_keypad_start_call, 'stringee-display-none');
				}
				if (require_info) {
					removeClass(id_stringee_wrap_logout_login, 'stringee-display-none');
				} else {
					addClass(id_stringee_wrap_logout_login, 'stringee-display-none');
				}
				removeClass(class_stringee_alert_content, 'stringee_alert_content_error');
				addClass(class_stringee_intergrate_panel, 'stringee-intergrate-panel-active');
				addClass(class_stringee_container_iframe, 'stringee-display-none');
				class_stringee_phone.innerHTML = stringee_text_welcome;
				class_stringee_duration.innerHTML = 'KÃ­nh chÃ o quÃ½ khÃ¡ch';
				class_stringee_alert_content_p.innerHTML = text_please_connect;
				addClass(class_stringee_alert_content_p, 'stringee-intergrate-panel-active');
			}

			if (state == "require_info") {

				removeClass(page_require_info, 'stringee-display-none');
				addClass(page_welcome, 'stringee-display-none');
				removeClass(class_stringee_agent, 'stringee-display-flex');
				addClass(class_stringee_text_call_free, 'stringee-display-none');
				addClass(class_stringee_keypad_start_call_login, 'stringee-display-none');
				addClass(id_stringee_wrap_logout_login, 'stringee-display-none');
			}

			if (state == "notallow") {
				pageRequestMicPhone();
				addClass(class_stringee_alert_content, 'stringee_alert_content_error');
				class_stringee_alert_content_p.innerHTML = text_err_notallow;
			}

			if (state == "notsupportwebsocket") {
				addClass(class_stringee_alert_content, 'stringee_alert_content_error');
				class_stringee_alert_content_p.innerHTML = text_err_notsupportsocket;
			}

			if (state == 'close') {

				setTimeout(function () {
					iframe.style.setProperty('z-index', '16000001');
					removeClass(class_stringee_intergrate_button_container, 'stringee-display-none');

					// TRUONG HOP DAC BIET THIET BI DEVICE ; FORCE DESKTOP
					if (checkDevice == "mobile" && width > 500) {
						document.getElementById('stringee-container-iframe').style.setProperty("width", "366px");
						document.getElementById('stringee-container-iframe').style.setProperty("height", "366px");
						document.getElementById('stringee-container-iframe').style.setProperty("bottom", "150px");
					} else {
						document.getElementById('stringee-container-iframe').style.setProperty("width", "140px");
						document.getElementById('stringee-container-iframe').style.setProperty("height", "140px");
						document.getElementById('stringee-container-iframe').style.setProperty("bottom", position_bottom);
						if (app_id == 'stringee_99') {
							document.getElementById('stringee-container-iframe').style.setProperty("bottom", "80px");
						}

						if (app_id = 'abay_99') {
							document.getElementById('stringee-container-iframe').style.setProperty("width", "140px");
							document.getElementById('stringee-container-iframe').style.setProperty("height", "160px");
						}
					}

				}, 500)


				var class_stringe_intergrate_panel = window.frames['stringee-container-iframe'].document
						.getElementsByClassName('stringee-intergrate-panel')[0];

				removeClass(class_stringe_intergrate_panel, 'stringee-intergrate-panel-active');
			}
			if (state == "startcall") {
				_deletePageRequestMic();
				removeClass(class_stringee_alert_content, 'stringee_alert_content_error');
				class_stringee_phone.innerHTML = formatPhoneNumberForEndUser(toNumber);
				class_stringee_duration.innerHTML = text_calling;
				class_stringee_alert_content_p.innerHTML = text_please_connect;
				addClass(class_stringee_keypad_start_call, 'stringee-display-none');
				addClass(class_stringee_keypad_start_call_login, 'stringee-display-none');
				removeClass(class_stringee_keypad_end_call, 'stringee-display-none');
				addClass(class_stringee_close, 'stringee-display-none');
				addClass(page_require_info, 'stringee-display-none');
				addClass(page_welcome, 'stringee-display-none');
				removeClass(page_incall, 'stringee-display-none');

				// SHOW/HIDE BUTTON LOGIN/LOGOUT
				if (checkCookie('__stringee_id') || require_info) {
					addClass(id_stringee_btn_login_label, 'stringee-display-none');
					removeClass(id_stringee_btn_logout_label, 'stringee-display-none');
					removeClass(id_stringee_wrap_logout_login, 'stringee-display-none');
				} else {
					removeClass(id_stringee_btn_login_label, 'stringee-display-none');
					addClass(id_stringee_btn_logout_label, 'stringee-display-none');
					addClass(id_stringee_wrap_logout_login, 'stringee-display-none');
				}
			}



			if (state == "endcall") {
				countTimeCall(true);
				setTimeout(function () {
					var class_stringee_intergrate_panel = window.frames['stringee-container-iframe'].document
							.getElementsByClassName('stringee-intergrate-panel')[0];
					var class_stringee_close = window.frames['stringee-container-iframe'].document
							.getElementsByClassName('stringee-close')[0];
					var class_stringee_keypad_start_call = window.frames['stringee-container-iframe'].document
							.querySelector('.stringee-keypad .keypad-key.start-call');
					var class_stringee_keypad_end_call = window.frames['stringee-container-iframe'].document
							.querySelector('.stringee-keypad .keypad-key.end-call');
					var class_stringee_label_powered = window.frames['stringee-container-iframe'].document.
							getElementsByClassName('stringee-label-powered')[0];


					removeClass(page_welcome, 'stringee-display-none');
					addClass(page_incall, 'stringee-display-none');
					class_stringee_phone.innerHTML = stringee_text_welcome;
					class_stringee_duration.innerHTML = text_end_call;
					class_stringee_alert_content_p.innerHTML = text_thankyou;

					removeClass(class_stringee_keypad_start_call, 'stringee-button-disabled');
					if (checkCookie('__stringee_id') || !require_info) {
						// BUTTON CALL OR TO LOGIN
						addClass(class_stringee_keypad_start_call_login, 'stringee-display-none');
						removeClass(class_stringee_keypad_start_call, 'stringee-display-none');

						// LABEL LOGIN/LOGOUT
						addClass(id_stringee_btn_login_label, 'stringee-display-none');
						removeClass(id_stringee_btn_logout_label, 'stringee-display-none');
					} else {
						// BUTTON CALL OR TO LOGIN
						removeClass(class_stringee_keypad_start_call_login, 'stringee-display-none');
						addClass(class_stringee_keypad_start_call, 'stringee-display-none');

						// LABEL LOGIN/LOGOUT
						removeClass(id_stringee_btn_login_label, 'stringee-display-none');
						addClass(id_stringee_btn_logout_label, 'stringee-display-none');
					}

					addClass(class_stringee_keypad_end_call, 'stringee-display-none')

					removeClass(class_stringee_close, 'stringee-display-none');
					removeClass(class_stringee_intergrate_panel, 'stringee-intergrate-panel-size-small')
					removeClass(class_stringee_label_powered, 'stringee-display-none');
				}, 200)
			}
		}

		function pageRequestMicPhone() {
			_deletePageRequestMic();
			var div = document.createElement("div");
			div.id = 'stringee-request-mic-overlay';
			div.style.setProperty("background", "#000000d1");
			div.style.setProperty("width", "100%");
			div.style.setProperty("height", "100%");
			div.style.setProperty("position", "fixed");
			div.style.setProperty("left", "0px");
			div.style.setProperty("top", "0px");
			div.style.setProperty('z-index', '21474836404444');
			div.innerHTML = "<h4 style='color: #fff; position: fixed; z-index: 999999; opacity: 1; border: 2px solid #fff; padding: 12px 20px 12px 40px; border-radius: 6px; top: 120px; left: 5%; font-size: 15px; font-weight: normal; background: url(https://app.toky.co/resources/images/back/arrow-up.png) left 10px center no-repeat;'>" +
					text_please_allow_mic +
					"<span id='stringee-close-mic-overlay' style='background: red;position: absolute;top: -15px;right: -15px;border-radius: 50%;padding: 5px;width: 30px;height: 30px;text-align: center;font-family: cursive;line-height: 15px; cursor: pointer;'>x</span>"
			"</h4>";
			document.body.appendChild(div);

			var id_stringee_close_mic_overlay_button = document.getElementById('stringee-close-mic-overlay');
			id_stringee_close_mic_overlay_button.addEventListener('click', function () {
				_deletePageRequestMic();
			})

		}

		function _deletePageRequestMic() {
			//DELETE NODE
			var stringee_request_mic_overlay = document.getElementById('stringee-request-mic-overlay');
			if (stringee_request_mic_overlay) {
				stringee_request_mic_overlay.remove();
			}
		}



		function n(n) {
			return n > 9 ? n : "0" + n;
		}

		// record start time
		var startTime;
		var fnCount;
		function countTimeCall(clear) {
			//	console.log('clear count time call: ' + clear)

			if (clear) {
				clearTimeout(fnCount);
				return;
			}
			// later record end time
			var endTime = new Date();
			// time difference in ms
			var timeDiff = endTime - startTime;
			timeDiff /= 1000;
			// get seconds
			var seconds = Math.round(timeDiff % 60);
			// remove seconds from the date
			timeDiff = Math.floor(timeDiff / 60);
			// get minutes
			var minutes = Math.round(timeDiff % 60);

			var stringee_duration = window.frames['stringee-container-iframe'].document
					.getElementsByClassName('stringee-duration')[0];
			stringee_duration.innerHTML = n(minutes) + ":" + n(seconds)
			fnCount = setTimeout(countTimeCall, 1000);
		}


		function htmlButton() {
			//TRUONG HOP DAC BIET: THIET BI MOBILE DUYET WEB DESKTOP
			var mode_mobile = (checkDevice == "mobile" && width > 500) ? 'stringee_mode_mobile' : '';
			var stringee_style = (app_style) ? 'stringee-app-style-' + app_style : 'stringee-app-style-yellow';
			// LOGO
			var urlLogo = '';
			var logoCompany = '';
			// SHADOW TOP
			var shadowTop = '';
			var shadowBottom = '';
			var imageExtraButton = '';
			shadowTop = '<img src="' + h + 'images/shadow1.png" width="250" class="stringee-margin-auto stringee-display-block shadow-top"/>';
			shadowBottom = '<img src="' + h + 'images/shadow2.png" width="250" class="stringee-margin-auto stringee-display-block shadow-bottom"/>';
			switch (app_id) {
				case "mediamart_99":
					urlLogo = '<img src="' + h + 'images/mediamart/logo.svg" width="200" class="stringee-margin-auto stringee-display-block"/>';
					break;
				case "stringee_99":
					urlLogo = '<img src="' + h + 'images/stringee/logo.png" height="30" class="stringee-margin-auto stringee-display-block"/>';
					break;
				case "abay_99":
					urlLogo = '<img src="' + h + 'images/abay/logo.png" height="30" class="stringee-margin-auto stringee-display-block"/>';
					break;
				case "cogo_99":
					urlLogo = '<img src="' + h + 'images/cogo/logo.png" width="100" class="stringee-margin-auto stringee-display-block"/>';
					break;
				case "luxstay_99":
					urlLogo = '<img src="' + h + 'images/luxstay/logo-white.png" width="150" class="stringee-margin-auto stringee-display-block"/>';
					break;
				case "edoctor_99":
					urlLogo = '<img src="' + h + 'images/edoctor/logo-edoctor.png" width="150" class="stringee-margin-auto stringee-display-block"/>';
					break;
				case "tatana_99":
					urlLogo = '<img src="' + h + 'images/tatana/logo.png" width="150" class="stringee-margin-auto stringee-display-block"/>';
					break;
				default:
					urlLogo = '<img src="' + h + 'images/logo_default.svg" width="200" class="stringee-margin-auto stringee-display-block"/>';

			}
			logoCompany =
					'<div id="stringee_logo_client">' +
					urlLogo +
					'</div>';

			//INFO PHONE
			var infoPhone =
					'<div class="stringee-info-phone">' +
					'    <div class="stringee-info">' +
					'         <h2 class="stringee-phone">0898587099</h2>' +
					'         <p class="stringee-duration">?ang g?i</p>' +
					'    </div>' +
					'</div>';


			// PAGE REQUIRE INFO
			var formInfo =
					'<div class="formInfo">' +
					'	<input type="text" name="name" tabindex="0" class="stringee_input" id="stringee_input_your_name" placeholder="'+text_your_name+'" />' +
					'	<input type="tel" name="phone" tabindex="0" class="stringee_input" id="stringee_input_your_phone" placeholder="'+text_your_phone+'" />' +
					'   <button class="stringee_button" id="stringee_button_save_info">' +
					'		<img src="' + h + 'images/phone.svg" width="18" class=""/>&nbsp;' +
					 text_call_now +
					'   </button>' +
					'</div>';

			var textCallFree;
			textCallFree =
					'<div class="stringee_text_phone_number">' +
					'<p class="stringee_text_welcome">' + stringee_text_welcome + '</p>' +
					'<h2 class="stringee_phone_number">' + formatPhoneNumberForEndUser(toNumber) + '</h2>' +
					'</div>' +
					'<div class="stringee_agent stringee-display-flex">' +
					'<img src="' + h + 'images/agent.png" width="120" class=""/>' +
					'<div class="stringee_text_call_free">' +
					'<div class="text_introduce">' + stringee_text_call_free_text_introduce + '</div>' +
					'<div class="text_and_image_call_free">' +
					'<div class="text_free">' + stringee_text_call_free_text_free + '</div>' +
					'<svg class="image_free" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"' +
					'width="75.631px" height="50.51px" viewBox="27.214 39.45 75.631 50.51" enable-background="new 27.214 39.45 75.631 50.51"' +
					'xml:space="preserve">' +
					'<g>' +
					'<path fill="#00AEEF" d="M97.572,39.691H32.805c-2.905,0-5.27,2.363-5.27,5.269v10.588c0,0.937,0.763,1.7,1.701,1.7' +
					'c0.937,0,1.697-0.765,1.697-1.7V44.959c0-1.027,0.838-1.864,1.87-1.864h64.768c1.03,0,1.87,0.837,1.87,1.864v39.53' +
					'c0,1.029-0.84,1.868-1.87,1.868h-22.68c-0.937,0-1.696,0.764-1.696,1.702s0.761,1.701,1.696,1.701h22.68' +
					'c2.907,0,5.271-2.365,5.271-5.271v-39.53C102.844,42.055,100.479,39.691,97.572,39.691"/>' +
					'</g>' +
					'</svg>' +
					'</div>' +
					'</div>' +
					'</div>';


			var pageRequireInfo =
					'<div class="stringee-page-require-info stringee-display-none">' +
					shadowTop +
					textCallFree +
					formInfo +
					'</div>	';


			// PAGE WELCOME
			var pageWelcome =
					'<div class="stringee-page-welcome">' +
					shadowTop +
					textCallFree +
					'    <div class="stringee-alert_content">' +
					'       <p>' +
					'           ÄÃ¢y lÃ  á»©ng dá»¥ng gá»i Ä‘iá»‡n thoáº¡i<br>' +
					'           <strong>HOÃ€N TOÃ€N MIá»„N PHÃ</strong>' +
					'           Vui lÃ²ng káº¿t ná»‘i tai nghe Ä‘á»ƒ trÃ² chuyá»‡n.<br>' +
					'           (Hoáº·c há»‡ thá»‘ng sáº½ sá»­ dá»¥ng loa vÃ  microphone trÃªn thiáº¿t bá»‹ cá»§a báº¡n).' +
					'       </p>' +
					'    </div>' +
					'</div>';




			// PAGE INCALL
			var pageIncall =
					'                    <div class="stringee-page-incall stringee-display-none">' +
					infoPhone +
					'                        <div class="stringee-row stringee-send-dtmf">' +
					'                            <div class="keypad-key" data-key="1">' +
					'                                <div class="keypad-key-number">1</div>' +
					'                                <div class="keypad-key-letters"></div>' +
					'                            </div>' +
					'                            <div class="keypad-key" data-key="2">' +
					'                                <div class="keypad-key-number">2</div>' +
					'                                <div class="keypad-key-letters">abc</div>' +
					'                            </div>' +
					'                            <div class="keypad-key" data-key="3">' +
					'                                <div class="keypad-key-number">3</div>' +
					'                                <div class="keypad-key-letters">def</div>' +
					'                            </div>' +
					'                        </div>' +
					'                        <div class="stringee-row stringee-send-dtmf">' +
					'                            <div class="keypad-key" data-key="4">' +
					'                                <div class="keypad-key-number">4</div>' +
					'                                <div class="keypad-key-letters">ghi</div>' +
					'                            </div>' +
					'                            <div class="keypad-key" data-key="5">' +
					'                                <div class="keypad-key-number">5</div>' +
					'                                <div class="keypad-key-letters">jkl</div>' +
					'                            </div>' +
					'                            <div class="keypad-key" data-key="6">' +
					'                                <div class="keypad-key-number">6</div>' +
					'                                <div class="keypad-key-letters">mno</div>' +
					'                            </div>' +
					'                        </div>' +
					'                        <div class="stringee-row stringee-send-dtmf">' +
					'                            <div class="keypad-key" data-key="7">' +
					'                                <div class="keypad-key-number">7</div>' +
					'                                <div class="keypad-key-letters">pqrs</div>' +
					'                            </div>' +
					'                            <div class="keypad-key" data-key="8">' +
					'                                <div class="keypad-key-number">8</div>' +
					'                                <div class="keypad-key-letters">tuv</div>' +
					'                            </div>' +
					'                            <div class="keypad-key" data-key="9">' +
					'                                <div class="keypad-key-number">9</div>' +
					'                                <div class="keypad-key-letters">wxyz</div>' +
					'                            </div>' +
					'                        </div>' +
					'                        <div class="stringee-row stringee-send-dtmf">' +
					'                            <div class="keypad-key" data-key="*">' +
					'                                <div class="keypad-key-number">*</div>' +
					'                                <div class="keypad-key-letters"></div>' +
					'                            </div>' +
					'                            <div class="keypad-key" data-key="0">' +
					'                                <div class="keypad-key-number">0</div>' +
					'                                <div class="keypad-key-letters"></div>' +
					'                            </div>' +
					'                            <div class="keypad-key" data-key="#">' +
					'                                <div class="keypad-key-number">#</div>' +
					'                                <div class="keypad-key-letters"></div>' +
					'                            </div>' +
					'                        </div>' +
					'                    </div>';


			// BUTTON SHOW TO 3 VONG
			if (app_id == "abay_99") {
				imageExtraButton = "<img class='stringee-extra-image' src='" + h + "images/abay/extra_button.png' />";
			}
			var sizeBtnShow = !btn_size ? "btn_container_small " : "";
			var mainButton =
					'            <div class="stringe-intergrate-button-container stringee-display-none ' + sizeBtnShow + '" >' +
					imageExtraButton +
					'                <div id="stringee-intergrate-button" style="background:' + button_background + '">' +
					'                    <div class="stringee-intergrate-icon stringee-intergrate-open-icon stringee-circle-shake">' +
					'                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 480.56 480.56" style="enable-background:new 0 0 480.56 480.56;" xml:space="preserve" width="512px" height="512px">' +
					'                        <g>' +
					'                        <path d="M365.354,317.9c-15.7-15.5-35.3-15.5-50.9,0c-11.9,11.8-23.8,23.6-35.5,35.6c-3.2,3.3-5.9,4-9.8,1.8    c-7.7-4.2-15.9-7.6-23.3-12.2c-34.5-21.7-63.4-49.6-89-81c-12.7-15.6-24-32.3-31.9-51.1c-1.6-3.8-1.3-6.3,1.8-9.4    c11.9-11.5,23.5-23.3,35.2-35.1c16.3-16.4,16.3-35.6-0.1-52.1c-9.3-9.4-18.6-18.6-27.9-28c-9.6-9.6-19.1-19.3-28.8-28.8    c-15.7-15.3-35.3-15.3-50.9,0.1c-12,11.8-23.5,23.9-35.7,35.5c-11.3,10.7-17,23.8-18.2,39.1c-1.9,24.9,4.2,48.4,12.8,71.3    c17.6,47.4,44.4,89.5,76.9,128.1c43.9,52.2,96.3,93.5,157.6,123.3c27.6,13.4,56.2,23.7,87.3,25.4c21.4,1.2,40-4.2,54.9-20.9    c10.2-11.4,21.7-21.8,32.5-32.7c16-16.2,16.1-35.8,0.2-51.8C403.554,355.9,384.454,336.9,365.354,317.9z" fill="#FFFFFF"/>' +
					'                        <path d="M346.254,238.2l36.9-6.3c-5.8-33.9-21.8-64.6-46.1-89c-25.7-25.7-58.2-41.9-94-46.9l-5.2,37.1    c27.7,3.9,52.9,16.4,72.8,36.3C329.454,188.2,341.754,212,346.254,238.2z" fill="#FFFFFF"/>' +
					'                        <path d="M403.954,77.8c-42.6-42.6-96.5-69.5-156-77.8l-5.2,37.1c51.4,7.2,98,30.5,134.8,67.2c34.9,34.9,57.8,79,66.1,127.5    l36.9-6.3C470.854,169.3,444.354,118.3,403.954,77.8z" fill="#FFFFFF"/>' +
					'                        </g>' +
					'                        </svg>' +
					'                    </div>' +
					'                    <div class="stringee-intergrate-icon stringee-intergrate-close-icon">' +
					'                        <svg width="14" height="14"><path d="M13.978 12.637l-1.341 1.341L6.989 8.33l-5.648 5.648L0 12.637l5.648-5.648L0 1.341 1.341 0l5.648 5.648L12.637 0l1.341 1.341L8.33 6.989l5.648 5.648z" fill-rule="evenodd"></path></svg>' +
					'                    </div>' +
					'                </div>' +
					'                <div class="stringee-circle-fill" style="background:' + button_background + '"></div>' +
					'                <div class="stringee-circle" style="border: 2px solid ' + button_background + '"></div>' +
					'            </div>';


			// BUTTON LOGOUT
			var display_text_login = getCookie('__stringee_id') ? 'stringee-display-none' : '';
			var display_text_logout = !getCookie('__stringee_id') ? 'stringee-display-none' : '';
			var btnLogout =
					'<div id="stringee_wrap_logout_login">' +
					shadowBottom +
					'<label class="label_login ' + display_text_login + '">'+text_login+'</label>' +
					'<label class="label_logout ' + display_text_logout + '">'+text_logout+'</label>' +
					'</div>';

			// BUTTON STARTCALL
			var iconPhone = '<img src="' + h + 'images/phone.svg" width="30"  />';
			var class_display_btn_start_call_login = checkCookie('__stringee_id') ? 'stringee-display-none' : '';
			var class_display_btn_start_call = !checkCookie('__stringee_id') ? 'stringee-display-none' : '';
			var btnCalls =
					'                    <div class="stringee-row">' +
					'                        <div class="keypad-key btn-success btn-call start-call-login stringee-margin-auto ' + class_display_btn_start_call_login + '">' +
					'                            <div class="wrap-img-icon">' +
					iconPhone +
					'                            </div>' +
					'                        </div>' +
					'                        <div class="keypad-key btn-call btn-success start-call stringee-button-disabled stringee-margin-auto ' + class_display_btn_start_call + '">' +
					'                            <div class="wrap-img-icon">' +
					iconPhone +
					'                            </div>' +
					'                        </div>' +
					'                        <div class="keypad-key btn-call btn-danger end-call stringee-margin-auto stringee-display-none">' +
					'                            <div class="wrap-img-icon">' +
					'                                <img src="' + h + 'images/phone-call-end.svg" width="40" />' +
					'                            </div>' +
					'                        </div>' +
					'                    </div>';

			// BUTTON CLOSE
			var class_style_close = (app_id == "mediamart_99") ? 'stringee-close-style-2' : 'stringee-close-style-1';
			var btnClose =
					'				<div class="stringee-close ' + class_style_close + '">' +
					'                    <img class="" src="' + h + 'images/close.svg" width="12" />' +
					'                </div>';


			var powered =
					'<div class="stringee-label-powered" >' +
					'<p><a href="https://stringee.com/" target="_blank">Powered by <span>Stringee</span></a></p>' +
					'</div>';
			// FINAL
			var temp =
					'<div id="stringee-intergrate-container" class="' + mode_mobile + " " + stringee_style + '">' +
					'       <audio id="stringee-sound-beep" volume="0.1" src="' + h + 'sound/keypad_sound.mp3"></audio>' +
					'       <div class="stringee-intergrate-panel">' +
					logoCompany +
					btnClose +
					'           <div class="stringee-keypad">' +
					pageRequireInfo +
					pageWelcome +
					pageIncall +
					btnCalls +
					'           </div>' +
					btnLogout +
					powered +
					'       </div>' +
					mainButton +
					'</div>';

			return temp;
		}


	}); //end ready




	function getCORS(url, success) {
		var xhr = new XMLHttpRequest();
		if (!('withCredentials' in xhr))
			xhr = new XDomainRequest(); // fix IE8/9
		xhr.open('GET', url);
		xhr.onload = success;
		xhr.send();
		return xhr;
	}

	function hasClass(el, className) {
		if (el.classList)
			return el.classList.contains(className)
		else
			return !!el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'))
	}
	function addClass(el, className) {
		if (el.classList)
			el.classList.add(className)
		else if (!hasClass(el, className))
			el.className += " " + className
	}

	function removeClass(el, className) {
		if (el.classList)
			el.classList.remove(className)
		else if (hasClass(el, className)) {
			var reg = new RegExp('(\\s|^)' + className + '(\\s|$)')
			el.className = el.className.replace(reg, ' ')
		}
	}

	function insertAfter(el, referenceNode) {
		referenceNode.parentNode.insertBefore(el, referenceNode.nextSibling);
	}

	function insertBefore(el, referenceNode) {
		referenceNode.parentNode.insertBefore(el, referenceNode);
	}

	function ready(fn) {
		if (document.readyState != 'loading') {
			fn();
		} else if (document.addEventListener) {
			document.addEventListener('DOMContentLoaded', fn);
		} else {
			document.attachEvent('onreadystatechange', function () {
				if (document.readyState != 'loading')
					fn();
			});
		}
	}

	function randomUserId() {
		var d = new Date();
		var timestamp = d.getTime();
		var auto_chacractor = Math.random().toString(36).substring(8);
		var user_id =  timestamp + '_' + auto_chacractor;
		return user_id;
	}

	function isSupportWebrtc() {
		//if (navigator && navigator.mediaDevices && (typeof navigator.mediaDevices.getUserMedia !== "undefined")) {
		var nav = navigator && navigator.mediaDevices && (typeof navigator.mediaDevices.getUserMedia !== "undefined");
		if (nav) {
			return true
		}
		return false;
	}

	function formatPhoneNumberForEndUser(phone) {
		var countryCode = phone.substring(0, 2);
		var specialNumber = phone.substring(2, 6);

		if (countryCode == 84) {
			if (specialNumber == 1900 || specialNumber == 1800) {
				return phone.substring(2);
			} else {
				return "0" + phone.substring(2);
			}
		}
		return phone;
	}

	function setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		var expires = "expires=" + d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}

	function getCookie(cname) {
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}

	function checkCookie(cname) {
		var user = getCookie(cname);
		if (user != "") {
			return true;
		} else {
			return false
		}
	}

	function deleteCookie(cname) {
		document.cookie = cname + '=; expires=Thu, 18 Dec 2013 12:00:00 UTC';
	}

	function getRandomRange(minimum, maximum) {
		var randomnumber = Math.floor(Math.random() * (maximum - minimum + 1)) + minimum;
		return randomnumber;
	}




}(); 