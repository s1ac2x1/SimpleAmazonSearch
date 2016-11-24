 var keyStr = "ABCDEFGHIJKLMNOP" +
               "QRSTUVWXYZabcdef" +
               "ghijklmnopqrstuv" +
               "wxyz0123456789+/" +
               "=";

  function encode64(input) {
     input = escape(input);
     var output = "";
     var chr1, chr2, chr3 = "";
     var enc1, enc2, enc3, enc4 = "";
     var i = 0;

     do {
        chr1 = input.charCodeAt(i++);
        chr2 = input.charCodeAt(i++);
        chr3 = input.charCodeAt(i++);

        enc1 = chr1 >> 2;
        enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
        enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
        enc4 = chr3 & 63;

        if (isNaN(chr2)) {
           enc3 = enc4 = 64;
        } else if (isNaN(chr3)) {
           enc4 = 64;
        }

        output = output +
           keyStr.charAt(enc1) +
           keyStr.charAt(enc2) +
           keyStr.charAt(enc3) +
           keyStr.charAt(enc4);
        chr1 = chr2 = chr3 = "";
        enc1 = enc2 = enc3 = enc4 = "";
     } while (i < input.length);

     return output;
  }

var jobs = {
  onLoad: function() 
  {
    this.initialized = true;
    this.strings = document.getElementById("jobs-strings");
  },
  
 alert: function(msg)
 {
  var promptService = Components.classes["@mozilla.org/embedcomp/prompt-service;1"].getService(Components.interfaces.nsIPromptService);
  promptService.alert(window, 'Message', s);
 },
   
  show: function() 
  {  	  	  	         
         var s = content.getSelection();
         var tab = gBrowser.addTab('http://simpleamazonsearch.com/index.php?title=' + encode64(s));
         gBrowser.selectedTab = tab;
  },
  
about : function()
  {
    openDialog(
               "chrome://jobs/content/about.xul",
               "",
               "centerscreen,dialog,chrome,dependent"
              );
  },
review : function()
{
 var tab = gBrowser.addTab('http://simpleamazonsearch.com');
 gBrowser.selectedTab = tab;                         
}
  

};
window.addEventListener("load", function(e) { jobs.onLoad(e); }, false);
