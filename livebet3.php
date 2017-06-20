<?php include_once('includes/logic_top.php');  ?>

<?php $_SESSION['PAGE_TYPE'] = 'live';?>

<?php

    /**

      Developer:Sourav Bhowmik

      Organization: WGT

     *

     * Edited by Marius H. <marius@hirjanu.com>

     * User: root

     * Date: 27/06/16

     * Time: 20:39

     */

	 $tax = 0.00;
	 $_SESSION['MID_ARR']='';

?>



<!DOCTYPE html>



<head>

	<meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<meta http-equiv="refresh" content="900">

	

	<title>XXL-Live</title>

	

	<link rel="stylesheet" href="css/media.css" media="screen" />

    <link rel="stylesheet" href="css/style.css" media="screen" />

	<link rel="stylesheet" href="css/font-awesome.css" media="screen" />

	<style>

	#preloader  {

		 position: absolute;

		 top: 0;

		 left: 0;

		 right: 0;

		 bottom: 0;

		 background-color: #fefefe;

		 opacity: 0.6;

    	 filter: alpha(opacity=60);

		 z-index: 99;

		height: 100%;

	 }

	

	#status  {

		 width: 200px;

		 height: 200px;

		 position: absolute;

		 left: 50%;

		 top: 50%;

		 background-image: url(img/status.gif);

		 background-repeat: no-repeat;

		 background-position: center;

		 margin: -100px 0 0 -100px;

	 }

	</style>

	

	<link rel="stylesheet" type="text/css" href="./files/bootstrap.css">

	<!----><link rel="stylesheet" type="text/css" href="./files/style.css">

	

	<style type="text/css">

	

	

	

	/*Today selected color */

	.menumid ul li a:hover, .menumid ul li a.active {

		background: #3F820E none repeat scroll 0 0;

		box-shadow: 0 0 10px rgba(0, 0, 0, 0.20) inset;

		color: #ffffff;

	}

	

	/*odds font*/

	.rt {

		font-size: 18px;

	}

	

	.Yellow {

		color: #E8C32D;

	}

	

	.Blue {

		color: #0364F9;

	}

	

	/*

	.lastcol .btn {

		background: rgba(0, 0, 0, 0) url("../images/tb_bg_new.png") no-repeat scroll center top;

		float: left;

		font-family: Arial,Helvetica,sans-serif;

		font-size: 12px;

		font-weight: bold;

		height: 39px;

		line-height: 39px;

		text-align: center;

		width: 50%;

	}

	

	

	.lastcol .btn .l_prc {

		margin-left: 0;

	}*/

	</style>

	

	<style type="text/css">

	

	<!--.set_background { background-color:#0C0 !important; color:#000 !important;  } -->

	

	.set_background {

		background-color:#e8c32d!important;

		padding:0px;

		color:#000;

		border-radius:4px;

		height: 36px;

		width: 40px;

	}

	/*.set_background:hover {

		color:#000!important;

		text-decoration:none!important;

	}*/

	.new  {

	

	}

	.line2{ margin-top:40px; position:absolute; margin-left:395px;}

	

	

	.borderClass{

        border: 2px solid #CE0001;

     }



	.pull-right {

		float: right;

		/*margin-right: 18px;*/

	}

	.scr_time {

		left: 0;

		padding-top: 11px;

		position: absolute;

		top: 0;

		width: 21px;

		z-index: 1;

	}

	.rt {

		font-size: 15px;

	}

	.league_name {

		position:absolute;

		font-size: 10px;

    	top: 28px;

	}

	</style>
	
	<input type="hidden" id="MID_ARRAY_HIDD" value="<?php echo implode(",",$_SESSION['MID_ARR']);?>">

	

	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.1/socket.io.js"></script>

    <!--<script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>-->
	
	<!--<script src="js/compressed.js"></script>-->

    <script type="text/javascript">

    var toType = function(obj) {

        return ({}).toString.call(obj).match(/\s([a-zA-Z]+)/)[1].toLowerCase()

    }

	var b1_status = {};
	var r1_status = {};
	var b2_status = {};
	var r2_status = {};
	var b3o1_status = {};
	var b3o2_status = {};
	var b3o3_status = {};
	var r3o1_status = {};
	var r3o2_status = {};
	var r3o3_status = {};
	var process_status = false;
	var debug_id = 0;
	var debug_event = null;

	function getBValues(id) {
		console.log('b1_status '+b1_status[id]);
		console.log('1x2b2_status '+b2_status[id+'1x2']);
		console.log('1x2r2_status '+r2_status[id+'1x2']);
		console.log('1x2b3o1_status '+b3o1_status[id]+'1x2');
		console.log('1x2b3o2_status '+b3o2_status[id+'1x2']);
		console.log('1x2b3o3_status '+b3o3_status[id+'1x2']);
		console.log('1x2r3o1_status '+r3o1_status[id]+'1x2');
		console.log('1x2r3o2_status '+r3o2_status[id+'1x2']);
		console.log('1x2r3o3_status '+r3o3_status[id+'1x2']);

		console.log('RES_1x2b2_status '+b2_status[id+'RES_1x2']);
		console.log('RES_1x2r2_status '+r2_status[id+'RES_1x2']);
		console.log('RES_1x2b3o1_status '+b3o1_status[id]+'RES_1x2');
		console.log('RES_1x2b3o2_status '+b3o2_status[id+'RES_1x2']);
		console.log('RES_1x2b3o3_status '+b3o3_status[id+'RES_1x2']);
		console.log('RES_1x2r3o1_status '+r3o1_status[id]+'RES_1x2');
		console.log('RES_1x2r3o2_status '+r3o2_status[id+'RES_1x2']);
		console.log('RES_1x2r3o3_status '+r3o3_status[id+'RES_1x2']);

		console.log('RES_1x2_Hb2_status '+b2_status[id+'RES_1x2_H']);
		console.log('RES_1x2_Hr2_status '+r2_status[id+'RES_1x2_H']);
		console.log('RES_1x2_Hb3o1_status '+b3o1_status[id]+'RES_1x2_H');
		console.log('RES_1x2_Hb3o2_status '+b3o2_status[id+'RES_1x2_H']);
		console.log('RES_1x2_Hb3o3_status '+b3o3_status[id+'RES_1x2_H']);
		console.log('RES_1x2_Hr3o1_status '+r3o1_status[id]+'RES_1x2_H');
		console.log('RES_1x2_Hr3o2_status '+r3o2_status[id+'RES_1x2_H']);
		console.log('RES_1x2_Hr3o3_status '+r3o3_status[id+'RES_1x2_H']);
	}

	function RunDebug(id) {
		if(b1_status[id] === 1) {
			console.log('Event should be blocked: b1='+b1_status[id+'1x2']+', b2='+b2_status[id+'1x2']+", r2="+r2_status[id+'1x2']);
		}

		if(b2_status[id+'1x2'] === 1 || r2_status[id+'1x2']=== 1) {
			console.log('1x2 market should be blocked: b2='+b2_status[id+'1x2']+", r2="+r2_status[id+'1x2']);
		}

		/*if(b2_status[id+'1x2_H1'] === 1 || r2_status[id+'1x2_H1']=== 1) {
		 console.log('1x2_H1 market should be blocked: b2='+b2_status[id+'1x2_H1']+", r2="+r2_status[id+'1x2_H1']);
		 }*/

		if(b3o1_status[id+'1x2'] === 1 || r3o1_status[id+'1x2']=== 1) {
			console.log('1x2 odd1 should be blocked: b2='+b3o1_status[id+'1x2']+", r2="+r3o1_status[id+'1x2']);
		}

		if(b3o2_status[id+'1x2'] === 1 || r3o2_status[id+'1x2']=== 1) {
			console.log('1x2 oddx should be blocked: b2='+b3o2_status[id+'1x2']+", r2="+r3o2_status[id+'1x2']);
		}

		if(b3o3_status[id+'1x2'] === 1 || r3o3_status[id+'1x2']=== 1) {
			console.log('1x2 odd2 should be blocked: b2='+b3o3_status[id+'1x2']+", r2="+r3o3_status[id+'1x2']);
		}

		if(b2_status[id+'RES_1x2'] === 1 || r2_status[id+'RES_1x2']=== 1) {
			console.log('RES_1x2 market should be blocked: b2='+b2_status[id+'RES_1x2']+", r2="+r2_status[id+'RES_1x2']);
		}

		/*if(b2_status[id+'RES_1x2_H'] === 1 || r2_status[id+'RES_1x2_H']=== 1) {
		 console.log('RES_1x2_H market should be blocked: b2='+b2_status[id+'RES_1x2_H']+", r2="+r2_status[id+'RES_1x2_H']);
		 }*/

		if(b3o1_status[id+'RES_1x2'] === 1 || r3o1_status[id+'RES_1x2']=== 1) {
			console.log('RES_1x2 odd1 should be blocked: b2='+b3o1_status[id+'RES_1x2']+", r2="+r3o1_status[id+'RES_1x2']);
		}

		if(b3o2_status[id+'RES_1x2'] === 1 || r3o2_status[id+'RES_1x2']=== 1) {
			console.log('RES_1x2 oddx should be blocked: b2='+b3o2_status[id+'RES_1x2']+", r2="+r3o2_status[id+'RES_1x2']);
		}

		if(b3o3_status[id+'RES_1x2'] === 1 || r3o3_status[id+'RES_1x2']=== 1) {
			console.log('RES_1x2 odd2 should be blocked: b2='+b3o3_status[id+'RES_1x2']+", r2="+r3o3_status[id+'RES_1x2']);
		}
	}

    
	
	function idle_full(){
	
	



	    var updateReceivedAt = new Date();

        var socket = new io.connect('http://tipxxl.mine.nu:3337/');

        var fullRestartCounter = 0;

        

        // 

        var objectStack = [];

        setInterval(function(){


			if(process_status === false) {

				processUQueue();

			}

		}, 1000);





		function processUQueue() {


				var msg = objectStack.shift();


				if (typeof msg !== "undefined") {

					if (msg.cmd === "U") {

						process_status = true;

						update_list_async(msg);

						console.log('Processed U JSON with dt ' + msg.dt);

						process_status = false;

					} else if (msg.cmd === "F") {

						process_status = true;

						/*if (objectStack.length > 0) {
						 for (var f = 1; f <= objectStack.length; f++) {
						 processUQueue();
						 }
						 }*/

						if(debug_event !== null) {
							RunDebug(debug_id);
						}

						create_list(msg);

						console.log('Processed F JSON with dt ' + msg.dt);

						if(debug_event !== null) {
							RunDebug(debug_id);
						}

						process_status = false;
					}
				}


		}

        function socketInit(socket){

			socket.on('eventUpdateObj', function(eventUpdateObj1) { 

				var eventUpdateObj = JSON.parse(eventUpdateObj1);

				if (eventUpdateObj && eventUpdateObj.cmd && eventUpdateObj.cmd == "F" && fullRestartCounter == 0) {


					update_list(eventUpdateObj);

					//fullRestartCounter++;

					//console.log("RESET RESET RESET RESET RESET RESET RESET RESET RESET RESET RESET RESET ");

				} else if(eventUpdateObj && eventUpdateObj.cmd && eventUpdateObj.cmd == "U") {

					update_list(eventUpdateObj);

				} else if(eventUpdateObj && eventUpdateObj.cmd && eventUpdateObj.cmd == "ERR"){
					console.log("Full Error");
					idle_full();
				}

				updateReceivedAt = new Date();

			});

			socket.on('eventHeartbeat', function(heartbeat) {

					updateReceivedAt = new Date();

				});

		}

        

		socketInit(socket);



        // !!! DON'T ENABLE THIS FUNCTION

        //  IT OVERWRITES THE UPDATED VALUES WITH locker images (if they don't come into array) and never the locker disappears unless the value id updated --- try to fix the socket

	  /*  setInterval(function() {

			var newDate = new Date();

			//console.log(newDate,updateReceivedAt, newDate - updateReceivedAt);

            if ((newDate - updateReceivedAt) > 59000) {

				//alert("F");

				//socket.disconnect();

				//socket.connect();

                //console.log('STARTFEED SIGNAL ! STARTFEED SIGNAL ! STARTFEED SIGNAL ! STARTFEED SIGNAL ! STARTFEED SIGNAL ! STARTFEED SIGNAL ! STARTFEED SIGNAL ! ');

                fullRestartCounter = 0;

                socket.close()

                var newsocket = new io.connect('http://tipxxl.mine.nu:3337/');

                socketInit(newsocket);

                socket = newsocket;

                updateReceivedAt = new Date();

                //socket.emit('startFeed', '');

            }

        }, 4000);*/





		function update_list(subscriptionMsg){

			objectStack.push(subscriptionMsg);

		}



        function create_list(eventUpdateJson) {

            var rows = [];



            //console.log("UPDATE FULL");





            if (eventUpdateJson != null && typeof eventUpdateJson["obj"] != "undefined" && typeof eventUpdateJson["obj"][0] != "undefined") {

                var list_rows = eventUpdateJson.obj;


				b1_status = {};
				b2_status = {};
				r2_status = {};
				b3o1_status = {};
				b3o2_status = {};
				b3o3_status = {};
				r3o1_status = {};
				r3o2_status = {};
				r3o3_status = {};


                /*var request = $.ajax({

                 url: "data.json",

                 method: "POST",

                 data: {id: 1},

                 dataType: "json",

                 async: false,

                 });



                 request.done(function (data) {

                 ev_data = data;

                 });*/
				 
				 //alert("Full");



                if (list_rows != null) {

				

					list_rows.sort(function(a, b) { return b.tm - a.tm; });

					//console.log('Avishek'+list_rows);

					var event_id_array = [];

					var std_id_array = [];

					var t1_name_array = [];

					var t2_name_array = [];



                    list_rows.forEach(function (row) {  // in this loop you should add all the event_ids



                        var row_id = row["id"];

						var std_id = row["std"];



						b1_status[row_id] = row.hasOwnProperty("b") ? row.b : undefined;


						

                        if (typeof row_id != "undefined" || row_id != "") {

                            //list_events.push(iventId); // just a temporaty push, in list_events you need to loop over all js data for rows

							

							event_id_array.push(row_id);

							std_id_array.push(std_id);
							
							t1_name_array.push(row.t1.n);

							t2_name_array.push(row.t2.n);





                            //console.log(iventId);

                            var btObj = row.bt;

                            var tss = row.tss;

                            var tm = row.tm;

                            //console.log(mseconds);

                            if (tm < 0) {

                                var negative = 1;

                            } else {

                                var negative = 0;

                            }

                            tm = Math.round(tm / 60);

                            if (negative == 1) {

                                var t = "-" + t;

                            }









                            // mapping to local object

                            var data = {

                                id: row_id,

                                t1: row.t1.n,

                                t2: row.t2.n,

                                inf: row.inf,

                                pn: row.pn,

                                g_t1: (row.sc.GOAL[0] != "") ? row.sc.GOAL[0] : "0",

                                g_t2: (row.sc.GOAL[1] != "") ? row.sc.GOAL[1] : "0",

                                tm: tm,

                                mw1: "",

                                mwx: "",

                                mw2: "",

                                mw1h: "",

                                mwxh: "",

                                mw2h: "",

                                rm1: "",

                                rmx: "",

                                rm2: "",

                                rm1h: "",

                                rmxh: "",

                                rm2h: "",

                                ng1: "",

                                ngx: "",

                                ng2: "",

                                ng1h: "",

                                ngxh: "",

                                ng2h: "",

                                to: "2.5",

                                to0: "",

                                to1: "",

                                toh: "0.5",

                                to0h: "",

                                to1h: "",
								
								dc1x: "",

                                dcx2: "",

                                dc12: "",
								
								btsy: "",

                                btsn: "",
								
								btsyh: "",

                                btsnh: "",
								
								ou_o05: "",

                                ou_u05: "",
								
								ou_o15: "",

                                ou_u15: "",
								
								ou_o25: "",

                                ou_u25: "",
								
								ou_o35: "",

                                ou_u35: "",
								
								ou_o45: "",

                                ou_u45: "",
								
								ou_o55: "",

                                ou_u55: "",
								
								ou_o65: "",

                                ou_u65: "",
								
								ou_o75: "",

                                ou_u75: "",
								
								ou_o85: "",

                                ou_u85: "",
								
								ou_o95: "",

                                ou_u95: "",

                            };



                            //console.log(data);

							
							
							///
							var t1_g = parseInt((row.sc.GOAL[0] != "") ? row.sc.GOAL[0] : "0");
							var t2_g = parseInt((row.sc.GOAL[1] != "") ? row.sc.GOAL[1] : "0");	
							var total_g1 = t1_g + t2_g + 1;	
							var total_g5 = t1_g + t2_g + 0.5;		
							
							var S1G = 'S'+ total_g1 +'G';
							var S1G_H1 = 'S'+ total_g1 +'G_H1';
							
							//console.log(row_id+' -> '+S1G+' - '+S1G_H1);
							
							if(row.sc.GOAL[0] != "" || row.sc.GOAL[1] != ""){
								var rgh = t1_g + '.' + t2_g;
							}else{
								var rgh = "0";
							}
							
							///
							var gf = t1_g + t2_g;
							if(gf >= 2){
								gf = gf + 0.5;
							} else {
								gf = 2.5;
							}
							var gh = t1_g + t2_g + 0.5;
							
														
							
							//console.log(row_id+' -> '+gf+' - '+gh);

                            var btObj = row.bt;

                            if (Object.keys(btObj).length > 0) {

								var len = Object.keys(btObj).length;
								
								var h_arr = [];
								var over_arr = [];
								var under_arr = [];
								var over_val = '';
								var under_val = '';
								
								var h_arr1 = [];
								var over_arr1 = [];
								var under_arr1 = [];
								var over_val1 = '';
								var under_val1 = '';
								
                                btObj.forEach(function (k) {

									len--;
                                    if (k.n == "1x2") {

										var int = row_id+k.n;

										b2_status[int] = typeof k.b !== "undefined" ? k.b : undefined;
										r2_status[int] = typeof k.r !== "undefined" ? k.r : undefined;

										if(typeof k.o !== "undefined") {

											if (typeof k.o[0] !== "undefined") {
												b3o1_status[int] = k.o[0].hasOwnProperty('b') ? k.o[0].b : undefined;
												r3o1_status[int] = k.o[0].hasOwnProperty('r')  ? k.o[0].r : undefined;
											}

											if (typeof k.o[1] !== "undefined") {
												b3o2_status[int] = k.o[1].hasOwnProperty('b') ? k.o[1].b : undefined;
												r3o2_status[int] = k.o[1].hasOwnProperty('r')  ? k.o[1].r : undefined;
											}

											if (typeof k.o[2] !== "undefined") {
												b3o3_status[int] = k.o[2].hasOwnProperty('b') ? k.o[2].b : undefined;
												r3o3_status[int] = k.o[2].hasOwnProperty('r')  ? k.o[2].r : undefined;
											}
										}

										if(b1_status[row_id] === 1 || b2_status[int] === 1 || r2_status[int] === 1) {
											//console.log("blocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.mw1 = "";

											data.mwx = "";

											data.mw2 = "";

										} else {
											//console.log("unblocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.mw1 = ((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined") ? k.o[0].v : "";

											data.mwx = ((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined") ? k.o[1].v : "";

											data.mw2 = ((typeof b3o3_status[int] !== "undefined" && b3o3_status[int] === 0) || typeof b3o3_status[int] === "undefined") && ((typeof r3o3_status[int] !== "undefined" && r3o3_status[int] === 0) ||  typeof r3o3_status[int] === "undefined") ? k.o[2].v : "";
										}

                                    }



                                    if (k.n == "1x2_H1") {

										var int = row_id+k.n;

										b2_status[int] = typeof k.b !== "undefined" ? k.b : undefined;
										r2_status[int] = typeof k.r !== "undefined" ? k.r : undefined;

										if(typeof k.o !== "undefined") {

											if (typeof k.o[0] !== "undefined") {
												b3o1_status[int] = k.o[0].hasOwnProperty('b') ? k.o[0].b : undefined;
												r3o1_status[int] = k.o[0].hasOwnProperty('r')  ? k.o[0].r : undefined;
											}

											if (typeof k.o[1] !== "undefined") {
												b3o2_status[int] = k.o[1].hasOwnProperty('b') ? k.o[1].b : undefined;
												r3o2_status[int] = k.o[1].hasOwnProperty('r')  ? k.o[1].r : undefined;
											}

											if (typeof k.o[2] !== "undefined") {
												b3o3_status[int] = k.o[2].hasOwnProperty('b') ? k.o[2].b : undefined;
												r3o3_status[int] = k.o[2].hasOwnProperty('r')  ? k.o[2].r : undefined;
											}
										}

										if(b1_status[row_id] === 1 || b2_status[int] === 1 || r2_status[int] === 1) {

											data.mw1h = "";

											data.mwxh = "";

											data.mw2h = "";

										} else {

											data.mw1h = ((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined") ? k.o[0].v : "";

											data.mwxh = ((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined") ? k.o[1].v : "";

											data.mw2h = ((typeof b3o3_status[int] !== "undefined" && b3o3_status[int] === 0) || typeof b3o3_status[int] === "undefined") && ((typeof r3o3_status[int] !== "undefined" && r3o3_status[int] === 0) ||  typeof r3o3_status[int] === "undefined") ? k.o[2].v : "";
										}


                                    }





                                    if (k.n == "RES_1x2" && k.h == rgh) {
									
										//console.log('RES_1x2 '+row_id + ' - '+ k.h + '->' + rgh);

										var int = row_id+k.n;

										b2_status[int] = typeof k.b !== "undefined" ? k.b : undefined;
										r2_status[int] = typeof k.r !== "undefined" ? k.r : undefined;

										if(typeof k.o !== "undefined") {

											if (typeof k.o[0] !== "undefined") {
												b3o1_status[int] = k.o[0].hasOwnProperty('b') ? k.o[0].b : undefined;
												r3o1_status[int] = k.o[0].hasOwnProperty('r')  ? k.o[0].r : undefined;
											}

											if (typeof k.o[1] !== "undefined") {
												b3o2_status[int] = k.o[1].hasOwnProperty('b') ? k.o[1].b : undefined;
												r3o2_status[int] = k.o[1].hasOwnProperty('r')  ? k.o[1].r : undefined;
											}

											if (typeof k.o[2] !== "undefined") {
												b3o3_status[int] = k.o[2].hasOwnProperty('b') ? k.o[2].b : undefined;
												r3o3_status[int] = k.o[2].hasOwnProperty('r')  ? k.o[2].r : undefined;
											}
										}

										if(b1_status[row_id] === 1 || b2_status[int] === 1 || r2_status[int] === 1) {

											data.rm1 = "";

											data.rmx = "";

											data.rm2 = "";

										} else {

											data.rm1 = ((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined") ? k.o[0].v : "";

											data.rmx = ((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined") ? k.o[1].v : "";

											data.rm2 = ((typeof b3o3_status[int] !== "undefined" && b3o3_status[int] === 0) || typeof b3o3_status[int] === "undefined") && ((typeof r3o3_status[int] !== "undefined" && r3o3_status[int] === 0) ||  typeof r3o3_status[int] === "undefined") ? k.o[2].v : "";
										}


                                    }





                                    if (k.n == "RES_1x2_H" && k.h == rgh) {

										var int = row_id+k.n;
										//console.log('RES_1x2_H FULL '+row_id+'-> '+k.h+'-'+rgh);

										b2_status[int] = typeof k.b !== "undefined" ? k.b : undefined;
										r2_status[int] = typeof k.r !== "undefined" ? k.r : undefined;

										if(typeof k.o !== "undefined") {

											if (typeof k.o[0] !== "undefined") {
												b3o1_status[int] = k.o[0].hasOwnProperty('b') ? k.o[0].b : undefined;
												r3o1_status[int] = k.o[0].hasOwnProperty('r')  ? k.o[0].r : undefined;
											}

											if (typeof k.o[1] !== "undefined") {
												b3o2_status[int] = k.o[1].hasOwnProperty('b') ? k.o[1].b : undefined;
												r3o2_status[int] = k.o[1].hasOwnProperty('r')  ? k.o[1].r : undefined;
											}

											if (typeof k.o[2] !== "undefined") {
												b3o3_status[int] = k.o[2].hasOwnProperty('b') ? k.o[2].b : undefined;
												r3o3_status[int] = k.o[2].hasOwnProperty('r')  ? k.o[2].r : undefined;
											}
										}

										if(b1_status[row_id] === 1 || b2_status[int] === 1 || r2_status[int] === 1) {

											data.rm1h = "";

											data.rmxh = "";

											data.rm2h = "";

										} else {

											data.rm1h = ((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined") ? k.o[0].v : "";

											data.rmxh = ((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined") ? k.o[1].v : "";

											data.rm2h = ((typeof b3o3_status[int] !== "undefined" && b3o3_status[int] === 0) || typeof b3o3_status[int] === "undefined") && ((typeof r3o3_status[int] !== "undefined" && r3o3_status[int] === 0) ||  typeof r3o3_status[int] === "undefined") ? k.o[2].v : "";
										}


                                    }





                                    if (k.n == S1G) {

										var int = row_id+"SG";

										b2_status[int] = typeof k.b !== "undefined" ? k.b : undefined;
										r2_status[int] = typeof k.r !== "undefined" ? k.r : undefined;

										if(typeof k.o !== "undefined") {

											if (typeof k.o[0] !== "undefined") {
												b3o1_status[int] = k.o[0].hasOwnProperty('b') ? k.o[0].b : undefined;
												r3o1_status[int] = k.o[0].hasOwnProperty('r')  ? k.o[0].r : undefined;
											}

											if (typeof k.o[1] !== "undefined") {
												b3o2_status[int] = k.o[1].hasOwnProperty('b') ? k.o[1].b : undefined;
												r3o2_status[int] = k.o[1].hasOwnProperty('r')  ? k.o[1].r : undefined;
											}

											if (typeof k.o[2] !== "undefined") {
												b3o3_status[int] = k.o[2].hasOwnProperty('b') ? k.o[2].b : undefined;
												r3o3_status[int] = k.o[2].hasOwnProperty('r')  ? k.o[2].r : undefined;
											}
										}

										if(b1_status[row_id] === 1 || b2_status[int] === 1 || r2_status[int] === 1) {

											data.ng1 = "";

											data.ngx = "";

											data.ng2 = "";

										} else {

											data.ng1 = ((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined") ? k.o[0].v : "";

											data.ngx = ((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined") ? k.o[1].v : "";

											data.ng2 = ((typeof b3o3_status[int] !== "undefined" && b3o3_status[int] === 0) || typeof b3o3_status[int] === "undefined") && ((typeof r3o3_status[int] !== "undefined" && r3o3_status[int] === 0) ||  typeof r3o3_status[int] === "undefined") ? k.o[2].v : "";
										}

                                    }





                                    if (k.n == S1G_H1) {

										var int = row_id+"SGH1";

										b2_status[int] = typeof k.b !== "undefined" ? k.b : undefined;
										r2_status[int] = typeof k.r !== "undefined" ? k.r : undefined;

										if(typeof k.o !== "undefined") {

											if (typeof k.o[0] !== "undefined") {
												b3o1_status[int] = k.o[0].hasOwnProperty('b') ? k.o[0].b : undefined;
												r3o1_status[int] = k.o[0].hasOwnProperty('r')  ? k.o[0].r : undefined;
											}

											if (typeof k.o[1] !== "undefined") {
												b3o2_status[int] = k.o[1].hasOwnProperty('b') ? k.o[1].b : undefined;
												r3o2_status[int] = k.o[1].hasOwnProperty('r')  ? k.o[1].r : undefined;
											}

											if (typeof k.o[2] !== "undefined") {
												b3o3_status[int] = k.o[2].hasOwnProperty('b') ? k.o[2].b : undefined;
												r3o3_status[int] = k.o[2].hasOwnProperty('r')  ? k.o[2].r : undefined;
											}
										}

										if(b1_status[row_id] === 1 || b2_status[int] === 1 || r2_status[int] === 1) {

											data.ng1h = "";

											data.ngxh = "";

											data.ng2h = "";

										} else {

											data.ng1h = ((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined") ? k.o[0].v : "";

											data.ngxh = ((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined") ? k.o[1].v : "";

											data.ng2h = ((typeof b3o3_status[int] !== "undefined" && b3o3_status[int] === 0) || typeof b3o3_status[int] === "undefined") && ((typeof r3o3_status[int] !== "undefined" && r3o3_status[int] === 0) ||  typeof r3o3_status[int] === "undefined") ? k.o[2].v : "";
										}


                                    }


									if(k.n == "OU" && typeof k.o !== "undefined" && typeof k.h !== "undefined"){
											h_arr.push(k.h);
											over_arr.push(parseFloat(k.o[0].v));
											under_arr.push(parseFloat(k.o[1].v));
											
									}
									
									if(len==0){
										//console.log(row_id+' --------> '+len);
										/*for (var i = 0; i < h_arr.length; i++) {
										  console.log('Value Array [' + i + ']' +row_id+' is: ' + h_arr[i]);
										}*/
										var gff = gf + 1;
										var gfff = gf + 2;
										var gfm = gf - 1;
										var gfmm = gf - 2;
										
										if(h_arr.indexOf(gf) >= 0){
											
											if(parseFloat(over_arr[h_arr.indexOf(gf)]) < 1.3){
												
												if(h_arr.indexOf(gff) >= 0){
													if(parseFloat(over_arr[h_arr.indexOf(gff)]) < 1.3){
														if(h_arr.indexOf(gfff) >= 0){
															if(parseFloat(over_arr[h_arr.indexOf(gfff)]) > 3 && gfff > total_g5){
																over_val = over_arr[h_arr.indexOf(gff)];
																under_val = under_arr[h_arr.indexOf(gff)];
																data.to = gff;
															}else{
																over_val = over_arr[h_arr.indexOf(gfff)];
																under_val = under_arr[h_arr.indexOf(gfff)];
																data.to = gfff;
															}
														}else{
															over_val = over_arr[h_arr.indexOf(gff)];
															under_val = under_arr[h_arr.indexOf(gff)];
															data.to = gff;
														}
													}else if(parseFloat(over_arr[h_arr.indexOf(gff)]) > 3 && gff > total_g5){
														
														over_val = over_arr[h_arr.indexOf(gf)];
														under_val = under_arr[h_arr.indexOf(gf)];
														data.to = gf;
													}else{
														over_val = over_arr[h_arr.indexOf(gff)];
														under_val = under_arr[h_arr.indexOf(gff)];
														data.to = gff;
													}
												}else{
													over_val = over_arr[h_arr.indexOf(gf)];
													under_val = under_arr[h_arr.indexOf(gf)];
													data.to = gf;
												}
											}else if(parseFloat(over_arr[h_arr.indexOf(gf)]) > 3 && gf > total_g5){
												if(h_arr.indexOf(gfm) >= 0){
													over_val = over_arr[h_arr.indexOf(gfm)];
													under_val = under_arr[h_arr.indexOf(gfm)];
													data.to = gfm;
												}else{
													over_val = over_arr[h_arr.indexOf(gf)];
													under_val = under_arr[h_arr.indexOf(gf)];
													data.to = gf;
												}
											}else{
												over_val = over_arr[h_arr.indexOf(gf)];
												under_val = under_arr[h_arr.indexOf(gf)];
												data.to = gf;
											}
											
											
											
											data.to0 = over_val;
											data.to1 = under_val;
											//console.log('Array List 1 ' +row_id+' - ' + h_arr[h_arr.indexOf(gf)] +'--'+ over_arr[h_arr.indexOf(gf)]);
											
										}else if(h_arr.indexOf(gff) >= 0){
											gf = gff;
											if(parseFloat(over_arr[h_arr.indexOf(gf)]) < 1.3){
												var gff = gf + 1;
												if(h_arr.indexOf(gff) >= 0){
													over_val = over_arr[h_arr.indexOf(gff)];
													under_val = under_arr[h_arr.indexOf(gff)];
													data.to = gff;
												}else{
													over_val = over_arr[h_arr.indexOf(gf)];
													under_val = under_arr[h_arr.indexOf(gf)];
													data.to = gf;
												}
											}else{
												over_val = over_arr[h_arr.indexOf(gf)];
												under_val = under_arr[h_arr.indexOf(gf)];
												data.to = gf;
											}
											data.to0 = over_val;
											data.to1 = under_val;
											//console.log('Array List 2 ' +row_id+' - ' + h_arr[h_arr.indexOf(gf)] +'--'+ over_arr[h_arr.indexOf(gf)]);
										}
										
										
										
									}
									
									//over_p != '' &&
									/*if( over_o != '' && over_n != '' ){
										
										console.log('OU FULL '+row_id+'->'+ over_p + ':'+ under_p + ' - ' + over_o + ':'+ under_o + ' - '+ over_n + ':'+ under_n +'**'+ gf);
									
										if(over_o < 1.3){
											data.to = gf + 1;
											over = over_n;
											under = under_n
										} else if(over_o > 3 && gf > total_g5){
											data.to = gf - 1;
											over = over_p;
											under = under_p;
										} else{
											data.to = gf;
											over = over_o;
											under = under_o;
										}
										
										//////////////
										
										var int = row_id+k.n;*/

										/*b2_status[int] = typeof k.b !== "undefined" ? k.b : undefined;
										r2_status[int] = typeof k.r !== "undefined" ? k.r : undefined;

										if(typeof k.o !== "undefined") {

											if (typeof k.o[0] !== "undefined") {
												b3o1_status[int] = k.o[0].hasOwnProperty('b') ? k.o[0].b : undefined;
												r3o1_status[int] = k.o[0].hasOwnProperty('r')  ? k.o[0].r : undefined;
											}

											if (typeof k.o[1] !== "undefined") {
												b3o2_status[int] = k.o[1].hasOwnProperty('b') ? k.o[1].b : undefined;
												r3o2_status[int] = k.o[1].hasOwnProperty('r')  ? k.o[1].r : undefined;
											}

										}
                                        //alert(k.h);
										

										if(b1_status[row_id] === 1 || b2_status[int] === 1 || r2_status[int] === 1) {

											data.to0 = "";

											data.to1 = "";

										} else {*/

											/*data.to0 = ((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined") ? k.o[0].v : "";

											data.to1 = ((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined") ? k.o[1].v : "";*/
											
											/*data.to0 = over;
											data.to1 = under;*/
											

										//}
										
										
									//}


									
									
									
									if(k.n == "OU_H1" && typeof k.o !== "undefined" && typeof k.h !== "undefined"){
										h_arr1.push(k.h);
										over_arr1.push(parseFloat(k.o[0].v));
										under_arr1.push(parseFloat(k.o[1].v));
											
									}
									
									if(len==0){
										//console.log(row_id+' --------> '+len);
										/*for (var i = 0; i < h_arr.length; i++) {
										  console.log('Value Array [' + i + ']' +row_id+' is: ' + h_arr[i]);
										}*/
										var ghh = gh + 1;
										
										if(h_arr1.indexOf(gh) >= 0){
											
											if(parseFloat(over_arr1[h_arr1.indexOf(gh)]) < 1.3){
												
												if(h_arr1.indexOf(ghh) >= 0){
													over_val1 = over_arr1[h_arr1.indexOf(ghh)];
													under_val1 = under_arr1[h_arr1.indexOf(ghh)];
													data.toh = ghh;
												}else{
													over_val1 = over_arr1[h_arr1.indexOf(gh)];
													under_val1 = under_arr1[h_arr1.indexOf(gh)];
													data.toh = gh;
												}
											}else{
												over_val1 = over_arr1[h_arr1.indexOf(gh)];
												under_val1 = under_arr1[h_arr1.indexOf(gh)];
												data.toh = gh;
											}
											data.to0h = over_val1;
											data.to1h = under_val1;
											//console.log('Array List 1 ' +row_id+' - ' + h_arr1[h_arr1.indexOf(gh)] +'--'+ over_arr1[h_arr1.indexOf(gh)]);
											
										}else if(h_arr1.indexOf(ghh) >= 0){
											gh = ghh;
											if(parseFloat(over_arr1[h_arr1.indexOf(gh)]) < 1.3){
												
												if(h_arr1.indexOf(ghh) >= 0){
													over_val1 = over_arr1[h_arr1.indexOf(ghh)];
													under_val1 = under_arr1[h_arr1.indexOf(ghh)];
													data.toh = ghh;
												}else{
													over_val1 = over_arr1[h_arr1.indexOf(gh)];
													under_val1 = under_arr1[h_arr1.indexOf(gh)];
													data.toh = gh;
												}
											}else{
												over_val1 = over_arr1[h_arr1.indexOf(gh)];
												under_val1 = under_arr1[h_arr1.indexOf(gh)];
												data.toh = gh;
											}
											data.to0h = over_val1;
											data.to1h = under_val1;
											//console.log('Array List 2 ' +row_id+' - ' + h_arr1[h_arr1.indexOf(gh)] +'--'+ over_arr1[h_arr1.indexOf(gh)]);
										}
										
										
									}


                                    /*if (k.n == "OU_H1" && k.h == gh) {

										var int = row_id+k.n;

										b2_status[int] = typeof k.b !== "undefined" ? k.b : undefined;
										r2_status[int] = typeof k.r !== "undefined" ? k.r : undefined;

										if(typeof k.o !== "undefined") {

											if (typeof k.o[0] !== "undefined") {
												b3o1_status[int] = k.o[0].hasOwnProperty('b') ? k.o[0].b : undefined;
												r3o1_status[int] = k.o[0].hasOwnProperty('r')  ? k.o[0].r : undefined;
											}

											if (typeof k.o[1] !== "undefined") {
												b3o2_status[int] = k.o[1].hasOwnProperty('b') ? k.o[1].b : undefined;
												r3o2_status[int] = k.o[1].hasOwnProperty('r')  ? k.o[1].r : undefined;
											}
										}
										
                                        //alert(row_id +'-'+gh);
										

										if(b1_status[row_id] === 1 || b2_status[int] === 1 || r2_status[int] === 1) {

											data.to0h = "";

											data.to1h = "";

										} else {

											data.to0h = ((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined") ? k.o[0].v : "";

											data.to1h = ((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined") ? k.o[1].v : "";

										}
										
										////
										if(k.o[0].v < 1.3){
											data.toh = gh + 1;
										} else if(k.o[0].v > 3 && gh > total_g5){
											data.toh = gh - 1;
										} else{
											data.toh = gh;
										}


                                    }*/
									
									
									
									
									
									
									if (k.n == "DC") {

										var int = row_id+k.n;

										b2_status[int] = typeof k.b !== "undefined" ? k.b : undefined;
										r2_status[int] = typeof k.r !== "undefined" ? k.r : undefined;

										if(typeof k.o !== "undefined") {

											if (typeof k.o[0] !== "undefined") {
												b3o1_status[int] = k.o[0].hasOwnProperty('b') ? k.o[0].b : undefined;
												r3o1_status[int] = k.o[0].hasOwnProperty('r')  ? k.o[0].r : undefined;
											}

											if (typeof k.o[1] !== "undefined") {
												b3o2_status[int] = k.o[1].hasOwnProperty('b') ? k.o[1].b : undefined;
												r3o2_status[int] = k.o[1].hasOwnProperty('r')  ? k.o[1].r : undefined;
											}

											if (typeof k.o[2] !== "undefined") {
												b3o3_status[int] = k.o[2].hasOwnProperty('b') ? k.o[2].b : undefined;
												r3o3_status[int] = k.o[2].hasOwnProperty('r')  ? k.o[2].r : undefined;
											}
										}

										if(b1_status[row_id] === 1 || b2_status[int] === 1 || r2_status[int] === 1) {
											//console.log("blocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.dc1x = "";

											data.dcx2 = "";

											data.dc12 = "";

										} else {
											//console.log("unblocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.dc1x = ((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined") ? k.o[0].v : "";

											data.dcx2 = ((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined") ? k.o[1].v : "";

											data.dc12 = ((typeof b3o3_status[int] !== "undefined" && b3o3_status[int] === 0) || typeof b3o3_status[int] === "undefined") && ((typeof r3o3_status[int] !== "undefined" && r3o3_status[int] === 0) ||  typeof r3o3_status[int] === "undefined") ? k.o[2].v : "";
										}

                                    }
									
									
									
									
									
									
									if (k.n == "BTS") {

										var int = row_id+k.n;

										b2_status[int] = typeof k.b !== "undefined" ? k.b : undefined;
										r2_status[int] = typeof k.r !== "undefined" ? k.r : undefined;

										if(typeof k.o !== "undefined") {

											if (typeof k.o[0] !== "undefined") {
												b3o1_status[int] = k.o[0].hasOwnProperty('b') ? k.o[0].b : undefined;
												r3o1_status[int] = k.o[0].hasOwnProperty('r')  ? k.o[0].r : undefined;
											}

											if (typeof k.o[1] !== "undefined") {
												b3o2_status[int] = k.o[1].hasOwnProperty('b') ? k.o[1].b : undefined;
												r3o2_status[int] = k.o[1].hasOwnProperty('r')  ? k.o[1].r : undefined;
											}

											
										}

										if(b1_status[row_id] === 1 || b2_status[int] === 1 || r2_status[int] === 1) {
											//console.log("blocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.btsy = "";

											data.btsn = "";


										} else {
											//console.log("unblocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.btsy = ((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined") ? k.o[0].v : "";

											data.btsn = ((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined") ? k.o[1].v : "";

										}

                                    }
									
									
									if (k.n == "BTS_H1") {

										var int = row_id+k.n;

										b2_status[int] = typeof k.b !== "undefined" ? k.b : undefined;
										r2_status[int] = typeof k.r !== "undefined" ? k.r : undefined;

										if(typeof k.o !== "undefined") {

											if (typeof k.o[0] !== "undefined") {
												b3o1_status[int] = k.o[0].hasOwnProperty('b') ? k.o[0].b : undefined;
												r3o1_status[int] = k.o[0].hasOwnProperty('r')  ? k.o[0].r : undefined;
											}

											if (typeof k.o[1] !== "undefined") {
												b3o2_status[int] = k.o[1].hasOwnProperty('b') ? k.o[1].b : undefined;
												r3o2_status[int] = k.o[1].hasOwnProperty('r')  ? k.o[1].r : undefined;
											}

											
										}

										if(b1_status[row_id] === 1 || b2_status[int] === 1 || r2_status[int] === 1) {
											//console.log("blocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.btsyh = "";

											data.btsnh = "";


										} else {
											//console.log("unblocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.btsyh = ((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined") ? k.o[0].v : "";

											data.btsnh = ((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined") ? k.o[1].v : "";

										}

                                    }
									
									
									
									if (k.n == "OU" && k.h == "0.5") {

										var int = row_id+k.n;

										b2_status[int] = typeof k.b !== "undefined" ? k.b : undefined;
										r2_status[int] = typeof k.r !== "undefined" ? k.r : undefined;

										if(typeof k.o !== "undefined") {

											if (typeof k.o[0] !== "undefined") {
												b3o1_status[int] = k.o[0].hasOwnProperty('b') ? k.o[0].b : undefined;
												r3o1_status[int] = k.o[0].hasOwnProperty('r')  ? k.o[0].r : undefined;
											}

											if (typeof k.o[1] !== "undefined") {
												b3o2_status[int] = k.o[1].hasOwnProperty('b') ? k.o[1].b : undefined;
												r3o2_status[int] = k.o[1].hasOwnProperty('r')  ? k.o[1].r : undefined;
											}

											
										}

										if(b1_status[row_id] === 1 || b2_status[int] === 1 || r2_status[int] === 1) {
											//console.log("blocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.ou_o05 = "";

											data.ou_u05 = "";

											
										} else {
											//console.log("unblocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.ou_o05 = ((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined") ? k.o[0].v : "";

											data.ou_u05 = ((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined") ? k.o[1].v : "";

										}

                                    }
																		
																		
									if (k.n == "OU" && k.h == "1.5") {

										var int = row_id+k.n;

										b2_status[int] = typeof k.b !== "undefined" ? k.b : undefined;
										r2_status[int] = typeof k.r !== "undefined" ? k.r : undefined;

										if(typeof k.o !== "undefined") {

											if (typeof k.o[0] !== "undefined") {
												b3o1_status[int] = k.o[0].hasOwnProperty('b') ? k.o[0].b : undefined;
												r3o1_status[int] = k.o[0].hasOwnProperty('r')  ? k.o[0].r : undefined;
											}

											if (typeof k.o[1] !== "undefined") {
												b3o2_status[int] = k.o[1].hasOwnProperty('b') ? k.o[1].b : undefined;
												r3o2_status[int] = k.o[1].hasOwnProperty('r')  ? k.o[1].r : undefined;
											}

											
										}

										if(b1_status[row_id] === 1 || b2_status[int] === 1 || r2_status[int] === 1) {
											//console.log("blocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.ou_o15 = "";

											data.ou_u15 = "";

											
										} else {
											//console.log("unblocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.ou_o15 = ((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined") ? k.o[0].v : "";

											data.ou_u15 = ((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined") ? k.o[1].v : "";

										}

                                    }
																		
									
									if (k.n == "OU" && k.h == "2.5") {

										var int = row_id+k.n;

										b2_status[int] = typeof k.b !== "undefined" ? k.b : undefined;
										r2_status[int] = typeof k.r !== "undefined" ? k.r : undefined;

										if(typeof k.o !== "undefined") {

											if (typeof k.o[0] !== "undefined") {
												b3o1_status[int] = k.o[0].hasOwnProperty('b') ? k.o[0].b : undefined;
												r3o1_status[int] = k.o[0].hasOwnProperty('r')  ? k.o[0].r : undefined;
											}

											if (typeof k.o[1] !== "undefined") {
												b3o2_status[int] = k.o[1].hasOwnProperty('b') ? k.o[1].b : undefined;
												r3o2_status[int] = k.o[1].hasOwnProperty('r')  ? k.o[1].r : undefined;
											}

											
										}

										if(b1_status[row_id] === 1 || b2_status[int] === 1 || r2_status[int] === 1) {
											//console.log("blocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.ou_o25 = "";

											data.ou_u25 = "";

											
										} else {
											//console.log("unblocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.ou_o25 = ((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined") ? k.o[0].v : "";

											data.ou_u25 = ((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined") ? k.o[1].v : "";

										}

                                    }
									
									
									if (k.n == "OU" && k.h == "3.5") {

										var int = row_id+k.n;

										b2_status[int] = typeof k.b !== "undefined" ? k.b : undefined;
										r2_status[int] = typeof k.r !== "undefined" ? k.r : undefined;

										if(typeof k.o !== "undefined") {

											if (typeof k.o[0] !== "undefined") {
												b3o1_status[int] = k.o[0].hasOwnProperty('b') ? k.o[0].b : undefined;
												r3o1_status[int] = k.o[0].hasOwnProperty('r')  ? k.o[0].r : undefined;
											}

											if (typeof k.o[1] !== "undefined") {
												b3o2_status[int] = k.o[1].hasOwnProperty('b') ? k.o[1].b : undefined;
												r3o2_status[int] = k.o[1].hasOwnProperty('r')  ? k.o[1].r : undefined;
											}

											
										}

										if(b1_status[row_id] === 1 || b2_status[int] === 1 || r2_status[int] === 1) {
											//console.log("blocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.ou_o35 = "";

											data.ou_u35 = "";

											
										} else {
											//console.log("unblocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.ou_o35 = ((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined") ? k.o[0].v : "";

											data.ou_u35 = ((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined") ? k.o[1].v : "";

										}

                                    }
									
									
									if (k.n == "OU" && k.h == "4.5") {

										var int = row_id+k.n;

										b2_status[int] = typeof k.b !== "undefined" ? k.b : undefined;
										r2_status[int] = typeof k.r !== "undefined" ? k.r : undefined;

										if(typeof k.o !== "undefined") {

											if (typeof k.o[0] !== "undefined") {
												b3o1_status[int] = k.o[0].hasOwnProperty('b') ? k.o[0].b : undefined;
												r3o1_status[int] = k.o[0].hasOwnProperty('r')  ? k.o[0].r : undefined;
											}

											if (typeof k.o[1] !== "undefined") {
												b3o2_status[int] = k.o[1].hasOwnProperty('b') ? k.o[1].b : undefined;
												r3o2_status[int] = k.o[1].hasOwnProperty('r')  ? k.o[1].r : undefined;
											}

											
										}

										if(b1_status[row_id] === 1 || b2_status[int] === 1 || r2_status[int] === 1) {
											//console.log("blocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.ou_o45 = "";

											data.ou_u45 = "";

											
										} else {
											//console.log("unblocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.ou_o45 = ((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined") ? k.o[0].v : "";

											data.ou_u45 = ((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined") ? k.o[1].v : "";

										}

                                    }
									
									
									if (k.n == "OU" && k.h == "5.5") {

										var int = row_id+k.n;

										b2_status[int] = typeof k.b !== "undefined" ? k.b : undefined;
										r2_status[int] = typeof k.r !== "undefined" ? k.r : undefined;

										if(typeof k.o !== "undefined") {

											if (typeof k.o[0] !== "undefined") {
												b3o1_status[int] = k.o[0].hasOwnProperty('b') ? k.o[0].b : undefined;
												r3o1_status[int] = k.o[0].hasOwnProperty('r')  ? k.o[0].r : undefined;
											}

											if (typeof k.o[1] !== "undefined") {
												b3o2_status[int] = k.o[1].hasOwnProperty('b') ? k.o[1].b : undefined;
												r3o2_status[int] = k.o[1].hasOwnProperty('r')  ? k.o[1].r : undefined;
											}

											
										}

										if(b1_status[row_id] === 1 || b2_status[int] === 1 || r2_status[int] === 1) {
											//console.log("blocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.ou_o55 = "";

											data.ou_u55 = "";

											
										} else {
											//console.log("unblocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.ou_o55 = ((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined") ? k.o[0].v : "";

											data.ou_u55 = ((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined") ? k.o[1].v : "";

										}

                                    }
									
									
									if (k.n == "OU" && k.h == "6.5") {

										var int = row_id+k.n;

										b2_status[int] = typeof k.b !== "undefined" ? k.b : undefined;
										r2_status[int] = typeof k.r !== "undefined" ? k.r : undefined;

										if(typeof k.o !== "undefined") {

											if (typeof k.o[0] !== "undefined") {
												b3o1_status[int] = k.o[0].hasOwnProperty('b') ? k.o[0].b : undefined;
												r3o1_status[int] = k.o[0].hasOwnProperty('r')  ? k.o[0].r : undefined;
											}

											if (typeof k.o[1] !== "undefined") {
												b3o2_status[int] = k.o[1].hasOwnProperty('b') ? k.o[1].b : undefined;
												r3o2_status[int] = k.o[1].hasOwnProperty('r')  ? k.o[1].r : undefined;
											}

											
										}

										if(b1_status[row_id] === 1 || b2_status[int] === 1 || r2_status[int] === 1) {
											//console.log("blocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.ou_o65 = "";

											data.ou_u65 = "";

											
										} else {
											//console.log("unblocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.ou_o65 = ((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined") ? k.o[0].v : "";

											data.ou_u65 = ((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined") ? k.o[1].v : "";

										}

                                    }
									
									
									if (k.n == "OU" && k.h == "7.5") {

										var int = row_id+k.n;

										b2_status[int] = typeof k.b !== "undefined" ? k.b : undefined;
										r2_status[int] = typeof k.r !== "undefined" ? k.r : undefined;

										if(typeof k.o !== "undefined") {

											if (typeof k.o[0] !== "undefined") {
												b3o1_status[int] = k.o[0].hasOwnProperty('b') ? k.o[0].b : undefined;
												r3o1_status[int] = k.o[0].hasOwnProperty('r')  ? k.o[0].r : undefined;
											}

											if (typeof k.o[1] !== "undefined") {
												b3o2_status[int] = k.o[1].hasOwnProperty('b') ? k.o[1].b : undefined;
												r3o2_status[int] = k.o[1].hasOwnProperty('r')  ? k.o[1].r : undefined;
											}

											
										}

										if(b1_status[row_id] === 1 || b2_status[int] === 1 || r2_status[int] === 1) {
											//console.log("blocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.ou_o75 = "";

											data.ou_u75 = "";

											
										} else {
											//console.log("unblocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.ou_o75 = ((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined") ? k.o[0].v : "";

											data.ou_u75 = ((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined") ? k.o[1].v : "";

										}

                                    }
									
									
									if (k.n == "OU" && k.h == "8.5") {

										var int = row_id+k.n;

										b2_status[int] = typeof k.b !== "undefined" ? k.b : undefined;
										r2_status[int] = typeof k.r !== "undefined" ? k.r : undefined;

										if(typeof k.o !== "undefined") {

											if (typeof k.o[0] !== "undefined") {
												b3o1_status[int] = k.o[0].hasOwnProperty('b') ? k.o[0].b : undefined;
												r3o1_status[int] = k.o[0].hasOwnProperty('r')  ? k.o[0].r : undefined;
											}

											if (typeof k.o[1] !== "undefined") {
												b3o2_status[int] = k.o[1].hasOwnProperty('b') ? k.o[1].b : undefined;
												r3o2_status[int] = k.o[1].hasOwnProperty('r')  ? k.o[1].r : undefined;
											}

											
										}

										if(b1_status[row_id] === 1 || b2_status[int] === 1 || r2_status[int] === 1) {
											//console.log("blocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.ou_o85 = "";

											data.ou_u85 = "";

											
										} else {
											//console.log("unblocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.ou_o85 = ((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined") ? k.o[0].v : "";

											data.ou_u85 = ((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined") ? k.o[1].v : "";

										}

                                    }
									
									
									if (k.n == "OU" && k.h == "9.5") {

										var int = row_id+k.n;

										b2_status[int] = typeof k.b !== "undefined" ? k.b : undefined;
										r2_status[int] = typeof k.r !== "undefined" ? k.r : undefined;

										if(typeof k.o !== "undefined") {

											if (typeof k.o[0] !== "undefined") {
												b3o1_status[int] = k.o[0].hasOwnProperty('b') ? k.o[0].b : undefined;
												r3o1_status[int] = k.o[0].hasOwnProperty('r')  ? k.o[0].r : undefined;
											}

											if (typeof k.o[1] !== "undefined") {
												b3o2_status[int] = k.o[1].hasOwnProperty('b') ? k.o[1].b : undefined;
												r3o2_status[int] = k.o[1].hasOwnProperty('r')  ? k.o[1].r : undefined;
											}

											
										}

										if(b1_status[row_id] === 1 || b2_status[int] === 1 || r2_status[int] === 1) {
											//console.log("blocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.ou_o95 = "";

											data.ou_u95 = "";

											
										} else {
											//console.log("unblocking market 1x2 from F "+row_id+' match b ='+b1_status[row_id]);
											data.ou_o95 = ((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined") ? k.o[0].v : "";

											data.ou_u95 = ((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined") ? k.o[1].v : "";

										}

                                    }
									
									
									
									





                                });



                            }





                            rows += parse_template(data);
							





                        }



                    });
					

					
					
					/// Insert Full Live Date

					/*$.ajax({  

					type: "POST",  

					data: "&event_id_array=" + event_id_array + "&std_id_array=" + std_id_array + "&t1_name_array=" + t1_name_array + "&t2_name_array=" + t2_name_array, 

					url: "ajax_eventId_live.php"

					});*/





                    // update the view
					//alert("Full");
                    if(rows!=''){ 
						$("#live_matches").append(rows);
						//$("#live_matches").html(rows);
						
					} 
					/*if($("#live_matches_temp").html()!=''){
						$("#live_matches").html($("#live_matches_temp").html());
					}*/
					

					

					// full lock

					list_rows.forEach(function (row) {  // in this loop you should add all the event_ids



                        var row_id = row["id"];
						var iventId = row_id;
						
						/// NEW FULL ODDS UPD
						/*var over_under_h = $('#over_under_h' + row_id).html();
						var over_under_hn = $('#over_under_hn' + row_id).html();
						console.log('over_under_h -> '+ over_under_h + '<->' + over_under_hn);
						//over_under_o6063613
						//over_under_u6063613*/
						

						/// Finished Match Remove

						if($('#match_status' + row_id).html()=="Finished"){

							$("#ind_game_feed"+row_id).remove();

						}

						// Second Half Hide Div

						if($('#match_status' + row_id).html()=='Halftime'){

							$('#match_current_time' + row_id).html('HT');						

						}

						if($('#match_status' + row_id).html()=='Second Half' || $('#match_status' + row_id).html()=='Halftime'){

							$('#sh_div' + row_id).hide();

							

							$('#ss_enabled_ax2h1' + row_id).hide();

							$('#ss_enabled_resh1' + row_id).hide();

							$('#ss_enabled_s1gh1' + row_id).hide();

							$('#ss_enabled_ovh1' + row_id).hide();

							$('#over_under_hn' + row_id).hide();

							$('#S_' + row_id).hide();

							$('#ind_game_feed' + row_id).css({"height": "44px"});

							$('#league_name' + row_id).show();

						}

						

						// Green Color Add	

						if($('#match_status' + row_id).html()!='Not Started'){

							$('#ind_game_feed' + row_id).addClass("greenRow");

							$('#match_current_time' + row_id).show();

							if( parseInt( $('#match_current_time' + row_id).html() , 10) < 0 ) $('#match_current_time' + row_id).html("0'");

						}				

						

						//alert(row_id);

						/// LOCK

							var int = iventId+"1x2";


							if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

								$('#1x2_val_1' + iventId).hide();

								$('#1x2_val_x' + iventId).hide();

								$('#1x2_val_2' + iventId).hide();


								$('#1x2_val_1_L' + iventId).show();

								$('#1x2_val_x_L' + iventId).show();

								$('#1x2_val_2_L' + iventId).show();


							} else {

								if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
									$('#1x2_val_1' + iventId).hide();
									$('#1x2_val_1_L' + iventId).show();
								} else if (((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
									$('#1x2_val_1' + iventId).show();
									$('#1x2_val_1_L' + iventId).hide();
								}

								if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
									$('#1x2_val_x' + iventId).hide();
									$('#1x2_val_x_L' + iventId).show();
								} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
									$('#1x2_val_x' + iventId).show();
									$('#1x2_val_x_L' + iventId).hide();
								}

								if((typeof b3o3_status[int] !== 'undefined' && b3o3_status[int] === 1) || (typeof r3o3_status[int] !== 'undefined' && r3o3_status[int] === 1)) {
									$('#1x2_val_2' + iventId).hide();
									$('#1x2_val_2_L' + iventId).show();
								} else if(((typeof b3o3_status[int] !== "undefined" && b3o3_status[int] === 0) || typeof b3o3_status[int] === "undefined") && ((typeof r3o3_status[int] !== "undefined" && r3o3_status[int] === 0) ||  typeof r3o3_status[int] === "undefined")) {
									$('#1x2_val_2' + iventId).show();
									$('#1x2_val_2_L' + iventId).hide();
								}

							}

							var int = iventId+"1x2_H1";


							if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

								$('#1x2h1_val_1' + iventId).hide();

								$('#1x2h1_val_x' + iventId).hide();

								$('#1x2h1_val_2' + iventId).hide();



								$('#1x2h1_val_1_L' + iventId).show();

								$('#1x2h1_val_x_L' + iventId).show();

								$('#1x2h1_val_2_L' + iventId).show();


							} else {

								if ((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
									$('#1x2h1_val_1' + iventId).hide();
									$('#1x2h1_val_1_L' + iventId).show();
								} else if (((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) || typeof r3o1_status[int] === "undefined")) {
									$('#1x2h1_val_1' + iventId).show();
									$('#1x2h1_val_1_L' + iventId).hide();
								}

								if ((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
									$('#1x2h1_val_x' + iventId).hide();
									$('#1x2h1_val_x_L' + iventId).show();
								} else if (((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) || typeof r3o2_status[int] === "undefined")) {
									$('#1x2h1_val_x' + iventId).show();
									$('#1x2h1_val_x_L' + iventId).hide();
								}

								if ((typeof b3o3_status[int] !== 'undefined' && b3o3_status[int] === 1) || (typeof r3o3_status[int] !== 'undefined' && r3o3_status[int] === 1)) {
									$('#1x2h1_val_2' + iventId).hide();
									$('#1x2h1_val_2_L' + iventId).show();
								} else if (((typeof b3o3_status[int] !== "undefined" && b3o3_status[int] === 0) || typeof b3o3_status[int] === "undefined") && ((typeof r3o3_status[int] !== "undefined" && r3o3_status[int] === 0) || typeof r3o3_status[int] === "undefined")) {
									$('#1x2h1_val_2' + iventId).show();
									$('#1x2h1_val_2_L' + iventId).hide();
								}

							}

							var int = iventId+"RES_1x2";

							if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

								$('#res_val_1' + iventId).hide();

								$('#res_val_x' + iventId).hide();

								$('#res_val_2' + iventId).hide();



								$('#res_val_1_L' + iventId).show();

								$('#res_val_x_L' + iventId).show();

								$('#res_val_2_L' + iventId).show();


							} else {

								if ((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
									$('#res_val_1' + iventId).hide();
									$('#res_val_1_L' + iventId).show();
								} else if (((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) || typeof r3o1_status[int] === "undefined")) {
									$('#res_val_1' + iventId).show();
									$('#res_val_1_L' + iventId).hide();
								}

								if ((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
									$('#res_val_x' + iventId).hide();
									$('#res_val_x_L' + iventId).show();
								} else if (((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) || typeof r3o2_status[int] === "undefined")) {
									$('#res_val_x' + iventId).show();
									$('#res_val_x_L' + iventId).hide();
								}

								if ((typeof b3o3_status[int] !== 'undefined' && b3o3_status[int] === 1) || (typeof r3o3_status[int] !== 'undefined' && r3o3_status[int] === 1)) {
									$('#res_val_2' + iventId).hide();
									$('#res_val_2_L' + iventId).show();
								} else if (((typeof b3o3_status[int] !== "undefined" && b3o3_status[int] === 0) || typeof b3o3_status[int] === "undefined") && ((typeof r3o3_status[int] !== "undefined" && r3o3_status[int] === 0) || typeof r3o3_status[int] === "undefined")) {
									$('#res_val_2' + iventId).show();
									$('#res_val_2_L' + iventId).hide();
								}
							}

							var int = iventId+"RES_1x2_H";


							if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

								$('#resh1_val_1' + iventId).hide();

								$('#resh1_val_x' + iventId).hide();

								$('#resh1_val_2' + iventId).hide();



								$('#resh1_val_1_L' + iventId).show();

								$('#resh1_val_x_L' + iventId).show();

								$('#resh1_val_2_L' + iventId).show();


							} else {

								if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
									$('#resh_val_1' + iventId).hide();
									$('#resh_val_1_L' + iventId).show();
								} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
									$('#resh_val_1' + iventId).show();
									$('#resh_val_1_L' + iventId).hide();
								}

								if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
									$('#resh_val_x' + iventId).hide();
									$('#resh_val_x_L' + iventId).show();
								} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
									$('#resh_val_x' + iventId).show();
									$('#resh_val_x_L' + iventId).hide();
								}

								if((typeof b3o3_status[int] !== 'undefined' && b3o3_status[int] === 1) || (typeof r3o3_status[int] !== 'undefined' && r3o3_status[int] === 1)) {
									$('#resh_val_2' + iventId).hide();
									$('#resh_val_2_L' + iventId).show();
								} else if(((typeof b3o3_status[int] !== "undefined" && b3o3_status[int] === 0) || typeof b3o3_status[int] === "undefined") && ((typeof r3o3_status[int] !== "undefined" && r3o3_status[int] === 0) ||  typeof r3o3_status[int] === "undefined")) {
									$('#resh_val_2' + iventId).show();
									$('#resh_val_2_L' + iventId).hide();
								}


							}


							var int = iventId+"SG";


							if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

								$('#s1g_val_1' + iventId).hide();

								$('#s1g_val_x' + iventId).hide();

								$('#s1g_val_2' + iventId).hide();



								$('#s1g_val_1_L' + iventId).show();

								$('#s1g_val_x_L' + iventId).show();

								$('#s1g_val_2_L' + iventId).show();


							} else {

								if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
									$('#s1g_val_1' + iventId).hide();
									$('#s1g_val_1_L' + iventId).show();
								} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
									$('#s1g_val_1' + iventId).show();
									$('#s1g_val_1_L' + iventId).hide();
								}

								if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
									$('#s1g_val_x' + iventId).hide();
									$('#s1g_val_x_L' + iventId).show();
								} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
									$('#s1g_val_x' + iventId).show();
									$('#s1g_val_x_L' + iventId).hide();
								}

								if((typeof b3o3_status[int] !== 'undefined' && b3o3_status[int] === 1) || (typeof r3o3_status[int] !== 'undefined' && r3o3_status[int] === 1)) {
									$('#s1g_val_2' + iventId).hide();
									$('#s1g_val_2_L' + iventId).show();
								} else if(((typeof b3o3_status[int] !== "undefined" && b3o3_status[int] === 0) || typeof b3o3_status[int] === "undefined") && ((typeof r3o3_status[int] !== "undefined" && r3o3_status[int] === 0) ||  typeof r3o3_status[int] === "undefined")) {
									$('#s1g_val_2' + iventId).show();
									$('#s1g_val_2_L' + iventId).hide();
								}

							}



							var int = "SGH1";


							if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

								$('#s1gh1_val_1' + iventId).hide();

								$('#s1gh1_val_x' + iventId).hide();

								$('#s1gh1_val_2' + iventId).hide();



								$('#s1gh1_val_1_L' + iventId).show();

								$('#s1gh1_val_x_L' + iventId).show();

								$('#s1gh1_val_2_L' + iventId).show();

							} else {

								if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
									$('#s1gh1_val_1' + iventId).hide();
									$('#s1gh1_val_1_L' + iventId).show();
								} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
									$('#s1gh1_val_1' + iventId).show();
									$('#s1gh1_val_1_L' + iventId).hide();
								}

								if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
									$('#s1gh1_val_x' + iventId).hide();
									$('#s1gh1_val_x_L' + iventId).show();
								} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
									$('#s1gh1_val_x' + iventId).show();
									$('#s1gh1_val_x_L' + iventId).hide();
								}

								if((typeof b3o3_status[int] !== 'undefined' && b3o3_status[int] === 1) || (typeof r3o3_status[int] !== 'undefined' && r3o3_status[int] === 1)) {
									$('#s1gh1_val_2' + iventId).hide();
									$('#s1gh1_val_2_L' + iventId).show();
								} else if(((typeof b3o3_status[int] !== "undefined" && b3o3_status[int] === 0) || typeof b3o3_status[int] === "undefined") && ((typeof r3o3_status[int] !== "undefined" && r3o3_status[int] === 0) ||  typeof r3o3_status[int] === "undefined")) {
									$('#s1gh1_val_2' + iventId).show();
									$('#s1gh1_val_2_L' + iventId).hide();
								}

							}

							var int = iventId+"OU";


							if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

								$('#over_under_o' + iventId).hide();

								$('#over_under_u' + iventId).hide();


								$('#over_under_o_L' + iventId).show();

								$('#over_under_u_L' + iventId).show();


							} else  {

								if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
									$('#over_under_o' + iventId).hide();
									$('#over_under_o_L' + iventId).show();
								} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
									$('#over_under_o' + iventId).show();
									$('#over_under_o_L' + iventId).hide();
								}

								if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
									$('#over_under_u' + iventId).hide();
									$('#over_under_u_L' + iventId).show();
								} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
									$('#over_under_u' + iventId).show();
									$('#over_under_u_L' + iventId).hide();
								}

							}


							var int = iventId+"OU_H1";


							if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

								$('#over_under_oh1' + iventId).hide();

								$('#over_under_uh1' + iventId).hide();



								$('#over_under_oh1_L' + iventId).show();

								$('#over_under_uh1_L' + iventId).show();


							} else {


								if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
									$('#over_under_oh1' + iventId).hide();
									$('#over_under_oh1_L' + iventId).show();
								} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
									$('#over_under_oh1' + iventId).show();
									$('#over_under_oh1_L' + iventId).hide();
								}

								if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
									$('#over_under_uh1' + iventId).hide();
									$('#over_under_uh1_L' + iventId).show();
								} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
									$('#over_under_uh1' + iventId).show();
									$('#over_under_uh1_L' + iventId).hide();
								}


							}
							
							
							
							
							
							
							//DC
							var int = iventId+"DC";


							if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

								$('#double_chance_1x' + iventId).hide();

								$('#double_chance_x2' + iventId).hide();

								$('#double_chance_12' + iventId).hide();


								$('#double_chance_1x_L' + iventId).show();

								$('#double_chance_x2_L' + iventId).show();

								$('#double_chance_12_L' + iventId).show();


							} else {

								if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
									$('#double_chance_1x' + iventId).hide();
									$('#double_chance_1x_L' + iventId).show();
								} else if (((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
									$('#double_chance_1x' + iventId).show();
									$('#double_chance_1x_L' + iventId).hide();
								}

								if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
									$('#double_chance_x2' + iventId).hide();
									$('#double_chance_x2_L' + iventId).show();
								} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
									$('#double_chance_x2' + iventId).show();
									$('#double_chance_x2_L' + iventId).hide();
								}

								if((typeof b3o3_status[int] !== 'undefined' && b3o3_status[int] === 1) || (typeof r3o3_status[int] !== 'undefined' && r3o3_status[int] === 1)) {
									$('#double_chance_12' + iventId).hide();
									$('#double_chance_12_L' + iventId).show();
								} else if(((typeof b3o3_status[int] !== "undefined" && b3o3_status[int] === 0) || typeof b3o3_status[int] === "undefined") && ((typeof r3o3_status[int] !== "undefined" && r3o3_status[int] === 0) ||  typeof r3o3_status[int] === "undefined")) {
									$('#double_chance_12' + iventId).show();
									$('#double_chance_12_L' + iventId).hide();
								}

							}
							
							
							
							//BTS
							var int = iventId+"BTS";


							if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {
							//alert("test");

								$('#bts_yes' + iventId).hide();

								$('#bts_no' + iventId).hide();

								
								$('#bts_yes_L' + iventId).show();

								$('#bts_no_L' + iventId).show();

								

							} else {

								if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
									$('#bts_yes' + iventId).hide();
									$('#bts_yes_L' + iventId).show();
								} else if (((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
									$('#bts_yes' + iventId).show();
									$('#bts_yes_L' + iventId).hide();
								}

								if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
									$('#bts_no' + iventId).hide();
									$('#bts_no_L' + iventId).show();
								} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
									$('#bts_no' + iventId).show();
									$('#bts_no_L' + iventId).hide();
								}

							}
							
							
							
							
							
							//BTS_H1
							var int = iventId+"BTS_H1";


							if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {
							//alert("test");

								$('#bts_yesh1' + iventId).hide();

								$('#bts_noh1' + iventId).hide();

								
								$('#bts_yesh1_L' + iventId).show();

								$('#bts_noh1_L' + iventId).show();

								

							} else {

								if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
									$('#bts_yesh1' + iventId).hide();
									$('#bts_yesh1_L' + iventId).show();
								} else if (((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
									$('#bts_yesh1' + iventId).show();
									$('#bts_yesh1_L' + iventId).hide();
								}

								if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
									$('#bts_noh1' + iventId).hide();
									$('#bts_noh1_L' + iventId).show();
								} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
									$('#bts_noh1' + iventId).show();
									$('#bts_noh1_L' + iventId).hide();
								}

							}
							
							
							
							
						var int = iventId+"OU";


							if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

								$('#ou_o05' + iventId).hide();

								$('#ou_u05' + iventId).hide();


								$('#ou_o05_L' + iventId).show();

								$('#ou_u05_L' + iventId).show();


							} else  {

								if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
									$('#ou_o05' + iventId).hide();
									$('#ou_o05_L' + iventId).show();
								} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
									$('#ou_o05' + iventId).show();
									$('#ou_o05_L' + iventId).hide();
								}

								if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
									$('#ou_u05' + iventId).hide();
									$('#ou_u05_L' + iventId).show();
								} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
									$('#ou_u05' + iventId).show();
									$('#ou_u05_L' + iventId).hide();
								}

							}	
							
							
							//1.5
							var int = iventId+"OU";


							if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

								$('#ou_o15' + iventId).hide();

								$('#ou_u15' + iventId).hide();


								$('#ou_o15_L' + iventId).show();

								$('#ou_u15_L' + iventId).show();


							} else  {

								if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
									$('#ou_o15' + iventId).hide();
									$('#ou_o15_L' + iventId).show();
								} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
									$('#ou_o15' + iventId).show();
									$('#ou_o15_L' + iventId).hide();
								}

								if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
									$('#ou_u15' + iventId).hide();
									$('#ou_u15_L' + iventId).show();
								} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
									$('#ou_u15' + iventId).show();
									$('#ou_u15_L' + iventId).hide();
								}

							}
							
							
							//2.5
							var int = iventId+"OU";


							if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

								$('#ou_o25' + iventId).hide();

								$('#ou_u25' + iventId).hide();


								$('#ou_o25_L' + iventId).show();

								$('#ou_u25_L' + iventId).show();


							} else  {

								if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
									$('#ou_o25' + iventId).hide();
									$('#ou_o25_L' + iventId).show();
								} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
									$('#ou_o25' + iventId).show();
									$('#ou_o25_L' + iventId).hide();
								}

								if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
									$('#ou_u25' + iventId).hide();
									$('#ou_u25_L' + iventId).show();
								} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
									$('#ou_u25' + iventId).show();
									$('#ou_u25_L' + iventId).hide();
								}

							}
							
							
							//3.5
							var int = iventId+"OU";


							if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

								$('#ou_o35' + iventId).hide();

								$('#ou_u35' + iventId).hide();


								$('#ou_o35_L' + iventId).show();

								$('#ou_u35_L' + iventId).show();


							} else  {

								if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
									$('#ou_o35' + iventId).hide();
									$('#ou_o35_L' + iventId).show();
								} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
									$('#ou_o35' + iventId).show();
									$('#ou_o35_L' + iventId).hide();
								}

								if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
									$('#ou_u35' + iventId).hide();
									$('#ou_u35_L' + iventId).show();
								} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
									$('#ou_u35' + iventId).show();
									$('#ou_u35_L' + iventId).hide();
								}

							}
							
							
							//4.5
							var int = iventId+"OU";


							if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

								$('#ou_o45' + iventId).hide();

								$('#ou_u45' + iventId).hide();


								$('#ou_o45_L' + iventId).show();

								$('#ou_u45_L' + iventId).show();


							} else  {

								if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
									$('#ou_o45' + iventId).hide();
									$('#ou_o45_L' + iventId).show();
								} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
									$('#ou_o45' + iventId).show();
									$('#ou_o45_L' + iventId).hide();
								}

								if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
									$('#ou_u45' + iventId).hide();
									$('#ou_u45_L' + iventId).show();
								} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
									$('#ou_u45' + iventId).show();
									$('#ou_u45_L' + iventId).hide();
								}

							}
							
							
							//5.5
							var int = iventId+"OU";


							if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

								$('#ou_o55' + iventId).hide();

								$('#ou_u55' + iventId).hide();


								$('#ou_o55_L' + iventId).show();

								$('#ou_u55_L' + iventId).show();


							} else  {

								if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
									$('#ou_o55' + iventId).hide();
									$('#ou_o55_L' + iventId).show();
								} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
									$('#ou_o55' + iventId).show();
									$('#ou_o55_L' + iventId).hide();
								}

								if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
									$('#ou_u55' + iventId).hide();
									$('#ou_u55_L' + iventId).show();
								} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
									$('#ou_u55' + iventId).show();
									$('#ou_u55_L' + iventId).hide();
								}

							}
							
							
							//6.5
							var int = iventId+"OU";


							if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

								$('#ou_o65' + iventId).hide();

								$('#ou_u65' + iventId).hide();


								$('#ou_o65_L' + iventId).show();

								$('#ou_u65_L' + iventId).show();


							} else  {

								if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
									$('#ou_o65' + iventId).hide();
									$('#ou_o65_L' + iventId).show();
								} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
									$('#ou_o65' + iventId).show();
									$('#ou_o65_L' + iventId).hide();
								}

								if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
									$('#ou_u65' + iventId).hide();
									$('#ou_u65_L' + iventId).show();
								} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
									$('#ou_u65' + iventId).show();
									$('#ou_u65_L' + iventId).hide();
								}

							}
							
							
							//7.5
							var int = iventId+"OU";


							if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

								$('#ou_o75' + iventId).hide();

								$('#ou_u75' + iventId).hide();


								$('#ou_o75_L' + iventId).show();

								$('#ou_u75_L' + iventId).show();


							} else  {

								if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
									$('#ou_o75' + iventId).hide();
									$('#ou_o75_L' + iventId).show();
								} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
									$('#ou_o75' + iventId).show();
									$('#ou_o75_L' + iventId).hide();
								}

								if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
									$('#ou_u75' + iventId).hide();
									$('#ou_u75_L' + iventId).show();
								} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
									$('#ou_u75' + iventId).show();
									$('#ou_u75_L' + iventId).hide();
								}

							}
							
							
							//8.5
							var int = iventId+"OU";


							if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

								$('#ou_o85' + iventId).hide();

								$('#ou_u85' + iventId).hide();


								$('#ou_o85_L' + iventId).show();

								$('#ou_u85_L' + iventId).show();


							} else  {

								if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
									$('#ou_o85' + iventId).hide();
									$('#ou_o85_L' + iventId).show();
								} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
									$('#ou_o85' + iventId).show();
									$('#ou_o85_L' + iventId).hide();
								}

								if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
									$('#ou_u85' + iventId).hide();
									$('#ou_u85_L' + iventId).show();
								} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
									$('#ou_u85' + iventId).show();
									$('#ou_u85_L' + iventId).hide();
								}

							}
							
							
							//9.5
							var int = iventId+"OU";


							if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

								$('#ou_o95' + iventId).hide();

								$('#ou_u95' + iventId).hide();


								$('#ou_o95_L' + iventId).show();

								$('#ou_u95_L' + iventId).show();


							} else  {

								if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
									$('#ou_o95' + iventId).hide();
									$('#ou_o95_L' + iventId).show();
								} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
									$('#ou_o95' + iventId).show();
									$('#ou_o95_L' + iventId).hide();
								}

								if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
									$('#ou_u95' + iventId).hide();
									$('#ou_u95_L' + iventId).show();
								} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
									$('#ou_u95' + iventId).show();
									$('#ou_u95_L' + iventId).hide();
								}

							}




/*
						if($('#1x2_val_1' + row_id).html()==''){

							$('#1x2_val_1' + row_id).hide();

							$('#1x2_val_1_L' + row_id).show();

						} else {
							$('#1x2_val_1' + row_id).show();

							$('#1x2_val_1_L' + row_id).hide();
						}

						if($('#1x2_val_x' + row_id).html()==''){

							$('#1x2_val_x' + row_id).hide();

							$('#1x2_val_x_L' + row_id).show();

						} else {
							$('#1x2_val_x' + row_id).show();

							$('#1x2_val_x_L' + row_id).hide();
						}

						if($('#1x2_val_2' + row_id).html()==''){

							$('#1x2_val_2' + row_id).hide();

							$('#1x2_val_2_L' + row_id).show();

						} else {
							$('#1x2_val_2' + row_id).show();

							$('#1x2_val_2_L' + row_id).hide();
						}

						///

						if($('#1x2h1_val_1' + row_id).html()==''){

							$('#1x2h1_val_1' + row_id).hide();

							$('#1x2h1_val_1_L' + row_id).show();

						} else {
							$('#1x2h1_val_1' + row_id).show();

							$('#1x2h1_val_1_L' + row_id).hide();
						}

						if($('#1x2h1_val_x' + row_id).html()==''){

							$('#1x2h1_val_x' + row_id).hide();

							$('#1x2h1_val_x_L' + row_id).show();

						} else {
							$('#1x2h1_val_x' + row_id).show();

							$('#1x2h1_val_x_L' + row_id).hide();
						}

						if($('#1x2h1_val_2' + row_id).html()==''){

							$('#1x2h1_val_2' + row_id).hide();

							$('#1x2h1_val_2_L' + row_id).show();

						} else {
							$('#1x2h1_val_2' + row_id).show();

							$('#1x2h1_val_2_L' + row_id).hide();
						}

						///

						if($('#res_val_1' + row_id).html()==''){

							$('#res_val_1' + row_id).hide();

							$('#res_val_1_L' + row_id).show();

						} else {
							$('#res_val_1' + row_id).show();

							$('#res_val_1_L' + row_id).hide();
						}

						if($('#res_val_x' + row_id).html()==''){

							$('#res_val_x' + row_id).hide();

							$('#res_val_x_L' + row_id).show();

						} else {
							$('#res_val_x' + row_id).show();

							$('#res_val_x_L' + row_id).hide();
						}

						if($('#res_val_2' + row_id).html()==''){

							$('#res_val_2' + row_id).hide();

							$('#res_val_2_L' + row_id).show();

						} else {
							$('#res_val_2' + row_id).show();

							$('#res_val_2_L' + row_id).hide();
						}

						///

						if($('#resh1_val_1' + row_id).html()==''){

							$('#resh1_val_1' + row_id).hide();

							$('#resh1_val_1_L' + row_id).show();

						} else {
							$('#resh1_val_1' + row_id).show();

							$('#resh1_val_1_L' + row_id).hide();
						}

						if($('#resh1_val_x' + row_id).html()==''){

							$('#resh1_val_x' + row_id).hide();

							$('#resh1_val_x_L' + row_id).show();

						} else {
							$('#resh1_val_x' + row_id).show();

							$('#resh1_val_x_L' + row_id).hide();
						}

						if($('#resh1_val_2' + row_id).html()==''){

							$('#resh1_val_2' + row_id).hide();

							$('#resh1_val_2_L' + row_id).show();

						} else {
							$('#resh1_val_2' + row_id).show();

							$('#resh1_val_2_L' + row_id).hide();
						}

						///

						if($('#s1g_val_1' + row_id).html()==''){

							$('#s1g_val_1' + row_id).hide();

							$('#s1g_val_1_L' + row_id).show();

						} else {
							$('#s1g_val_1' + row_id).show();

							$('#s1g_val_1_L' + row_id).hide();
						}

						if($('#s1g_val_x' + row_id).html()==''){

							$('#s1g_val_x' + row_id).hide();

							$('#s1g_val_x_L' + row_id).show();

						} else {
							$('#s1g_val_x' + row_id).show();

							$('#s1g_val_x_L' + row_id).hide();
						}

						if($('#s1g_val_2' + row_id).html()==''){

							$('#s1g_val_2' + row_id).hide();

							$('#s1g_val_2_L' + row_id).show();

						} else {
							$('#s1g_val_2' + row_id).show();

							$('#s1g_val_2_L' + row_id).hide();
						}

						///

						if($('#s1gh1_val_1' + row_id).html()==''){

							$('#s1gh1_val_1' + row_id).hide();

							$('#s1gh1_val_1_L' + row_id).show();

						} else {
							$('#s1gh1_val_1' + row_id).show();

							$('#s1gh1_val_1_L' + row_id).hide();
						}

						if($('#s1gh1_val_x' + row_id).html()==''){

							$('#s1gh1_val_x' + row_id).hide();

							$('#s1gh1_val_x_L' + row_id).show();

						} else {
							$('#s1gh1_val_x' + row_id).show();

							$('#s1gh1_val_x_L' + row_id).hide();
						}

						if($('#s1gh1_val_2' + row_id).html()==''){

							$('#s1gh1_val_2' + row_id).hide();

							$('#s1gh1_val_2_L' + row_id).show();

						} else {
							$('#s1gh1_val_2' + row_id).show();

							$('#s1gh1_val_2_L' + row_id).hide();
						}

						

						///

						if($('#over_under_o' + row_id).html()==''){

							$('#over_under_o' + row_id).hide();

							$('#over_under_o_L' + row_id).show();

						} else {
							$('#over_under_o' + row_id).show();

							$('#over_under_o_L' + row_id).hide();
						}

						if($('#over_under_u' + row_id).html()==''){

							$('#over_under_u' + row_id).hide();

							$('#over_under_u_L' + row_id).show();

						} else {
							$('#over_under_u' + row_id).show();

							$('#over_under_u_L' + row_id).hide();
						}

						///

						if($('#over_under_oh1' + row_id).html()==''){

							$('#over_under_oh1' + row_id).hide();

							$('#over_under_oh1_L' + row_id).show();

						} else {
							$('#over_under_oh1' + row_id).show();

							$('#over_under_oh1_L' + row_id).hide();
						}

						if($('#over_under_uh1' + row_id).html()==''){

							$('#over_under_uh1' + row_id).hide();

							$('#over_under_uh1_L' + row_id).show();

						} else {
							$('#over_under_uh1' + row_id).show();

							$('#over_under_uh1_L' + row_id).hide();
						}
*/
						

					});





                    //setTimeout(live_data, 2000); // recall



                }





            }



        }





        function update_list_async(subscriptionMsg) {

            var onextwokey = '';

            var oukey = '';

            var tss = '';



            if (subscriptionMsg != null && typeof subscriptionMsg["obj"] != "undefined" && typeof subscriptionMsg["obj"][0] != "undefined") {

                var list_rows = subscriptionMsg.obj;



                if(subscriptionMsg != null){

                    var iventId = subscriptionMsg["eId"];

                    if (typeof iventId != "undefined" || iventId != "") {



                        if(typeof subscriptionMsg["obj"] != "undefined" && typeof subscriptionMsg["obj"][0] != "undefined"){

                            //console.log(iventId);



                            if(typeof subscriptionMsg["obj"][0]["pn"] != "undefined"){

                                $("#match_status"+iventId).html(subscriptionMsg["obj"][0]["pn"]);

                                //alert(subscriptionMsg["obj"][0]["pn"]);

								

								/// Finished Match Remove

								if(subscriptionMsg["obj"][0]["pn"]=="Finished"){

									$("#ind_game_feed"+iventId).remove();

								}

								

								/// Second Half Hide Div

								if(subscriptionMsg["obj"][0]["pn"]=='Second Half' || subscriptionMsg["obj"][0]["pn"]=='Halftime'){

									$('#sh_div' + iventId).hide();

									

									$('#ss_enabled_ax2h1' + iventId).hide();

									$('#ss_enabled_resh1' + iventId).hide();

									$('#ss_enabled_s1gh1' + iventId).hide();

									$('#ss_enabled_ovh1' + iventId).hide();

									$('#over_under_hn' + iventId).hide();

									$('#S_' + iventId).hide();

									$('#ind_game_feed' + iventId).css({"height": "44px"});

									$('#league_name' + iventId).show();

								}

								if(subscriptionMsg["obj"][0]["pn"]=='Halftime'){

									$('#match_current_time' + iventId).html('HT');						

								}

								

								// Green Color Add	

								if($('#match_status' + iventId).html()!='Not Started'){

									$('#ind_game_feed' + iventId).addClass("greenRow");

									$('#match_current_time' + iventId).show();

									if( parseInt( $('#match_current_time' + iventId).html() , 10) < 0 ) $('#match_current_time' + iventId).html("0'");

								}

								

								

                            }





							// update the goals score

							if (typeof subscriptionMsg["obj"][0]["sc"] != "undefined" && typeof subscriptionMsg["obj"][0]["sc"]["GOAL"] != "undefined" && typeof subscriptionMsg["obj"][0]["sc"]["GOAL"][0] != "undefined") {
							
								var str_goal1 = 'ballShow' + iventId;
								if($('#team_1_score' + iventId).html()!=subscriptionMsg["obj"][0]["sc"]["GOAL"][0] && subscriptionMsg["obj"][0]["sc"]["GOAL"][0]!='0'){
									$('#TEM1_' + iventId).show();
									$('#TEM2_' + iventId).hide();
									goal_score(str_goal1);
								}

								$("#team_1_score" + iventId).html(subscriptionMsg["obj"][0]["sc"]["GOAL"][0]);
								
								//console.log(iventId + ": New Goal Update -> "+subscriptionMsg["obj"][0]["sc"]["GOAL"][0]+" (team1)", subscriptionMsg);

							}

							if (typeof subscriptionMsg["obj"][0]["sc"] != "undefined" && typeof subscriptionMsg["obj"][0]["sc"]["GOAL"] != "undefined" && typeof subscriptionMsg["obj"][0]["sc"]["GOAL"][1] != "undefined") {
								
								var str_goal2 = 'ballShow' + iventId;
								if($('#team_2_score' + iventId).html()!=subscriptionMsg["obj"][0]["sc"]["GOAL"][1] && subscriptionMsg["obj"][0]["sc"]["GOAL"][1]!='0'){
									$('#TEM1_' + iventId).hide();
									$('#TEM2_' + iventId).show();
									goal_score(str_goal2);
								}

								$("#team_2_score" + iventId).html(subscriptionMsg["obj"][0]["sc"]["GOAL"][1]);

								//console.log(iventId + ": New Goal Update -> "+subscriptionMsg["obj"][0]["sc"]["GOAL"][1]+" (team2)", subscriptionMsg);

							}
							
							if (typeof subscriptionMsg["obj"][0]["sc"] != "undefined" && typeof subscriptionMsg["obj"][0]["sc"]["GOAL"] != "undefined" && (typeof subscriptionMsg["obj"][0]["sc"]["GOAL"][0] != "undefined" || typeof subscriptionMsg["obj"][0]["sc"]["GOAL"][1] != "undefined")) {
								var gf = parseInt($("#team_1_score" + iventId).html()) + parseInt($("#team_2_score" + iventId).html());
								if(gf >= 2){
									gf = gf + 0.5;
								} else {
									gf = 2.5;
								}
								var gh = parseInt($("#team_1_score" + iventId).html()) + parseInt($("#team_2_score" + iventId).html()) + 0.5;
								
								$("#over_under_h" + iventId).html(gf);
								$("#over_under_hn" + iventId).html(gh);
							}




                            //console.log(btObj);

                            if(typeof subscriptionMsg["obj"][0]["bt"] != "undefined") {

                                $("#match_status" + iventId).html(subscriptionMsg["obj"][0]["pn"]);

                                //console.log(Object.keys(btObj).length);

								

								/// Finished Match Remove

								if(subscriptionMsg["obj"][0]["pn"]=="Finished"){

									$("#ind_game_feed"+iventId).remove();

								}

								

								/// Second Half Hide Div

								if(subscriptionMsg["obj"][0]["pn"]=='Second Half' || subscriptionMsg["obj"][0]["pn"]=='Halftime'){

									$('#sh_div' + iventId).hide();

									

									$('#ss_enabled_ax2h1' + iventId).hide();

									$('#ss_enabled_resh1' + iventId).hide();

									$('#ss_enabled_s1gh1' + iventId).hide();

									$('#ss_enabled_ovh1' + iventId).hide();

									$('#over_under_hn' + iventId).hide();

									$('#S_' + iventId).hide();

									$('#ind_game_feed' + iventId).css({"height": "44px"});

									$('#league_name' + iventId).show();

								}

								if(subscriptionMsg["obj"][0]["pn"]=='Halftime'){

									$('#match_current_time' + iventId).html('HT');						

								}

								

								// Green Color Add	

								if($('#match_status' + iventId).html()!='Not Started'){

									$('#ind_game_feed' + iventId).addClass("greenRow");

									$('#match_current_time' + iventId).show();

									if( parseInt( $('#match_current_time' + iventId).html() , 10) < 0 ) $('#match_current_time' + iventId).html("0'");

								}

								

								



                                if (Object.keys(subscriptionMsg["obj"][0]["bt"]).length > 0) {





                                    // update the elapsed time

                                    var tm = subscriptionMsg["obj"][0]["tm"];

                                    //console.log(mseconds);

                                    if (tm < 0) {

                                        var negative = 1;

                                    } else {

                                        var negative = 0;

                                    }

                                    tm = Math.round(tm / 60);

                                    if (negative == 1) {

                                        var t = "-" + t;

                                    }


									console.log('Time UPD '+iventId+' -> '+tm);


                                    $("#match_current_time" + iventId).html(tm+"'");

									/// Hide 16:29

									if(tm>=0){

										$('#tmm_' + iventId).hide();

									}

									/// Test

									if($("#match_status" + iventId).html()=='Halftime'){

										$('#match_current_time' + iventId).html('HT');

									}



                                    handle_market(subscriptionMsg);

                                }

                            }

                        }

                    }

                }

            }

        }





        function handle_market(subscriptionMsg) {

            var btObj = subscriptionMsg["obj"][0]["bt"];

            var iventId = subscriptionMsg["eId"];

			 //b2_status[iventId]  = subscriptionMsg["obj"][0].hasOwnProperty("b") ? subscriptionMsg["obj"][0].b : b2_status[iventId];
			
			var h_arr = [];
			var over_arr = [];
			var under_arr = [];


            $.each(btObj, function(i, bt) {

                //console_log('Update', subscriptionMsg);

                //console.log(bt["n"]);

                //console.log(bt["b"]+'-'+iventId+'->'+bt["n"]);
				
				var rgh = parseInt($("#team_1_score" + iventId).html()) + '.' + parseInt($("#team_2_score" + iventId).html());
				
				var total_g1 = parseInt($("#team_1_score" + iventId).html()) + parseInt($("#team_2_score" + iventId).html()) + 1;	
							
				var S1G = 'S'+ total_g1 +'G';
				var S1G_H1 = 'S'+ total_g1 +'G_H1';
				
				//console.log(iventId+' UPD -> '+S1G+' - '+S1G_H1);

				////////////////////////////////////////////////////////////////////////////////////

                if (bt["n"] == "1x2") {

                    update_match_winner(subscriptionMsg, bt);

					var int = iventId+bt["n"];

					b2_status[int] = typeof bt.b !== "undefined" ? bt.b : b2_status[int];
					r2_status[int] = typeof bt.r !== "undefined" ? bt.r : r2_status[int];

					if(typeof bt.o !== "undefined") {

						if (typeof bt.o[0] !== "undefined") {
							b3o1_status[int] = bt.o[0].hasOwnProperty('b') ? bt.o[0].b : b3o1_status[int];
							r3o1_status[int] = bt.o[0].hasOwnProperty('r') ? bt.o[0].r : r3o1_status[int];
						}

						if (typeof bt.o[1] !== "undefined") {
							b3o2_status[int] = bt.o[1].hasOwnProperty('b') ? bt.o[1].b : b3o2_status[int];
							r3o2_status[int] = bt.o[1].hasOwnProperty('r') ? bt.o[1].r : r3o2_status[int];
						}

						if (typeof bt.o[2] !== "undefined") {
							b3o3_status[int] = bt.o[2].hasOwnProperty('b') ? bt.o[2].b : b3o3_status[int];
							r3o3_status[int] = bt.o[2].hasOwnProperty('r') ? bt.o[2].r : r3o3_status[int];
						}
					}





                    //if(typeof b2_status[iventId] !== 'undefined' || typeof r2_status[iventId] !== 'undefined') {

                        if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

                            $('#1x2_val_1' + iventId).hide();

                            $('#1x2_val_x' + iventId).hide();

                            $('#1x2_val_2' + iventId).hide();



                            $('#1x2_val_1_L' + iventId).show();

                            $('#1x2_val_x_L' + iventId).show();

                            $('#1x2_val_2_L' + iventId).show();

							

							if(parseFloat($("#1"+iventId).html())>0){

								do_close('1'+iventId);

							} if(parseFloat($("#2"+iventId).html())>0){

								do_close('2'+iventId);

							} if(parseFloat($("#3"+iventId).html())>0){	

								do_close('3'+iventId);

							}

							console.log('1x2 LOCK '+iventId);


                        } else {

							if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
								$('#1x2_val_1' + iventId).hide();
								$('#1x2_val_1_L' + iventId).show();
							} else if (((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
								$('#1x2_val_1' + iventId).show();
								$('#1x2_val_1_L' + iventId).hide();
							}

							if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
								$('#1x2_val_x' + iventId).hide();
								$('#1x2_val_x_L' + iventId).show();
							} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
								$('#1x2_val_x' + iventId).show();
								$('#1x2_val_x_L' + iventId).hide();
							}

							if((typeof b3o3_status[int] !== 'undefined' && b3o3_status[int] === 1) || (typeof r3o3_status[int] !== 'undefined' && r3o3_status[int] === 1)) {
								$('#1x2_val_2' + iventId).hide();
								$('#1x2_val_2_L' + iventId).show();
							} else if(((typeof b3o3_status[int] !== "undefined" && b3o3_status[int] === 0) || typeof b3o3_status[int] === "undefined") && ((typeof r3o3_status[int] !== "undefined" && r3o3_status[int] === 0) ||  typeof r3o3_status[int] === "undefined")) {
								$('#1x2_val_2' + iventId).show();
								$('#1x2_val_2_L' + iventId).hide();
							}

                          /*  $('#1x2_val_1' + iventId).show();

                            $('#1x2_val_x' + iventId).show();

                            $('#1x2_val_2' + iventId).show();



                            $('#1x2_val_1_L' + iventId).hide();

                            $('#1x2_val_x_L' + iventId).hide();

                            $('#1x2_val_2_L' + iventId).hide();*/



							//console_log(bt.n + ' update received ('+(typeof bt.b !== 'undefined' ? 'Unlocking' : 'Adding')+')', subscriptionMsg, bt);
							console.log('1x2 UNLOCK '+iventId);

                        }

                   // }

                }

                else if (bt["n"] == "1x2_H1") {

                    update_match_winner(subscriptionMsg, bt);

                    //var onextwoHkey = i;

					var int = iventId+bt["n"];

					b2_status[int] = typeof bt.b !== "undefined" ? bt.b : b2_status[int];
					r2_status[int] = typeof bt.r !== "undefined" ? bt.r : r2_status[int];

					if(typeof bt.o !== "undefined") {

						if (typeof bt.o[0] !== "undefined") {
							b3o1_status[int] = bt.o[0].hasOwnProperty('b') ? bt.o[0].b : b3o1_status[int];
							r3o1_status[int] = bt.o[0].hasOwnProperty('r') ? bt.o[0].r : r3o1_status[int];
						}

						if (typeof bt.o[1] !== "undefined") {
							b3o2_status[int] = bt.o[1].hasOwnProperty('b') ? bt.o[1].b : b3o2_status[int];
							r3o2_status[int] = bt.o[1].hasOwnProperty('r') ? bt.o[1].r : r3o2_status[int];
						}

						if (typeof bt.o[2] !== "undefined") {
							b3o3_status[int] = bt.o[2].hasOwnProperty('b') ? bt.o[2].b : b3o3_status[int];
							r3o3_status[int] = bt.o[2].hasOwnProperty('r') ? bt.o[2].r : r3o3_status[int];
						}

					}

					//if(typeof b2_status[iventId] !== 'undefined' || typeof r2_status[iventId] !== 'undefined') {


					if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

						$('#1x2h1_val_1' + iventId).hide();

							$('#1x2h1_val_x' + iventId).hide();

							$('#1x2h1_val_2' + iventId).hide();



							$('#1x2h1_val_1_L' + iventId).show();

							$('#1x2h1_val_x_L' + iventId).show();

							$('#1x2h1_val_2_L' + iventId).show();

							

							if(parseFloat($("#4"+iventId).html())>0){

								do_close('4'+iventId);

							} if(parseFloat($("#5"+iventId).html())>0){

								do_close('5'+iventId);

							} if(parseFloat($("#6"+iventId).html())>0){	

								do_close('6'+iventId);

							}



							//console_log(bt.n + ' update received (' + (typeof bt.b !== 'undefined' ? 'Locking' : 'Removing') + ')', subscriptionMsg, bt);

						} else  {

							if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
								$('#1x2h1_val_1' + iventId).hide();
								$('#1x2h1_val_1_L' + iventId).show();
							} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
								$('#1x2h1_val_1' + iventId).show();
								$('#1x2h1_val_1_L' + iventId).hide();
							}

							if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
								$('#1x2h1_val_x' + iventId).hide();
								$('#1x2h1_val_x_L' + iventId).show();
							} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
								$('#1x2h1_val_x' + iventId).show();
								$('#1x2h1_val_x_L' + iventId).hide();
							}

							if((typeof b3o3_status[int] !== 'undefined' && b3o3_status[int] === 1) || (typeof r3o3_status[int] !== 'undefined' && r3o3_status[int] === 1)) {
								$('#1x2h1_val_2' + iventId).hide();
								$('#1x2h1_val_2_L' + iventId).show();
							} else if(((typeof b3o3_status[int] !== "undefined" && b3o3_status[int] === 0) || typeof b3o3_status[int] === "undefined") && ((typeof r3o3_status[int] !== "undefined" && r3o3_status[int] === 0) ||  typeof r3o3_status[int] === "undefined")) {
								$('#1x2h1_val_2' + iventId).show();
								$('#1x2h1_val_2_L' + iventId).hide();
							}

							/*$('#1x2h1_val_1' + iventId).show();

							$('#1x2h1_val_x' + iventId).show();

							$('#1x2h1_val_2' + iventId).show();



							$('#1x2h1_val_1_L' + iventId).hide();

							$('#1x2h1_val_x_L' + iventId).hide();

							$('#1x2h1_val_2_L' + iventId).hide();*/



							//console_log(bt.n + ' update received (' + (typeof bt.b !== 'undefined' ? 'Unlocking' : 'Adding') + ')', subscriptionMsg, bt);

						}

					//}

                }



                else if (bt["n"] == "RES_1x2" && bt["h"] == rgh) {
					
                    update_rest_match(subscriptionMsg, bt);
					
                    //var reskey = i;

					var int = iventId+bt["n"];

					b2_status[int] = typeof bt.b !== "undefined" ? bt.b : b2_status[int];
					r2_status[int] = typeof bt.r !== "undefined" ? bt.r : r2_status[int];

					if(typeof bt.o !== "undefined") {

						if (typeof bt.o[0] !== "undefined") {
							b3o1_status[int] = bt.o[0].hasOwnProperty('b') ? bt.o[0].b : b3o1_status[int];
							r3o1_status[int] = bt.o[0].hasOwnProperty('r') ? bt.o[0].r : r3o1_status[int];
						}

						if (typeof bt.o[1] !== "undefined") {
							b3o2_status[int] = bt.o[1].hasOwnProperty('b') ? bt.o[1].b : b3o2_status[int];
							r3o2_status[int] = bt.o[1].hasOwnProperty('r') ? bt.o[1].r : r3o2_status[int];
						}

						if (typeof bt.o[2] !== "undefined") {
							b3o3_status[int] = bt.o[2].hasOwnProperty('b') ? bt.o[2].b : b3o3_status[int];
							r3o3_status[int] = bt.o[2].hasOwnProperty('r') ? bt.o[2].r : r3o3_status[int];
						}

					}

					//if(typeof b2_status[iventId] !== 'undefined' || typeof r2_status[iventId] !== 'undefined') {


					if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {
						//console.log('RES_1x2--Locking-'+iventId + ' - '+ bt["h"] + '->' + rgh);
						
						$('#res_val_1' + iventId).hide();

                            $('#res_val_x' + iventId).hide();

                            $('#res_val_2' + iventId).hide();



                            $('#res_val_1_L' + iventId).show();

                            $('#res_val_x_L' + iventId).show();

                            $('#res_val_2_L' + iventId).show();

							

							if(parseFloat($("#7"+iventId).html())>0){

								do_close('7'+iventId);

							} if(parseFloat($("#8"+iventId).html())>0){

								do_close('8'+iventId);

							} if(parseFloat($("#9"+iventId).html())>0){	

								do_close('9'+iventId);

							}



							console_log(bt.n + ' update received ('+(typeof bt.b !== 'undefined' ? 'Locking' : 'Removing')+')', subscriptionMsg, bt);

						} else {
							
							//console.log('RES_1x2--Unlocking-'+iventId + ' - '+ bt["h"] + '->' + rgh);
							
							if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
								$('#res_val_1' + iventId).hide();
								$('#res_val_1_L' + iventId).show();
							} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
								$('#res_val_1' + iventId).show();
								$('#res_val_1_L' + iventId).hide();
							}

							if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
								$('#res_val_x' + iventId).hide();
								$('#res_val_x_L' + iventId).show();
							} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
								$('#res_val_x' + iventId).show();
								$('#res_val_x_L' + iventId).hide();
							}

							if((typeof b3o3_status[int] !== 'undefined' && b3o3_status[int] === 1) || (typeof r3o3_status[int] !== 'undefined' && r3o3_status[int] === 1)) {
								$('#res_val_2' + iventId).hide();
								$('#res_val_2_L' + iventId).show();
							} else if(((typeof b3o3_status[int] !== "undefined" && b3o3_status[int] === 0) || typeof b3o3_status[int] === "undefined") && ((typeof r3o3_status[int] !== "undefined" && r3o3_status[int] === 0) ||  typeof r3o3_status[int] === "undefined")) {
								$('#res_val_2' + iventId).show();
								$('#res_val_2_L' + iventId).hide();
							}

                            /*$('#res_val_1' + iventId).show();

                            $('#res_val_x' + iventId).show();

                            $('#res_val_2' + iventId).show();



                            $('#res_val_1_L' + iventId).hide();

                            $('#res_val_x_L' + iventId).hide();

                            $('#res_val_2_L' + iventId).hide();*/



							console_log(bt.n + ' update received ('+(typeof bt.b !== 'undefined' ? 'Unlocking' : 'Adding')+')', subscriptionMsg, bt);

                        }

                    //}



                }

                else if (bt["n"] == "RES_1x2_H" && bt["h"] == rgh) {

                    update_rest_match(subscriptionMsg, bt);

                    //var resHkey = i;
					//console.log('RES_1x2_H UPD '+iventId+'-> '+bt["h"]+'-'+rgh);

					var int = iventId+bt["n"];

					b2_status[int] = typeof bt.b !== "undefined" ? bt.b : b2_status[int];
					r2_status[int] = typeof bt.r !== "undefined" ? bt.r : r2_status[int];

					if(typeof bt.o !== "undefined") {

						if (typeof bt.o[0] !== "undefined") {
							b3o1_status[int] = bt.o[0].hasOwnProperty('b') ? bt.o[0].b : b3o1_status[int];
							r3o1_status[int] = bt.o[0].hasOwnProperty('r') ? bt.o[0].r : r3o1_status[int];
						}

						if (typeof bt.o[1] !== "undefined") {
							b3o2_status[int] = bt.o[1].hasOwnProperty('b') ? bt.o[1].b : b3o2_status[int];
							r3o2_status[int] = bt.o[1].hasOwnProperty('r') ? bt.o[1].r : r3o2_status[int];
						}

						if (typeof bt.o[2] !== "undefined") {
							b3o3_status[int] = bt.o[2].hasOwnProperty('b') ? bt.o[2].b : b3o3_status[int];
							r3o3_status[int] = bt.o[2].hasOwnProperty('r') ? bt.o[2].r : r3o3_status[int];
						}

					}


					//if(typeof b2_status[iventId] !== 'undefined' || typeof r2_status[iventId] !== 'undefined') {


					if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

						$('#resh1_val_1' + iventId).hide();

                            $('#resh1_val_x' + iventId).hide();

                            $('#resh1_val_2' + iventId).hide();



                            $('#resh1_val_1_L' + iventId).show();

                            $('#resh1_val_x_L' + iventId).show();

                            $('#resh1_val_2_L' + iventId).show();

							

							if(parseFloat($("#10"+iventId).html())>0){

								do_close('10'+iventId);

							} if(parseFloat($("#11"+iventId).html())>0){

								do_close('11'+iventId);

							} if(parseFloat($("#12"+iventId).html())>0){	

								do_close('12'+iventId);

							}



							console_log(bt.n + ' update received ('+(typeof bt.b !== 'undefined' ? 'Locking' : 'Removing')+')', subscriptionMsg, bt);

							//alert(bt.n);
							//console.log('RES_1x2_H LOCK '+iventId+'-> '+bt["h"]+'-'+rgh);

						} else {

							if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
								$('#resh_val_1' + iventId).hide();
								$('#resh_val_1_L' + iventId).show();
							} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
								$('#resh_val_1' + iventId).show();
								$('#resh_val_1_L' + iventId).hide();
							}

							if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
								$('#resh_val_x' + iventId).hide();
								$('#resh_val_x_L' + iventId).show();
							} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
								$('#resh_val_x' + iventId).show();
								$('#resh_val_x_L' + iventId).hide();
							}

							if((typeof b3o3_status[int] !== 'undefined' && b3o3_status[int] === 1) || (typeof r3o3_status[int] !== 'undefined' && r3o3_status[int] === 1)) {
								$('#resh_val_2' + iventId).hide();
								$('#resh_val_2_L' + iventId).show();
							} else if(((typeof b3o3_status[int] !== "undefined" && b3o3_status[int] === 0) || typeof b3o3_status[int] === "undefined") && ((typeof r3o3_status[int] !== "undefined" && r3o3_status[int] === 0) ||  typeof r3o3_status[int] === "undefined")) {
								$('#resh_val_2' + iventId).show();
								$('#resh_val_2_L' + iventId).hide();
							}

                            $('#resh1_val_1' + iventId).show();

                            $('#resh1_val_x' + iventId).show();

                            $('#resh1_val_2' + iventId).show();



                            $('#resh1_val_1_L' + iventId).hide();

                            $('#resh1_val_x_L' + iventId).hide();

                            $('#resh1_val_2_L' + iventId).hide();



							console_log(bt.n + ' update received ('+(typeof bt.b !== 'undefined' ? 'Unlocking' : 'Adding')+')', subscriptionMsg, bt);
							
							//console.log('RES_1x2_H UNLOCK '+iventId+'-> '+bt["h"]+'-'+rgh);

                        }

                   // }



                }



                else if (bt["n"] == S1G) {

                    update_next_goal(subscriptionMsg, bt);

                    //var s1gkey = i;

					var int = iventId+"SG";

					b2_status[int] = typeof bt.b !== "undefined" ? bt.b : b2_status[int];
					r2_status[int] = typeof bt.r !== "undefined" ? bt.r : r2_status[int];

					if(typeof bt.o !== "undefined") {

						if (typeof bt.o[0] !== "undefined") {
							b3o1_status[int] = bt.o[0].hasOwnProperty('b') ? bt.o[0].b : b3o1_status[int];
							r3o1_status[int] = bt.o[0].hasOwnProperty('r') ? bt.o[0].r : r3o1_status[int];
						}

						if (typeof bt.o[1] !== "undefined") {
							b3o2_status[int] = bt.o[1].hasOwnProperty('b') ? bt.o[1].b : b3o2_status[int];
							r3o2_status[int] = bt.o[1].hasOwnProperty('r') ? bt.o[1].r : r3o2_status[int];
						}

						if (typeof bt.o[2] !== "undefined") {
							b3o3_status[int] = bt.o[2].hasOwnProperty('b') ? bt.o[2].b : b3o3_status[int];
							r3o3_status[int] = bt.o[2].hasOwnProperty('r') ? bt.o[2].r : r3o3_status[int];
						}

					}



					//if(typeof b2_status[iventId] !== 'undefined' || typeof r2_status[iventId] !== 'undefined') {


					if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

							$('#s1g_val_1' + iventId).hide();

                            $('#s1g_val_x' + iventId).hide();

                            $('#s1g_val_2' + iventId).hide();



                            $('#s1g_val_1_L' + iventId).show();

                            $('#s1g_val_x_L' + iventId).show();

                            $('#s1g_val_2_L' + iventId).show();

                            //alert(iventId+' Next Goal L');

							

							if(parseFloat($("#13"+iventId).html())>0){

								do_close('13'+iventId);

							} if(parseFloat($("#14"+iventId).html())>0){

								do_close('14'+iventId);

							} if(parseFloat($("#15"+iventId).html())>0){	

								do_close('15'+iventId);

							}



                            //console_log(bt.n+' update received (Locking)', subscriptionMsg, bt);

						} else {

							if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
								$('#s1g_val_1' + iventId).hide();
								$('#s1g_val_1_L' + iventId).show();
							} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
								$('#s1g_val_1' + iventId).show();
								$('#s1g_val_1_L' + iventId).hide();
							}

							if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
								$('#s1g_val_x' + iventId).hide();
								$('#s1g_val_x_L' + iventId).show();
							} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
								$('#s1g_val_x' + iventId).show();
								$('#s1g_val_x_L' + iventId).hide();
							}

							if((typeof b3o3_status[int] !== 'undefined' && b3o3_status[int] === 1) || (typeof r3o3_status[int] !== 'undefined' && r3o3_status[int] === 1)) {
								$('#s1g_val_2' + iventId).hide();
								$('#s1g_val_2_L' + iventId).show();
							} else if(((typeof b3o3_status[int] !== "undefined" && b3o3_status[int] === 0) || typeof b3o3_status[int] === "undefined") && ((typeof r3o3_status[int] !== "undefined" && r3o3_status[int] === 0) ||  typeof r3o3_status[int] === "undefined")) {
								$('#s1g_val_2' + iventId).show();
								$('#s1g_val_2_L' + iventId).hide();
							}

                          /*  $('#s1g_val_1' + iventId).show();

                            $('#s1g_val_x' + iventId).show();

                            $('#s1g_val_2' + iventId).show();



                            $('#s1g_val_1_L' + iventId).hide();

                            $('#s1g_val_x_L' + iventId).hide();

                            $('#s1g_val_2_L' + iventId).hide();*/

                            //alert(iventId+' Next Goal U');



                            //console_log(bt.n+' update received (Unlocking)', subscriptionMsg, bt);

                        }

                    //}



                }

                else if (bt["n"] == S1G_H1) {

                    update_next_goal(subscriptionMsg, bt);

                    //var s1gHkey = i;

					var int = iventId+"SGH1";

					b2_status[int] = typeof bt.b !== "undefined" ? bt.b : b2_status[int];
					r2_status[int] = typeof bt.r !== "undefined" ? bt.r : r2_status[int];

					if(typeof bt.o !== "undefined") {

						if (typeof bt.o[0] !== "undefined") {
							b3o1_status[int] = bt.o[0].hasOwnProperty('b') ? bt.o[0].b : b3o1_status[int];
							r3o1_status[int] = bt.o[0].hasOwnProperty('r') ? bt.o[0].r : r3o1_status[int];
						}

						if (typeof bt.o[1] !== "undefined") {
							b3o2_status[int] = bt.o[1].hasOwnProperty('b') ? bt.o[1].b : b3o2_status[int];
							r3o2_status[int] = bt.o[1].hasOwnProperty('r') ? bt.o[1].r : r3o2_status[int];
						}

						if (typeof bt.o[2] !== "undefined") {
							b3o3_status[int] = bt.o[2].hasOwnProperty('b') ? bt.o[2].b : b3o3_status[int];
							r3o3_status[int] = bt.o[2].hasOwnProperty('r') ? bt.o[2].r : r3o3_status[int];
						}
					}



					//if(typeof b2_status[iventId] !== 'undefined' || typeof r2_status[iventId] !== 'undefined') {


					if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

							$('#s1gh1_val_1' + iventId).hide();

                            $('#s1gh1_val_x' + iventId).hide();

                            $('#s1gh1_val_2' + iventId).hide();



                            $('#s1gh1_val_1_L' + iventId).show();

                            $('#s1gh1_val_x_L' + iventId).show();

                            $('#s1gh1_val_2_L' + iventId).show();

							

							if(parseFloat($("#16"+iventId).html())>0){

								do_close('16'+iventId);

							} if(parseFloat($("#17"+iventId).html())>0){

								do_close('17'+iventId);

							} if(parseFloat($("#18"+iventId).html())>0){	

								do_close('18'+iventId);

							}



                            //console_log(bt.n+' update received (Locking)', subscriptionMsg, bt);

						} else {

							if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
								$('#s1gh1_val_1' + iventId).hide();
								$('#s1gh1_val_1_L' + iventId).show();
							} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
								$('#s1gh1_val_1' + iventId).show();
								$('#s1gh1_val_1_L' + iventId).hide();
							}

							if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
								$('#s1gh1_val_x' + iventId).hide();
								$('#s1gh1_val_x_L' + iventId).show();
							} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
								$('#s1gh1_val_x' + iventId).show();
								$('#s1gh1_val_x_L' + iventId).hide();
							}

							if((typeof b3o3_status[int] !== 'undefined' && b3o3_status[int] === 1) || (typeof r3o3_status[int] !== 'undefined' && r3o3_status[int] === 1)) {
								$('#s1gh1_val_2' + iventId).hide();
								$('#s1gh1_val_2_L' + iventId).show();
							} else if(((typeof b3o3_status[int] !== "undefined" && b3o3_status[int] === 0) || typeof b3o3_status[int] === "undefined") && ((typeof r3o3_status[int] !== "undefined" && r3o3_status[int] === 0) ||  typeof r3o3_status[int] === "undefined")) {
								$('#s1gh1_val_2' + iventId).show();
								$('#s1gh1_val_2_L' + iventId).hide();
							}

                             /*$('#s1gh1_val_1' + iventId).show();

                            $('#s1gh1_val_x' + iventId).show();

                            $('#s1gh1_val_2' + iventId).show();



                            $('#s1gh1_val_1_L' + iventId).hide();

                            $('#s1gh1_val_x_L' + iventId).hide();

                            $('#s1gh1_val_2_L' + iventId).hide();*/



                            //console_log(bt.n+' update received (Unlocking)', subscriptionMsg, bt);

                        }

                    //}



                }



                else if (bt["n"] == "OU" && bt["h"] == $("#over_under_h" + iventId).html()) {
					
					//console.log('OU ' +iventId+' -> ' + bt["h"]);
					
					/*if(typeof bt["o"][0]["v"] !== "undefined" && typeof bt["o"][1]["v"] !== "undefined"){
						if(bt["n"] == "OU" && typeof bt.o !== "undefined" && typeof bt["h"] !== "undefined"){
								h_arr.push(bt["h"]);
								over_arr.push(parseFloat(bt["o"][0]["v"]));
								under_arr.push(parseFloat(bt["o"][1]["v"]));
								
						}
						for (var i = 0; i < h_arr.length; i++) {
						  console.log('Value Array [' + i + ']' +iventId+' is: ' + h_arr[i]);
						}
					}*/

                    update_total(subscriptionMsg, bt);

					var int = iventId+bt["n"];

					b2_status[int] = typeof bt.b !== "undefined" ? bt.b : b2_status[int];
					r2_status[int] = typeof bt.r !== "undefined" ? bt.r : r2_status[int];

					if(typeof bt.o !== "undefined") {

						if (typeof bt.o[0] !== "undefined") {
							b3o1_status[int] = bt.o[0].hasOwnProperty('b') ? bt.o[0].b : b3o1_status[int];
							r3o1_status[int] = bt.o[0].hasOwnProperty('r') ? bt.o[0].r : r3o1_status[int];
						}

						if (typeof bt.o[1] !== "undefined") {
							b3o2_status[int] = bt.o[1].hasOwnProperty('b') ? bt.o[1].b : b3o2_status[int];
							r3o2_status[int] = bt.o[1].hasOwnProperty('r') ? bt.o[1].r : r3o2_status[int];
						}

						if (typeof bt.o[2] !== "undefined") {
							b3o3_status[int] = bt.o[2].hasOwnProperty('b') ? bt.o[2].b : b3o3_status[int];
							r3o3_status[int] = bt.o[2].hasOwnProperty('r') ? bt.o[2].r : r3o3_status[int];
						}

					}



					//if(typeof b2_status[iventId] !== 'undefined' || typeof r2_status[iventId] !== 'undefined') {


					if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

							$('#over_under_o' + iventId).hide();

                            $('#over_under_u' + iventId).hide();



                            $('#over_under_o_L' + iventId).show();

                            $('#over_under_u_L' + iventId).show();

							

							if(parseFloat($("#19"+iventId).html())>0){

								do_close('19'+iventId);

							} if(parseFloat($("#20"+iventId).html())>0){

								do_close('20'+iventId);

							}



                            //console_log(bt.n+' update received (Locking)', subscriptionMsg, bt);

						} else  {

							if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
								$('#over_under_o' + iventId).hide();
								$('#over_under_o_L' + iventId).show();
							} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
								$('#over_under_o' + iventId).show();
								$('#over_under_o_L' + iventId).hide();
							}

							if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
								$('#over_under_u' + iventId).hide();
								$('#over_under_u_L' + iventId).show();
							} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
								$('#over_under_u' + iventId).show();
								$('#over_under_u_L' + iventId).hide();
							}


                            /*$('#over_under_o' + iventId).show();

                            $('#over_under_u' + iventId).show();



                            $('#over_under_o_L' + iventId).hide();

                            $('#over_under_u_L' + iventId).hide();*/



                            //console_log(bt.n+' update received (Unlocking)', subscriptionMsg, bt);

                        }

                    //}

                }

                else if (bt["n"] == "OU_H1" && bt["h"] == $("#over_under_hn" + iventId).html()) {

                    update_total(subscriptionMsg, bt);

                    //var ouHkey = i;

					var int = iventId+bt["n"];

					b2_status[int] = typeof bt.b !== "undefined" ? bt.b : b2_status[int];
					r2_status[int] = typeof bt.r !== "undefined" ? bt.r : r2_status[int];

					if(typeof bt.o !== "undefined") {

						if (typeof bt.o[0] !== "undefined") {
							b3o1_status[int] = bt.o[0].hasOwnProperty('b') ? bt.o[0].b : b3o1_status[int];
							r3o1_status[int] = bt.o[0].hasOwnProperty('r') ? bt.o[0].r : r3o1_status[int];
						}

						if (typeof bt.o[1] !== "undefined") {
							b3o2_status[int] = bt.o[1].hasOwnProperty('b') ? bt.o[1].b : b3o2_status[int];
							r3o2_status[int] = bt.o[1].hasOwnProperty('r') ? bt.o[1].r : r3o2_status[int];
						}

						if (typeof bt.o[2] !== "undefined") {
							b3o3_status[int] = bt.o[2].hasOwnProperty('b') ? bt.o[2].b : b3o3_status[int];
							r3o3_status[int] = bt.o[2].hasOwnProperty('r') ? bt.o[2].r : r3o3_status[int];
						}

					}



					//if(typeof b2_status[iventId] !== 'undefined' || typeof r2_status[iventId] !== 'undefined') {


					if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

							$('#over_under_oh1' + iventId).hide();

                            $('#over_under_uh1' + iventId).hide();



                            $('#over_under_oh1_L' + iventId).show();

                            $('#over_under_uh1_L' + iventId).show();

							

							if(parseFloat($("#21"+iventId).html())>0){

								do_close('21'+iventId);

							} if(parseFloat($("#22"+iventId).html())>0){

								do_close('22'+iventId);

							}



                            //console_log(bt.n+' update received (Locking)', subscriptionMsg, bt);

						} else {


							if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
								$('#over_under_oh1' + iventId).hide();
								$('#over_under_oh1_L' + iventId).show();
							} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
								$('#over_under_oh1' + iventId).show();
								$('#over_under_oh1_L' + iventId).hide();
							}

							if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
								$('#over_under_uh1' + iventId).hide();
								$('#over_under_uh1_L' + iventId).show();
							} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
								$('#over_under_uh1' + iventId).show();
								$('#over_under_uh1_L' + iventId).hide();
							}


                            /*$('#over_under_oh1' + iventId).show();

                            $('#over_under_uh1' + iventId).show();



                            $('#over_under_oh1_L' + iventId).hide();

                            $('#over_under_uh1_L' + iventId).hide();*/



                            //console_log(bt.n+' update received (Unlocking)', subscriptionMsg, bt);

                        }

                    //}



                }
				
				else if (bt["n"] == "DC") {

                    update_double_chance(subscriptionMsg, bt);

					var int = iventId+bt["n"];

					b2_status[int] = typeof bt.b !== "undefined" ? bt.b : b2_status[int];
					r2_status[int] = typeof bt.r !== "undefined" ? bt.r : r2_status[int];

					if(typeof bt.o !== "undefined") {

						if (typeof bt.o[0] !== "undefined") {
							b3o1_status[int] = bt.o[0].hasOwnProperty('b') ? bt.o[0].b : b3o1_status[int];
							r3o1_status[int] = bt.o[0].hasOwnProperty('r') ? bt.o[0].r : r3o1_status[int];
						}

						if (typeof bt.o[1] !== "undefined") {
							b3o2_status[int] = bt.o[1].hasOwnProperty('b') ? bt.o[1].b : b3o2_status[int];
							r3o2_status[int] = bt.o[1].hasOwnProperty('r') ? bt.o[1].r : r3o2_status[int];
						}

						if (typeof bt.o[2] !== "undefined") {
							b3o3_status[int] = bt.o[2].hasOwnProperty('b') ? bt.o[2].b : b3o3_status[int];
							r3o3_status[int] = bt.o[2].hasOwnProperty('r') ? bt.o[2].r : r3o3_status[int];
						}
					}





                    
					if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {
	
						$('#double_chance_1x' + iventId).hide();
	
						$('#double_chance_x2' + iventId).hide();
	
						$('#double_chance_12' + iventId).hide();
	
	
	
						$('#double_chance_1x_L' + iventId).show();
	
						$('#double_chance_x2_L' + iventId).show();
	
						$('#double_chance_12_L' + iventId).show();
	
						
	
						if(parseFloat($("#23"+iventId).html())>0){
	
							do_close('23'+iventId);
	
						} if(parseFloat($("#24"+iventId).html())>0){
	
							do_close('24'+iventId);
	
						} if(parseFloat($("#25"+iventId).html())>0){	
	
							do_close('25'+iventId);
	
						}
	
						console.log('DC LOCK '+iventId);
	
	
					} else {
	
						if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
							$('#double_chance_1x' + iventId).hide();
							$('#double_chance_1x_L' + iventId).show();
						} else if (((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
							$('#double_chance_1x' + iventId).show();
							$('#double_chance_1x_L' + iventId).hide();
						}
	
						if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
							$('#double_chance_x2' + iventId).hide();
							$('#double_chance_x2_L' + iventId).show();
						} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
							$('#double_chance_x2' + iventId).show();
							$('#double_chance_x2_L' + iventId).hide();
						}
	
						if((typeof b3o3_status[int] !== 'undefined' && b3o3_status[int] === 1) || (typeof r3o3_status[int] !== 'undefined' && r3o3_status[int] === 1)) {
							$('#double_chance_12' + iventId).hide();
							$('#double_chance_12_L' + iventId).show();
						} else if(((typeof b3o3_status[int] !== "undefined" && b3o3_status[int] === 0) || typeof b3o3_status[int] === "undefined") && ((typeof r3o3_status[int] !== "undefined" && r3o3_status[int] === 0) ||  typeof r3o3_status[int] === "undefined")) {
							$('#double_chance_12' + iventId).show();
							$('#double_chance_12_L' + iventId).hide();
						}
	
					  /*  $('#double_chance_1x' + iventId).show();
	
						$('#double_chance_x2' + iventId).show();
	
						$('#double_chance_12' + iventId).show();
	
	
	
						$('#double_chance_1x_L' + iventId).hide();
	
						$('#double_chance_x2_L' + iventId).hide();
	
						$('#double_chance_12_L' + iventId).hide();*/
	
	
	
						//console_log(bt.n + ' update received ('+(typeof bt.b !== 'undefined' ? 'Unlocking' : 'Adding')+')', subscriptionMsg, bt);
						console.log('DC UNLOCK '+iventId);
	
					}


                }
				
				
				
				else if (bt["n"] == "BTS") {

                    update_bts(subscriptionMsg, bt);

					var int = iventId+bt["n"];

					b2_status[int] = typeof bt.b !== "undefined" ? bt.b : b2_status[int];
					r2_status[int] = typeof bt.r !== "undefined" ? bt.r : r2_status[int];

					if(typeof bt.o !== "undefined") {

						if (typeof bt.o[0] !== "undefined") {
							b3o1_status[int] = bt.o[0].hasOwnProperty('b') ? bt.o[0].b : b3o1_status[int];
							r3o1_status[int] = bt.o[0].hasOwnProperty('r') ? bt.o[0].r : r3o1_status[int];
						}

						if (typeof bt.o[1] !== "undefined") {
							b3o2_status[int] = bt.o[1].hasOwnProperty('b') ? bt.o[1].b : b3o2_status[int];
							r3o2_status[int] = bt.o[1].hasOwnProperty('r') ? bt.o[1].r : r3o2_status[int];
						}

						if (typeof bt.o[2] !== "undefined") {
							b3o3_status[int] = bt.o[2].hasOwnProperty('b') ? bt.o[2].b : b3o3_status[int];
							r3o3_status[int] = bt.o[2].hasOwnProperty('r') ? bt.o[2].r : r3o3_status[int];
						}
					}





                    //if(typeof b2_status[iventId] !== 'undefined' || typeof r2_status[iventId] !== 'undefined') {

                        if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

                            $('#bts_yes' + iventId).hide();

                            $('#bts_no' + iventId).hide();


                            $('#bts_yes_L' + iventId).show();

                            $('#bts_no_L' + iventId).show();

                            
							
							if(parseFloat($("#26"+iventId).html())>0){

								do_close('26'+iventId);

							} if(parseFloat($("#27"+iventId).html())>0){

								do_close('27'+iventId);

							}

							console.log('BTS LOCK '+iventId);


                        } else {

							if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
								$('#bts_yes' + iventId).hide();
								$('#bts_yes_L' + iventId).show();
							} else if (((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
								$('#bts_yes' + iventId).show();
								$('#bts_yes_L' + iventId).hide();
							}

							if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
								$('#bts_no' + iventId).hide();
								$('#bts_no_L' + iventId).show();
							} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
								$('#bts_no' + iventId).show();
								$('#bts_no_L' + iventId).hide();
							}

							

                          /*  $('#1x2_val_1' + iventId).show();

                            $('#1x2_val_x' + iventId).show();

                            $('#1x2_val_2' + iventId).show();



                            $('#1x2_val_1_L' + iventId).hide();

                            $('#1x2_val_x_L' + iventId).hide();

                            $('#1x2_val_2_L' + iventId).hide();*/



							//console_log(bt.n + ' update received ('+(typeof bt.b !== 'undefined' ? 'Unlocking' : 'Adding')+')', subscriptionMsg, bt);
							console.log('BTS UNLOCK '+iventId);

                        }

                   // }

                }
				
				
				
				
				else if (bt["n"] == "BTS_H1") {

                    update_bts(subscriptionMsg, bt);

					var int = iventId+bt["n"];

					b2_status[int] = typeof bt.b !== "undefined" ? bt.b : b2_status[int];
					r2_status[int] = typeof bt.r !== "undefined" ? bt.r : r2_status[int];

					if(typeof bt.o !== "undefined") {

						if (typeof bt.o[0] !== "undefined") {
							b3o1_status[int] = bt.o[0].hasOwnProperty('b') ? bt.o[0].b : b3o1_status[int];
							r3o1_status[int] = bt.o[0].hasOwnProperty('r') ? bt.o[0].r : r3o1_status[int];
						}

						if (typeof bt.o[1] !== "undefined") {
							b3o2_status[int] = bt.o[1].hasOwnProperty('b') ? bt.o[1].b : b3o2_status[int];
							r3o2_status[int] = bt.o[1].hasOwnProperty('r') ? bt.o[1].r : r3o2_status[int];
						}

						if (typeof bt.o[2] !== "undefined") {
							b3o3_status[int] = bt.o[2].hasOwnProperty('b') ? bt.o[2].b : b3o3_status[int];
							r3o3_status[int] = bt.o[2].hasOwnProperty('r') ? bt.o[2].r : r3o3_status[int];
						}
					}





                    //if(typeof b2_status[iventId] !== 'undefined' || typeof r2_status[iventId] !== 'undefined') {

                        if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

                            $('#bts_yesh1' + iventId).hide();

                            $('#bts_noh1' + iventId).hide();


                            $('#bts_yesh1_L' + iventId).show();

                            $('#bts_noh1_L' + iventId).show();

                            
							
							if(parseFloat($("#28"+iventId).html())>0){

								do_close('28'+iventId);

							} if(parseFloat($("#29"+iventId).html())>0){

								do_close('29'+iventId);

							}

							console.log('BTS_H1 LOCK '+iventId);


                        } else {

							if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
								$('#bts_yesh1' + iventId).hide();
								$('#bts_yesh1_L' + iventId).show();
							} else if (((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
								$('#bts_yesh1' + iventId).show();
								$('#bts_yesh1_L' + iventId).hide();
							}

							if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
								$('#bts_noh1' + iventId).hide();
								$('#bts_noh1_L' + iventId).show();
							} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
								$('#bts_noh1' + iventId).show();
								$('#bts_noh1_L' + iventId).hide();
							}

							

                          /*  $('#1x2_val_1' + iventId).show();

                            $('#1x2_val_x' + iventId).show();

                            $('#1x2_val_2' + iventId).show();



                            $('#1x2_val_1_L' + iventId).hide();

                            $('#1x2_val_x_L' + iventId).hide();

                            $('#1x2_val_2_L' + iventId).hide();*/



							//console_log(bt.n + ' update received ('+(typeof bt.b !== 'undefined' ? 'Unlocking' : 'Adding')+')', subscriptionMsg, bt);
							console.log('BTS_H1 UNLOCK '+iventId);

                        }

                   // }

                }
				
				
				
				//OU 0.5
				else if (bt["n"] == "OU" && bt["h"] == "0.5") {
					
					//console.log('OU ' +iventId+' -> ' + bt["h"]);
					
                    update_over_under(subscriptionMsg, bt);

					var int = iventId+bt["n"];

					b2_status[int] = typeof bt.b !== "undefined" ? bt.b : b2_status[int];
					r2_status[int] = typeof bt.r !== "undefined" ? bt.r : r2_status[int];

					if(typeof bt.o !== "undefined") {

						if (typeof bt.o[0] !== "undefined") {
							b3o1_status[int] = bt.o[0].hasOwnProperty('b') ? bt.o[0].b : b3o1_status[int];
							r3o1_status[int] = bt.o[0].hasOwnProperty('r') ? bt.o[0].r : r3o1_status[int];
						}

						if (typeof bt.o[1] !== "undefined") {
							b3o2_status[int] = bt.o[1].hasOwnProperty('b') ? bt.o[1].b : b3o2_status[int];
							r3o2_status[int] = bt.o[1].hasOwnProperty('r') ? bt.o[1].r : r3o2_status[int];
						}

						if (typeof bt.o[2] !== "undefined") {
							b3o3_status[int] = bt.o[2].hasOwnProperty('b') ? bt.o[2].b : b3o3_status[int];
							r3o3_status[int] = bt.o[2].hasOwnProperty('r') ? bt.o[2].r : r3o3_status[int];
						}

					}



					if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

							$('#ou_o05' + iventId).hide();

                            $('#ou_u05' + iventId).hide();



                            $('#ou_o05_L' + iventId).show();

                            $('#ou_u05_L' + iventId).show();

							

							if(parseFloat($("#30"+iventId).html())>0){

								do_close('30'+iventId);

							} if(parseFloat($("#31"+iventId).html())>0){

								do_close('31'+iventId);

							}



                            //console_log(bt.n+' update received (Locking)', subscriptionMsg, bt);

						} else  {

							if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
								$('#ou_o05' + iventId).hide();
								$('#ou_o05_L' + iventId).show();
							} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
								$('#ou_o05' + iventId).show();
								$('#ou_o05_L' + iventId).hide();
							}

							if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
								$('#ou_u05' + iventId).hide();
								$('#ou_u05_L' + iventId).show();
							} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
								$('#ou_u05' + iventId).show();
								$('#ou_u05_L' + iventId).hide();
							}


                            /*$('#over_under_o' + iventId).show();

                            $('#over_under_u' + iventId).show();



                            $('#over_under_o_L' + iventId).hide();

                            $('#over_under_u_L' + iventId).hide();*/



                            //console_log(bt.n+' update received (Unlocking)', subscriptionMsg, bt);

                        }


                }
				
				
				//OU 1.5
				else if (bt["n"] == "OU" && bt["h"] == "1.5") {
					
					//console.log('OU ' +iventId+' -> ' + bt["h"]);
					
                    update_over_under(subscriptionMsg, bt);

					var int = iventId+bt["n"];

					b2_status[int] = typeof bt.b !== "undefined" ? bt.b : b2_status[int];
					r2_status[int] = typeof bt.r !== "undefined" ? bt.r : r2_status[int];

					if(typeof bt.o !== "undefined") {

						if (typeof bt.o[0] !== "undefined") {
							b3o1_status[int] = bt.o[0].hasOwnProperty('b') ? bt.o[0].b : b3o1_status[int];
							r3o1_status[int] = bt.o[0].hasOwnProperty('r') ? bt.o[0].r : r3o1_status[int];
						}

						if (typeof bt.o[1] !== "undefined") {
							b3o2_status[int] = bt.o[1].hasOwnProperty('b') ? bt.o[1].b : b3o2_status[int];
							r3o2_status[int] = bt.o[1].hasOwnProperty('r') ? bt.o[1].r : r3o2_status[int];
						}

						if (typeof bt.o[2] !== "undefined") {
							b3o3_status[int] = bt.o[2].hasOwnProperty('b') ? bt.o[2].b : b3o3_status[int];
							r3o3_status[int] = bt.o[2].hasOwnProperty('r') ? bt.o[2].r : r3o3_status[int];
						}

					}



					if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

							$('#ou_o15' + iventId).hide();

                            $('#ou_u15' + iventId).hide();



                            $('#ou_o15_L' + iventId).show();

                            $('#ou_u15_L' + iventId).show();

							

							if(parseFloat($("#32"+iventId).html())>0){

								do_close('32'+iventId);

							} if(parseFloat($("#33"+iventId).html())>0){

								do_close('33'+iventId);

							}



                            //console_log(bt.n+' update received (Locking)', subscriptionMsg, bt);

						} else  {

							if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
								$('#ou_o15' + iventId).hide();
								$('#ou_o15_L' + iventId).show();
							} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
								$('#ou_o15' + iventId).show();
								$('#ou_o15_L' + iventId).hide();
							}

							if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
								$('#ou_u15' + iventId).hide();
								$('#ou_u15_L' + iventId).show();
							} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
								$('#ou_u15' + iventId).show();
								$('#ou_u15_L' + iventId).hide();
							}


                            

                            //console_log(bt.n+' update received (Unlocking)', subscriptionMsg, bt);

                        }


                }
				
				
				
				//OU 2.5
				else if (bt["n"] == "OU" && bt["h"] == "2.5") {
					
					//console.log('OU ' +iventId+' -> ' + bt["h"]);
					
                    update_over_under(subscriptionMsg, bt);

					var int = iventId+bt["n"];

					b2_status[int] = typeof bt.b !== "undefined" ? bt.b : b2_status[int];
					r2_status[int] = typeof bt.r !== "undefined" ? bt.r : r2_status[int];

					if(typeof bt.o !== "undefined") {

						if (typeof bt.o[0] !== "undefined") {
							b3o1_status[int] = bt.o[0].hasOwnProperty('b') ? bt.o[0].b : b3o1_status[int];
							r3o1_status[int] = bt.o[0].hasOwnProperty('r') ? bt.o[0].r : r3o1_status[int];
						}

						if (typeof bt.o[1] !== "undefined") {
							b3o2_status[int] = bt.o[1].hasOwnProperty('b') ? bt.o[1].b : b3o2_status[int];
							r3o2_status[int] = bt.o[1].hasOwnProperty('r') ? bt.o[1].r : r3o2_status[int];
						}

						if (typeof bt.o[2] !== "undefined") {
							b3o3_status[int] = bt.o[2].hasOwnProperty('b') ? bt.o[2].b : b3o3_status[int];
							r3o3_status[int] = bt.o[2].hasOwnProperty('r') ? bt.o[2].r : r3o3_status[int];
						}

					}



					if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

							$('#ou_o25' + iventId).hide();

                            $('#ou_u25' + iventId).hide();



                            $('#ou_o25_L' + iventId).show();

                            $('#ou_u25_L' + iventId).show();

							

							if(parseFloat($("#34"+iventId).html())>0){

								do_close('34'+iventId);

							} if(parseFloat($("#35"+iventId).html())>0){

								do_close('35'+iventId);

							}



                            //console_log(bt.n+' update received (Locking)', subscriptionMsg, bt);

						} else  {

							if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
								$('#ou_o25' + iventId).hide();
								$('#ou_o25_L' + iventId).show();
							} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
								$('#ou_o25' + iventId).show();
								$('#ou_o25_L' + iventId).hide();
							}

							if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
								$('#ou_u25' + iventId).hide();
								$('#ou_u25_L' + iventId).show();
							} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
								$('#ou_u25' + iventId).show();
								$('#ou_u25_L' + iventId).hide();
							}


                            //console_log(bt.n+' update received (Unlocking)', subscriptionMsg, bt);

                        }


                }
				
				
				
				//OU 3.5
				else if (bt["n"] == "OU" && bt["h"] == "3.5") {
					
					//console.log('OU ' +iventId+' -> ' + bt["h"]);
					
                    update_over_under(subscriptionMsg, bt);

					var int = iventId+bt["n"];

					b2_status[int] = typeof bt.b !== "undefined" ? bt.b : b2_status[int];
					r2_status[int] = typeof bt.r !== "undefined" ? bt.r : r2_status[int];

					if(typeof bt.o !== "undefined") {

						if (typeof bt.o[0] !== "undefined") {
							b3o1_status[int] = bt.o[0].hasOwnProperty('b') ? bt.o[0].b : b3o1_status[int];
							r3o1_status[int] = bt.o[0].hasOwnProperty('r') ? bt.o[0].r : r3o1_status[int];
						}

						if (typeof bt.o[1] !== "undefined") {
							b3o2_status[int] = bt.o[1].hasOwnProperty('b') ? bt.o[1].b : b3o2_status[int];
							r3o2_status[int] = bt.o[1].hasOwnProperty('r') ? bt.o[1].r : r3o2_status[int];
						}

						if (typeof bt.o[2] !== "undefined") {
							b3o3_status[int] = bt.o[2].hasOwnProperty('b') ? bt.o[2].b : b3o3_status[int];
							r3o3_status[int] = bt.o[2].hasOwnProperty('r') ? bt.o[2].r : r3o3_status[int];
						}

					}



					if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

							$('#ou_o35' + iventId).hide();

                            $('#ou_u35' + iventId).hide();



                            $('#ou_o35_L' + iventId).show();

                            $('#ou_u35_L' + iventId).show();

							

							if(parseFloat($("#36"+iventId).html())>0){

								do_close('36'+iventId);

							} if(parseFloat($("#37"+iventId).html())>0){

								do_close('37'+iventId);

							}



                            //console_log(bt.n+' update received (Locking)', subscriptionMsg, bt);

						} else  {

							if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
								$('#ou_o35' + iventId).hide();
								$('#ou_o35_L' + iventId).show();
							} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
								$('#ou_o35' + iventId).show();
								$('#ou_o35_L' + iventId).hide();
							}

							if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
								$('#ou_u35' + iventId).hide();
								$('#ou_u35_L' + iventId).show();
							} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
								$('#ou_u35' + iventId).show();
								$('#ou_u35_L' + iventId).hide();
							}


                            //console_log(bt.n+' update received (Unlocking)', subscriptionMsg, bt);

                        }


                }
				
				
				//OU 4.5
				else if (bt["n"] == "OU" && bt["h"] == "4.5") {
					
					//console.log('OU ' +iventId+' -> ' + bt["h"]);
					
                    update_over_under(subscriptionMsg, bt);

					var int = iventId+bt["n"];

					b2_status[int] = typeof bt.b !== "undefined" ? bt.b : b2_status[int];
					r2_status[int] = typeof bt.r !== "undefined" ? bt.r : r2_status[int];

					if(typeof bt.o !== "undefined") {

						if (typeof bt.o[0] !== "undefined") {
							b3o1_status[int] = bt.o[0].hasOwnProperty('b') ? bt.o[0].b : b3o1_status[int];
							r3o1_status[int] = bt.o[0].hasOwnProperty('r') ? bt.o[0].r : r3o1_status[int];
						}

						if (typeof bt.o[1] !== "undefined") {
							b3o2_status[int] = bt.o[1].hasOwnProperty('b') ? bt.o[1].b : b3o2_status[int];
							r3o2_status[int] = bt.o[1].hasOwnProperty('r') ? bt.o[1].r : r3o2_status[int];
						}

						if (typeof bt.o[2] !== "undefined") {
							b3o3_status[int] = bt.o[2].hasOwnProperty('b') ? bt.o[2].b : b3o3_status[int];
							r3o3_status[int] = bt.o[2].hasOwnProperty('r') ? bt.o[2].r : r3o3_status[int];
						}

					}



					if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

							$('#ou_o45' + iventId).hide();

                            $('#ou_u45' + iventId).hide();



                            $('#ou_o45_L' + iventId).show();

                            $('#ou_u45_L' + iventId).show();

							

							if(parseFloat($("#38"+iventId).html())>0){

								do_close('38'+iventId);

							} if(parseFloat($("#39"+iventId).html())>0){

								do_close('39'+iventId);

							}



                            //console_log(bt.n+' update received (Locking)', subscriptionMsg, bt);

						} else  {

							if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
								$('#ou_o45' + iventId).hide();
								$('#ou_o45_L' + iventId).show();
							} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
								$('#ou_o45' + iventId).show();
								$('#ou_o45_L' + iventId).hide();
							}

							if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
								$('#ou_u45' + iventId).hide();
								$('#ou_u45_L' + iventId).show();
							} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
								$('#ou_u45' + iventId).show();
								$('#ou_u45_L' + iventId).hide();
							}


                            //console_log(bt.n+' update received (Unlocking)', subscriptionMsg, bt);

                        }


                }
				
								
				//OU 5.5
				else if (bt["n"] == "OU" && bt["h"] == "5.5") {
					
					//console.log('OU ' +iventId+' -> ' + bt["h"]);
					
                    update_over_under(subscriptionMsg, bt);

					var int = iventId+bt["n"];

					b2_status[int] = typeof bt.b !== "undefined" ? bt.b : b2_status[int];
					r2_status[int] = typeof bt.r !== "undefined" ? bt.r : r2_status[int];

					if(typeof bt.o !== "undefined") {

						if (typeof bt.o[0] !== "undefined") {
							b3o1_status[int] = bt.o[0].hasOwnProperty('b') ? bt.o[0].b : b3o1_status[int];
							r3o1_status[int] = bt.o[0].hasOwnProperty('r') ? bt.o[0].r : r3o1_status[int];
						}

						if (typeof bt.o[1] !== "undefined") {
							b3o2_status[int] = bt.o[1].hasOwnProperty('b') ? bt.o[1].b : b3o2_status[int];
							r3o2_status[int] = bt.o[1].hasOwnProperty('r') ? bt.o[1].r : r3o2_status[int];
						}

						if (typeof bt.o[2] !== "undefined") {
							b3o3_status[int] = bt.o[2].hasOwnProperty('b') ? bt.o[2].b : b3o3_status[int];
							r3o3_status[int] = bt.o[2].hasOwnProperty('r') ? bt.o[2].r : r3o3_status[int];
						}

					}



					if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

							$('#ou_o55' + iventId).hide();

                            $('#ou_u55' + iventId).hide();



                            $('#ou_o55_L' + iventId).show();

                            $('#ou_u55_L' + iventId).show();

							

							if(parseFloat($("#40"+iventId).html())>0){

								do_close('40'+iventId);

							} if(parseFloat($("#41"+iventId).html())>0){

								do_close('41'+iventId);

							}



                            //console_log(bt.n+' update received (Locking)', subscriptionMsg, bt);

						} else  {

							if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
								$('#ou_o55' + iventId).hide();
								$('#ou_o55_L' + iventId).show();
							} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
								$('#ou_o55' + iventId).show();
								$('#ou_o55_L' + iventId).hide();
							}

							if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
								$('#ou_u55' + iventId).hide();
								$('#ou_u55_L' + iventId).show();
							} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
								$('#ou_u55' + iventId).show();
								$('#ou_u55_L' + iventId).hide();
							}


                            //console_log(bt.n+' update received (Unlocking)', subscriptionMsg, bt);

                        }


                }
				
				
								
				//OU 6.5
				else if (bt["n"] == "OU" && bt["h"] == "6.5") {
					
					//console.log('OU ' +iventId+' -> ' + bt["h"]);
					
                    update_over_under(subscriptionMsg, bt);

					var int = iventId+bt["n"];

					b2_status[int] = typeof bt.b !== "undefined" ? bt.b : b2_status[int];
					r2_status[int] = typeof bt.r !== "undefined" ? bt.r : r2_status[int];

					if(typeof bt.o !== "undefined") {

						if (typeof bt.o[0] !== "undefined") {
							b3o1_status[int] = bt.o[0].hasOwnProperty('b') ? bt.o[0].b : b3o1_status[int];
							r3o1_status[int] = bt.o[0].hasOwnProperty('r') ? bt.o[0].r : r3o1_status[int];
						}

						if (typeof bt.o[1] !== "undefined") {
							b3o2_status[int] = bt.o[1].hasOwnProperty('b') ? bt.o[1].b : b3o2_status[int];
							r3o2_status[int] = bt.o[1].hasOwnProperty('r') ? bt.o[1].r : r3o2_status[int];
						}

						if (typeof bt.o[2] !== "undefined") {
							b3o3_status[int] = bt.o[2].hasOwnProperty('b') ? bt.o[2].b : b3o3_status[int];
							r3o3_status[int] = bt.o[2].hasOwnProperty('r') ? bt.o[2].r : r3o3_status[int];
						}

					}



					if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

							$('#ou_o65' + iventId).hide();

                            $('#ou_u65' + iventId).hide();



                            $('#ou_o65_L' + iventId).show();

                            $('#ou_u65_L' + iventId).show();

							

							if(parseFloat($("#42"+iventId).html())>0){

								do_close('42'+iventId);

							} if(parseFloat($("#43"+iventId).html())>0){

								do_close('43'+iventId);

							}



                            //console_log(bt.n+' update received (Locking)', subscriptionMsg, bt);

						} else  {

							if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
								$('#ou_o65' + iventId).hide();
								$('#ou_o65_L' + iventId).show();
							} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
								$('#ou_o65' + iventId).show();
								$('#ou_o65_L' + iventId).hide();
							}

							if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
								$('#ou_u65' + iventId).hide();
								$('#ou_u65_L' + iventId).show();
							} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
								$('#ou_u65' + iventId).show();
								$('#ou_u65_L' + iventId).hide();
							}


                            //console_log(bt.n+' update received (Unlocking)', subscriptionMsg, bt);

                        }


                }
				
				
				
				//OU 7.5
				else if (bt["n"] == "OU" && bt["h"] == "7.5") {
					
					//console.log('OU ' +iventId+' -> ' + bt["h"]);
					
                    update_over_under(subscriptionMsg, bt);

					var int = iventId+bt["n"];

					b2_status[int] = typeof bt.b !== "undefined" ? bt.b : b2_status[int];
					r2_status[int] = typeof bt.r !== "undefined" ? bt.r : r2_status[int];

					if(typeof bt.o !== "undefined") {

						if (typeof bt.o[0] !== "undefined") {
							b3o1_status[int] = bt.o[0].hasOwnProperty('b') ? bt.o[0].b : b3o1_status[int];
							r3o1_status[int] = bt.o[0].hasOwnProperty('r') ? bt.o[0].r : r3o1_status[int];
						}

						if (typeof bt.o[1] !== "undefined") {
							b3o2_status[int] = bt.o[1].hasOwnProperty('b') ? bt.o[1].b : b3o2_status[int];
							r3o2_status[int] = bt.o[1].hasOwnProperty('r') ? bt.o[1].r : r3o2_status[int];
						}

						if (typeof bt.o[2] !== "undefined") {
							b3o3_status[int] = bt.o[2].hasOwnProperty('b') ? bt.o[2].b : b3o3_status[int];
							r3o3_status[int] = bt.o[2].hasOwnProperty('r') ? bt.o[2].r : r3o3_status[int];
						}

					}



					if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

							$('#ou_o75' + iventId).hide();

                            $('#ou_u75' + iventId).hide();



                            $('#ou_o75_L' + iventId).show();

                            $('#ou_u75_L' + iventId).show();

							

							if(parseFloat($("#44"+iventId).html())>0){

								do_close('44'+iventId);

							} if(parseFloat($("#45"+iventId).html())>0){

								do_close('45'+iventId);

							}



                            //console_log(bt.n+' update received (Locking)', subscriptionMsg, bt);

						} else  {

							if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
								$('#ou_o75' + iventId).hide();
								$('#ou_o75_L' + iventId).show();
							} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
								$('#ou_o75' + iventId).show();
								$('#ou_o75_L' + iventId).hide();
							}

							if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
								$('#ou_u75' + iventId).hide();
								$('#ou_u75_L' + iventId).show();
							} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
								$('#ou_u75' + iventId).show();
								$('#ou_u75_L' + iventId).hide();
							}


                            //console_log(bt.n+' update received (Unlocking)', subscriptionMsg, bt);

                        }


                }
				
				
				
				//OU 8.5
				else if (bt["n"] == "OU" && bt["h"] == "8.5") {
					
					//console.log('OU ' +iventId+' -> ' + bt["h"]);
					
                    update_over_under(subscriptionMsg, bt);

					var int = iventId+bt["n"];

					b2_status[int] = typeof bt.b !== "undefined" ? bt.b : b2_status[int];
					r2_status[int] = typeof bt.r !== "undefined" ? bt.r : r2_status[int];

					if(typeof bt.o !== "undefined") {

						if (typeof bt.o[0] !== "undefined") {
							b3o1_status[int] = bt.o[0].hasOwnProperty('b') ? bt.o[0].b : b3o1_status[int];
							r3o1_status[int] = bt.o[0].hasOwnProperty('r') ? bt.o[0].r : r3o1_status[int];
						}

						if (typeof bt.o[1] !== "undefined") {
							b3o2_status[int] = bt.o[1].hasOwnProperty('b') ? bt.o[1].b : b3o2_status[int];
							r3o2_status[int] = bt.o[1].hasOwnProperty('r') ? bt.o[1].r : r3o2_status[int];
						}

						if (typeof bt.o[2] !== "undefined") {
							b3o3_status[int] = bt.o[2].hasOwnProperty('b') ? bt.o[2].b : b3o3_status[int];
							r3o3_status[int] = bt.o[2].hasOwnProperty('r') ? bt.o[2].r : r3o3_status[int];
						}

					}



					if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

							$('#ou_o85' + iventId).hide();

                            $('#ou_u85' + iventId).hide();



                            $('#ou_o85_L' + iventId).show();

                            $('#ou_u85_L' + iventId).show();

							

							if(parseFloat($("#46"+iventId).html())>0){

								do_close('46'+iventId);

							} if(parseFloat($("#47"+iventId).html())>0){

								do_close('47'+iventId);

							}



                            //console_log(bt.n+' update received (Locking)', subscriptionMsg, bt);

						} else  {

							if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
								$('#ou_o85' + iventId).hide();
								$('#ou_o85_L' + iventId).show();
							} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
								$('#ou_o85' + iventId).show();
								$('#ou_o85_L' + iventId).hide();
							}

							if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
								$('#ou_u85' + iventId).hide();
								$('#ou_u85_L' + iventId).show();
							} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
								$('#ou_u85' + iventId).show();
								$('#ou_u85_L' + iventId).hide();
							}


                            //console_log(bt.n+' update received (Unlocking)', subscriptionMsg, bt);

                        }


                }
				
				
				
				//OU 9.5
				else if (bt["n"] == "OU" && bt["h"] == "9.5") {
					
					//console.log('OU ' +iventId+' -> ' + bt["h"]);
					
                    update_over_under(subscriptionMsg, bt);

					var int = iventId+bt["n"];

					b2_status[int] = typeof bt.b !== "undefined" ? bt.b : b2_status[int];
					r2_status[int] = typeof bt.r !== "undefined" ? bt.r : r2_status[int];

					if(typeof bt.o !== "undefined") {

						if (typeof bt.o[0] !== "undefined") {
							b3o1_status[int] = bt.o[0].hasOwnProperty('b') ? bt.o[0].b : b3o1_status[int];
							r3o1_status[int] = bt.o[0].hasOwnProperty('r') ? bt.o[0].r : r3o1_status[int];
						}

						if (typeof bt.o[1] !== "undefined") {
							b3o2_status[int] = bt.o[1].hasOwnProperty('b') ? bt.o[1].b : b3o2_status[int];
							r3o2_status[int] = bt.o[1].hasOwnProperty('r') ? bt.o[1].r : r3o2_status[int];
						}

						if (typeof bt.o[2] !== "undefined") {
							b3o3_status[int] = bt.o[2].hasOwnProperty('b') ? bt.o[2].b : b3o3_status[int];
							r3o3_status[int] = bt.o[2].hasOwnProperty('r') ? bt.o[2].r : r3o3_status[int];
						}

					}



					if (b1_status[iventId] === 1 || (typeof b2_status[int] !== 'undefined' && b2_status[int] === 1) || (typeof r2_status[int] !== 'undefined' && r2_status[int] === 1)) {

							$('#ou_o95' + iventId).hide();

                            $('#ou_u95' + iventId).hide();



                            $('#ou_o95_L' + iventId).show();

                            $('#ou_u95_L' + iventId).show();

							

							if(parseFloat($("#48"+iventId).html())>0){

								do_close('48'+iventId);

							} if(parseFloat($("#49"+iventId).html())>0){

								do_close('49'+iventId);

							}



                            //console_log(bt.n+' update received (Locking)', subscriptionMsg, bt);

						} else  {

							if((typeof b3o1_status[int] !== 'undefined' && b3o1_status[int] === 1) || (typeof r3o1_status[int] !== 'undefined' && r3o1_status[int] === 1)) {
								$('#ou_o95' + iventId).hide();
								$('#ou_o95_L' + iventId).show();
							} else if(((typeof b3o1_status[int] !== "undefined" && b3o1_status[int] === 0) || typeof b3o1_status[int] === "undefined") && ((typeof r3o1_status[int] !== "undefined" && r3o1_status[int] === 0) ||  typeof r3o1_status[int] === "undefined")) {
								$('#ou_o95' + iventId).show();
								$('#ou_o95_L' + iventId).hide();
							}

							if((typeof b3o2_status[int] !== 'undefined' && b3o2_status[int] === 1) || (typeof r3o2_status[int] !== 'undefined' && r3o2_status[int] === 1)) {
								$('#ou_u95' + iventId).hide();
								$('#ou_u95_L' + iventId).show();
							} else if(((typeof b3o2_status[int] !== "undefined" && b3o2_status[int] === 0) || typeof b3o2_status[int] === "undefined") && ((typeof r3o2_status[int] !== "undefined" && r3o2_status[int] === 0) ||  typeof r3o2_status[int] === "undefined")) {
								$('#ou_u95' + iventId).show();
								$('#ou_u95_L' + iventId).hide();
							}


                            //console_log(bt.n+' update received (Unlocking)', subscriptionMsg, bt);

                        }


                }
				
				
				
				




            });

        }





        /**

         * GROUP: Update Match Winner

         */

        function update_match_winner(subscriptionMsg, bt){

            var event_id = subscriptionMsg["eId"];



            //console_log(bt.n+' update received', subscriptionMsg);





            if (typeof bt != "undefined" && typeof bt["o"] != "undefined" && bt.n != "undefined") {

                //var data = subscriptionMsg["obj"][0]["bt"][onextwokey]["o"];

                var data = bt["o"];

                if (typeof data != "undefined" || (data instanceof Array)) {



                    //console.log("BT "+event_id+":");

                    //console.log(bt);



                    // 1x2





                    if(bt.n == "1x2") {





                        if (typeof data[0] != "undefined") {

                            if (data[0].n == "1" && data[0]["v"] != "") {

                                //alert(btObj[onextwokey]["b"]+'-'+data[0].n+" 0");

                                $('#1x2_val_1' + event_id).html(data[0]["v"]);

								

								$('#span_1' + event_id).html(data[0]["v"]);

								$('#1' + event_id).html(data[0]["v"]);

                                $('#1x2_val_1' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#1x2_val_1' + event_id);

                            } else if (data[0].n == "X" && data[0]["v"] != "") {

                                $('#1x2_val_x' + event_id).html(data[0]["v"]);

								

								$('#span_2' + event_id).html(data[0]["v"]);

								$('#2' + event_id).html(data[0]["v"]);

                                //alert(data[0].n+" 0");

                                $('#1x2_val_x' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#1x2_val_x' + event_id);

                            } else if (data[0].n == "2" && data[0]["v"] != "") {

                                //alert(data[0].n+" 0");

                                $('#1x2_val_2' + event_id).html(data[0]["v"]);

								

								$('#span_3' + event_id).html(data[0]["v"]);

								$('#3' + event_id).html(data[0]["v"]);

                                $('#1x2_val_2' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#1x2_val_2' + event_id);

                            }

                        }





                        if (typeof data[1] != "undefined") {

                            if (data[1].n == "1" && data[1]["v"] != "") {

                                //alert(data[1].n+" 1");

                                $('#1x2_val_1' + event_id).html(data[1]["v"]);

								

								$('#span_1' + event_id).html(data[1]["v"]);

								$('#1' + event_id).html(data[1]["v"]);

                                $('#1x2_val_1' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#1x2_val_1' + event_id);

                            } else if (data[1].n == "X" && data[1]["v"] != "") {

                                //alert(data[1].n+" 1");

                                $('#1x2_val_x' + event_id).html(data[1]["v"]);

								

								$('#span_2' + event_id).html(data[1]["v"]);

								$('#2' + event_id).html(data[1]["v"]);

                                $('#1x2_val_x' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#1x2_val_x' + event_id);

                            } else if (data[1].n == "2" && data[1]["v"] != "") {

                                //alert(data[1].n+" 1");

                                $('#1x2_val_2' + event_id).html(data[1]["v"]);

								

								$('#span_2' + event_id).html(data[1]["v"]);

								$('#3' + event_id).html(data[1]["v"]);

                                $('#1x2_val_2' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#1x2_val_2' + event_id);

                            }

                        }





                        if (typeof data[2] != "undefined") {

                            if (data[2].n == "1" && data[2]["v"] != "") {

                                //alert(data[2].n+" 2");

                                $('#1x2_val_1' + event_id).html(data[2]["v"]);

								

								$('#span_1' + event_id).html(data[2]["v"]);

								$('#1' + event_id).html(data[2]["v"]);

                                $('#1x2_val_1' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#1x2_val_1' + event_id);

                            } else if (data[2].n == "X" && data[2]["v"] != "") {

                                //alert(data[2].n+" 2");

                                $('#1x2_val_x' + event_id).html(data[2]["v"]);

								

								$('#span_2' + event_id).html(data[2]["v"]);

								$('#2' + event_id).html(data[2]["v"]);

                                $('#1x2_val_x' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#1x2_val_x' + event_id);

                            } else if (data[2].n == "2" && data[2]["v"] != "") {

                                //alert(data[2].n+" 2");

                                $('#1x2_val_2' + event_id).html(data[2]["v"]);

								

								$('#span_3' + event_id).html(data[2]["v"]);

								$('#3' + event_id).html(data[2]["v"]);

                                $('#1x2_val_2' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#1x2_val_2' + event_id);

                            }

                        }

						upd_slip();



                    }





                    // H data iventId

                    else if(bt.n == "1x2_H1"){



                        //console.log("going here");



                        if (typeof data[0] != "undefined"){



                            if (data[0].n == "1" && data[0]["v"] != "") {

                                $('#1x2h1_val_1' + event_id).html(data[0]["v"]);

								

								$('#span_4' + event_id).html(data[0]["v"]);

								$('#4' + event_id).html(data[0]["v"]);

                                $('#1x2h1_val_1' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#1x2h1_val_1' + event_id);

                            } else if (data[0].n == "X" && data[0]["v"] != "") {

                                $('#1x2h1_val_x' + event_id).html(data[0]["v"]);

								

								$('#span_5' + event_id).html(data[0]["v"]);

								$('#5' + event_id).html(data[0]["v"]);

                                $('#1x2h1_val_x' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#1x2h1_val_x' + event_id);

                            } else if (data[0].n == "2" && data[0]["v"] != "") {

                                $('#1x2h1_val_2' + event_id).html(data[0]["v"]);

								

								$('#span_6' + event_id).html(data[0]["v"]);

								$('#6' + event_id).html(data[0]["v"]);

                                $('#1x2h1_val_2' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#1x2h1_val_2' + event_id);

                            }

                        }

                        if (typeof data[1] != "undefined"){



                            if (data[1].n == "1" && data[1]["v"] != "") {

                                $('#1x2h1_val_1' + event_id).html(data[1]["v"]);

								

								$('#span_4' + event_id).html(data[1]["v"]);

								$('#4' + event_id).html(data[1]["v"]);

                                $('#1x2h1_val_1' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#1x2h1_val_1' + event_id);

                            } else if (data[1].n == "X" && data[1]["v"] != "") {

                                $('#1x2h1_val_x' + event_id).html(data[1]["v"]);

								

								$('#span_5' + event_id).html(data[1]["v"]);

								$('#5' + event_id).html(data[1]["v"]);

                                $('#1x2h1_val_x' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#1x2h1_val_x' + event_id);

                            } else if (data[1].n == "2" && data[1]["v"] != "") {

                                $('#1x2h1_val_2' + event_id).html(data[1]["v"]);

								

								$('#span_6' + event_id).html(data[1]["v"]);

								$('#6' + event_id).html(data[1]["v"]);

                                $('#1x2h1_val_2' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#1x2h1_val_2' + event_id);

                            }



                        }

                        if (typeof data[2] != "undefined"){



                            if (data[2].n == "1" && data[2]["v"] != "") {

                                $('#1x2h1_val_1' + event_id).html(data[2]["v"]);

								

								$('#span_4' + event_id).html(data[2]["v"]);

								$('#4' + event_id).html(data[2]["v"]);

                                $('#1x2h1_val_1' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#1x2h1_val_1' + event_id);

                            } else if (data[2].n == "X" && data[2]["v"] != "") {

                                $('#1x2h1_val_x' + event_id).html(data[2]["v"]);

								

								$('#span_5' + event_id).html(data[2]["v"]);

								$('#5' + event_id).html(data[2]["v"]);

                                $('#1x2h1_val_x' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#1x2h1_val_x' + event_id);

                            } else if (data[2].n == "2" && data[2]["v"] != "") {

                                $('#1x2h1_val_2' + event_id).html(data[2]["v"]);

								

								$('#span_6' + event_id).html(data[2]["v"]);

								$('#6' + event_id).html(data[2]["v"]);

                                $('#1x2h1_val_2' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#1x2h1_val_2' + event_id);

                            }

                        }

                    }



                }

            }

        }





        /**

         * GROUP: Update Rest Match

         */

        function update_rest_match(subscriptionMsg, bt){

            var iventId = subscriptionMsg["eId"];



            console_log(bt.n+' update received', subscriptionMsg);





            if (typeof bt != "undefined" && typeof bt["o"] != "undefined" && bt.n != "undefined") {

                //var data = subscriptionMsg["obj"][0]["bt"][onextwokey]["o"];

                var data = bt["o"];

                if (typeof data != "undefined" || (data instanceof Array)) {



                    //console.log("BT "+event_id+":");

                    //console.log('RES---'+iventId);

					var rgh = parseInt($("#team_1_score" + iventId).html()) + '.' + parseInt($("#team_2_score" + iventId).html());

                    // RES_1x2

                    if(bt.n == "RES_1x2" && bt.h == rgh) {

						//console.log('RES_1x2-UPD-'+iventId+'->'+rgh);

                        if (typeof data[0] != "undefined"){



                            if (data[0].n == "1" && data[0]["v"] != "") {

                                $('#res_val_1' + iventId).html(data[0]["v"]);

								

								$('#span_7' + iventId).html(data[0]["v"]);

								$('#7' + iventId).html(data[0]["v"]);

                                $('#res_val_1' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#res_val_1' + iventId);

                            } else if (data[0].n == "X" && data[0]["v"] != "") {

                                $('#res_val_x' + iventId).html(data[0]["v"]);

								

								$('#span_8' + iventId).html(data[0]["v"]);

								$('#8' + iventId).html(data[0]["v"]);

                                $('#res_val_x' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#res_val_x' + iventId);

                            } else if (data[0].n == "2" && data[0]["v"] != "") {

                                $('#res_val_2' + iventId).html(data[0]["v"]);

								

								$('#span_9' + iventId).html(data[0]["v"]);

								$('#9' + iventId).html(data[0]["v"]);

                                $('#res_val_2' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#res_val_2' + iventId);

                            }

                        }

                        if (typeof data[1] != "undefined"){



                            if (data[1].n == "1" && data[1]["v"] != "") {

                                $('#res_val_1' + iventId).html(data[1]["v"]);

								

								$('#span_7' + iventId).html(data[1]["v"]);

								$('#7' + iventId).html(data[1]["v"]);

                                $('#res_val_1' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#res_val_1' + iventId);

                            } else if (data[1].n == "X" && data[1]["v"] != "") {

                                $('#res_val_x' + iventId).html(data[1]["v"]);

								

								$('#span_8' + iventId).html(data[1]["v"]);

								$('#8' + iventId).html(data[1]["v"]);

                                $('#res_val_x' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#res_val_x' + iventId);

                            } else if (data[1].n == "2" && data[1]["v"] != "") {

                                $('#res_val_2' + iventId).html(data[1]["v"]);

								

								$('#span_9' + iventId).html(data[1]["v"]);

								$('#9' + iventId).html(data[1]["v"]);

                                $('#res_val_2' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#res_val_2' + iventId);

                            }

                        }

                        if (typeof data[2] != "undefined"){



                            if (data[2].n == "1" && data[2]["v"] != "") {

                                $('#res_val_1' + iventId).html(data[2]["v"]);

								

								$('#span_7' + iventId).html(data[2]["v"]);

								$('#7' + iventId).html(data[2]["v"]);

                                $('#res_val_1' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#res_val_1' + iventId);

                            } else if (data[2].n == "X" && data[2]["v"] != "") {

                                $('#res_val_x' + iventId).html(data[2]["v"]);

								

								$('#span_8' + iventId).html(data[2]["v"]);

								$('#8' + iventId).html(data[2]["v"]);

                                $('#res_val_x' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#res_val_x' + iventId);

                            } else if (data[2].n == "2" && data[2]["v"] != "") {

                                $('#res_val_2' + iventId).html(data[2]["v"]);

								

								$('#span_9' + iventId).html(data[2]["v"]);

								$('#9' + iventId).html(data[2]["v"]);

                                $('#res_val_2' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#res_val_2' + iventId);

                            }

                        }



                    }





                    // RES_1x2_H

                    else if(bt.n == "RES_1x2_H" && bt.h == rgh){



                        if (typeof data[0] != "undefined"){



                            if (data[0].n == "1" && data[0]["v"] != "") {

                                $('#resh1_val_1' + iventId).html(data[0]["v"]);

								

								$('#span_10' + iventId).html(data[0]["v"]);

								$('#10' + iventId).html(data[0]["v"]);

                                $('#resh1_val_1' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#resh1_val_1' + iventId);

                            } else if (data[0].n == "X" && data[0]["v"] != "") {

                                $('#resh1_val_x' + iventId).html(data[0]["v"]);

								

								$('#span_11' + iventId).html(data[0]["v"]);

								$('#11' + iventId).html(data[0]["v"]);

                                $('#resh1_val_x' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#resh1_val_x' + iventId);

                            } else if (data[0].n == "2" && data[0]["v"] != "") {

                                $('#resh1_val_2' + iventId).html(data[0]["v"]);

								

								$('#span_12' + iventId).html(data[0]["v"]);

								$('#12' + iventId).html(data[0]["v"]);

                                $('#resh1_val_2' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#resh1_val_2' + iventId);

                            }

                        }

                        if (typeof data[1] != "undefined"){



                            if (data[1].n == "1" && data[1]["v"] != "") {

                                $('#resh1_val_1' + iventId).html(data[1]["v"]);

								

								$('#span_10' + iventId).html(data[1]["v"]);

								$('#10' + iventId).html(data[1]["v"]);

                                $('#resh1_val_1' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#resh1_val_1' + iventId);

                            } else if (data[1].n == "X" && data[1]["v"] != "") {

                                $('#resh1_val_x' + iventId).html(data[1]["v"]);

								

								$('#span_11' + iventId).html(data[1]["v"]);

								$('#11' + iventId).html(data[1]["v"]);

                                $('#resh1_val_x' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#resh1_val_x' + iventId);

                            } else if (data[1].n == "2" && data[1]["v"] != "") {

                                $('#resh1_val_2' + iventId).html(data[1]["v"]);

								

								$('#span_12' + iventId).html(data[1]["v"]);

								$('#12' + iventId).html(data[1]["v"]);

                                $('#resh1_val_2' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#resh1_val_2' + iventId);

                            }

                        }

                        if (typeof data[2] != "undefined"){



                            if (data[2].n == "1" && data[2]["v"] != "") {

                                $('#resh1_val_1' + iventId).html(data[2]["v"]);

								

								$('#span_10' + iventId).html(data[2]["v"]);

								$('#10' + iventId).html(data[2]["v"]);

                                $('#resh1_val_1' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#resh1_val_1' + iventId);

                            } else if (data[2].n == "X" && data[2]["v"] != "") {

                                $('#resh1_val_x' + iventId).html(data[2]["v"]);

								

								$('#span_11' + iventId).html(data[2]["v"]);

								$('#11' + iventId).html(data[2]["v"]);

                                $('#resh1_val_x' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#resh1_val_x' + iventId);

                            } else if (data[2].n == "2" && data[2]["v"] != "") {

                                $('#resh1_val_2' + iventId).html(data[2]["v"]);

								

								$('#span_12' + iventId).html(data[2]["v"]);

								$('#12' + iventId).html(data[2]["v"]);

                                $('#resh1_val_2' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#resh1_val_2' + iventId);

                            }

                        }



                    }



                }

            }


        }





        /**

         * GROUP: Update Next Goal

         */

        function update_next_goal(subscriptionMsg, bt){

            var iventId = subscriptionMsg["eId"];



            //console_log(bt.n+' update received', subscriptionMsg);



            if (typeof bt != "undefined" && typeof bt["o"] != "undefined" && bt.n != "undefined") {

                //var betData = subscriptionMsg["obj"][0]["bt"][onextwokey]["o"];

                var data = bt["o"];

                if (typeof data != "undefined" || (data instanceof Array)) {



                    //console.log("BT "+event_id+":");

                    //console.log(bt);
					
					var total_g1 = parseInt($("#team_1_score" + iventId).html()) + parseInt($("#team_2_score" + iventId).html()) + 1;		
					var S1G = 'S'+ total_g1 +'G';
					var S1G_H1 = 'S'+ total_g1 +'G_H1';

                    // S1G

                    if(bt["n"] == S1G) {



                        if (typeof data[0] != "undefined"){



                            if (data[0].n == "1" && data[0]["v"] != "") {

                                $('#s1g_val_1' + iventId).html(data[0]["v"]);

								

								$('#span_13' + iventId).html(data[0]["v"]);

								$('#13' + iventId).html(data[0]["v"]);

                                $('#s1g_val_1' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#s1g_val_1' + iventId);

                            } else if (data[0].n == "No goal" && data[0]["v"] != "") {

                                $('#s1g_val_x' + iventId).html(data[0]["v"]);

								

								$('#span_14' + iventId).html(data[0]["v"]);

								$('#14' + iventId).html(data[0]["v"]);

                                $('#s1g_val_x' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#s1g_val_x' + iventId);

                            } else if (data[0].n == "2" && data[0]["v"] != "") {

                                $('#s1g_val_2' + iventId).html(data[0]["v"]);

								

								$('#span_15' + iventId).html(data[0]["v"]);

								$('#15' + iventId).html(data[0]["v"]);

                                $('#s1g_val_2' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#s1g_val_2' + iventId);

                            }

                        }



                        if (typeof data[1] != "undefined"){



                            if (data[1].n == "1" && data[1]["v"] != "") {

                                $('#s1g_val_2' + iventId).html(data[1]["v"]);

								

								$('#span_13' + iventId).html(data[1]["v"]);

								$('#13' + iventId).html(data[1]["v"]);

                                $('#s1g_val_1' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#s1g_val_1' + iventId);

                            } else if (data[1].n == "No goal" && data[1]["v"] != "") {

                                $('#s1g_val_x' + iventId).html(data[1]["v"]);

								

								$('#span_14' + iventId).html(data[1]["v"]);

								$('#14' + iventId).html(data[1]["v"]);

                                $('#s1g_val_x' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#s1g_val_x' + iventId);

                            } else if (data[1].n == "2" && data[1]["v"] != "") {

                                $('#s1g_val_2' + iventId).html(data[1]["v"]);

								

								$('#span_15' + iventId).html(data[1]["v"]);

								$('#15' + iventId).html(data[1]["v"]);

                                $('#s1g_val_2' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#s1g_val_2' + iventId);

                            }

                        }



                        if (typeof data[2] != "undefined"){



                            if (data[2].n == "1" && data[2]["v"] != "") {

                                $('#s1g_val_1' + iventId).html(data[2]["v"]);

								

								$('#span_13' + iventId).html(data[2]["v"]);

								$('#13' + iventId).html(data[2]["v"]);

                                $('#s1g_val_1' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#s1g_val_1' + iventId);

                            } else if (data[2].n == "No goal" && data[2]["v"] != "") {

                                $('#s1g_val_x' + iventId).html(data[2]["v"]);

								

								$('#span_14' + iventId).html(data[2]["v"]);

								$('#14' + iventId).html(data[2]["v"]);

                                $('#s1g_val_x' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#s1g_val_x' + iventId);

                            } else if (data[2].n == "2" && data[2]["v"] != "") {

                                $('#s1g_val_2' + iventId).html(data[2]["v"]);

								

								$('#span_15' + iventId).html(data[2]["v"]);

								$('#15' + iventId).html(data[2]["v"]);

                                $('#s1g_val_2' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#s1g_val_2' + iventId);

                            }

                        }



                    }





                    // H

                    else if(bt["n"] == S1G_H1){



                        if (typeof data[0] != "undefined"){



                            if (data[0].n == "1" && data[0]["v"] != "") {

                                $('#s1gh1_val_1' + iventId).html(data[0]["v"]);

								

								$('#span_16' + iventId).html(data[0]["v"]);

								$('#16' + iventId).html(data[0]["v"]);

                                $('#s1gh1_val_1' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#s1gh1_val_1' + iventId);

                            } else if (data[0].n == "No goal" && data[0]["v"] != "") {

                                $('#s1gh1_val_x' + iventId).html(data[0]["v"]);

								

								$('#span_17' + iventId).html(data[0]["v"]);

								$('#17' + iventId).html(data[0]["v"]);

                                $('#s1gh1_val_x' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#s1gh1_val_x' + iventId);

                            } else if (data[0].n == "2" && data[0]["v"] != "") {

                                $('#s1gh1_val_2' + iventId).html(data[0]["v"]);

								

								$('#span_18' + iventId).html(data[0]["v"]);

								$('#18' + iventId).html(data[0]["v"]);

                                $('#s1gh1_val_2' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#s1gh1_val_2' + iventId);

                            }



                        }



                        if (typeof data[1] != "undefined"){



                            if (data[1].n == "1" && data[1]["v"] != "") {

                                $('#s1gh1_val_1' + iventId).html(data[1]["v"]);

								

								$('#span_16' + iventId).html(data[1]["v"]);

								$('#16' + iventId).html(data[1]["v"]);

                                $('#s1gh1_val_1' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#s1gh1_val_1' + iventId);

                            } else if (data[1].n == "No goal" && data[1]["v"] != "") {

                                $('#s1gh1_val_x' + iventId).html(data[1]["v"]);

								

								$('#span_17' + iventId).html(data[1]["v"]);

								$('#17' + iventId).html(data[1]["v"]);

                                $('#s1gh1_val_x' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#s1gh1_val_x' + iventId);

                            } else if (data[1].n == "2" && data[1]["v"] != "") {

                                $('#s1gh1_val_2' + iventId).html(data[1]["v"]);

								

								$('#span_18' + iventId).html(data[1]["v"]);

								$('#18' + iventId).html(data[1]["v"]);

                                $('#s1gh1_val_2' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#s1gh1_val_2' + iventId);

                            }



                        }



                        if (typeof data[2] != "undefined"){



                            if (data[2].n == "1" && data[2]["v"] != "") {

                                $('#s1gh1_val_1' + iventId).html(data[2]["v"]);

								

								$('#span_16' + iventId).html(data[2]["v"]);

								$('#16' + iventId).html(data[2]["v"]);

                                $('#s1gh1_val_1' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#s1gh1_val_1' + iventId);

                            } else if (data[2].n == "No goal" && data[2]["v"] != "") {

                                $('#s1gh1_val_x' + iventId).html(data[2]["v"]);

								

								$('#span_17' + iventId).html(data[2]["v"]);

								$('#17' + iventId).html(data[2]["v"]);

                                $('#s1gh1_val_x' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#s1gh1_val_x' + iventId);

                            } else if (data[2].n == "2" && data[2]["v"] != "") {

                                $('#s1gh1_val_2' + iventId).html(data[2]["v"]);

								

								$('#span_18' + iventId).html(data[2]["v"]);

								$('#18' + iventId).html(data[2]["v"]);

                                $('#s1gh1_val_2' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#s1gh1_val_2' + iventId);

                            }

                        }



                    }



                }

            }



        }





        /**

         * GROUP: Update Total

         */

        function update_total(subscriptionMsg, bt){

            var iventId = subscriptionMsg["eId"];



            //console_log(bt.n+' update received', subscriptionMsg);



            if (typeof bt != "undefined" && typeof bt["o"] != "undefined" && bt.n != "undefined") {

                //var betData = subscriptionMsg["obj"][0]["bt"][onextwokey]["o"];

                var data = bt["o"];

                if (typeof data != "undefined" || (data instanceof Array)) {



                    //console.log("BT "+event_id+":");

                    //console.log(bt);

                    // OU


                    if(bt.n == "OU") {



                        if (typeof data[0] != "undefined"){

                            if (data[0].n == "Over") {

                                if(data[0].b != undefined && data[0].b === 1) {

                                    $('#over_under_o' + iventId).html(data[0]["v"]);

									

									$('#span_19' + iventId).html(data[0]["v"]);

									$('#19' + iventId).html(data[0]["v"]);

                                } else {

                                    $('#over_under_o' + iventId).html(data[0]["v"]);

									

									$('#span_19' + iventId).html(data[0]["v"]);

									$('#19' + iventId).html(data[0]["v"]);

                                }



                                $('#over_under_o' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#over_under_o' + iventId);

                            } else  if (data[0].n == "Under") {

                                if(data[0].b != undefined && data[0].b === 1) {

                                    $('#over_under_u' + iventId).html(data[0]["v"]);

									

									$('#span_20' + iventId).html(data[0]["v"]);

									$('#20' + iventId).html(data[0]["v"]);

                                } else {

                                    $('#over_under_u' + iventId).html(data[0]["v"]);

									

									$('#span_20' + iventId).html(data[0]["v"]);

									$('#20' + iventId).html(data[0]["v"]);

                                }



                                $('#over_under_u' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#over_under_u' + iventId);

                            }

                        }

                        if (typeof data[1] != "undefined"){

                            if (data[1].n == "Over") {

                                if(data[1].b != undefined && data[1].b === 1) {

                                    $('#over_under_o' + iventId).html(data[1]["v"]);

									

									$('#span_19' + iventId).html(data[1]["v"]);

									$('#19' + iventId).html(data[1]["v"]);

                                } else {

                                    $('#over_under_o' + iventId).html(data[1]["v"]);

									

									$('#span_19' + iventId).html(data[1]["v"]);

									$('#19' + iventId).html(data[1]["v"]);

                                }



                                $('#over_under_o' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#over_under_o' + iventId);

                            } else  if (data[1].n == "Under") {

                                if(data[1].b != undefined && data[1].b === 1) {

                                    $('#over_under_u' + iventId).html(data[1]["v"]);

									

									$('#span_20' + iventId).html(data[1]["v"]);

									$('#20' + iventId).html(data[1]["v"]);

                                } else {

                                    $('#over_under_u' + iventId).html(data[1]["v"]);

									

									$('#span_20' + iventId).html(data[1]["v"]);

									$('#20' + iventId).html(data[1]["v"]);

                                }

                                $('#over_under_u' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#over_under_u' + iventId);

                            }

                        }



                    }





                    // H betDataH iventId
					

                    else if(bt.n == "OU_H1"){



                        if (typeof data[0] != "undefined"){



                            if (data[0].n == "Over") {

                                $('#over_under_oh1' + iventId).html(data[0]["v"]);

								

								$('#span_21' + iventId).html(data[0]["v"]);

								$('#21' + iventId).html(data[0]["v"]);

                                $('#over_under_oh1' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#over_under_oh1' + iventId);

                            } else if (data[0].n == "Under") {

                                $('#over_under_uh1' + iventId).html(data[0]["v"]);

								

								$('#span_22' + iventId).html(data[0]["v"]);

								$('#22' + iventId).html(data[0]["v"]);

                                $('#over_under_uh1' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#over_under_uh1' + iventId);

                            }

                        }

                        if (typeof data[1] != "undefined"){



                            if (data[1].n == "Over") {

                                $('#over_under_oh1' + iventId).html(data[1]["v"]);

								

								$('#span_21' + iventId).html(data[1]["v"]);

								$('#21' + iventId).html(data[1]["v"]);

                                $('#over_under_oh1' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#over_under_oh1' + iventId);

                            } else if (data[1].n == "Under") {

                                $('#over_under_uh1' + iventId).html(data[1]["v"]);

								

								$('#span_22' + iventId).html(data[1]["v"]);

								$('#22' + iventId).html(data[1]["v"]);

                                $('#over_under_uh1' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#over_under_uh1' + iventId);

                            }

                        }



                    }



                }

            }



        }
		
		
		
		
		/**

         * GROUP: Update Double Chance

         */

        function update_double_chance(subscriptionMsg, bt){

            var event_id = subscriptionMsg["eId"];

            //console_log(bt.n+' update received', subscriptionMsg);

            if (typeof bt != "undefined" && typeof bt["o"] != "undefined" && bt.n != "undefined") {

                //var data = subscriptionMsg["obj"][0]["bt"][onextwokey]["o"];

                var data = bt["o"];

                if (typeof data != "undefined" || (data instanceof Array)) {

                    //console.log("BT "+event_id+":");

                    //console.log(bt);

                    // DC
                    if(bt.n == "DC") {

                        if (typeof data[0] != "undefined") {

                            if (data[0].n == "1X" && data[0]["v"] != "") {

                                //alert(btObj[onextwokey]["b"]+'-'+data[0].n+" 0");

                                $('#double_chance_1x' + event_id).html(data[0]["v"]);

								$('#span_23' + event_id).html(data[0]["v"]);

								$('#23' + event_id).html(data[0]["v"]);

                                $('#double_chance_1x' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#double_chance_1x' + event_id);

                            } else if (data[0].n == "X2" && data[0]["v"] != "") {

                                $('#double_chance_x2' + event_id).html(data[0]["v"]);

								$('#span_24' + event_id).html(data[0]["v"]);

								$('#24' + event_id).html(data[0]["v"]);

                                //alert(data[0].n+" 0");

                                $('#double_chance_x2' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#double_chance_x2' + event_id);

                            } else if (data[0].n == "12" && data[0]["v"] != "") {

                                //alert(data[0].n+" 0");

                                $('#double_chance_12' + event_id).html(data[0]["v"]);

								$('#span_25' + event_id).html(data[0]["v"]);

								$('#25' + event_id).html(data[0]["v"]);

                                $('#double_chance_12' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#double_chance_12' + event_id);

                            }

                        }





                        if (typeof data[1] != "undefined") {

                            if (data[1].n == "1X" && data[1]["v"] != "") {

                                //alert(data[1].n+" 1");

                                $('#double_chance_1x' + event_id).html(data[1]["v"]);

								$('#span_23' + event_id).html(data[1]["v"]);

								$('#23' + event_id).html(data[1]["v"]);

                                $('#double_chance_1x' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#double_chance_1x' + event_id);

                            } else if (data[1].n == "X2" && data[1]["v"] != "") {

                                //alert(data[1].n+" 1");

                                $('#double_chance_x2' + event_id).html(data[1]["v"]);

								$('#span_24' + event_id).html(data[1]["v"]);

								$('#24' + event_id).html(data[1]["v"]);

                                $('#double_chance_x2' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#double_chance_x2' + event_id);

                            } else if (data[1].n == "12" && data[1]["v"] != "") {

                                //alert(data[1].n+" 1");

                                $('#double_chance_12' + event_id).html(data[1]["v"]);

								$('#span_25' + event_id).html(data[1]["v"]);

								$('#25' + event_id).html(data[1]["v"]);

                                $('#double_chance_12' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#double_chance_12' + event_id);

                            }

                        }





                        if (typeof data[2] != "undefined") {

                            if (data[2].n == "1X" && data[2]["v"] != "") {

                                //alert(data[2].n+" 2");

                                $('#double_chance_1x' + event_id).html(data[2]["v"]);

								$('#span_23' + event_id).html(data[2]["v"]);

								$('#23' + event_id).html(data[2]["v"]);

                                $('#double_chance_1x' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#double_chance_1x' + event_id);

                            } else if (data[2].n == "X2" && data[2]["v"] != "") {

                                //alert(data[2].n+" 2");

                                $('#double_chance_x2' + event_id).html(data[2]["v"]);

								$('#span_24' + event_id).html(data[2]["v"]);

								$('#24' + event_id).html(data[2]["v"]);

                                $('#double_chance_x2' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#double_chance_x2' + event_id);

                            } else if (data[2].n == "12" && data[2]["v"] != "") {

                                //alert(data[2].n+" 2");

                                $('#double_chance_12' + event_id).html(data[2]["v"]);

								

								$('#span_25' + event_id).html(data[2]["v"]);

								$('#25' + event_id).html(data[2]["v"]);

                                $('#double_chance_12' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#double_chance_12' + event_id);

                            }

                        }

						upd_slip();



                    }


                }

            }

        }
		
		
		
		
		/**

         * GROUP: Update BTS

         */

        function update_bts(subscriptionMsg, bt){

            var event_id = subscriptionMsg["eId"];



            //console_log(bt.n+' update received', subscriptionMsg);





            if (typeof bt != "undefined" && typeof bt["o"] != "undefined" && bt.n != "undefined") {

                //var data = subscriptionMsg["obj"][0]["bt"][onextwokey]["o"];

                var data = bt["o"];

                if (typeof data != "undefined" || (data instanceof Array)) {

                    //console.log("BT "+event_id+":");

                    //console.log(bt);

                    if(bt.n == "BTS") {

                        if (typeof data[0] != "undefined") {

                            if (data[0].n == "Yes" && data[0]["v"] != "") {

                                //alert(btObj[onextwokey]["b"]+'-'+data[0].n+" 0");

                                $('#bts_yes' + event_id).html(data[0]["v"]);

								

								$('#span_26' + event_id).html(data[0]["v"]);

								$('#26' + event_id).html(data[0]["v"]);

                                $('#bts_yes' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#bts_yes' + event_id);

                            } else if (data[0].n == "No" && data[0]["v"] != "") {

                                $('#bts_no' + event_id).html(data[0]["v"]);

								

								$('#span_27' + event_id).html(data[0]["v"]);

								$('#27' + event_id).html(data[0]["v"]);

                                //alert(data[0].n+" 0");

                                $('#bts_no' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#bts_no' + event_id);

                            } 

                        }





                        if (typeof data[1] != "undefined") {

                            if (data[1].n == "Yes" && data[1]["v"] != "") {

                                //alert(data[1].n+" 1");

                                $('#bts_yes' + event_id).html(data[1]["v"]);

								

								$('#span_26' + event_id).html(data[1]["v"]);

								$('#26' + event_id).html(data[1]["v"]);

                                $('#bts_yes' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#bts_yes' + event_id);

                            } else if (data[1].n == "No" && data[1]["v"] != "") {

                                //alert(data[1].n+" 1");

                                $('#bts_no' + event_id).html(data[1]["v"]);

								

								$('#span_27' + event_id).html(data[1]["v"]);

								$('#27' + event_id).html(data[1]["v"]);

                                $('#bts_no' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#bts_no' + event_id);

                            }

                        }



						upd_slip();



                    }
					
					if(bt.n == "BTS_H1") {

                        if (typeof data[0] != "undefined") {

                            if (data[0].n == "Yes" && data[0]["v"] != "") {

                                //alert(btObj[onextwokey]["b"]+'-'+data[0].n+" 0");

                                $('#bts_yesh1' + event_id).html(data[0]["v"]);

								

								$('#span_28' + event_id).html(data[0]["v"]);

								$('#28' + event_id).html(data[0]["v"]);

                                $('#bts_yesh1' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#bts_yesh1' + event_id);

                            } else if (data[0].n == "No" && data[0]["v"] != "") {

                                $('#bts_noh1' + event_id).html(data[0]["v"]);

								

								$('#span_29' + event_id).html(data[0]["v"]);

								$('#29' + event_id).html(data[0]["v"]);

                                //alert(data[0].n+" 0");

                                $('#bts_noh1' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#bts_noh1' + event_id);

                            } 

                        }





                        if (typeof data[1] != "undefined") {

                            if (data[1].n == "Yes" && data[1]["v"] != "") {

                                //alert(data[1].n+" 1");

                                $('#bts_yesh1' + event_id).html(data[1]["v"]);

								

								$('#span_28' + event_id).html(data[1]["v"]);

								$('#28' + event_id).html(data[1]["v"]);

                                $('#bts_yesh1' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#bts_yesh1' + event_id);

                            } else if (data[1].n == "No" && data[1]["v"] != "") {

                                //alert(data[1].n+" 1");

                                $('#bts_noh1' + event_id).html(data[1]["v"]);

								

								$('#span_29' + event_id).html(data[1]["v"]);

								$('#29' + event_id).html(data[1]["v"]);

                                $('#bts_noh1' + event_id).parent('a').addClass('borderClass');

                                borderSetTime('#bts_noh1' + event_id);

                            }

                        }



						upd_slip();



                    }




                }

            }

        }
		
		
		
		
		
		
		
		
		
		
		/**

         * GROUP: Update Over Under

         */

        function update_over_under(subscriptionMsg, bt){

            var iventId = subscriptionMsg["eId"];



            //console_log(bt.n+' update received', subscriptionMsg);



            if (typeof bt != "undefined" && typeof bt["o"] != "undefined" && bt.n != "undefined") {

                //var betData = subscriptionMsg["obj"][0]["bt"][onextwokey]["o"];

                var data = bt["o"];

                if (typeof data != "undefined" || (data instanceof Array)) {



                    //console.log("BT "+event_id+":");

                    //console.log(bt);

                    // OU


                    if(bt.n == "OU" && bt.h == "0.5") {



                        if (typeof data[0] != "undefined"){

                            if (data[0].n == "Over") {

                                if(data[0].b != undefined && data[0].b === 1) {

                                    $('#ou_o05' + iventId).html(data[0]["v"]);

									

									$('#span_30' + iventId).html(data[0]["v"]);

									$('#30' + iventId).html(data[0]["v"]);

                                } else {

                                    $('#ou_o05' + iventId).html(data[0]["v"]);

									

									$('#span_30' + iventId).html(data[0]["v"]);

									$('#30' + iventId).html(data[0]["v"]);

                                }



                                $('#ou_o05' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#ou_o05' + iventId);

                            } else  if (data[0].n == "Under") {

                                if(data[0].b != undefined && data[0].b === 1) {

                                    $('#ou_u05' + iventId).html(data[0]["v"]);

									

									$('#span_31' + iventId).html(data[0]["v"]);

									$('#31' + iventId).html(data[0]["v"]);

                                } else {

                                    $('#ou_u05' + iventId).html(data[0]["v"]);

									

									$('#span_31' + iventId).html(data[0]["v"]);

									$('#31' + iventId).html(data[0]["v"]);

                                }



                                $('#ou_u05' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#ou_u05' + iventId);

                            }

                        }

                        if (typeof data[1] != "undefined"){

                            if (data[1].n == "Over") {

                                if(data[1].b != undefined && data[1].b === 1) {

                                    $('#ou_o05' + iventId).html(data[1]["v"]);

									

									$('#span_30' + iventId).html(data[1]["v"]);

									$('#30' + iventId).html(data[1]["v"]);

                                } else {

                                    $('#ou_o05' + iventId).html(data[1]["v"]);

									

									$('#span_30' + iventId).html(data[1]["v"]);

									$('#30' + iventId).html(data[1]["v"]);

                                }



                                $('#ou_o05' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#ou_o05' + iventId);

                            } else  if (data[1].n == "Under") {

                                if(data[1].b != undefined && data[1].b === 1) {

                                    $('#ou_u05' + iventId).html(data[1]["v"]);

									

									$('#span_31' + iventId).html(data[1]["v"]);

									$('#31' + iventId).html(data[1]["v"]);

                                } else {

                                    $('#ou_o05' + iventId).html(data[1]["v"]);

									

									$('#span_31' + iventId).html(data[1]["v"]);

									$('#31' + iventId).html(data[1]["v"]);

                                }

                                $('#ou_o05' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#ou_o05' + iventId);

                            }

                        }

						upd_slip();

                    }
					
					
					
					
					if(bt.n == "OU" && bt.h == "1.5") {



                        if (typeof data[0] != "undefined"){

                            if (data[0].n == "Over") {

                                if(data[0].b != undefined && data[0].b === 1) {

                                    $('#ou_o15' + iventId).html(data[0]["v"]);

									

									$('#span_32' + iventId).html(data[0]["v"]);

									$('#32' + iventId).html(data[0]["v"]);

                                } else {

                                    $('#ou_o15' + iventId).html(data[0]["v"]);

									

									$('#span_32' + iventId).html(data[0]["v"]);

									$('#32' + iventId).html(data[0]["v"]);

                                }



                                $('#ou_o15' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#ou_o15' + iventId);

                            } else  if (data[0].n == "Under") {

                                if(data[0].b != undefined && data[0].b === 1) {

                                    $('#ou_u15' + iventId).html(data[0]["v"]);

									

									$('#span_33' + iventId).html(data[0]["v"]);

									$('#33' + iventId).html(data[0]["v"]);

                                } else {

                                    $('#ou_u15' + iventId).html(data[0]["v"]);

									

									$('#span_33' + iventId).html(data[0]["v"]);

									$('#33' + iventId).html(data[0]["v"]);

                                }



                                $('#ou_u15' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#ou_u15' + iventId);

                            }

                        }

                        if (typeof data[1] != "undefined"){

                            if (data[1].n == "Over") {

                                if(data[1].b != undefined && data[1].b === 1) {

                                    $('#ou_o15' + iventId).html(data[1]["v"]);

									

									$('#span_32' + iventId).html(data[1]["v"]);

									$('#32' + iventId).html(data[1]["v"]);

                                } else {

                                    $('#ou_o15' + iventId).html(data[1]["v"]);

									

									$('#span_32' + iventId).html(data[1]["v"]);

									$('#32' + iventId).html(data[1]["v"]);

                                }



                                $('#ou_o15' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#ou_o15' + iventId);

                            } else  if (data[1].n == "Under") {

                                if(data[1].b != undefined && data[1].b === 1) {

                                    $('#ou_u15' + iventId).html(data[1]["v"]);

									

									$('#span_33' + iventId).html(data[1]["v"]);

									$('#33' + iventId).html(data[1]["v"]);

                                } else {

                                    $('#ou_o15' + iventId).html(data[1]["v"]);

									

									$('#span_33' + iventId).html(data[1]["v"]);

									$('#33' + iventId).html(data[1]["v"]);

                                }

                                $('#ou_o15' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#ou_o15' + iventId);

                            }

                        }

						upd_slip();

                    }
					
					
					
					
					
					if(bt.n == "OU" && bt.h == "2.5") {


                        if (typeof data[0] != "undefined"){

                            if (data[0].n == "Over") {

                                if(data[0].b != undefined && data[0].b === 1) {

                                    $('#ou_o25' + iventId).html(data[0]["v"]);

									

									$('#span_34' + iventId).html(data[0]["v"]);

									$('#34' + iventId).html(data[0]["v"]);

                                } else {

                                    $('#ou_o25' + iventId).html(data[0]["v"]);

									

									$('#span_34' + iventId).html(data[0]["v"]);

									$('#34' + iventId).html(data[0]["v"]);

                                }



                                $('#ou_o25' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#ou_o25' + iventId);

                            } else  if (data[0].n == "Under") {

                                if(data[0].b != undefined && data[0].b === 1) {

                                    $('#ou_u25' + iventId).html(data[0]["v"]);

									

									$('#span_35' + iventId).html(data[0]["v"]);

									$('#35' + iventId).html(data[0]["v"]);

                                } else {

                                    $('#ou_u25' + iventId).html(data[0]["v"]);

									

									$('#span_35' + iventId).html(data[0]["v"]);

									$('#35' + iventId).html(data[0]["v"]);

                                }



                                $('#ou_u25' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#ou_u25' + iventId);

                            }

                        }

                        if (typeof data[1] != "undefined"){

                            if (data[1].n == "Over") {

                                if(data[1].b != undefined && data[1].b === 1) {

                                    $('#ou_o25' + iventId).html(data[1]["v"]);

									

									$('#span_34' + iventId).html(data[1]["v"]);

									$('#34' + iventId).html(data[1]["v"]);

                                } else {

                                    $('#ou_o25' + iventId).html(data[1]["v"]);

									

									$('#span_34' + iventId).html(data[1]["v"]);

									$('#34' + iventId).html(data[1]["v"]);

                                }



                                $('#ou_o25' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#ou_o25' + iventId);

                            } else  if (data[1].n == "Under") {

                                if(data[1].b != undefined && data[1].b === 1) {

                                    $('#ou_u25' + iventId).html(data[1]["v"]);

									

									$('#span_35' + iventId).html(data[1]["v"]);

									$('#35' + iventId).html(data[1]["v"]);

                                } else {

                                    $('#ou_o25' + iventId).html(data[1]["v"]);

									

									$('#span_35' + iventId).html(data[1]["v"]);

									$('#35' + iventId).html(data[1]["v"]);

                                }

                                $('#ou_o25' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#ou_o25' + iventId);

                            }

                        }

						upd_slip();

                    }
					
					
					
					if(bt.n == "OU" && bt.h == "3.5") {



                        if (typeof data[0] != "undefined"){

                            if (data[0].n == "Over") {

                                if(data[0].b != undefined && data[0].b === 1) {

                                    $('#ou_o35' + iventId).html(data[0]["v"]);

									

									$('#span_36' + iventId).html(data[0]["v"]);

									$('#36' + iventId).html(data[0]["v"]);

                                } else {

                                    $('#ou_o35' + iventId).html(data[0]["v"]);

									

									$('#span_36' + iventId).html(data[0]["v"]);

									$('#36' + iventId).html(data[0]["v"]);

                                }



                                $('#ou_o35' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#ou_o35' + iventId);

                            } else  if (data[0].n == "Under") {

                                if(data[0].b != undefined && data[0].b === 1) {

                                    $('#ou_u35' + iventId).html(data[0]["v"]);

									

									$('#span_37' + iventId).html(data[0]["v"]);

									$('#37' + iventId).html(data[0]["v"]);

                                } else {

                                    $('#ou_u35' + iventId).html(data[0]["v"]);

									

									$('#span_37' + iventId).html(data[0]["v"]);

									$('#37' + iventId).html(data[0]["v"]);

                                }



                                $('#ou_u35' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#ou_u35' + iventId);

                            }

                        }

                        if (typeof data[1] != "undefined"){

                            if (data[1].n == "Over") {

                                if(data[1].b != undefined && data[1].b === 1) {

                                    $('#ou_o35' + iventId).html(data[1]["v"]);

									

									$('#span_36' + iventId).html(data[1]["v"]);

									$('#36' + iventId).html(data[1]["v"]);

                                } else {

                                    $('#ou_o35' + iventId).html(data[1]["v"]);

									

									$('#span_36' + iventId).html(data[1]["v"]);

									$('#36' + iventId).html(data[1]["v"]);

                                }



                                $('#ou_o35' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#ou_o35' + iventId);

                            } else  if (data[1].n == "Under") {

                                if(data[1].b != undefined && data[1].b === 1) {

                                    $('#ou_u35' + iventId).html(data[1]["v"]);

									

									$('#span_37' + iventId).html(data[1]["v"]);

									$('#37' + iventId).html(data[1]["v"]);

                                } else {

                                    $('#ou_o35' + iventId).html(data[1]["v"]);

									

									$('#span_37' + iventId).html(data[1]["v"]);

									$('#37' + iventId).html(data[1]["v"]);

                                }

                                $('#ou_o35' + iventId).parent('a').addClass('borderClass');

                                borderSetTime('#ou_o35' + iventId);

                            }

                        }

						upd_slip();

                    }
					





                    // ADDD
					



                }

            }



        }
		
		
		
		
		
		
		
		









        /**

         * Parse the template

         * @param data

         * @returns {*}

         */

        function parse_template(data) {

			row = '';

			if($("div").find("#ind_game_feed"+data.id).html()=== undefined){


				var inp = data.tm;
	
				var tmm = '';
	
				if(inp<0){
	
					var day = new Date();
	
					var timestamp = day.getTime();
	
					timestamp = timestamp - (1000*60*inp);
	
					
	
					var dnew = new Date(timestamp);
	
					var hh = dnew.getHours();
	
					var mm = dnew.getMinutes();
	
					if(mm<10){
	
						mm = '0'+mm;
	
					}
	
					var tmm = hh+':'+mm;
	
				}
	
				
	
				
	
				
	
				row += '<div id="ind_game_feed' + data.id + '" class="Gamedetl inner6 " style="display:none;">';
	
				row += '<div class="col1">';
	
				
	
				row += '<div class="scr_time Light12 Bold clr_ylw Align_cent" id="match_current_time' + data.id + '" style="display:none;">' + data.tm + '\'</div>';
	
	
	
				row += '<div class="scr_detail Light12 Bold White">';
	
				row += '<div class="b_1" id="team_1_name' + data.id + '">     ' + data.t1 + '</div>';
	
				row += '<div id="team_1_score' + data.id + '" class="b_3">' + data.g_t1 + '</div>';
	
				row += '<div class="b_4"><!--V--></div>';
	
				row += '<div id="team_2_score' + data.id + '" class="b_3">' + data.g_t2 + '</div>';
	
	
	
				row += '<div class="b_2" id="team_2_name' + data.id + '">' + data.t2 + ' ' + data.id + '</div>';
	
				row += '</div>';
	
	
	
				row += '<div class="league_name Light12 White Bold Align_cent" id="league_name' + data.id + '" style="display:none;">' +  data.inf + '</div>';
	
				
	
				row += '<div class="lf_botm Light10 White" id="sh_div' + data.id + '">';
	
				row += '<div class="t_c_1">' + data.inf + '</div>';
	
				
	
				
	
				////// tmm
	
				row += '<div class="t_c_3 Align_cent Light12 Bold clr_ylw"><p style="font-size:16px;" id="tmm_' + data.id + '">' + tmm + '</p></div>';
	
	
	
				row += '<div id="match_status' + data.id + '" class="t_c_2 Align_right">' + data.pn + '</div>';
	
				row += '</div>';
	
				row += '</div>';
	
	
	
	
	
				row += '<div class="col2 inner6">';
	
				row += '<div class="rest_title2">';
	
				row += '<div class="Inner_cnt_hd rw">';
	
				row += '<div class="tl_rw Light12 White Bold Align_cent">';
	
				row += '<!--Remaining match-->Match winner </div>';
	
				row += '<div class="tl_rw Light12 White Bold Align_cent">';
	
				row += '<div class="sm_cl">1</div>';
	
				row += '<div class="sm_cl">x</div>';
	
				row += '<div class="sm_cl">2</div>';
	
				row += '</div>';
	
				row += '</div>';
	
				
	
				
	
				<!--ADD CALCULATION HIDDEN-->
				var hid = '';
				var flag_select = 0;
				var flag_class = '';
				
				//var MID_ARRAY = [];
				
				//var MID_ARRAY = "<?php echo implode(",",$_SESSION['MID_ARR']);?>";
				
				var MID_ARRAY = $("#MID_ARRAY_HIDD").val();
	
				hid += '<input type="hidden" name="sport_' + data.id + '" id="sport_' + data.id + '" value="0"/>';
	
				hid += '<input type="hidden" name="market_' + data.id + '" id="market_' + data.id + '" value="0"/>';
	
				
	
				hid += '<input type="hidden" name="market1_' + data.id + '" id="market1_' + data.id + '" value=""/>';
	
				hid += '<input type="hidden" name="market2_' + data.id + '" id="market2_' + data.id + '" value=""/>';
	
				
	
				hid += '<input type="hidden" name="market3_' + data.id + '" id="market3_' + data.id + '" value=""/>';
	
				hid += '<input type="hidden" name="market4_' + data.id + '" id="market4_' + data.id + '" value=""/>';
	
				hid += '<input type="hidden" name="market5_' + data.id + '" id="market5_' + data.id + '" value=""/>';
	
				hid += '<input type="hidden" name="market6_' + data.id + '" id="market6_' + data.id + '" value=""/>';
	
				hid += '<input type="hidden" name="market7_' + data.id + '" id="market7_' + data.id + '" value=""/>';
	
				hid += '<input type="hidden" name="market8_' + data.id + '" id="market8_' + data.id + '" value=""/>';
				
				row += hid;
				
				
				//alert($("div").find("#sport_"+data.id).html());
				/*if($("div").find("#sport_"+data.id).html()==undefined){
					$("#live_hid").append(hid);
					//alert("Not find");
				}*/
	
				/*row += '<input type="hidden" name="market9_' + data.id + '" id="market9_' + data.id + '" value=""/>';
	
				row += '<input type="hidden" name="market10_' + data.id + '" id="market10_' + data.id + '" value=""/>';
	
				row += '<input type="hidden" name="market11_' + data.id + '" id="market11_' + data.id + '" value=""/>';
	
				row += '<input type="hidden" name="market12_' + data.id + '" id="market12_' + data.id + '" value=""/>';
	
				row += '<input type="hidden" name="market13_' + data.id + '" id="market13_' + data.id + '" value=""/>';
	
				row += '<input type="hidden" name="market14_' + data.id + '" id="market14_' + data.id + '" value=""/>';
	
				row += '<input type="hidden" name="market15_' + data.id + '" id="market15_' + data.id + '" value=""/>';
	
				row += '<input type="hidden" name="market16_' + data.id + '" id="market16_' + data.id + '" value=""/>';
	
				row += '<input type="hidden" name="market17_' + data.id + '" id="market17_' + data.id + '" value=""/>';
	
				row += '<input type="hidden" name="market18_' + data.id + '" id="market18_' + data.id + '" value=""/>';
	
				row += '<input type="hidden" name="market19_' + data.id + '" id="market19_' + data.id + '" value=""/>';
	
				row += '<input type="hidden" name="market20_' + data.id + '" id="market20_' + data.id + '" value=""/>';
	
				row += '<input type="hidden" name="market21_' + data.id + '" id="market21_' + data.id + '" value=""/>';
	
				row += '<input type="hidden" name="market22_' + data.id + '" id="market22_' + data.id + '" value=""/>';*/
	
				
	
	
	
				row += '<div id="ss_enabled' + data.id + '" style=" " class="tl_rw Light12 White Bold match_winner">';
	
				
	
				var id_1 = '1'+data.id;
				
				if(MID_ARRAY.indexOf(id_1)<0){
					flag_select = 0;
				} else {
					flag_select = 1;
					flag_class = 'set_background';
				}
				
				row += '<div class="sm_cl">';
	
				row += '<div class="rt_tab linght36 "><a class="btn_min '+ flag_class +'" href="javascript:void(0);" id="div_'+ id_1 +'"><span id="1x2_val_1' + data.id + '" class="rt" onclick="javascript:do_select('+ id_1 +');">' + data.mw1 + '</span><span id="team_'+ id_1 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_1 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_1 +'" style="display:none;">1</span><span id="span_'+ id_1 +'" class="new" style="display:none;">' + data.mw1 + '</span><span class="rt" id="od_'+ id_1 +'" style="display:none;">' + data.mw1 + '</span><input type="hidden" id="is_selected_'+ id_1 +'" value="'+ flag_select +'" /><input type="hidden" name="event_id_'+ id_1 +'" id="event_id_'+ id_1 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_1 +'" id="market_id_'+ id_1 +'" value="'+ id_1 +'" /><input type="hidden" name="market_code_'+ id_1 +'" id="market_code_'+ id_1 +'" value="1x2" /><input type="hidden" name="extra_'+ id_1 +'" id="extra_'+ id_1 +'" value="" /><span id="1x2_val_1_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += '</div>';
	
				
	
				var id_2 = '2'+data.id;
	
				row += '<div class="sm_cl">';
	
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_2 +'"><span id="1x2_val_x' + data.id + '" class="rt" onclick="javascript:do_select('+ id_2 +');">' + data.mwx + '</span><span id="team_'+ id_2 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_2 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_2 +'" style="display:none;">X</span><span id="span_'+ id_2 +'" class="new" style="display:none;">' + data.mwx + '</span><span class="rt" id="od_'+ id_2 +'" style="display:none;">' + data.mwx + '</span><input type="hidden" id="is_selected_'+ id_2 +'" value="0" /><input type="hidden" name="event_id_'+ id_2 +'" id="event_id_'+ id_2 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_2 +'" id="market_id_'+ id_2 +'" value="'+ id_2 +'" /><input type="hidden" name="market_code_'+ id_2 +'" id="market_code_'+ id_2 +'" value="1x2" /><input type="hidden" name="extra_'+ id_2 +'" id="extra_'+ id_2 +'" value="" /><span id="1x2_val_x_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += '</div>';
	
				
	
				var id_3 = '3'+data.id;
	
				row += '<div class="sm_cl">';
	
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_3 +'"><span id="1x2_val_2' + data.id + '" class="rt" onclick="javascript:do_select('+ id_3 +');">' + data.mw2 + '</span><span id="team_'+ id_3 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_3 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_3 +'" style="display:none;">2</span><span id="span_'+ id_3 +'" class="new" style="display:none;">' + data.mw2 + '</span><span class="rt" id="od_'+ id_3 +'" style="display:none;">' + data.mw2 + '</span><input type="hidden" id="is_selected_'+ id_3 +'" value="0" /><input type="hidden" name="event_id_'+ id_3 +'" id="event_id_'+ id_3 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_3 +'" id="market_id_'+ id_3 +'" value="'+ id_3 +'" /><input type="hidden" name="market_code_'+ id_3 +'" id="market_code_'+ id_3 +'" value="1x2" /><input type="hidden" name="extra_'+ id_3 +'" id="extra_'+ id_3 +'" value="" /><span id="1x2_val_2_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += '</div>';
	
				row += '</div>';
	
				row += '<div id="ss_enabled_ax2h1' + data.id + '" style=" " class="tl_rw Light12 White Bold m_t_2 match_winner_h1">';
	
				
	
				var id_4 = '4'+data.id;
	
				row += '<div class="sm_cl">';
	
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_4 +'"><span id="1x2h1_val_1' + data.id + '" class="rt" onclick="javascript:do_select('+ id_4 +');">' + data.mw1h + '</span><span id="team_'+ id_4 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_4 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_4 +'" style="display:none;">1</span><span id="span_'+ id_4 +'" class="new" style="display:none;">' + data.mw1h + '</span><span class="rt" id="od_'+ id_4 +'" style="display:none;">' + data.mw1h + '</span><input type="hidden" id="is_selected_'+ id_4 +'" value="0" /><input type="hidden" name="event_id_'+ id_4 +'" id="event_id_'+ id_4 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_4 +'" id="market_id_'+ id_4 +'" value="'+ id_4 +'" /><input type="hidden" name="market_code_'+ id_4 +'" id="market_code_'+ id_4 +'" value="1x2_H1" /><input type="hidden" name="extra_'+ id_4 +'" id="extra_'+ id_4 +'" value="" /><span id="1x2h1_val_1_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += '</div>';
	
				
	
				var id_5 = '5'+data.id;
	
				row += '<div class="sm_cl">';
	
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_5 +'"><span id="1x2h1_val_x' + data.id + '" class="rt" onclick="javascript:do_select('+ id_5 +');">' + data.mwxh + '</span><span id="team_'+ id_5 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_5 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_5 +'" style="display:none;">X</span><span id="span_'+ id_5 +'" class="new" style="display:none;">' + data.mwxh + '</span><span class="rt" id="od_'+ id_5 +'" style="display:none;">' + data.mwxh + '</span><input type="hidden" id="is_selected_'+ id_5 +'" value="0" /><input type="hidden" name="event_id_'+ id_5 +'" id="event_id_'+ id_5 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_5 +'" id="market_id_'+ id_5 +'" value="'+ id_5 +'" /><input type="hidden" name="market_code_'+ id_5 +'" id="market_code_'+ id_5 +'" value="1x2_H1" /><input type="hidden" name="extra_'+ id_5 +'" id="extra_'+ id_5 +'" value="" /><span id="1x2h1_val_x_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += '</div>';
	
				
	
				var id_6 = '6'+data.id;
	
				row += '<div class="sm_cl">';
	
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_6 +'"><span id="1x2h1_val_2' + data.id + '" class="rt" onclick="javascript:do_select('+ id_6 +');">' + data.mw2h + '</span><span id="team_'+ id_6 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_6 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_6 +'" style="display:none;">2</span><span id="span_'+ id_6 +'" class="new" style="display:none;">' + data.mw2h + '</span><span class="rt" id="od_'+ id_6 +'" style="display:none;">' + data.mw2h + '</span><input type="hidden" id="is_selected_'+ id_6 +'" value="0" /><input type="hidden" name="event_id_'+ id_6 +'" id="event_id_'+ id_6 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_6 +'" id="market_id_'+ id_6 +'" value="'+ id_6 +'" /><input type="hidden" name="market_code_'+ id_6 +'" id="market_code_'+ id_6 +'" value="1x2_H1" /><input type="hidden" name="extra_'+ id_6 +'" id="extra_'+ id_6 +'" value="" /><span id="1x2h1_val_2_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += '</div>';
	
				row += '</div>';
	
				row += '</div>';
	
	
	
				row += '<div class="rest_title2 m_l_10">';
	
				row += '<div class="Inner_cnt_hd rw">';
	
				row += '<div class="tl_rw Light12 White Bold Align_cent">';
	
				row += '<!--Next goal-->Rest of the match </div>';
	
				row += '<div class="tl_rw Light12 White Bold Align_cent">';
	
				row += '<div class="sm_cl">1</div>';
	
				row += '<div class="sm_cl">x</div>';
	
				row += '<div class="sm_cl">2</div>';
	
				row += '</div>';
	
				row += '</div>';
	
	
	
				row += '<div id="ss_enabled_res' + data.id + '" style=" " class="tl_rw Light12 White Bold">';
	
				
	
				var id_7 = '7'+data.id;
	
				row += '<div class="sm_cl">';
	
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_7 +'"><span id="res_val_1' + data.id + '" class="rt" onclick="javascript:do_select('+ id_7 +');">' + data.rm1 + '</span><span id="team_'+ id_7 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_7 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_7 +'" style="display:none;">1</span><span id="span_'+ id_7 +'" class="new" style="display:none;">' + data.rm1 + '</span><span class="rt" id="od_'+ id_7 +'" style="display:none;">' + data.rm1 + '</span><input type="hidden" id="is_selected_'+ id_7 +'" value="0" /><input type="hidden" name="event_id_'+ id_7 +'" id="event_id_'+ id_7 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_7 +'" id="market_id_'+ id_7 +'" value="'+ id_7 +'" /><input type="hidden" name="market_code_'+ id_7 +'" id="market_code_'+ id_7 +'" value="RES_1x2" /><input type="hidden" name="extra_'+ id_7 +'" id="extra_'+ id_7 +'" value="" /><span id="res_val_1_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += '</div>';
	
				
	
				var id_8 = '8'+data.id;
	
				row += '<div class="sm_cl">';
	
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_8 +'"><span id="res_val_x' + data.id + '" class="rt" onclick="javascript:do_select('+ id_8 +');">' + data.rmx + '</span><span id="team_'+ id_8 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_8 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_8 +'" style="display:none;">X</span><span id="span_'+ id_8 +'" class="new" style="display:none;">' + data.rmx + '</span><span class="rt" id="od_'+ id_8 +'" style="display:none;">' + data.rmx + '</span><input type="hidden" id="is_selected_'+ id_8 +'" value="0" /><input type="hidden" name="event_id_'+ id_8 +'" id="event_id_'+ id_8 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_8 +'" id="market_id_'+ id_8 +'" value="'+ id_8 +'" /><input type="hidden" name="market_code_'+ id_8 +'" id="market_code_'+ id_8 +'" value="RES_1x2" /><input type="hidden" name="extra_'+ id_8 +'" id="extra_'+ id_8 +'" value="" /><span id="res_val_x_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += '</div>';
	
				
	
				var id_9 = '9'+data.id;
	
				row += '<div class="sm_cl">';
	
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_9 +'"><span id="res_val_2' + data.id + '" class="rt" onclick="javascript:do_select('+ id_9 +');">' + data.rm2 + '</span><span id="team_'+ id_9 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_9 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_9 +'" style="display:none;">2</span><span id="span_'+ id_9 +'" class="new" style="display:none;">' + data.rm2 + '</span><span class="rt" id="od_'+ id_9 +'" style="display:none;">' + data.rm2 + '</span><input type="hidden" id="is_selected_'+ id_9 +'" value="0" /><input type="hidden" name="event_id_'+ id_9 +'" id="event_id_'+ id_9 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_9 +'" id="market_id_'+ id_9 +'" value="'+ id_9 +'" /><input type="hidden" name="market_code_'+ id_9 +'" id="market_code_'+ id_9 +'" value="RES_1x2" /><input type="hidden" name="extra_'+ id_9 +'" id="extra_'+ id_9 +'" value="" /><span id="res_val_2_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += '</div>';
	
				row += '</div>';
	
	
	
				row += '<div id="ss_enabled_resh1' + data.id + '" style=" " class="tl_rw Light12 White Bold m_t_2">';
	
				
	
				var id_10 = '10'+data.id;
	
				row += '<div class="sm_cl">';
	
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_10 +'"><span id="resh1_val_1' + data.id + '" class="rt" onclick="javascript:do_select('+ id_10 +');">' + data.rm1h + '</span><span id="team_'+ id_10 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_10 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_10 +'" style="display:none;">1</span><span id="span_'+ id_10 +'" class="new" style="display:none;">' + data.rm1h + '</span><span class="rt" id="od_'+ id_10 +'" style="display:none;">' + data.rm1h + '</span><input type="hidden" id="is_selected_'+ id_10 +'" value="0" /><input type="hidden" name="event_id_'+ id_10 +'" id="event_id_'+ id_10 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_10 +'" id="market_id_'+ id_10 +'" value="'+ id_10 +'" /><input type="hidden" name="market_code_'+ id_10 +'" id="market_code_'+ id_10 +'" value="RES_1x2_H" /><input type="hidden" name="extra_'+ id_10 +'" id="extra_'+ id_10 +'" value="" /><span id="resh1_val_1_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += '</div>';
	
				
	
				var id_11 = '11'+data.id;
	
				row += '<div class="sm_cl">';
	
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_11 +'"><span id="resh1_val_x' + data.id + '" class="rt" onclick="javascript:do_select('+ id_11 +');">' + data.rmxh + '</span><span id="team_'+ id_11 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_11 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_11 +'" style="display:none;">X</span><span id="span_'+ id_11 +'" class="new" style="display:none;">' + data.rmxh + '</span><span class="rt" id="od_'+ id_11 +'" style="display:none;">' + data.rmxh + '</span><input type="hidden" id="is_selected_'+ id_11 +'" value="0" /><input type="hidden" name="event_id_'+ id_11 +'" id="event_id_'+ id_11 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_11 +'" id="market_id_'+ id_11 +'" value="'+ id_11 +'" /><input type="hidden" name="market_code_'+ id_11 +'" id="market_code_'+ id_11 +'" value="RES_1x2_H" /><input type="hidden" name="extra_'+ id_11 +'" id="extra_'+ id_11 +'" value="" /><span id="resh1_val_x_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += '</div>';
	
				
	
				var id_12 = '12'+data.id;
	
				row += ' <div class="sm_cl">';
	
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_12 +'"><span id="resh1_val_2' + data.id + '" class="rt" onclick="javascript:do_select('+ id_12 +');">' + data.rm2h + '</span><span id="team_'+ id_12 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_12 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_12 +'" style="display:none;">2</span><span id="span_'+ id_12 +'" class="new" style="display:none;">' + data.rm2h + '</span><span class="rt" id="od_'+ id_12 +'" style="display:none;">' + data.rm2h + '</span><input type="hidden" id="is_selected_'+ id_12 +'" value="0" /><input type="hidden" name="event_id_'+ id_12 +'" id="event_id_'+ id_12 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_12 +'" id="market_id_'+ id_12 +'" value="'+ id_12 +'" /><input type="hidden" name="market_code_'+ id_12 +'" id="market_code_'+ id_12 +'" value="RES_1x2_H" /><input type="hidden" name="extra_'+ id_12 +'" id="extra_'+ id_12 +'" value="" /><span id="resh1_val_2_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += '</div>';
	
				row += '</div>';
	
				row += '</div>';
	
	
	
				row += '<div class="rest_title2 m_l_10">';
	
				row += '<div class="Inner_cnt_hd rw">';
	
				row += '<div class="tl_rw Light12 White Bold Align_cent">';
	
				row += '<!--Match winner-->Next Goal </div>';
	
				row += '<div class="tl_rw Light12 White Bold Align_cent">';
	
				row += '<div class="sm_cl">1</div>';
	
				row += '<div class="sm_cl">x</div>';
	
				row += '<div class="sm_cl">2</div>';
	
				row += '</div>';
	
				row += '</div>';
	
	
	
				row += '<div id="ss_enabled_s1g' + data.id + '" style=" " class="tl_rw Light12 White Bold next_goal">';
	
				
	
				var id_13 = '13'+data.id;
	
				row += '<div class="sm_cl">';
	
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_13 +'"><span id="s1g_val_1' + data.id + '" class="rt" onclick="javascript:do_select('+ id_13 +');">' + data.ng1 + '</span><span id="team_'+ id_13 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_13 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_13 +'" style="display:none;">1</span><span id="span_'+ id_13 +'" class="new" style="display:none;">' + data.ng1 + '</span><span class="rt" id="od_'+ id_13 +'" style="display:none;">' + data.ng1 + '</span><input type="hidden" id="is_selected_'+ id_13 +'" value="0" /><input type="hidden" name="event_id_'+ id_13 +'" id="event_id_'+ id_13 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_13 +'" id="market_id_'+ id_13 +'" value="'+ id_13 +'" /><input type="hidden" name="market_code_'+ id_13 +'" id="market_code_'+ id_13 +'" value="S1G" /><input type="hidden" name="extra_'+ id_13 +'" id="extra_'+ id_13 +'" value="" /><span id="s1g_val_1_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += '</div>';
	
				
	
				var id_14 = '14'+data.id;
	
				row += '<div class="sm_cl">';
	
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_14 +'"><span id="s1g_val_x' + data.id + '" class="rt" onclick="javascript:do_select('+ id_14 +');">' + data.ngx + '</span><span id="team_'+ id_14 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_14 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_14 +'" style="display:none;">X</span><span id="span_'+ id_14 +'" class="new" style="display:none;">' + data.ngx + '</span><span class="rt" id="od_'+ id_14 +'" style="display:none;">' + data.ngx + '</span><input type="hidden" id="is_selected_'+ id_14 +'" value="0" /><input type="hidden" name="event_id_'+ id_14 +'" id="event_id_'+ id_14 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_14 +'" id="market_id_'+ id_14 +'" value="'+ id_14 +'" /><input type="hidden" name="market_code_'+ id_14 +'" id="market_code_'+ id_14 +'" value="S1G" /><input type="hidden" name="extra_'+ id_14 +'" id="extra_'+ id_14 +'" value="" /><span id="s1g_val_x_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += '</div>';
	
				
	
				var id_15 = '15'+data.id;
	
				row += '<div class="sm_cl">';
	
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_15 +'"><span id="s1g_val_2' + data.id + '" class="rt" onclick="javascript:do_select('+ id_15 +');">' + data.ng2 + '</span><span id="team_'+ id_15 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_15 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_15 +'" style="display:none;">2</span><span id="span_'+ id_15 +'" class="new" style="display:none;">' + data.ng2 + '</span><span class="rt" id="od_'+ id_15 +'" style="display:none;">' + data.ng2 + '</span><input type="hidden" id="is_selected_'+ id_15 +'" value="0" /><input type="hidden" name="event_id_'+ id_15 +'" id="event_id_'+ id_15 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_15 +'" id="market_id_'+ id_15 +'" value="'+ id_15 +'" /><input type="hidden" name="market_code_'+ id_15 +'" id="market_code_'+ id_15 +'" value="S1G" /><input type="hidden" name="extra_'+ id_15 +'" id="extra_'+ id_15 +'" value="" /><span id="s1g_val_2_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += '</div>';
	
				row += '</div>';
	
				row += ' <div id="ss_enabled_s1gh1' + data.id + '" style=" " class="tl_rw Light12 White Bold m_t_2 next_goal_h1">';
	
				
	
				var id_16 = '16'+data.id;
	
				row += '<div class="sm_cl">';
	
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_16 +'"><span id="s1gh1_val_1' + data.id + '" class="rt" onclick="javascript:do_select('+ id_16 +');">' + data.ng1h + '</span><span id="team_'+ id_16 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_16 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_16 +'" style="display:none;">1</span><span id="span_'+ id_16 +'" class="new" style="display:none;">' + data.ng1h + '</span><span class="rt" id="od_'+ id_16 +'" style="display:none;">' + data.ng1h + '</span><input type="hidden" id="is_selected_'+ id_16 +'" value="0" /><input type="hidden" name="event_id_'+ id_16 +'" id="event_id_'+ id_16 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_16 +'" id="market_id_'+ id_16 +'" value="'+ id_16 +'" /><input type="hidden" name="market_code_'+ id_16 +'" id="market_code_'+ id_16 +'" value="S1G_H1" /><input type="hidden" name="extra_'+ id_16 +'" id="extra_'+ id_16 +'" value="" /><span id="s1gh1_val_1_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += ' </div>';
	
				
	
				var id_17 = '17'+data.id;
	
				row += '<div class="sm_cl">';
	
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_17 +'"><span id="s1gh1_val_x' + data.id + '" class="rt" onclick="javascript:do_select('+ id_17 +');">' + data.ngxh + '</span><span id="team_'+ id_17 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_17 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_17 +'" style="display:none;">X</span><span id="span_'+ id_17 +'" class="new" style="display:none;">' + data.ngxh + '</span><span class="rt" id="od_'+ id_17 +'" style="display:none;">' + data.ngxh + '</span><input type="hidden" id="is_selected_'+ id_17 +'" value="0" /><input type="hidden" name="event_id_'+ id_17 +'" id="event_id_'+ id_17 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_17 +'" id="market_id_'+ id_17 +'" value="'+ id_17 +'" /><input type="hidden" name="market_code_'+ id_17 +'" id="market_code_'+ id_17 +'" value="S1G_H1" /><input type="hidden" name="extra_'+ id_17 +'" id="extra_'+ id_17 +'" value="" /><span id="s1gh1_val_x_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += '</div>';
	
				
	
				var id_18 = '18'+data.id;
	
				row += '<div class="sm_cl">';
	
				row += ' <div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_18 +'"><span id="s1gh1_val_2' + data.id + '" class="rt" onclick="javascript:do_select('+ id_18 +');">' + data.ng2h + '</span><span id="team_'+ id_18 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_18 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_18 +'" style="display:none;">2</span><span id="span_'+ id_18 +'" class="new" style="display:none;">' + data.ng2h + '</span><span class="rt" id="od_'+ id_18 +'" style="display:none;">' + data.ng2h + '</span><input type="hidden" id="is_selected_'+ id_18 +'" value="0" /><input type="hidden" name="event_id_'+ id_18 +'" id="event_id_'+ id_18 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_18 +'" id="market_id_'+ id_18 +'" value="'+ id_18 +'" /><input type="hidden" name="market_code_'+ id_18 +'" id="market_code_'+ id_18 +'" value="S1G_H1" /><input type="hidden" name="extra_'+ id_18 +'" id="extra_'+ id_18 +'" value="" /><span id="s1gh1_val_2_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += ' </div>';
	
				row += '</div>';
	
				row += '</div>';
	
	
	
	
	
				row += '<div id="over_under_h' + data.id + '" class="ratecol2 Align_cent Light12 Bold White">' + data.to + '</div>';
	
	
	
				row += '<div id="over_under_hn' + data.id + '" class="ratecol2 Align_cent Light12 Bold White line2">' + data.toh + '</div>';
	
	
	
				row += '<div class="totl_over2">';
	
				row += '<div class="Inner_cnt_hd rw">';
	
				row += '<div class="tl_rw Light12 White Bold Align_cent">Total </div>';
	
				row += '<div class="tl_rw Light12 White Bold Align_cent">';
	
				row += '<div class="sm_cl">Under</div>';
	
	
	
				row += '<div class="sm_cl">Over</div>';
	
				row += ' </div>';
	
				row += ' </div>';
	
	
	
	
	
				row += '<div id="ss_enabled_ov' + data.id + '" style=" " class="tl_rw rw Light12 White Bold">';
	
				
	
				var id_19 = '19'+data.id;
	
				row += ' <div class="sm_cl">';
	
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_19 +'"><span id="over_under_o' + data.id + '" class="rt" onclick="javascript:do_select('+ id_19 +');">' + data.to0 + '</span><span id="team_'+ id_19 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_19 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_19 +'" style="display:none;">O</span><span id="span_'+ id_19 +'" class="new" style="display:none;">' + data.to0 + '</span><span class="rt" id="od_'+ id_19 +'" style="display:none;">' + data.to0 + '</span><input type="hidden" id="is_selected_'+ id_19 +'" value="0" /><input type="hidden" name="event_id_'+ id_19 +'" id="event_id_'+ id_19 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_19 +'" id="market_id_'+ id_19 +'" value="'+ id_19 +'" /><input type="hidden" name="market_code_'+ id_19 +'" id="market_code_'+ id_19 +'" value="OU" /><input type="hidden" name="extra_'+ id_19 +'" id="extra_'+ id_19 +'" value="2.5" /><span id="over_under_o_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += '</div>';
	
				
	
				var id_20 = '20'+data.id;
	
				row += '<div class="sm_cl">';
	
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_20 +'"><span id="over_under_u' + data.id + '" class="rt" onclick="javascript:do_select('+ id_20 +');">' + data.to1 + '</span><span id="team_'+ id_20 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_20 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_20 +'" style="display:none;">U</span><span id="span_'+ id_20 +'" class="new" style="display:none;">' + data.to1 + '</span><span class="rt" id="od_'+ id_20 +'" style="display:none;">' + data.to1 + '</span><input type="hidden" id="is_selected_'+ id_20 +'" value="0" /><input type="hidden" name="event_id_'+ id_20 +'" id="event_id_'+ id_20 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_20 +'" id="market_id_'+ id_20 +'" value="'+ id_20 +'" /><input type="hidden" name="market_code_'+ id_20 +'" id="market_code_'+ id_20 +'" value="OU" /><input type="hidden" name="extra_'+ id_20 +'" id="extra_'+ id_20 +'" value="2.5" /><span id="over_under_u_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += ' </div>';
	
				row += '</div>';
	
	
	
				row += ' <div id="ss_enabled_ovh1' + data.id + '" style=" " class="tl_rw rw Light12 White Bold m_t_2">';
	
				
	
				var id_21 = '21'+data.id;
	
				row += ' <div class="sm_cl">';
	
				row += ' <div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_21 +'"><span id="over_under_oh1' + data.id + '" class="rt" onclick="javascript:do_select('+ id_21 +');">' + data.to0h + '</span><span id="team_'+ id_21 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_21 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_21 +'" style="display:none;">O</span><span id="span_'+ id_21 +'" class="new" style="display:none;">' + data.to0h + '</span><span class="rt" id="od_'+ id_21 +'" style="display:none;">' + data.to0h + '</span><input type="hidden" id="is_selected_'+ id_21 +'" value="0" /><input type="hidden" name="event_id_'+ id_21 +'" id="event_id_'+ id_21 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_21 +'" id="market_id_'+ id_21 +'" value="'+ id_21 +'" /><input type="hidden" name="market_code_'+ id_21 +'" id="market_code_'+ id_21 +'" value="OU_H1" /><input type="hidden" name="extra_'+ id_21 +'" id="extra_'+ id_21 +'" value="0.5" /><span id="over_under_oh1_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += ' </div>';
	
				
	
				var id_22 = '22'+data.id;
	
				row += ' <div class="sm_cl">';
	
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_22 +'"><span id="over_under_uh1' + data.id + '" class="rt" onclick="javascript:do_select('+ id_22 +');">' + data.to1h + '</span><span id="team_'+ id_22 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_22 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_22 +'" style="display:none;">U</span><span id="span_'+ id_22 +'" class="new" style="display:none;">' + data.to1h + '</span><span class="rt" id="od_'+ id_22 +'" style="display:none;">' + data.to1h + '</span><input type="hidden" id="is_selected_'+ id_22 +'" value="0" /><input type="hidden" name="event_id_'+ id_22 +'" id="event_id_'+ id_22 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_22 +'" id="market_id_'+ id_22 +'" value="'+ id_22 +'" /><input type="hidden" name="market_code_'+ id_22 +'" id="market_code_'+ id_22 +'" value="OU_H1" /><input type="hidden" name="extra_'+ id_22 +'" id="extra_'+ id_22 +'" value="0.5" /><span id="over_under_uh1_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
	
				row += '</div>';
	
				row += '</div>';
	
				row += '</div>';
	
	
	
				row += '<div class="lastcol">';
	
				row += '<div class="btn"><a class="btn_min" href="javascript:void(0)"><span class="l_prc " id="check1_' + data.id + '" onClick="show_more('+data.id+');">+20</span></a></div>';
	
				row += '<div class="btn m_t_2" id="S_'+ data.id +'"><a id="check_54" class="btn_min2" href="javascript:void(0);"><span class="l_prc ballShow" id="ballShow' + data.id + '" onClick="goal_score(this.id);">S</span></a></div>';
	
				row += ' </div>';
				
				
				
				row += '<div class="overBall"><div class="ballBox"><span><table><tr><td><img src="images/ball1.png" alt="img"></td><td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; G O O O O A A A L <font color="#01FF00"><b id="TEM1_'+ data.id +'" style="display:none;">'+data.t1+'</b><b id="TEM2_'+ data.id +'" style="display:none;">'+data.t2+'</b></font> score.</td></tr></table></span></div></div>';
	
				row += ' </div>';
	
				row += ' </div>';
	
				
				
				////////ADD +20
				row += '<div class="grid_3_iner3 new_sec_grd" id="toggle1_'+data.id+'" style="display:none;">';	
				
				row += '<div class="matchwrap"><div class="md_game_b"><div class="cent">';
				
				row += '<div class="n_col_lf">';
				
					
				row += '<div class="col"><div class="m_title Light13 Bold White">Double Chance</div><div class="rest_title2"><div class="Inner_cnt_hd rw"><div class="tl_rw Light12 White Bold Align_cent"><div class="sm_cl">1X</div><div class="sm_cl">X2</div><div class="sm_cl">12</div></div></div><div class="tl_rw Light12 White Bold">';
				
				var id_23 = '23'+data.id;
				
				row += '<div class="sm_cl">';
								
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_23 +'"><span id="double_chance_1x' + data.id + '" class="rt" onclick="javascript:do_select('+ id_23 +');">' + data.dc1x + '</span><span id="team_'+ id_23 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_23 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_23 +'" style="display:none;">1X</span><span id="span_'+ id_23 +'" class="new" style="display:none;">' + data.dc1x + '</span><span class="rt" id="od_'+ id_23 +'" style="display:none;">' + data.dc1x + '</span><input type="hidden" id="is_selected_'+ id_23 +'" value="0" /><input type="hidden" name="event_id_'+ id_23 +'" id="event_id_'+ id_23 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_23 +'" id="market_id_'+ id_23 +'" value="'+ id_23 +'" /><input type="hidden" name="market_code_'+ id_23 +'" id="market_code_'+ id_23 +'" value="DC" /><input type="hidden" name="extra_'+ id_23 +'" id="extra_'+ id_23 +'" value="" /><span id="double_chance_1x_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				var id_24 = '24'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_24 +'"><span id="double_chance_x2' + data.id + '" class="rt" onclick="javascript:do_select('+ id_24 +');">' + data.dcx2 + '</span><span id="team_'+ id_24 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_24 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_24 +'" style="display:none;">X2</span><span id="span_'+ id_24 +'" class="new" style="display:none;">' + data.dcx2 + '</span><span class="rt" id="od_'+ id_24 +'" style="display:none;">' + data.dcx2 + '</span><input type="hidden" id="is_selected_'+ id_24 +'" value="0" /><input type="hidden" name="event_id_'+ id_24 +'" id="event_id_'+ id_24 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_24 +'" id="market_id_'+ id_24 +'" value="'+ id_24 +'" /><input type="hidden" name="market_code_'+ id_24 +'" id="market_code_'+ id_24 +'" value="DC" /><input type="hidden" name="extra_'+ id_24 +'" id="extra_'+ id_24 +'" value="" /><span id="double_chance_x2_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				var id_25 = '25'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_25 +'"><span id="double_chance_12' + data.id + '" class="rt" onclick="javascript:do_select('+ id_25 +');">' + data.dc12 + '</span><span id="team_'+ id_25 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_25 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_25 +'" style="display:none;">12</span><span id="span_'+ id_25 +'" class="new" style="display:none;">' + data.dc12 + '</span><span class="rt" id="od_'+ id_25 +'" style="display:none;">' + data.dc12 + '</span><input type="hidden" id="is_selected_'+ id_25 +'" value="0" /><input type="hidden" name="event_id_'+ id_25 +'" id="event_id_'+ id_25 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_25 +'" id="market_id_'+ id_25 +'" value="'+ id_25 +'" /><input type="hidden" name="market_code_'+ id_25 +'" id="market_code_'+ id_25 +'" value="DC" /><input type="hidden" name="extra_'+ id_25 +'" id="extra_'+ id_25 +'" value="" /><span id="double_chance_12_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				row += '</div></div></div>';	
				
				
				
				
				
				//BTS
				var mrk_flag = '';
				if(data.btsy=='' || data.btsn==''){
					mrk_flag = 'none';
				}else{
					mrk_flag = 'block';
				}
				row += '<div class="col" style="display:'+ mrk_flag +'"><div class="m_title Light13 Bold White">Both Teams To Score</div><div class="rest_title2"><div class="Inner_cnt_hd rw"><div class="tl_rw Light12 White Bold Align_cent"><div class="sm_cl">&nbsp;</div><div class="sm_cl">Yes</div><div class="sm_cl">No</div></div></div><div class="tl_rw Light12 White Bold">';
				
				
				
				row += '<div class="sm_cl">';
								
				row += '<div class="rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">&nbsp;</span></a></div>';
				
				row += '</div>';
				
				var id_26 = '26'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_26 +'"><span id="bts_yes' + data.id + '" class="rt" onclick="javascript:do_select('+ id_26 +');">' + data.btsy + '</span><span id="team_'+ id_26 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_26 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_26 +'" style="display:none;">Yes</span><span id="span_'+ id_26 +'" class="new" style="display:none;">' + data.btsy + '</span><span class="rt" id="od_'+ id_26 +'" style="display:none;">' + data.btsy + '</span><input type="hidden" id="is_selected_'+ id_26 +'" value="0" /><input type="hidden" name="event_id_'+ id_26 +'" id="event_id_'+ id_26 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_26 +'" id="market_id_'+ id_26 +'" value="'+ id_26 +'" /><input type="hidden" name="market_code_'+ id_26 +'" id="market_code_'+ id_26 +'" value="BTS" /><input type="hidden" name="extra_'+ id_26 +'" id="extra_'+ id_26 +'" value="" /><span id="bts_yes_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				var id_27 = '27'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_27 +'"><span id="bts_no' + data.id + '" class="rt" onclick="javascript:do_select('+ id_27 +');">' + data.btsn + '</span><span id="team_'+ id_27 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_27 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_27 +'" style="display:none;">No</span><span id="span_'+ id_27 +'" class="new" style="display:none;">' + data.btsn + '</span><span class="rt" id="od_'+ id_27 +'" style="display:none;">' + data.btsn + '</span><input type="hidden" id="is_selected_'+ id_27 +'" value="0" /><input type="hidden" name="event_id_'+ id_27 +'" id="event_id_'+ id_27 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_27 +'" id="market_id_'+ id_27 +'" value="'+ id_27 +'" /><input type="hidden" name="market_code_'+ id_27 +'" id="market_code_'+ id_27 +'" value="BTS" /><input type="hidden" name="extra_'+ id_27 +'" id="extra_'+ id_27 +'" value="" /><span id="bts_no_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				row += '</div></div></div>';
				
				
				
				//BTS_H1
				var mrk_flag = '';
				if(data.btsyh=='' || data.btsnh==''){
					mrk_flag = 'none';
				}else{
					mrk_flag = 'block';
				}
				row += '<div class="col" style="display:'+ mrk_flag +'"><div class="m_title Light13 Bold White">Both Teams To Score (1st Half)</div><div class="rest_title2"><div class="Inner_cnt_hd rw"><div class="tl_rw Light12 White Bold Align_cent"><div class="sm_cl">&nbsp;</div><div class="sm_cl">Yes</div><div class="sm_cl">No</div></div></div><div class="tl_rw Light12 White Bold">';
				
				
				
				row += '<div class="sm_cl">';
								
				row += '<div class="rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">&nbsp;</span></a></div>';
				
				row += '</div>';
				
				var id_28 = '28'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_28 +'"><span id="bts_yesh1' + data.id + '" class="rt" onclick="javascript:do_select('+ id_28 +');">' + data.btsyh + '</span><span id="team_'+ id_28 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_28 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_28 +'" style="display:none;">Yes</span><span id="span_'+ id_28 +'" class="new" style="display:none;">' + data.btsyh + '</span><span class="rt" id="od_'+ id_28 +'" style="display:none;">' + data.btsyh + '</span><input type="hidden" id="is_selected_'+ id_28 +'" value="0" /><input type="hidden" name="event_id_'+ id_28 +'" id="event_id_'+ id_28 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_28 +'" id="market_id_'+ id_28 +'" value="'+ id_28 +'" /><input type="hidden" name="market_code_'+ id_28 +'" id="market_code_'+ id_28 +'" value="BTS_H1" /><input type="hidden" name="extra_'+ id_28 +'" id="extra_'+ id_28 +'" value="" /><span id="bts_yesh1_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				var id_29 = '29'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_29 +'"><span id="bts_noh1' + data.id + '" class="rt" onclick="javascript:do_select('+ id_29 +');">' + data.btsnh + '</span><span id="team_'+ id_29 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_29 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_29 +'" style="display:none;">No</span><span id="span_'+ id_29 +'" class="new" style="display:none;">' + data.btsnh + '</span><span class="rt" id="od_'+ id_29 +'" style="display:none;">' + data.btsnh + '</span><input type="hidden" id="is_selected_'+ id_29 +'" value="0" /><input type="hidden" name="event_id_'+ id_29 +'" id="event_id_'+ id_29 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_29 +'" id="market_id_'+ id_29 +'" value="'+ id_29 +'" /><input type="hidden" name="market_code_'+ id_29 +'" id="market_code_'+ id_29 +'" value="BTS_H1" /><input type="hidden" name="extra_'+ id_29 +'" id="extra_'+ id_29 +'" value="" /><span id="bts_noh1_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				row += '</div></div></div>';
				
				
				
				
				
				
				
				
				
				
				
				
				
				
						
				row += '</div>';
				
				row += '<div class="n_col_rg">';
				
				
				
				
				
				
				//OU 0.5
				var ou_flag = '';
				if(data.ou_o05=='' || data.ou_u05==''){
					ou_flag = 'none';
				}else{
					ou_flag = 'block';
				}
				row += '<div class="col" style="display:'+ ou_flag +'"><div class="m_title Light13 Bold White">Over/Under</div><div class="rest_title2"><div class="Inner_cnt_hd rw"><div class="tl_rw Light12 White Bold Align_cent"><div class="sm_cl">G</div><div class="sm_cl"><img src="images/ic_17.png" class="arw_t_ic" alt="img"></div><div class="sm_cl"><img src="images/ic_18.png" class="arw_t_ic" alt="img"></div></div></div><div class="tl_rw Light12 White Bold">';
				
				
				
				row += '<div class="sm_cl">';
								
				row += '<div class="rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">0.5</span></a></div>';
				
				row += '</div>';
				
				var id_30 = '30'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_30 +'"><span id="ou_o05' + data.id + '" class="rt" onclick="javascript:do_select('+ id_30 +');">' + data.ou_o05 + '</span><span id="team_'+ id_30 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_30 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_30 +'" style="display:none;">O</span><span id="span_'+ id_30 +'" class="new" style="display:none;">' + data.ou_o05 + '</span><span class="rt" id="od_'+ id_30 +'" style="display:none;">' + data.ou_o05 + '</span><input type="hidden" id="is_selected_'+ id_30 +'" value="0" /><input type="hidden" name="event_id_'+ id_30 +'" id="event_id_'+ id_30 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_30 +'" id="market_id_'+ id_30 +'" value="'+ id_30 +'" /><input type="hidden" name="market_code_'+ id_30 +'" id="market_code_'+ id_30 +'" value="OU" /><input type="hidden" name="extra_'+ id_30 +'" id="extra_'+ id_30 +'" value="0.5" /><span id="ou_o05_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				var id_31 = '31'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_31 +'"><span id="ou_u05' + data.id + '" class="rt" onclick="javascript:do_select('+ id_31 +');">' + data.ou_u05 + '</span><span id="team_'+ id_31 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_31 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_31 +'" style="display:none;">U</span><span id="span_'+ id_31 +'" class="new" style="display:none;">' + data.ou_u05 + '</span><span class="rt" id="od_'+ id_31 +'" style="display:none;">' + data.ou_u05 + '</span><input type="hidden" id="is_selected_'+ id_31 +'" value="0" /><input type="hidden" name="event_id_'+ id_31 +'" id="event_id_'+ id_31 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_31 +'" id="market_id_'+ id_31 +'" value="'+ id_31 +'" /><input type="hidden" name="market_code_'+ id_31 +'" id="market_code_'+ id_31 +'" value="OU" /><input type="hidden" name="extra_'+ id_31 +'" id="extra_'+ id_31 +'" value="0.5" /><span id="ou_u05_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				row += '</div></div></div>';
				
				
				
				//OU 1.5
				var ou_flag = '';
				if(data.ou_o15=='' || data.ou_u15==''){
					ou_flag = 'none';
				}else{
					ou_flag = 'block';
				}
				row += '<div class="col" style="display:'+ ou_flag +'"><div class="m_title Light13 Bold White">Over/Under</div><div class="rest_title2"><div class="Inner_cnt_hd rw"><div class="tl_rw Light12 White Bold Align_cent"><div class="sm_cl">G</div><div class="sm_cl"><img src="images/ic_17.png" class="arw_t_ic" alt="img"></div><div class="sm_cl"><img src="images/ic_18.png" class="arw_t_ic" alt="img"></div></div></div><div class="tl_rw Light12 White Bold">';
				
				
				
				row += '<div class="sm_cl">';
								
				row += '<div class="rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">1.5</span></a></div>';
				
				row += '</div>';
				
				var id_32 = '32'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_32 +'"><span id="ou_o15' + data.id + '" class="rt" onclick="javascript:do_select('+ id_32 +');">' + data.ou_o15 + '</span><span id="team_'+ id_32 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_32 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_32 +'" style="display:none;">O</span><span id="span_'+ id_32 +'" class="new" style="display:none;">' + data.ou_o15 + '</span><span class="rt" id="od_'+ id_32 +'" style="display:none;">' + data.ou_o15 + '</span><input type="hidden" id="is_selected_'+ id_32 +'" value="0" /><input type="hidden" name="event_id_'+ id_32 +'" id="event_id_'+ id_32 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_32 +'" id="market_id_'+ id_32 +'" value="'+ id_32 +'" /><input type="hidden" name="market_code_'+ id_32 +'" id="market_code_'+ id_32 +'" value="OU" /><input type="hidden" name="extra_'+ id_32 +'" id="extra_'+ id_32 +'" value="1.5" /><span id="ou_o15_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				var id_33 = '33'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_33 +'"><span id="ou_u15' + data.id + '" class="rt" onclick="javascript:do_select('+ id_33 +');">' + data.ou_u15 + '</span><span id="team_'+ id_33 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_33 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_33 +'" style="display:none;">U</span><span id="span_'+ id_33 +'" class="new" style="display:none;">' + data.ou_u15 + '</span><span class="rt" id="od_'+ id_33 +'" style="display:none;">' + data.ou_u15 + '</span><input type="hidden" id="is_selected_'+ id_33 +'" value="0" /><input type="hidden" name="event_id_'+ id_33 +'" id="event_id_'+ id_33 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_33 +'" id="market_id_'+ id_33 +'" value="'+ id_33 +'" /><input type="hidden" name="market_code_'+ id_33 +'" id="market_code_'+ id_33 +'" value="OU" /><input type="hidden" name="extra_'+ id_33 +'" id="extra_'+ id_33 +'" value="1.5" /><span id="ou_u15_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				row += '</div></div></div>';
				
				
				
				
				//OU 2.5
				var ou_flag = '';
				if(data.ou_o25=='' || data.ou_u25==''){
					ou_flag = 'none';
				}else{
					ou_flag = 'block';
				}
				row += '<div class="col" style="display:'+ ou_flag +'"><div class="m_title Light13 Bold White">Over/Under</div><div class="rest_title2"><div class="Inner_cnt_hd rw"><div class="tl_rw Light12 White Bold Align_cent"><div class="sm_cl">G</div><div class="sm_cl"><img src="images/ic_17.png" class="arw_t_ic" alt="img"></div><div class="sm_cl"><img src="images/ic_18.png" class="arw_t_ic" alt="img"></div></div></div><div class="tl_rw Light12 White Bold">';
				
				
				
				row += '<div class="sm_cl">';
								
				row += '<div class="rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">2.5</span></a></div>';
				
				row += '</div>';
				
				var id_34 = '34'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_34 +'"><span id="ou_o25' + data.id + '" class="rt" onclick="javascript:do_select('+ id_34 +');">' + data.ou_o25 + '</span><span id="team_'+ id_34 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_34 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_34 +'" style="display:none;">O</span><span id="span_'+ id_34 +'" class="new" style="display:none;">' + data.ou_o25 + '</span><span class="rt" id="od_'+ id_34 +'" style="display:none;">' + data.ou_o25 + '</span><input type="hidden" id="is_selected_'+ id_34 +'" value="0" /><input type="hidden" name="event_id_'+ id_34 +'" id="event_id_'+ id_34 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_34 +'" id="market_id_'+ id_34 +'" value="'+ id_34 +'" /><input type="hidden" name="market_code_'+ id_34 +'" id="market_code_'+ id_34 +'" value="OU" /><input type="hidden" name="extra_'+ id_34 +'" id="extra_'+ id_34 +'" value="2.5" /><span id="ou_o25_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				var id_35 = '35'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_35 +'"><span id="ou_u25' + data.id + '" class="rt" onclick="javascript:do_select('+ id_35 +');">' + data.ou_u25 + '</span><span id="team_'+ id_35 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_35 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_35 +'" style="display:none;">U</span><span id="span_'+ id_35 +'" class="new" style="display:none;">' + data.ou_u25 + '</span><span class="rt" id="od_'+ id_35 +'" style="display:none;">' + data.ou_u25 + '</span><input type="hidden" id="is_selected_'+ id_35 +'" value="0" /><input type="hidden" name="event_id_'+ id_35 +'" id="event_id_'+ id_35 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_35 +'" id="market_id_'+ id_35 +'" value="'+ id_35 +'" /><input type="hidden" name="market_code_'+ id_35 +'" id="market_code_'+ id_35 +'" value="OU" /><input type="hidden" name="extra_'+ id_35 +'" id="extra_'+ id_35 +'" value="2.5" /><span id="ou_u25_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				row += '</div></div></div>';
				
				
				
				
				//OU 3.5
				var ou_flag = '';
				if(data.ou_o35=='' || data.ou_u35==''){
					ou_flag = 'none';
				}else{
					ou_flag = 'block';
				}
				row += '<div class="col" style="display:'+ ou_flag +'"><div class="m_title Light13 Bold White">Over/Under</div><div class="rest_title2"><div class="Inner_cnt_hd rw"><div class="tl_rw Light12 White Bold Align_cent"><div class="sm_cl">G</div><div class="sm_cl"><img src="images/ic_17.png" class="arw_t_ic" alt="img"></div><div class="sm_cl"><img src="images/ic_18.png" class="arw_t_ic" alt="img"></div></div></div><div class="tl_rw Light12 White Bold">';
				
				
				
				row += '<div class="sm_cl">';
								
				row += '<div class="rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">3.5</span></a></div>';
				
				row += '</div>';
				
				var id_36 = '36'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_36 +'"><span id="ou_o35' + data.id + '" class="rt" onclick="javascript:do_select('+ id_36 +');">' + data.ou_o35 + '</span><span id="team_'+ id_36 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_36 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_36 +'" style="display:none;">O</span><span id="span_'+ id_36 +'" class="new" style="display:none;">' + data.ou_o35 + '</span><span class="rt" id="od_'+ id_36 +'" style="display:none;">' + data.ou_o35 + '</span><input type="hidden" id="is_selected_'+ id_36 +'" value="0" /><input type="hidden" name="event_id_'+ id_36 +'" id="event_id_'+ id_36 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_36 +'" id="market_id_'+ id_36 +'" value="'+ id_36 +'" /><input type="hidden" name="market_code_'+ id_36 +'" id="market_code_'+ id_36 +'" value="OU" /><input type="hidden" name="extra_'+ id_36 +'" id="extra_'+ id_36 +'" value="3.5" /><span id="ou_o35_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				var id_37 = '37'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_37 +'"><span id="ou_u35' + data.id + '" class="rt" onclick="javascript:do_select('+ id_37 +');">' + data.ou_u35 + '</span><span id="team_'+ id_37 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_37 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_37 +'" style="display:none;">U</span><span id="span_'+ id_37 +'" class="new" style="display:none;">' + data.ou_u35 + '</span><span class="rt" id="od_'+ id_37 +'" style="display:none;">' + data.ou_u35 + '</span><input type="hidden" id="is_selected_'+ id_37 +'" value="0" /><input type="hidden" name="event_id_'+ id_37 +'" id="event_id_'+ id_37 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_37 +'" id="market_id_'+ id_37 +'" value="'+ id_37 +'" /><input type="hidden" name="market_code_'+ id_37 +'" id="market_code_'+ id_37 +'" value="OU" /><input type="hidden" name="extra_'+ id_37 +'" id="extra_'+ id_37 +'" value="3.5" /><span id="ou_u35_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				row += '</div></div></div>';
				
				
				
				
				//OU 4.5
				var ou_flag = '';
				if(data.ou_o45=='' || data.ou_u45==''){
					ou_flag = 'none';
				}else{
					ou_flag = 'block';
				}
				row += '<div class="col" style="display:'+ ou_flag +'"><div class="m_title Light13 Bold White">Over/Under</div><div class="rest_title2"><div class="Inner_cnt_hd rw"><div class="tl_rw Light12 White Bold Align_cent"><div class="sm_cl">G</div><div class="sm_cl"><img src="images/ic_17.png" class="arw_t_ic" alt="img"></div><div class="sm_cl"><img src="images/ic_18.png" class="arw_t_ic" alt="img"></div></div></div><div class="tl_rw Light12 White Bold">';
				
				
				
				row += '<div class="sm_cl">';
								
				row += '<div class="rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">4.5</span></a></div>';
				
				row += '</div>';
				
				var id_38 = '38'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_38 +'"><span id="ou_o45' + data.id + '" class="rt" onclick="javascript:do_select('+ id_38 +');">' + data.ou_o45 + '</span><span id="team_'+ id_38 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_38 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_38 +'" style="display:none;">O</span><span id="span_'+ id_38 +'" class="new" style="display:none;">' + data.ou_o45 + '</span><span class="rt" id="od_'+ id_38 +'" style="display:none;">' + data.ou_o45 + '</span><input type="hidden" id="is_selected_'+ id_38 +'" value="0" /><input type="hidden" name="event_id_'+ id_38 +'" id="event_id_'+ id_38 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_38 +'" id="market_id_'+ id_38 +'" value="'+ id_38 +'" /><input type="hidden" name="market_code_'+ id_38 +'" id="market_code_'+ id_38 +'" value="OU" /><input type="hidden" name="extra_'+ id_38 +'" id="extra_'+ id_38 +'" value="4.5" /><span id="ou_o45_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				var id_39 = '39'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_39 +'"><span id="ou_u45' + data.id + '" class="rt" onclick="javascript:do_select('+ id_39 +');">' + data.ou_u45 + '</span><span id="team_'+ id_39 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_39 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_39 +'" style="display:none;">U</span><span id="span_'+ id_39 +'" class="new" style="display:none;">' + data.ou_u45 + '</span><span class="rt" id="od_'+ id_39 +'" style="display:none;">' + data.ou_u45 + '</span><input type="hidden" id="is_selected_'+ id_39 +'" value="0" /><input type="hidden" name="event_id_'+ id_39 +'" id="event_id_'+ id_39 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_39 +'" id="market_id_'+ id_39 +'" value="'+ id_39 +'" /><input type="hidden" name="market_code_'+ id_39 +'" id="market_code_'+ id_39 +'" value="OU" /><input type="hidden" name="extra_'+ id_39 +'" id="extra_'+ id_39 +'" value="4.5" /><span id="ou_u45_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				row += '</div></div></div>';
				
				
				
				
				//OU 5.5
				var ou_flag = '';
				if(data.ou_o55=='' || data.ou_u55==''){
					ou_flag = 'none';
				}else{
					ou_flag = 'block';
				}
				row += '<div class="col" style="display:'+ ou_flag +'"><div class="m_title Light13 Bold White">Over/Under</div><div class="rest_title2"><div class="Inner_cnt_hd rw"><div class="tl_rw Light12 White Bold Align_cent"><div class="sm_cl">G</div><div class="sm_cl"><img src="images/ic_17.png" class="arw_t_ic" alt="img"></div><div class="sm_cl"><img src="images/ic_18.png" class="arw_t_ic" alt="img"></div></div></div><div class="tl_rw Light12 White Bold">';
				
				
				
				row += '<div class="sm_cl">';
								
				row += '<div class="rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">5.5</span></a></div>';
				
				row += '</div>';
				
				var id_40 = '40'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_40 +'"><span id="ou_o55' + data.id + '" class="rt" onclick="javascript:do_select('+ id_40 +');">' + data.ou_o55 + '</span><span id="team_'+ id_40 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_40 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_40 +'" style="display:none;">O</span><span id="span_'+ id_40 +'" class="new" style="display:none;">' + data.ou_o55 + '</span><span class="rt" id="od_'+ id_40 +'" style="display:none;">' + data.ou_o55 + '</span><input type="hidden" id="is_selected_'+ id_40 +'" value="0" /><input type="hidden" name="event_id_'+ id_40 +'" id="event_id_'+ id_40 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_40 +'" id="market_id_'+ id_40 +'" value="'+ id_40 +'" /><input type="hidden" name="market_code_'+ id_40 +'" id="market_code_'+ id_40 +'" value="OU" /><input type="hidden" name="extra_'+ id_40 +'" id="extra_'+ id_40 +'" value="5.5" /><span id="ou_o55_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				var id_41 = '41'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_41 +'"><span id="ou_u55' + data.id + '" class="rt" onclick="javascript:do_select('+ id_41 +');">' + data.ou_u55 + '</span><span id="team_'+ id_41 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_41 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_41 +'" style="display:none;">U</span><span id="span_'+ id_41 +'" class="new" style="display:none;">' + data.ou_u55 + '</span><span class="rt" id="od_'+ id_41 +'" style="display:none;">' + data.ou_u55 + '</span><input type="hidden" id="is_selected_'+ id_41 +'" value="0" /><input type="hidden" name="event_id_'+ id_41 +'" id="event_id_'+ id_41 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_41 +'" id="market_id_'+ id_41 +'" value="'+ id_41 +'" /><input type="hidden" name="market_code_'+ id_41 +'" id="market_code_'+ id_41 +'" value="OU" /><input type="hidden" name="extra_'+ id_41 +'" id="extra_'+ id_41 +'" value="5.5" /><span id="ou_u55_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				row += '</div></div></div>';
				
				
				
				
				//OU 6.5
				var ou_flag = '';
				if(data.ou_o65=='' || data.ou_u65==''){
					ou_flag = 'none';
				}else{
					ou_flag = 'block';
				}
				row += '<div class="col" style="display:'+ ou_flag +'"><div class="m_title Light13 Bold White">Over/Under</div><div class="rest_title2"><div class="Inner_cnt_hd rw"><div class="tl_rw Light12 White Bold Align_cent"><div class="sm_cl">G</div><div class="sm_cl"><img src="images/ic_17.png" class="arw_t_ic" alt="img"></div><div class="sm_cl"><img src="images/ic_18.png" class="arw_t_ic" alt="img"></div></div></div><div class="tl_rw Light12 White Bold">';
				
				
				
				row += '<div class="sm_cl">';
								
				row += '<div class="rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">6.5</span></a></div>';
				
				row += '</div>';
				
				var id_42 = '42'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_42 +'"><span id="ou_o65' + data.id + '" class="rt" onclick="javascript:do_select('+ id_42 +');">' + data.ou_o65 + '</span><span id="team_'+ id_42 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_42 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_42 +'" style="display:none;">O</span><span id="span_'+ id_42 +'" class="new" style="display:none;">' + data.ou_o65 + '</span><span class="rt" id="od_'+ id_42 +'" style="display:none;">' + data.ou_o65 + '</span><input type="hidden" id="is_selected_'+ id_42 +'" value="0" /><input type="hidden" name="event_id_'+ id_42 +'" id="event_id_'+ id_42 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_42 +'" id="market_id_'+ id_42 +'" value="'+ id_42 +'" /><input type="hidden" name="market_code_'+ id_42 +'" id="market_code_'+ id_42 +'" value="OU" /><input type="hidden" name="extra_'+ id_42 +'" id="extra_'+ id_42 +'" value="6.5" /><span id="ou_o65_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				var id_43 = '43'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_43 +'"><span id="ou_u65' + data.id + '" class="rt" onclick="javascript:do_select('+ id_43 +');">' + data.ou_u65 + '</span><span id="team_'+ id_43 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_43 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_43 +'" style="display:none;">U</span><span id="span_'+ id_43 +'" class="new" style="display:none;">' + data.ou_u65 + '</span><span class="rt" id="od_'+ id_43 +'" style="display:none;">' + data.ou_u65 + '</span><input type="hidden" id="is_selected_'+ id_43 +'" value="0" /><input type="hidden" name="event_id_'+ id_43 +'" id="event_id_'+ id_43 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_43 +'" id="market_id_'+ id_43 +'" value="'+ id_43 +'" /><input type="hidden" name="market_code_'+ id_43 +'" id="market_code_'+ id_43 +'" value="OU" /><input type="hidden" name="extra_'+ id_43 +'" id="extra_'+ id_43 +'" value="6.5" /><span id="ou_u65_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				row += '</div></div></div>';
				
				
				
				//OU 7.5
				var ou_flag = '';
				if(data.ou_o75=='' || data.ou_u75==''){
					ou_flag = 'none';
				}else{
					ou_flag = 'block';
				}
				row += '<div class="col" style="display:'+ ou_flag +'"><div class="m_title Light13 Bold White">Over/Under</div><div class="rest_title2"><div class="Inner_cnt_hd rw"><div class="tl_rw Light12 White Bold Align_cent"><div class="sm_cl">G</div><div class="sm_cl"><img src="images/ic_17.png" class="arw_t_ic" alt="img"></div><div class="sm_cl"><img src="images/ic_18.png" class="arw_t_ic" alt="img"></div></div></div><div class="tl_rw Light12 White Bold">';
				
				
				
				row += '<div class="sm_cl">';
								
				row += '<div class="rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">7.5</span></a></div>';
				
				row += '</div>';
				
				var id_44 = '44'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_44 +'"><span id="ou_o75' + data.id + '" class="rt" onclick="javascript:do_select('+ id_44 +');">' + data.ou_o75 + '</span><span id="team_'+ id_44 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_44 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_44 +'" style="display:none;">O</span><span id="span_'+ id_44 +'" class="new" style="display:none;">' + data.ou_o75 + '</span><span class="rt" id="od_'+ id_44 +'" style="display:none;">' + data.ou_o75 + '</span><input type="hidden" id="is_selected_'+ id_44 +'" value="0" /><input type="hidden" name="event_id_'+ id_44 +'" id="event_id_'+ id_44 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_44 +'" id="market_id_'+ id_44 +'" value="'+ id_44 +'" /><input type="hidden" name="market_code_'+ id_44 +'" id="market_code_'+ id_44 +'" value="OU" /><input type="hidden" name="extra_'+ id_44 +'" id="extra_'+ id_44 +'" value="7.5" /><span id="ou_o75_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				var id_45 = '45'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_45 +'"><span id="ou_u75' + data.id + '" class="rt" onclick="javascript:do_select('+ id_45 +');">' + data.ou_u75 + '</span><span id="team_'+ id_45 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_45 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_45 +'" style="display:none;">U</span><span id="span_'+ id_45 +'" class="new" style="display:none;">' + data.ou_u75 + '</span><span class="rt" id="od_'+ id_45 +'" style="display:none;">' + data.ou_u75 + '</span><input type="hidden" id="is_selected_'+ id_45 +'" value="0" /><input type="hidden" name="event_id_'+ id_45 +'" id="event_id_'+ id_45 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_45 +'" id="market_id_'+ id_45 +'" value="'+ id_45 +'" /><input type="hidden" name="market_code_'+ id_45 +'" id="market_code_'+ id_45 +'" value="OU" /><input type="hidden" name="extra_'+ id_45 +'" id="extra_'+ id_45 +'" value="7.5" /><span id="ou_u75_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				row += '</div></div></div>';
				
				
				
				//OU 8.5
				var ou_flag = '';
				if(data.ou_o85=='' || data.ou_u85==''){
					ou_flag = 'none';
				}else{
					ou_flag = 'block';
				}
				row += '<div class="col" style="display:'+ ou_flag +'"><div class="m_title Light13 Bold White">Over/Under</div><div class="rest_title2"><div class="Inner_cnt_hd rw"><div class="tl_rw Light12 White Bold Align_cent"><div class="sm_cl">G</div><div class="sm_cl"><img src="images/ic_17.png" class="arw_t_ic" alt="img"></div><div class="sm_cl"><img src="images/ic_18.png" class="arw_t_ic" alt="img"></div></div></div><div class="tl_rw Light12 White Bold">';
				
				
				
				row += '<div class="sm_cl">';
								
				row += '<div class="rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">8.5</span></a></div>';
				
				row += '</div>';
				
				var id_46 = '46'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_46 +'"><span id="ou_o85' + data.id + '" class="rt" onclick="javascript:do_select('+ id_46 +');">' + data.ou_o85 + '</span><span id="team_'+ id_46 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_46 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_46 +'" style="display:none;">O</span><span id="span_'+ id_46 +'" class="new" style="display:none;">' + data.ou_o85 + '</span><span class="rt" id="od_'+ id_46 +'" style="display:none;">' + data.ou_o85 + '</span><input type="hidden" id="is_selected_'+ id_46 +'" value="0" /><input type="hidden" name="event_id_'+ id_46 +'" id="event_id_'+ id_46 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_46 +'" id="market_id_'+ id_46 +'" value="'+ id_46 +'" /><input type="hidden" name="market_code_'+ id_46 +'" id="market_code_'+ id_46 +'" value="OU" /><input type="hidden" name="extra_'+ id_46 +'" id="extra_'+ id_46 +'" value="8.5" /><span id="ou_o85_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				var id_47 = '47'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_47 +'"><span id="ou_u85' + data.id + '" class="rt" onclick="javascript:do_select('+ id_47 +');">' + data.ou_u85 + '</span><span id="team_'+ id_47 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_47 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_47 +'" style="display:none;">U</span><span id="span_'+ id_47 +'" class="new" style="display:none;">' + data.ou_u85 + '</span><span class="rt" id="od_'+ id_47 +'" style="display:none;">' + data.ou_u85 + '</span><input type="hidden" id="is_selected_'+ id_47 +'" value="0" /><input type="hidden" name="event_id_'+ id_47 +'" id="event_id_'+ id_47 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_47 +'" id="market_id_'+ id_47 +'" value="'+ id_47 +'" /><input type="hidden" name="market_code_'+ id_47 +'" id="market_code_'+ id_47 +'" value="OU" /><input type="hidden" name="extra_'+ id_47 +'" id="extra_'+ id_47 +'" value="8.5" /><span id="ou_u85_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				row += '</div></div></div>';
				
				
				
				//OU 9.5
				var ou_flag = '';
				if(data.ou_o95=='' || data.ou_u95==''){
					ou_flag = 'none';
				}else{
					ou_flag = 'block';
				}
				row += '<div class="col" style="display:'+ ou_flag +'"><div class="m_title Light13 Bold White">Over/Under</div><div class="rest_title2"><div class="Inner_cnt_hd rw"><div class="tl_rw Light12 White Bold Align_cent"><div class="sm_cl">G</div><div class="sm_cl"><img src="images/ic_17.png" class="arw_t_ic" alt="img"></div><div class="sm_cl"><img src="images/ic_18.png" class="arw_t_ic" alt="img"></div></div></div><div class="tl_rw Light12 White Bold">';
				
				
				
				row += '<div class="sm_cl">';
								
				row += '<div class="rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">9.5</span></a></div>';
				
				row += '</div>';
				
				var id_48 = '48'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_48 +'"><span id="ou_o95' + data.id + '" class="rt" onclick="javascript:do_select('+ id_48 +');">' + data.ou_o95 + '</span><span id="team_'+ id_48 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_48 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_48 +'" style="display:none;">O</span><span id="span_'+ id_48 +'" class="new" style="display:none;">' + data.ou_o95 + '</span><span class="rt" id="od_'+ id_48 +'" style="display:none;">' + data.ou_o95 + '</span><input type="hidden" id="is_selected_'+ id_48 +'" value="0" /><input type="hidden" name="event_id_'+ id_48 +'" id="event_id_'+ id_48 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_48 +'" id="market_id_'+ id_48 +'" value="'+ id_48 +'" /><input type="hidden" name="market_code_'+ id_48 +'" id="market_code_'+ id_48 +'" value="OU" /><input type="hidden" name="extra_'+ id_48 +'" id="extra_'+ id_48 +'" value="9.5" /><span id="ou_o95_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				var id_49 = '49'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_49 +'"><span id="ou_u95' + data.id + '" class="rt" onclick="javascript:do_select('+ id_49 +');">' + data.ou_u95 + '</span><span id="team_'+ id_49 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_49 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_49 +'" style="display:none;">U</span><span id="span_'+ id_49 +'" class="new" style="display:none;">' + data.ou_u95 + '</span><span class="rt" id="od_'+ id_49 +'" style="display:none;">' + data.ou_u95 + '</span><input type="hidden" id="is_selected_'+ id_49 +'" value="0" /><input type="hidden" name="event_id_'+ id_49 +'" id="event_id_'+ id_49 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_49 +'" id="market_id_'+ id_49 +'" value="'+ id_49 +'" /><input type="hidden" name="market_code_'+ id_49 +'" id="market_code_'+ id_49 +'" value="OU" /><input type="hidden" name="extra_'+ id_49 +'" id="extra_'+ id_49 +'" value="9.5" /><span id="ou_u95_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				row += '</div></div></div>';
				
				
				
				
				
				//OU_H1 0.5
				row += '<div class="col"><div class="m_title Light13 Bold White">Over/Under (1st Half)</div><div class="rest_title2"><div class="Inner_cnt_hd rw"><div class="tl_rw Light12 White Bold Align_cent"><div class="sm_cl">G</div><div class="sm_cl"><img src="images/ic_17.png" class="arw_t_ic" alt="img"></div><div class="sm_cl"><img src="images/ic_18.png" class="arw_t_ic" alt="img"></div></div></div><div class="tl_rw Light12 White Bold">';
				
				
				
				row += '<div class="sm_cl">';
								
				row += '<div class="rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">0.5</span></a></div>';
				
				row += '</div>';
				
				var id_30 = '30'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_30 +'"><span id="ou_o05' + data.id + '" class="rt" onclick="javascript:do_select('+ id_30 +');">' + data.ou_o05 + '</span><span id="team_'+ id_30 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_30 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_30 +'" style="display:none;">O</span><span id="span_'+ id_30 +'" class="new" style="display:none;">' + data.ou_o05 + '</span><span class="rt" id="od_'+ id_30 +'" style="display:none;">' + data.ou_o05 + '</span><input type="hidden" id="is_selected_'+ id_30 +'" value="0" /><input type="hidden" name="event_id_'+ id_30 +'" id="event_id_'+ id_30 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_30 +'" id="market_id_'+ id_30 +'" value="'+ id_30 +'" /><input type="hidden" name="market_code_'+ id_30 +'" id="market_code_'+ id_30 +'" value="OU" /><input type="hidden" name="extra_'+ id_30 +'" id="extra_'+ id_30 +'" value="0.5" /><span id="ou_o05_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				var id_31 = '31'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_31 +'"><span id="ou_u05' + data.id + '" class="rt" onclick="javascript:do_select('+ id_31 +');">' + data.ou_u05 + '</span><span id="team_'+ id_31 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_31 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_31 +'" style="display:none;">U</span><span id="span_'+ id_31 +'" class="new" style="display:none;">' + data.ou_u05 + '</span><span class="rt" id="od_'+ id_31 +'" style="display:none;">' + data.ou_u05 + '</span><input type="hidden" id="is_selected_'+ id_31 +'" value="0" /><input type="hidden" name="event_id_'+ id_31 +'" id="event_id_'+ id_31 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_31 +'" id="market_id_'+ id_31 +'" value="'+ id_31 +'" /><input type="hidden" name="market_code_'+ id_31 +'" id="market_code_'+ id_31 +'" value="OU" /><input type="hidden" name="extra_'+ id_31 +'" id="extra_'+ id_31 +'" value="0.5" /><span id="ou_u05_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				row += '</div></div></div>';
				
				
				
				
				
				//OU_H1 1.5
				row += '<div class="col"><div class="m_title Light13 Bold White">Over/Under (1st Half)</div><div class="rest_title2"><div class="Inner_cnt_hd rw"><div class="tl_rw Light12 White Bold Align_cent"><div class="sm_cl">G</div><div class="sm_cl"><img src="images/ic_17.png" class="arw_t_ic" alt="img"></div><div class="sm_cl"><img src="images/ic_18.png" class="arw_t_ic" alt="img"></div></div></div><div class="tl_rw Light12 White Bold">';
				
				
				
				row += '<div class="sm_cl">';
								
				row += '<div class="rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">1.5</span></a></div>';
				
				row += '</div>';
				
				var id_30 = '30'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_30 +'"><span id="ou_o05' + data.id + '" class="rt" onclick="javascript:do_select('+ id_30 +');">' + data.ou_o05 + '</span><span id="team_'+ id_30 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_30 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_30 +'" style="display:none;">O</span><span id="span_'+ id_30 +'" class="new" style="display:none;">' + data.ou_o05 + '</span><span class="rt" id="od_'+ id_30 +'" style="display:none;">' + data.ou_o05 + '</span><input type="hidden" id="is_selected_'+ id_30 +'" value="0" /><input type="hidden" name="event_id_'+ id_30 +'" id="event_id_'+ id_30 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_30 +'" id="market_id_'+ id_30 +'" value="'+ id_30 +'" /><input type="hidden" name="market_code_'+ id_30 +'" id="market_code_'+ id_30 +'" value="OU" /><input type="hidden" name="extra_'+ id_30 +'" id="extra_'+ id_30 +'" value="0.5" /><span id="ou_o05_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				var id_31 = '31'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_31 +'"><span id="ou_u05' + data.id + '" class="rt" onclick="javascript:do_select('+ id_31 +');">' + data.ou_u05 + '</span><span id="team_'+ id_31 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_31 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_31 +'" style="display:none;">U</span><span id="span_'+ id_31 +'" class="new" style="display:none;">' + data.ou_u05 + '</span><span class="rt" id="od_'+ id_31 +'" style="display:none;">' + data.ou_u05 + '</span><input type="hidden" id="is_selected_'+ id_31 +'" value="0" /><input type="hidden" name="event_id_'+ id_31 +'" id="event_id_'+ id_31 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_31 +'" id="market_id_'+ id_31 +'" value="'+ id_31 +'" /><input type="hidden" name="market_code_'+ id_31 +'" id="market_code_'+ id_31 +'" value="OU" /><input type="hidden" name="extra_'+ id_31 +'" id="extra_'+ id_31 +'" value="0.5" /><span id="ou_u05_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				row += '</div></div></div>';
				
				
				
				
				
				//OU_H1 2.5
				row += '<div class="col"><div class="m_title Light13 Bold White">Over/Under (1st Half)</div><div class="rest_title2"><div class="Inner_cnt_hd rw"><div class="tl_rw Light12 White Bold Align_cent"><div class="sm_cl">G</div><div class="sm_cl"><img src="images/ic_17.png" class="arw_t_ic" alt="img"></div><div class="sm_cl"><img src="images/ic_18.png" class="arw_t_ic" alt="img"></div></div></div><div class="tl_rw Light12 White Bold">';
				
				
				
				row += '<div class="sm_cl">';
								
				row += '<div class="rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">2.5</span></a></div>';
				
				row += '</div>';
				
				var id_30 = '30'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_30 +'"><span id="ou_o05' + data.id + '" class="rt" onclick="javascript:do_select('+ id_30 +');">' + data.ou_o05 + '</span><span id="team_'+ id_30 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_30 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_30 +'" style="display:none;">O</span><span id="span_'+ id_30 +'" class="new" style="display:none;">' + data.ou_o05 + '</span><span class="rt" id="od_'+ id_30 +'" style="display:none;">' + data.ou_o05 + '</span><input type="hidden" id="is_selected_'+ id_30 +'" value="0" /><input type="hidden" name="event_id_'+ id_30 +'" id="event_id_'+ id_30 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_30 +'" id="market_id_'+ id_30 +'" value="'+ id_30 +'" /><input type="hidden" name="market_code_'+ id_30 +'" id="market_code_'+ id_30 +'" value="OU" /><input type="hidden" name="extra_'+ id_30 +'" id="extra_'+ id_30 +'" value="0.5" /><span id="ou_o05_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				var id_31 = '31'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_31 +'"><span id="ou_u05' + data.id + '" class="rt" onclick="javascript:do_select('+ id_31 +');">' + data.ou_u05 + '</span><span id="team_'+ id_31 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_31 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_31 +'" style="display:none;">U</span><span id="span_'+ id_31 +'" class="new" style="display:none;">' + data.ou_u05 + '</span><span class="rt" id="od_'+ id_31 +'" style="display:none;">' + data.ou_u05 + '</span><input type="hidden" id="is_selected_'+ id_31 +'" value="0" /><input type="hidden" name="event_id_'+ id_31 +'" id="event_id_'+ id_31 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_31 +'" id="market_id_'+ id_31 +'" value="'+ id_31 +'" /><input type="hidden" name="market_code_'+ id_31 +'" id="market_code_'+ id_31 +'" value="OU" /><input type="hidden" name="extra_'+ id_31 +'" id="extra_'+ id_31 +'" value="0.5" /><span id="ou_u05_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				row += '</div></div></div>';
				
				
				
				
				//OU_H1 3.5
				row += '<div class="col"><div class="m_title Light13 Bold White">Over/Under (1st Half)</div><div class="rest_title2"><div class="Inner_cnt_hd rw"><div class="tl_rw Light12 White Bold Align_cent"><div class="sm_cl">G</div><div class="sm_cl"><img src="images/ic_17.png" class="arw_t_ic" alt="img"></div><div class="sm_cl"><img src="images/ic_18.png" class="arw_t_ic" alt="img"></div></div></div><div class="tl_rw Light12 White Bold">';
				
				
				
				row += '<div class="sm_cl">';
								
				row += '<div class="rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">3.5</span></a></div>';
				
				row += '</div>';
				
				var id_30 = '30'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_30 +'"><span id="ou_o05' + data.id + '" class="rt" onclick="javascript:do_select('+ id_30 +');">' + data.ou_o05 + '</span><span id="team_'+ id_30 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_30 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_30 +'" style="display:none;">O</span><span id="span_'+ id_30 +'" class="new" style="display:none;">' + data.ou_o05 + '</span><span class="rt" id="od_'+ id_30 +'" style="display:none;">' + data.ou_o05 + '</span><input type="hidden" id="is_selected_'+ id_30 +'" value="0" /><input type="hidden" name="event_id_'+ id_30 +'" id="event_id_'+ id_30 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_30 +'" id="market_id_'+ id_30 +'" value="'+ id_30 +'" /><input type="hidden" name="market_code_'+ id_30 +'" id="market_code_'+ id_30 +'" value="OU" /><input type="hidden" name="extra_'+ id_30 +'" id="extra_'+ id_30 +'" value="0.5" /><span id="ou_o05_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				var id_31 = '31'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_31 +'"><span id="ou_u05' + data.id + '" class="rt" onclick="javascript:do_select('+ id_31 +');">' + data.ou_u05 + '</span><span id="team_'+ id_31 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_31 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_31 +'" style="display:none;">U</span><span id="span_'+ id_31 +'" class="new" style="display:none;">' + data.ou_u05 + '</span><span class="rt" id="od_'+ id_31 +'" style="display:none;">' + data.ou_u05 + '</span><input type="hidden" id="is_selected_'+ id_31 +'" value="0" /><input type="hidden" name="event_id_'+ id_31 +'" id="event_id_'+ id_31 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_31 +'" id="market_id_'+ id_31 +'" value="'+ id_31 +'" /><input type="hidden" name="market_code_'+ id_31 +'" id="market_code_'+ id_31 +'" value="OU" /><input type="hidden" name="extra_'+ id_31 +'" id="extra_'+ id_31 +'" value="0.5" /><span id="ou_u05_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				row += '</div></div></div>';
				
				
				
								
				//OU_H1 4.5
				row += '<div class="col"><div class="m_title Light13 Bold White">Over/Under (1st Half)</div><div class="rest_title2"><div class="Inner_cnt_hd rw"><div class="tl_rw Light12 White Bold Align_cent"><div class="sm_cl">G</div><div class="sm_cl"><img src="images/ic_17.png" class="arw_t_ic" alt="img"></div><div class="sm_cl"><img src="images/ic_18.png" class="arw_t_ic" alt="img"></div></div></div><div class="tl_rw Light12 White Bold">';
				
				
				
				row += '<div class="sm_cl">';
								
				row += '<div class="rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">4.5</span></a></div>';
				
				row += '</div>';
				
				var id_30 = '30'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_30 +'"><span id="ou_o05' + data.id + '" class="rt" onclick="javascript:do_select('+ id_30 +');">' + data.ou_o05 + '</span><span id="team_'+ id_30 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_30 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_30 +'" style="display:none;">O</span><span id="span_'+ id_30 +'" class="new" style="display:none;">' + data.ou_o05 + '</span><span class="rt" id="od_'+ id_30 +'" style="display:none;">' + data.ou_o05 + '</span><input type="hidden" id="is_selected_'+ id_30 +'" value="0" /><input type="hidden" name="event_id_'+ id_30 +'" id="event_id_'+ id_30 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_30 +'" id="market_id_'+ id_30 +'" value="'+ id_30 +'" /><input type="hidden" name="market_code_'+ id_30 +'" id="market_code_'+ id_30 +'" value="OU" /><input type="hidden" name="extra_'+ id_30 +'" id="extra_'+ id_30 +'" value="0.5" /><span id="ou_o05_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				var id_31 = '31'+data.id;
				
				row += '<div class="sm_cl">';
				
				row += '<div class="rt_tab linght36 "><a class="btn_min" href="javascript:void(0);" id="div_'+ id_31 +'"><span id="ou_u05' + data.id + '" class="rt" onclick="javascript:do_select('+ id_31 +');">' + data.ou_u05 + '</span><span id="team_'+ id_31 +'" style="display:none;">' + data.t1 + '  v  ' + data.t2 + '</span><span id="text_'+ id_31 +'" style="display:none;">' + data.inf + '</span><span id="tip_'+ id_31 +'" style="display:none;">U</span><span id="span_'+ id_31 +'" class="new" style="display:none;">' + data.ou_u05 + '</span><span class="rt" id="od_'+ id_31 +'" style="display:none;">' + data.ou_u05 + '</span><input type="hidden" id="is_selected_'+ id_31 +'" value="0" /><input type="hidden" name="event_id_'+ id_31 +'" id="event_id_'+ id_31 +'" value="' + data.id + '" /><input type="hidden" name="market_id_'+ id_31 +'" id="market_id_'+ id_31 +'" value="'+ id_31 +'" /><input type="hidden" name="market_code_'+ id_31 +'" id="market_code_'+ id_31 +'" value="OU" /><input type="hidden" name="extra_'+ id_31 +'" id="extra_'+ id_31 +'" value="0.5" /><span id="ou_u05_L' + data.id + '" class="lck" style="display:none;"><img src="images/lock.png" alt="img"></span></a></div>';
				
				row += '</div>';
				
				row += '</div></div></div>';
				
				
				
				
				
				
				//Handic
				row += '<div class="col"><div class="m_title Light13 Bold White">Handic ap 0:1</div><div class="rest_title2"><div class="Inner_cnt_hd rw"><div class="tl_rw Light12 White Bold Align_cent"><div class="sm_cl">1</div><div class="sm_cl">0</div><div class="sm_cl">2</div></div></div><div class="tl_rw Light12 White Bold">';
				
				row += '<div class="sm_cl"><div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">1.75</span></a></div></div>';	
				
				row += '<div class="sm_cl"><div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">3.80</span></a></div></div>';
				
				row += '<div class="sm_cl"><div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">3.80</span></a></div></div>';
				
				row += '</div></div></div>';
				
				
				
				
				
				
				
				
				
				
				
				
					
				row += '</div>';	
				
				row += '</div></div></div>';
				
				row += '</div>';	
				
				
				
				
				
				
				
				
				
				
				
			
				
				
					
				
				
				
				
			} else {
				//alert("Already");
				var str_goal = 'ballShow' + data.id;
				
				
				if($('#team_1_score' + data.id).html()!=data.g_t1 && data.g_t1!='0' && data.g_t1!='-'){
					$('#TEM1_' + data.id).show();
					$('#TEM2_' + data.id).hide();
					goal_score(str_goal);
				} if($('#team_2_score' + data.id).html()!=data.g_t2 && data.g_t2!='0' && data.g_t2!='-'){
					$('#TEM1_' + data.id).hide();
					$('#TEM2_' + data.id).show();
					goal_score(str_goal);
				}
				
				$('#match_current_time' + data.id).html(data.tm);
				$('#team_1_score' + data.id).html(data.g_t1);
				$('#team_2_score' + data.id).html(data.g_t2);
				$('#match_status' + data.id).html(data.pn);
				
				$('#over_under_h' + data.id).html(data.to);
				$('#over_under_hn' + data.id).html(data.toh);
				
				//$('#1x2_val_1' + data.id).parent('a').addClass('borderClass');
				
				// Update Match Winner
				if(data.mw1!=""){
					$('#1x2_val_1' + data.id).html(data.mw1);
					$('#span_1' + data.id).html(data.mw1);
					$('#1' + data.id).html(data.mw1);
					
					$('#1x2_val_1' + data.id).show();
					$('#1x2_val_1_L' + data.id).hide();
				} else {
					$('#1x2_val_1' + data.id).hide();
					$('#1x2_val_1_L' + data.id).show();
				}
				if(data.mwx!=""){
					$('#1x2_val_x' + data.id).html(data.mwx);
					$('#span_2' + data.id).html(data.mwx);
					$('#2' + data.id).html(data.mwx);
					
					$('#1x2_val_x' + data.id).show();
					$('#1x2_val_x_L' + data.id).hide();
				} else {
					$('#1x2_val_x' + data.id).hide();
					$('#1x2_val_x_L' + data.id).show();
				}
				if(data.mw2!=""){
					$('#1x2_val_2' + data.id).html(data.mw2);
					$('#span_3' + data.id).html(data.mw2);
					$('#3' + data.id).html(data.mw2);
					
					$('#1x2_val_2' + data.id).show();
					$('#1x2_val_2_L' + data.id).hide();
				} else {
					$('#1x2_val_2' + data.id).hide();
					$('#1x2_val_2_L' + data.id).show();
				}
				
				// H1
				if(data.mw1h!=""){
					$('#1x2h1_val_1' + data.id).html(data.mw1h);
					$('#span_4' + data.id).html(data.mw1h);
					$('#4' + data.id).html(data.mw1h);
					
					$('#1x2h1_val_1' + data.id).show();
					$('#1x2h1_val_1_L' + data.id).hide();
				} else {
					$('#1x2h1_val_1' + data.id).hide();
					$('#1x2h1_val_1_L' + data.id).show();
				}
				if(data.mwxh!=""){
					$('#1x2h1_val_x' + data.id).html(data.mwxh);
					$('#span_5' + data.id).html(data.mwxh);
					$('#5' + data.id).html(data.mwxh);
					
					$('#1x2h1_val_x' + data.id).show();
					$('#1x2h1_val_x_L' + data.id).hide();
				} else {
					$('#1x2h1_val_x' + data.id).hide();
					$('#1x2h1_val_x_L' + data.id).show();
				}
				if(data.mw2h!=""){
					$('#1x2h1_val_2' + data.id).html(data.mw2h);
					$('#span_6' + data.id).html(data.mw2h);
					$('#6' + data.id).html(data.mw2h);
					
					$('#1x2h1_val_2' + data.id).show();
					$('#1x2h1_val_2_L' + data.id).hide();
				} else {
					$('#1x2h1_val_2' + data.id).hide();
					$('#1x2h1_val_2_L' + data.id).show();
				}
				
				
				// Update Rest Match
				if(data.rm1!=""){
					$('#res_val_1' + data.id).html(data.rm1);
					$('#span_7' + data.id).html(data.rm1);
					$('#7' + data.id).html(data.rm1);
					
					$('#res_val_1' + data.id).show();
					$('#res_val_1_L' + data.id).hide();
				} else {
					$('#res_val_1' + data.id).hide();
					$('#res_val_1_L' + data.id).show();
				}
				if(data.rmx!=""){
					$('#res_val_x' + data.id).html(data.rmx);
					$('#span_8' + data.id).html(data.rmx);
					$('#8' + data.id).html(data.rmx);
					
					$('#res_val_x' + data.id).show();
					$('#res_val_x_L' + data.id).hide();
				} else {
					$('#res_val_x' + data.id).hide();
					$('#res_val_x_L' + data.id).show();
				}
				if(data.rm2!=""){
					$('#res_val_2' + data.id).html(data.rm2);
					$('#span_9' + data.id).html(data.rm2);
					$('#9' + data.id).html(data.rm2);
					
					$('#res_val_2' + data.id).show();
					$('#res_val_2_L' + data.id).hide();
				} else {
					$('#res_val_2' + data.id).hide();
					$('#res_val_2_L' + data.id).show();
				}
				
				// H1
				if(data.rm1h!=""){
					$('#resh1_val_1' + data.id).html(data.rm1h);
					$('#span_10' + data.id).html(data.rm1h);
					$('#10' + data.id).html(data.rm1h);
					
					$('#resh1_val_1' + data.id).show();
					$('#resh1_val_1_L' + data.id).hide();
				} else {
					$('#resh1_val_1' + data.id).hide();
					$('#resh1_val_1_L' + data.id).show();
				}
				if(data.rmxh!=""){
					$('#resh1_val_x' + data.id).html(data.rmxh);
					$('#span_11' + data.id).html(data.rmxh);
					$('#11' + data.id).html(data.rmxh);
					
					$('#resh1_val_x' + data.id).show();
					$('#resh1_val_x_L' + data.id).hide();
				} else {
					$('#resh1_val_x' + data.id).hide();
					$('#resh1_val_x_L' + data.id).show();
				}
				if(data.rm2h!=""){
					$('#resh1_val_2' + data.id).html(data.rm2h);
					$('#span_12' + data.id).html(data.rm2h);
					$('#12' + data.id).html(data.rm2h);
					
					$('#resh1_val_2' + data.id).show();
					$('#resh1_val_2_L' + data.id).hide();
				} else {
					$('#resh1_val_2' + data.id).hide();
					$('#resh1_val_2_L' + data.id).show();
				}
				
				// Update Next Goal
				if(data.ng1!=""){
					$('#s1g_val_1' + data.id).html(data.ng1);
					$('#span_13' + data.id).html(data.ng1);
					$('#13' + data.id).html(data.ng1);
					
					$('#s1g_val_1' + data.id).show();
					$('#s1g_val_1_L' + data.id).hide();
				} else {
					$('#s1g_val_1' + data.id).hide();
					$('#s1g_val_1_L' + data.id).show();
				}
				if(data.ngx!=""){
					$('#s1g_val_x' + data.id).html(data.ngx);
					$('#span_14' + data.id).html(data.ngx);
					$('#14' + data.id).html(data.ngx);
					
					$('#s1g_val_x' + data.id).show();
					$('#s1g_val_x_L' + data.id).hide();
				} else {
					$('#s1g_val_x' + data.id).hide();
					$('#s1g_val_x_L' + data.id).show();
				}
				if(data.ng2!=""){
					$('#s1g_val_2' + data.id).html(data.ng2);
					$('#span_15' + data.id).html(data.ng2);
					$('#15' + data.id).html(data.ng2);
					
					$('#s1g_val_2' + data.id).show();
					$('#s1g_val_2_L' + data.id).hide();
				} else {
					$('#s1g_val_2' + data.id).hide();
					$('#s1g_val_2_L' + data.id).show();
				}
				
				// H1
				if(data.ng1h!=""){
					$('#s1gh1_val_1' + data.id).html(data.ng1h);
					$('#span_16' + data.id).html(data.ng1h);
					$('#16' + data.id).html(data.ng1h);
					
					$('#s1gh1_val_1' + data.id).show();
					$('#s1gh1_val_1_L' + data.id).hide();
				} else {
					$('#s1gh1_val_1' + data.id).hide();
					$('#s1gh1_val_1_L' + data.id).show();
				}
				if(data.ngxh!=""){
					$('#s1gh1_val_x' + data.id).html(data.ngxh);
					$('#span_17' + data.id).html(data.ngxh);
					$('#17' + data.id).html(data.ngxh);
					
					$('#s1gh1_val_x' + data.id).show();
					$('#s1gh1_val_x_L' + data.id).hide();
				} else {
					$('#s1gh1_val_x' + data.id).hide();
					$('#s1gh1_val_x_L' + data.id).show();
				}
				if(data.ng2h!=""){
					$('#s1gh1_val_2' + data.id).html(data.ng2h);
					$('#span_18' + data.id).html(data.ng2h);
					$('#18' + data.id).html(data.ng2h);
					
					$('#s1gh1_val_2' + data.id).show();
					$('#s1gh1_val_2_L' + data.id).hide();
				} else {
					$('#s1gh1_val_2' + data.id).hide();
					$('#s1gh1_val_2_L' + data.id).show();
				}
				
				// Update Update Total
				if(data.to0!=""){
					$('#over_under_o' + data.id).html(data.to0);
					$('#span_19' + data.id).html(data.to0);
					$('#19' + data.id).html(data.to0);
					
					$('#over_under_o' + data.id).show();
					$('#over_under_o_L' + data.id).hide();
				} else {
					$('#over_under_o' + data.id).hide();
					$('#over_under_o_L' + data.id).show();
				}
				if(data.to1!=""){
					$('#over_under_u' + data.id).html(data.to1);
					$('#span_20' + data.id).html(data.to1);
					$('#20' + data.id).html(data.to1);
					
					$('#over_under_u' + data.id).show();
					$('#over_under_u_L' + data.id).hide();
				} else {
					$('#over_under_u' + data.id).hide();
					$('#over_under_u_L' + data.id).show();
				}
							
				// H1
				if(data.to0h!=""){
					$('#over_under_oh1' + data.id).html(data.to0h);
					$('#span_21' + data.id).html(data.to0h);
					$('#21' + data.id).html(data.to0h);
					
					$('#over_under_oh1' + data.id).show();
					$('#over_under_oh1_L' + data.id).hide();
				} else {
					$('#over_under_oh1' + data.id).hide();
					$('#over_under_oh1_L' + data.id).show();
				}
				if(data.to1h!=""){
					$('#over_under_uh1' + data.id).html(data.to1h);
					$('#span_22' + data.id).html(data.to1h);
					$('#22' + data.id).html(data.to1h);
					
					$('#over_under_uh1' + data.id).show();
					$('#over_under_uh1_L' + data.id).hide();
				} else {
					$('#over_under_uh1' + data.id).hide();
					$('#over_under_uh1_L' + data.id).show();
				}
				
				// DC
				if(data.dc1x!=""){
					$('#double_chance_1x' + data.id).html(data.dc1x);
					$('#span_23' + data.id).html(data.dc1x);
					$('#23' + data.id).html(data.dc1x);
					
					$('#double_chance_1x' + data.id).show();
					$('#double_chance_1x_L' + data.id).hide();
				} else {
					$('#double_chance_1x' + data.id).hide();
					$('#double_chance_1x_L' + data.id).show();
				}
				
				if(data.dcx2!=""){
					$('#double_chance_x2' + data.id).html(data.dcx2);
					$('#span_24' + data.id).html(data.dcx2);
					$('#24' + data.id).html(data.dcx2);
					
					$('#double_chance_x2' + data.id).show();
					$('#double_chance_x2_L' + data.id).hide();
				} else {
					$('#double_chance_x2' + data.id).hide();
					$('#double_chance_x2_L' + data.id).show();
				}
				
				if(data.dc12!=""){
					$('#double_chance_12' + data.id).html(data.dc12);
					$('#span_25' + data.id).html(data.dc12);
					$('#25' + data.id).html(data.dc12);
					
					$('#double_chance_12' + data.id).show();
					$('#double_chance_12_L' + data.id).hide();
				} else {
					$('#double_chance_12' + data.id).hide();
					$('#double_chance_12_L' + data.id).show();
				}
								
				
				upd_slip();
			}
			
			
			
			
			return row;

        }





        function borderSetTime(divid) {

            setTimeout(function () {

                $(divid).parent('a').removeClass('borderClass');

            }, 2000);

        }







        /**

         * Debug the code

         * @param message

         * @param event

         */

        function console_log(message, event, bt){

            var debug_market_id;

            var market_id = event.eId;



			if(bt == undefined) bt = 0;



            debug_market_id = 0; // monitor only this market or comment out/0 for all



            if(debug_market_id != undefined && debug_market_id != 0){

                if(debug_market_id == market_id) log_message(message, event, bt);

            } else log_message(message, event, bt);

        }





        /**

         * Show the message only based on selection

         * @param message

         * @param event

         */

        function log_message(message, event, bt){

            var market_id = event.eId;



            //console.log(event.obj[0]);



			if(bt != 0){

				//console.log("BT:"); console.log(bt);

			} else {

				//console.log("OBJ:"); console.log(event.obj[0]);

			}



            //console.log(market_id+": "+message);

            //console.log("---");

        }


    
	
		//alert("Full");
		jQuery.fancybox.close();
		
		
		
		
		
	
	
	}	
	$(document).ready(function(){
		idle_full();
		
	});





	

    </script>

	<!--HHHHHHHHHHH-->
	<!--<script>
		setInterval(function() {
		
			console.log('RRRRRR');
			idle_full();
			
        }, 900000);	
	</script>-->
	

   <!--<script src="js/idle.js"></script>
	<script>
	$(document).idle({
	  onIdle: function(){
		//alert('10 M');
		idle_fancybox();
		
	  },
	  idle: 900000
	})
	
	//900000
	//10000
	</script>-->

</head>

<body class="bg_bdy" style="position:absolute">



	
<!--<div id="preloader">

  <div id="status">&nbsp;</div>

</div>

<script>

jQuery(document).ready(function($) {  

	// site preloader

	jQuery(window).load(function(){

		jQuery('#preloader').fadeOut('slow',function(){$(this).remove();});

	});

});

</script>-->





<?php if(file_exists('includes/menu.php')) include_once('includes/menu.php');?>



<link rel="stylesheet" href="css/menu_new.css">



<section class="middle_inner rw p_btm_5">

<div class="container_inner2">

<div class="aside_left iner5">

<div class="tble_bx">

<div class="leag_t_wrap" id="d1">

<div class="menumid">

<ul class="menu" style="background: #050505;">

<li style="width:94px;"><a href="#">Leauge <img src="images/drop_arw2.png" border="0" alt="img"></a>
	<ul style="z-index: 5;">
		<li><a href="javascript:void(0)" style="width:200px;">All</a></li>
	</ul>
</li> 

<li style="width:94px;"><a href="#" onClick="layout_click(this.id);" id="layout1">Layout 1</a></li>

<!--<li style="width:94px;"><a href="#" onClick="layout_click(this.id);" id="layout2">Layout 2</a></li>-->

<li style="width:94px;"><a href="#" onClick="layout_click(this.id);" id="layout3" class="active">Layout 3</a></li>



<!--<li style="width:94px;"><a href="#" class="active">Today</a></li>

<li style="width:94px;"><a href="#">Tomorrow</a></li>

<li style="width:94px;"><a href="#">Sunday</a></li>

<li style="width:94px;"><a href="#">Monday</a></li>

<li style="width:94px;"><a href="#">Tuesday</a></li>

<li style="width:94px;"><a href="#">Wednesday</a></li>

<li style="width:94px;"><a href="#">Thursday</a></li>-->



<li style="width:94px;"><a href="#" id="day_0" onClick="livebet_day('0','<?php echo time();?>','','Today');" class="active">Today</a></li>

<li style="width:94px;"><a href="#" id="day_1" onClick="livebet_day('1','<?php echo strtotime("+1 day");?>','','Tomorrow');">Tomorrow</a></li>

<li style="width:94px;"><a href="#" id="day_2" onClick="livebet_day('2','<?php echo strtotime("+2 day");?>','','<?php echo date("l", strtotime("+2 day"));?>');"><?php echo date("l", strtotime("+2 day"));?></a></li>

<li style="width:94px;"><a href="#" id="day_3" onClick="livebet_day('3','<?php echo strtotime("+3 day");?>','','<?php echo date("l", strtotime("+3 day"));?>');"><?php echo date("l", strtotime("+3 day"));?></a></li>

<li style="width:94px;"><a href="#" id="day_4" onClick="livebet_day('4','<?php echo strtotime("+4 day");?>','','<?php echo date("l", strtotime("+4 day"));?>');"><?php echo date("l", strtotime("+4 day"));?></a></li>

<li style="width:94px;"><a href="#" id="day_5" onClick="livebet_day('5','<?php echo strtotime("+5 day");?>','','<?php echo date("l", strtotime("+5 day"));?>');"><?php echo date("l", strtotime("+5 day"));?></a></li>

<li style="width:94px;"><a href="#" id="day_6" onClick="livebet_day('6','<?php echo strtotime("+6 day");?>','','<?php echo date("l", strtotime("+6 day"));?>');"><?php echo date("l", strtotime("+6 day"));?></a></li>



</ul>





</div>







</div>



<div class="tabContant">



<div class="h_wrap inner6 lve_sec2" id="d2">



<div id="layout_3">

<div class="col1 Light16 Bold White" id="livebet_title">Loading..</div>

<div class="col2 inner6">

<div class="rest_title match_winner">

<p class="Light12 Bold White Align_cent"><!--Remaining match-->Match winner</p> 

<div class="tl_rw Light12 White Bold Align_cent">

<div class="sm_cl">1</div> 

<div class="sm_cl">x</div> 

<div class="sm_cl">2</div>





</div>





</div> 



<div class="rest_title m_l_9">

<p class="Light12 Bold White Align_cent"><!--Next goal-->Rest of the match</p> 

<div class="tl_rw Light12 White Bold Align_cent">

<div class="sm_cl">1</div> 

<div class="sm_cl">x</div> 

<div class="sm_cl">2</div>





</div>





</div> 

<div class="rest_title m_l_9 next_goal">

<p class="Light12 Bold White Align_cent"><!--Match winner-->Next Goal</p> 

<div class="tl_rw Light12 White Bold Align_cent">

<div class="sm_cl">1</div> 

<div class="sm_cl">x</div> 

<div class="sm_cl">2</div>





</div>





</div>



<div class="ratecol"> &nbsp;</div>



<div class="totl_over Light12 Bold White Align_cent">

<p>Total</p>

<div class="rw">

<div class="sm_cl">Over</div> 

<div class="sm_cl">Under</div>





</div>







</div>



</div>

</div>







</div>





<div class="c_m_wrap rw" id="d3">

<div class="c_m_wrap2" id="match_scroll">

<div class="c_m_wrap3 lve_sec2">



<div id="today_matches">

<div id="live_matches_temp" style="display:none;"></div>
<div id="live_matches"></div>


<div id="hr24_matches" style="display:none;">

<?php //echo rand(2,9);

$d = date("d");

$m = date("m");

$Y = date("Y");

$st = mktime(0, 0, 0, $m, $d, $Y);

$et = mktime(23, 59, 59, $m, $d, $Y);



$sport_qry = mysql_query("SELECT * FROM `bet_sport` WHERE `SPORT_ID` = '50' AND `EVENT_DATETIME` >= '".$st."' AND `EVENT_DATETIME` <= '".$et."' AND `EVENT_DATETIME` >= '".time()."' AND `status_live_con` = 'Active' GROUP BY `EVENT_ID` ORDER BY `EVENT_DATETIME` ASC");



while($res = mysql_fetch_array($sport_qry)){?>

	<div class="Gamedetl inner6 match_div">

		<div class="col1">

		<div class="scr_time Light12 Bold White Align_cent">

		<?php //echo date("H:i", $res['EVENT_DATETIME']);?>

		</div>

		

		<div class="scr_detail Light12 Bold White">

		<div class="b_1"><?php echo stripslashes($res['TEAM1_NAME']);?></div>

		<div class="b_3" id="team_1_score<?php echo $res['EVENT_ID'];?>"></div>

		<div class="b_4"><!--V--></div>

		<div class="b_3" id="team_2_score<?php echo $res['EVENT_ID'];?>"></div>

		

		<div class="b_2"><?php echo stripslashes($res['TEAM2_NAME']);?></div>

		</div>

		

		

		<div class="lf_botm Light10 White">

		<div class="t_c_1"><?php echo stripslashes($res['REGION_NAME']).' '.stripslashes($res['LEAGUE_NAME']);?></div>

		<div class="t_c_3 Align_cent Light12 Bold clr_ylw"><!--<p class="Light12 Bold White frsthlf">1st half </p>--><p style="font-size:16px;"><?php echo date("H:i", $res['EVENT_DATETIME']);?></p></div>

		

		<div class="t_c_2 Align_right"><!--1 half--></div>

		</div>

		

		

		</div>

	

	

		<div class="col2 inner6">

		<div class="rest_title2">

		<div class="Inner_cnt_hd rw">

		<div class="tl_rw Light12 White Bold Align_cent">

		 Remaining match

		 </div>

		<div class="tl_rw Light12 White Bold Align_cent">

		<div class="sm_cl">

		1

		

		</div> 

		<div class="sm_cl">

		x

		

		</div> 

		<div class="sm_cl">

		2

		

		</div>

		

		

		</div>

		</div>

		

		<div class="tl_rw Light12 White Bold">

		<?php $markets_qry1 = mysql_query("SELECT `ODD_VALUE`, `market_id`, `ODD_NAME`, `MARKET_CODE` FROM `bet_market` WHERE `EVENT_ID` = '".$res['EVENT_ID']."' AND `MARKET_CODE` = '1x2' AND (`ODD_NAME` = '1' OR `ODD_NAME` = 'X' OR `ODD_NAME` = '2') ORDER BY `market_id` ASC ");

	if(mysql_num_rows($markets_qry1)>0){

		while($markets_res1 = mysql_fetch_array($markets_qry1)){

			$firest = $markets_res1['market_id'];?>

		

		<div class="sm_cl">

		<div class="rt_tab linght36 ">

			<a class="btn_min" href="javascript:void(0);" id="div_<?php echo $firest;?>">

				<span id="1x2_val_<?php echo $firest;?>" class="rt" onClick="javascript:do_select(<?php echo $firest;?>);"><?php echo $markets_res1['ODD_VALUE'];?></span>

				<span id="team_<?php echo $firest;?>" style="display:none;"><?php echo $res['TEAM1_NAME'];?> v <?php echo $res['TEAM2_NAME'];?></span>

				<span id="text_<?php echo $firest;?>" style="display:none;"><?php echo $res['REGION_NAME'].', '.$res['LEAGUE_NAME'];?></span>

				<span id="tip_<?php echo $firest;?>" style="display:none;"><?php echo $markets_res1['ODD_NAME'];?></span>

				<span id="span_<?php echo $firest;?>" class="new" style="display:none;"><?php echo $markets_res1['ODD_VALUE'];?></span>

				<span class="rt" id="od_<?php echo $firest;?>" style="display:none;"><?php echo $markets_res1['ODD_VALUE'];?></span>

				<input type="hidden" id="is_selected_<?php echo $firest;?>" value="0" />

				<input type="hidden" name="event_id_<?php echo $firest;?>" id="event_id_<?php echo $firest;?>" value="<?php echo $res['EVENT_ID'];?>" />

				<input type="hidden" name="market_id_<?php echo $firest;?>" id="market_id_<?php echo $firest;?>" value="<?php echo $firest;?>" />

				<input type="hidden" name="market_code_<?php echo $firest;?>" id="market_code_<?php echo $firest;?>" value="<?php echo $markets_res1['MARKET_CODE'];?>" />

				<input type="hidden" name="extra_<?php echo $firest;?>" id="extra_<?php echo $firest;?>" value="" />

			</a>

		</div>

		</div> 

		

		<?php }

		}else{

			for($l=0; $l<3; $l++){?>

			<div class="sm_cl">

				<div class="rt_tab linght36 "><a href="javascript:void(0);" class="btn_min"><span class="lck"><img src="images/lock.png" alt="img"></span></a></div>

			</div> 

		<?php }

		}?>

		</div>

		

		<div class="tl_rw Light12 White Bold m_t_2">

		<?php $markets_qry1 = mysql_query("SELECT `ODD_VALUE`, `market_id`, `ODD_NAME`, `MARKET_CODE` FROM `bet_market` WHERE `EVENT_ID` = '".$res['EVENT_ID']."' AND `MARKET_CODE` = '1x2_H1' AND (`ODD_NAME` = '1' OR `ODD_NAME` = 'X' OR `ODD_NAME` = '2') ORDER BY `market_id` ASC ");

	if(mysql_num_rows($markets_qry1)>0){

		while($markets_res1 = mysql_fetch_array($markets_qry1)){

			$firest = $markets_res1['market_id'];?>

		

		<div class="sm_cl">

		<div class="rt_tab linght36 ">

			<a class="btn_min" href="javascript:void(0);" id="div_<?php echo $firest;?>">

				<span id="1x2_val_<?php echo $firest;?>" class="rt" onClick="javascript:do_select(<?php echo $firest;?>);"><?php echo $markets_res1['ODD_VALUE'];?></span>

				<span id="team_<?php echo $firest;?>" style="display:none;"><?php echo $res['TEAM1_NAME'];?> v <?php echo $res['TEAM2_NAME'];?></span>

				<span id="text_<?php echo $firest;?>" style="display:none;"><?php echo $res['REGION_NAME'].', '.$res['LEAGUE_NAME'];?></span>

				<span id="tip_<?php echo $firest;?>" style="display:none;"><?php echo $markets_res1['ODD_NAME'];?></span>

				<span id="span_<?php echo $firest;?>" class="new" style="display:none;"><?php echo $markets_res1['ODD_VALUE'];?></span>

				<span class="rt" id="od_<?php echo $firest;?>" style="display:none;"><?php echo $markets_res1['ODD_VALUE'];?></span>

				<input type="hidden" id="is_selected_<?php echo $firest;?>" value="0" />

				<input type="hidden" name="event_id_<?php echo $firest;?>" id="event_id_<?php echo $firest;?>" value="<?php echo $res['EVENT_ID'];?>" />

				<input type="hidden" name="market_id_<?php echo $firest;?>" id="market_id_<?php echo $firest;?>" value="<?php echo $firest;?>" />

				<input type="hidden" name="market_code_<?php echo $firest;?>" id="market_code_<?php echo $firest;?>" value="<?php echo $markets_res1['MARKET_CODE'];?>" />

				<input type="hidden" name="extra_<?php echo $firest;?>" id="extra_<?php echo $firest;?>" value="" />

			</a>

		</div>

		</div> 

		

		<?php }

		}else{

			for($l=0; $l<3; $l++){?>

			<div class="sm_cl">

				<div class="rt_tab linght36 "><a href="javascript:void(0);" class="btn_min"><span class="lck"><img src="images/lock.png" alt="img"></span></a></div>

			</div> 

		<?php }

		}?>

	

		

		

		

		</div>

		

		

		</div>

		

		<div class="rest_title2 m_l_10">

		<div class="Inner_cnt_hd rw">

		<div class="tl_rw Light12 White Bold Align_cent">

		 Rest of the match

		 </div>

		<div class="tl_rw Light12 White Bold Align_cent">

		<div class="sm_cl">

		1

		

		</div> 

		<div class="sm_cl">

		x

		

		</div> 

		<div class="sm_cl">

		2

		

		</div>

		

		

		</div>

		</div>

		

		<div class="tl_rw Light12 White Bold">

		<div class="sm_cl">

		<div class="rt_tab linght36 "><a href="" class="btn_min"><span class="lck"><img src="images/lock.png" alt="img"></span></a></div>

		

		</div> 

		<div class="sm_cl">

		<div class="rt_tab linght36 "><a href="" class="btn_min"><span class="lck"><img src="images/lock.png" alt="img"></span></a></div>

		

		</div> 

		<div class="sm_cl">

		<div class="rt_tab linght36 "><a href="" class="btn_min"><span class="lck"><img src="images/lock.png" alt="img"></span></a></div>

		

		</div>

		

		

		</div>

		<div class="tl_rw Light12 White Bold m_t_2">

		<div class="sm_cl">

		<div class="rt_tab linght36 "><a href="" class="btn_min"><span class="lck"><img src="images/lock.png" alt="img"></span></a></div>

		

		</div> 

		<div class="sm_cl">

		<div class="rt_tab linght36 "><a href="" class="btn_min"><span class="lck"><img src="images/lock.png" alt="img"></span></a></div>

		

		</div> 

		<div class="sm_cl">

		<div class="rt_tab linght36 "><a href="" class="btn_min"><span class="lck"><img src="images/lock.png" alt="img"></span></a></div>

		

		</div>

		

		

		</div>

		

		

		</div>

		

		<div class="rest_title2 m_l_10">

		<div class="Inner_cnt_hd rw">

		<div class="tl_rw Light12 White Bold Align_cent">

		 Next Goal

		 </div>

		<div class="tl_rw Light12 White Bold Align_cent">

		<div class="sm_cl">

		1

		

		</div> 

		<div class="sm_cl">

		x

		

		</div> 

		<div class="sm_cl">

		2

		

		</div>

		

		

		</div>

		</div>

		

		<div class="tl_rw Light12 White Bold">

		<?php $markets_qry1 = mysql_query("SELECT `ODD_VALUE`, `market_id`, `ODD_NAME`, `MARKET_CODE` FROM `bet_market` WHERE `EVENT_ID` = '".$res['EVENT_ID']."' AND `MARKET_CODE` = 'FTS_3W' AND (`ODD_NAME` = '1' OR `ODD_NAME` = 'X' OR `ODD_NAME` = '2') ORDER BY `market_id` ASC ");

	if(mysql_num_rows($markets_qry1)>0){

		while($markets_res1 = mysql_fetch_array($markets_qry1)){

			$firest = $markets_res1['market_id'];?>

		

		<div class="sm_cl">

		<div class="rt_tab linght36 ">

			<a class="btn_min" href="javascript:void(0);" id="div_<?php echo $firest;?>">

				<span id="1x2_val_<?php echo $firest;?>" class="rt" onClick="javascript:do_select(<?php echo $firest;?>);"><?php echo $markets_res1['ODD_VALUE'];?></span>

				<span id="team_<?php echo $firest;?>" style="display:none;"><?php echo $res['TEAM1_NAME'];?> v <?php echo $res['TEAM2_NAME'];?></span>

				<span id="text_<?php echo $firest;?>" style="display:none;"><?php echo $res['REGION_NAME'].', '.$res['LEAGUE_NAME'];?></span>

				<span id="tip_<?php echo $firest;?>" style="display:none;"><?php echo $markets_res1['ODD_NAME'];?></span>

				<span id="span_<?php echo $firest;?>" class="new" style="display:none;"><?php echo $markets_res1['ODD_VALUE'];?></span>

				<span class="rt" id="od_<?php echo $firest;?>" style="display:none;"><?php echo $markets_res1['ODD_VALUE'];?></span>

				<input type="hidden" id="is_selected_<?php echo $firest;?>" value="0" />

				<input type="hidden" name="event_id_<?php echo $firest;?>" id="event_id_<?php echo $firest;?>" value="<?php echo $res['EVENT_ID'];?>" />

				<input type="hidden" name="market_id_<?php echo $firest;?>" id="market_id_<?php echo $firest;?>" value="<?php echo $firest;?>" />

				<input type="hidden" name="market_code_<?php echo $firest;?>" id="market_code_<?php echo $firest;?>" value="<?php echo $markets_res1['MARKET_CODE'];?>" />

				<input type="hidden" name="extra_<?php echo $firest;?>" id="extra_<?php echo $firest;?>" value="" />

			</a>

		</div>

		</div> 

		

		<?php }

		}else{

			for($l=0; $l<3; $l++){?>

			<div class="sm_cl">

				<div class="rt_tab linght36 "><a href="javascript:void(0);" class="btn_min"><span class="lck"><img src="images/lock.png" alt="img"></span></a></div>

			</div> 

		<?php }

		}?>

	

		

		

		

		</div>

				

		

		<div class="tl_rw Light12 White Bold m_t_2">

		<div class="sm_cl">

		<div class="rt_tab linght36 "><a href="" class="btn_min"><span class="lck"><img src="images/lock.png" alt="img"></span></a></div>

		

		</div> 

		<div class="sm_cl">

		<div class="rt_tab linght36 "><a href="" class="btn_min"><span class="lck"><img src="images/lock.png" alt="img"></span></a></div>

		

		</div> 

		<div class="sm_cl">

		<div class="rt_tab linght36 "><a href="" class="btn_min"><span class="lck"><img src="images/lock.png" alt="img"></span></a></div>

		

		</div>

		

		

		</div>

		

		

		</div>

		

		

		<div class="ratecol2 Align_cent Light12 Bold White">2.5</div>

		<div class="ratecol2 Align_cent Light12 Bold White line2">0.5</div>

		

		<div class="totl_over2">

		<div class="Inner_cnt_hd rw">

		<div class="tl_rw Light12 White Bold Align_cent">

		Total

		 </div>

		<div class="tl_rw Light12 White Bold Align_cent">

		<div class="sm_cl">

		Under

		

		</div> 

		 

		<div class="sm_cl">

		Over

		

		</div>

		

		

		</div>

		</div>

		

		<div class="tl_rw Light12 White Bold">

		<?php $markets_qry1 = mysql_query("SELECT `ODD_VALUE`, `market_id`, `ODD_NAME`, `MARKET_CODE` FROM `bet_market` WHERE `EVENT_ID` = '".$res['EVENT_ID']."' AND `MARKET_CODE` = 'OU' AND `MARKET_H` = '2.5' ORDER BY `ODD_NAME` ASC ");

	if(mysql_num_rows($markets_qry1)>0){

		while($markets_res1 = mysql_fetch_array($markets_qry1)){

			$firest = $markets_res1['market_id'];?>

		

		<div class="sm_cl">

		<div class="rt_tab linght36 ">

			<a class="btn_min" href="javascript:void(0);" id="div_<?php echo $firest;?>">

				<span id="1x2_val_<?php echo $firest;?>" class="rt" onClick="javascript:do_select(<?php echo $firest;?>);"><?php echo $markets_res1['ODD_VALUE'];?></span>

				<span id="team_<?php echo $firest;?>" style="display:none;"><?php echo $res['TEAM1_NAME'];?> v <?php echo $res['TEAM2_NAME'];?></span>

				<span id="text_<?php echo $firest;?>" style="display:none;"><?php echo $res['REGION_NAME'].', '.$res['LEAGUE_NAME'];?></span>

				<span id="tip_<?php echo $firest;?>" style="display:none;"><?php echo $markets_res1['ODD_NAME'];?></span>

				<span id="span_<?php echo $firest;?>" class="new" style="display:none;"><?php echo $markets_res1['ODD_VALUE'];?></span>

				<span class="rt" id="od_<?php echo $firest;?>" style="display:none;"><?php echo $markets_res1['ODD_VALUE'];?></span>

				<input type="hidden" id="is_selected_<?php echo $firest;?>" value="0" />

				<input type="hidden" name="event_id_<?php echo $firest;?>" id="event_id_<?php echo $firest;?>" value="<?php echo $res['EVENT_ID'];?>" />

				<input type="hidden" name="market_id_<?php echo $firest;?>" id="market_id_<?php echo $firest;?>" value="<?php echo $firest;?>" />

				<input type="hidden" name="market_code_<?php echo $firest;?>" id="market_code_<?php echo $firest;?>" value="<?php echo $markets_res1['MARKET_CODE'];?>" />

				<input type="hidden" name="extra_<?php echo $firest;?>" id="extra_<?php echo $firest;?>" value="" />

			</a>

		</div>

		</div> 

		

		<?php }

		}else{

			for($l=0; $l<2; $l++){?>

			<div class="sm_cl">

				<div class="rt_tab linght36 "><a href="javascript:void(0);" class="btn_min"><span class="lck"><img src="images/lock.png" alt="img"></span></a></div>

			</div> 

		<?php }

		}?>

	

		

		

		

		</div>

		

		<div class="tl_rw Light12 White Bold m_t_2">

		<?php $markets_qry1 = mysql_query("SELECT `ODD_VALUE`, `market_id`, `ODD_NAME`, `MARKET_CODE` FROM `bet_market` WHERE `EVENT_ID` = '".$res['EVENT_ID']."' AND `MARKET_CODE` = 'OU' AND `MARKET_H` = '0.5' ORDER BY `ODD_NAME` ASC ");

	if(mysql_num_rows($markets_qry1)>0){

		while($markets_res1 = mysql_fetch_array($markets_qry1)){

			$firest = $markets_res1['market_id'];?>

		

		<div class="sm_cl">

		<div class="rt_tab linght36 ">

			<a class="btn_min" href="javascript:void(0);" id="div_<?php echo $firest;?>">

				<span id="1x2_val_<?php echo $firest;?>" class="rt" onClick="javascript:do_select(<?php echo $firest;?>);"><?php echo $markets_res1['ODD_VALUE'];?></span>

				<span id="team_<?php echo $firest;?>" style="display:none;"><?php echo $res['TEAM1_NAME'];?> v <?php echo $res['TEAM2_NAME'];?></span>

				<span id="text_<?php echo $firest;?>" style="display:none;"><?php echo $res['REGION_NAME'].', '.$res['LEAGUE_NAME'];?></span>

				<span id="tip_<?php echo $firest;?>" style="display:none;"><?php echo $markets_res1['ODD_NAME'];?></span>

				<span id="span_<?php echo $firest;?>" class="new" style="display:none;"><?php echo $markets_res1['ODD_VALUE'];?></span>

				<span class="rt" id="od_<?php echo $firest;?>" style="display:none;"><?php echo $markets_res1['ODD_VALUE'];?></span>

				<input type="hidden" id="is_selected_<?php echo $firest;?>" value="0" />

				<input type="hidden" name="event_id_<?php echo $firest;?>" id="event_id_<?php echo $firest;?>" value="<?php echo $res['EVENT_ID'];?>" />

				<input type="hidden" name="market_id_<?php echo $firest;?>" id="market_id_<?php echo $firest;?>" value="<?php echo $firest;?>" />

				<input type="hidden" name="market_code_<?php echo $firest;?>" id="market_code_<?php echo $firest;?>" value="<?php echo $markets_res1['MARKET_CODE'];?>" />

				<input type="hidden" name="extra_<?php echo $firest;?>" id="extra_<?php echo $firest;?>" value="" />

			</a>

		</div>

		</div> 

		

		<?php }

		}else{

			for($l=0; $l<2; $l++){?>

			<div class="sm_cl">

				<div class="rt_tab linght36 "><a href="javascript:void(0);" class="btn_min"><span class="lck"><img src="images/lock.png" alt="img"></span></a></div>

			</div> 

		<?php }

		}?>

	

		

		

		

		</div>

		

		

		

		</div>

		

		<div class="lastcol">

		<div class="btn"><a href="javascript:void(0);" class="btn_min" id="check_<?php echo $res['EVENT_ID'];?>"><span class="l_prc ">+20</span></a></div>

		<div class="btn m_t_2"><a href="javascript:void(0);" class="btn_min2"><span class="l_prc ">S</span></a></div>

		

		

		</div>

		

		

		</div>

	

	

	</div>



	<div class="grid_3_iner3 new_sec_grd" id="toggle_<?php echo $res['EVENT_ID'];?>" style="display:none;">

	<div class="matchwrap">

	<div class="md_game_b">

	<div class="cent">

	<div class="n_col_lf">

	<div class="col">

	<div class="m_title Light13 Bold White">Handic ap 0:1</div>

	

	<div class="rest_title2">

	<div class="Inner_cnt_hd rw">

	

	<div class="tl_rw Light12 White Bold Align_cent">

	<div class="sm_cl">

	1

	

	</div> 

	<div class="sm_cl">

	0

	

	</div> 

	<div class="sm_cl">

	2

	

	</div>

	

	

	</div>

	</div>

	

	<div class="tl_rw Light12 White Bold">

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">1.75</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">3.80</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">3.80</span></a></div>

	

	</div>

	

	

	</div>

	

	

	

	</div>

	</div> 

	

	<div class="col">

	<div class="m_title Light13 Bold White">Over/Under</div>

	

	<div class="rest_title2">

	<div class="Inner_cnt_hd rw">

	

	<div class="tl_rw Light12 White Bold Align_cent">

	<div class="sm_cl ">

	G

	

	</div> 

	<div class="sm_cl">

	<img src="images/ic_17.png" class="arw_t_ic"  alt="img">

	

	</div> 

	<div class="sm_cl">

	<img src="images/ic_18.png" class="arw_t_ic" alt="img">

	

	</div>

	

	

	</div>

	</div>

	

	<div class="tl_rw Light12 White Bold">

	<div class="sm_cl">

	<div class=" rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">1.5</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">1.16</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">3.90</span></a></div>

	

	</div>

	

	

	</div>

	

	

	

	</div>

	</div>

	

	

	<div class="col">

	<div class="m_title Light13 Bold White">Handic ap 0:2</div>

	

	<div class="rest_title2">

	<div class="Inner_cnt_hd rw">

	

	<div class="tl_rw Light12 White Bold Align_cent">

	<div class="sm_cl">

	1

	

	</div> 

	<div class="sm_cl">

	0

	

	</div> 

	<div class="sm_cl">

	2

	

	</div>

	

	

	</div>

	</div>

	

	<div class="tl_rw Light12 White Bold">

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">1.75</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">3.80</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">3.80</span></a></div>

	

	</div>

	

	

	</div>

	

	

	

	</div>

	</div> 

	

	<div class="col">

	<div class="m_title Light13 Bold White">Over/Under</div>

	

	<div class="rest_title2">

	<div class="Inner_cnt_hd rw">

	

	<div class="tl_rw Light12 White Bold Align_cent">

	<div class="sm_cl ">

	G

	

	</div> 

	<div class="sm_cl">

	<img src="images/ic_17.png" class="arw_t_ic"  alt="img">

	

	</div> 

	<div class="sm_cl">

	<img src="images/ic_18.png" class="arw_t_ic" alt="img">

	

	</div>

	

	

	</div>

	</div>

	

	<div class="tl_rw Light12 White Bold">

	<div class="sm_cl">

	<div class=" rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">1.5</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">1.16</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">3.90</span></a></div>

	

	</div>

	

	

	</div>

	

	

	

	</div>

	</div>

	

	

	<div class="col">

	<div class="m_title Light13 Bold White">First Half</div>

	

	<div class="rest_title2">

	<div class="Inner_cnt_hd rw">

	

	<div class="tl_rw Light12 White Bold Align_cent">

	<div class="sm_cl">

	1

	

	</div> 

	<div class="sm_cl">

	0

	

	</div> 

	<div class="sm_cl">

	2

	

	</div>

	

	

	</div>

	</div>

	

	<div class="tl_rw Light12 White Bold">

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">1.75</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">3.80</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">3.80</span></a></div>

	

	</div>

	

	

	</div>

	

	

	

	</div>

	</div> 

	

	<div class="col">

	<div class="m_title pd_t8 Light13 Bold White">First Half<br/>Over/Under</div>

	

	<div class="rest_title2">

	<div class="Inner_cnt_hd rw">

	

	<div class="tl_rw Light12 White Bold Align_cent">

	<div class="sm_cl ">

	G

	

	</div> 

	<div class="sm_cl">

	<img src="images/ic_17.png" class="arw_t_ic"  alt="img">

	

	</div> 

	<div class="sm_cl">

	<img src="images/ic_18.png" class="arw_t_ic" alt="img">

	

	</div>

	

	

	</div>

	</div>

	

	<div class="tl_rw Light12 White Bold">

	<div class="sm_cl">

	<div class=" rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">1.5</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">1.16</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">3.90</span></a></div>

	

	</div>

	

	

	</div>

	

	

	

	</div>

	</div>

	

	</div>

	

	<div class="n_col_rg">

	

	<div class="col">

	<div class="m_title Light13 Bold White">Double Chance</div>

	

	<div class="rest_title2">

	<div class="Inner_cnt_hd rw">

	

	<div class="tl_rw Light12 White Bold Align_cent">

	<div class="sm_cl">

	1x

	

	</div> 

	<div class="sm_cl">

	12

	

	</div> 

	<div class="sm_cl">

	x2

	

	</div>

	

	

	</div>

	</div>

	

	<div class="tl_rw Light12 White Bold">

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">1.75</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">3.80</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">3.80</span></a></div>

	

	</div>

	

	

	</div>

	

	

	

	</div>

	</div> 

	

	<div class="col">

	<div class="m_title pd_t8 Light13 Bold White">First Half<br/>Over/Under</div>

	

	<div class="rest_title2">

	<div class="Inner_cnt_hd rw">

	

	<div class="tl_rw Light12 White Bold Align_cent">

	<div class="sm_cl ">

	G

	

	</div> 

	<div class="sm_cl">

	<img src="images/ic_17.png" class="arw_t_ic"  alt="img">

	

	</div> 

	<div class="sm_cl">

	<img src="images/ic_18.png" class="arw_t_ic" alt="img">

	

	</div>

	

	

	</div>

	</div>

	

	<div class="tl_rw Light12 White Bold">

	<div class="sm_cl">

	<div class=" rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">1.5</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">1.16</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">3.90</span></a></div>

	

	</div>

	

	

	</div>

	

	

	

	</div>

	</div> 

	

	

	<div class="col">

	<div class="m_title Light13 Bold White">Next Goal</div>

	

	<div class="rest_title2">

	<div class="Inner_cnt_hd rw">

	

	<div class="tl_rw Light12 White Bold Align_cent">

	<div class="sm_cl">

	1

	

	</div> 

	<div class="sm_cl">

	0

	

	</div> 

	<div class="sm_cl">

	2

	

	</div>

	

	

	</div>

	</div>

	

	<div class="tl_rw Light12 White Bold">

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">1.75</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">3.80</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">3.80</span></a></div>

	

	</div>

	

	

	</div>

	

	

	

	</div>

	</div> 

	

	<div class="col">

	<div class="m_title Light13 Bold White">Corners Over/Under</div>

	

	<div class="rest_title2">

	<div class="Inner_cnt_hd rw">

	

	<div class="tl_rw Light12 White Bold Align_cent">

	<div class="sm_cl ">

	C

	

	</div> 

	<div class="sm_cl">

	<img src="images/ic_17.png" class="arw_t_ic"  alt="img">

	

	</div> 

	<div class="sm_cl">

	<img src="images/ic_18.png" class="arw_t_ic" alt="img">

	

	</div>

	

	

	</div>

	</div>

	

	<div class="tl_rw Light12 White Bold">

	<div class="sm_cl">

	<div class=" rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">1.5</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">1.16</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">3.90</span></a></div>

	

	</div>

	

	

	</div>

	

	

	

	</div>

	</div>

	

	<div class="col">

	<div class="m_title Light13 Bold White">Handic ap 0:1</div>

	

	<div class="rest_title2">

	<div class="Inner_cnt_hd rw">

	

	<div class="tl_rw Light12 White Bold Align_cent">

	<div class="sm_cl">

	1

	

	</div> 

	<div class="sm_cl">

	0

	

	</div> 

	<div class="sm_cl">

	2

	

	</div>

	

	

	</div>

	</div>

	

	<div class="tl_rw Light12 White Bold">

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">1.75</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">3.80</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">3.80</span></a></div>

	

	</div>

	

	

	</div>

	

	

	

	</div>

	</div> 

	

	<div class="col">

	<div class="m_title Light13 Bold White">Over/Under</div>

	

	<div class="rest_title2">

	<div class="Inner_cnt_hd rw">

	

	<div class="tl_rw Light12 White Bold Align_cent">

	<div class="sm_cl ">

	G

	

	</div> 

	<div class="sm_cl">

	<img src="images/ic_17.png" class="arw_t_ic"  alt="img">

	

	</div> 

	<div class="sm_cl">

	<img src="images/ic_18.png" class="arw_t_ic" alt="img">

	

	</div>

	

	

	</div>

	</div>

	

	<div class="tl_rw Light12 White Bold">

	<div class="sm_cl">

	<div class=" rw linght32 Align_cent "><a class="btn_min" href=""><span class="rt yelw_clr2">1.5</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">1.16</span></a></div>

	

	</div> 

	<div class="sm_cl">

	<div class="rt_tab linght32 "><a class="btn_min" href=""><span class="rt">3.90</span></a></div>

	

	</div>

	

	

	</div>

	

	

	

	</div>

	</div>

	

	</div>

	

	</div>

	</div>

	</div>

	

	

	</div>		

	

<?php }?>

</div>

</div>

<div id="nextday_matches" style="display:none;"></div>



</div>

</div>

</div>





</div>





</div>





</div>







<div class="aside_rg">

<div class="bestslip" id="f1">

<div class="bestslip_t" id="f2">



<div class="menumid" id="top_menu">

	<ul class="menu" >

		<li><a href="#"><b id="sport_name"><?php echo $user_res['user_name'];?>&nbsp; Credit Limit &nbsp;<b id="credit_limit"><?php if($_SESSION['USER_TYPE']=='card'){ echo $user_res['account_balance'];}else{ echo $user_res['credit'];}?></b></b> &nbsp;<img src="images/drop_arw2.png" border="0" alt="img"></a>

			<ul style="z-index: 5;">

				<li><a href="payout.php" style="width:200px;">Payout</a></li>

				<li><a href="tickets.php" style="width:200px;">Tickets</a></li>

				<li><a href="account_statement.php" style="width:200px;">Account Statement</a></li>

				<li><a href="change_password.php" style="width:200px;">Change Password</a></li>

				<li><a href="logout.php" style="width:200px;">Logout</a></li>

			</ul>

		</li>

		

	</ul>

</div>

<div class=" close" style="margin-top: -29px; margin-right: 10px; z-index:2000;" style="cursor:pointer;" onClick="clearOnclick();"><img src="files/close.jpg" height="18"></div>



<div class="selectbet"><!--<img src="images/selectbet.jpg" alt="img">-->



<div class="country_bx" align="left" id="slip">

	<div class="cent" style="background-color:#000000;" id="one">

		

		<h3 id="sec_text_sin"></h3>

		
		<span id="list_content"></span>

		

		<h3 id="sec_text"></h3>

		<span id="list_double"></span>

		<span id="list_trixie"></span>

		<span id="list_accumulator"></span>

	

	</div>

</div>





		

</div>





</div>

<div class="cent" id="f3">

<div class="rw m_b_7">

<div class="bet_arw"><a href="javascript:void(0);" onClick="slipupClick()"><img src="images/ic_9.png" border="0" alt="img"></a></div> 

<div class="bet_arw"><a href="javascript:void(0);" onClick="slipdownClick()"><img src="images/ic_10.png" border="0" alt="img"></a></div>



</div>



<!--<div class="rw sytmbtn m_b_13"><a href=""><img src="images/systm_btn.jpg" border="0" alt="img"></a></div>-->



<div class="totlstk">

<div class="mins"><a href="javascript:void(0);" onClick="minusClick();"><img src="images/mins.jpg" border="0" alt="img"></a></div>

<div class="title">Total stake</div>



<a class="fancybox fancybox.ajax" href="stake_popup.php"><div class="t_stk_prc" id="total_stake">1.00</div></a>



<div class="pls"><a href="javascript:void(0);" onClick="plusClick();"><img src="images/plus.jpg" border="0" alt="img"></a></div>

</div>





<!--<div class="tstk_pag">

<ul>

<li><a href="">1</a></li>

<li><a href="">5</a></li>

<li><a href="">10</a></li>

<li><a href="">20</a></li>

<li><a href="">50</a></li>

<li><a href="" class="redc">C</a></li>





</ul>



</div>-->





<div class="t_detail">

<div class="rw_tl">

<div class="c_sml_1">Row <samp id="row">0</samp> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Bet type </div> 

<div class="c_sml_2"><input name="bet_type" id="bet_type" class="t_bx_bet" value="" type="text" readonly=""></div>





</div>

<div class="rw_tl">

<div class="c_sml_1">Tip <samp id="tip">0</samp> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Total odds</div> 

<div class="c_sml_2"><input name="total_odds" id="total_odds" class="t_bx_bet" value="0.00" type="text" readonly=""></div>





</div>

<div class="rw_tl">

<div class="c_sml_1">Possible winnings</div> 

<div class="c_sml_2"><input name="possible_winnings" id="possible_winnings" class="t_bx_bet" value="0.00" type="text" readonly=""></div>





</div>







</div>





<div class="rw maxwdh"><a href="javascript:void(0);" onClick="place_bet_wait();"><img src="images/place_bet.jpg" alt="img"></a></div>





</div>







</div>





</div>



</div>

</section>


<footer class="footer_inner rw">

<div class="container_inner2">

<div class="foter_inr2">

<div class="cent_b">

<div class="col1 iner5">

<div class="allmatch"><a href="" id="all_matches">All Matches</a></div>



<div class="arw_cent_b iner5">

<ul>
<!---->
<li><a href="javascript:void(0);" onClick="matchupClick()"><img src="images/ic_5.png" border="0" alt="img"></a></li> 

<li><a href="javascript:void(0);" onClick="matchdownClick()"><img src="images/ic_6.png" border="0" alt="img"></a></li>



</ul>







</div>





<div class="arw_cent_b2">

<ul>

<!--matchpreviousClick() matchnextClick()-->

<li><a href="javascript:void(0);" onClick="previous();"><img src="images/ic_7.png" border="0" alt="img"></a></li> 

<li><a href="javascript:void(0);"><b id="new_page">0</b><b>/</b><b id="total_page">0</b></a></li>

<li><a href="javascript:void(0);" onClick="next();"><img src="images/ic_8.png" border="0" alt="img"></a></li>



</ul>







</div>







</div>





</div>

</div>

</div>







</footer>
<div id="live_hid"></div>

<script>

 $(window).load(function() {

   var a1=$("body").height()

   

  

            var a2=$("header").height();

            var a3=$("footer").height();

            var a4=a2+a3;

			

			 var a5=a1-a4;

            $("section").height(a5);

			

			var a6=$("#d1").height();

			var a7=$("#d2").height();

			var a9= $("section").height();

			var a8=a6+a7;

			

			var a10=a9-a8;

			

			 $("#d3").height(a10-8);

			   $(".aside_rg").height(a5-5);

			 var f1=$("#f1").height();

			

			 

			 var f3=$("#f3").height();

			 

			 var f2=f1-f3;

			

			 

			 $("#f2").height(f2-15);

 });

</script>

<script>

/// For Match

function matchdownClick() {

    //$('#mybott1').scrollBy(0, 10);

	$('#match_scroll').animate({scrollTop: ($('#match_scroll').scrollTop() + 70) + 'px'}, 200);

}



function matchupClick() {

    //$('#mybott1').scrollBy(0, -10);

	$('#match_scroll').animate({scrollTop: ($('#match_scroll').scrollTop() - 70) + 'px'}, 200);

}



function matchnextClick() {

	var scroll_height = $("#d3").height();
	
	$('#match_scroll').animate({scrollTop: ($('#match_scroll').scrollTop() + scroll_height) + 'px'}, 5);

}



function matchpreviousClick() {

	var scroll_height = $("#d3").height();

	$('#match_scroll').animate({scrollTop: ($('#match_scroll').scrollTop() - scroll_height) + 'px'}, 5);

}



/// For Bet Slip

function slipdownClick() {

    //$('#mybott1').scrollBy(0, 10);

	$('#one').animate({scrollTop: ($('#one').scrollTop() + 70) + 'px'}, 200);

}



function slipupClick() {

    //$('#mybott1').scrollBy(0, -10);

	$('#one').animate({scrollTop: ($('#one').scrollTop() - 70) + 'px'}, 200);

}

</script>







<script>

/////FLAG SET

var flag_ts = 0;



/// For Minus

function minusClick(){

	flag_ts = 0;

	var total_stake = $("#total_stake").html();

	//alert(total_stake);

	var ts = parseFloat(total_stake) - 0.50;

	ts = ts.toFixed(2);

	if(ts>1){

	document.getElementById("total_stake").innerHTML = ts;

	

	/// TAX CALCULATION

	var tax = <?php echo $tax;?>;

	if(tax>0){

		tax = (ts * tax) / 100;

		tax = tax.toFixed(2);

		$("#tax").val(tax);

		ts = ts - tax;

		ts = ts.toFixed(2);

	}

	//alert(ts);

	

	var possible_winnings = 0;

	var total_odds = $("#total_odds").val();

	var bet_type = $("#bet_type").val();

	var row = $("#row").html();

		

	if(bet_type == 'Multiway'){

		var tr = parseFloat(ts / row);

		possible_winnings = parseFloat(total_odds*tr);

	}else if(bet_type == 'Ext. Multiway'){

		var tr = parseFloat(ts / row);

		possible_winnings = parseFloat(total_odds*tr);

	}else{

		possible_winnings = parseFloat(total_odds*ts);

	}	

	

	possible_winnings = possible_winnings.toFixed(2);

	$("#possible_winnings").val(possible_winnings);

	}

}

/// For Plus

function plusClick(){

	flag_ts = 0;

	var total_stake = $("#total_stake").html();

	//alert(total_stake);

	var ts = parseFloat(total_stake) + 0.50;

	ts = ts.toFixed(2);

	document.getElementById("total_stake").innerHTML = ts;

	

	

	/// TAX CALCULATION

	var tax = <?php echo $tax;?>;

	if(tax>0){

		tax = (ts * tax) / 100;

		tax = tax.toFixed(2);

		$("#tax").val(tax);

		ts = ts - tax;

		ts = ts.toFixed(2);

	}

	//alert(ts);

	

	var possible_winnings = 0;

	var total_odds = $("#total_odds").val();

	var bet_type = $("#bet_type").val();

	var row = $("#row").html();

		

	if(bet_type == 'Multiway'){

		var tr = parseFloat(ts / row);

		possible_winnings = parseFloat(total_odds*tr);

	}else if(bet_type == 'Ext. Multiway'){

		var tr = parseFloat(ts / row);

		possible_winnings = parseFloat(total_odds*tr);

	}else{

		possible_winnings = parseFloat(total_odds*ts);

	}

	

	possible_winnings = possible_winnings.toFixed(2);

	$("#possible_winnings").val(possible_winnings);

}

</script>



<input type="hidden" id="added_items" value="" />

<input type="hidden" name="event_arr" id="event_arr" value=""/>



<!--<script>

function do_select(ID){

 	alert(ID);

}

</script>-->

<script>

var flag_ts = 0;

var lig_id = [];



var acc = [];

var odds_acc = [];

var event_arr = [];

var odds_arr = [];

var odd_sum = 1;

var flag = 0;

var type = '';

var MID_ARR = [];

var mi_arr = [];

var curr_total_stake = 0;

   

   

   function do_select(ID)

   {

      //alert("Click");

	  var check =  $("#is_selected_"+ID).val(); 

	   

	   check = parseInt(check);

	   

	   if( check == 0 ) { 

	   	   

	   var team = $("#team_"+ID).html();

	   

	   var text = $("#text_"+ID).html();

	   

	   var tip = $("#tip_"+ID).html();

	   

	   var ratio = $("#span_"+ID).html();

	   

	   var event_id = $("#event_id_"+ID).val();

	   

	   var market_id = $("#market_id_"+ID).val();

	   

	   var market_code = $("#market_code_"+ID).val();

	   

	   var extra = $("#extra_"+ID).val(); 

	   

	   //////// ADD ACTIVE SELECT

	   mi_arr.push(market_id);

	   //alert(mi_arr);

	   $.ajax({  

			type: "POST",  

			data: "&mi_arr=" + mi_arr, 

			url: "ajax_active_bet.php"

			});

	   

	   

	   

	   

	   var event_id = $("#event_id_"+ID).val();

	   var sport = $("#sport_"+event_id).val();

	   sport++;

	   if(sport>5){

		   alert("Con't pick more than 5 in same match !");

		   return true;

	   }

	   

	   $("#sport_"+event_id).val(sport);

	   

	   

	   

	   var market_name = '';

	   if(market_code=='1x2'){

	   	market_name = "Match Winner";

	   } else if(market_code=='1x2_H1'){

	   	market_name = "Match Winner (1st Half)";

	   } else if(market_code=='RES_1x2'){

	   	market_name = "Rest Of The Match";

	   } else if(market_code=='RES_1x2_H'){

	   	market_name = "Rest Of The Match (1st Half)";

	   } else if(market_code=='S1G'){

	   	market_name = "Next Goal";

	   } else if(market_code=='S1G_H1'){

	   	market_name = "Next Goal (1st Half)";

	   } else if(market_code=='OU'){

	   	market_name = "Over/Under";

	   } else if(market_code=='OU_H1'){

	   	market_name = "Over/Under (1st Half)";

	   } else if(market_code=='FTS_3W'){

	   	market_name = "Next Goal";

	   } else{

	   	market_name = market_code;

	   }

	   

	      

	   	   

	   ////// For ACC /////

	   $acc_pos = acc.indexOf(team); 

	   acc.push(team); 

	   //alert(acc.length);

	   odds_acc.push(ratio);

	   //alert(odds_acc.length);

	    var long_arr = 0;

		

		for( i = 0 ; i < acc.length; i++ ) {

			for( j = i+1 ; j < acc.length; j++ ) {

				if( acc[i] == acc[j] ) {

					long_arr = 1;

				}  

			}

		}

	  

	   

	   var added = $("#added_items").val();

	   if( added == "" ) {

		   $("#added_items").val(ID);

	   } else {

		   added = added+"###"+ID;

		   $("#added_items").val(added); 

	   }

	   

	   if($("#team_1_score"+event_id).html()=='-'){

	   	var t1_score = '0';

	   } else {

	   	var t1_score = $("#team_1_score"+event_id).html();

	   }

	   if($("#team_2_score"+event_id).html()=='-'){

	   	var t2_score = '0';

	   } else {

	   	var t2_score = $("#team_2_score"+event_id).html();

	   }

	   var current_score = '(' + t1_score + '-' + t2_score + ')';

		   

	  

	  var html_tm = '<div id="TM_'+event_id+'" style="width: 250px;"><font color="#CCCCCC">'+team+'</font><div id="ALLSP_'+event_id+'"></div></div>';

	  

	  var html = '<span id="sp_'+ID+'"><div class="panel def-panal" style="margin-bottom:0px;"><h3 class="panel-title " style="background:#ffd63e;"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td colspan="2"><table><tr><td width="15%"><img src="images/live_icon.png"></td><td>'+market_name+' '+current_score+'</td></tr></table></td></tr><tr><td>'+extra+' Tip: '+tip+'</td><td><div class="pull-right" id="'+ID+'">'+ratio+'</div></td></tr></table><span id="total_'+ID+'"></span></h3><div class="panel-heading  head" data-dismiss="alert" style="background:#fbbd6a; padding: 0px;"><div class="close" style="margin-top: -39px; margin-right: 5px; z-index:2000;" style="cursor:pointer;" onclick="javascript:do_close('+ID+')"><img src="./files/close.jpg" kasperskylab_antibanner="on"></div></div></div><input type="hidden" id="TW_'+ID+'" value="0.00"><input type="hidden" id="ODD_'+ID+'" value="'+ratio+'"><input type="hidden" id="ODD_NAME_'+ID+'" value="'+tip+'"><input type="hidden" id="EVENT_'+ID+'" value="'+event_id+'"> <input type="hidden"  id="v1_'+ID+'" value="'+ratio+'"><input type="hidden" id="MI_'+ID+'" value="'+ID+'"><input type="hidden" id="MC_'+ID+'" value="'+market_code+'"><input type="hidden" id="TEX_'+ID+'" value="'+text+'"><input type="hidden" id="EXT_'+ID+'" value="'+extra+'"><input type="hidden" id="TP_'+ID+'" value="'+tip+'"><input type="hidden" id="RAT_'+ID+'" value="'+ratio+'"><input type="hidden" id="TEM_'+ID+'" value="'+team+'"></span>';

	   

	   //alert(long_arr);

	   if(acc.length >1 && long_arr == 0){

		  $("#bet_type").val("Combinations");

		  type = 'Combinations';

	   }

	   if(long_arr == 1){

		  $("#bet_type").val("Multiway");

		  type = 'Multiway';

	   }

	   if(acc.length==1){

	      $("#bet_type").val("Single");

		  type = 'Single';

	   }

	   

		

	   //alert($("div").find("#ALLSP_"+event_id).html());

	   if($("div").find("#ALLSP_"+event_id).html()==undefined){

			$("#list_content").append(html_tm);

	   }

	   

	   

	   

	   $("#ALLSP_"+event_id).append(html);

	   

	   //OLD BOX

	   //$("#list_content").append(html);

	   

	   $("#is_selected_"+ID).val(1);

	   

	   $("#div_"+ID).addClass('set_background'); 

	   

	   $("#value_"+ID).focus();

	   

	   var total_stake = $("#total_stake").html();

	   $("#total_odds").val(ratio);

	   

	   

	   

	   /// TAX CALCULATION

		var tax = <?php echo $tax;?>;

		if(tax>0){

			tax = (total_stake * tax) / 100;

			tax = tax.toFixed(2);

			$("#tax").val(tax);

			total_stake = total_stake - tax;

			total_stake = total_stake.toFixed(2);

		}

		//alert(total_stake);

	   

		/// For odds multiplication //

		odd_sum = 1;

		var added = $("#added_items").val();

		var added_arr = added.split("###");

		if( added != '') {  

			for( i = 0 ; i < added_arr.length; i++ ) {

			

			   var odd = $("#v1_"+added_arr[i]).val();

			   odd = parseFloat(odd);

			   odd_sum = odd_sum * odd;

			}	

		}else{

			odd_sum = 0.00;

		}

		odd_sum = odd_sum.toFixed(2);

		$("#total_odds").val(odd_sum);

		///

		

		var possible_winnings = parseFloat(odd_sum*total_stake);

	    possible_winnings = possible_winnings.toFixed(2);

	    $("#possible_winnings").val(possible_winnings);

	   

	  

	   /// Row & Tip Cal

	  

	   var tip = $("#tip").html();

	   if(tip==0){

	   		tip = 1;

	   }else{

	   		tip ++;

	   }

	   $("#tip").html(tip);

	   

	   

	   /////////

	   ////////

	   

	   if(event_arr.length==0){

	   	event_arr.push(event_id);

	   }

	   var flag = event_arr.indexOf(event_id); 

	   if(flag<0){

	   	event_arr.push(event_id);

	   }

	   $("#event_arr").val(event_arr);

	   //alert(event_arr.length);

	   var i = 1;

	   var j = 1;

	   var row = 1;

	   var k = 1;

	   for( i = 0 ; i < event_arr.length; i++ ) {	

	   		var sport_val = $("#sport_"+event_arr[i]).val();

			

			//alert(sport_val);	

			for( j = 1 ; j <= sport_val; j++ ) {

				row = k * j;

			} 

			k = row;

			

		}

		

		$("#row").html(row);

	   ////////

	   

	   

	   total_stake = parseFloat(0.50 * row);

	   if(total_stake==0.50){

	   	total_stake = parseFloat(1.00);

	   }

	   total_stake = total_stake.toFixed(2);

	   curr_total_stake = parseFloat($("#total_stake").html());

	   if(curr_total_stake < total_stake || flag_ts == 1){

	       $("#total_stake").html(total_stake);

		   flag_ts = 1;

	   }

	   

	  	   

	   ///////Market

	    var market_val = $("#market_"+event_id).val();

		if(market_val==0){

			$("#market_"+event_id).val(market_id);

		}else{

			var temp_market = market_val+','+market_id;

			$("#market_"+event_id).val(temp_market);			

		}

		var tip_new = $("#tip_"+ID).html();

		

		////////Market1

		if(market_code=='1x2'){

			var market1_val = $("#market1_"+event_id).val();

			if(market1_val==0){

				$("#market1_"+event_id).val(market_id);

			}else{

				var temp_market1 = market1_val+','+market_id;

				$("#market1_"+event_id).val(temp_market1);			

			}

		}

		

		////////Market2

		if(market_code=='1x2_H1'){

			var market2_val = $("#market2_"+event_id).val();

			if(market2_val==0){

				$("#market2_"+event_id).val(market_id);

			}else{

				var temp_market2 = market2_val+','+market_id;

				$("#market2_"+event_id).val(temp_market2);			

			}

		}

		

		////////Market3

		if(market_code=='RES_1x2'){

			var market3_val = $("#market3_"+event_id).val();

			if(market3_val==0){

				$("#market3_"+event_id).val(market_id);

			}else{

				var temp_market3 = market3_val+','+market_id;

				$("#market3_"+event_id).val(temp_market3);			

			}

		}

		

		////////Market4

		if(market_code=='RES_1x2_H'){

			var market4_val = $("#market4_"+event_id).val();

			if(market4_val==0){

				$("#market4_"+event_id).val(market_id);

			}else{

				var temp_market4 = market4_val+','+market_id;

				$("#market4_"+event_id).val(temp_market4);			

			}

		}

		

		////////Market5

		if(market_code=='S1G'){

			var market5_val = $("#market5_"+event_id).val();

			if(market5_val==0){

				$("#market5_"+event_id).val(market_id);

			}else{

				var temp_market5 = market5_val+','+market_id;

				$("#market5_"+event_id).val(temp_market5);			

			}

		}

		

		////////Market6

		if(market_code=='S1G_H1'){

			var market6_val = $("#market6_"+event_id).val();

			if(market6_val==0){

				$("#market6_"+event_id).val(market_id);

			}else{

				var temp_market6 = market6_val+','+market_id;

				$("#market6_"+event_id).val(temp_market6);			

			}

		}

		

		////////Market7

		if(market_code=='OU'){

			var market7_val = $("#market7_"+event_id).val();

			if(market7_val==0){

				$("#market7_"+event_id).val(market_id);

			}else{

				var temp_market7 = market7_val+','+market_id;

				$("#market7_"+event_id).val(temp_market7);			

			}

		}

		

		////////Market8

		if(market_code=='OU_H1'){

			var market8_val = $("#market8_"+event_id).val();

			if(market8_val==0){

				$("#market8_"+event_id).val(market_id);

			}else{

				var temp_market8 = market8_val+','+market_id;

				$("#market8_"+event_id).val(temp_market8);			

			}

		}

		

		

		

		/*////////Market2 OU

		if(market_code=='OU'){

			var market2_val = $("#market2_"+event_id).val();

			if(market2_val==0){

				$("#market2_"+event_id).val(market_id);

			}else{

				var temp_market2 = market2_val+','+market_id;

				$("#market2_"+event_id).val(temp_market2);			

			}		

		}

		

		

		////////Market3 EH All

		if(market_code=='EH'){

			var market3_val = $("#market3_"+event_id).val();

			if(market3_val==0){

				$("#market3_"+event_id).val(market_id);

			}else{

				var temp_market3 = market3_val+','+market_id;

				$("#market3_"+event_id).val(temp_market3);			

			}		

		}

		

		

		

		////////Market7 DC

		if(market_code=='DC'){

			var market7_val = $("#market7_"+event_id).val();

			if(market7_val==0){

				$("#market7_"+event_id).val(market_id);

			}else{

				var temp_market7 = market7_val+','+market_id;

				$("#market7_"+event_id).val(temp_market7);			

			}		

		}

		

		

		

		////////Market13 BTS

		if(market_code=='BTS'){

			var market13_val = $("#market13_"+event_id).val();

			if(market13_val==0){

				$("#market13_"+event_id).val(market_id);

			}else{

				var temp_market13 = market13_val+','+market_id;

				$("#market13_"+event_id).val(temp_market13);			

			}		

		}

		////////Market14 DNB

		if(market_code=='DNB'){

			var market14_val = $("#market14_"+event_id).val();

			if(market14_val==0){

				$("#market14_"+event_id).val(market_id);

			}else{

				var temp_market14 = market14_val+','+market_id;

				$("#market14_"+event_id).val(temp_market14);			

			}		

		}

		////////Market15 HTFT

		if(market_code=='HTFT'){

			var market15_val = $("#market15_"+event_id).val();

			if(market15_val==0){

				$("#market15_"+event_id).val(market_id);

			}else{

				var temp_market15 = market15_val+','+market_id;

				$("#market15_"+event_id).val(temp_market15);			

			}		

		}

		////////Market16 BTS_H1

		if(market_code=='BTS_H1'){

			var market16_val = $("#market16_"+event_id).val();

			if(market16_val==0){

				$("#market16_"+event_id).val(market_id);

			}else{

				var temp_market16 = market16_val+','+market_id;

				$("#market16_"+event_id).val(temp_market16);			

			}		

		}

		////////Market17 FTS_3W

		if(market_code=='FTS_3W'){

			var market17_val = $("#market17_"+event_id).val();

			if(market17_val==0){

				$("#market17_"+event_id).val(market_id);

			}else{

				var temp_market17 = market17_val+','+market_id;

				$("#market17_"+event_id).val(temp_market17);			

			}		

		}

		////////Market18 LTS_3W

		if(market_code=='LTS_3W'){

			var market18_val = $("#market18_"+event_id).val();

			if(market18_val==0){

				$("#market18_"+event_id).val(market_id);

			}else{

				var temp_market18 = market18_val+','+market_id;

				$("#market18_"+event_id).val(temp_market18);			

			}		

		}

		////////Market19 TSG_T1

		if(market_code=='TSG_T1'){

			var market19_val = $("#market19_"+event_id).val();

			if(market19_val==0){

				$("#market19_"+event_id).val(market_id);

			}else{

				var temp_market19 = market19_val+','+market_id;

				$("#market19_"+event_id).val(temp_market19);			

			}		

		}

		////////Market20 TSG_T2

		if(market_code=='TSG_T2'){

			var market20_val = $("#market20_"+event_id).val();

			if(market20_val==0){

				$("#market20_"+event_id).val(market_id);

			}else{

				var temp_market20 = market20_val+','+market_id;

				$("#market20_"+event_id).val(temp_market20);			

			}		

		}

		////////Market21 1x2_H1

		if(market_code=='1x2_H1'){

			var market21_val = $("#market21_"+event_id).val();

			if(market21_val==0){

				$("#market21_"+event_id).val(market_id);

			}else{

				var temp_market21 = market21_val+','+market_id;

				$("#market21_"+event_id).val(temp_market21);			

			}		

		}

		////////Market22 1x2_H2

		if(market_code=='1x2_H2'){

			var market22_val = $("#market22_"+event_id).val();

			if(market22_val==0){

				$("#market22_"+event_id).val(market_id);

			}else{

				var temp_market22 = market22_val+','+market_id;

				$("#market22_"+event_id).val(temp_market22);			

			}		

		}

		////////Market23 CS

		if(market_code=='CS'){

			var market23_val = $("#market23_"+event_id).val();

			if(market23_val==0){

				$("#market23_"+event_id).val(market_id);

			}else{

				var temp_market23 = market23_val+','+market_id;

				$("#market23_"+event_id).val(temp_market23);			

			}		

		}

		////////Market24 HA && HA_OT

		if(market_code=='HA' || market_code=='HA_OT'){

			var market24_val = $("#market24_"+event_id).val();

			if(market24_val==0){

				$("#market24_"+event_id).val(market_id);

			}else{

				var temp_market24 = market24_val+','+market_id;

				$("#market24_"+event_id).val(temp_market24);			

			}		

		}

		////////Market25 OU_OT

		if(market_code=='OU_OT'){

			var market25_val = $("#market25_"+event_id).val();

			if(market25_val==0){

				$("#market25_"+event_id).val(market_id);

			}else{

				var temp_market25 = market25_val+','+market_id;

				$("#market25_"+event_id).val(temp_market25);			

			}		

		}*/

		

		

		

	  

		

	    //// Max Odds

	   /* var max_val = 0;

	    var max_odd = $("#max_"+event_id).val();

		if(max_odd==0){

			$("#max_"+event_id).val(ratio);

		}else{

			var temp_odd = max_odd+','+ratio;

			$("#max_"+event_id).val(temp_odd);			

		}

		

		

		var max_odds = $("#max_"+event_id).val();

		

		var odds_arr = max_odds.split(",");

		//alert(odds_arr.length);

		for( j = 0 ; j < odds_arr.length; j++ ) {

			if(max_val < odds_arr[j]){

 				max_val = odds_arr[j];

			}

		}

		//alert(max_val);

		$("#maximum_"+event_id).val(max_val);

		

		var mul_odds = 1;

		

		///////	

		

		

		

		///////// Ext. Multiway

		var tip = $("#tip_"+ID).html();

		var max_rest = 0;

		var max_ou = 0;

		var max_o = 0;

		var ext_odds = 1;

		var flag_ext = 0;

		if(market_code=='1x2'){

			//alert('1X2');

			var rest_odd = $("#rest_"+event_id).val();

			if(rest_odd==0){

				$("#rest_"+event_id).val(ratio);

			}else{

				var temp_odd = rest_odd+','+ratio;

				$("#rest_"+event_id).val(temp_odd);			

			}

			

			var rest_odd = $("#rest_"+event_id).val();

			var rest_arr = rest_odd.split(",");

			//alert(rest_arr.length);

			for( j = 0 ; j < rest_arr.length; j++ ) {

				if(max_rest < rest_arr[j]){

					max_rest = rest_arr[j];

				}

			}

			//alert(max_rest);

			$("#rest_hi_"+event_id).val(max_rest);

			

		}

		

	  

		if(market_code=='OU'){

			//alert('OU');

			var ou_odd = $("#ou_"+event_id).val();

			if(ou_odd==0){

				$("#ou_"+event_id).val(ratio);

			}else{

				var temp_odd = ou_odd+','+ratio;

				$("#ou_"+event_id).val(temp_odd);			

			}

			

			var ou_odd = $("#ou_"+event_id).val();

			var ou_arr = ou_odd.split(",");

			//alert(rest_arr.length);

			for( j = 0 ; j < ou_arr.length; j++ ) {

				if(max_ou < parseFloat(ou_arr[j])){

					max_ou = parseFloat(ou_arr[j]);

				}

			}

			//alert(max_rest);

			$("#ou_hi_"+event_id).val(max_ou);

		}

		

		

		if(market_code=='EH'){

			max_o = 0;

			var eh_odd = $("#eh_"+event_id).val();

			if(eh_odd==0){

				$("#eh_"+event_id).val(ratio);

			}else{

				var temp_odd = eh_odd+','+ratio;

				$("#eh_"+event_id).val(temp_odd);			

			}

			

			var eh_odd = $("#eh_"+event_id).val();

			var eh_arr = eh_odd.split(",");

			//alert(eh_arr);

			for( j = 0 ; j < eh_arr.length; j++ ) {

				if(max_o < parseFloat(eh_arr[j])){

					max_o = parseFloat(eh_arr[j]);

					//alert(max_o);

				}

			}

			$("#eh_hi_"+event_id).val(max_o);

		}

		

		

		

		if(market_code=='DC'){

			max_o = 0;

			var dc_odd = $("#dc_"+event_id).val();

			if(dc_odd==0){

				$("#dc_"+event_id).val(ratio);

			}else{

				var temp_odd = dc_odd+','+ratio;

				$("#dc_"+event_id).val(temp_odd);			

			}

			

			var dc_odd = $("#dc_"+event_id).val();

			var dc_arr = dc_odd.split(",");

			//alert(rest_arr.length);

			for( j = 0 ; j < dc_arr.length; j++ ) {

				if(max_o < dc_arr[j]){

					max_o = dc_arr[j];

				}

			}

			//alert(max_rest);

			$("#dc_hi_"+event_id).val(max_o);

		}

		

		

		if(market_code=='BTS'){

			max_o = 0;

			var bts_odd = $("#bts_"+event_id).val();

			if(bts_odd==0){

				$("#bts_"+event_id).val(ratio);

			}else{

				var temp_odd = bts_odd+','+ratio;

				$("#bts_"+event_id).val(temp_odd);			

			}

			

			var bts_odd = $("#bts_"+event_id).val();

			var bts_arr = bts_odd.split(",");

			//alert(rest_arr.length);

			for( j = 0 ; j < bts_arr.length; j++ ) {

				if(max_o < bts_arr[j]){

					max_o = bts_arr[j];

				}

			}

			//alert(max_rest);

			$("#bts_hi_"+event_id).val(max_o);

		}

		if(market_code=='DNB'){

			max_o = 0;

			var dnb_odd = $("#dnb_"+event_id).val();

			if(dnb_odd==0){

				$("#dnb_"+event_id).val(ratio);

			}else{

				var temp_odd = dnb_odd+','+ratio;

				$("#dnb_"+event_id).val(temp_odd);			

			}

			

			var dnb_odd = $("#dnb_"+event_id).val();

			var dnb_arr = dnb_odd.split(",");

			//alert(rest_arr.length);

			for( j = 0 ; j < dnb_arr.length; j++ ) {

				if(max_o < dnb_arr[j]){

					max_o = dnb_arr[j];

				}

			}

			//alert(max_rest);

			$("#dnb_hi_"+event_id).val(max_o);

		}

		if(market_code=='HTFT'){

			max_o = 0;

			var htft_odd = $("#htft_"+event_id).val();

			if(htft_odd==0){

				$("#htft_"+event_id).val(ratio);

			}else{

				var temp_odd = htft_odd+','+ratio;

				$("#htft_"+event_id).val(temp_odd);			

			}

			

			var htft_odd = $("#htft_"+event_id).val();

			var htft_arr = htft_odd.split(",");

			//alert(rest_arr.length);

			for( j = 0 ; j < htft_arr.length; j++ ) {

				if(max_o < htft_arr[j]){

					max_o = htft_arr[j];

				}

			}

			//alert(max_rest);

			$("#htft_hi_"+event_id).val(max_o);

		}

		if(market_code=='BTS_H1'){

			max_o = 0;

			var btsh1_odd = $("#btsh1_"+event_id).val();

			if(btsh1_odd==0){

				$("#btsh1_"+event_id).val(ratio);

			}else{

				var temp_odd = btsh1_odd+','+ratio;

				$("#btsh1_"+event_id).val(temp_odd);			

			}

			

			var btsh1_odd = $("#btsh1_"+event_id).val();

			var btsh1_arr = btsh1_odd.split(",");

			//alert(rest_arr.length);

			for( j = 0 ; j < btsh1_arr.length; j++ ) {

				if(max_o < btsh1_arr[j]){

					max_o = btsh1_arr[j];

				}

			}

			//alert(max_rest);

			$("#btsh1_hi_"+event_id).val(max_o);

		}

		if(market_code=='FTS_3W'){

			max_o = 0;

			var fts3w_odd = $("#fts3w_"+event_id).val();

			if(fts3w_odd==0){

				$("#fts3w_"+event_id).val(ratio);

			}else{

				var temp_odd = fts3w_odd+','+ratio;

				$("#fts3w_"+event_id).val(temp_odd);			

			}

			

			var fts3w_odd = $("#fts3w_"+event_id).val();

			var fts3w_arr = fts3w_odd.split(",");

			//alert(rest_arr.length);

			for( j = 0 ; j < fts3w_arr.length; j++ ) {

				if(max_o < fts3w_arr[j]){

					max_o = fts3w_arr[j];

				}

			}

			//alert(max_rest);

			$("#fts3w_hi_"+event_id).val(max_o);

		}

		if(market_code=='LTS_3W'){

			max_o = 0;

			var lts3w_odd = $("#lts3w_"+event_id).val();

			if(lts3w_odd==0){

				$("#lts3w_"+event_id).val(ratio);

			}else{

				var temp_odd = lts3w_odd+','+ratio;

				$("#lts3w_"+event_id).val(temp_odd);			

			}

			

			var lts3w_odd = $("#lts3w_"+event_id).val();

			var lts3w_arr = lts3w_odd.split(",");

			//alert(rest_arr.length);

			for( j = 0 ; j < lts3w_arr.length; j++ ) {

				if(max_o < lts3w_arr[j]){

					max_o = lts3w_arr[j];

				}

			}

			//alert(max_rest);

			$("#lts3w_hi_"+event_id).val(max_o);

		}

		if(market_code=='TSG_T1'){

			max_o = 0;

			var tsgt1_odd = $("#tsgt1_"+event_id).val();

			if(tsgt1_odd==0){

				$("#tsgt1_"+event_id).val(ratio);

			}else{

				var temp_odd = tsgt1_odd+','+ratio;

				$("#tsgt1_"+event_id).val(temp_odd);			

			}

			

			var tsgt1_odd = $("#tsgt1_"+event_id).val();

			var tsgt1_arr = tsgt1_odd.split(",");

			//alert(rest_arr.length);

			for( j = 0 ; j < tsgt1_arr.length; j++ ) {

				if(max_o < tsgt1_arr[j]){

					max_o = tsgt1_arr[j];

				}

			}

			//alert(max_rest);

			$("#tsgt1_hi_"+event_id).val(max_o);

		}

		if(market_code=='TSG_T2'){

			max_o = 0;

			var tsgt2_odd = $("#tsgt2_"+event_id).val();

			if(tsgt2_odd==0){

				$("#tsgt2_"+event_id).val(ratio);

			}else{

				var temp_odd = tsgt2_odd+','+ratio;

				$("#tsgt2_"+event_id).val(temp_odd);			

			}

			

			var tsgt2_odd = $("#tsgt2_"+event_id).val();

			var tsgt2_arr = tsgt2_odd.split(",");

			//alert(rest_arr.length);

			for( j = 0 ; j < tsgt2_arr.length; j++ ) {

				if(max_o < tsgt2_arr[j]){

					max_o = tsgt2_arr[j];

				}

			}

			//alert(max_rest);

			$("#tsgt2_hi_"+event_id).val(max_o);

		}

		if(market_code=='1x2_H1'){

			max_o = 0;

			var oh1_odd = $("#oh1_"+event_id).val();

			if(oh1_odd==0){

				$("#oh1_"+event_id).val(ratio);

			}else{

				var temp_odd = oh1_odd+','+ratio;

				$("#oh1_"+event_id).val(temp_odd);			

			}

			

			var oh1_odd = $("#oh1_"+event_id).val();

			var oh1_arr = oh1_odd.split(",");

			//alert(rest_arr.length);

			for( j = 0 ; j < oh1_arr.length; j++ ) {

				if(max_o < oh1_arr[j]){

					max_o = oh1_arr[j];

				}

			}

			//alert(max_rest);

			$("#oh1_hi_"+event_id).val(max_o);

		}

		if(market_code=='1x2_H2'){

			max_o = 0;

			var oh2_odd = $("#oh2_"+event_id).val();

			if(oh2_odd==0){

				$("#oh2_"+event_id).val(ratio);

			}else{

				var temp_odd = oh2_odd+','+ratio;

				$("#oh2_"+event_id).val(temp_odd);			

			}

			

			var oh2_odd = $("#oh2_"+event_id).val();

			var oh2_arr = oh2_odd.split(",");

			//alert(rest_arr.length);

			for( j = 0 ; j < oh2_arr.length; j++ ) {

				if(max_o < oh2_arr[j]){

					max_o = oh2_arr[j];

				}

			}

			//alert(max_rest);

			$("#oh2_hi_"+event_id).val(max_o);

		}

		if(market_code=='CS'){

			max_o = 0;

			var cs_odd = $("#cs_"+event_id).val();

			if(cs_odd==0){

				$("#cs_"+event_id).val(ratio);

			}else{

				var temp_odd = cs_odd+','+ratio;

				$("#cs_"+event_id).val(temp_odd);			

			}

			

			var cs_odd = $("#cs_"+event_id).val();

			var cs_arr = cs_odd.split(",");

			//alert(rest_arr.length);

			for( j = 0 ; j < cs_arr.length; j++ ) {

				if(max_o < cs_arr[j]){

					max_o = cs_arr[j];

				}

			}

			//alert(max_rest);

			$("#cs_hi_"+event_id).val(max_o);

		}

		

		

		

		if(market_code=='HA' || market_code=='HA_OT'){

			max_o = 0;

			var ha_odd = $("#ha_"+event_id).val();

			if(ha_odd==0){

				$("#ha_"+event_id).val(ratio);

			}else{

				var temp_odd = ha_odd+','+ratio;

				$("#ha_"+event_id).val(temp_odd);			

			}

			

			var ha_odd = $("#ha_"+event_id).val();

			var ha_arr = ha_odd.split(",");

			//alert(rest_arr.length);

			for( j = 0 ; j < ha_arr.length; j++ ) {

				if(max_o < ha_arr[j]){

					max_o = ha_arr[j];

				}

			}

			//alert(max_rest);

			$("#ha_hi_"+event_id).val(max_o);

		}

		if(market_code=='OU_OT'){

			max_o = 0;

			var ouot_odd = $("#ouot_"+event_id).val();

			if(ouot_odd==0){

				$("#ouot_"+event_id).val(ratio);

			}else{

				var temp_odd = ouot_odd+','+ratio;

				$("#ouot_"+event_id).val(temp_odd);			

			}

			

			var ouot_odd = $("#ouot_"+event_id).val();

			var ouot_arr = ouot_odd.split(",");

			//alert(rest_arr.length);

			for( j = 0 ; j < ouot_arr.length; j++ ) {

				if(max_o < ouot_arr[j]){

					max_o = ouot_arr[j];

				}

			}

			//alert(max_rest);

			$("#ouot_hi_"+event_id).val(max_o);

		}*/

		

		

		

		

		var ext_odds = 1;

		var flag_new = 0;

		//var ext_odd = 0;

		for( i = 0 ; i < event_arr.length; i++ ) {	

			var ext_odd = 0;

			var flag_ext = 0;

			

			var max_oddval = 0;

			var market1 = $("#market1_"+event_arr[i]).val();

			//alert(market1);

			var market1_arr = market1.split(",");

			for( j = 0 ; j < market1_arr.length; j++ ) {

			

				var market1_hi = parseFloat($("#"+market1_arr[j]).html());

				if(max_oddval < market1_hi){

					max_oddval = market1_hi;

				}

			}

			var market1_hi = max_oddval;

			//alert(market1_hi);

			

			max_oddval = 0;

			var market2 = $("#market2_"+event_arr[i]).val();

			var market2_arr = market2.split(",");

			for( j = 0 ; j < market2_arr.length; j++ ) {

			

				var market2_hi = parseFloat($("#"+market2_arr[j]).html());

				if(max_oddval < market2_hi){

					max_oddval = market2_hi;

				}

			}

			var market2_hi = max_oddval;

			

			max_oddval = 0;

			var market3 = $("#market3_"+event_arr[i]).val();

			var market3_arr = market3.split(",");

			for( j = 0 ; j < market3_arr.length; j++ ) {

			

				var market3_hi = parseFloat($("#"+market3_arr[j]).html());

				if(max_oddval < market3_hi){

					max_oddval = market3_hi;

				}

			}

			var market3_hi = max_oddval;

			

			max_oddval = 0;

			var market4 = $("#market4_"+event_arr[i]).val();

			var market4_arr = market4.split(",");

			for( j = 0 ; j < market4_arr.length; j++ ) {

			

				var market4_hi = parseFloat($("#"+market4_arr[j]).html());

				if(max_oddval < market4_hi){

					max_oddval = market4_hi;

				}

			}

			var market4_hi = max_oddval;

			

			max_oddval = 0;

			var market5 = $("#market5_"+event_arr[i]).val();

			var market5_arr = market5.split(",");

			for( j = 0 ; j < market5_arr.length; j++ ) {

			

				var market5_hi = parseFloat($("#"+market5_arr[j]).html());

				if(max_oddval < market5_hi){

					max_oddval = market5_hi;

				}

			}

			var market5_hi = max_oddval;

			

			max_oddval = 0;

			var market6 = $("#market6_"+event_arr[i]).val();

			var market6_arr = market6.split(",");

			for( j = 0 ; j < market6_arr.length; j++ ) {

			

				var market6_hi = parseFloat($("#"+market6_arr[j]).html());

				if(max_oddval < market6_hi){

					max_oddval = market6_hi;

				}

			}

			var market6_hi = max_oddval;

			

			max_oddval = 0;

			var market7 = $("#market7_"+event_arr[i]).val();

			var market7_arr = market7.split(",");

			for( j = 0 ; j < market7_arr.length; j++ ) {

			

				var market7_hi = parseFloat($("#"+market7_arr[j]).html());

				if(max_oddval < market7_hi){

					max_oddval = market7_hi;

				}

			}

			var market7_hi = max_oddval;

			

			max_oddval = 0;

			var market8 = $("#market8_"+event_arr[i]).val();

			var market8_arr = market8.split(",");

			for( j = 0 ; j < market8_arr.length; j++ ) {

			

				var market8_hi = parseFloat($("#"+market8_arr[j]).html());

				if(max_oddval < market8_hi){

					max_oddval = market8_hi;

				}

			}

			var market8_hi = max_oddval;

			

			

			

			if(market1_hi!=0){

				flag_ext++;

				ext_odd = parseFloat(ext_odd + market1_hi);

			} if(market2_hi!=0){

				flag_ext++;

				ext_odd = parseFloat(ext_odd + market2_hi);

			} if(market3_hi!=0){

				flag_ext++;

				ext_odd = parseFloat(ext_odd + market3_hi);

			} if(market4_hi!=0){

				flag_ext++;

				ext_odd = parseFloat(ext_odd + market4_hi);

			} if(market5_hi!=0){

				flag_ext++;

				ext_odd = parseFloat(ext_odd + market5_hi);

			} if(market6_hi!=0){

				flag_ext++;

				ext_odd = parseFloat(ext_odd + market6_hi);

			} if(market7_hi!=0){

				flag_ext++;

				ext_odd = parseFloat(ext_odd + market7_hi);

			} if(market8_hi!=0){

				flag_ext++;

				ext_odd = parseFloat(ext_odd + market8_hi);

			}

			
			
			

			

			/*if(rest_hi!=0){

				flag_ext++;

				ext_odd = ext_odd + parseFloat(rest_hi);

			} if(ou_hi!=0){

				flag_ext++;

				ext_odd = ext_odd + parseFloat(ou_hi);

			} if(eh_hi!=0){

				flag_ext++;

				ext_odd = ext_odd + parseFloat(eh_hi);

			} if(dc_hi!=0){

				flag_ext++;

				ext_odd = ext_odd + parseFloat(dc_hi);

			} if(bts_hi!=0){

				flag_ext++;

				ext_odd = ext_odd + parseFloat(bts_hi);

			} if(dnb_hi!=0){

				flag_ext++;

				ext_odd = ext_odd + parseFloat(dnb_hi);

			} if(htft_hi!=0){

				flag_ext++;

				ext_odd = ext_odd + parseFloat(htft_hi);

			} if(btsh1_hi!=0){

				flag_ext++;

				ext_odd = ext_odd + parseFloat(btsh1_hi);

			} if(fts3w_hi!=0){

				flag_ext++;

				ext_odd = ext_odd + parseFloat(fts3w_hi);

			} if(lts3w_hi!=0){

				flag_ext++;

				ext_odd = ext_odd + parseFloat(lts3w_hi);

			} if(tsgt1_hi!=0){

				flag_ext++;

				ext_odd = ext_odd + parseFloat(tsgt1_hi);

			} if(tsgt2_hi!=0){

				flag_ext++;

				ext_odd = ext_odd + parseFloat(tsgt2_hi);

			} if(oh1_hi!=0){

				flag_ext++;

				ext_odd = ext_odd + parseFloat(oh1_hi);

			} if(oh2_hi!=0){

				flag_ext++;

				ext_odd = ext_odd + parseFloat(oh2_hi);

			} if(cs_hi!=0){

				flag_ext++;

				ext_odd = ext_odd + parseFloat(cs_hi);

			} if(ha_hi!=0){

				flag_ext++;

				ext_odd = ext_odd + parseFloat(ha_hi);

			} if(ouot_hi!=0){

				flag_ext++;

				ext_odd = ext_odd + parseFloat(ouot_hi);

			}*/

			

			

			//alert(ext_odd);


			

			

			

			

			/////

			if(ext_odd!=0){

				ext_odds = parseFloat(ext_odds * ext_odd);

			}

			

			if(flag_ext>1){

				flag_new = 1;

			}

			

		 }

		 

		 

		 
		
		 

		// Default total stake 2.00 

		var bettype = $("#bet_type").val();

		if(bettype== 'Multiway' || bettype== 'Ext. Multiway'){

			var totalstake = $("#total_stake").html();

			if(totalstake<2){

				$("#total_stake").html('2.00');

			}

			

			/// New Add

			ext_odds = ext_odds.toFixed(2);

		  	$("#total_odds").val(ext_odds);

			

			var total_stake = $("#total_stake").html();

			

			/// TAX CALCULATION

			var tax = <?php echo $tax;?>;

			if(tax>0){

				tax = (total_stake * tax) / 100;

				tax = tax.toFixed(2);

				$("#tax").val(tax);

				total_stake = total_stake - tax;

				total_stake = total_stake.toFixed(2);

			}

			//alert(total_stake);

			

		 	var tr = parseFloat(total_stake) / parseFloat(row);

			var possible_winnings = parseFloat(ext_odds*tr);

			possible_winnings = possible_winnings.toFixed(2);

			$("#possible_winnings").val(possible_winnings);

			

		}

		 

		 

		 

		 

		 

		
		
		 

		 //alert(type);

		 if(flag_new==1){

	      $("#bet_type").val("Ext. Multiway");

		  type = 'Ext. Multiway';

		  var total_stake_new = $("#total_stake").html();

		  

		  /// TAX CALCULATION

			var tax = <?php echo $tax;?>;

			if(tax>0){

				tax = (total_stake_new * tax) / 100;

				tax = tax.toFixed(2);

				$("#tax").val(tax);

				total_stake_new = total_stake_new - tax;

				total_stake_new = total_stake_new.toFixed(2);

			}
			
			//alert(total_stake_new);


		  //ext_odds = ext_odds.toFixed(2);

		  $("#total_odds").val(ext_odds);

		  var tr = parseFloat(total_stake_new) / parseFloat(row);

		  var possible_winnings = parseFloat(ext_odds*tr);

			possible_winnings = possible_winnings.toFixed(2);

			$("#possible_winnings").val(possible_winnings);
			
		
			

	     }

		////////

		

		

		

		

		

		

		 

		
		
		

		/// For Select Bet

	

		var total_stake = $("#total_stake").html();

		var bet_type = $("#bet_type").val();

		var total_odds = $("#total_odds").val();

		var possible_winnings = $("#possible_winnings").val();

		

		

		

		var added = $("#added_items").val();

		var added_arr = added.split("###");

		if( added != '') {  

			for( i = 0 ; i < added_arr.length; i++ ) {

			

			   var odd = $("#v1_"+added_arr[i]).val();

			   odd = parseFloat(odd);

			   odd_sum = odd_sum * odd;

			   

			   //var MID = $("#MI_"+added_arr[i]).val();

			   //MID_ARR.push(MID);

			}

			

			$.ajax({  

			type: "POST",  

			data: "&MID_ARR=" + MID_ARR + "&total_stake=" + total_stake + "&bet_type=" + bet_type + "&total_odds=" + total_odds + "&possible_winnings=" + possible_winnings, 

			url: "ajax_select_bet.php"

			});

			

			

		}

		

		

		

		

		//alert("END SCRIPT");

	  

				  	   

	   

	   

	   } else {

	   	  

		 ////// For ACC

		 var total_stake = $("#total_stake").html();

		 var text = $("#text_"+ID).html();

	   	 var ratio = $("#span_"+ID).html();

		 var tip = $("#tip_"+ID).html();

		 var market_id = $("#market_id_"+ID).val();

		 

		 var market_code = $("#market_code_"+ID).val();

		 var extra = $("#extra_"+ID).val(); 

		 

		 var event_id = $("#event_id_"+ID).val();

 		 var tm = $("#team_"+ID).html();

		 

		 

		 //////// ADD ACTIVE SELECT

		 var mi_arr_pos = mi_arr.indexOf(market_id); 

		 mi_arr.splice(mi_arr_pos, 1);

		 $.ajax({  

			type: "POST",  

			data: "&mi_arr=" + mi_arr, 

			url: "ajax_active_bet.php"

			});

		 

		 

		 

 		 var acc_pos = acc.indexOf(tm); 

		 acc.splice(acc_pos, 1);

		 //alert(acc.length);

		 

		var long_arr = 0;

		for( i = 0 ; i < acc.length; i++ ) {

			for( j = i+1 ; j < acc.length; j++ ) {

				if( acc[i] == acc[j] ) {

					long_arr = 1;

				}  

			}

		}

		

		

	   if(acc.length >1 && long_arr == 0){

		  $("#bet_type").val("Combinations");

		  type = 'Combinations';



	   }

	   if(long_arr == 1){

		  $("#bet_type").val("Multiway");

		  type = 'Multiway';

	   }

	   if(acc.length==1){

	      $("#bet_type").val("Single");

		  type = 'Single';

	   }

	   

	   ///////////

		  

		   

		  var added = $("#added_items").val();

		  var added_arr = added.split("###");

		  var nw = '';

		  

		  for( i = 0 ; i < added_arr.length; i++ ) {

			 // alert(added_arr[i]);

			  if( added_arr[i] != ID ) {

				  

				  if( nw == '' ) {

					   nw = added_arr[i];

				  } else {

					   nw = nw+"###"+added_arr[i];

				  }

				  

			  }

			  

		  }

		  

		 	  

		  if(added_arr.length-1 == 0){

		  	document.getElementById("sec_text_sin").innerHTML = '';

		  }

		  

		  $("#added_items").val(nw); 

		  

		  $("#sp_"+ID).remove();

		  $("#is_selected_"+ID).val(0);

		  $("#div_"+ID).removeClass('set_background'); 

		  

		  

		  // ADD NEW

		  //alert($("div").find("#ALLSP_"+event_id).html());

		  if($("div").find("#ALLSP_"+event_id).html()==''){

			$("#TM_"+event_id).remove();

	   	  }

		  

		  /// For @ multiplication //

			odd_sum = 1;

			var added = $("#added_items").val();

			var added_arr = added.split("###");

			if( added != '') {  

				for( i = 0 ; i < added_arr.length; i++ ) {

				

				   var odd = $("#v1_"+added_arr[i]).val();

				   odd = parseFloat(odd);

				   odd_sum = odd_sum * odd;

				}	

			}else{

				odd_sum = 0.00;

			}

			odd_sum = odd_sum.toFixed(2);

			

			$("#total_odds").val(odd_sum);

		  ///

		  

		  

		  	var tip = $("#tip").html();

			if(tip==0){

				tip = 1;

			}else{

				tip --;

			}

			$("#tip").html(tip);

			

			/// TAX CALCULATION

			var tax = <?php echo $tax;?>;

			if(tax>0){

				tax = (total_stake * tax) / 100;

				tax = tax.toFixed(2);

				$("#tax").val(tax);

				total_stake = total_stake - tax;

				total_stake = total_stake.toFixed(2);

			}

			//alert(total_stake);

			

			var possible_winnings = parseFloat(odd_sum*total_stake);

			possible_winnings = possible_winnings.toFixed(2);

			$("#possible_winnings").val(possible_winnings);

			

			/////////

		   var event_id = $("#event_id_"+ID).val();

		   var sport = $("#sport_"+event_id).val();

		   sport--;

		   $("#sport_"+event_id).val(sport);

		   

		   if(event_arr.length==0){

			event_arr.push(event_id);

		   }

		   var flag = event_arr.indexOf(event_id); 

		   if(flag<0){

			event_arr.push(event_id);

		   }

		   //alert(event_arr.length);

		   var i = 1;

		   var j = 1;

		   var row = 1;

		   var k = 1;

		   for( i = 0 ; i < event_arr.length; i++ ) {	

				var sport_val = $("#sport_"+event_arr[i]).val();

				

				//alert(sport_val);	

				for( j = 1 ; j <= sport_val; j++ ) {

					row = k * j;

				} 

				k = row;

				

			}

			if(tip==0){

				row = 0;

			}

			

			$("#row").html(row);

		   ////////

		   

		   

		   

		   total_stake = parseFloat(0.50 * row);

		   if(total_stake==0.50){

			total_stake = parseFloat(1.00);

		   }

		   total_stake = total_stake.toFixed(2);

		   if(total_stake == 0.00){

		   	total_stake = '1.00';

		   }

		   

		   curr_total_stake = parseFloat($("#total_stake").html());

		   if(curr_total_stake < total_stake || flag_ts == 1){

			   $("#total_stake").html(total_stake);

			   flag_ts = 1;

		   }

		   //alert("2");

		   

		   

		   ////// Market

			var temp_market = [];

			var market_arr = $("#market_"+event_id).val();

			var market_arr = market_arr.split(",");

			for( i = 0 ; i < market_arr.length; i++ ) {

				if(market_arr[i]!=market_id){

					temp_market.push(market_arr[i]);

				}

			}

			//alert(temp_market);

			$("#market_"+event_id).val(temp_market);

			

			

			

			////// Market1

			var temp_market1 = [];

			var market1_arr = $("#market1_"+event_id).val();

			var market1_arr = market1_arr.split(",");

			for( i = 0 ; i < market1_arr.length; i++ ) {

				if(market1_arr[i]!=market_id){

					temp_market1.push(market1_arr[i]);

				}

			}

			//alert(temp_market);

			$("#market1_"+event_id).val(temp_market1);

			

			////// Market2

			var temp_market2 = [];

			var market2_arr = $("#market2_"+event_id).val();

			var market2_arr = market2_arr.split(",");

			for( i = 0 ; i < market2_arr.length; i++ ) {

				if(market2_arr[i]!=market_id){

					temp_market2.push(market2_arr[i]);

				}

			}

			//alert(temp_market2);

			$("#market2_"+event_id).val(temp_market2);

			

			

			///// Market 3

			var temp_market3 = [];

			var market3_arr = $("#market3_"+event_id).val();

			var market3_arr = market3_arr.split(",");

			for( i = 0 ; i < market3_arr.length; i++ ) {

				if(market3_arr[i]!=market_id){

					temp_market3.push(market3_arr[i]);

				}

			}

			$("#market3_"+event_id).val(temp_market3);

			

			///// Market 4

			var temp_market4 = [];

			var market4_arr = $("#market4_"+event_id).val();

			var market4_arr = market4_arr.split(",");

			for( i = 0 ; i < market4_arr.length; i++ ) {

				if(market4_arr[i]!=market_id){

					temp_market4.push(market4_arr[i]);

				}

			}

			$("#market4_"+event_id).val(temp_market4);		

			

			///// Market 5

			var temp_market5 = [];

			var market5_arr = $("#market5_"+event_id).val();

			var market5_arr = market5_arr.split(",");

			for( i = 0 ; i < market5_arr.length; i++ ) {

				if(market5_arr[i]!=market_id){

					temp_market5.push(market5_arr[i]);

				}

			}

			$("#market5_"+event_id).val(temp_market5);	

			

			///// Market 6

			var temp_market6 = [];

			var market6_arr = $("#market6_"+event_id).val();

			var market6_arr = market6_arr.split(",");

			for( i = 0 ; i < market6_arr.length; i++ ) {

				if(market6_arr[i]!=market_id){

					temp_market6.push(market6_arr[i]);

				}

			}

			$("#market6_"+event_id).val(temp_market6);	

			

			////// Market 7

			var temp_market7 = [];

			var market7_arr = $("#market7_"+event_id).val();

			var market7_arr = market7_arr.split(",");

			for( i = 0 ; i < market7_arr.length; i++ ) {

				if(market7_arr[i]!=market_id){

					temp_market7.push(market7_arr[i]);

				}

			}

			$("#market7_"+event_id).val(temp_market7);

			

			////// Market 8

			var temp_market8 = [];

			var market8_arr = $("#market8_"+event_id).val();

			var market8_arr = market8_arr.split(",");

			for( i = 0 ; i < market8_arr.length; i++ ) {

				if(market8_arr[i]!=market_id){

					temp_market8.push(market8_arr[i]);

				}

			}

			$("#market8_"+event_id).val(temp_market8);

		

		   

		   /*//// Max Odds

			var max_val = 0;

			var temp_ar = [];

			var max_arr = $("#max_"+event_id).val();

			var max_arr = max_arr.split(",");

			for( i = 0 ; i < max_arr.length; i++ ) {

				if(max_arr[i]!=ratio){

					temp_ar.push(max_arr[i]);

				}

			}

			//alert(temp_ar);

			$("#max_"+event_id).val(temp_ar);

			

			///

			

			var max_odds = $("#max_"+event_id).val();

			

			var odds_arr = max_odds.split(",");

			//alert(odds_arr.length);

			for( j = 0 ; j < odds_arr.length; j++ ) {

				if(max_val < odds_arr[j]){

					max_val = odds_arr[j];

				}

			}

			//alert(max_val);

			$("#maximum_"+event_id).val(max_val);

			

			var mul_odds = 1;

			

			///////	*/

			

			

			

			

			

			

			/*///////// Ext. Multiway

			var tip = $("#tip_"+ID).html();

			var max_rest = 0;

			var max_ou = 0;

			var max_o = 0;

			var ext_odds = 1;

			var flag_ext = 0;

			

	

			var temp_rest = [];

			var temp_ou = [];

			

			if(market_code=='1x2'){

				//alert('1X2');

				var rest_odd = $("#rest_"+event_id).val();

			

				var rest_arr = rest_odd.split(",");

				for( i = 0 ; i < rest_arr.length; i++ ) {

					if(rest_arr[i]!=ratio){

						temp_rest.push(rest_arr[i]);

					}

				}

				//alert(temp_ar);

				$("#rest_"+event_id).val(temp_rest);

			

			

			

				var rest_odd = $("#rest_"+event_id).val();

				var rest_arr = rest_odd.split(",");

				//alert(rest_arr.length);

				for( j = 0 ; j < rest_arr.length; j++ ) {

					if(max_rest < rest_arr[j]){

						max_rest = rest_arr[j];

					}

				}

				//alert(max_rest);

				$("#rest_hi_"+event_id).val(max_rest);

				

			}

			if(market_code=='OU'){

				//alert('OU');

				var ou_odd = $("#ou_"+event_id).val();

				

				var ou_arr = ou_odd.split(",");

				for( i = 0 ; i < ou_arr.length; i++ ) {

					if(ou_arr[i]!=ratio){

						temp_ou.push(ou_arr[i]);

					}

				}

				//alert(temp_ar);

				$("#ou_"+event_id).val(temp_ou);

				

				

				var ou_odd = $("#ou_"+event_id).val();

				var ou_arr = ou_odd.split(",");

				//alert(rest_arr.length);

				for( j = 0 ; j < ou_arr.length; j++ ) {

					if(max_ou < ou_arr[j]){

						max_ou = ou_arr[j];

					}

				}

				//alert(max_rest);

				$("#ou_hi_"+event_id).val(max_ou);

			}

			

			if(market_code=='EH'){

				//alert('EH');

				var temp_eh = [];

				max_o = 0;

				var eh_odd = $("#eh_"+event_id).val();

				

				var eh_arr = eh_odd.split(",");

				for( i = 0 ; i < eh_arr.length; i++ ) {

					if(eh_arr[i]!=ratio){

						temp_eh.push(eh_arr[i]);

					}

				}

				//alert(temp_ar);

				$("#eh_"+event_id).val(temp_eh);

				

				

				var eh_odd = $("#eh_"+event_id).val();

				var eh_arr = eh_odd.split(",");

				//alert(eh_arr);

				for( j = 0 ; j < eh_arr.length; j++ ) {

					if(max_o < parseFloat(eh_arr[j])){

						max_o = parseFloat(eh_arr[j]);

					}

				}

				//alert(max_rest);

				$("#eh_hi_"+event_id).val(max_o);

			}

			

			

			if(market_code=='DC'){

				var temp_dc = [];

				max_o = 0;

				var dc_odd = $("#dc_"+event_id).val();

				

				var dc_arr = dc_odd.split(",");

				for( i = 0 ; i < dc_arr.length; i++ ) {

					if(dc_arr[i]!=ratio){

						temp_dc.push(dc_arr[i]);

					}

				}

				$("#dc_"+event_id).val(temp_dc);

				

				var dc_odd = $("#dc_"+event_id).val();

				var dc_arr = dc_odd.split(",");

				for( j = 0 ; j < dc_arr.length; j++ ) {

					if(max_o < dc_arr[j]){

						max_o = dc_arr[j];

					}

				}

				$("#dc_hi_"+event_id).val(max_o);

			}

			

			

			

			if(market_code=='BTS'){

				var temp_bts = [];

				max_o = 0;

				var bts_odd = $("#bts_"+event_id).val();

				

				var bts_arr = bts_odd.split(",");

				for( i = 0 ; i < bts_arr.length; i++ ) {

					if(bts_arr[i]!=ratio){

						temp_bts.push(bts_arr[i]);

					}

				}

				$("#bts_"+event_id).val(temp_bts);

				

				var bts_odd = $("#bts_"+event_id).val();

				var bts_arr = bts_odd.split(",");

				for( j = 0 ; j < bts_arr.length; j++ ) {

					if(max_o < bts_arr[j]){

						max_o = bts_arr[j];

					}

				}

				$("#bts_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='DNB'){

				var temp_dnb = [];

				max_o = 0;

				var dnb_odd = $("#dnb_"+event_id).val();

				

				var dnb_arr = dnb_odd.split(",");

				for( i = 0 ; i < dnb_arr.length; i++ ) {

					if(dnb_arr[i]!=ratio){

						temp_dnb.push(dnb_arr[i]);

					}

				}

				$("#dnb_"+event_id).val(temp_dnb);

				

				var dnb_odd = $("#dnb_"+event_id).val();

				var dnb_arr = dnb_odd.split(",");

				for( j = 0 ; j < dnb_arr.length; j++ ) {

					if(max_o < dnb_arr[j]){

						max_o = dnb_arr[j];

					}

				}

				$("#dnb_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='HTFT'){

				var temp_htft = [];

				max_o = 0;

				var htft_odd = $("#htft_"+event_id).val();

				

				var htft_arr = htft_odd.split(",");

				for( i = 0 ; i < htft_arr.length; i++ ) {

					if(htft_arr[i]!=ratio){

						temp_htft.push(htft_arr[i]);

					}

				}

				$("#htft_"+event_id).val(temp_htft);

				

				var htft_odd = $("#htft_"+event_id).val();

				var htft_arr = htft_odd.split(",");

				for( j = 0 ; j < htft_arr.length; j++ ) {

					if(max_o < htft_arr[j]){

						max_o = htft_arr[j];

					}

				}

				$("#htft_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='BTS_H1'){

				var temp_btsh1 = [];

				max_o = 0;

				var btsh1_odd = $("#btsh1_"+event_id).val();

				

				var btsh1_arr = btsh1_odd.split(",");

				for( i = 0 ; i < btsh1_arr.length; i++ ) {

					if(btsh1_arr[i]!=ratio){

						temp_btsh1.push(btsh1_arr[i]);

					}

				}

				$("#btsh1_"+event_id).val(temp_btsh1);

				

				var btsh1_odd = $("#btsh1_"+event_id).val();

				var btsh1_arr = btsh1_odd.split(",");

				for( j = 0 ; j < btsh1_arr.length; j++ ) {

					if(max_o < btsh1_arr[j]){

						max_o = btsh1_arr[j];

					}

				}

				$("#btsh1_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='FTS_3W'){

				var temp_fts3w = [];

				max_o = 0;

				var fts3w_odd = $("#fts3w_"+event_id).val();

				

				var fts3w_arr = fts3w_odd.split(",");

				for( i = 0 ; i < fts3w_arr.length; i++ ) {

					if(fts3w_arr[i]!=ratio){

						temp_fts3w.push(fts3w_arr[i]);

					}

				}

				$("#fts3w_"+event_id).val(temp_fts3w);

				

				var fts3w_odd = $("#fts3w_"+event_id).val();

				var fts3w_arr = fts3w_odd.split(",");

				for( j = 0 ; j < fts3w_arr.length; j++ ) {

					if(max_o < fts3w_arr[j]){

						max_o = fts3w_arr[j];

					}

				}

				$("#fts3w_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='LTS_3W'){

				var temp_lts3w = [];

				max_o = 0;

				var lts3w_odd = $("#lts3w_"+event_id).val();

				

				var lts3w_arr = lts3w_odd.split(",");

				for( i = 0 ; i < lts3w_arr.length; i++ ) {

					if(lts3w_arr[i]!=ratio){

						temp_lts3w.push(lts3w_arr[i]);

					}

				}

				$("#lts3w_"+event_id).val(temp_lts3w);

				

				var lts3w_odd = $("#lts3w_"+event_id).val();

				var lts3w_arr = lts3w_odd.split(",");

				for( j = 0 ; j < lts3w_arr.length; j++ ) {

					if(max_o < lts3w_arr[j]){

						max_o = lts3w_arr[j];

					}

				}

				$("#lts3w_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='TSG_T1'){

				var temp_tsgt1 = [];

				max_o = 0;

				var tsgt1_odd = $("#tsgt1_"+event_id).val();

				

				var tsgt1_arr = tsgt1_odd.split(",");

				for( i = 0 ; i < tsgt1_arr.length; i++ ) {

					if(tsgt1_arr[i]!=ratio){

						temp_tsgt1.push(tsgt1_arr[i]);

					}

				}

				$("#tsgt1_"+event_id).val(temp_tsgt1);

				

				var tsgt1_odd = $("#tsgt1_"+event_id).val();

				var tsgt1_arr = tsgt1_odd.split(",");

				for( j = 0 ; j < tsgt1_arr.length; j++ ) {

					if(max_o < tsgt1_arr[j]){

						max_o = tsgt1_arr[j];

					}

				}

				$("#tsgt1_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='TSG_T2'){

				var temp_tsgt2 = [];

				max_o = 0;

				var tsgt2_odd = $("#tsgt2_"+event_id).val();

				

				var tsgt2_arr = tsgt2_odd.split(",");

				for( i = 0 ; i < tsgt2_arr.length; i++ ) {

					if(tsgt2_arr[i]!=ratio){

						temp_tsgt2.push(tsgt2_arr[i]);

					}

				}

				$("#tsgt2_"+event_id).val(temp_tsgt2);

				

				var tsgt2_odd = $("#tsgt2_"+event_id).val();

				var tsgt2_arr = tsgt2_odd.split(",");

				for( j = 0 ; j < tsgt2_arr.length; j++ ) {

					if(max_o < tsgt2_arr[j]){

						max_o = tsgt2_arr[j];

					}

				}

				$("#tsgt2_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='1x2_H1'){

				var temp_oh1 = [];

				max_o = 0;

				var oh1_odd = $("#oh1_"+event_id).val();

				

				var oh1_arr = oh1_odd.split(",");

				for( i = 0 ; i < oh1_arr.length; i++ ) {

					if(oh1_arr[i]!=ratio){

						temp_oh1.push(oh1_arr[i]);

					}

				}

				$("#oh1_"+event_id).val(temp_oh1);

				

				var oh1_odd = $("#oh1_"+event_id).val();

				var oh1_arr = oh1_odd.split(",");

				for( j = 0 ; j < oh1_arr.length; j++ ) {

					if(max_o < oh1_arr[j]){

						max_o = oh1_arr[j];

					}

				}

				$("#oh1_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='1x2_H2'){

				var temp_oh2 = [];

				max_o = 0;

				var oh2_odd = $("#oh2_"+event_id).val();

				

				var oh2_arr = oh2_odd.split(",");

				for( i = 0 ; i < oh2_arr.length; i++ ) {

					if(oh2_arr[i]!=ratio){

						temp_oh2.push(oh2_arr[i]);

					}

				}

				$("#oh2_"+event_id).val(temp_oh2);

				

				var oh2_odd = $("#oh2_"+event_id).val();

				var oh2_arr = oh2_odd.split(",");

				for( j = 0 ; j < oh2_arr.length; j++ ) {

					if(max_o < oh2_arr[j]){

						max_o = oh2_arr[j];

					}

				}

				$("#oh2_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='CS'){

				var temp_cs = [];

				max_o = 0;

				var cs_odd = $("#cs_"+event_id).val();

				

				var cs_arr = cs_odd.split(",");

				for( i = 0 ; i < cs_arr.length; i++ ) {

					if(cs_arr[i]!=ratio){

						temp_cs.push(cs_arr[i]);

					}

				}

				$("#cs_"+event_id).val(temp_cs);

				

				var cs_odd = $("#cs_"+event_id).val();

				var cs_arr = cs_odd.split(",");

				for( j = 0 ; j < cs_arr.length; j++ ) {

					if(max_o < cs_arr[j]){

						max_o = cs_arr[j];

					}

				}

				$("#cs_hi_"+event_id).val(max_o);

			}

			

			

			

			

			if(market_code=='HA' || market_code=='HA_OT'){

				var temp_ha = [];

				max_o = 0;

				var ha_odd = $("#ha_"+event_id).val();

				

				var ha_arr = ha_odd.split(",");

				for( i = 0 ; i < ha_arr.length; i++ ) {

					if(ha_arr[i]!=ratio){

						temp_ha.push(ha_arr[i]);

					}

				}

				$("#ha_"+event_id).val(temp_ha);

				

				var ha_odd = $("#ha_"+event_id).val();

				var ha_arr = ha_odd.split(",");

				for( j = 0 ; j < ha_arr.length; j++ ) {

					if(max_o < ha_arr[j]){

						max_o = ha_arr[j];

					}

				}

				$("#ha_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='OU_OT'){

				var temp_ouot = [];

				max_o = 0;

				var ouot_odd = $("#ouot_"+event_id).val();

				

				var ouot_arr = ouot_odd.split(",");

				for( i = 0 ; i < ouot_arr.length; i++ ) {

					if(ouot_arr[i]!=ratio){

						temp_ouot.push(ouot_arr[i]);

					}

				}

				$("#ouot_"+event_id).val(temp_ouot);

				

				var ouot_odd = $("#ouot_"+event_id).val();

				var ouot_arr = ouot_odd.split(",");

				for( j = 0 ; j < ouot_arr.length; j++ ) {

					if(max_o < ouot_arr[j]){

						max_o = ouot_arr[j];

					}

				}

				$("#ouot_hi_"+event_id).val(max_o);

			}*/

			

			

			

			var ext_odds = 1;

			var flag_new = 0;

			//var ext_odd = 0;

			var flag_new = 0;

			for( i = 0 ; i < event_arr.length; i++ ) {	

				var ext_odd = 0;

				var flag_ext = 0;

				

				var max_oddval = 0;

				var market1 = $("#market1_"+event_arr[i]).val();

				//alert(market1);

				var market1_arr = market1.split(",");

				for( j = 0 ; j < market1_arr.length; j++ ) {

				

					var market1_hi = parseFloat($("#"+market1_arr[j]).html());

					if(max_oddval < market1_hi){

						max_oddval = market1_hi;

					}

				}

				var market1_hi = max_oddval;

				//alert(market1_hi);

				

				max_oddval = 0;

				var market2 = $("#market2_"+event_arr[i]).val();

				var market2_arr = market2.split(",");

				for( j = 0 ; j < market2_arr.length; j++ ) {

				

					var market2_hi = parseFloat($("#"+market2_arr[j]).html());

					if(max_oddval < market2_hi){

						max_oddval = market2_hi;

					}

				}

				var market2_hi = max_oddval;

				

				max_oddval = 0;

				var market3 = $("#market3_"+event_arr[i]).val();

				var market3_arr = market3.split(",");

				for( j = 0 ; j < market3_arr.length; j++ ) {

				

					var market3_hi = parseFloat($("#"+market3_arr[j]).html());

					if(max_oddval < market3_hi){

						max_oddval = market3_hi;

					}

				}

				var market3_hi = max_oddval;

				

				max_oddval = 0;

				var market4 = $("#market4_"+event_arr[i]).val();

				var market4_arr = market4.split(",");

				for( j = 0 ; j < market4_arr.length; j++ ) {

				

					var market4_hi = parseFloat($("#"+market4_arr[j]).html());

					if(max_oddval < market4_hi){

						max_oddval = market4_hi;

					}

				}

				var market4_hi = max_oddval;

				

				max_oddval = 0;

				var market5 = $("#market5_"+event_arr[i]).val();

				var market5_arr = market5.split(",");

				for( j = 0 ; j < market5_arr.length; j++ ) {

				

					var market5_hi = parseFloat($("#"+market5_arr[j]).html());

					if(max_oddval < market5_hi){

						max_oddval = market5_hi;

					}

				}

				var market5_hi = max_oddval;

				

				max_oddval = 0;

				var market6 = $("#market6_"+event_arr[i]).val();

				var market6_arr = market6.split(",");

				for( j = 0 ; j < market6_arr.length; j++ ) {

				

					var market6_hi = parseFloat($("#"+market6_arr[j]).html());

					if(max_oddval < market6_hi){

						max_oddval = market6_hi;

					}

				}

				var market6_hi = max_oddval;

				

				max_oddval = 0;

				var market7 = $("#market7_"+event_arr[i]).val();

				var market7_arr = market7.split(",");

				for( j = 0 ; j < market7_arr.length; j++ ) {

				

					var market7_hi = parseFloat($("#"+market7_arr[j]).html());

					if(max_oddval < market7_hi){

						max_oddval = market7_hi;

					}

				}

				var market7_hi = max_oddval;

				

				max_oddval = 0;

				var market8 = $("#market8_"+event_arr[i]).val();

				var market8_arr = market8.split(",");

				for( j = 0 ; j < market8_arr.length; j++ ) {

				

					var market8_hi = parseFloat($("#"+market8_arr[j]).html());

					if(max_oddval < market8_hi){

						max_oddval = market8_hi;

					}

				}

				var market8_hi = max_oddval;

				

				

				

				if(market1_hi!=0){

					flag_ext++;

					ext_odd = parseFloat(ext_odd + market1_hi);

				} if(market2_hi!=0){

					flag_ext++;

					ext_odd = parseFloat(ext_odd + market2_hi);

				} if(market3_hi!=0){

					flag_ext++;

					ext_odd = parseFloat(ext_odd + market3_hi);

				} if(market4_hi!=0){

					flag_ext++;

					ext_odd = parseFloat(ext_odd + market4_hi);

				} if(market5_hi!=0){

					flag_ext++;

					ext_odd = parseFloat(ext_odd + market5_hi);

				} if(market6_hi!=0){

					flag_ext++;

					ext_odd = parseFloat(ext_odd + market6_hi);

				} if(market7_hi!=0){

					flag_ext++;

					ext_odd = parseFloat(ext_odd + market7_hi);

				} if(market8_hi!=0){

					flag_ext++;

					ext_odd = parseFloat(ext_odd + market8_hi);

				}

					

				

				

				///

				if(ext_odd!=0){

					ext_odds = parseFloat(ext_odds * ext_odd);

				}

				

				if(flag_ext>1){

					flag_new = 1;

				}

				

			 }

			 

			 //alert(ext_odds);

			 

			////

			var bettype = $("#bet_type").val();

			if(bettype== 'Multiway' || bettype== 'Ext. Multiway'){

				var totalstake = $("#total_stake").html();

				if(totalstake<2){

					$("#total_stake").html('2.00');

				}

				

				/// New Add

				ext_odds = ext_odds.toFixed(2);

				$("#total_odds").val(ext_odds);

				

				var total_stake = $("#total_stake").html();

				

				/// TAX CALCULATION

				var tax = <?php echo $tax;?>;

				if(tax>0){

					tax = (total_stake * tax) / 100;

					tax = tax.toFixed(2);

					$("#tax").val(tax);

					total_stake = total_stake - tax;

					total_stake = total_stake.toFixed(2);

				}

				//alert(total_stake);

				

				var tr = parseFloat(total_stake) / parseFloat(row);

				var possible_winnings = parseFloat(ext_odds*tr);

				possible_winnings = possible_winnings.toFixed(2);

				$("#possible_winnings").val(possible_winnings);

				

			}

			 

			 

			 //alert(flag_ext);

			 if(flag_new==1){

				$("#bet_type").val("Ext. Multiway");

				type = 'Ext. Multiway';

				var total_stake_new = $("#total_stake").html();

				

				ext_odds = ext_odds.toFixed(2);

				$("#total_odds").val(ext_odds);

				

				/// TAX CALCULATION

				var tax = <?php echo $tax;?>;

				if(tax>0){

					tax = (total_stake_new * tax) / 100;

					tax = tax.toFixed(2);

					$("#tax").val(tax);

					total_stake_new = total_stake_new - tax;

					total_stake_new = total_stake_new.toFixed(2);

				}

				//alert(total_stake);

				

				var tr = parseFloat(total_stake_new) / parseFloat(row);

				var possible_winnings = parseFloat(ext_odds*tr);

				possible_winnings = possible_winnings.toFixed(2);

				$("#possible_winnings").val(possible_winnings);

			 }

			////////

			

			

			

			

			

			

			

			

			  

		   //do_beting_total_stake();

		   var curr_tip = $("#tip").html();

		    if(curr_tip==0){

				$("#bet_type").val("");

			}

			

			

			

			

			

			

			

			

			

			

			

			

			

			

			

			

			

			

			

			/// For Select Bet

			//var MID_ARR = [];

			var added = $("#added_items").val();

			var added_arr = added.split("###");

			if( added != '') {  

				for( i = 0 ; i < added_arr.length; i++ ) {

				

				   var odd = $("#v1_"+added_arr[i]).val();

				   odd = parseFloat(odd);

				   odd_sum = odd_sum * odd;

				   

				   //var MID = $("#MI_"+added_arr[i]).val();

				   //MID_ARR.push(MID);

				}

				

				

				$.ajax({  

				type: "POST",  

				data: "&MID_ARR=" + MID_ARR , 

				url: "ajax_select_bet.php"

				});

				

			}


			

	   }

	   
	   	var slip_content = $("#list_content").html();
		//alert(escape(slip_content));
		setSession(escape(slip_content));

   }

   
   

   

    function do_close(ID)

	{	

		//alert(ID);

		////// For ACC

		 var total_stake = $("#total_stake").html();

		 var text = $("#TEX_"+ID).val();

	   	 var ratio = $("#RAT_"+ID).val();

		 var tip = $("#TP_"+ID).val();

		 var market_id = $("#MI_"+ID).val();

		 

		 var market_code = $("#MC_"+ID).val();

		 var extra = $("#EXT_"+ID).val(); 

		 

		 var event_id = $("#EVENT_"+ID).val();



		 //var event_id = $("#event_id_"+ID).val();

 		 var tm = $("#TEM_"+ID).val();

		 

		 

		 //////// ADD ACTIVE SELECT

		 var mi_arr_pos = mi_arr.indexOf(market_id); 

		 mi_arr.splice(mi_arr_pos, 1);

		 $.ajax({  

			type: "POST",  

			data: "&mi_arr=" + mi_arr, 

			url: "ajax_active_bet.php"

			});

			

			

			

			

		 

 		 var acc_pos = acc.indexOf(tm); 

		 acc.splice(acc_pos, 1);

		 //alert(acc.length);

		 

		var long_arr = 0;

		for( i = 0 ; i < acc.length; i++ ) {

			for( j = i+1 ; j < acc.length; j++ ) {

				if( acc[i] == acc[j] ) {

					long_arr = 1;

				}  

			}

		}

		

		

	   if(acc.length >1 && long_arr == 0){

		  $("#bet_type").val("Combinations");

		  type = 'Combinations';

	   }

	   if(long_arr == 1){

		  $("#bet_type").val("Multiway");

		  type = 'Multiway';

	   }

	   if(acc.length==1){

	      $("#bet_type").val("Single");

		  type = 'Single';

	   }

	   

	   ///////////

		  

		   

		  var added = $("#added_items").val();

		  var added_arr = added.split("###");

		  var nw = '';

		  

		  for( i = 0 ; i < added_arr.length; i++ ) {

			 // alert(added_arr[i]);

			  if( added_arr[i] != ID ) {

				  

				  if( nw == '' ) {

					   nw = added_arr[i];

				  } else {

					   nw = nw+"###"+added_arr[i];

				  }

				  

			  }

			  

		  }

		  

		 	  

		  if(added_arr.length-1 == 0){

		  	document.getElementById("sec_text_sin").innerHTML = '';

		  }

		  

		  $("#added_items").val(nw); 

		  

		  $("#sp_"+ID).remove();

		  $("#is_selected_"+ID).val(0);

		  $("#div_"+ID).removeClass('set_background'); 

		  

		  

		  // ADD NEW

		  //alert($("div").find("#ALLSP_"+event_id).html());

		  if($("div").find("#ALLSP_"+event_id).html()==''){

			$("#TM_"+event_id).remove();

	   	  }

		  

		  /// For @ multiplication //

		  	odd_sum = 1;

			var added = $("#added_items").val();

		    var added_arr = added.split("###");

			if( added != '') {  

				for( i = 0 ; i < added_arr.length; i++ ) {

				

				   var odd = $("#v1_"+added_arr[i]).val();

				   odd = parseFloat(odd);

				   odd_sum = odd_sum * odd;

				}	

			}else{

				odd_sum = 0.00;

			}

			odd_sum = odd_sum.toFixed(2);

			

			$("#total_odds").val(odd_sum);

		  ///

		  

		  

		  	var tip = $("#tip").html();

			if(tip==0){

				tip = 1;

			}else{

				tip --;

			}

			$("#tip").html(tip);

			

			/// TAX CALCULATION

			var tax = <?php echo $tax;?>;

			if(tax>0){

				tax = (total_stake * tax) / 100;

				tax = tax.toFixed(2);

				$("#tax").val(tax);

				total_stake = total_stake - tax;

				total_stake = total_stake.toFixed(2);

			}

			//alert(total_stake);

			

			var possible_winnings = parseFloat(odd_sum*total_stake);

			possible_winnings = possible_winnings.toFixed(2);

			$("#possible_winnings").val(possible_winnings);

			

			/////////

		   //alert(event_id);

		   var sport = $("#sport_"+event_id).val();

		   sport--;

		   $("#sport_"+event_id).val(sport);

		   

		   if(event_arr.length==0){

			event_arr.push(event_id);

		   }

		   var flag = event_arr.indexOf(event_id); 

		   if(flag<0){

			event_arr.push(event_id);

		   }

		   //alert(event_arr.length);

		   var i = 1;

		   var j = 1;

		   var row = 1;

		   var k = 1;

		   for( i = 0 ; i < event_arr.length; i++ ) {	

				var sport_val = $("#sport_"+event_arr[i]).val();

				

				//alert(sport_val);	

				for( j = 1 ; j <= sport_val; j++ ) {

					row = k * j;

				} 

				k = row;

				

			}

			if(tip==0){

				row = 0;

			}

			

			$("#row").html(row);

		   ////////

		   

		   

		   total_stake = parseFloat(0.50 * row);

		   if(total_stake==0.50){

			total_stake = parseFloat(1.00);

		   }

		   total_stake = total_stake.toFixed(2);

		   if(total_stake == 0.00){

		   	total_stake = '1.00';

		   }

		   

		   curr_total_stake = parseFloat($("#total_stake").html());

		   if(curr_total_stake < total_stake || flag_ts == 1){

			   $("#total_stake").html(total_stake);

			   flag_ts = 1;

		   }

		   //alert("3");

		  

		   

		  

		   ////// Market

			var temp_market = [];

			var market_arr = $("#market_"+event_id).val();

			var market_arr = market_arr.split(",");

			for( i = 0 ; i < market_arr.length; i++ ) {

				if(market_arr[i]!=market_id){

					temp_market.push(market_arr[i]);

				}

			}

			//alert(temp_market);

			$("#market_"+event_id).val(temp_market);

			

			

			////// Market1

			var temp_market1 = [];

			var market1_arr = $("#market1_"+event_id).val();

			var market1_arr = market1_arr.split(",");

			for( i = 0 ; i < market1_arr.length; i++ ) {

				if(market1_arr[i]!=market_id){

					temp_market1.push(market1_arr[i]);

				}

			}

			//alert(temp_market);

			$("#market1_"+event_id).val(temp_market1);

			

			////// Market2

			var temp_market2 = [];

			var market2_arr = $("#market2_"+event_id).val();

			var market2_arr = market2_arr.split(",");

			for( i = 0 ; i < market2_arr.length; i++ ) {

				if(market2_arr[i]!=market_id){

					temp_market2.push(market2_arr[i]);

				}

			}

			//alert(temp_market2);

			$("#market2_"+event_id).val(temp_market2);

			

			

			///// Market 3

			var temp_market3 = [];

			var market3_arr = $("#market3_"+event_id).val();

			var market3_arr = market3_arr.split(",");

			for( i = 0 ; i < market3_arr.length; i++ ) {

				if(market3_arr[i]!=market_id){

					temp_market3.push(market3_arr[i]);

				}

			}

			$("#market3_"+event_id).val(temp_market3);

			

			///// Market 4

			var temp_market4 = [];

			var market4_arr = $("#market4_"+event_id).val();

			var market4_arr = market4_arr.split(",");

			for( i = 0 ; i < market4_arr.length; i++ ) {

				if(market4_arr[i]!=market_id){

					temp_market4.push(market4_arr[i]);

				}

			}

			$("#market4_"+event_id).val(temp_market4);		

			

			///// Market 5

			var temp_market5 = [];

			var market5_arr = $("#market5_"+event_id).val();

			var market5_arr = market5_arr.split(",");

			for( i = 0 ; i < market5_arr.length; i++ ) {

				if(market5_arr[i]!=market_id){

					temp_market5.push(market5_arr[i]);

				}

			}

			$("#market5_"+event_id).val(temp_market5);	

			

			///// Market 6

			var temp_market6 = [];

			var market6_arr = $("#market6_"+event_id).val();

			var market6_arr = market6_arr.split(",");

			for( i = 0 ; i < market6_arr.length; i++ ) {

				if(market6_arr[i]!=market_id){

					temp_market6.push(market6_arr[i]);

				}

			}

			$("#market6_"+event_id).val(temp_market6);	

			

			////// Market 7

			var temp_market7 = [];

			var market7_arr = $("#market7_"+event_id).val();

			var market7_arr = market7_arr.split(",");

			for( i = 0 ; i < market7_arr.length; i++ ) {

				if(market7_arr[i]!=market_id){

					temp_market7.push(market7_arr[i]);

				}

			}

			$("#market7_"+event_id).val(temp_market7);

			

			////// Market 8

			var temp_market8 = [];

			var market8_arr = $("#market8_"+event_id).val();

			var market8_arr = market8_arr.split(",");

			for( i = 0 ; i < market8_arr.length; i++ ) {

				if(market8_arr[i]!=market_id){

					temp_market8.push(market8_arr[i]);

				}

			}

			$("#market8_"+event_id).val(temp_market8);

			

			

		   

		   /*//// Max Odds

			var max_val = 0;

			var temp_ar = [];

			var max_arr = $("#max_"+event_id).val();

			var max_arr = max_arr.split(",");

			for( i = 0 ; i < max_arr.length; i++ ) {

				if(max_arr[i]!=ratio){

					temp_ar.push(max_arr[i]);

				}

			}

			//alert(temp_ar);

			$("#max_"+event_id).val(temp_ar);

			

			///

			

			var max_odds = $("#max_"+event_id).val();

			

			var odds_arr = max_odds.split(",");

			//alert(odds_arr.length);

			for( j = 0 ; j < odds_arr.length; j++ ) {

				if(max_val < odds_arr[j]){

					max_val = odds_arr[j];

				}

			}

			//alert(max_val);

			$("#maximum_"+event_id).val(max_val);

			

			var mul_odds = 1;*/

			

			

			

			

			

			

			/*///////// Ext. Multiway

			//var tip = $("#tip_"+ID).html();

			var tip = $("#TP_"+ID).val();

			var max_rest = 0;

			var max_ou = 0;

			var max_o = 0;

			var ext_odds = 1;

			var flag_ext = 0;

			

	

			var temp_rest = [];

			var temp_ou = [];

			

			if(market_code=='1x2'){

				//alert('1X2');

				var rest_odd = $("#rest_"+event_id).val();

			

				var rest_arr = rest_odd.split(",");

				for( i = 0 ; i < rest_arr.length; i++ ) {

					if(rest_arr[i]!=ratio){

						temp_rest.push(rest_arr[i]);

					}

				}

				//alert(temp_ar);

				$("#rest_"+event_id).val(temp_rest);

			

			

			

				var rest_odd = $("#rest_"+event_id).val();

				var rest_arr = rest_odd.split(",");

				//alert(rest_arr.length);

				for( j = 0 ; j < rest_arr.length; j++ ) {

					if(max_rest < rest_arr[j]){

						max_rest = rest_arr[j];

					}

				}

				//alert(max_rest);

				$("#rest_hi_"+event_id).val(max_rest);

				

			}

			if(market_code=='OU'){

				//alert('OU');

				var ou_odd = $("#ou_"+event_id).val();

				

				var ou_arr = ou_odd.split(",");

				for( i = 0 ; i < ou_arr.length; i++ ) {

					if(ou_arr[i]!=ratio){

						temp_ou.push(ou_arr[i]);

					}

				}

				//alert(temp_ar);

				$("#ou_"+event_id).val(temp_ou);

				

				

				var ou_odd = $("#ou_"+event_id).val();

				var ou_arr = ou_odd.split(",");

				//alert(rest_arr.length);

				for( j = 0 ; j < ou_arr.length; j++ ) {

					if(max_ou < ou_arr[j]){

						max_ou = ou_arr[j];

					}

				}

				//alert(max_rest);

				$("#ou_hi_"+event_id).val(max_ou);

			}

			

			if(market_code=='EH'){

				//alert('EH');

				var temp_eh = [];

				max_o = 0;

				var eh_odd = $("#eh_"+event_id).val();

				

				var eh_arr = eh_odd.split(",");

				for( i = 0 ; i < eh_arr.length; i++ ) {

					if(eh_arr[i]!=ratio){

						temp_eh.push(eh_arr[i]);

					}

				}

				//alert(temp_ar);

				$("#eh_"+event_id).val(temp_eh);

				

				

				var eh_odd = $("#eh_"+event_id).val();

				var eh_arr = eh_odd.split(",");

				//alert(eh_arr);

				for( j = 0 ; j < eh_arr.length; j++ ) {

					if(max_o < parseFloat(eh_arr[j])){

						max_o = parseFloat(eh_arr[j]);

					}

				}

				//alert(max_rest);

				$("#eh_hi_"+event_id).val(max_o);

			}

			

			

			

			

			if(market_code=='DC'){

				var temp_dc = [];

				max_o = 0;

				var dc_odd = $("#dc_"+event_id).val();

				

				var dc_arr = dc_odd.split(",");

				for( i = 0 ; i < dc_arr.length; i++ ) {

					if(dc_arr[i]!=ratio){

						temp_dc.push(dc_arr[i]);

					}

				}

				$("#dc_"+event_id).val(temp_dc);

				

				var dc_odd = $("#dc_"+event_id).val();

				var dc_arr = dc_odd.split(",");

				for( j = 0 ; j < dc_arr.length; j++ ) {

					if(max_o < dc_arr[j]){

						max_o = dc_arr[j];

					}

				}

				$("#dc_hi_"+event_id).val(max_o);

			}

			

			

			

			if(market_code=='BTS'){

				var temp_bts = [];

				max_o = 0;

				var bts_odd = $("#bts_"+event_id).val();

				

				var bts_arr = bts_odd.split(",");

				for( i = 0 ; i < bts_arr.length; i++ ) {

					if(bts_arr[i]!=ratio){

						temp_bts.push(bts_arr[i]);

					}

				}

				$("#bts_"+event_id).val(temp_bts);

				

				var bts_odd = $("#bts_"+event_id).val();

				var bts_arr = bts_odd.split(",");

				for( j = 0 ; j < bts_arr.length; j++ ) {

					if(max_o < bts_arr[j]){

						max_o = bts_arr[j];

					}

				}

				$("#bts_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='DNB'){

				var temp_dnb = [];

				max_o = 0;

				var dnb_odd = $("#dnb_"+event_id).val();

				

				var dnb_arr = dnb_odd.split(",");

				for( i = 0 ; i < dnb_arr.length; i++ ) {

					if(dnb_arr[i]!=ratio){

						temp_dnb.push(dnb_arr[i]);

					}

				}

				$("#dnb_"+event_id).val(temp_dnb);

				

				var dnb_odd = $("#dnb_"+event_id).val();

				var dnb_arr = dnb_odd.split(",");

				for( j = 0 ; j < dnb_arr.length; j++ ) {

					if(max_o < dnb_arr[j]){

						max_o = dnb_arr[j];

					}

				}

				$("#dnb_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='HTFT'){

				var temp_htft = [];

				max_o = 0;

				var htft_odd = $("#htft_"+event_id).val();

				

				var htft_arr = htft_odd.split(",");

				for( i = 0 ; i < htft_arr.length; i++ ) {

					if(htft_arr[i]!=ratio){

						temp_htft.push(htft_arr[i]);

					}

				}

				$("#htft_"+event_id).val(temp_htft);

				

				var htft_odd = $("#htft_"+event_id).val();

				var htft_arr = htft_odd.split(",");

				for( j = 0 ; j < htft_arr.length; j++ ) {

					if(max_o < htft_arr[j]){

						max_o = htft_arr[j];

					}

				}

				$("#htft_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='BTS_H1'){

				var temp_btsh1 = [];

				max_o = 0;

				var btsh1_odd = $("#btsh1_"+event_id).val();

				

				var btsh1_arr = btsh1_odd.split(",");

				for( i = 0 ; i < btsh1_arr.length; i++ ) {

					if(btsh1_arr[i]!=ratio){

						temp_btsh1.push(btsh1_arr[i]);

					}

				}

				$("#btsh1_"+event_id).val(temp_btsh1);

				

				var btsh1_odd = $("#btsh1_"+event_id).val();

				var btsh1_arr = btsh1_odd.split(",");

				for( j = 0 ; j < btsh1_arr.length; j++ ) {

					if(max_o < btsh1_arr[j]){

						max_o = btsh1_arr[j];

					}

				}

				$("#btsh1_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='FTS_3W'){

				var temp_fts3w = [];

				max_o = 0;

				var fts3w_odd = $("#fts3w_"+event_id).val();

				

				var fts3w_arr = fts3w_odd.split(",");

				for( i = 0 ; i < fts3w_arr.length; i++ ) {

					if(fts3w_arr[i]!=ratio){

						temp_fts3w.push(fts3w_arr[i]);

					}

				}

				$("#fts3w_"+event_id).val(temp_fts3w);

				

				var fts3w_odd = $("#fts3w_"+event_id).val();

				var fts3w_arr = fts3w_odd.split(",");

				for( j = 0 ; j < fts3w_arr.length; j++ ) {

					if(max_o < fts3w_arr[j]){

						max_o = fts3w_arr[j];

					}

				}

				$("#fts3w_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='LTS_3W'){

				var temp_lts3w = [];

				max_o = 0;

				var lts3w_odd = $("#lts3w_"+event_id).val();

				

				var lts3w_arr = lts3w_odd.split(",");

				for( i = 0 ; i < lts3w_arr.length; i++ ) {

					if(lts3w_arr[i]!=ratio){

						temp_lts3w.push(lts3w_arr[i]);

					}

				}

				$("#lts3w_"+event_id).val(temp_lts3w);

				

				var lts3w_odd = $("#lts3w_"+event_id).val();

				var lts3w_arr = lts3w_odd.split(",");

				for( j = 0 ; j < lts3w_arr.length; j++ ) {

					if(max_o < lts3w_arr[j]){

						max_o = lts3w_arr[j];

					}

				}

				$("#lts3w_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='TSG_T1'){

				var temp_tsgt1 = [];

				max_o = 0;

				var tsgt1_odd = $("#tsgt1_"+event_id).val();

				

				var tsgt1_arr = tsgt1_odd.split(",");

				for( i = 0 ; i < tsgt1_arr.length; i++ ) {

					if(tsgt1_arr[i]!=ratio){

						temp_tsgt1.push(tsgt1_arr[i]);

					}

				}

				$("#tsgt1_"+event_id).val(temp_tsgt1);

				

				var tsgt1_odd = $("#tsgt1_"+event_id).val();

				var tsgt1_arr = tsgt1_odd.split(",");

				for( j = 0 ; j < tsgt1_arr.length; j++ ) {

					if(max_o < tsgt1_arr[j]){

						max_o = tsgt1_arr[j];

					}

				}

				$("#tsgt1_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='TSG_T2'){

				var temp_tsgt2 = [];

				max_o = 0;

				var tsgt2_odd = $("#tsgt2_"+event_id).val();

				

				var tsgt2_arr = tsgt2_odd.split(",");

				for( i = 0 ; i < tsgt2_arr.length; i++ ) {

					if(tsgt2_arr[i]!=ratio){

						temp_tsgt2.push(tsgt2_arr[i]);

					}

				}

				$("#tsgt2_"+event_id).val(temp_tsgt2);

				

				var tsgt2_odd = $("#tsgt2_"+event_id).val();

				var tsgt2_arr = tsgt2_odd.split(",");

				for( j = 0 ; j < tsgt2_arr.length; j++ ) {

					if(max_o < tsgt2_arr[j]){

						max_o = tsgt2_arr[j];

					}

				}

				$("#tsgt2_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='1x2_H1'){

				var temp_oh1 = [];

				max_o = 0;

				var oh1_odd = $("#oh1_"+event_id).val();

				

				var oh1_arr = oh1_odd.split(",");

				for( i = 0 ; i < oh1_arr.length; i++ ) {

					if(oh1_arr[i]!=ratio){

						temp_oh1.push(oh1_arr[i]);

					}

				}

				$("#oh1_"+event_id).val(temp_oh1);

				

				var oh1_odd = $("#oh1_"+event_id).val();

				var oh1_arr = oh1_odd.split(",");

				for( j = 0 ; j < oh1_arr.length; j++ ) {

					if(max_o < oh1_arr[j]){

						max_o = oh1_arr[j];

					}

				}

				$("#oh1_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='1x2_H2'){

				var temp_oh2 = [];

				max_o = 0;

				var oh2_odd = $("#oh2_"+event_id).val();

				

				var oh2_arr = oh2_odd.split(",");

				for( i = 0 ; i < oh2_arr.length; i++ ) {

					if(oh2_arr[i]!=ratio){

						temp_oh2.push(oh2_arr[i]);

					}

				}

				$("#oh2_"+event_id).val(temp_oh2);

				

				var oh2_odd = $("#oh2_"+event_id).val();

				var oh2_arr = oh2_odd.split(",");

				for( j = 0 ; j < oh2_arr.length; j++ ) {

					if(max_o < oh2_arr[j]){

						max_o = oh2_arr[j];

					}

				}

				$("#oh2_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='CS'){

				var temp_cs = [];

				max_o = 0;

				var cs_odd = $("#cs_"+event_id).val();

				

				var cs_arr = cs_odd.split(",");

				for( i = 0 ; i < cs_arr.length; i++ ) {

					if(cs_arr[i]!=ratio){

						temp_cs.push(cs_arr[i]);

					}

				}

				$("#cs_"+event_id).val(temp_cs);

				

				var cs_odd = $("#cs_"+event_id).val();

				var cs_arr = cs_odd.split(",");

				for( j = 0 ; j < cs_arr.length; j++ ) {

					if(max_o < cs_arr[j]){

						max_o = cs_arr[j];

					}

				}

				$("#cs_hi_"+event_id).val(max_o);

			}

			

			

			

			

			if(market_code=='HA' || market_code=='HA_OT'){

				var temp_ha = [];

				max_o = 0;

				var ha_odd = $("#ha_"+event_id).val();

				

				var ha_arr = ha_odd.split(",");

				for( i = 0 ; i < ha_arr.length; i++ ) {

					if(ha_arr[i]!=ratio){

						temp_ha.push(ha_arr[i]);

					}

				}

				$("#ha_"+event_id).val(temp_ha);

				

				var ha_odd = $("#ha_"+event_id).val();

				var ha_arr = ha_odd.split(",");

				for( j = 0 ; j < ha_arr.length; j++ ) {

					if(max_o < ha_arr[j]){

						max_o = ha_arr[j];

					}

				}

				$("#ha_hi_"+event_id).val(max_o);

			}

			

			if(market_code=='OU_OT'){

				var temp_ouot = [];

				max_o = 0;

				var ouot_odd = $("#ouot_"+event_id).val();

				

				var ouot_arr = ouot_odd.split(",");

				for( i = 0 ; i < ouot_arr.length; i++ ) {

					if(ouot_arr[i]!=ratio){

						temp_ouot.push(ouot_arr[i]);

					}

				}

				$("#ouot_"+event_id).val(temp_ouot);

				

				var ouot_odd = $("#ouot_"+event_id).val();

				var ouot_arr = ouot_odd.split(",");

				for( j = 0 ; j < ouot_arr.length; j++ ) {

					if(max_o < ouot_arr[j]){

						max_o = ouot_arr[j];

					}

				}

				$("#ouot_hi_"+event_id).val(max_o);

			}*/

			

			

			

			

			var ext_odds = 1;

			var flag_new = 0;

			//var ext_odd = 0;

			for( i = 0 ; i < event_arr.length; i++ ) {	

				var ext_odd = 0;

				var flag_ext = 0;

				

				var max_oddval = 0;

				var market1 = $("#market1_"+event_arr[i]).val();

				//alert(market1);

				var market1_arr = market1.split(",");

				for( j = 0 ; j < market1_arr.length; j++ ) {

				

					var market1_hi = parseFloat($("#"+market1_arr[j]).html());

					if(max_oddval < market1_hi){

						max_oddval = market1_hi;

					}

				}

				var market1_hi = max_oddval;

				//alert(market1_hi);

				

				max_oddval = 0;

				var market2 = $("#market2_"+event_arr[i]).val();

				var market2_arr = market2.split(",");

				for( j = 0 ; j < market2_arr.length; j++ ) {

				

					var market2_hi = parseFloat($("#"+market2_arr[j]).html());

					if(max_oddval < market2_hi){

						max_oddval = market2_hi;

					}

				}

				var market2_hi = max_oddval;

				

				max_oddval = 0;

				var market3 = $("#market3_"+event_arr[i]).val();

				var market3_arr = market3.split(",");

				for( j = 0 ; j < market3_arr.length; j++ ) {

				

					var market3_hi = parseFloat($("#"+market3_arr[j]).html());

					if(max_oddval < market3_hi){

						max_oddval = market3_hi;

					}

				}

				var market3_hi = max_oddval;

				

				max_oddval = 0;

				var market4 = $("#market4_"+event_arr[i]).val();

				var market4_arr = market4.split(",");

				for( j = 0 ; j < market4_arr.length; j++ ) {

				

					var market4_hi = parseFloat($("#"+market4_arr[j]).html());

					if(max_oddval < market4_hi){

						max_oddval = market4_hi;

					}

				}

				var market4_hi = max_oddval;

				

				max_oddval = 0;

				var market5 = $("#market5_"+event_arr[i]).val();

				var market5_arr = market5.split(",");

				for( j = 0 ; j < market5_arr.length; j++ ) {

				

					var market5_hi = parseFloat($("#"+market5_arr[j]).html());

					if(max_oddval < market5_hi){

						max_oddval = market5_hi;

					}

				}

				var market5_hi = max_oddval;

				

				max_oddval = 0;

				var market6 = $("#market6_"+event_arr[i]).val();

				var market6_arr = market6.split(",");

				for( j = 0 ; j < market6_arr.length; j++ ) {

				

					var market6_hi = parseFloat($("#"+market6_arr[j]).html());

					if(max_oddval < market6_hi){

						max_oddval = market6_hi;

					}

				}

				var market6_hi = max_oddval;

				

				max_oddval = 0;

				var market7 = $("#market7_"+event_arr[i]).val();

				var market7_arr = market7.split(",");

				for( j = 0 ; j < market7_arr.length; j++ ) {

				

					var market7_hi = parseFloat($("#"+market7_arr[j]).html());

					if(max_oddval < market7_hi){

						max_oddval = market7_hi;

					}

				}

				var market7_hi = max_oddval;

				

				max_oddval = 0;

				var market8 = $("#market8_"+event_arr[i]).val();

				var market8_arr = market8.split(",");

				for( j = 0 ; j < market8_arr.length; j++ ) {

				

					var market8_hi = parseFloat($("#"+market8_arr[j]).html());

					if(max_oddval < market8_hi){

						max_oddval = market8_hi;

					}

				}

				var market8_hi = max_oddval;

				

				

				

				if(market1_hi!=0){

					flag_ext++;

					ext_odd = parseFloat(ext_odd + market1_hi);

				} if(market2_hi!=0){

					flag_ext++;

					ext_odd = parseFloat(ext_odd + market2_hi);

				} if(market3_hi!=0){

					flag_ext++;

					ext_odd = parseFloat(ext_odd + market3_hi);

				} if(market4_hi!=0){

					flag_ext++;

					ext_odd = parseFloat(ext_odd + market4_hi);

				} if(market5_hi!=0){

					flag_ext++;

					ext_odd = parseFloat(ext_odd + market5_hi);

				} if(market6_hi!=0){

					flag_ext++;

					ext_odd = parseFloat(ext_odd + market6_hi);

				} if(market7_hi!=0){

					flag_ext++;

					ext_odd = parseFloat(ext_odd + market7_hi);

				} if(market8_hi!=0){

					flag_ext++;

					ext_odd = parseFloat(ext_odd + market8_hi);

				}

				

				

				

				///

				if(ext_odd!=0){

					ext_odds = parseFloat(ext_odds * ext_odd);

				}

				

				if(flag_ext>1){

					flag_new = 1;

				}

				

			 }

			 

			 

			 

			////

			var bettype = $("#bet_type").val();

			if(bettype== 'Multiway' || bettype== 'Ext. Multiway'){

				var totalstake = $("#total_stake").html();

				if(totalstake<2){

					$("#total_stake").html('2.00');

				}

				

				/// New Add

				ext_odds = ext_odds.toFixed(2);

				$("#total_odds").val(ext_odds);

				

				var total_stake = $("#total_stake").html();

				

				/// TAX CALCULATION

				var tax = <?php echo $tax;?>;

				if(tax>0){

					tax = (total_stake * tax) / 100;

					tax = tax.toFixed(2);

					$("#tax").val(tax);

					total_stake = total_stake - tax;

					total_stake = total_stake.toFixed(2);

				}

				//alert(total_stake);

				

				var tr = parseFloat(total_stake) / parseFloat(row);

				var possible_winnings = parseFloat(ext_odds*tr);

				possible_winnings = possible_winnings.toFixed(2);

				$("#possible_winnings").val(possible_winnings);

				

			}

			 

			 

			 //alert(flag_ext);

			 if(flag_new==1){

				$("#bet_type").val("Ext. Multiway");

				type = 'Ext. Multiway';

				var total_stake_new = $("#total_stake").html();

				

				ext_odds = ext_odds.toFixed(2);

				$("#total_odds").val(ext_odds);

				

				/// TAX CALCULATION

				var tax = <?php echo $tax;?>;

				if(tax>0){

					tax = (total_stake_new * tax) / 100;

					tax = tax.toFixed(2);

					$("#tax").val(tax);

					total_stake_new = total_stake_new - tax;

					total_stake_new = total_stake_new.toFixed(2);

				}

				//alert(total_stake_new);

				

				var tr = parseFloat(total_stake_new) / parseFloat(row);

				var possible_winnings = parseFloat(ext_odds*tr);

				possible_winnings = possible_winnings.toFixed(2);

				$("#possible_winnings").val(possible_winnings);

			 }

			////////

			

			

			

			

			

			

			

			

			  

		   //do_beting_total_stake();

		   var curr_tip = $("#tip").html();

		    if(curr_tip==0){

				$("#bet_type").val("");

			}

			

			

			

			

			

			

			

			

			/// For Select Bet

			//var MID_ARR = [];

			var added = $("#added_items").val();

			var added_arr = added.split("###");

			if( added != '') {  

				for( i = 0 ; i < added_arr.length; i++ ) {

				

				   var odd = $("#v1_"+added_arr[i]).val();

				   odd = parseFloat(odd);

				   odd_sum = odd_sum * odd;

				   

				   //var MID = $("#MI_"+added_arr[i]).val();

				   //MID_ARR.push(MID);

				}

				

				

				$.ajax({  

				type: "POST",  

				data: "&MID_ARR=" + MID_ARR , 

				url: "ajax_select_bet.php"

				});

				

			}

			

	}

     

	

   

</script>





<script>

function upd_slip(){

	//alert("upd_slip");

	odd_sum = 1;

	var total_stake = $("#total_stake").html();

	var added = $("#added_items").val();

	var event_arr = $("#event_arr").val();

	event_arr = event_arr.split(",");

	var row = $("#row").html();

	//alert(event_arr);

	

	/// TAX CALCULATION

	var tax = 0;

	if(tax>0){

		tax = (total_stake * tax) / 100;

		tax = tax.toFixed(2);

		$("#tax").val(tax);

		total_stake = total_stake - tax;

		total_stake = total_stake.toFixed(2);

	}

	//alert(total_stake);

		

	var added_arr = added.split("###");



	if( added != '') {  

		for( i = 0 ; i < added_arr.length; i++ ) {

		

		   var odd = $("#"+added_arr[i]).html();

		   odd = parseFloat(odd);

		   odd_sum = odd_sum * odd;

		}	

	}else{

		odd_sum = 0.00;

	}

	odd_sum = odd_sum.toFixed(2);

	$("#total_odds").val(odd_sum);

	///

	var bettype = $("#bet_type").val();



	var possible_winnings = parseFloat(odd_sum*total_stake);

	possible_winnings = possible_winnings.toFixed(2);

	$("#possible_winnings").val(possible_winnings);

	//alert(possible_winnings);

	

	var ext_odds = 1;

	var flag_new = 0;

	//var ext_odd = 0;

	for( i = 0 ; i < event_arr.length; i++ ) {	

		var ext_odd = 0;

		var flag_ext = 0;

		var max_oddval = 0;

		

		var market1 = $("#market1_"+event_arr[i]).val();

		//console.log("MARKET 1");

		//console.log(market1);

		var market1_arr = market1 == null ? [] :  market1.split(",");

		for( j = 0 ; j < market1_arr.length; j++ ) {

		

			var market1_hi = parseFloat($("#"+market1_arr[j]).html());

			if(max_oddval < market1_hi){

				max_oddval = market1_hi;

			}

		}

		var market1_hi = max_oddval;

		//alert(market1_hi);

		

		max_oddval = 0;

		var market2 = $("#market2_"+event_arr[i]).val();

		var market2_arr = market2 == null ? [] : market2.split(",");

		for( j = 0 ; j < market2_arr.length; j++ ) {

		

			var market2_hi = parseFloat($("#"+market2_arr[j]).html());

			if(max_oddval < market2_hi){

				max_oddval = market2_hi;

			}

		}

		var market2_hi = max_oddval;

		

		max_oddval = 0;

		var market3 = $("#market3_"+event_arr[i]).val();

		var market3_arr = market3 == null ? [] :  market3.split(",");

		for( j = 0 ; j < market3_arr.length; j++ ) {

		

			var market3_hi = parseFloat($("#"+market3_arr[j]).html());

			if(max_oddval < market3_hi){

				max_oddval = market3_hi;

			}

		}

		var market3_hi = max_oddval;

		

		max_oddval = 0;

		var market4 = $("#market4_"+event_arr[i]).val();

		var market4_arr = market4 == null ? [] : market4.split(",");

		for( j = 0 ; j < market4_arr.length; j++ ) {

		

			var market4_hi = parseFloat($("#"+market4_arr[j]).html());

			if(max_oddval < market4_hi){

				max_oddval = market4_hi;

			}

		}

		var market4_hi = max_oddval;

		

		max_oddval = 0;

		var market5 = $("#market5_"+event_arr[i]).val();

		var market5_arr = market5 == null ? [] :  market5.split(",");

		for( j = 0 ; j < market5_arr.length; j++ ) {

		

			var market5_hi = parseFloat($("#"+market5_arr[j]).html());

			if(max_oddval < market5_hi){

				max_oddval = market5_hi;

			}

		}

		var market5_hi = max_oddval;

		

		max_oddval = 0;

		var market6 = $("#market6_"+event_arr[i]).val();

		var market6_arr = market6 == null ? [] : market6.split(",");

		for( j = 0 ; j < market6_arr.length; j++ ) {

		

			var market6_hi = parseFloat($("#"+market6_arr[j]).html());

			if(max_oddval < market6_hi){

				max_oddval = market6_hi;

			}

		}

		var market6_hi = max_oddval;

		

		max_oddval = 0;

		var market7 = $("#market7_"+event_arr[i]).val();

		var market7_arr = market7 == null ? [] : market7.split(",");

		for( j = 0 ; j < market7_arr.length; j++ ) {

		

			var market7_hi = parseFloat($("#"+market7_arr[j]).html());

			if(max_oddval < market7_hi){

				max_oddval = market7_hi;

			}

		}

		var market7_hi = max_oddval;

		

		max_oddval = 0;

		var market8 = $("#market8_"+event_arr[i]).val();

		var market8_arr = market8 == null ? [] : market8.split(",");

		for( j = 0 ; j < market8_arr.length; j++ ) {

		

			var market8_hi = parseFloat($("#"+market8_arr[j]).html());

			if(max_oddval < market8_hi){

				max_oddval = market8_hi;

			}

		}

		var market8_hi = max_oddval;

		

		

		

		if(market1_hi!=0){

			flag_ext++;

			ext_odd = parseFloat(ext_odd + market1_hi);

		} if(market2_hi!=0){

			flag_ext++;

			ext_odd = parseFloat(ext_odd + market2_hi);

		} if(market3_hi!=0){

			flag_ext++;

			ext_odd = parseFloat(ext_odd + market3_hi);

		} if(market4_hi!=0){

			flag_ext++;

			ext_odd = parseFloat(ext_odd + market4_hi);

		} if(market5_hi!=0){

			flag_ext++;

			ext_odd = parseFloat(ext_odd + market5_hi);

		} if(market6_hi!=0){

			flag_ext++;

			ext_odd = parseFloat(ext_odd + market6_hi);

		} if(market7_hi!=0){

			flag_ext++;

			ext_odd = parseFloat(ext_odd + market7_hi);

		} if(market8_hi!=0){

			flag_ext++;

			ext_odd = parseFloat(ext_odd + market8_hi);

		}

		

	

		/////

		if(ext_odd!=0){

			ext_odds = parseFloat(ext_odds * ext_odd);

		}

		

		if(flag_ext>1){

			flag_new = 1;

		}

		

	 }

	 

	 // Default total stake 2.00 

	var bettype = $("#bet_type").val();

	if(bettype== 'Multiway' || bettype== 'Ext. Multiway'){

		var totalstake = $("#total_stake").html();

		if(totalstake<2){

			$("#total_stake").html('2.00');

		}

		

		/// New Add

		ext_odds = ext_odds.toFixed(2);

		$("#total_odds").val(ext_odds);

		

		var total_stake = $("#total_stake").html();

		

		/// TAX CALCULATION

		var tax = 0;

		if(tax>0){

			tax = (total_stake * tax) / 100;

			tax = tax.toFixed(2);

			$("#tax").val(tax);

			total_stake = total_stake - tax;

			total_stake = total_stake.toFixed(2);

		}

		//alert(total_stake);

		

		var tr = parseFloat(total_stake) / parseFloat(row);

		var possible_winnings = parseFloat(ext_odds*tr);

		possible_winnings = possible_winnings.toFixed(2);

		$("#possible_winnings").val(possible_winnings);

		

	}

	 

	 

	 

	 

	 

	

	 

	 //alert(type);

	 /*if(flag_new==1){

	  $("#bet_type").val("Ext. Multiway");

	  type = 'Ext. Multiway';

	  var total_stake_new = $("#total_stake").html();

	  

	  /// TAX CALCULATION

		var tax = <?php echo $tax;?>;

		if(tax>0){

			tax = (total_stake_new * tax) / 100;

			tax = tax.toFixed(2);

			$("#tax").val(tax);

			total_stake_new = total_stake_new - tax;

			total_stake_new = total_stake_new.toFixed(2);

		}

		//alert(total_stake_new);

	  

	  ext_odds = ext_odds.toFixed(2);

	  $("#total_odds").val(ext_odds);

	  var tr = parseFloat(total_stake_new) / parseFloat(row);

	  var possible_winnings = parseFloat(ext_odds*tr);

		possible_winnings = possible_winnings.toFixed(2);

		$("#possible_winnings").val(possible_winnings);

		

	 }

*/	////////

	

	

	

	

	/// For Select Bet

	/*var total_stake = $("#total_stake").html();

	var bet_type = $("#bet_type").val();

	var total_odds = $("#total_odds").val();

	var possible_winnings = $("#possible_winnings").val();

	

	

	

	var added = $("#added_items").val();

	var added_arr = added.split("###");

	if( added != '') {  

		for( i = 0 ; i < added_arr.length; i++ ) {

		

		   var odd = $("#v1_"+added_arr[i]).val();

		   odd = parseFloat(odd);

		   odd_sum = odd_sum * odd;

		   

		   //var MID = $("#MI_"+added_arr[i]).val();

		   //MID_ARR.push(MID);

		}

		

		$.ajax({  

		type: "POST",  

		data: "&MID_ARR=" + MID_ARR + "&total_stake=" + total_stake + "&bet_type=" + bet_type + "&total_odds=" + total_odds + "&possible_winnings=" + possible_winnings, 

		url: "ajax_select_bet.php"

		});

		

		

	}*/

	

	 

	

	

	

}

</script>







<script>

 /////// Clear All 

  function clearOnclick(){		

 	//alert("clr");

	//return(0);	

 	var added = $("#added_items").val();

	var added_arr = added.split("###");

	if( added != '') {  

		for( i = 0 ; i < added_arr.length; i++ ) {

		

		  var ID_ALL = added_arr[i];

		  

		  /*var event_id = $("#event_id_"+ID_ALL).val();*/

		  var event_id = $("#EVENT_"+ID_ALL).val();

		  $("#sport_"+event_id).val(0);

		  $("#market_"+event_id).val(0);

		  

		  $("#market1_"+event_id).val(0);

		  $("#market2_"+event_id).val(0);

		  $("#market3_"+event_id).val(0);

		  $("#market4_"+event_id).val(0);

		  $("#market5_"+event_id).val(0);

		  $("#market6_"+event_id).val(0);

		  $("#market7_"+event_id).val(0);

		  $("#market8_"+event_id).val(0);

		  

		  $("#is_selected_"+ID_ALL).val(0);

		  $("#div_"+ID_ALL).removeClass('set_background'); 

		  $("#sp_"+ID_ALL).remove();

		  

		  $("#TM_"+event_id).remove();

		

		}	

	}

	$("#added_items").val(''); 

	acc = [];

	odds_acc = [];

	cat = [];

	

	//var added = [];

	

	

	

	 for( i = 0 ; i < event_arr.length; i++ ) {	

		$("#sport_"+event_arr[i]).val(0);

	 }

	 event_arr = [];

		

	

	var zer = '0.00';

	$("#total_stake").html('1.00');

	$("#bet_type").val("");

	$("#total_odds").val(zer);

	$("#possible_winnings").val(zer);

	$("#row").html(0);

	$("#tip").html(0);

	$("#tax").val(zer);

	

	var blank = ''

	$.ajax({  

	type: "POST",  

	data: "&MID_ARR=" , 

	url: "ajax_select_bet.php"

	});

	

	

	//////// ADD ACTIVE SELECT

	//var mi_arr_pos = mi_arr.indexOf(market_id); 

	//mi_arr.splice(mi_arr_pos, 1);

	 $.ajax({  

		type: "POST",  

		data: "&mi_arr=", 

		url: "ajax_active_bet.php"

		});

	

	

		

 }

</script>





<script>

	function place_bet(){

		var flag = 0;

		var single_flag = 0;

		var odd_arr = [];

		var odd_name_arr = [];

		var stake_arr = [];

		var amount_arr = [];

		var team_arr = [];

		

		var match_id_arr = [];

		var type_arr = [];

		

		var md_arr = [];

		var match_date_arr = [];

		var localteam_id_arr = [];

		var visitorteam_id_arr = [];

		var category_name_arr = [];

		var extra_arr = [];

		

		var event_id_arr = [];

		

		var match_time_arr = [];

		



		var team_1_name_arr = [];

		var team_2_name_arr = [];

		var team_1_score_arr = [];

		var team_2_score_arr = [];

		

		

		var event_un_arr = [];

		

		var market_code_arr = [];

		

		var market_id_arr = [];

		

		var sum_x = $("#sum").html();

				

		var stake_total = 0;

		var ui = '<?php echo $_SESSION['USER_ID'];?>';

		

		if(ui==''){

			alert("Please Login");

			flag = 1;

			return(0);	

		}

		

		var added = $("#added_items").val();

		var added_arr = added.split("###");

		if( added != '') {  

			for( i = 0 ; i < added_arr.length; i++ ) {

			

				var ODD = $("#"+added_arr[i]).html();

				ODD = parseFloat(ODD);

			    odd_arr.push(ODD);

				

				var ODD_NAME = $("#ODD_NAME_"+added_arr[i]).val();

			    odd_name_arr.push(ODD_NAME);

				

				

				var EVENT_ID = $("#EVENT_"+added_arr[i]).val();

			    event_id_arr.push(EVENT_ID);

				

				var match_current_time = parseFloat($("#match_current_time"+EVENT_ID).html());

				match_time_arr.push(match_current_time);

				

				

				var team_1_name = $("#team_1_name"+EVENT_ID).html();

				team_1_name_arr.push(team_1_name);

				

				var team_2_name = $("#team_2_name"+EVENT_ID).html();

				team_2_name_arr.push(team_2_name);

				

				var team_1_score = $("#team_1_score"+EVENT_ID).html();

				team_1_score_arr.push(team_1_score);

				

				var team_2_score = $("#team_2_score"+EVENT_ID).html();

				team_2_score_arr.push(team_2_score);

				

				

				

				if(event_un_arr.length==0){

					event_un_arr.push(EVENT_ID);

			    }

				var event_flag = event_un_arr.indexOf(EVENT_ID); 

			    if(event_flag<0){

					event_un_arr.push(EVENT_ID);

			    }

				

				

				var MC = $("#MC_"+added_arr[i]).val();

			    market_code_arr.push(MC);

				

				

				var MI = $("#MI_"+added_arr[i]).val();

			    market_id_arr.push(MI);

				

				

			  

			   

			   

			   

			   

			}

		}else{

			alert("Please Select At Least One Bet");

			flag = 1;

			return(0);	

		}

		

		////////

		

		//alert(market_code_arr);

		var all_market = '';

		for(i=0; i<event_un_arr.length; i++){

			var market = $("#market_"+event_un_arr[i]).val(); 

			

			if(all_market==''){

				all_market = market;

			}else{

				all_market = all_market + '#' + market;

			}

		}

		

		//alert(all_market);

		

		var total_stake = parseFloat($("#total_stake").html());

		var credit_limit = parseFloat($("#credit_limit").html());

		var bet_type = $("#bet_type").val(); 

		var total_odds = $("#total_odds").val(); 

		var possible_winnings = $("#possible_winnings").val();

		var row = $("#row").html();		

		var d = new Date();

    	var mt = d.getTime();

		var tax = $("#tax").val();

		

		

		

		if(total_stake > credit_limit){

			alert("Not Enough Balance !");

			flag = 1;

			return(0);	

		}

		

		

		

		////extended test 

		var extended = '';

		for(i=0; i<event_un_arr.length; i++){

			var market1 = $("#market1_"+event_un_arr[i]).val();

			var market2 = $("#market2_"+event_un_arr[i]).val();

			

			if(extended == ''){

				if(market1!=''){

					extended = market1;

				}

				if(market2!='' && market1==''){

					extended = market2;

				}

				if(market2!='' && market1!=''){

					extended = extended + '##' + market2;

				}

			}else{

			

				if(market1!=''){

					//extended.push(rest);

					extended = extended + '##' + market1;

				}

				if(market2!=''){

					//extended.push(ou);

					extended = extended + '##' + market2;

				}

			}

		}

		//alert(market_code_arr);

		

		if(flag == 0){

		

			$.ajax({  

			type: "POST",  

			data: "&total_stake=" + total_stake + "&bet_type=" + bet_type + "&total_odds=" + total_odds + "&possible_winnings=" + possible_winnings + "&total_odds=" + total_odds + "&mt=" + mt + "&odd_arr=" + odd_arr + "&odd_name_arr=" + odd_name_arr + "&event_id_arr=" + event_id_arr + "&market_code_arr=" + market_code_arr + "&market_id_arr=" + market_id_arr + "&row=" + row + "&all_market=" + all_market + "&extended=" + extended + "&tax=" + tax + "&match_time_arr=" + match_time_arr + "&team_1_name_arr=" + team_1_name_arr + "&team_2_name_arr=" + team_2_name_arr + "&team_1_score_arr=" + team_1_score_arr + "&team_2_score_arr=" + team_2_score_arr, 

			url: "ajax_place_bet_live.php"

			});

			

			clearOnclick();

			

			////credit_limit

			credit_limit = parseFloat(credit_limit-total_stake);

			credit_limit = credit_limit.toFixed(2);

			$("#credit_limit").html(credit_limit);

			

			

			/// Redirect 

			var winWidth = 700;

					

			var winHeight = 500;

			

			var winLeft = (screen.width-winWidth)/2;

			

			var winTop = (screen.height-winHeight)/2;

			

			window.open('bet_slip.php?mt='+mt, 'complete_registration', 'menubar=no,statusbar=0,toolbar=no,resizable=yes,scrollbars=yes' +',width=' + winWidth + ',height=' + winHeight);

			

		}

	}

</script>

<script>
function setSession(slip) {

	var total_stake = $("#total_stake").html();	
	var bet_type = $("#bet_type").val();
	var total_odds = $("#total_odds").val();
	var possible_winnings = $("#possible_winnings").val();
	var row = $("#row").val();
	var tip = $("#tip").val();
	
	//alert(total_stake);
	
    $.ajax({  
		type: "POST",  
		data: "&slip=" + slip + "&total_stake=" + total_stake + "&bet_type=" + bet_type + "&total_odds=" + total_odds + "&possible_winnings=" + possible_winnings + "&row=" + row + "&tip=" + tip, 
		url: "ajax_session.php"
		});
		//alert(svalue);
} 
</script>



<style type="text/css">

	div#my-timer{

		width: 100%; 

		background-color: #fefefe;

		bottom: 0;

		height: 100%;

		left: 0;

		opacity: 0.6;

		position: absolute;

		right: 0;

		top: 0;

		z-index: 99;

	}

	

	#wait-status {

		/*background-image: url("img/status.gif");*/

		font-family: Arial; font-size:20px;

		background-position: center center;

		background-repeat: no-repeat;

		height: 200px;

		left: 50%;

		margin: -100px 0 0 -100px;

		position: absolute;

		top: 50%;

		width: 250px;

	}

    </style>



<div id="my-timer" style="display:none;">

        <div id="wait-status">Please Wait <b id="show-time">6</b> Seconds</div>

</div>



<script type="text/javascript">

	function place_bet_wait(){

	var settimmer = 0;

	var strt = '6';

	$("b[id=show-time]").html(strt);

	$("div[id=my-timer]").show();

		setInterval(function() {

			var timeCounter = $("b[id=show-time]").html();

			var updateTime = eval(timeCounter)- eval(1);

			$("b[id=show-time]").html(updateTime);



			if(updateTime == 0){

				$("div[id=my-timer]").hide();

				//window.location = ("redirect.php");

				place_bet();

				return(0);

			}

		}, 1000);

	

	}

</script>





<script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>

<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.5"></script>

<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />

<script type="text/javascript">

	var j=jQuery.noConflict();

	j(document).ready(function() {

		j('.fancybox').fancybox();

	});
	
	/*var kk=jQuery.noConflict();
	function idle_fancybox(){
		kk.fancybox({
            'type': 'ajax',
            'href': 'http://tipxxl.mine.nu/idle_popup.php'
        });
	}*/
	
</script>



<script>

	function submitClick(){

		var cal_text = $("#cal_text").val();

		cal_text = parseFloat(cal_text);

		cal_text = cal_text.toFixed(2)

		

		flag_ts = 0;

	   //curr_total_stake = $("#total_stake").html();

	   //if(curr_total_stake<cal_text){

	       $("#total_stake").html(cal_text);

	   //}

	   //alert("4");

	   

	   /// TAX CALCULATION

		var tax = <?php echo $tax;?>;

		if(tax>0){

			tax = (cal_text * tax) / 100;

			tax = tax.toFixed(2);

			$("#tax").val(tax);

			cal_text = cal_text - tax;

			cal_text = cal_text.toFixed(2);

		}

		//alert(cal_text);

		

		var possible_winnings = 0;

		var total_odds = $("#total_odds").val();

		var bet_type = $("#bet_type").val();

		var row = $("#row").html();

		

		if(bet_type == 'Multiway'){

			var tr = parseFloat(cal_text / row);

			possible_winnings = parseFloat(total_odds*tr);

		}else if(bet_type == 'Ext. Multiway'){

			var tr = parseFloat(cal_text / row);

			possible_winnings = parseFloat(total_odds*tr);

		}else{

			possible_winnings = parseFloat(total_odds*cal_text);

		}

		possible_winnings = possible_winnings.toFixed(2);

		$("#possible_winnings").val(possible_winnings);

		

	

		//alert("close");

		jQuery.fancybox.close()

	}

</script>



<script>

function layout_click(i){

	//alert(i);

	$("#layout1").removeClass("active");

	$("#layout2").removeClass("active");

	$("#layout3").removeClass("active");

	

	$("#"+i).addClass("active");

	

	if(i=='layout1'){

		$("#d2").removeClass("inner6");

		$("#d2").removeClass("lve_sec2");

		

		$('.match_winner').hide();

		$('.match_winner_h1').hide();

		

		

		$('.next_goal').hide();

		$('.next_goal_h1').hide();

		

		 

	}else if(i=='layout2'){

		$("#d2").removeClass("inner6");

		

		$('.match_winner').hide();

		$('.match_winner_h1').hide();

		

		$('.next_goal').show();

		$('.next_goal_h1').show();

		

	}else if(i=='layout3'){

		$("#d2").addClass("inner6");

		$("#d2").addClass("lve_sec2");

		

		$('.match_winner').show();

		$('.match_winner_h1').show();

		

		$('.next_goal').show();

		$('.next_goal_h1').show();

	}

}

</script>

















<!--Admin/Oddsmanager Ctrl-->

<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>-->

<script type="text/javascript">

$(document).ready(function(){

	var timer = 5000;

	var strData = '';
	
	var cnt_flag = 0;

    function load_data() {

        $.ajax({

            type: 'POST',

            url: 'load_live_event.php',

            dataType: 'html',

            data: strData,

            success: function(data) {

				$('#tbl_live_event').html('');

                $('#tbl_live_event').html(data);

                setTimeout(load_data, timer);
				
				if($("#live_matches").html()!='' || cnt_flag > 2){
					
					live_pagination();
					$('#hr24_matches').css('display', 'block');
					$('#livebet_title').html('Soccer');
					
					var page_no = parseInt($('#current_page').val());
					//if there is an item before the current active link run the function
					//alert(page_no);
					if(page_no!=0){
						go_to_page(page_no);
					}
				} else {
					cnt_flag++;
				}

            }

        });

    }

    load_data();
	

});

</script>







<?php $sport_qry = mysql_query("SELECT * FROM `bet_sport` WHERE `SPORT_ID` = '50' AND `EVENT_DATETIME` >= '".$st."' AND `EVENT_DATETIME` <= '".$et."' AND `EVENT_DATETIME` >= '".time()."' AND `status_live_con` = 'Active' GROUP BY `EVENT_ID` ORDER BY `EVENT_DATETIME` ASC");

if(mysql_num_rows($sport_qry) >0){

while($res = mysql_fetch_array($sport_qry)){?>

<script type="text/javascript"> 

	$(document).ready(function(){

	$("#check_<?php echo $res['EVENT_ID'];?>").click(function(){

		$("#toggle_<?php echo $res['EVENT_ID'];?>").slideToggle("slow");

	  });

	});

</script>

<?php }

}?>


<script>
/*$(document).ready(function(){
	//$("#check1_'+ data.id +'").click(function(){
	function show_more(i){
		alert(i);
		//$("#toggle1_'+i+'").slideToggle("slow");
	}
  //});
});*/



function show_more(i) {
	//alert(i);
    var x = document.getElementById('toggle1_'+i);
    if (x.style.display === 'none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
}

</script>






<script>

////livebet_day

function livebet_day(n,t,l,i){

	

	//alert(t);

	var p_no = 0;

	var s_id = 50;

	if(n!='' && n!=null){

		var str = 'day_'+n;

		//document.getElementById(str).className += " current";

		$('#day_0').removeClass('active');

		$('#day_1').removeClass('active');

		$('#day_2').removeClass('active');

		$('#day_3').removeClass('active');

		$('#day_4').removeClass('active');

		$('#day_5').removeClass('active');

		$('#day_6').removeClass('active');

		$('#'+str).addClass(' active');

		

		if(n=='0'){

			$("#nextday_matches").hide();

			$("#today_matches").show();

		} else {

			$("#today_matches").hide();

			$("#nextday_matches").show();

			$('#nextday_matches').html('');

		}

	}

	

	function load_livebet_data() {

		$.ajax({

			type: 'GET',

			url: 'livebet_data_page.php',

			dataType: 'html',

			data: "&ts=" + t + "&s_id=" + s_id,

			success: function(data) {

				$('#nextday_matches').html('');

				$('#nextday_matches').html(data);

			}

		});

	}

	load_livebet_data();

	

	/*

	function load_24_left() {

		$.ajax({

			type: 'GET',

			url: 'left_24hr_menu.php',

			dataType: 'html',

			data: "&ts=" + t + "&s_id=" + i + "&s_name=" + l,

			success: function(data) {

				$('#left_menu').html('');

				$('#left_menu').html(data);

			}

		});

	}

	load_24_left();*/

}

</script>



<!--24 HR-->

<!--<script type="text/javascript">

$(document).ready(function(){

	var timer = 10000;

	var strData = '';

    function load_data24() {

        $.ajax({

            type: 'POST',

            url: 'load_24_matches.php',

            dataType: 'html',

            data: strData,

            success: function(data) {

				$('#hr24_matches').html('');

                $('#hr24_matches').html(data);

                setTimeout(load_data24, timer);

            }

        });

    }

    load_data24();

});

</script>-->

<span id="tbl_live_event"></span>






<!-- the input fields that will hold the variables we will use -->
<input type='hidden' id='current_page' value="0" />
<input type='hidden' id='show_per_page' value="12" />
<div id='page_navigation' style="display:none;"></div>


<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<script>
	function live_pagination(){
		//how much items per page to show
		var show_per_page = 16; 
		//getting the amount of elements inside content div
		var number_of_items = $('.match_div').size();
		//alert(number_of_items);
		
		//calculate the number of pages we are going to have
		var number_of_pages = Math.ceil(number_of_items/show_per_page);
		
		$('#total_page').html(number_of_pages);
		if($('#current_page').val()==0){
			$('#new_page').html(1);
		}else{
			$('#new_page').val($('#current_page').val());
		}
		
		//set the value of our hidden input fields
		//$('#current_page').val(0);
		$('#show_per_page').val(show_per_page);
		
		//now when we got all we need for the navigation let's make it '
		
		
		var navigation_html = '<a class="previous_link" href="javascript:previous();">Prev</a>';
		var current_link = 0;
		while(number_of_pages > current_link){
			navigation_html += '<a class="page_link" href="javascript:go_to_page(' + current_link +')" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>';
			current_link++;
		}
		navigation_html += '<a class="next_link" href="javascript:next();">Next</a>';
		
		$('#page_navigation').html(navigation_html);
		
		//add active_page class to the first page link
		$('#page_navigation .page_link:first').addClass('active_page');
		
		//hide all the elements inside content div
		$('.match_div').css('display', 'none');
				
		//and show the first n (show_per_page) elements
		$('.match_div').slice(0, show_per_page).css('display', 'block');
		
	}
		
		
		
		
		
	function previous(){
		new_page = parseInt($('#current_page').val()) - 1;
		//if there is an item before the current active link run the function
		if($('.active_page').prev('.page_link').length==true){
			go_to_page(new_page);
			$('#match_scroll').animate({ scrollTop: 0 }, 1);
		}
	}
	
	function next(){
		new_page = parseInt($('#current_page').val()) + 1;
		//if there is an item after the current active link run the function
		if($('.active_page').next('.page_link').length==true){
			go_to_page(new_page);
			$('#match_scroll').animate({ scrollTop: 0 }, 1);
		}
	}
	function go_to_page(page_num){
		
		
		$('#new_page').html(page_num+1);
		
		//get the number of items shown per page
		var show_per_page = parseInt($('#show_per_page').val());
		
		//get the element number where to start the slice from
		start_from = page_num * show_per_page;
		
		//get the element number where to end the slice
		end_on = start_from + show_per_page;
		
		//hide all children elements of content div, get specific items and show them
		$('.match_div').css('display', 'none').slice(start_from, end_on).css('display', 'block');
		
		//get the page link that has longdesc attribute of the current page and add active_page class to it
		//and remove that class from previously active page link
		$('.page_link[longdesc=' + page_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');
		
		//update the current page input field
		$('#current_page').val(page_num);
		//alert("Hi");
		
	}
</script>



<!--<script>
$(".ballShow").click(function(){
 alert("Hi");
 $(this).closest('.lastcol').next('.overBall').addClass('active');
 var cur_id = $(this).attr("id");
   setTimeout(function() {
  $("#"+cur_id).closest('.lastcol').next('.overBall').removeClass('active');
    }, 3000);
});
</script>-->

<script>
//$(".ballShow").click(function(){
function goal_score(i){
 $("#"+i).closest('.lastcol').next('.overBall').addClass('active');
 var cur_id = $("#"+i).attr("id");
   setTimeout(function() {
  $("#"+cur_id).closest('.lastcol').next('.overBall').removeClass('active');
    }, 6000);
}
//});
</script>



<style>
.Gamedetl{overflow:hidden; position:relative; -webkit-transition:all 0.3s ease 0s; -moz-transition:all 0.3s ease 0s; -o-transition:all 0.3s ease 0s; transition:all 0.3s ease 0s;}
.overBall{position:absolute; width:100%; height:100%; float:left; top:0; left:0; background:rgba(0,0,0,.99); -webkit-transition:all 0.3s ease 0s; -moz-transition:all 0.3s ease 0s; -o-transition:all 0.3s ease 0s; transition:all 0.3s ease 0s; opacity:0; visibility:hidden; z-index:-1;}
.overBall span{position:absolute; top:15%; left:102%; z-index:99; -webkit-transition:all 0.3s ease 0s; -moz-transition:all 0.3s ease 0s; -o-transition:all 0.6s ease 0s; transition:all 0.6s ease 0s;}
.overBall.active span{left:10px; -webkit-transition:all 0.6s ease 0s; -moz-transition:all 0.6s ease 0s; -o-transition:all 0.6s ease 0s; transition:all 0.6s ease 0s;}
.overBall.active{opacity:1; visibility:visible; z-index:9; color:#FFFFFF; font-size:25px;}

</style>

</body>

</html>