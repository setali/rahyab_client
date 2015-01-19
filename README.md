# RahyabClient

<h3> How to work?</h3>
<p>
Download this package and add in your project. <br>
then  include "src/ClientManager".<br>
then  create a new ClientManager('soap', 'your username', 'your password').
example: $cm = new ClientManager('soap', 'your username', 'your password')
</p>

<h4> Send SMS   </h4>
<p>
$cm->->getConnector()->sendSms('50001********', ['9*********','9*********'], 'Test Message', "encoding");<br>
$encoding is "true" for persian and "false" for latin.
</p>

<h4> Get Credit   </h4>
<p>
$cm->getConnector()->getCredit();
</p>

<h4> Get Message   </h4>
<p>
$cm->getConnector()->getMessages("Last row messages ID ");
</p>

<h4> Get Message Status   </h4>
<p>
$cm->getConnector()->getMessagesStatus("Array of Message IDs ");
</p>

<h5> src/index.php is a example for RahyabClient   </h5>

