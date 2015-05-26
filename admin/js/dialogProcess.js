
function alertInputForm(msg)
{
    $('.alert').show().html(' <strong>' + msg + '</strong>');
}
    
    
var imglist=[];
var titlelist=[];
var textlist=[];
var hreflist=[];
initLists();
prepareImages();

var curimg=0;
function changePicture(direction)
{
    if(direction==undefined) direction=1;
    var bground=document.getElementById('background');

    curimg+=direction;
    if(curimg>imglist.length-1) curimg=0;
    if(curimg<0) curimg=imglist.length-1;

    bground.style.backgroundImage='url(images/'+imglist[curimg]+')';
}

function initLists()
{   
    imglist=['img1.jpg','img2.jpg','img3.jpg','img4.jpg'];
}
function prepareImages()
{
    var foreground=document.createElement('div');
    var cnt=imglist.length;
    for(var item=0;item<cnt;item++)
    {            
        var newimg = document.createElement("img");
        newimg.src='images/'+imglist[item];
        if(item!=0) newimg.style.display="none";
        else newimg.style.display="block";
        foreground.appendChild(newimg);        
    }    
}