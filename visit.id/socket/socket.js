'use strict';

const net = require('net');
const PORT = 50000;
const ADDRESS = '192.168.81.183';

let server = net.createServer(onClientConnected);
server.listen(PORT, ADDRESS);

/*
function onClientConnected(socket) {
  console.log(`New client: ${socket.remoteAddress}:${socket.remotePort}`);
  socket.destroy();
}
*/
console.log(`Server started at: ${ADDRESS}:${PORT}`);

function onClientConnected(socket) {

  let clientName = `${socket.remoteAddress}:${socket.remotePort}`;
  console.log(`${clientName} connected.`);
  socket.on('data', (data) => {
  if( typeof onClientConnected.myMessages == 'undefined' ) {
        onClientConnected.myMessages = '';
    }

	/*
    let m = data.toString().replace(/[\n\r]*$/, '');
    var d = {msg:{info:m}};
    console.log(`${clientName} said: ${m}`);
    socket.write(`We got your message (${m}). Thanks!\n`);
	*/
	let m = data.toString();
	onClientConnected.myMessages += m;
	if ( m.indexOf('\r\n') > -1 ){
		let finalMSG = onClientConnected.myMessages.replace('\r\n', '');
		console.log(`${clientName} said: ${finalMSG}`);
		onClientConnected.myMessages = '';
		
		if ( finalMSG == 'quit' ){
			console.log('Trying to exit process...');
			process.exit()
		}
	}
	//console.log(`${clientName} said: ${m}`);
	
  });

  socket.on('end', () => {
    console.log(`${clientName} disconnected.`);
  });

}