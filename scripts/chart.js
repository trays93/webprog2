function chartMaker() {
    let myChart = document.getElementById('myChart').getContext('2d');


    Chart.defaults.font.size = 18;
    Chart.defaults.font.family = 'Lato';
    Chart.defaults.font.color = '#000';
        

    let massPopChart = new Chart(myChart, {
    type:'bar',
    data:{
        labels: labels,
        datasets:[ {
        label: 'Szoftverek népszerűsége',
        data: datas, //[695506, 185174, 152160, 120479, 110267, 95678, 95347, 94604],
        backgroundColor: colors,/*[
            'rgba(20, 20, 20, 0.6)',
            'rgba(40, 40, 40, 0.6)',
            'rgba(60, 60, 60, 0.6)',
            'rgba(80, 80, 80, 0.6)',
            'rgba(100, 100, 100, 0.6)',
            'rgba(120, 120, 120, 0.6)',
            'rgba(140, 140, 140, 0.6)',
            'rgba(160, 160, 160, 0.6)'],*/
        borderWidth: 0,
        borderColor: '#777',
        hoverBorderWidth: 1,
        hoverBorderColor: '#000'}]
    },
    options:{}
    }) 

}


$(document).ready(function() {
    chartMaker();
})