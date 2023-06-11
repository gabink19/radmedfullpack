/**
 * Highcharts data
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */
(function ($) {

  const data_json = [];
  getJson();

  function getJson(){
    $.ajax({
        type: "GET",
        url: "ajax.php", 
        success: function(result){
          chartOxi(result);
      }
    });
  }

  function chartOxi(datajson) {
    Highcharts.chart('oximeter', {
        title: false,
        subtitle:false,
        chart: {
            type: 'line',
            events: {
                load: function() {
                    //set up the updating of the chart each second
                    var series1 = this.series[0];
                    var series2 = this.series[1];
                    var chart = this;
                    var kategories = this.xAxis[0].categories;
                    setInterval(function() {
                        $.ajax({
                          type: "GET",
                          url: "ajax.php?update=true", 
                          success: function(result){
                            chart.xAxis[0].categories.push(result.oxi.date);
                            series1.addPoint([result.oxi.date,result.oxi.bpm[0]], true,true); 
                            // $('#oximeter').html(result.oxi.bpm);
                            datetime = result.oxi.last_data;
                           }
                        });
                    }, 61000);
                }
            }
        },
        yAxis: {
            title: false,
            tickInterval: 1000,
            title: false
        },
        xAxis: {
            categories: datajson.oxi.date,
            crosshair: true,
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        series: [{
            name: 'Wallet BTC',
            data: datajson.oxi.bpm
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
            pointFormat: '<b>Rp. {point.y}</b><br/>',
            valueSuffix: '',
            shared: true
        }
    });
  }

  
})(jQuery)
