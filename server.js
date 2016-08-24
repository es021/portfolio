var express = require('express');
var app = express();

/////////////////////////////////////////////////////////////////////////////////////
/// APP INIT ////////////////////////////////////////////////////////////////////////
/// APP INIT ////////////////////////////////////////////////////////////////////////

appInit();

function appInit()
{
  app.use(express.static(__dirname + '/www'));

  app.set('port', process.env.PORT || 8100);
  app.listen(app.get('port'), function () {
      console.log('Express server listening on port ' + app.get('port'));
  });	

  app.get('/', function (request, response) {
	    response.sendFile(__dirname + "/www/index.html");
  });	
}