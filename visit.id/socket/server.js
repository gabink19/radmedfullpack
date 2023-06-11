'use strict';

const net = require('net');
const Sequelize = require('sequelize');

//const netSocket = net.Socket;
const PORT = 50000;
//const ADDRESS = '192.168.81.183';
const ADDRESS = '103.157.96.62';

let server = net.createServer(onClientConnected);
server.listen(PORT, ADDRESS);
var arSocket = [];

console.log(`Server started at: ${ADDRESS}:${PORT}`);

function onClientConnected(socket) {
	let clientName = `${socket.remoteAddress}:${socket.remotePort}`;
	console.log(`${clientName} connected.`);
	//console.log(`Handle: ${netSocket}`);
	
	if ( arSocket[clientName] === undefined ) { arSocket[clientName] = ''; }
	arSocket[clientName] = socket;
	
	socket.on('data', (data) => {
		onDataArrival(data, clientName);
	});

  socket.on('end', () => {
    console.log(`${clientName} disconnected.`);
  });

}

function onDataArrival(data, clientName) {	
	let m = data.toString();
	//console.log(`${clientName} said: ${m}`);
	
	//logdata = {"deviceid": "raspi01", "sensorid": "dht001", "sensordata": "10010110101"};
	logtodb(m);
	//sendPaket(`Data received: (${m})`, clientName);
		
	if ( m == 'quit' ){
		console.log(`Trying to disconnect (${clientName})...`);
		setTimeout(function(){}, 2000);
		closeSocket(clientName);
		console.log('done');
	}
	//}
}

function closeSocket(clientName) {
	if ( arSocket[clientName] === undefined ) { return; }
	arSocket[clientName].destroy();
}

function sendPaket(data, clientName) {
	if ( arSocket[clientName] === undefined ) { return; }
	arSocket[clientName].write(data);
}

class csocket extends net.Socket {
  getHandle() {
    console.log(`${super.name}`);
  }
	
}

const dbConn = "mysql://root:Disana4misbah@localhost:3306/";
const dbConnOptions = {dialect: 'mariadb', logging: false, dialectOptions: {connectTimeout: 1000}};

const sequelize = new Sequelize(dbConn,dbConnOptions);
const Model = Sequelize.Model;
const DataTypes = Sequelize.DataTypes;
class devicelog extends Model {}

devicelog.init({
  kode_device: { type: DataTypes.STRING(40), allowNull: false },
  sensorid: { type: DataTypes.STRING(100), allowNull: false },
  sensordata: { type: DataTypes.STRING(50), allowNull: false }
}, {sequelize, timestamps: true, modelName: 'devicelog'} );

sequelize.sync();

/*
sequelize.sync()
  .then(() => devicelog.create({
    deviceid: 'raapi01',
	sensorid: 'dt01',
	sensordata: '10001010111010101'
  }))
  .then(loggedData => {
    //console.log(loggedData.toJSON());
  });
*/

 function logtodb(logdataparam){
	let mylogdata;
	try {
        mylogdata = JSON.parse(logdataparam);
	
		if ( mylogdata.deviceid === undefined ) { mylogdata.deviceid = ''; }
		if ( mylogdata.sensorid === undefined ) { mylogdata.sensorid = ''; }
		if ( mylogdata.sensordata === undefined ) { mylogdata.sensordata = ''; }
		
		devicelog.create({
			deviceid: mylogdata.deviceid,
			sensorid: mylogdata.sensorid,
			sensordata: mylogdata.sensordata
		  })

    } catch(e) { console.log('Error parse logdata : '+logdataparam); return; }
 }
  
/*
// Test conn
sequelize
  .authenticate()
  .then(() => {
    console.log('Connection has been established successfully.');
  })
  .catch(err => {
    console.error('Unable to connect to the database:', err);
  });
*/
