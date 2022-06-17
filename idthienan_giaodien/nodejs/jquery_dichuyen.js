var imgObj = null;
	    function init(){
               imgObj = document.getElementById('myImage');
               imgObj.style.position= 'relative'; 
               imgObj.style.left = '0px'; 
	       imgObj.style.top = '0px';				
            }
	   function Trai(){
               imgObj.style.left = parseInt(imgObj.style.left) - 10 + 'px';
            }
		  function Phai(){
               imgObj.style.left = parseInt(imgObj.style.left) + 10 + 'px';
            } 
		  function Len(){
               imgObj.style.top = parseInt(imgObj.style.top) - 10 + 'px';
            }
		  function Xuong(){
               imgObj.style.top = parseInt(imgObj.style.top) + 10 + 'px';
            }		  
	   window.onload =init;
