
var test = null;
var myVal = ""; // Drop down selected value of reader 
var disabled = true;
var startEnroll = false;

var currentFormat = Fingerprint.SampleFormat.PngImage;

var FingerprintSdkTest = (function () {
    function FingerprintSdkTest() {
        var _instance = this;
        this.operationToRestart = null;
        this.acquisitionStarted = false;
        this.sdk = new Fingerprint.WebApi;
        this.sdk.onDeviceConnected = function (e) {
            // Detects if the deveice is connected for which acquisition started
            GetInfo();
            
        };
        this.sdk.onDeviceDisconnected = function (e) {
            // Detects if device gets disconnected - provides deviceUid of disconnected device
            alert("Device disconnected");
            $("#startStopScan").prop('disabled', true);
           
        };
        this.sdk.onCommunicationFailed = function (e) {
            // Detects if there is a failure in communicating with U.R.U web SDK
            alert("Communinication Failed");
        };
        this.sdk.onSamplesAcquired = function (s) {
            console.log(s);
            // Sample acquired event triggers this function
                sampleAcquired(s);
        };
        this.sdk.onQualityReported = function (e) {
            // Quality of sample aquired - Function triggered on every sample acquired
        };

    }

    FingerprintSdkTest.prototype.startCapture = function () {
        if (this.acquisitionStarted) // Monitoring if already started capturing
            return;
        var _instance = this;
        
        this.operationToRestart = this.startCapture;
        this.sdk.startAcquisition(currentFormat, myVal).then(function () {
            _instance.acquisitionStarted = true;
        }, function (error) {
            alert(error.message);
        });
    };
    FingerprintSdkTest.prototype.stopCapture = function () {
        if (!this.acquisitionStarted) //Monitor if already stopped capturing
            return;
        var _instance = this;
        alert("");
        this.sdk.stopAcquisition().then(function () {
            _instance.acquisitionStarted = false;

        }, function (error) {
            alert(error.message);
        });
    };

    FingerprintSdkTest.prototype.getInfo = function () {
        var _instance = this;
        return this.sdk.enumerateDevices();
    };

    FingerprintSdkTest.prototype.getDeviceInfoWithID = function (uid) {
        var _instance = this;
        return  this.sdk.getDeviceInfo(uid);
    };

    
    return FingerprintSdkTest;
})();


function onStart() {  
        test.startCapture();
}

function onStop() {
    test.stopCapture();
}

function GetInfo() {
    var allReaders = test.getInfo();    
    allReaders.then(function (sucessObj) {
        myVal = sucessObj[0];
         $("#startStopScan").prop('disabled', false);
        alert(myVal);  
        alert(currentFormat);  
    }, function (error){
        alert("No se detecto el lector");
    });
}



function sendRawToServer(raw, name)
{
    $.ajax({
  method: "POST",
        url: "http://52.214.193.226:81/api/ScanAuth",
  data: { raw: raw, name: name },
  crossDomain: true,
  dataType: "json"

})
  .done(function( msg ) {
      console.log(msg);
    alert(JSON.stringify(msg) );
  });
}

function download(filename, text) {
  var element = document.createElement('a');
  element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
  element.setAttribute('download', filename);

  element.style.display = 'none';
  document.body.appendChild(element);

  element.click();

  document.body.removeChild(element);
}

function startScan()
{
    assignFormat();
    test.startCapture();
}

function sampleAcquired(s){  
    
        console.log("****************");
        console.log(s);
        console.log("****************");
        return;

            if(currentFormat == Fingerprint.SampleFormat.PngImage){   
       
                localStorage.setItem("imageSrc", "");                
                var samples = JSON.parse(s.samples);   
                var name = $("#userName").val();
                console.log(samples[0]);
                alert(name);
                sendRawToServer(samples[0], name)         
           /*     localStorage.setItem("imageSrc", "data:image/png;base64," + Fingerprint.b64UrlTo64(samples[0]));
                if(state == document.getElementById("content-capture")){ 
                    var vDiv = document.getElementById('imagediv');
                    vDiv.innerHTML = "";
                    var image = document.createElement("img");
                    image.id = "image";
                    image.src = localStorage.getItem("imageSrc");
                    vDiv.appendChild(image); 
                }

                disableEnableExport(false);*/
            }
/*
            else if(currentFormat == Fingerprint.SampleFormat.Raw){  
                // If sample acquired format is RAW- perform following call on object recieved 
                // Get samples from the object - get 0th element of samples and then get Data from it.
                // Returned data is Base 64 encoded, which needs to get decoded to UTF8,
                // after decoding get Data key from it, it returns Base64 encoded raw image data
                localStorage.setItem("raw", "");
                var samples = JSON.parse(s.samples);
                var sampleData = Fingerprint.b64UrlTo64(samples[0].Data);
                console.log("****************");
                console.log(sampleData);
                console.log("****************");
                var decodedData = JSON.parse(Fingerprint.b64UrlToUtf8(sampleData));
                console.log("****************");
                console.log(decodedData);
                sendRawToServer(decodedData.Data, "Diego")
                console.log("****************");
                localStorage.setItem("raw", Fingerprint.b64UrlTo64(decodedData.Data));

                var vDiv = document.getElementById('imagediv').innerHTML = '<div id="animateText" style="display:none">RAW Sample Acquired <br>'+Date()+'</div>';
                setTimeout('delayAnimate("animateText","table-cell")',100); 

                disableEnableExport(false);
            }

            else if(currentFormat == Fingerprint.SampleFormat.Compressed){  
                // If sample acquired format is Compressed- perform following call on object recieved 
                // Get samples from the object - get 0th element of samples and then get Data from it.
                // Returned data is Base 64 encoded, which needs to get decoded to UTF8,
                // after decoding get Data key from it, it returns Base64 encoded wsq image
                localStorage.setItem("wsq", "");
                var samples = JSON.parse(s.samples);
                var sampleData = Fingerprint.b64UrlTo64(samples[0].Data);
                var decodedData = JSON.parse(Fingerprint.b64UrlToUtf8(sampleData));
                localStorage.setItem("wsq","data:application/octet-stream;base64," + Fingerprint.b64UrlTo64(decodedData.Data));

                var vDiv = document.getElementById('imagediv').innerHTML = '<div id="animateText" style="display:none">WSQ Sample Acquired <br>'+Date()+'</div>';
                setTimeout('delayAnimate("animateText","table-cell")',100);   

                disableEnableExport(false);
            }

            else if(currentFormat == Fingerprint.SampleFormat.Intermediate){  
                // If sample acquired format is Intermediate- perform following call on object recieved 
                // Get samples from the object - get 0th element of samples and then get Data from it.
                // It returns Base64 encoded feature set
                localStorage.setItem("intermediate", "");
                var samples = JSON.parse(s.samples);
                var sampleData = Fingerprint.b64UrlTo64(samples[0].Data);
                localStorage.setItem("intermediate", sampleData);

                var vDiv = document.getElementById('imagediv').innerHTML = '<div id="animateText" style="display:none">Intermediate Sample Acquired <br>'+Date()+'</div>';
                setTimeout('delayAnimate("animateText","table-cell")',100); 

                disableEnableExport(false);
            }
*/
            else{
                alert("Format Error");
                //disableEnableExport(true);
            }    
}

function assignFormat(){
   currentFormat = Fingerprint.SampleFormat.PngImage;
}

$( document ).ready(function() {
    test = new FingerprintSdkTest();
});
// For Download and formats ends