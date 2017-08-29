
var conn = new WebSocket('ws://localhost:8080');
conn.onmessage = function(e) { console.log(e.data); };
conn.onopen = function() { conn.send({"idUser":'+yiiConfig["idUser"]+'}); };