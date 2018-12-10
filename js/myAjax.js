function serv(pageurl,argums)
{
	var res="";
	var jqxhr = $.ajax({url: pageurl, data: argums,  async: false})
	.done(function(data) {res=data;});
	return res;
}
function serv_post(pageurl,argums)
{
	var res="";
	var jqxhr = $.ajax({url: pageurl, data: argums,  async: false, method:'post'})
	.done(function(data) {res=data;});
	return res;
}

function serva(pageurl,argums,donefunc,failfunc)
{
	var jqxhr = $.ajax({url: pageurl, data: argums,  async: true})
	.done(function(data) {donefunc(data);})
	.fail(function(data) {failfunc();});
	return;
}