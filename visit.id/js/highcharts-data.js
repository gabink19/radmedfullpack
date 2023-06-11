/**
 * Highcharts data
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */
(function ($) {

  const data_json = [];
  getJson();
  clockUpdate();
  setInterval(clockUpdate, 1000);

  function getJson(){
    $.ajax({
        type: "POST",
        url: "ajax.php", 
        data: {now: "",limit : 60, data : "all"},
        success: function(result){
          chartOxi(result);
          chartJarak(result);
          chartKelembapan(result);
          tableSuhuTubuh();
      }
    });
  }

  function chartOxi(datajson) {
    datetime = datajson.oxi.last_data;
    tinggi = $('.panel-header').height();
    lebar = $('.panel-header').width();
    count = 0;
    console.log(lebar)
    Highcharts.chart('oximeter', {
        title: { text: "Oxymeter",
            style: {
                color: '#FFFFFF',
                fontWeight: 'bold'
            }
        },
        subtitle:false,
        chart: {
            backgroundColor: '#141e30',
            height: tinggi,
            width: lebar,
            type: 'line',
            events: {
                load: function() {
                    //set up the updating of the chart each second
                    console.log(this.series)
                    var series1 = this.series[0];
                    var series2 = this.series[1];
                    var chart = this;
                    var kategories = this.xAxis[0].categories;
                    setInterval(function() {
                        if (count<5) {
                            $.ajax({
                              type: "POST",
                              url: "ajax.php", 
                              data: {now: datetime, limit : 1, data : "oxi"},
                              success: function(result){
                                    chart.xAxis[0].categories.push(result.oxi.date);

                                    series2.addPoint([result.oxi.date,result.oxi.spo2[0]], true,true);
                                    series1.addPoint([result.oxi.date,result.oxi.bpm[0]], true,true); 
                                    // $('#oximeter').html(result.oxi.bpm);
                                    datetime = result.oxi.last_data;
                                    $('#denyut').html(result.oxi.last_bpm);
                                    $('#oxygen').html(result.oxi.last_spo2);
                                }
                            });
                            count++
                        }
                    }, 1000);
                }
            }
        },
        yAxis: {
            min: 0,
            title: false,
            tickInterval: 30,
            title: false,
            labels: {
                style: {
                    color: 'white'
                }
            }
        },
        xAxis: {
            categories: datajson.oxi.date,
            crosshair: true,
            labels: {
                style: {
                    color: 'white'
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            itemStyle: {
                color: '#FFFFFF'
            }
        },
        series: [{
            name: 'BPM',
            data: datajson.oxi.bpm
        }, {
            name: 'SpO2',
            data: datajson.oxi.spo2,
            color: '#FF0000'
        }],
        exporting: {
            enabled: false
        },
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500,
                    maxHeight: 500,
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f}</b><br/>',
            valueSuffix: ' cm',
            shared: true
        }
    });
  }

  function chartJarak(datajson) {
    datetime = datajson.sensorjarak.last_data;
    tinggi = $('.panel-header').height();
    lebar = $('.panel-header').width();
    count = 0;
    console.log(lebar)
    Highcharts.chart('sensorjarak', {
        title: { text: "Sensor Jarak" ,
            style: {
                color: '#FFFFFF',
                fontWeight: 'bold'
            }
        },
        subtitle:false,
        chart: {
            backgroundColor: '#141e30',
            height: tinggi,
            width: lebar,
            type: 'line',
            events: {
                load: function() {
                    //set up the updating of the chart each second
                    console.log(this.series)
                    var series1 = this.series[0];
                    var chart = this;
                    var kategories = this.xAxis[0].categories;
                    setInterval(function() {
                        if (count<5) {
                            $.ajax({
                              type: "POST",
                              url: "ajax.php", 
                              data: {now: datetime, limit : 1, data : "jarak"},
                              success: function(result){
                                chart.xAxis[0].categories.push(result.sensorjarak.date);
                                series1.addPoint([result.sensorjarak.date,result.sensorjarak.value[0]], true,true); 
                                // $('#sensorjarakmeter').html(result.sensorjarak.bpm);
                                datetime = result.sensorjarak.last_data;
                                $('#jarak').html(result.sensorjarak.last_jarak);
                               }
                            });
                        }
                        count++;
                    }, 1000);
                }
            }
        },
        yAxis: {
            min: 50,
            title: false,
            tickInterval: 10,
            title: false,
            labels: {
                style: {
                    color: 'white'
                }
            }
        },
        xAxis: {
            categories: datajson.sensorjarak.date,
            crosshair: true,
            labels: {
                style: {
                    color: 'white'
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            itemStyle: {
                color: '#FFFFFF'
            }
        },
        series: [{
            name: 'Jarak',
            data: datajson.sensorjarak.value
        }],
        exporting: {
            enabled: false
        },
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500,
                    maxHeight: 500,
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f} cm</b><br/>',
            valueSuffix: ' cm',
            shared: true
        }
    });
  }

  function chartKelembapan(datajson) {
    datetime = datajson.sensorkelembapan.last_data;
    tinggi = $('.panel-header').height();
    lebar = $('.panel-header').width();
    count = 0;
    console.log(lebar)
    Highcharts.chart('sensorKelembapan', {
        title: { text: "Sensor Kelembaban Udara" ,
            style: {
                color: '#FFFFFF',
                fontWeight: 'bold'
            }
        },
        subtitle:false,
        chart: {
            backgroundColor: '#141e30',
            height: tinggi,
            width: lebar,
            type: 'line',
            events: {
                load: function() {
                    //set up the updating of the chart each second
                    console.log(this.series)
                    var series1 = this.series[0];
                    var chart = this;
                    var kategories = this.xAxis[0].categories;
                    setInterval(function() {
                        if (count<5) {
                            $.ajax({
                              type: "POST",
                              url: "ajax.php", 
                              data: {now: datetime, limit : 1, data : "udara"},
                              success: function(result){
                                chart.xAxis[0].categories.push(result.sensorkelembapan.date);
                                series1.addPoint([result.sensorkelembapan.date,result.sensorkelembapan.value[0]], true,true); 
                                // $('#sensorkelembapanmeter').html(result.sensorkelembapan.bpm);
                                datetime = result.sensorkelembapan.last_data;
                                $('#udara').html(result.sensorkelembapan.last_lembab);
                               }
                            });
                        }
                        count++;
                    }, 1000);
                }
            }
        },
        yAxis: {
            min: 0,
            title: false,
            tickInterval: 10,
            title: false,
            labels: {
                style: {
                    color: 'white'
                }
            }
        },
        xAxis: {
            categories: datajson.sensorkelembapan.date,
            crosshair: true,
            labels: {
                style: {
                    color: 'white'
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            itemStyle: {
                color: '#FFFFFF'
            }
        },
        series: [{
            name: 'Kelembaban',
            data: datajson.sensorkelembapan.value
        }],
        exporting: {
            enabled: false
        },
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500,
                    maxHeight: 500,
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.1f} cm</b><br/>',
            valueSuffix: ' cm',
            shared: true
        }
    });
  }

  function clockUpdate() {
      var date = new Date();
      $('.digital-clock').css({'color': '#fff', 'text-shadow': '0 0 6px #ff0'});
      function addZero(x) {
        if (x < 10) {
          return x = '0' + x;
        } else {
          return x;
        }
      }

      function twelveHour(x) {
        if (x > 12) {
          return x = x - 12;
        } else if (x == 0) {
          return x = 12;
        } else {
          return x;
        }
      }

      var h = addZero(date.getHours());
      // var h = addZero(twelveHour(date.getHours()));
      var m = addZero(date.getMinutes());
      var s = addZero(date.getSeconds());

      $('#waktu').text(h + ':' + m + ':' + s)
      $('#waktu1').text(h + ':' + m + ':' + s)
      $('#waktu2').text(h + ':' + m + ':' + s)
      $('#waktu3').text(h + ':' + m + ':' + s)
    }

    function tableSuhuTubuh() {
        count = 0;
        setInterval(function(){
            if (count<5) {
                $.ajax({
                    type: "POST",
                    url: "table.php", 
                    success: function(result){
                        $('#sensorSuhuTubuh').html(result);
                        $('#panel-sensorsuhu').height($('#sensorSuhuTubuh').height());
                        $( ".grid-mlx" ).each(function( index ) {
                            if (parseInt($( this ).text())<=20) {
                                $( this ).css({"background-color": "#00af91"});
                            }else if (parseInt($( this ).text())<=36.5) {
                                $( this ).css({"background-color": "#007965"});
                            }else if (parseInt($( this ).text())<=37.5) {
                                $( this ).css({"background-color": "#ffcc29"});
                            }else if (parseInt($( this ).text())>37.5) {
                                $( this ).css({"background-color": "#91091e"});
                            }
                        });
                  }
                });
            }
            count++;
        }, 1200);
    }
})(jQuery)
