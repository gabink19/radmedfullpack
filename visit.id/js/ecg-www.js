

(function() {
    setInterval(function(){
        document.getElementById("denyut").innerHTML = Math.floor(Math.random()*99)+40;
        document.getElementById("waktu").innerHTML = (new Date()).toLocaleTimeString('en-ID', { hour12: false });
    }, 10000);
    ////////////////////////////////////////////////////////////////////////// setup mqtt///////////////////

        client = new Paho.MQTT.Client("test.mosquitto.org", Number(8081), Math.random().toString(16).replace(/[^a-z]+/g, '').substr(0, 5));
        client.onConnectionLost = onConnectionLost;
        client.onMessageArrived = onMessageArrived;
        client.connect({onSuccess:onConnect, useSSL: true});

        function onConnect() {
            console.log("Komunikasi terhubung.");
            client.subscribe("rafdytester/1");
            client.subscribe("rafdytester/2");
        }

        function onConnectionLost() {
            alert("Koneksi terputus.");
        }

        function onMessageArrived(message) {
            if (message.destinationName == "rafdytester/1") {
                console.log (message.payloadString);
            }
            else 
            if (message.destinationName == "rafdytester/2") {
            console.log(message.payloadString);
            }
        }
   

  

    ////////////////////////////////////////////////////////////////////////// setup graph
    var ctx = document.getElementById('myChart').getContext('2d');
    var gradientFill = ctx.createLinearGradient(0, 200, 0, 50);
    gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
    gradientFill.addColorStop(1, "rgba(255, 255, 255, 0.24)");

    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [{
                label: "Heart Signal",
                borderColor: "#16a085",
                borderWidth: 2,
                fill: true,
                backgroundColor: gradientFill,
                radius: 0,
                data: []
            }]
        },
        options: {
            layout: {
                padding: {
                    left: 0
                }
            },
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    display: false
                }],
                xAxes: [{
                    gridLines: {display: false},
                    ticks: {
                        padding: 10,
                        fontColor: "rgba(255,255,255,0.4)",
                        fontStyle: "bold"
                    },
                    type: 'realtime'
                }]
            },
            plugins: {
                streaming: {
                    refresh: 20,
                    duration: 10000,
                    frameRate: 30,
                    delay: 40,
                    onRefresh: function(chart) {
                        chart.data.datasets[0].data.push({
                            x: Date.now(),
                            y: Math.floor(Math.random()*99)
                            // y: signalData.pop()
                        });
                    }
                }
            }
        }
    });
}())