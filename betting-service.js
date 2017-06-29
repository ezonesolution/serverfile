//var waterfall = require('async-waterfall');
var utf8 = require('utf8');
var async = require('async');


var net = require('net');
var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
//var Buffer = require('safe-buffer').Buffer
var fs = require("fs");
//var ss = require("socket.io-stream");

io.set('heartbeat interval', 5000);
io.set('heartbeat timeout', 11000);

var HOST = '64.251.19.243';
var PORT = 4661;

var client = null;
var ssClient = null;
var usClient = null;
var eventsStr = null;
var updateSentAt = new Date();

app.get('/', function(req, res) {
    res.sendFile(__dirname + '/betting-service.html');
});

io.on('connection', function() {
    console.log('A new client connected..');
    startFeed();
});

io.on('startFeed', function() {
    console.log('Got a feed refresh request from client..');
    startFeed();
});

io.on('uncaughtException', function(err) {
    console.log("Problem:", err);
    /*console.log('Socket connection error occurred..');
     io.connect().io.connect().reconnect();*/
});

io.on('error', function(err) {
	console.log("Problem:", err);
    /*console.log('Socket connection error occurred..');
	io.connect().io.connect().reconnect();*/
});

http.listen(3337, function() {
    console.log('listening on *:3337');
});

setInterval(function() {
    console.log('Checking if update is sent in the past 20s..');
    if (Math.abs(((new Date()) - updateSentAt) > 20000)) {
        console.log('Update not sent for more than 20s.. Hence restarting the feed..');
        startFeed();
    }
}, 20000);

function startFeed() {

    if (client) {
        client.destroy();
    }

    if (ssClient) {
        ssClient.destroy();
    }
	

    client = new net.Socket();
    client.connect(PORT, HOST, function() {
        //var cmdLengthBuf = new Buffer(4);
		const cmdLengthBuf = Buffer.allocUnsafe(4);
        var elCommand = '{C:\"EL\",bmId:7,inst:\"asaturoglu\",tok:\"114780425008\",sid:50,P:\"all\"}';
        cmdLengthBuf.writeUInt32BE(elCommand.length, 0);
        client.write(cmdLengthBuf);
        client.write(elCommand);

        var buf;
        client.on('data', function(data) {

            if (buf) {
                var tmpBuf = Buffer(data.length + buf.length);
                buf.copy(tmpBuf, 0, 0, buf.length);
                data.copy(tmpBuf, buf.length, 0, data.length);
                buf = tmpBuf;
            } else {
                buf = new Buffer(data.length);
                data.copy(buf, 0, 0, data.length);
            }

            if (buf && buf.length >=4) {
                var dataLength  = (buf[0] << 32) + (buf[1] << 16) + (buf[2] << 8)  + buf[3];
                if (buf.length >= (4 + dataLength)) {
                    var msgBytes = Buffer(dataLength);
                    buf.copy(msgBytes, 0, 4, 4 + dataLength);
                    if ((msgBytes.toString('utf8')).indexOf('{\"dt\"') === 0) {
                        if (buf.length == (4 + dataLength)) {
                            buf = null;
                        } else {
                            buf = buf.slice(4 + dataLength, buf.length);
                        }
                    } else {
                        var msgStr = String.fromCharCode.apply(null, new Uint8Array(msgBytes));
                        var elObj = null;
                        try {
                           elObj = JSON.parse(msgStr);
                        } catch (e) {
                            console.log('An error occurred while parsing the event list.. ' + e);
                            // Parsing error. Restart the stream
                            startFeed();
                        }
                        var eventsArr = elObj['obj'];
                        if (eventsArr && eventsArr.length > 0) {
                            eventsStr = '';
                            for (var i = 0; i < eventsArr.length; i++) {
                                if (eventsStr === '') {
                                    eventsStr = eventsArr[i].id;
                                } else {
                                    eventsStr = eventsStr + ',' + eventsArr[i].id;
                                }
								
								if(i==20){
									break;
								}
                            }
							
                            console.log('Starting feed for the events - ' + eventsStr);
							
							
                            ssClient = new net.Socket();
                            ssClient.connect(PORT, HOST, function() {
                                //var cmdLengthBuf = new Buffer(4);
								const cmdLengthBuf = Buffer.allocUnsafe(4);
                                var ssCommand = '{C:\"SS\",bmId:7,inst:\"asaturoglu\",tok:\"114780425008\",eId:\"'
                                    +eventsStr+'\"}';
                                cmdLengthBuf.writeUInt32BE(ssCommand.length, 0);
                                ssClient.write(cmdLengthBuf);
                                ssClient.write(ssCommand);

                                console.log('SS command length - ' + cmdLengthBuf);
                                console.log('SS command - ' + ssCommand);

                                var dataBuf;
                                ssClient.on('data', function(data) {
                                    //console.log('Got an update..');
									
									
									async.waterfall([
									function(callback) {
										console.log('running waterfall function 1...');
										
										if (dataBuf) {
											var tmpBuf = Buffer(data.length + dataBuf.length);
											dataBuf.copy(tmpBuf, 0, 0, dataBuf.length);
											data.copy(tmpBuf, dataBuf.length, 0, data.length);
											dataBuf = tmpBuf;
										} else {
											dataBuf = new Buffer(data.length);
											data.copy(dataBuf, 0, 0, data.length);
										}
										
										callback(null, 'one');
										
									},
									function(arg1, callback) {
										console.log('running waterfall function 2...');
											
											if (dataBuf && dataBuf.length >=4) {
											var dataLength = (dataBuf[0] << 32) + (dataBuf[1] << 16) + (dataBuf[2] << 8)
												+ dataBuf[3];
											if (dataBuf.length >= (4 + dataLength)) {
												var msgBytes = Buffer(dataLength);
												dataBuf.copy(msgBytes, 0, 4, 4 + dataLength);
	
	
												//    var stream = ss.createStream();
												//stream.write(msgBytes);
	
												try {
													///var str = msgBytes;
												   // if(str.indexOf('{\"dt\"') !== -1)
												   // {
														var str = msgBytes.toString('utf8');
														if(str==""){
															console.log('Update Null..');
															startFeed();
														}
														updateSentAt = new Date();
														io.emit('eventUpdateObj', str);
														
	
													var newMsgBuf = new Buffer(dataBuf.length - (4 + dataLength));
													dataBuf.copy(newMsgBuf, 4 + dataLength, dataBuf.length);
													dataBuf = newMsgBuf;
												   // }
												} catch (e) {
													console.log('An error occurred while parsing event update.. ' + e);
													// Parsing error. Restart the stream
												}
	
	
											}
										}
											callback(null, 'done');
										}
									], function (err, result) {
										console.log('running waterfall function comp...'+err);
										// result now equals 'done'
									});
                                    

                                    //waterfall(tasks, callback);
									
									

					//console.log('Data length..'+dataBuf.length);
                                  /*  if (dataBuf && dataBuf.length >=4) {
                                        var dataLength  = (dataBuf[0] << 32) + (dataBuf[1] << 16) + (dataBuf[2] << 8)
                                            + dataBuf[3];
                                        if (dataBuf.length >= (4 + dataLength)) {
                                            var msgBytes = Buffer(dataLength);
                                            dataBuf.copy(msgBytes, 0, 4, 4 + dataLength);
                                            if ((msgBytes.toString('utf8')).indexOf('{\"dt\"') === 0) {
                                                var msgStr = String.fromCharCode.apply(null, new Uint8Array(msgBytes));
                                                var eventHeartbeat = null;
                                                try {
                                                    eventHeartbeat = JSON.parse(msgStr);
                                                } catch (e) {
                                                    console.log('An error occurred while parsing event heartbeat.. ' + e);
                                                    // Parsing error. Restart the stream
                                                    startFeed();
                                                }

                                                console.log('Broadcasting heartbeat.. ' + eventHeartbeat);
                                                io.emit('eventHeartbeat', eventHeartbeat);
                                                updateSentAt = new Date();

                                                if (dataBuf.length == (4 + dataLength)) {
                                                    dataBuf = null;
                                                } else {
                                                    var newMsgBuf = new Buffer(dataBuf.length - (4 + dataLength));
                                                    dataBuf.copy(newMsgBuf, 4 + dataLength, dataBuf.length);
                                                    dataBuf = newMsgBuf;
                                                }
                                            } else {
                                                var msgStr = msgBytes.toString('utf8');
                                                var eventUpdateObj = null;
                                                try {
                                                    eventUpdateObj = JSON.parse(msgStr);
                                                } catch (e) {
                                                    console.log('An error occurred while parsing event update.. ' + e);
                                                    // Parsing error. Restart the stream
                                                    startFeed();
                                                }
													if(eventUpdateObj.hasOwnProperty('dt') && eventUpdateObj.hasOwnProperty('eId')) {
																			 console.log('Broadcasting event update.. ' + eventUpdateObj.dt + '. match:' + eventUpdateObj.eId);
													} else {
													  console.log('Broadcasting event update.. with no addditional info');
													}
                                                io.emit('eventUpdateObj', eventUpdateObj);
                                                updateSentAt = new Date();
                                                var newMsgBuf = new Buffer(dataBuf.length - (4 + dataLength));
                                                dataBuf.copy(newMsgBuf, 4 + dataLength, dataBuf.length);
                                                dataBuf = newMsgBuf;
                                            } //else
                                        }//if
                                    }//if*/
								  
								  
                                });//SSCLient on data
                            });// SSClient connect
                        }//if events > 0
						
						//usClient = new net.Socket();
						//ssClient.connect(PORT, HOST, function() {
							//var cmdLengthBuf = new Buffer(4);
							const cmdLengthBuf = Buffer.allocUnsafe(4);
							var usCommand = '{C:\"US\",bmId:7,inst:\"asaturoglu\",tok:\"114780425008\",eId:\"'
								+eventsStr+'\"}';
							cmdLengthBuf.writeUInt32BE(usCommand.length, 0);
							ssClient.write(cmdLengthBuf);
							ssClient.write(usCommand);
							console.log('US -> '+eventsStr);
						//});	
						
						
                        client.destroy();
                    }//else dt = 0
                }//if
            }//if

        });//client on data
    });// client connect
}//start Feed()



 
