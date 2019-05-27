
function stopRKey(evt) {
	var evt = (evt) ? evt : ((event) ? event : null);
	var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
	if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}
document.onkeypress = stopRKey;

function doThing(inputs) {    
    for (var i=0; i<inputs.length; i++) {
        inputs[i].onkeydown = function(e) {
            if (e.keyCode==40) {
                var node = this.nextSibling;
                while (node) {
                    console.log(node.tagName);
                    if (node.tagName=='INPUT' || node.tagName=='SELECT') {
                        node.focus();
                        break;
                    }
                    node = node.nextSibling;                
                }
            }
        };
    };
}
doThing(document.getElementsByTagName('input'));
doThing(document.getElementsByTagName('select'));