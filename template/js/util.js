function ChN(xN)	// это целое число без знака ?
{
	var num="0123456789";
	ret=true;
	for(i=0;i<xN.length;i++){ 
		if (num.indexOf(xN.charAt(i))<0){ ret=false; break;}
	}
	return ret;
}

function IsTime(tm){	// это время "чч:мм" ?
	var ret=false,hh,mm;
	if (tm.charAt(2)!=':') return ret;
	if (tm.length==5)
	{
		hh=tm.substring(0,2);	// часы
		mm=tm.substring(3,5);	// мин
		if (!ChN(hh) || !ChN(mm)) return ret;
		if (  0<=hh && hh<24 ) {
			if (  0<=mm && mm<60 ) {ret=true;}
		}
	}
	return ret;
}

function IsObjTime(obj){	// ввели время "чч:мм" или "" ?
	obj.value=Trim(obj.value);
	if (obj.value=='') return 1;
	if (!IsTime(obj.value))
	{	alert('Неверное время !');
		SetTimeFocus(obj.id);
		return 0;
	}else {return 1;}
}

function IsDate(dt){	// это дата "dd/mm/year" ?
	var ret=false,dd,mm,gg;
	dm= new Array(31,28,31,30,31,30,31,31,30,31,30,31);

	if (dt.charAt(2)!='/' || dt.charAt(5)!='/') return ret;
	if (dt.length==10)
	{
		dd=dt.substring(0,2);	// день
		mm=dt.substring(3,5);	// месяц
		gg=dt.substring(6,10);	// год
		if (!ChN(dd) || !ChN(mm) || !ChN(gg) ) return ret;

		if (  gg==(100*Math.floor(gg/100)) ) {
			if (gg==(400*Math.floor(gg/400)) ) dm[1]=29;
		}else {
			if (gg==(4*Math.floor(gg/4)) ) dm[1]=29;
		}
		if (0<mm && mm<13) {
			if ( 0<dd && dd<=dm[mm-1]) ret=true;
		}
	}
	return ret;
}

function IsObjDate(obj){	// Ввели дату "dd/mm/year" или "" ?
	obj.value=Trim(obj.value);
	if (obj.value=='') return 1;
	if (!IsDate(obj.value))
	{	alert('Неверная дата !');
		SetTimeFocus(obj.id);
		return 0;
	}else {return 1;}
}

// Функция установки фокуса по событию onBlur
function SetTimeFocus(id){ setTimeout('document.getElementById("'+id+'").focus()',200);}

// вернуть строку без пробелов с краёв
function Trim(str)
{	
	if(!str) return "";	
	var strX=str;
	strX=strX.replace(/^\s+/,''); // Удаляем все пробелы слева
	strX=strX.replace(/\s+$/,''); // Удаляем все пробелы справа
	return strX;
}

function TempDt(event, obj)
{
	if(event.keyCode==8) return false;
	var v=obj.value,l=v.length;
	if(l==2) obj.value=v+"/";
	if(l==5) obj.value=v+"/";
	return true;
}

function TempTm(event, obj)
{
	if(event.keyCode==8) return false;
	var v=obj.value;
	if(v.length==2) obj.value=v+":";
	return true;
}

// Преобразует текстовые дату и время в объект типа даты JavaScript
// DT : dd/mm/yyyy,   Tm:  hh:mm
function DateTime(Dt,Tm){
	var dayI=Dt.indexOf("/",0);
	var day=Dt.substring(dayI,0);
	
	var monthI=Dt.indexOf("/",dayI+1);
	var month=Dt.substring(dayI+1,monthI);
	
	var yearI=Dt.indexOf("/",monthI+1);
	var year=Dt.substring(monthI+1,Dt.length);
	
	var hoursI=Tm.indexOf(":",0);
	var hours=Tm.substring(hoursI,0);
	
	var minutesI=Tm.indexOf(":",hoursI+1);
	var minutes=Tm.substring(hoursI+1,Tm.length);
	
	return new Date(year, month-1, day, hours, minutes,0);
}

//-- Функция для ввода чисел с заданным кол-м знаков после запятой onLoad="mInput('id',6);"
function mInput(ID,dec)	//ввод чисел в поле с id=ID, dec-знаков после запятой
{
  var input=document.getElementById(ID);
  if (typeof input.onkeyup!='function') input.onkeyup=check;
  else {
	  var keyup = input.onkeyup;
	  input.onkeyup=function() {check(window.event);keyup();};
  }
  if (typeof input.onblur!='function') input.onblur=finish;
  else {
	 var blur = input.onblur;
	 input.onblur=function() {finish(window.event);blur();};
  }
  //input.onkeyup=check;
  //input.onblur=finish;
  function finish(e){
	if(!input.value) input.value=0;
	input.value=parseFloat(input.value).toFixed(dec);
	return true;
  }
  function check(e){
	var iv=input.value;	// пришло из поля
	// контроль получившегося поля
	var nn="";
	var pos=-1;	// позиция удаленного символа
	var pt=-1;	// позиция первой точки
	for (var i=0;i<iv.length;++i){
		b=iv.charAt(i);
		if(((b=="+")||(b=="-"))&&(i>0)){b=""; pos=i;}	// знак только вначале
		if(b==",")b="."; 	// перевод "," в "."
		if(b=="."){
			if(pt>-1){b=""; pos=pt+1;}
			else pt=i;	// это первая точка
		}
		if("0123456789.-+".indexOf(b)<0){b=""; pos=i;}
		nn=nn+b;
	}
	//if(nn.indexOf(".")==0)nn="0"+nn;	// если начало с "." то делаем "0."
	if(iv!=nn)input.value=nn;		// поле мы исправили и его запишем
	if(pos>=0) MvCur(input,pos);	// курсор на изменённый символ 
	return true;
  }
  return true;
}
//-- Конец форматного ввода

function MvCur(obj,num){ // Курсор в позицию "num" в поле ввода "obj"
 obj.focus();
 if(obj.createTextRange)// IE
 {
	var r=obj.createTextRange();
	r.move("character",num);
	r.select();
 }
 else{	// Mozilla
	//if(obj.selectionStart) 
	obj.setSelectionRange(num,num);
 }
 return true;
}

// Округлить N до P знаков после запятой
function rnd(N,P){return parseFloat(0+N).toFixed(P);}


