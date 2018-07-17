let username = 'devilishwtr'
let elem = document.getElementById('hi');


axios.post('http://192.168.5.235:80/Sites/DataWEBDLL.dll/datasnap/rest/TServerMethods1/GetCostMain/')
  .then(function(response){
    console.log(response.data); // ex.: { user: 'Your User'}
    console.log(response.status); // ex.: 200
  }); 