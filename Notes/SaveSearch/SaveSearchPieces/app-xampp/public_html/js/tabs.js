//Set tab to intially be selected when page loads:
//[which tab (1=first tab), ID of tab content to display (or "" if no corresponding tab content)]:
var initialtab=[2, "sc2"]

//Turn menu into single level image tabs (completely hides 2nd level)?
var turntosingle=0 //0 for no (default), 1 for yes

//Disable hyperlinks in 1st level tab images?
var disabletablinks=0 //0 for no (default), 1 for yes


////////Stop editting////////////////

var previoustab="";
var previoustab_id="";
var previoustab_id2="";
var prev_tab_arr = [];

if (turntosingle==1){
  document.write('<style type="text/css">\n#tabcontentcontainer{display: none;}\n</style>')
}
function expandcontent(cid, aobject, tabid){
  if (disabletablinks==1)
    aobject.onclick=new Function("return false");
  if (document.getElementById && turntosingle==0){
      highlighttab(aobject, tabid);
      previoustab_id = prev_tab_arr[tabid];
      //alert(previoustab_id + " >> "+cid+" >> "+tabid);
      if (previoustab_id!=""){
        document.getElementById(previoustab_id).style.display="none";
      }
      if (cid!=""){
        document.getElementById(cid).style.display="block";
        prev_tab_arr[tabid] = cid;
      }
  }
}

function expandcontent2(cid, aobject, tabid){
  if (disabletablinks==1)
    aobject.onclick=new Function("return false");
  if (document.getElementById && turntosingle==0){
      highlighttab(aobject, tabid);
    if (previoustab2!=""){
      document.getElementById(previoustab2).style.display="none";
    }
    if (cid!=""){
      document.getElementById(cid).style.display="block";
      previoustab2=cid;
    }
  }
}

function highlighttab(aobject, tabid){
  if (typeof tabobjlinks=="undefined"){
    //collectddimagetabs(tabid);
  }
  var tabobj=document.getElementById(tabid)
  tabobjlinks=tabobj.getElementsByTagName("A");
  //alert(tabid + " >> "+tabobjlinks.length);
  for (i=0; i<tabobjlinks.length; i++){
    tabobjlinks[i].className="";
  }
  //alert(aobject);
  aobject.className="current";
}

function collectddimagetabs(tabid){
  var tabobj=document.getElementById(tabid)
  tabobjlinks=tabobj.getElementsByTagName("A");
  //alert(tabobjlinks.length);
}

function do_onload(){
  collectddimagetabs()
  expandcontent(initialtab[1], tabobjlinks[initialtab[0]-1])
}

function do_onload_new(tabid,selected_tab_id,selected_tab_index){
  //collectddimagetabs(tabid);
  var tabobj=document.getElementById(tabid);
  tabobjlinks=tabobj.getElementsByTagName("A");
  prev_tab_arr[tabid] = selected_tab_id;
  expandcontent(selected_tab_id, tabobjlinks[selected_tab_index], tabid);
}
/*
if (window.addEventListener)
window.addEventListener("load", do_onload, false)
else if (window.attachEvent)
window.attachEvent("onload", do_onload)
else if (document.getElementById)
window.onload=do_onload*/
//do_onload();