var horizontal_offset="9px"
var vertical_offset="0"
var ie=document.all
var ns6=document.getElementById&&!document.all


function showid(id)
{
	document.getElementById('table_'+id).style.display = '';
	document.getElementById('id_'+id).src = '/template/images/minimize.gif';
	document.getElementById('id_'+id).onclick = function(){ hideid(id); };
}

function hideid(id)
{
	document.getElementById('table_'+id).style.display = 'none';
	document.getElementById('id_'+id).src = '/template/images/maximize.gif';
	document.getElementById('id_'+id).onclick = function(id){ showid(id); };
}

function changeitem()
{
	
}

function afgewerkt(value)
{
	if(value == '0')
	{
		document.getElementById('afgewerkt1').style.background = 'red';
		document.getElementById('afgewerkt2').style.background = 'red';
		document.getElementById('afgewerkt1').style.color = 'white';
		document.getElementById('afgewerkt2').style.color = 'white';
		document.getElementById('afgewerkt3').style.display = 'none';
		document.getElementById('afgewerkt4').style.display = 'none';
		document.getElementById('afgewerkt5').style.color = 'white';
	}
	else
	{
		document.getElementById('afgewerkt1').style.background = 'none';
		document.getElementById('afgewerkt2').style.background = 'none';
		document.getElementById('afgewerkt1').style.color = '#0059A4';
		document.getElementById('afgewerkt2').style.color = '#0059A4';
		document.getElementById('afgewerkt3').style.display = '';
		document.getElementById('afgewerkt4').style.display = '';
		document.getElementById('afgewerkt5').style.color = '#666666';
	}
	
}

function filter(data)
{
	if(itemid)
	{	
		window.location = '/?systemmodule='+sysmod+'&view='+sysview+'&action='+sysaction+'&item='+itemid+'&sort='+data;		
	}
	else if(sysaction)
	{
		window.location = '/?systemmodule='+sysmod+'&view='+sysview+'&action='+sysaction+'&sort='+data;	
	}
	else
	{
		window.location = '/?systemmodule='+sysmod+'&view='+sysview+'&sort='+data;	
	}	
}

$(function() {
	var dates = $( "#startdate, #enddate" ).datepicker({
		defaultDate: "+1w",
		changeMonth: true,
		numberOfMonths: 3,
		onSelect: function( selectedDate ) {
			var option = this.id == "from" ? "minDate" : "maxDate",
				instance = $( this ).data( "datepicker" ),
				date = $.datepicker.parseDate(
					instance.settings.dateFormat ||
					$.datepicker._defaults.dateFormat,
					selectedDate, instance.settings );
			dates.not( this ).datepicker( "option", option, date );
		}
	});
});

jQuery(function($)
{
  	var menuRoot = $("#menu-root");
    var menu = $("#menu");
    menuRoot
    .attr("href","javascript:void(0)")
    .click(function(){ menu2.hide(); menu.toggle(); menuRoot.blur(); return(false); });
    $(document).click(function(event){ if(menu.is(":visible") && !$(event.target).closest("#menu").size()) menu.hide(); });

  	var menuRoot2 = $("#menu-root2");
    var menu2 = $("#menu2");
    menuRoot2
    .attr("href","javascript:void(0)")
    .click(function(){ menu.hide(); menu2.toggle(); menuRoot2.blur(); return(false); });
    $(document).click(function(event){ if(menu2.is(":visible") && !$(event.target).closest("#menu2").size()) menu2.hide(); });

});

function createGroupsSave1()
{
	document.cmsform.sendto.value = document.webpage.selection.value;
	closeMessage();return false
}

function createGroups1()
{
	select = document.webpage.select;
	id = "";
	value = "";
	selecter = "";
	
	total= 0;
	for (i=0;i<select.length;++ i)
  	{
		if (select[i].checked)
		{
			total = total+1;
		}
	}
	total = total-1;
	calc  = 0;
	for (i=0;i<select.length;++ i)
  	{
 		if (select[i].checked)
		{
			if(total == calc)
			{
				value=value + select[i].value;
			}
			else
			{
				value=value + select[i].value + ",";
			}
		++ calc;
		}
  	}
	
	document.webpage.selection.value = value;
}

function createGroupsSave()
{
	document.cmsform.to.value = document.webpage.groups.value;
	document.cmsform.toname.value = document.webpage.selection.value;
	closeMessage();return false
}

function createGroups()
{
	select = document.webpage.select;
	id = "";
	value = "";
	selecter = "";
	
	total= 0;
	for (i=0;i<select.length;++ i)
  	{
		if (select[i].checked)
		{
			total = total+1;
		}
	}
	total = total-1;
	calc  = 0;
	for (i=0;i<select.length;++ i)
  	{
 		if (select[i].checked)
		{
			if(total == calc)
			{
				id=id + select[i].value;
				value=value + select[i].alt + "; ";
			}
			else
			{
				id=id + select[i].value + ",";
				value=value + select[i].alt + "; ";
			}
		++ calc;
		}
  	}
	
	document.webpage.groups.value = id;
	document.webpage.selection.value = value;
}

function createGroups33()
{
	select = document.cmsform.check;
	id = "";
	value = "";
	selecter = "";
	
	total= 0;
	for (i=0;i<select.length;++ i)
  	{
		if (select[i].checked)
		{
			total = total+1;
		}
	}
	total = total-1;
	calc  = 0;
	for (i=0;i<select.length;++ i)
  	{
 		if (select[i].checked)
		{
			if(total == calc)
			{
				id=id + select[i].value;
			}
			else
			{
				id=id + select[i].value + ",";
			}
		++ calc;
		}
  	}
	
	document.parent.webpage.selection.value = id;
}

function manager(action,id)
{
	if(action == 'edit')
	{
		window.location = "/?systemmodule="+sysmod+"&view=edit&item="+id;
	}
	if(action == 'active')
	{
		//alert("/?systemmodule="+sysmod+"&view=active&item="+id);
		window.location = "/?systemmodule="+sysmod+"&view=active&item="+id;
	}
}

function GetNowClock()
{
d = new Date();
nhour  = d.getHours();
nmin   = d.getMinutes();
nsec   = d.getSeconds();

if(nhour <= 9){nhour="0"+nhour}
if(nmin <= 9){nmin="0"+nmin}
if(nsec <= 9){nsec="0"+nsec}
document.getElementById('starttime').value = nhour+":"+nmin;
//document.cmsform.starttime.value = nhour+":"+nmin;
setTimeout("GetClock()", 1);

}

function GetClock(){

var time = document.cmsform.starttime.value;	

d = new Date();
nhour  = d.getHours();
nmin   = d.getMinutes();
nsec   = d.getSeconds();

if(nhour <= 9){nhour="0"+nhour}
if(nmin <= 9){nmin="0"+nmin}
if(nsec <= 9){nsec="0"+nsec}

document.cmsform.endtime.value = nhour+":"+nmin;
setTimeout("GetClock()", 1);
}

function formfocus()
{
 	document.cmsform.company.focus();
	//GetNowClock();
}

if(sysmod == 'register-new-call' && sysaction == 'new') window.onload = formfocus;




function save(action,id)
{
	if(action == 'new')
	{
		document.webpage.action = '/?systemmodule='+sysmod+'&view='+sysview+'&action=new&return=edit&item='+itemid;
		document.webpage.submit();
	}
	else if(action == 'edit')
	{
		document.webpage.action = '/?systemmodule='+sysmod+'&view='+sysview+'&action=edit&return=edit&save='+id+'&item='+itemid;
		document.webpage.submit();	
	}
}

function newitems()
{
	window.location = '/?systemmodule='+sysmod+'&view=new&action=new';	
}

function mask(){
	jQuery(function($){
		$(".time").mask("99:99",{placeholder:" "});
	});
}

function deleteitems()
{
	var question = confirm('Wilt u doorgaan met verwijderen?');
	if(question)
	{
		document.cmsform.action = '/?systemmodule='+sysmod+'&view='+sysview+'&action=delete&return=edit&item='+itemid;
		document.cmsform.submit();	
	}
}

function deleteitemsnow()
{
	var question = confirm('Wilt u doorgaan met verwijderen?');
	if(question)
	{
		document.cmsform.action = '/?systemmodule='+sysmod+'&view='+sysview+'&action=deletenow&return=edit&item='+itemid;
		document.cmsform.submit();	
	}
}

function replyitems()
{
	document.cmsform.action = '/?systemmodule='+sysmod+'&view='+sysview+'&action=replys&return=edit&item='+itemid;
	document.cmsform.submit();
}

function forwarditems()
{
	document.cmsform.action = '/?systemmodule='+sysmod+'&view='+sysview+'&action=forwards&return=edit&item='+itemid;
	document.cmsform.submit();
}

function changefolder()
{
	document.cmsform.action = '/?systemmodule='+sysmod+'&view='+sysview+'&action=changefolder&return=edit&item='+itemid;
	document.cmsform.submit();
}

function createOrder()
{
	select=document.permissions.select;
	id= "";
	value= "";
	selecter= "";
	
	total= 0;
	for (i=0;i<select.length;++ i)
  	{
		if (select[i].checked)
		{
			total = total+1;
		}
	}
	total = total-1;
	calc  = 0;
	for (i=0;i<select.length;++ i)
  	{
 		if (select[i].checked)
		{
			if(total == calc)
			{
				id=id + select[i].value;
				value=value + select[i].alt;
				selecter=selecter + '<img src="/template/images/pijl.gif"> ' + select[i].alt;
			}
			else
			{
				id=id + select[i].value + ",";
				value=value + select[i].alt + ",";
				selecter=selecter + '<img src="/template/images/pijl.gif"> ' + select[i].alt + "<br>";
			}
		++ calc;
		}
  	}
	
	document.getElementById("persmissionid").innerHTML=id;
	document.getElementById("persmissionname").innerHTML=value;
	document.getElementById("persmissionselecter").innerHTML=selecter;
}

function control_show(contentid)
{
	var article = document.getElementById(contentid);
	article.style.visibility = 'visible';
}

function control_hide(contentid)
{
	var article = document.getElementById(contentid);
	article.style.visibility = 'hidden';
	
}

function deletelogin(id)
{
	window.location = "/?delete="+id;
}

function loginuser(id)
{
	window.location = "/?login="+id;
}

function loginscreen()
{
	var cookiescreen = document.getElementById('cookielogins');
	var loginscreen = document.getElementById('logonscreen');
	cookiescreen.style.display = "none";
	loginscreen.style.display = "block";
}

function uitloggen()
{
	window.location = "/?logout=true";
}

function userlogin_show(contentid)
{
	var block = document.getElementById('userlogin'+contentid);
	block.style.backgroundColor = '#E3E3E3';
	var login = document.getElementById('login'+contentid);
	login.style.visibility = 'visible';
}

function userlogin_hide(contentid)
{
	var block = document.getElementById('userlogin'+contentid);
	block.style.backgroundColor = '#ffffff';
	var login = document.getElementById('login'+contentid);
	login.style.visibility = 'hidden';
}

shortcut = {
	'all_shortcuts':{},//All the shortcuts are stored in this array
	'add': function(shortcut_combination,callback,opt) {
		//Provide a set of default options
		var default_options = {
			'type':'keydown',
			'propagate':false,
			'disable_in_input':false,
			'target':document,
			'keycode':false
		}
		if(!opt) opt = default_options;
		else {
			for(var dfo in default_options) {
				if(typeof opt[dfo] == 'undefined') opt[dfo] = default_options[dfo];
			}
		}

		var ele = opt.target;
		if(typeof opt.target == 'string') ele = document.getElementById(opt.target);
		var ths = this;
		shortcut_combination = shortcut_combination.toLowerCase();

		//The function to be called at keypress
		var func = function(e) {
			e = e || window.event;
			
			if(opt['disable_in_input']) { //Don't enable shortcut keys in Input, Textarea fields
				var element;
				if(e.target) element=e.target;
				else if(e.srcElement) element=e.srcElement;
				if(element.nodeType==3) element=element.parentNode;

				if(element.tagName == 'INPUT' || element.tagName == 'TEXTAREA') return;
			}
	
			//Find Which key is pressed
			if (e.keyCode) code = e.keyCode;
			else if (e.which) code = e.which;
			var character = String.fromCharCode(code).toLowerCase();
			
			if(code == 188) character=","; //If the user presses , when the type is onkeydown
			if(code == 190) character="."; //If the user presses , when the type is onkeydown

			var keys = shortcut_combination.split("+");
			//Key Pressed - counts the number of valid keypresses - if it is same as the number of keys, the shortcut function is invoked
			var kp = 0;
			
			//Work around for stupid Shift key bug created by using lowercase - as a result the shift+num combination was broken
			var shift_nums = {
				"`":"~",
				"1":"!",
				"2":"@",
				"3":"#",
				"4":"$",
				"5":"%",
				"6":"^",
				"7":"&",
				"8":"*",
				"9":"(",
				"0":")",
				"-":"_",
				"=":"+",
				";":":",
				"'":"\"",
				",":"<",
				".":">",
				"/":"?",
				"\\":"|"
			}
			//Special Keys - and their codes
			var special_keys = {
				'esc':27,
				'escape':27,
				'tab':9,
				'space':32,
				'return':13,
				'enter':13,
				'backspace':8,
	
				'scrolllock':145,
				'scroll_lock':145,
				'scroll':145,
				'capslock':20,
				'caps_lock':20,
				'caps':20,
				'numlock':144,
				'num_lock':144,
				'num':144,
				
				'pause':19,
				'break':19,
				
				'insert':45,
				'home':36,
				'delete':46,
				'end':35,
				
				'pageup':33,
				'page_up':33,
				'pu':33,
	
				'pagedown':34,
				'page_down':34,
				'pd':34,
	
				'left':37,
				'up':38,
				'right':39,
				'down':40,
	
				'f1':112,
				'f2':113,
				'f3':114,
				'f4':115,
				'f5':116,
				'f6':117,
				'f7':118,
				'f8':119,
				'f9':120,
				'f10':121,
				'f11':122,
				'f12':123
			}
	
			var modifiers = { 
				shift: { wanted:false, pressed:false},
				ctrl : { wanted:false, pressed:false},
				alt  : { wanted:false, pressed:false},
				meta : { wanted:false, pressed:false}	//Meta is Mac specific
			};
                        
			if(e.ctrlKey)	modifiers.ctrl.pressed = true;
			if(e.shiftKey)	modifiers.shift.pressed = true;
			if(e.altKey)	modifiers.alt.pressed = true;
			if(e.metaKey)   modifiers.meta.pressed = true;
                        
			for(var i=0; k=keys[i],i<keys.length; i++) {
				//Modifiers
				if(k == 'ctrl' || k == 'control') {
					kp++;
					modifiers.ctrl.wanted = true;

				} else if(k == 'shift') {
					kp++;
					modifiers.shift.wanted = true;

				} else if(k == 'alt') {
					kp++;
					modifiers.alt.wanted = true;
				} else if(k == 'meta') {
					kp++;
					modifiers.meta.wanted = true;
				} else if(k.length > 1) { //If it is a special key
					if(special_keys[k] == code) kp++;
					
				} else if(opt['keycode']) {
					if(opt['keycode'] == code) kp++;

				} else { //The special keys did not match
					if(character == k) kp++;
					else {
						if(shift_nums[character] && e.shiftKey) { //Stupid Shift key bug created by using lowercase
							character = shift_nums[character]; 
							if(character == k) kp++;
						}
					}
				}
			}
			
			if(kp == keys.length && 
						modifiers.ctrl.pressed == modifiers.ctrl.wanted &&
						modifiers.shift.pressed == modifiers.shift.wanted &&
						modifiers.alt.pressed == modifiers.alt.wanted &&
						modifiers.meta.pressed == modifiers.meta.wanted) {
				callback(e);
	
				if(!opt['propagate']) { //Stop the event
					//e.cancelBubble is supported by IE - this will kill the bubbling process.
					e.cancelBubble = true;
					e.returnValue = false;
	
					//e.stopPropagation works in Firefox.
					if (e.stopPropagation) {
						e.stopPropagation();
						e.preventDefault();
					}
					return false;
				}
			}
		}
		this.all_shortcuts[shortcut_combination] = {
			'callback':func, 
			'target':ele, 
			'event': opt['type']
		};
		//Attach the function with the event
		if(ele.addEventListener) ele.addEventListener(opt['type'], func, false);
		else if(ele.attachEvent) ele.attachEvent('on'+opt['type'], func);
		else ele['on'+opt['type']] = func;
	},

	//Remove the shortcut - just specify the shortcut and I will remove the binding
	'remove':function(shortcut_combination) {
		shortcut_combination = shortcut_combination.toLowerCase();
		var binding = this.all_shortcuts[shortcut_combination];
		delete(this.all_shortcuts[shortcut_combination])
		if(!binding) return;
		var type = binding['event'];
		var ele = binding['target'];
		var callback = binding['callback'];

		if(ele.detachEvent) ele.detachEvent('on'+type, callback);
		else if(ele.removeEventListener) ele.removeEventListener(type, callback, false);
		else ele['on'+type] = false;
	}
}

if(sysmod == 'register-new-call')
{
	if(sysaction == 'actueel')
	{
		shortcut.add("Ctrl+N",function() 
		{
			document.cmsform.action = '/?systemmodule=register-new-call&view=editor&action=actueel&page=edit&id='+headid;
			document.cmsform.submit();
		});
		shortcut.add("insert",function() { window.open("/?systemmodule=register-new-call&view=editor&action=new","_blank"); });
		shortcut.add("Ctrl+S",function() { document.cmsform.submit(); });
	}
	else
	{
		shortcut.add("Ctrl+N",function() 
		{
			document.cmsform.action = '/?systemmodule=register-new-call&view=editor&action=new&page=new';
			document.cmsform.submit();
		});
		shortcut.add("insert",function() { window.open("/?systemmodule=register-new-call&view=editor&action=new","_blank"); });
		shortcut.add("Ctrl+S",function() { document.cmsform.submit(); });
	}
}
else
{
	shortcut.add("insert",function() { window.open("/?systemmodule=register-new-call&view=editor&action=new","_blank"); });
}
 


if(sysview == 'editor')
{
	if(sysmod == 'register-new-call' || sysmod == 'register-new-copy' || sysmod == 'register-edit-call' || sysmod == 'register-archive-call')
	{
		function checkSaveStatus(e)
		{	
			if(window.event) window.event.returnValue = "!!";
			else e.preventDefault();
		}
	
		//window.onbeforeunload = checkSaveStatus;
		shortcut.add("Ctrl+R",function(){ return false; });
		shortcut.add("Ctrl+F5",function(){ return false; });
		shortcut.add("Ctrl+T",function(){ addRowToTableNew(); return false; });
		
		shortcut.add("F5",function(){ document.cmsform.job.focus(); return false; });
		shortcut.add("F6",function(){ document.cmsform.relationname.focus(); return false; });
		shortcut.add("F7",function(){ document.cmsform.address.focus(); return false; });
		shortcut.add("F8",function(){ document.cmsform.content.focus(); return false; });
		shortcut.add("F9",function()
		{
			if(document.cmsform.ready[0].checked)
			{
				var data = document.cmsform.ready[1].checked = true;
				data.checked = true;
				afgewerkt(0);
			}
			else
			{
				var data = document.cmsform.ready[0].checked = true;
				data.checked = true;
				afgewerkt(1);
			}
		});
		shortcut.add("F10",function()
		{
			if(document.cmsform.send[0].checked)
			{
				var data = document.cmsform.send[1].checked = true;
				data.checked = true;
			}
			else
			{
				var data = document.cmsform.send[0].checked = true;
				data.checked = true;
			}
		});
		shortcut.add("F11",function()
		{
			if(document.cmsform.archief[0].checked)
			{
				var data = document.cmsform.archief[1].checked = true;
				data.checked = true;
			}
			else
			{
				var data = document.cmsform.archief[0].checked = true;
				data.checked = true;
			}
		});
		shortcut.add("F12",function()
		{
			if(document.cmsform.elements["data[0][rightjob]"].value)
			{
				document.cmsform.elements["data[0][rightjob]"].focus();				
			}
		});
	}

	if(sysaction == 'new' || sysaction == 'edit')
	{
		shortcut.add("Ctrl+S",function()
		{
			document.cmsform.action ="/?systemmodule="+sysmod+"&view="+sysview+"&return=save&action="+sysaction+"&item="+itemid;
			document.cmsform.target = "_self";
			document.cmsform.submit();
		});
	}
}

	function addRowToTableNew()
	{
	  if(document.cmsform.companyid.value == "")
	  {
	     alert('Selecteer eerst een debiteur!');
		 return false;  
	  }
	  
	  var tbl = document.getElementById('tblSample');
	  var lastRow = tbl.rows.length;
	  var iteration = lastRow;
	  var row = tbl.insertRow(lastRow);
	  
	  var cella1 = row.insertCell(0);
	  var data = document.getElementById('divright').innerHTML;
	  var cell1 = cella1.innerHTML = '<select id="rightjob'+iteration+'" name="data['+iteration+'][rightjob]" style="width:80px">'+data+'</select>';
	
	  var cella2 = row.insertCell(1);
	  var cell2 = document.createElement('input');
	  cell2.type = 'text';
	  cell2.id = 'rightdate'+iteration;
	  cell2.name = 'data['+iteration+'][rightdate]';
	  cell2.value = document.cmsform.datecall.value;
	  cell2.className = 'dateinput';
	  cell2.style.width = '70px';
	  cella2.appendChild(cell2);
	  
	  d = new Date();
  	  nhour  = d.getHours();
	  nmin   = d.getMinutes();
	  nsec   = d.getSeconds();
	  
	  if(nhour < 10) nhour = '0'+nhour;
	  if(nmin < 10)  nmin  = '0'+nmin;
	  if(nsec < 10)  nsec  = '0'+nsec;
	  
	  var cella3 = row.insertCell(2);
	  var cell3 = document.createElement('input');
	  cell3.type = 'text';
	  cell3.id = 'righttime'+iteration;
	  cell3.name = 'data['+iteration+'][righttime]';
	  cell3.value = nhour+':'+nmin;
	  cell2.className = 'timeinput';
	  cell3.style.width = '70px';
	  cella3.appendChild(cell3);
	  
	  var input = document.cmsform.mechanics;	  
	  var json = eval('('+input.value+')');  
	  
	  var cella4 = row.insertCell(3);
	  var inputt;
	  
	  inputt = '<select id="mechanicid'+iteration+'" onchange="dothis(this.value)" name="data['+iteration+'][mechanicid]" style="width:160px">';
	  inputt+= '<option value="0">Maak een keuze</option>';
	  for(i=0; i<=(json.data.length-1); i++)
	  {
		 inputt+= '<option value="'+iteration+'|'+(json.data[i].id)+'|'+(json.data[i].phonenumber)+'|'+(json.data[i].mobilenumber)+'">'+(json.data[i].mechanicname)+'</option>';
	  }
	  inputt+= '</select>';
	  
	  var cell4 = cella4.innerHTML = inputt;
	
	  var cella6 = row.insertCell(4);
	  var cell6 = document.createElement('input');
	  cell6.type = 'text';
	  cell6.id = 'rightphone'+iteration;
	  cell6.name = 'data['+iteration+'][rightphone]';
	  cell6.style.width = '160px';
	  cella6.appendChild(cell6);
	
	  var cella7 = row.insertCell(5);
	  var cell7 = document.createElement('input');
	  cell7.type = 'text';
	  cell7.id = 'rightmobile'+iteration;
	  cell7.name = 'data['+iteration+'][rightmobile]';
	  cell7.style.width = '160px';
	  cella7.appendChild(cell7);
	  
	  var cella8 = row.insertCell(6);
	  var cell8 = cella8.innerHTML = '<input type="button" value="X" onclick="document.getElementById(\'tblSample\').deleteRow('+iteration+');" />';
	  
	  jQuery(function($){
			$(".dateinput").mask("99-99-9999",{placeholder:" "});
			$(".dateinput").mask("99-99-9999",{placeholder:" "});
			$(".timeinput").mask("99:99",{placeholder:" "});
			document.getElementById('rightjob'+iteration).focus();
		});
	}
	
	function dothis(data)
	{
		data2 = data.split('|');
		
		document.getElementById('rightphone'+data2[0]).value = data2[2];
		document.getElementById('rightmobile'+data2[0]).value = data2[3];
	}
	
	function addRowToTableNewkopie()
	{
	  if(document.cmsform.companyid.value == "")
	  {
	     alert('Selecteer eerst een debiteur!');
		 return false;  
	  }
	  
	  var tbl = document.getElementById('tblSample');
	  var lastRow = tbl.rows.length;
	  var iteration = lastRow;
	  var row = tbl.insertRow(lastRow);
	  
	  var cella1 = row.insertCell(0);
	  var data = document.getElementById('divright').innerHTML;
	  var cell1 = cella1.innerHTML = '<select id="rightjob'+iteration+'" name="data['+iteration+'][rightjob]" style="width:80px">'+data+'</select>';
	
	  var cella2 = row.insertCell(1);
	  var cell2 = document.createElement('input');
	  cell2.type = 'text';
	  cell2.id = 'rightdate'+iteration;
	  cell2.name = 'data['+iteration+'][rightdate]';
	  cell2.className = 'dateinput';
	  cell2.value = document.cmsform.datecall.value;
	  cell2.style.width = '70px';
	  cella2.appendChild(cell2);
	  
	  d = new Date();
  	  nhour  = d.getHours();
	  nmin   = d.getMinutes();
	  nsec   = d.getSeconds();
	  
	  if(nhour < 10) nhour = '0'+nhour;
	  if(nmin < 10)  nmin  = '0'+nmin;
	  if(nsec < 10)  nsec  = '0'+nsec;
	  
	  var cella3 = row.insertCell(2);
	  var cell3 = document.createElement('input');
	  cell3.type = 'text';
	  cell3.id = 'righttime'+iteration;
	  cell3.name = 'data['+iteration+'][righttime]';
	  cell3.className = 'timeinput';
	  cell3.value = nhour+':'+nmin;
	  cell3.style.width = '70px';
	  cella3.appendChild(cell3);
	  
	  var input = document.cmsform.mechanics;	  
	  var json = eval('('+input.value+')');  
	  
	  var cella4 = row.insertCell(3);
	  var inputt;
	  
	  inputt = '<select id="mechanicid'+iteration+'" onchange="dothis(this.value)" name="data['+iteration+'][mechanicid]" style="width:160px">';
	  inputt+= '<option value="0">Maak een keuze</option>';
	  for(i=0; i<=(json.data.length-1); i++)
	  {
		 inputt+= '<option value="'+iteration+'|'+(json.data[i].id)+'|'+(json.data[i].phonenumber)+'|'+(json.data[i].mobilenumber)+'">'+(json.data[i].mechanicname)+'</option>';
	  }
	  inputt+= '</select>';
	  
	  var cell4 = cella4.innerHTML = inputt;
	
	  var cella6 = row.insertCell(4);
	  var cell6 = document.createElement('input');
	  cell6.type = 'text';
	  cell6.id = 'rightphone'+iteration;
	  cell6.name = 'data['+iteration+'][rightphone]';
	  cell6.style.width = '160px';
	  cella6.appendChild(cell6);
	
	  var cella7 = row.insertCell(5);
	  var cell7 = document.createElement('input');
	  cell7.type = 'text';
	  cell7.id = 'rightmobile'+iteration;
	  cell7.name = 'data['+iteration+'][rightmobile]';
	  cell7.style.width = '160px';
	  cella7.appendChild(cell7);
	  
	  var cella8 = row.insertCell(6);
	  var cell8 = cella8.innerHTML = '<input type="button" value="X" onclick="document.getElementById(\'tblSample\').deleteRow('+iteration+');" />';
	  
	  jQuery(function($){
		  $(".dateinput").mask("99-99-9999",{placeholder:" "});
	      $(".timeinput").mask("99:99",{placeholder:" "});
		  document.getElementById('rightjob'+iteration).focus();
	  });
	  
	}

	function deleteRow(tableID)
	{
    	try
		{
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
 
            for(var i=0; i<rowCount; i++)
			{
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked)
				{
                    document.getElementById('tblSample').deleteRow(i);
                    rowCount--;
                    i--;
                }
            }
       	}
		catch(e)
		{
         	alert(e);
        }
   	}

	function keyPressTest(e, obj)
	{
	  var validateChkb = document.getElementById('chkValidateOnKeyPress');
	  if (validateChkb.checked) {
		var displayObj = document.getElementById('spanOutput');
		var key;
		if(window.event) {
		  key = window.event.keyCode; 
		}
		else if(e.which) {
		  key = e.which;
		}
		var objId;
		if (obj != null) {
		  objId = obj.id;
		} else {
		  objId = this.id;
		}
		displayObj.innerHTML = objId + ' : ' + String.fromCharCode(key);
	  }
	}
	
	function removeRowFromTable()
	{
	  var tbl = document.getElementById('tblSample');
	  var lastRow = tbl.rows.length;
	  if (lastRow > 2) tbl.deleteRow(lastRow - 1);
	}
	function openInNewWindow(frm)
	{
	  // open a blank window
	  var aWindow = window.open('', 'TableAddRowNewWindow',
	   'scrollbars=yes,menubar=yes,resizable=yes,toolbar=no,width=400,height=400');
	   
	  // set the target to the blank window
	  frm.target = 'TableAddRowNewWindow';
	  
	  // submit
	  frm.submit();
	}
	function validateRow(frm)
	{
	  var chkb = document.getElementById('chkValidate');
	  if (chkb.checked) {
		var tbl = document.getElementById('tblSample');
		var lastRow = tbl.rows.length - 1;
		var i;
		for (i=1; i<=lastRow; i++) {
		  var aRow = document.getElementById('txtRow' + i);
		  if (aRow.value.length <= 0) {
			alert('Row ' + i + ' is empty');
			return;
		  }
		}
	  }
	  openInNewWindow(frm);
	}

shortcut.add("Ctrl+H",function() { window.location = "/?systemmodule="+sysmod+"&view=help"; });

function adduserpermission(id,name)
{
	document.getElementById("userpermissionsid").innerHTML=id;
	document.getElementById("userpermissionsname").innerHTML=name;
	document.getElementById("userpermissionsselecter").innerHTML= '<img src="/template/images/pijl.gif"> '+name;
}

function itemlink(action,itemid)
{
	if(action == 'help' || action == 'manager')
	{
		var question = confirm('Weet u zeker dat u wilt annuleren?');
		if(question) window.location = "/?systemmodule="+sysmod+"&view="+action;
	}
	
	if(action == 'new' || action == 'upload' || action == 'folder')
	{
		window.location = "/?systemmodule="+sysmod+"&view=editor&action="+action;
	}
	
	if(action == 'preview')
	{
		if(document.cmsform)
		{
			if(sysview == 'manager')
			{
				document.cmsform.action ="/systemmodule/"+sysmod+"/view/"+action+".php";
				document.cmsform.target = "popup";
				popup = window.open("about:blank", "popup", "toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=800,height=800,left = 560,top = 140");
				document.cmsform.submit();
			}
			else
			{
				document.cmsform.action ="/systemmodule/"+sysmod+"/view/"+action+".php";
				document.cmsform.target = "popup";
				popup = window.open("about:blank", "popup", "toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=800,height=800,left = 560,top = 140");
				document.cmsform.submit();
			}
		}
	}
	
	if(action == 'edit' || action == 'delete' || action == 'delete1' || action == 'delete2' || action == 'answer')
	{
		if(action == 'delete1')
		{
			question = confirm('Wilt u deze call verwijderen?');
			if(question)
			{
				window.location = '/?systemmodule=register-edit-call&view=editor&action=delete&item='+itemid;	
			}
			return false;
		}
		if(action == 'delete2')
		{
			question = confirm('Wilt u deze call verwijderen?');
			if(question)
			{
				window.location = '/?systemmodule=register-archive-call&view=editor&action=delete&item='+itemid;	
			}
			return false;
		}
		
		if(document.cmsform)
		{
			document.cmsform.action ="/?systemmodule="+sysmod+"&view="+action;
			document.cmsform.target = "_self";
			if(document.cmsform.sendtogroup || document.cmsform.template)
			{
				if(document.cmsform.sendtogroup.value == '' || document.cmsform.template.value == '')
				{
					alert('Controleer de volgende onderdelen:\n\n- Heeft u een template geselecteerd?\n- Heeft u ontvangersgroepen geselecteerd?');
				}
				else
				{
					document.cmsform.submit();
				}
			}
			else
			{
				document.cmsform.submit();
			}
		}
	}

	if(sysaction == 'new' || sysaction == 'actueel')
	{
		if(action == 'save' || action == 'apply')
		{
			if(document.cmsform)
			{
				document.cmsform.action ="/?systemmodule="+sysmod+"&view="+sysview+"&return="+action+"&action="+sysaction;
				document.cmsform.target = "_self";
				
				if(sysmod == 'register-new-call' && sysaction == 'actueel')
				{
					document.getElementById('savebutton').onclick = function dothis() { alert('De call word al opgeslagen!'); };
					document.cmsform.action ="/?systemmodule="+sysmod+"&view="+sysview+"&action="+sysaction+"&page=save&id="+headid;
					document.cmsform.target = "_self";
				}
				
				if(sysmod == 'register-new-call' && sysaction == 'new')
				{
					document.getElementById('savebutton').onclick = function dothis() { alert('De call word al opgeslagen!'); };
				}
				
				if(document.cmsform.sendtogroup || document.cmsform.template)
				{
					if(document.cmsform.systemmodule.value == '' || document.cmsform.template.value == '')
					{
						alert('Controleer de volgende onderdelen:\n\n- Heeft u een template geselecteerd?\n- Heeft u een pagina type geselecteerd?');
					}
					else
					{
						document.cmsform.submit();
					}
				}
				else
				{
					document.cmsform.submit();
				}
			}
		}		
	}

	if(sysaction == 'edit' || sysaction == 'answer')
	{
		if(action == 'save' || action == 'apply')
		{
			if(document.cmsform)
			{
				document.cmsform.action ="/?systemmodule="+sysmod+"&view="+sysview+"&return="+action+"&action="+sysaction+"&item="+itemid;
				document.cmsform.target = "_self";
				document.cmsform.submit();
			}
		}		
	}
	
	if(sysview == 'delete')
	{
		if(action == 'delete')
		{
			var question = confirm('Weet u zeker dat u dit item wilt verwijderen?');
			if(question)
			{
				document.cmsform.action ="/?systemmodule="+sysmod+"&view="+sysview+"&return="+action+"&action="+sysview;
				document.cmsform.target = "_self";
				document.cmsform.submit();
			}
		}
	}
	
	return;
}

function iwindow(page,data,id,width,height)
{
	displayMessage('/systemmodule/'+sysmod+'/view/'+page+'?data='+data+'&id='+id,width,height);
	return false;
}

function adduserpermissions()
{
	var userpermissionsid = document.getElementById('userpermissionsid').innerHTML;
	var userpermissionsname = document.getElementById('userpermissionsname').innerHTML;
	var userpermissionsselecter = document.getElementById('userpermissionsselecter').innerHTML;
	if(userpermissionsid)
	{
		document.forms[0].group.value = userpermissionsid;
		document.getElementById('userpermissionsvalue').innerHTML = userpermissionsselecter;
		
		closeMessage();
		return true;
	}
	else
	{
		var message = confirm('U heeft nog geen gebruikersgroepen geselecteerd. Wilt u doorgaan?');
		if(message)
		{
			closeMessage();
			return true;	
		}
	}
}

function getposOffset(what, offsettype)
{
	var totaloffset=(offsettype=="left")? what.offsetLeft : what.offsetTop;
	var parentEl=what.offsetParent;
	while (parentEl!=null)
	{
		totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
		parentEl=parentEl.offsetParent;
	}
	return totaloffset;
}

function iecompattest()
{
	return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function clearbrowseredge(obj, whichedge)
{
	var edgeoffset=(whichedge=="rightedge")? parseInt(horizontal_offset)*-1 : parseInt(vertical_offset)*-1
	if (whichedge=="rightedge")
	{
		var windowedge=ie && !window.opera? iecompattest().scrollLeft+iecompattest().clientWidth-30 : window.pageXOffset+window.innerWidth-40
		dropmenuobj.contentmeasure=dropmenuobj.offsetWidth
		if (windowedge-dropmenuobj.x < dropmenuobj.contentmeasure)
		edgeoffset=dropmenuobj.contentmeasure+obj.offsetWidth+parseInt(horizontal_offset)
	}
	else
	{
		var windowedge=ie && !window.opera? iecompattest().scrollTop+iecompattest().clientHeight-15 : window.pageYOffset+window.innerHeight-18
		dropmenuobj.contentmeasure=dropmenuobj.offsetHeight
		if (windowedge-dropmenuobj.y < dropmenuobj.contentmeasure)
		edgeoffset=dropmenuobj.contentmeasure-obj.offsetHeight
	}
	return edgeoffset
}

tinyMCE.init({
	// General options
    mode : "specific_textareas",
    theme : "advanced",
	editor_selector :"currentinformation",
                    
    relative_urls : false,
    document_base_url : "http://"+ window.location.hostname +"",
	
    language : "en",
    plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
            
    // Theme options
    theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,fontsizeselect,cut,copy,paste,pastetext,|,bullist,numlist,|,link,unlink,image,code,|,forecolor,backcolor",
    theme_advanced_buttons2 : "",
    theme_advanced_buttons3 : "",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resizing : false,
	theme_advanced_path : false,
	theme_advanced_resize_horizontal: 0,
            
    // Example content CSS (should be your site CSS)
    content_css : "/system/css/template.css",

    // Drop lists for link/image/media/template dialogs
    template_external_list_url : "editors/TinyMCE/examples/lists/template_list.js",
    external_link_list_url : "editors/TinyMCE/examples/lists/link_list.js",
    external_image_list_url : "editors/TinyMCE/examples/lists/image_list.js",
    media_external_list_url : "editors/TinyMCE/examples/lists/media_list.js"

});

var ds_i_date = new Date();
ds_c_month = ds_i_date.getMonth() + 1;
ds_c_year = ds_i_date.getFullYear();

function ds_getel(id) {
	return document.getElementById(id);
}

function ds_getleft(el) {
	var tmp = el.offsetLeft;
	el = el.offsetParent
	while(el) {
		tmp += el.offsetLeft;
		el = el.offsetParent;
	}
	return tmp;
}
function ds_gettop(el) {
	var tmp = el.offsetTop;
	el = el.offsetParent
	while(el) {
		tmp += el.offsetTop;
		el = el.offsetParent;
	}
	return tmp;
}

var ds_oe = document.getElementById('ds_calclass');
var ds_ce = document.getElementById('ds_conclass');
var ds_ob = ''; 

function ds_ob_clean() {
	ds_ob = '';
}
function ds_ob_flush() {
	document.getElementById('ds_calclass').innerHTML = ds_ob;
	ds_ob_clean();
}
function ds_echo(t) {
	ds_ob += t;
}

var ds_element;

var ds_monthnames = [
'januari', 'februari', 'maart', 'april', 'mei', 'juni',
'juli', 'augustus', 'september', 'oktober', 'november', 'december'
];

var ds_daynames = [
'zo', 'ma', 'di', 'wo', 'do', 'vr', 'za'
];

function ds_template_main_above(t) {
	return '<table cellpadding="3" cellspacing="0" class="ds_tbl">'
	     + '<tr>'
		 + '<td class="ds_head" style="cursor: pointer" onclick="ds_py();"><<</td>'
		 + '<td class="ds_head" style="cursor: pointer" onclick="ds_pm();"><</td>'
		 + '<td class="ds_head" style="cursor: pointer" onclick="ds_hi();" colspan="3">' + t + '</td>'
		 + '<td class="ds_head" style="cursor: pointer" onclick="ds_nm();">></td>'
		 + '<td class="ds_head" style="cursor: pointer" onclick="ds_ny();">>></td>'
		 + '</tr>'
		 + '<tr>';
}

function ds_template_day_row(t) {
	return '<td class="ds_subhead">' + t + '</td>';
}

function ds_template_new_week() {
	return '</tr><tr>';
}

function ds_template_blank_cell(colspan) {
	return '<td colspan="' + colspan + '"></td>'
}

function ds_template_day(d, m, y) {
	return '<td class="ds_cell" onclick="ds_onclick(' + d + ',' + m + ',' + y + ')">' + d + '</td>';
}

function ds_template_main_below() {
	return '</tr>'
	     + '</table>';
}

function ds_draw_calendar(m, y) {

	ds_ob_clean();
	ds_echo (ds_template_main_above(ds_monthnames[m - 1] + ' ' + y));
	for (i = 0; i < 7; i ++) {
		ds_echo (ds_template_day_row(ds_daynames[i]));
	}
	var ds_dc_date = new Date();
	ds_dc_date.setMonth(m - 1);
	ds_dc_date.setFullYear(y);
	ds_dc_date.setDate(1);
	if (m == 1 || m == 3 || m == 5 || m == 7 || m == 8 || m == 10 || m == 12) {
		days = 31;
	} else if (m == 4 || m == 6 || m == 9 || m == 11) {
		days = 30;
	} else {
		days = (y % 4 == 0) ? 29 : 28;
	}
	var first_day = ds_dc_date.getDay();
	var first_loop = 1;
	ds_echo (ds_template_new_week());
	if (first_day != 0) {
		ds_echo (ds_template_blank_cell(first_day));
	}
	var j = first_day;
	for (i = 0; i < days; i ++) {
		if (j == 0 && !first_loop) {
			ds_echo (ds_template_new_week());
		}
		ds_echo (ds_template_day(i + 1, m, y));
		first_loop = 0;
		j ++;
		j %= 7;
	}
	ds_echo (ds_template_main_below());
	ds_ob_flush();
	document.getElementById('ds_conclass').scrollIntoView();
}

function ds_sh(t) {
	ds_element = t;
	var ds_sh_date = new Date();
	ds_c_month = ds_sh_date.getMonth() + 1;
	ds_c_year = ds_sh_date.getFullYear();
	
	ds_draw_calendar(ds_c_month, ds_c_year);
	
	document.getElementById('ds_conclass').style.display = '';
	
	the_left = ds_getleft(t);
	the_top = ds_gettop(t) + t.offsetHeight;
	
	document.getElementById('ds_conclass').style.left = the_left + 'px';
	document.getElementById('ds_conclass').style.top = the_top + 'px';
	
	document.getElementById('ds_conclass').scrollIntoView();
}

function ds_hi() {
	document.getElementById('ds_conclass').style.display = 'none';
}

function ds_nm() {
	ds_c_month ++;
	if (ds_c_month > 12) {
		ds_c_month = 1; 
		ds_c_year++;
	}
	ds_draw_calendar(ds_c_month, ds_c_year);
}

function ds_pm() {
	ds_c_month = ds_c_month - 1;
	if (ds_c_month < 1) {
		ds_c_month = 12; 
		ds_c_year = ds_c_year - 1;
	}
	ds_draw_calendar(ds_c_month, ds_c_year);
}

function ds_ny() {
	ds_c_year++;
	ds_draw_calendar(ds_c_month, ds_c_year);
}

function ds_py() {
	ds_c_year = ds_c_year - 1;
	ds_draw_calendar(ds_c_month, ds_c_year);
}

function ds_format_date(d, m, y) {
	m2 = '00' + m;
	m2 = m2.substr(m2.length - 2);
	d2 = '00' + d;
	d2 = d2.substr(d2.length - 2);
	return d2 + '-' + m2 + '-' + y;
}

function ds_onclick(d, m, y) {
	ds_hi();
	if (typeof(ds_element.value) != 'undefined') {
		ds_element.value = ds_format_date(d, m, y);
	} else if (typeof(ds_element.innerHTML) != 'undefined') {
		ds_element.innerHTML = ds_format_date(d, m, y);
	} else {
		alert (ds_format_date(d, m, y));
	}
}