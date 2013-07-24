<?php

/*THIS IS STRICTLY EXAMPLE SOURCE CODE. IT IS ONLY MEANT TO 
QUICKLY DEMONSTRATE THE CONCEPT AND THE USAGE OF THE ADAPTIVE 
PAYMENTS API. PLEASE NOTE THAT THIS IS *NOT* PRODUCTION-QUALITY 
CODE AND SHOULD NOT BE USED AS SUCH.

THIS EXAMPLE CODE IS PROVIDED TO YOU ONLY ON AN "AS IS" 
BASIS WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, EITHER 
EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION ANY WARRANTIES 
OR CONDITIONS OF TITLE, NON-INFRINGEMENT, MERCHANTABILITY OR 
FITNESS FOR A PARTICULAR PURPOSE. PAYPAL MAKES NO WARRANTY THAT 
THE SOFTWARE OR DOCUMENTATION WILL BE ERROR-FREE. IN NO EVENT 
SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY 
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR 
CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT 
OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; 
OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF 
LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT 
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF 
THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY 
OF SUCH DAMAGE.
*/

	/* TODO
 	* Using PHP SOAP 5.3
	* Modifiy/add other fields to the class structure based on payment types/API requirements
	* the http headers and request body contains sample data, please replace the data with valid data.
	*/


//turn php errors on
ini_set("track_errors", true);

//set PayPal Endpoint to sandbox
//set PayPal Endpoint to sandbox
$api_endpoint = trim("https://svcs.sandbox.paypal.com/AdaptivePayments/PaymentDetails");
$wsdl = trim("https://svcs.sandbox.paypal.com/AdaptivePayments?wsdl");

/*
*******************************************************************
PayPal API Credentials
Replace <API_USERNAME> with your API Username
Replace <API_PASSWORD> with your API Password
Replace <API_SIGNATURE> with your Signature
*******************************************************************
*/

//PayPal API Credentials
$API_UserName = "sbapi_1287090601_biz_api1.paypal.com"; //TODO
$API_Password = "1287090610"; //TODO
$API_Signature = "ANFgtzcGWolmjcm5vfrf07xVQ6B9AsoDvVryVxEQqezY85hChCfdBMvY"; //TODO
	
//Default App ID for Sandbox	
$API_AppID = "APP-80W284485P519543T";

$API_MessageProtocol = "SOAP11";




class RequestEnvelope {
    public $detailLevel;
    public $errorLanguage;
}
class PaymentDetailsRequest { 
public $payKey; 
public $requestEnvelope; 

}  

try {	
	//create instance of the complex types classes
	$xrequestEnvelope = new RequestEnvelope();

	//instance of the PayRequest complex type which will be payload for the Pay Operation
	$params = new PaymentDetailsRequest();
   	$params->requestEnvelope = $xrequestEnvelope;
   	$params->payKey = 'AP-70A23669JT320981C';


 //API credentials - http headers  	
   	
	$http_headers = "X-PAYPAL-SECURITY-USERID: " . $API_UserName . "\r\n" .
                    "X-PAYPAL-SECURITY-SIGNATURE: " . $API_Signature . "\r\n" .
                 	"X-PAYPAL-SECURITY-PASSWORD: " . $API_Password . "\r\n" .
                   	"X-PAYPAL-APPLICATION-ID: " . $API_AppID . "\r\n" .
   	                "X-PAYPAL-MESSAGE-PROTOCOL: " .$API_MessageProtocol. "\r\n";
   	


$opts = array( 'http' => array('method'=>'POST','header'=>$http_headers));


$ctx = stream_context_create($opts);


$soapClient = new SoapClient($wsdl,
							array('location' => $api_endpoint, 
                                  'uri' => "urn:PaymentDetails", //define the soap action
                                  'soap_version' => SOAP_1_1, 
                                  'trace' => 1, //add this line for debugging purpose during development
                                  'stream_context' => $ctx)); //adding the stream context option containing the http headers
                    
$response = $soapClient->PaymentDetails($params);

//The $response is a PaymentDetailsResponse object type.
//Save or retrive information from the incomming response



$cancelUrl = $response->cancelUrl;
$status  = $response->status;
$senderEmail  = $response->senderEmail;
$feespayer = $response->feesPayer;
$paykey = $response->payKey;



    echo '<p>Some payment details of paykey :' . $paykey. '</p><br/>';
      echo '<p>status :' . $status. '</p><br/>';
        echo '<p>sender email :' . $senderEmail. '</p><br/>';
          echo '<p>fees payer :' . $feespayer. '</p><br/>';
           


} catch (SoapFault $e) { 
    echo "Error Id : ||" .$e->detail->FaultMessage->error->errorId;
  echo "Error Message : ||" .$e->details->FaultMessage->error->message;	
}

?>
